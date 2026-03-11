<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cases;
use App\Models\Item;
use App\Models\Contract;
use App\Models\Live;
use App\Models\Upgrade;
use App\Models\User;
use App\Models\MissionsDone;
use App\Models\Payment;
use App\Models\Logs;

class MissionsController extends Controller
{
    // Метод отображения доступных миссий
    public function index()
    {

        $user = Auth::user();

        if (!$user) {
            return ["type" => "error", "message" => "Авторизуйтесь!"];
        }
        $missions = [
            [
                'id' => 1,
                'title' => 'Начинающий коллекционер',
                'tasks' => [
                    [
                        'description' => 'Открыть 5 кейсов',
                        'done' => Live::where('user_id', $user->id)
                            ->where('type', 'case')
                            ->whereNotNull('case_id')
                            ->count() >= 5,
                    ],
                    [
                        'description' => 'Сделать 5 апгрейдов',
                        'done' => Upgrade::where('user_id', $user->id)
                            ->whereNotNull('win_id')
                            ->count() >= 5,
                    ],
                    [
                        'description' => 'Сделать 5 контрактов',
                        'done' => Contract::where('user_id', $user->id)
                            ->whereNotNull('item_id')
                            ->count() >= 5,
                    ],
                ],
                'prize' => 'https://steamcommunity-a.akamaihd.net/economy/image/-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpot7HxfDhox8zYfjFb09-3mY-0lvygZITdn2xZ_Ish07qSrdz32Qzs_UVoamqgJI6TclRsNVrSqVO2kry-jJW8upnMmyE1pGB8shpgfL76/360fx360f/image.png',
                'completed' => MissionsDone::where('user_id', $user->id)
                    ->where('missions_id', 1)
                    ->exists(),
            ],
            [
                'id' => 2,
                'title' => 'Искатель сокровищ',
                'tasks' => [
                    [
                        'description' => 'Открыть кейс стоимостью более 500₽',
                        'done' => Live::where('user_id', $user->id)
                            ->where('type', 'case')
                            ->whereNotNull('case_id')
                            ->whereHas('case', function ($query) {
                                $query->where('price', '>', 500);
                            })
                            ->count() > 0,

                    ],
                    [
                        'description' => 'Сделать 10 контрактов',
                        'done' => Contract::where('user_id', $user->id)
                            ->count() >= 10,
                    ],
                    [
                        'description' => 'Успешный апгрейд до 30%',
                        'done' => Upgrade::where('user_id', $user->id)
                            ->where('percent', '<=', 30)
                            ->whereNotNull('win_id')
                            ->count() > 0,
                    ],
                ],
                'prize' => 'https://steamcommunity-a.akamaihd.net/economy/image/-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpot621FAZx7PLfYQJW-9W4kb-HnvD8J_XUlzwFuZMgjLjCrIik3wS1_kpvZ2uhLY_AdwRqZlrS8we3k7_vgZa0ot2XntSQs7PA/360fx360f/image.png',
                'completed' => MissionsDone::where('user_id', $user->id)
                    ->where('missions_id', 2)
                    ->exists(),
            ],
            [
                'id' => 3,
                'title' => 'Ставка на удачу',
                'tasks' => [
                    [
                        'description' => '7 успешных апгрейдов с шансом 50% и ниже',
                        'done' => Upgrade::where('user_id', $user->id)
                            ->where('percent', '<=', 50)
                            ->whereNotNull('win_id')
                            ->count() > 7,
                    ],
                    [
                        'description' => 'Открыть 15 кейсов стоимость более 200₽',
                        'done' => Live::where('user_id', $user->id)
                            ->where('type', 'case')
                            ->whereNotNull('case_id')
                            ->whereHas('case', function ($query) {
                                $query->where('price', '>', 200);
                            })
                            ->count() > 15,
                    ],
                    [
                        'description' => 'Депозит  одним платежём от 500₽ за последние 24 часа',
                        'done' => Payment::where('user_id', $user->id)
                            ->where('status', 1)
                            ->where('sum', '>=', 500)
                            ->where('created_at', '>=', now()->subDay())
                            ->count() > 0,  // Если есть хотя бы один успешный депозит за последние 24 часа
                    ],

                ],
                'prize' => 'https://steamcommunity-a.akamaihd.net/economy/image/-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposr-kLAtl7PTbTjlH7du6kb-GkvT8MoTdn2xZ_Isk2bmXot_33AK3rkpoZj_xJYKRJlRraAyF-Va-l7jr05TpvM_PzyQypGB8slsMoZQy/360fx360f/image.png',
                'completed' => MissionsDone::where('user_id', $user->id)
                    ->where('missions_id', 3)
                    ->exists(),
            ],
            [
                'id' => 4,
                'title' => 'Мастер контрактов',
                'tasks' => [
                    [
                        'description' => 'Открыть 10 000 кейсов',
                        'done' => Live::where('user_id', $user->id)
                            ->where('type', 'case')
                            ->whereNotNull('case_id')
                            ->count() >= 10000,
                    ],
                    [
                        'description' => 'Сделать 500 успешных апгрейдов',
                        'done' => Upgrade::where('user_id', $user->id)
                            ->whereNotNull('win_id')
                            ->count() >= 500,
                    ],
                    [
                        'description' => 'Сделать 500 контрактов',
                        'done' => Contract::where('user_id', $user->id)
                            ->whereNotNull('item_id')
                            ->count() >= 500,
                        'mixMode' => 'lighten'
                    ],

                ],
                'prize' => '/assets/missions/random-knife.png',
            ],
        ];

        return [
            'missions' => $missions
        ];
    }

