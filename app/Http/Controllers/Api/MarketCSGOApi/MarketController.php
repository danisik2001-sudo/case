<?php

namespace App\Http\Controllers\Api\MarketCSGOApi;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\User;
use App\Models\Live;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis; // Подключаем фасад Redis
use App\Services\RedisService;
use GuzzleHttp\Client;


class MarketController extends Controller
{
    const MARKET_URL = 'https://market.csgo.com';

    protected $redis;

    protected $settings;

    public function __construct()
    {
        $this->redis = new RedisService();
        $this->settings = Setting::first();
    }


    public function checkItems()
    {
        $items = Live::query()
            ->where('status', Live::SENDING)
            ->orWhere('status', Live::WAIT_SELLER)
            ->orWhere('status', Live::WAIT_ORDER)
            ->orWhere('status', Live::ORDER_READY)
            ->get();

        foreach ($items as $item) {
            $url = json_decode(file_get_contents(self::MARKET_URL . '/api/v2/get-buy-info-by-custom-id?key=' . $this->settings->market_key . '&custom_id=' . $item->custom_id), true);
            if ($url['success']) {
                $data = $url['data'];

                if ($data['stage'] === "1" && (is_null($data['trade_id']) || $data['trade_id'] === "0") && $item->status !== Live::WAIT_SELLER) {
                    $item->update([
                        'status' => Live::WAIT_SELLER
                    ]);

                    Redis::publish('setItemStatus', json_encode([
                        'id' => $item->id,
                        'status' => Live::WAIT_SELLER,
                        'user_id' => $item->user_id,
                    ]));
                }

                if ($data['stage'] === "1" && !is_null($data['trade_id']) && $data['trade_id'] !== "0" && $data['trade_id'] !== 0 && is_null($item->trade_id)) {

                    $item->update([
                        'status' => Live::ORDER_READY,
                        'trade_id' => is_null($data['trade_id']) ? null : $data['trade_id'],
                        'user_id' => $item->user_id
                    ]);

                    Redis::publish('notify', json_encode([
                        'user_id' => $item->user_id,
                        'success' => true,
                        'message' => 'Предмет отправлен, примите его в профиле!'
                    ]));


                    Redis::publish('setItemStatus', json_encode([
                        'id' => $item->id,
                        'user_id' => $item->user_id,
                        'status' => $item->status,
                        'trade_id' => $data['trade_id']
                    ]));

                    // $this->redis->event('setItemStatus', [
                    //     'id' => $item->id,
                    //     'user_id' => $item->user_id,
                    //     'status' => $item->status,
                    //     'trade_id' => $data['trade_id']
                    // ]);
                }

                if ($data['stage'] === "2") {
                    $item->update([
                        'status' => Live::SEND
                    ]);

                    Redis::publish('setItemStatus', json_encode([
                        'id' => $item->id,
                        'status' => $item->status,
                        'user_id' => $item->user_id
                    ]));
                    // $this->redis->event('setItemStatus', [
                    //     'id' => $item->id,
                    //     'status' => $item->status,
                    //     'user_id' => $item->user_id
                    // ]);
                }

                if ($data['stage'] === "5") {
                    $item->update([
                        'status' => Live::OPENED,
                        'market_id' => NULL,
                        'custom_id' => NULL,
                        'trade_id' => NULL,
                    ]);

                    Redis::publish('notify', json_encode([
                        'user_id' => $item->user_id,
                        'success' => false,
                        'message' => 'Один из ваших трейдов отменён'
                    ]));

                    Redis::publish('setItemStatus', json_encode([
                        'id' => $item->id,
                        'status' => $item->status,
                        'user_id' => $item->user_id
                    ]));

                    // $this->redis->event('setItemStatus', [
                    //     'id' => $item->id,
                    //     'status' => $item->status,
                    //     'user_id' => $item->user_id
                    // ]);
                }
            }
        }
    }

