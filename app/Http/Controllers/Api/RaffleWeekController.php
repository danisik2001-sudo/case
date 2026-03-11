<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BattleSwitchLog;
use App\Models\Payment;
use App\Models\Promocodes;
use App\Models\User;
use App\Models\RaffleWeekItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\Raffle;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use App\Models\Live;
use App\Models\Item;
use App\Models\Setting;

class RaffleWeekController extends Controller
{

    protected $redis;

    public function __construct()
    {
        $this->redis = Redis::connection(); // Устанавливаем соединение с Redis
    }
    function parseData($n)
    {
        $date = Carbon::parse($n);
        $date = $date->format('Y-m-d H:i:s');
        $real = Carbon::now()->diffInRealMilliseconds();
        $add = Carbon::parse($date)
            ->addHours(168)
            ->diffInRealMilliseconds();
        $date = $add - $real;
        return $date;
    }

    public function getRaffle(Request $request)
    {
        $user = Auth::user();
        $limitUsersInRaffle = 15000;
        $userStatus = false;
        $userPlace = '';
        $settings = Setting::query()->first();
        $minDep = $settings->raffle_dep_week;

        // Получаем текущий розыгрыш с типом 'week'
        $RaffleActual = Raffle::getActualWeekRaffle(); // Исправили вызов метода

        $getRedisUsers = empty($this->redis->lrange('week:' . $RaffleActual->id . ':users', 0, -1))
            ? false
            : $this->redis->lrange(
                'week:' . $RaffleActual->id . ':users',
                0,
                -1
            );

        $usersInRaffle = [];
        if ($getRedisUsers != false) {
            foreach ($getRedisUsers as $user) {
                $usersInRaffle[] = json_decode($user)[0];
            }
        }
        $usersInRaffle = array_slice(
            array_reverse($usersInRaffle),
            0,
            $limitUsersInRaffle
        );

        if (!Auth::guest()) {
            $place = 0;
            foreach ($this->redis->lrange('week:' . $RaffleActual->id . ':users', 0, -1) as $i) {
                $place++;
                $decodedUser = json_decode($i);


                if (is_array($decodedUser) && isset($decodedUser[0]) && isset($decodedUser[0]->stdClass->user->id)) {
                    if ($decodedUser[0]->stdClass->user->id == $user->id) {
                        $userStatus = true;
                        $userPlace = $place;
                        break;
                    }
                }
            }
        }

        // Получаем информацию о предмете для текущего розыгрыша
        $itemInfo = Raffle::getItemInfo($RaffleActual->item_id);

        // Получаем последний розыгрыш с типом 'week'
        $RaffleLast = Raffle::where('status', 1)->where('type', 'week')->orderBy('id', 'desc')->first();

        if ($RaffleLast) {
            $winners = Raffle::where('status', 1)->where('type', 'week')->orderBy('id', 'desc')->take(15)->get()
                ->map(function ($raffle) {
                    $user = User::select('id', 'username', 'avatar')
                        ->where('id', $raffle->win_user_id)
                        ->first();
                    return [
                        'user' => $user,
                        'place' => $raffle->win_place,
                        'itemInfo' => Raffle::getItemInfo($raffle->item_id),
                        'created_at' => $raffle->created_at,
                    ];
                });

            $itemInfoLastRaffle = Raffle::getItemInfo($RaffleLast->item_id);
        } else {
            $winners = [];
            $itemInfoLastRaffle = null;
        }

        return [
            'success' => true,
            'info' => [
                'status' => $userStatus,
                'place' => $userPlace,
            ],
            'raffle' => [
                'current' => [
                    'itemInfo' => $itemInfo,
                    'time' => $this->parseData($RaffleActual->created_at),
                    'users' => $usersInRaffle,
                    'limit' => $limitUsersInRaffle,
                    'minDep' =>
                    $minDep,
                ],
                'last' => [
                    'winners' => $winners,
                ],
            ],
        ];
    }


