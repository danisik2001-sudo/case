<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Live;
use App\Models\Upgrade;
use App\Services\RedisService;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Models\Logs;
use App\Models\Setting;

class UpgradeController extends Controller
{
    protected $redis;
    public function __construct()
    {
        $this->redis = new RedisService();
    }
    public function loadItems(Request $request): array
    {
        $perPage = 12; // Количество элементов на странице
        $page = $request->input('page', 1);

        $live = $request->user()
            ? Live::query()
            ->with('item:id,market_hash_name,icon_url,rarity,exterior')
            ->where('user_id', $request->user()->id)
            ->whereIn('status', [0, 12])
            ->orderBy('price')
            ->paginate($perPage, ['*'], 'page', $page)
            : [];

        $items = [];
        foreach ($live as $item) {
            $items[] = [
                'id' => $item->id,
                'item' => [
                    'id' => $item->item->id,
                    'market_hash_name' => $item->item->market_hash_name,
                    'rarity' => $item->item->rarity,
                    'icon_url' => $item->item->icon_url,
                    'exterior' => $item->item->exterior,
                ],
                'price' => $item->price,
                'selected' => false,
                'isHovering' => false,
            ];
        }

        return [
            'userItems' => $items,
            'pagination' => [
                'current_page' => $live->currentPage(),
                'last_page' => $live->lastPage(),
            ],
        ];
    }