    // Создание вывода предмета в профиле, покупка на Market CSGO
    public function withdraw(Request $request): array
    {
        $user = $request->user();
        $userPayment = User::query()
            ->withSum(['paymentsPayed' => function ($query) {
                $query->where('status', 1);
            }], 'sum')
            ->find(intval($request->user()->id));

        if (!$user) return ['success' => false, 'message' => 'Авторизуйтесь'];
        if (is_null($user->trade_link)) return ['success' => false, 'message' => 'Укажите ссылку на обмен'];
        if ($userPayment->payments_payed_sum_sum == 0) return ['success' => false, 'message' => 'Сделайте минимальный депозит для возможности вывода!'];
        if (!$this->settings->market_key) return ['success' => false, 'message' => 'Выводы закрыты'];
        if ($user->block_withdraw == 1) return ['success' => false, 'message' => 'Произошла ошибка при выводе. Обратитесь в техническую поддержку'];

        if (Cache::has('send.' . $user->id)) return ['success' => false, 'message' => 'Не так быстро...'];
        if (Cache::has('send.yes.' . $user->id)) return ['success' => false, 'message' => 'Подождите минуту после прошлого вывода'];
        Cache::put('send.' . $user->id, '', 10);

        $liveId = $request->id;

        Log::info('liveId: ' . $liveId);

        $live = Live::query()
            ->with('item')
            ->where('user_id', $user->id)
            ->where('status', Live::OPENED)
            ->where('id', $liveId)
            ->first();
        if (!$live) return ['success' => false, 'message' => 'Данный предмет уже был продан или выведен'];

        if ($live->price < $this->settings->withdraw_min_sum) return ['success' => false, 'message' => 'Минимальная сумма вывода - ' . $this->settings->withdraw_min_sum . '₽'];

        // Получаем правильный market_hash_name со стима
        $url = json_decode(file_get_contents('https://api.steampowered.com/ISteamEconomy/GetAssetClassInfo/v0001/?key=' . env('STEAM_API_KEY') . '&appid=730&class_count=1&classid0=' . $live->item->classid . '&language=ru_RU'), true);
        $result = $url['result'];

        if (!$result['success']) {
            $live->update([
                'status' => Live::OPENED
            ]);

            return ['success' => false, 'message' => 'Попробуйте позже', 'status' => $live->status];
        }

        $item = $result[$live->item->classid];
        $market_hash_name = $item['market_hash_name'];

        // Получаем список активных оферов на market csgo по market_hash_name
        $url = Http::get(self::MARKET_URL . '/api/v2/search-item-by-hash-name', [
            'key' => $this->settings->market_key,
            'hash_name' => $market_hash_name
        ])->json();

        if (!$url['success'] || !isset($url['data'][0])) {
            $live->update([
                'status' => Live::OPENED
            ]);
            return ['success' => false, 'message' => 'Не нашли подходящий предложений на маркете', 'status' => $live->status];
        }

        // Получаем первый самый дешевый офер
        $item = $url['data'][0];
        $custom_id = Str::random(50);

        $token = $this->_parseToken($user->trade_link);
        $partner = $this->_parsePartner($user->trade_link);

        $maxPrice = ($live->price * 100) * 1.05;


        $minPrice = $item['price'] / 100;

        // Проверяем, чтобы цена предмета не превышала допустимый лимит
        if ($minPrice > $maxPrice) {
            $live->update([
                'status' => Live::OPENED
            ]);
            return ['success' => false, 'message' => 'Ошибка вывода. Попробуйте позже!', 'status' => $live->status];
        }

        // Создаём запрос на покупку предмета
        $url = json_decode(file_get_contents(self::MARKET_URL . '/api/v2/buy-for?key=' . $this->settings->market_key . '&hash_name=' . $item['market_hash_name'] . '&price=' . $item['price'] . '&partner=' . $partner . '&token=' . $token . '&custom_id=' . $custom_id), true);

        if (!$url['success']) {
            $live->update([
                'status' => Live::OPENED
            ]);
            return ['success' => false, 'message' => 'Не нашли подходящий предложений на маркете', 'status' => $live->status];
        }

        Cache::put('send.yes.' . $user->id, '', 60);

        $live->update([
            'status' => Live::SENDING,
            'market_id' => $url['id'],
            'custom_id' => $custom_id
        ]);

        return ['success' => true, 'message' => 'Запрос на покупку отправлен', 'status' => $live->status];
    }