    public function RaffleOpen()
    {

        $user = Auth::user();
        if (Auth::guest()) {
            return [
                'success' => false,
                'type' => 'error',
                'msg' => 'Авторизуйтесь!',
            ];
        }

        $settings = Setting::query()->first();
        $minDep = $settings->raffle_dep_week;

        $sum = Payment::where('user_id', $user->id)
            ->where('status', 1)
            ->where('created_at', '>=', Carbon::now()->subDay()) // Фильтр по времени в МСК, последние 24 часа
            ->sum('sum');

        if (
            $sum < $minDep
        ) {
            return [
                'success' => false,
                'type' => 'error',
                'msg' =>
                'Для участия в розыгрыше вы должны пополнить баланс минимум на ' .
                    $minDep .
                    ' за последние 24 часа!',
                'sum' => $sum,
            ];
        }
        $game = Raffle::getActualWeekRaffle();
        $place = 1;
        foreach (
            $this->redis->lrange('week:' . $game->id . ':users', 0, -1)
            as $i
        ) {
            $place++;
            if (json_decode($i)[0]->user_id == $user->id) {
                return [
                    'success' => false,
                    'type' => 'error',
                    'msg' => 'Вы уже участвуете!',
                ];
            }
        }
        $drops = [];
        $drops[] = [
            'place' => $place,
            'user_id' => $user->id,
            'user' => User::where('id', $user->id)
                ->select('id', 'username', 'avatar')
                ->first(),
        ];
        $this->redis->rpush(
            'week:' . $game->id . ':users',
            json_encode($drops)
        );
        $game->update(['places' => $game->places + 1]);
        $this->redis->publish(
            'liveUsersInraffle',
            json_encode(['item' => $drops[0]])
        );
        return ['success' => true, 'place' => $place];
    }


    public function RaffleNew(Request $r)
    {
        $RaffleActual = Raffle::getActualweekRaffle();
        if (date("Y-m-d H:i:s", strtotime('-' . 168 . 'hours')) < $RaffleActual->created_at) {
            return response()->json([
                'success' => false,
                'message' => 'Raffle week cannot be completed yet',
            ], 400);
        }
        $user = $this->redis->lrange(
            'week:' . $RaffleActual->id . ':users',
            0,
            -1
        );
        $usersInRaffle = [];
        if ($user != false) {
            foreach ($user as $u) {
                $usersInRaffle[] = json_decode($u)[0];
            }
        }
        if (count($user) > 0) {
            $s = json_decode($user[mt_rand(0, count($user) - 1)]);
            $RaffleActual->update([
                'status' => 1,
                'win_user_id' => $s[0]->user_id,
                'win_place' => $s[0]->place,
            ]);
            $create = Raffle::create([
                'item_id' => RaffleWeekItems::inRandomOrder()->first()->item_id,
                'created_at' => now()->startOfWeek()->addHours(0),
                'places' => 1,
                'type' => 'week',
            ]);
            $open = Live::create([
                'user_id' => $s[0]->user_id,
                'item_id' => $RaffleActual->item_id,
                'price' => Item::where(
                    'id',
                    $RaffleActual->item_id
                )->first()->price,
                'status' => 0,
                'type' => 'raffle',
            ]);
            $this->redis->del('week:' . $RaffleActual->id . ':users');
            $findOpen = Live::with(['item', 'user'])
                ->where('id', $open->id)
                ->first();
            $drop = [
                'user' => [
                    'id' => $findOpen->user->id,
                    'username' => $findOpen->user->username,
                ],
                'box' => ['image' => ''],
                'id' => $findOpen->id,
                'item' => [
                    'name' => $findOpen->item->market_hash_name,
                    'name_en' => $findOpen->item->market_hash_name,
                    'image' => $findOpen->item->icon_url,
                    'price' => $findOpen->item->price,
                    'rarity' => $findOpen->item->rarity,
                ],
            ];
            $this->redis->publish('liveDrop', json_encode(['item' => $drop]));
            $this->redis->publish(
                'updateRaffle',
                json_encode([
                    'success' => true,
                    'time' => $this->parseData($create->created_at),
                    'RaffleNew' => [
                        'itemInfo' => ($itemInfo = Raffle::getItemInfo(
                            $create->item_id
                        )),
                    ],
                    'RaffleLast' => [
                        'itemInfo' => ($itemInfo = Raffle::getItemInfo(
                            $RaffleActual->item_id
                        )),
                        'winnerInfo' => [
                            'userInfo' => User::select(
                                'id',
                                'username',
                                'avatar'
                            )
                                ->where('id', $s[0]->user_id)
                                ->first(),
                            'place' => $s[0]->place,
                        ],
                    ],
                ])
            );

            return response()->json([
                'success' => true,
                'message' => 'Raffle completed successfully',
            ]);
        } else {
            $RaffleActual->update([
                'created_at' => now()->startOfWeek()->addHours(0),
            ]);
            return response()->json([
                'success' => false,
                'time' => $this->parseData($RaffleActual->created_at),
                'message' => 'Not enough participants',
            ]);
            // $this->redis->publish(
            //     'updateRaffle',
            //     json_encode([
            //         'success' => false,
            //         'time' => $this->parseData($RaffleActual->created_at),
            //     ])
            // );

        }
    }
}