    public function loadSiteItems(Request $request): array
    {
        $query = Item::query();

        if ($request->filled('name')) {
            $query->where('market_hash_name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->filled('price')) {
            $query->where('price', '>=', $request->price);
        }

        if ($request->filled('rarity')) {
            $query->where('rarity', $request->rarity);
        }

        $query->whereNotIn('rarity', Item::getExcludedRarities());

        $siteItemsCollection = $query
            ->select('id', 'icon_url', 'market_hash_name', 'price', 'rarity', 'exterior')
            ->orderBy('price')
            ->paginate(12);

        return [
            'siteItems' => $siteItemsCollection
        ];
    }




    public function create(Request $request): array
    {
        $userItemId = $request->userItem;
        $siteItemId = $request->siteItem;
        $gameChance = $request->gameChance;
        $plusBalance = $request->plusBalance;

        $userItem = null;
        if (!is_null($userItemId)) {
            $userItem = Live::query()->whereIn('status', [0, 12])->where('id', $userItemId)->first();
        }

        if (!$userItemId && $plusBalance === 0) {
            return [
                'success' => false,
                'message' => 'Нечем ставить'
            ];
        }

        $siteItem = Item::query()->find($siteItemId);

        if (!$siteItem) {
            return [
                'success' => false,
                'message' => 'Предметы устарели, обновите страницу'
            ];
        }

        if ($plusBalance > $request->user()->balance) {
            return [
                'success' => false,
                'message' => 'Недостаточно средств'
            ];
        }

        $totalPrice = $userItem ? $userItem->price + $plusBalance : $plusBalance;

        if ($totalPrice < 10) {
            return [
                'success' => false,
                'message' => 'Минимальная сумма апгрейда 10₽'
            ];
        }

        if ($totalPrice > $siteItem->price) {
            return [
                'success' => false,
                'message' => 'Сумма апгрейда не может быть больше получаемого предмета'
            ];
        }

        $priceRatio = $siteItem->price / $totalPrice;

        if ($priceRatio <= 1.25) {
            if ($siteItem->price >= 20 && $siteItem->price <= 1000) {
                $chance = 500;
            } elseif ($siteItem->price >= 1001 && $siteItem->price <= 5000) {
                $chance = 400;
            } elseif ($siteItem->price >= 5001 && $siteItem->price <= 10000) {
                $chance = 300;
            } elseif ($siteItem->price >= 10001 && $siteItem->price <= 20000) {
                $chance = 200;
            } elseif ($siteItem->price >= 20001 && $siteItem->price <= 50000) {
                $chance = 100;
            } elseif ($siteItem->price >= 50001 && $siteItem->price <= 250000) {
                $chance = 50;
            } else {
                $chance = 45;
            }
        } elseif ($priceRatio <= 1.55) {
            if ($siteItem->price >= 20 && $siteItem->price <= 1000) {
                $chance = 450;
            } elseif ($siteItem->price >= 1001 && $siteItem->price <= 5000) {
                $chance = 400;
            } elseif ($siteItem->price >= 5001 && $siteItem->price <= 10000) {
                $chance = 300;
            } elseif ($siteItem->price >= 10001 && $siteItem->price <= 20000) {
                $chance = 200;
            } elseif ($siteItem->price >= 20001 && $siteItem->price <= 50000) {
                $chance = 100;
            } elseif ($siteItem->price >= 50001 && $siteItem->price <= 250000) {
                $chance = 50;
            } else {
                $chance = 40;
            }
        } elseif ($priceRatio <= 2.05) {
            if ($siteItem->price >= 20 && $siteItem->price <= 1000) {
                $chance = 300;
            } elseif ($siteItem->price >= 1001 && $siteItem->price <= 5000) {
                $chance = 200;
            } elseif ($siteItem->price >= 5001 && $siteItem->price <= 10000) {
                $chance = 150;
            } elseif ($siteItem->price >= 10001 && $siteItem->price <= 20000) {
                $chance = 100;
            } elseif ($siteItem->price >= 20001 && $siteItem->price <= 50000) {
                $chance = 50;
            } elseif ($siteItem->price >= 50001 && $siteItem->price <= 250000) {
                $chance = 30;
            } else {
                $chance = 25;
            }
        } elseif ($priceRatio <= 5.5) {
            if ($siteItem->price >= 20 && $siteItem->price <= 10000) {
                $chance = 70;
            } elseif ($siteItem->price >= 1001 && $siteItem->price <= 10000) {
                $chance = 50;
            } elseif ($siteItem->price >= 10001 && $siteItem->price <= 50000) {
                $chance = 30;
            } elseif ($siteItem->price >= 50001 && $siteItem->price <= 250000) {
                $chance = 20;
            } else {
                $chance = 10;
            }
        } elseif ($priceRatio <= 10.5) {
            if ($siteItem->price >= 20 && $siteItem->price <= 1000) {
                $chance = 50;
            } elseif ($siteItem->price >= 1001 && $siteItem->price <= 10000) {
                $chance = 30;
            } elseif ($siteItem->price >= 10001 && $siteItem->price <= 50000) {
                $chance = 10;
            } elseif ($siteItem->price >= 50001 && $siteItem->price <= 250000) {
                $chance = 5;
            } else {
                $chance = 1;
            }
        } elseif ($priceRatio <= 15.5) {
            if ($siteItem->price >= 20 && $siteItem->price <= 1000) {
                $chance = 5;
            } elseif ($siteItem->price >= 1001 && $siteItem->price <= 10000) {
                $chance = 4;
            } elseif ($siteItem->price >= 10001 && $siteItem->price <= 50000) {
                $chance = 3;
            } elseif ($siteItem->price >= 50001 && $siteItem->price <= 250000) {
                $chance = 2;
            } else {
                $chance = 1;
            }
        } else {
            $chance = 0;
        }


        $randomInteger = mt_rand(1, 1000);
        $winItem = null;

        Logs::create([
            'created_at' => now(),
            'user_id' => $request->user()->id,
            'action' => "Пользователь {$request->user()->username} использовал предметы для апгрейда. 
                 Предмет пользователя: " . ($userItem->item->market_hash_name ?? 'использовал баланс') . ", 
                 сайтовский предмет: " . ($siteItem->market_hash_name ?? 'использовал баланс') . ".",
            'impact' => "Предметы добавлены в апгрейд"
        ]);


        // Условие выигрыша проверяется только если текущий профит сайта достаточен
        if ($chance >= $randomInteger) {
            $winItem = $siteItem;

            $liveItem = Live::query()->create([
                'user_id' => $request->user()->id,
                'item_id' => $winItem->id,
                'price' => $winItem->price,
                'type' => 'upgrade'
            ]);

            Upgrade::query()->create([
                'user_id' => $request->user()->id,
                'item_id' => $userItem ? $userItem->item->id : null,
                'win_id' => $siteItem->id,
                'price' => $totalPrice,
                'price_win' => $siteItem->price,
                'profit' => ($totalPrice - $siteItem->price),
                'percent' => $gameChance,
                'status' => Upgrade::WIN
            ]);

            Logs::create([
                'created_at' => now(),
                'user_id' => $request->user()->id,
                'action' => "Пользователь <a href='/admin/user/{$request->user()->id}' class='user-link'>{$request->user()->username}</a> получил предмет <div class='item-link'>{$winItem->market_hash_name}</div> за {$winItem->price}$ - успешный апгрейд",
                'impact' => "Предмет добавлен в инвентарь пользователя"
            ]);


            Redis::publish('live', json_encode([
                'type' => 'default',
                'item' => [
                    'all' => [
                        Live::query()
                            ->with(['user:id,username,avatar,steamid', 'item:id,market_hash_name,rarity,icon_url', 'case:id,name,url,image'])
                            ->select('id', 'user_id', 'item_id', 'case_id', 'price', 'type')
                            ->find($liveItem->id)
                            ->toArray()
                    ],
                ],
            ]));
        } else {
            // В случае проигрыша
            Upgrade::query()->create([
                'user_id' => $request->user()->id,
                'item_id' => $userItem ? $userItem->item->id : null,
                'win_id' => $siteItem->id,
                'price' => $totalPrice,
                'price_win' => $siteItem->price,
                'profit' => ($siteItem->price - $totalPrice),
                'percent' => $gameChance,
                'status' => Upgrade::LOSE
            ]);

            // Logs::create([
            //     'created_at' => now(),
            //     'user_id' => $request->user()->id,
            //     'action' => "Пользователь <a href='/admin/user/{$request->user()->id}' class='user-link'>{$request->user()->username}</a> проиграл. 
            //      Предмет пользователя: <div class='item-link'>" . ($userItem->item->market_hash_name ?? 'использовал баланс') . "</div>, 
            //      сайтовский предмет: " . ($siteItem->market_hash_name ?? 'использовал баланс') . ".",
            //     'impact' => "Пользователь потерял предметы"
            // ]);
        }

        // Обновляем баланс пользователя
        $request->user()->update([
            'balance' => $request->user()->balance - $plusBalance
        ]);

        // Обновляем статус предмета пользователя
        if ($userItem) {
            $userItem->update([
                'status' => Live::UPGRADE
            ]);
        }

        // Публикуем обновления в Redis
        Redis::publish('updateUser', json_encode([
            'user_id' => $request->user()->id,
            'balance' => $request->user()->balance,
        ]));



        Redis::publish('stats', json_encode([
            'live' => (new LiveController)->getLiveStatistic(),
        ]));

        return [
            'success' => true,
            'win' => !is_null($winItem),
            'random' => $randomInteger
        ];
    }
}
