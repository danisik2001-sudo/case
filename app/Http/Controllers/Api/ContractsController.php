<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Item;
use App\Models\Live;
use App\Models\Setting;
use App\Models\Logs;
use Illuminate\Support\Facades\Redis;
use App\Services\RedisService;
use Illuminate\Http\Request;

class ContractsController extends Controller
{
    protected $redis;

    public function __construct()
    {
        $this->redis = new RedisService();
    }

    public function userItems(Request $request): array
    {
        if (!$request->user()) return [
            'success' => false
        ];


        $live = Live::query()
            ->select('id', 'item_id', 'user_id', 'price')
            ->with('item:id,market_hash_name,rarity,icon_url,price')
            ->where('user_id', $request->user()->id)
            ->whereIn('status', [0, 13])
            ->orderBy('id', 'desc')
            ->get();

        $items = [];

        foreach ($live as $item) {
            $items[] = [
                'id' => $item->id,
                'item' => [
                    'id' => $item->item->id,
                    'market_hash_name' => $item->item->market_hash_name,
                    'rarity' => $item->item->rarity,
                    'icon_url' => $item->item->icon_url,
                    'price' => $item->item->price,
                ],
                'price' => $item->price,
                'selected' => false,
            ];
        }

        return [
            'success' => true,
            'items' => $items
        ];
    }

    public function create(Request $request): array
    {
        if (!$request->user()) return [
            'success' => false,
            'message' => 'Авторизуйтесь'
        ];

        $ids = $request->items;

        $siteProfit = Setting::where('id', 1)->first();
        $profitPercent = $siteProfit->profit_percent;
        $profitPercent /= 100;

        $currentProfit = $siteProfit->site_profit;
        $currentPureProfit = $siteProfit->pure_profit;
        $purePercent = $siteProfit->pure_percent;


        $price = 0;
        $itemsId = [];
        foreach ($ids as $id) {
            $live = Live::query()->with('item')->whereIn('status', [0, 13])->where('id', $id)->first();
            if (!$live) return ['success' => false, 'message' => 'Одна из вещей устарела, обновите страницу'];
            $price += $live->item->price;
            $itemsId[] = $live->item->id;
        }

        $min = ceil($price / 3.2);
        $max = $price * 4;

        $chance = mt_rand(0, 100);
        if ($currentProfit >= $price && $chance >= 80) {
            $winItem = Item::query()
                ->where('price', '>=', $price)
                ->where('price', '<=', $max)
                ->inRandomOrder()
                ->first();
            $isWin = true;
        } else {
            $winItem = Item::query()
                ->where('price', '>=', $min)
                ->where('price', '<=', $price)
                ->inRandomOrder()
                ->first();
            $isWin = false;
        }

        if (!$winItem) {
            Logs::create([
                'created_at' => now(),
                'user_id' => $request->user()->id,
                'action' => "Ошибка при создании контракта. Предмет для выигрыша не найден.",
                'impact' => "Контракт не создан.",
            ]);
            return ['success' => false, 'message' => 'Ошибка определения выигрыша, попробуйте снова'];
        }

        foreach ($ids as $id) {
            Live::query()->where('id', $id)->update([
                'status' => Live::CONTRACTS,
            ]);
        }

        $gameProfit = $price - $winItem->price;

        if (!$isWin) {
            // Если пользователь проиграл, умножаем прибыль на процент
            $siteProfit->update([
                'site_profit' => $currentProfit + ($gameProfit * $profitPercent),
                'pure_profit' => $currentPureProfit + ($gameProfit * $purePercent)
            ]);
        } else {
            // Если пользователь выиграл, добавляем только прибыль от игры (без процента)
            $siteProfit->update([
                'site_profit' => $currentProfit + $gameProfit
            ]);
        }

        $contract = Live::query()->create([
            'user_id' => $request->user()->id,
            'item_id' => $winItem->id,
            'price' => $winItem->price,
            'status' => Live::OPENED,
            'type' => 'contract'
        ]);

        Contract::query()->create([
            'user_id' => auth()->user()->id,
            'item_id' => $winItem->id,
            'price' => $winItem->price,
            'profit' => $gameProfit,
            'items' => $itemsId
        ]);

        Redis::publish('live', json_encode([
            'type' => 'default',
            'item' => [
                'all' => [
                    Live::query()
                        ->with(['user:id,username,avatar,steamid', 'item:id,market_hash_name,rarity,icon_url', 'case:id,name,url,image'])
                        ->select('id', 'user_id', 'item_id', 'case_id', 'price', 'type')
                        ->find($contract->id)
                        ->toArray()
                ],
            ],
        ]));

        Redis::publish('stats', json_encode([
            'live' => (new LiveController)->getLiveStatistic(),
        ]));

        // Логирование успешного контракта
        Logs::create([
            'created_at' => now(),
            'user_id' => $request->user()->id,
            'action' => "Пользователь <a href='/admin/user/{$request->user()->id}' class='user-link'>{$request->user()->username}</a> Использовано предметов: " . count($itemsId) . " на сумму {$price}$. Выигран предмет: <div class='item-link'>{$winItem->market_hash_name}</div> стоимостью {$winItem->price}$. Прибыль системы: {$gameProfit}$.",
            'impact' => "Предмет добавлен в инвентарь пользователя",
        ]);

        return [
            'success' => true,
            'winItem' => [
                'id' => $contract->id,
                'market_hash_name' => $contract->item->market_hash_name,
                'icon_url' => $contract->item->icon_url,
                'rarity' => $contract->item->rarity,
                'price' => $contract->price
            ]
        ];
    }
}
