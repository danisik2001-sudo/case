<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Item;
use App\Models\Level;
use App\Models\Live;
use App\Models\Logs;
use App\Models\Payment;
use App\Models\Upgrade;
use App\Models\User;
use App\Services\RedisService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class UsersController extends Controller
{
    public function user(Request $request): array
    {
        $user = User::query()->where('steamid', $request->steamid)->first();
        if (!$user) return ['success' => false];

        $items = Live::query()
            ->with('item')
            ->where('user_id', $request->user()->id)
            ->orderBy('id', 'desc')
            ->get();

        $contracts = Contract::query()
            ->with('winItem:id,market_hash_name,icon_url,rarity')
            ->select('user_id', 'item_id', 'price', 'items')
            ->where('user_id', $request->user()->id)
            ->orderBy('id', 'desc')
            ->get();

        $contractItems = [];
        $price = 0;
        foreach ($contracts as $contract) {

            foreach (json_decode($contract->items, true) as $item) {
                $contractItems[] = Item::query()->select('icon_url', 'price', 'rarity')->find($item);
            }

            foreach ($contractItems as $contractItem) {
                $price += $contractItem->price;
            }

            $contract->itemsList = $contractItems;
            $contract->allPrice = $price;
        }

        return [
            'user' => $user,
            'info' => [
                'liveCount' => $user->live()->count(),
                'upgrades_count' => $user->upgradesCount,
                'contracts_count' => $user->contractsCount
            ],
            'best' => [
                'drop' => Live::query()->where('user_id', $user->id)
                    ->select('id', 'item_id', 'price')
                    ->with('item:id,market_hash_name,market_name,rarity,icon_url')
                    ->orderBy('price', 'desc')
                    ->first(),
                'case' => Live::query()->where('user_id', $user->id)
                    ->whereNotNull('case_id')
                    ->select('case_id')
                    ->with('case:id,name,image,url')
                    ->groupBy('case_id')
                    ->first()->case ?? null
            ],
            'items' => $items,
            'contracts' => $contracts,
            'upgrades' => Upgrade::query()
                ->select('id', 'item_id', 'price', 'price_win', 'win_id', 'percent', 'status')
                ->with(['usedItem:id,icon_url,market_hash_name,rarity', 'winItem:id,icon_url,market_hash_name,rarity'])
                ->where('user_id', $request->user()->id)
                ->orderBy('id', 'desc')
                ->get()
        ];
    }

    public function profile(Request $request): array
    {
        $user = $request->user();

        $levelThresholds = [
            1 => 20,
            2 => 80,
            3 => 180,
            4 => 320,
            5 => 500,
            6 => 720,
            7 => 980,
            8 => 1280,
            9 => 1620,
            10 => 2000,
            11 => 2420,
            12 => 2880,
            13 => 3380,
            14 => 3920,
            15 => 4500,
            16 => 5120,
            17 => 5780,
            18 => 6480,
            19 => 7220,
            20 => 8000,
            21 => 8820,
            22 => 9680,
            23 => 10580,
            24 => 11520,
            25 => 12500,
            26 => 13520,
            27 => 14580,
            28 => 15680,
            29 => 16820,
            30 => 18000,
            31 => 19220,
            32 => 20480,
            33 => 21780,
            34 => 23120,
            35 => 24500,
            36 => 25920,
            37 => 27380,
            38 => 28880,
            39 => 30420,
            40 => 32000,
            41 => 33620,
            42 => 35280,
            43 => 36980,
            44 => 38720,
            45 => 40500,
            46 => 42320,
            47 => 44180,
            48 => 46080,
            49 => 48020,
            50 => 50000
        ];

        // Вычисление текущего уровня пользователя
        $currentLvl = $user->lvl;
        $nextThreshold = 0;
        $prevThreshold = 0;

        foreach ($levelThresholds as $lvl => $threshold) {
            if ($user->exp >= $threshold) {
                $currentLvl = $lvl;
                $prevThreshold = $threshold;
            } else {
                $nextThreshold = $threshold;
                break;
            }
        }

        if ($user->lvl != $currentLvl) {
            $user->update(['lvl' => $currentLvl]);
        }

        // Вычисление прогресса (прогресс на текущем уровне)
        $progress = 0;
        if ($nextThreshold > 0 && $prevThreshold > 0) {
            $progress = ($user->exp - $prevThreshold) / ($nextThreshold - $prevThreshold) * 100;
        }

        return [
            'best' => [
                'drop' => Live::query()->where('user_id', $user->id)
                    ->select('id', 'item_id', 'price')
                    ->with('item:id,market_hash_name,rarity,icon_url')
                    ->orderBy('price', 'desc')
                    ->first(),
                'case' => Live::query()->where('user_id', $user->id)
                    ->whereNotNull('case_id')
                    ->select('case_id')
                    ->with(['case:id,category_id,name,image,price,url', 'case.category:id,name'])
                    ->groupBy('case_id')
                    ->first(),
            ],
            'allPrice' => Live::query()
                ->where('user_id', $user->id)
                ->where('status', Live::OPENED)
                ->sum('price'),
            'tradeLink' => $user->trade_link,
            'levelProgress' => $progress,  // Добавляем прогресс
            'currentLevel' => $currentLvl,  // Текущий уровень
            'nextLevelThreshold' => $nextThreshold,  // Порог следующего уровня
        ];
    }


    public function getUserHistory(Request $request)
    {
        $user = Auth::user();

        $items = Live::query()
            ->select('id', 'case_id', 'item_id', 'price', 'status', 'trade_id', 'market_id', 'custom_id', 'type')
            ->with(['item:id,market_hash_name,exterior,rarity,icon_url,price', 'case:id,url,name,image'])
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(15, ['*'], 'items');

        $upgrades = Upgrade::query()
            ->select('id', 'item_id', 'price', 'price_win', 'win_id', 'percent', 'status')
            ->with(['usedItem:id,icon_url,market_hash_name,rarity,price', 'winItem:id,icon_url,market_hash_name,rarity,price'])
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(8, ['*'], 'upgrades');

        $contracts = Contract::query()
            ->with('winItem:id,market_hash_name,icon_url,rarity')
            ->select('user_id', 'item_id', 'price', 'items')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(4, ['*'], 'contracts');


        foreach ($contracts->items() as $contract) {
            $contractsItems = [];
            $price = 0;

            foreach ($contract->items as $item) {
                $contractsItems[] = Item::query()->select('icon_url', 'price', 'rarity')->find($item);
            }

            foreach ($contractsItems as $item) {
                $price += $item->price;
            }

            $contract->itemsList = $contractsItems;
            $contract->priceAll = $price;
        }

        return [
            'items' => $items,
            'upgrades' => $upgrades,
            'contracts' => $contracts
        ];
    }

    public function getItemsForSale(Request $request): array
    {
        $user = $request->user();

        $items = Live::query()
            ->select('id', 'item_id', 'user_id', 'price', 'status')
            ->with(['item:id,market_hash_name,rarity,icon_url,price'])
            ->where('user_id', $user->id)
            ->where('status', 0)
            ->take(9)
            ->get();

        $allPrice = Live::query()
            ->where('user_id', $user->id)
            ->where('status', 0)
            ->sum('price');

        $count = Live::query()
            ->where('user_id', $user->id)
            ->where('status', 0)
            ->count('id');

        return [
            'items' => $items,
            'allPrice' => $allPrice,
            'countItems' => $count
        ];
    }

    public function getUser(Request $request): array
    {
        return [
            'user' => $request->user(),
        ];
    }

    public function getProfile(Request $request): array
    {
        $user = User::query()->where('id', $request->id)->first();

        if (!$user) {
            return ['success' => false, 'message' => 'Пользователь не найден'];
        }

        return [
            'success' => true,
            'user' => [
                'username' => $user->username,
                'steamid' => $user->steamid,
                'id' => $user->id,
                'avatar' => $user->avatar,
                'best' => [
                    'drop' => Live::query()->where('user_id', $user->id)
                        ->select('id', 'item_id', 'price')
                        ->with('item:id,market_hash_name,rarity,icon_url')
                        ->orderBy('price', 'desc')
                        ->first(),
                    'case' => [
                        'info' => Live::query()->where('user_id', $user->id)
                            ->whereNotNull('case_id')
                            ->select('case_id')
                            ->with(['case:id,category_id,name,image,price,url', 'case.category:id,name'])
                            ->groupBy('case_id')
                            ->first(),
                        'count' =>
                        Live::query()->where('user_id', $user->id)
                            ->whereNotNull('case_id')
                            ->groupBy('case_id')
                            ->count('id'),
                    ]
                ],
            ],
        ];
    }


    public function getProfileHistory(Request $request)
    {
        $user = User::query()->where('id', $request->id)->first();

        if (!$user) {
            return ['success' => false, 'message' => 'Пользователь не найден'];
        }

        $items = Live::query()
            ->select('id', 'case_id', 'item_id', 'price', 'status', 'trade_id', 'market_id', 'custom_id', 'type')
            ->with(['item:id,market_hash_name,exterior,rarity,icon_url,price', 'case:id,url,name,image'])
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(15, ['*'], 'items');

        $upgrades = Upgrade::query()
            ->select('id', 'item_id', 'price', 'price_win', 'win_id', 'percent', 'status')
            ->with(['usedItem:id,icon_url,market_hash_name,rarity,price', 'winItem:id,icon_url,market_hash_name,rarity,price'])
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(6, ['*'], 'upgrades');

        $contracts = Contract::query()
            ->with('winItem:id,market_hash_name,icon_url,rarity')
            ->select('user_id', 'item_id', 'price', 'items')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(4, ['*'], 'contracts');


        foreach ($contracts->items() as $contract) {
            $contractsItems = [];
            $price = 0;

            foreach ($contract->items as $item) {
                $contractsItems[] = Item::query()->select('icon_url', 'price', 'rarity')->find($item);
            }

            foreach ($contractsItems as $item) {
                $price += $item->price;
            }

            $contract->itemsList = $contractsItems;
            $contract->priceAll = $price;
        }

        return [
            'items' => $items,
            'upgrades' => $upgrades,
            'contracts' => $contracts
        ];
    }

    public function getSimilarItems(Request $request): array
    {
        $user = User::query()->find(\auth()->id());
        $itemId = $request->item_id;

        if (!$user) return ['success' => false, 'message' => 'Авторизируйтесь!'];

        // Проверяем, существует ли предмет
        $item = Live::with(["item"])
            ->where("user_id", $user->id)
            ->where("status", 0)
            ->where("id", $itemId)
            ->first();
        if (!$item) {
            return ['success' => false, 'message' => 'Предмет не найден'];
        }

        $price = $item->price;

        Log::info($item);
        Log::info($price);

        $similarItems = Item::query()
            ->where('id', '!=', $itemId)
            ->where('price', '<=', $price - 1)
            ->where(function ($query) {
                $query->where('rarity', 'like', '%Industrial%')
                    ->orWhere('rarity', 'like', '%Mil-spec%')
                    ->orWhere('rarity', 'like', '%Restricted%')
                    ->orWhere('rarity', 'like', '%Classified%')
                    ->orWhere('rarity', 'like', '%Covert%')
                    ->orWhere('rarity', 'like', '%★%');
            })
            ->orderBy('price', 'desc')
            ->take(21)
            ->get(['id', 'market_hash_name', 'price', 'icon_url', 'rarity']);

        Log::info($similarItems);

        return [
            'success' => true,
            'items' => $similarItems,
            'replaceable' => $item
        ];
    }

    public function replaceItem(Request $request): array
    {

        $user = User::query()->find(\auth()->id());
        $currentItemId = $request->input('current_item_id');
        $newItemId = $request->input('new_item_id');

        // Проверяем, существует ли текущий предмет
        $currentItem = Live::with(["item"])
            ->where("user_id", $user->id)
            ->where("status", 0)
            ->where("id", $currentItemId)
            ->first();
        if (!$currentItem) {
            return ['success' => false, 'message' => 'Текущий предмет не найден'];
        }

        // Проверяем, существует ли новый предмет
        $newItem = Item::find($newItemId);
        if (!$newItem) {
            return ['success' => false, 'message' => 'Новый предмет не найден'];
        }

        if ($newItem->price > $currentItem->item->price) {
            return ['success' => false, 'message' => 'Новый предмет не подходит по цене или редкости'];
        }

        // Выполняем замену: обновляем информацию о предмете в `Live`
        $currentItem->update([
            'status' => Live::REPLACED
        ]);

        $newLiveItem = Live::create([
            'user_id' => $user->id,
            'case_id' => null, // Сохраняем тот же case_id, если требуется
            'item_id' => $newItem->id,
            'price' => $newItem->price,
            'status' => Live::OPENED,
            'type' => 'replace' // Сохраняем тип предмета, если требуется
        ]);

        $replaceSum = $currentItem->item->price - $newItem->price;

        $user->update([
            'balance' => $user->balance + $replaceSum
        ]);

        return [
            'success' => true,
            'message' => 'Предмет успешно заменён',
            'item' => [
                'id' => $newItem->id,
                'market_hash_name' => $newItem->market_hash_name,
                'price' => $newItem->price,
                'icon_url' => $newItem->icon_url,
                'rarity' => $newItem->rarity
            ]
        ];
    }


    public function tradeLinkSave(Request $request): array
    {
        $link = $request->link;

        if (strlen($link) > 255) {
            return [
                'success' => false,
                'message' => 'Слишком длинная ссылка'
            ];
        }

        if (!$this->parseSteamTradeUrl($link)) {
            return [
                'success' => false,
                'message' => 'Ссылка указана неверно!'
            ];
        }

        if (!$this->_parseTradeLink($link)) {
            return [
                'success' => false,
                'message' => 'Ссылка указана неверно!'
            ];
        }

        $request->user()->update([
            'trade_link' => $link
        ]);

        return [
            'success' => true,
            'message' => 'Трейд ссылка сохранена'
        ];
    }

    public function sellItems(Request $request): array
    {
        $ids = $request->input('ids', []); // Используем метод input с значением по умолчанию пустой массив
        $isAll = $request->input('isAll', false); // Добавим значение по умолчанию для isAll

        Log::info('sellItems', ['ids' => $ids, 'isAll' => $isAll]);

        if (!is_array($ids) && !$isAll) {
            return [
                'success' => false,
                'message' => 'Предметов для продажи нет'
            ];
        }

        $text = '';
        $selledItems = [];

        if (!$isAll) {
            if (empty($ids)) {
                return [
                    'success' => false,
                    'message' => 'Предметов для продажи нет'
                ];
            }

            foreach ($ids as $id) {
                $open = Live::query()->where('user_id', $request->user()->id)
                    ->where('status', 0)
                    ->where('id', $id)
                    ->first();

                if (!$open) continue;

                $open->update([
                    'status' => Live::SELL
                ]);

                $selledItems[] = $open->id;

                $request->user()->update([
                    'balance' => $request->user()->balance + $open->price
                ]);

                $text = (count($selledItems) > 0) ? 'Предмет продан' : 'Ничего не было продано, обновите страницу';
            }
        } else {
            $open = Live::query()->where('user_id', $request->user()->id)
                ->where('status', 0)
                ->get();

            foreach ($open as $item) {
                $item->update([
                    'status' => Live::SELL
                ]);

                $selledItems[] = $item->id;

                $request->user()->update([
                    'balance' => $request->user()->balance + $item->price
                ]);

                $text = (count($selledItems) > 0) ? 'Предметы проданы' : 'Ничего не было продано, обновите страницу';
            }
        }

        $redisService = new RedisService();
        $redisService->event('updateBalance', [
            'balance' => $request->user()->balance
        ]);
        Redis::publish('updateUser', json_encode([
            'user_id' => $request->user()->id,
            'balance' => $request->user()->balance,
        ]));
        return [
            'success' => true,
            'message' => $text
        ];
    }

    public function sellItemsCase(Request $request): array
    {
        $ids = $request->input('ids', []); // Получаем массив ID предметов
        if (empty($ids)) {
            return [
                'success' => false,
                'message' => 'Предметов для продажи нет'
            ];
        }

        Log::info('sellItems', ['ids' => $ids]);

        $selledItems = [];

        // Получаем предметы пользователя с переданными ID
        $items = Live::query()
            ->where('user_id', $request->user()->id)
            ->whereIn('id', $ids)
            ->where('status', 0)
            ->get();

        if ($items->isEmpty()) {
            return [
                'success' => false,
                'message' => 'Предметы не найдены или уже проданы'
            ];
        }

        $totalPrice = $items->sum('price');

        // Обновляем статус предметов и баланс пользователя
        Live::whereIn('id', $items->pluck('id'))->update(['status' => Live::SELL]);
        $request->user()->increment('balance', $totalPrice);

        $selledItems = $items->pluck('id')->toArray();
        $text = count($selledItems) > 0 ? 'Предметы проданы' : 'Ничего не было продано, обновите страницу';

        // Отправляем обновлённый баланс через Redis
        $redisService = new RedisService();
        $redisService->event('updateBalance', [
            'balance' => $request->user()->balance
        ]);
        Redis::publish('updateUser', json_encode([
            'user_id' => $request->user()->id,
            'balance' => $request->user()->balance,
        ]));

        return [
            'success' => true,
            'message' => $text
        ];
    }


    public function sell(Request $r)
    {
        $user = User::query()->find(\auth()->id());
        if (Auth::guest()) {
            return ["type" => "error", "message" => "Авторизуйтесь!"];
        }
        $ids = $r->ids;
        if (!is_array($r->id)) {
            $ids = [$r->id];
        }

        foreach ($ids as $id) {
            $open = Live::with(["item"])
                ->where("user_id", $user->id)
                ->where("status", 0)
                ->where("id", $id)
                ->first();
            if (!$open) {
                continue;
            }
            $open->update(["status" => Live::SELL]);
            $user->update([
                "balance" => $user->balance + $open->item->price,
            ]);

            $newBalance = $user->balance + $open->item->price;

            Logs::create([
                'created_at' => now(), // Дата и время действия
                'user_id' => $user->id,
                'action' => "Пользователь <a href='/admin/user/{$user->id}' class='user-link'>{$user->username}</a> продал предмет <div class='item-link'>{$open->item->market_hash_name}</div> за {$open->item->price}$",

                'impact' => "Баланс пользователя: {$user->balance} -> {$newBalance}" // Влияние
            ]);
            Redis::publish('updateUser', json_encode([
                'user_id' => $user->id,
                'balance' => $user->balance,
            ]));
            return [
                "type" => "success",
                "message" =>
                "Вы успешно продали " .
                    $open->item->market_hash_name .
                    " за " .
                    $open->item->price .
                    " ",
            ];
        }
        return ["type" => "error", "message" => "Упс! Что-то пошло не так"];
    }

    public function depositStats(Request $request)
    {
        $userId = Auth::id();
        $today = Carbon::now()->format('j');
        $totalDeposits = Payment::where('user_id', $userId)
            ->whereDate('created_at', Carbon::today())
            ->where('status', 1)
            ->sum('sum');

        return [
            'success' => true,
            'totalDeposits' => $totalDeposits,
        ];
    }

    public function logout()
    {
        Auth::logout();
    }

    private function _parseTradeLink($tradeLink)
    {
        $query_str = parse_url($tradeLink, PHP_URL_QUERY);
        parse_str($query_str, $query_params);
        return isset($query_params['token']) ? $query_params['token'] : false;
    }

    private function parseSteamTradeUrl($tradeLink): bool
    {
        return str_contains($tradeLink, 'https://steamcommunity.com/tradeoffer/new/');
    }

    private function _parsePartner($tradeLink)
    {
        $query_str = parse_url($tradeLink, PHP_URL_QUERY);
        parse_str($query_str, $query_params);
        return isset($query_params['partner']) ? $query_params['partner'] : false;
    }
}