    public function updateItemsPricesSteamp(): array
    {
        set_time_limit(300); // Увеличиваем лимит на выполнение скрипта

        $client = new Client();

        try {
            // Отправляем GET-запрос к API steamp.ru
            $response = $client->get('https://steamp.ru/api/v2', [
                'query' => [
                    'appid' => '730',
                    'classid' => 'true',
                    'img' => 'true',
                    'rarity' => 'true',
                ],
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ]);

            // Декодируем тело ответа
            $data = json_decode($response->getBody()->getContents(), true);

            // Проверяем наличие элементов
            if (isset($data['items']) && is_array($data['items'])) {
                // Разбиваем данные на части для избежания таймаута
                foreach (array_chunk($data['items'], 100) as $chunk) {
                    foreach ($chunk as $marketHashName => $item) {
                        $existingItem = Item::where('classid', $item['classid'])->first();

                        if ($existingItem) {
                            $newPriceSteam = $item['price'] * 1.07;
                            $existingItem->update(['price' => $newPriceSteam]);
                        }
                    }
                }
            }

            return ['success' => true, 'message' => 'Цены на предметы обновлены'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Ошибка при обновлении цен: ' . $e->getMessage()];
        }
    }

    public function updateItemsPricesMarket(): array
    {
        $url = json_decode(file_get_contents('https://market.csgo.com/api/v2/prices/RUB.json'), true);

        if (!$url['success']) {
            return ['success' => false, 'message' => 'Ошибка запроса API'];
        }

        $items = $url['items'];

        // Разбиваем данные на части по 500 элементов
        foreach (array_chunk($items, 500) as $chunk) {
            foreach ($chunk as $item) {
                $basePrice = $item['price'];

                // Определяем коэффициент в зависимости от цены
                if ($basePrice >= 0 && $basePrice <= 25000) {
                    $newPrice = $basePrice * 1.25;
                } elseif ($basePrice > 250 && $basePrice <= 50000) {
                    $newPrice = $basePrice * 1.15;
                } elseif ($basePrice > 500 && $basePrice <= 150000) {
                    $newPrice = $basePrice * 1.1;
                } else {
                    $newPrice = $basePrice * 1.07;
                }

                Item::query()->where('market_hash_name', $item['market_hash_name'])->update([
                    'price' => $newPrice
                ]);
            }
        }

        Log::info('Цены на предметы обновлены');

        return ['success' => true, 'message' => 'Цены на предметы обновлены'];
    }



    public function updateItemsList(): array
    {
        $client = new Client();

        try {
            $response = $client->get('https://steamp.ru/api/v2', [
                'query' => [
                    'appid' => '730',
                    'classid' => 'true',
                    'img' => 'true',
                    'rarity' => 'true',
                ],
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (!isset($data['items']) || !is_array($data['items'])) {
                return ['success' => false, 'message' => 'Некорректные данные от API'];
            }

            $excludedItems = ['case', 'capsule', 'music kit', 'sticker capsule', 'RMR', 'Sticker', 'Package', 'Autograph', 'Legends', 'Patch', 'Katowice', 'Pass', 'PGL', 'Graffiti', 'StatTrak™'];

            foreach ($data['items'] as $marketHashName => $item) {
                if (preg_match('/' . implode('|', $excludedItems) . '/i', $marketHashName)) {
                    continue;
                }

                $price = $item['price'];

                $existingItem = Item::where('market_hash_name', $marketHashName)->first();

                if (!$existingItem) {
                    Item::create([
                        'classid' => $item['classid'] ?? null,
                        'price' => $price,
                        'rarity' => $item['rarity'] ?? 'неизвестно',
                        'icon_url' => $item['img'] ?? '',
                        'market_hash_name' => $marketHashName,
                        'market_name' => $marketHashName,
                        'exterior' => $item['rarity'] ?? null,
                    ]);
                }
            }
            Log::info('Список предметов обновлен');

            return ['success' => true, 'message' => 'Список предметов обновлен'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Ошибка при обновлении списка предметов: ' . $e->getMessage()];
        }
    }





    private function _parsePartner($tradeLink)
    {
        $query_str = parse_url($tradeLink, PHP_URL_QUERY);
        parse_str($query_str, $query_params);
        return isset($query_params['partner']) ? $query_params['partner'] : false;
    }

    private function _parseToken($tradeLink)
    {
        $query_str = parse_url($tradeLink, PHP_URL_QUERY);
        parse_str($query_str, $query_params);
        return isset($query_params['token']) ? $query_params['token'] : false;
    }
}