    // Метод завершения миссии
    public function complete(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Вы не авторизованы.',
            ];
        }


        $missionId = $request->input('missionId');

        $missionAlreadyDone = MissionsDone::where('user_id', $user->id)
            ->where('missions_id', $missionId)
            ->exists();

        if ($missionAlreadyDone) {
            return response()->json([
                'success' => false,
                'message' => 'Вы уже выполнили данную миссию.',
            ]);
        }

        if ($missionId == 1) {
            $tasksCompleted = 0;

            $casesOpened = Live::where('user_id', $user->id)
                ->where('type', 'case')
                ->whereNotNull('case_id')
                ->count();

            if ($casesOpened >= 5) {
                $tasksCompleted++;
            }

            $upgradesDone = Upgrade::where('user_id', $user->id)
                ->whereNotNull('win_id')
                ->count();

            if ($upgradesDone >= 5) {
                $tasksCompleted++;
            }

            $contractsDone = Contract::where('user_id', $user->id)
                ->whereNotNull('item_id')
                ->count();

            if ($contractsDone >= 5) {
                $tasksCompleted++;
            }

            $itemDrop = Item::where('id', 22302)->first();


            if ($itemDrop) {

                $tasksCompleted++;
            }

            if ($tasksCompleted == 4) {

                MissionsDone::query()->create([
                    'user_id' => $request->user()->id,
                    'missions_id' => $missionId,
                    'prize' => $itemDrop->id,
                ]);

                Live::query()->create([
                    'user_id' => $request->user()->id,
                    'item_id' => $itemDrop ? $itemDrop->id : '1', // Используем ID найденного предмета или заглушку
                    'price' => $itemDrop ? $itemDrop->price : '123', // Если предмет найден, используем его цену
                    'type' => 'missions'
                ]);

                Logs::create([
                    'created_at' => now(), // Дата и время действия
                    'user_id' => $user->id,
                    'action' => "Пользователь <a href='/admin/user/{$user->id}' class='user-link'>{$user->username}</a> получил предмет <div class='item-link'>{$itemDrop->market_hash_name}</div> за {$itemDrop->price}$ за выполнение миссии 'Начинающий коллекционер'",

                    'impact' => "Предмет добавлен в инвентарь пользователя" // Влияние
                ]);


                return [
                    'success' => true,
                    'message' => 'Миссия выполнена, награда начислена!',
                    'done' => true,
                ];
            }

            return [
                'success' => false,
                'message' => 'Не удалось забрать приз. Задачи не выполнены.',
                'done' => false,
            ];
        }

        if ($missionId == 2) {
            $tasksCompleted = 0;

            $casesOpened = Live::where('user_id', $user->id)
                ->where('type', 'case')
                ->whereNotNull('case_id')
                ->whereHas('case', function ($query) {
                    $query->where('price', '>', 500);
                })
                ->count() > 0;

            if ($casesOpened > 0) {
                $tasksCompleted++;
            }

            $contractsDone = Contract::where('user_id', $user->id)
                ->count() >= 10;

            if ($contractsDone >= 10) {
                $tasksCompleted++;
            }

            $upgradesDone = Upgrade::where('user_id', $user->id)
                ->where('percent', '<=', 30)
                ->whereNotNull('win_id')
                ->count() > 0;

            if ($upgradesDone > 0) {
                $tasksCompleted++;
            }

            $itemDrop = Item::where('id', 238)->first();


            if ($itemDrop) {

                $tasksCompleted++;
            }

            if ($tasksCompleted == 4) {

                MissionsDone::query()->create([
                    'user_id' => $request->user()->id,
                    'missions_id' => $missionId,
                    'prize' => $itemDrop->id,
                ]);

                Live::query()->create([
                    'user_id' => $request->user()->id,
                    'item_id' => $itemDrop ? $itemDrop->id : '1', // Используем ID найденного предмета или заглушку
                    'price' => $itemDrop ? $itemDrop->price : '123', // Если предмет найден, используем его цену
                    'type' => 'missions'
                ]);

                Logs::create([
                    'created_at' => now(), // Дата и время действия
                    'user_id' => $user->id,
                    'action' => "Пользователь <a href='/admin/user/{$user->id}' class='user-link'>{$user->username}</a> получил предмет <div class='item-link'>{$itemDrop->market_hash_name}</div> за {$itemDrop->price}$ за выполнение миссии 'Искатель сокровищ'",

                    'impact' => "Предмет добавлен в инвентарь пользователя" // Влияние
                ]);

                return [
                    'success' => true,
                    'message' => 'Миссия "Искатель сокровищ" выполнена, награда начислена!',
                    'done' => true,
                ];
            }

            return [
                'success' => false,
                'message' => 'Не удалось забрать приз. Задачи не выполнены.',
                'done' => false,
            ];
        }

        if ($missionId == 3) {
            $tasksCompleted = 0;

            $casesOpened =  Live::where('user_id', $user->id)
                ->where('type', 'case')
                ->whereNotNull('case_id')
                ->whereHas('case', function ($query) {
                    $query->where('price', '>', 199);
                })
                ->count() > 15;

            if ($casesOpened >= 15) {
                $tasksCompleted++;
            }

            $PaymentDone =  Payment::where('user_id', $user->id)
                ->where('status', 1)
                ->where('sum', '>=', 500)
                ->where('created_at', '>=', now()->subDay())
                ->count() > 0;

            if ($PaymentDone > 0) {
                $tasksCompleted++;
            }

            $upgradesDone = Upgrade::where('user_id', $user->id)
                ->where('percent', '<=', 50)
                ->whereNotNull('win_id')
                ->count() > 7;

            if ($upgradesDone >= 7) {
                $tasksCompleted++;
            }

            $itemDrop = Item::where('id', 140)->first();


            if ($itemDrop) {

                $tasksCompleted++;
            }

            if ($tasksCompleted == 4) {

                MissionsDone::query()->create([
                    'user_id' => $request->user()->id,
                    'missions_id' => $missionId,
                    'prize' => $itemDrop->id,
                ]);

                Live::query()->create([
                    'user_id' => $request->user()->id,
                    'item_id' => $itemDrop ? $itemDrop->id : '1', // Используем ID найденного предмета или заглушку
                    'price' => $itemDrop ? $itemDrop->price : '123', // Если предмет найден, используем его цену
                    'type' => 'missions'
                ]);

                Logs::create([
                    'created_at' => now(), // Дата и время действия
                    'user_id' => $user->id,
                    'action' => "Пользователь <a href='/admin/user/{$user->id}' class='user-link'>{$user->username}</a> получил предмет <div class='item-link'>{$itemDrop->market_hash_name}</div> за {$itemDrop->price}$ за выполнение миссии 'Ставка на удачу'",

                    'impact' => "Предмет добавлен в инвентарь пользователя" // Влияние
                ]);


                return [
                    'success' => true,
                    'message' => 'Миссия "Ставка на удачу" выполнена, награда начислена!',
                    'done' => true,
                ];
            }

            return [
                'success' => false,
                'message' => 'Не удалось забрать приз. Задачи не выполнены.',
                'done' => false,
            ];
        }

        if ($missionId == 4) {
            $tasksCompleted = 0;

            $casesOpened = Live::where('user_id', $user->id)
                ->where('type', 'case')
                ->whereNotNull('case_id')
                ->count();

            if ($casesOpened >= 10000) {
                $tasksCompleted++;
            }

            $upgradesDone = Upgrade::where('user_id', $user->id)
                ->whereNotNull('win_id')
                ->count();

            if ($upgradesDone >= 500) {
                $tasksCompleted++;
            }

            $contractsDone = Contract::where('user_id', $user->id)
                ->whereNotNull('item_id')
                ->count();

            if ($contractsDone >= 500) {
                $tasksCompleted++;
            }

            $randomItem = Item::where('market_hash_name', 'like', '%★%')
                ->where('market_hash_name', 'not like', '%gloves%')
                ->where('price', '<=', 20000)
                ->inRandomOrder()
                ->first();

            if ($randomItem) {

                $tasksCompleted++;
            }

            if ($tasksCompleted == 4) {
                MissionsDone::query()->create([
                    'user_id' => $request->user()->id,
                    'missions_id' => $missionId,
                    'prize' => $randomItem->id,
                ]);

                Live::query()->create([
                    'user_id' => $request->user()->id,
                    'item_id' => $randomItem ? $randomItem->id : '1', // Используем ID найденного предмета или заглушку
                    'price' => $randomItem ? $randomItem->price : '123', // Если предмет найден, используем его цену
                    'type' => 'missions'
                ]);

                Logs::create([
                    'created_at' => now(), // Дата и время действия
                    'user_id' => $user->id,
                    'action' => "Пользователь <a href='/admin/user/{$user->id}' class='user-link'>{$user->username}</a> получил предмет <div class='item-link'>{$randomItem->market_hash_name}</div> за {$randomItem->price}$ за выполнение миссии 'Мастер контрактов'",

                    'impact' => "Предмет добавлен в инвентарь пользователя" // Влияние
                ]);

                return [
                    'success' => true,
                    'message' => 'Миссия "Мастер контрактов" выполнена, награда начислена!',
                    'done' => true,
                ];
            }

            return [
                'success' => false,
                'message' => 'Не удалось забрать приз. Задачи не выполнены.',
                'done' => false,
            ];
        }


        return response()->json([
            'success' => false,
            'message' => 'Миссия не найдена.',
        ]);
    }
}
