<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promocodes;
use App\Models\Item;
use App\Models\Cases;
use App\Models\User;
use App\Models\Calendar;
use App\Models\Live;
use App\Models\Payment;
use App\Models\Logs;
use App\Models\CalendarBonus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CalendarController extends Controller
{
    public function get(Request $request)
    {
        $today = Carbon::now()->format('j');
        $currentMonthDays = Carbon::now()->daysInMonth;
        $userId = Auth::id();

        $totalDeposits = Payment::where('user_id', $userId)
            ->whereDate('created_at', Carbon::today())
            ->where('status', 1)
            ->sum('sum');

        $receivedBonuses = CalendarBonus::where('user_id', $userId)
            ->whereMonth('created_at', Carbon::now()->month)
            ->get(['day', 'bonus_balance', 'case_id', 'item_id', 'promocode_id']);

        $receivedBonusesData = $receivedBonuses->map(function ($bonus) {
            $promocodeName = null;
            if ($bonus->promocode_id) {
                $promocode = Promocodes::find($bonus->promocode_id);
                $promocodeName = $promocode ? $promocode->name : null;
            }
            $caseUrl = null;
            if ($bonus->case_id) {
                $case = Cases::find($bonus->case_id);
                $caseUrl = $case ? $case->url : null;
            }
            return [
                'day' => $bonus->day,
                'type' => $bonus->bonus_balance ? 'bonus_balance' : ($bonus->case_id ? 'free_case' : ($bonus->item_id ? 'free_item' : 'promocode')),
                'bonus_balance' => $bonus->bonus_balance,
                'case_id' => $caseUrl,
                'item_id' => $bonus->item_id,
                'promocode_id' => $promocodeName,
            ];
        });

        if ($totalDeposits > 100) {
            $bonus = Calendar::where('day', $today)->first();

            if ($bonus) {
                $promocodeName = null;
                if ($bonus->promocode_id) {
                    $promocode = Promocodes::find($bonus->promocode_id);
                    $promocodeName = $promocode ? $promocode->name : null;
                }
                $caseUrl = null;
                if ($bonus->case_id) {
                    $case = Cases::find($bonus->case_id);
                    $caseUrl = $case ? $case->url : null;
                }
                return [
                    'has_bonus' => true,
                    'currentDay' => $bonus->day,
                    'type' => $bonus->bonus_balance ? 'bonus_balance' : ($bonus->case_id ? 'free_case' : ($bonus->item_id ? 'free_item' : 'promocode')),
                    'bonus_balance' => $bonus->bonus_balance,
                    'case_id' => $caseUrl,
                    'item_id' => $bonus->item_id,
                    'promocode_id' => $promocodeName,
                    'total_days' => $currentMonthDays,
                    'received_bonuses' => $receivedBonusesData,
                ];
            }
        }

        return [
            'has_bonus' => false,
            'message' => 'Нет бонусов за текущий день.',
            'total_days' => $currentMonthDays,
            'received_bonuses' => $receivedBonusesData,

        ];
    }




    public function claimBonus(Request $request)
    {
        $userId = Auth::id();
        $today = Carbon::now()->format('j');

        $totalDeposits = Payment::where('user_id', $userId)
            ->whereDate('created_at', Carbon::today())
            ->where('status', 1)
            ->sum('sum');

        if ($totalDeposits > 100) {
            $bonus = Calendar::where('day', $today)->first();

            if ($bonus) {
                $user = User::find($userId);
                if ($bonus->bonus_balance) {
                    $calendarBonus = CalendarBonus::create([
                        'user_id' => $userId,
                        'day' => $bonus->day,
                        'bonus_balance' => $bonus->bonus_balance,
                        'case_id' => null,
                        'item_id' => null,
                        'promocode_id' => null,
                    ]);


                    $user->balance += $bonus->bonus_balance;
                    $user->save();

                    Logs::create([
                        'created_at' => now(),
                        'user_id' => $userId,
                        'action' => "Пользователь <a href='/admin/user/{$user->id}' class='user-link'>{$user->username}</a> получил бонус <div class='item-link'>{$bonus->bonus_balance}$</div> за день {$today} в календаре.",
                        'impact' => "Бонус в размере {$bonus->bonus_balance}$ добавлен к балансу пользователя.",
                    ]);

                    return [
                        'message' => 'Бонус успешно начислен. Сумма бонуса: ' . $calendarBonus->bonus_balance . '$.',
                        'bonus' => $calendarBonus,
                    ];
                } elseif ($bonus->case_id) {
                    $case = Cases::find($bonus->case_id);
                    $calendarBonus = CalendarBonus::create([
                        'user_id' => $userId,
                        'day' => $bonus->day,
                        'bonus_balance' => null,
                        'case_id' => $bonus->case_id,
                        'item_id' => null,
                        'promocode_id' => null,
                    ]);
                    \Cache::put(
                        'wheel.' . md5($userId),
                        md5($bonus->case_id),
                        3600
                    );

                    Logs::create([
                        'created_at' => now(),
                        'user_id' => $userId,
                        'action' => "Пользователь <a href='/admin/user/{$user->id}' class='user-link'>{$user->username}</a> получил бонусный кейс <div class='item-link'>{$case->name}</div> за день {$today} в календаре.",
                        'impact' => "Бонусный кейс добавлен в активы пользователя.",
                    ]);

                    return [
                        'message' => 'Ваш бонусный кейс: ' . $case->name,
                        'bonus' => $calendarBonus,
                    ];
                } elseif ($bonus->item_id) {
                    $item = Item::find($bonus->item_id);

                    if ($item) {
                        $calendarBonus = CalendarBonus::create([
                            'user_id' => $userId,
                            'day' => $bonus->day,
                            'bonus_balance' => null,
                            'case_id' => null,
                            'item_id' => $bonus->item_id,
                            'promocode_id' => null,
                        ]);

                        Live::query()->create([
                            'user_id' => $userId,
                            'case_id' => null,
                            'item_id' => $item->id,
                            'price' => $item->price,
                            'status' => Live::OPENED,
                            'type' => 'calendar',
                        ]);

                        Logs::create([
                            'created_at' => now(),
                            'user_id' => $userId,
                            'action' => "Пользователь <a href='/admin/user/{$user->id}' class='user-link'>{$user->username}</a> получил предмет <div class='item-link'>{$item->market_hash_name}</div> стоимостью {$item->price}$ за день {$today} в календаре.",
                            'impact' => "Предмет добавлен в инвентарь пользователя.",
                        ]);

                        return [
                            'message' => 'Бонус успешно начислен. Вы получили предмет: ' . $item->market_hash_name,
                            'bonus' => $calendarBonus,
                        ];
                    }
                } elseif ($bonus->promocode_id) {
                    $calendarBonus = CalendarBonus::create([
                        'user_id' => $userId,
                        'day' => $bonus->day,
                        'bonus_balance' => null,
                        'case_id' => null,
                        'item_id' => null,
                        'promocode_id' => $bonus->promocode_id,
                    ]);

                    Logs::create([
                        'created_at' => now(),
                        'user_id' => $userId,
                        'action' => "Пользователь <a href='/admin/user/{$user->id}' class='user-link'>{$user->username}</a> получил <div class='item-link'>промокод</div> за день {$today} в календаре.",
                        'impact' => "Промокод добавлен пользователю.",
                    ]);

                    return [
                        'message' => 'Вы получили промокод.',
                    ];
                }
            }
        }

        Logs::create([
            'created_at' => now(),
            'user_id' => $userId,
            'action' => "Пользователь {$request->user()->username} попытался получить бонус за день {$today}, но не выполнил условия.",
            'impact' => "Бонус не выдан.",
        ]);

        return ['message' => 'Не удалось начислить бонус.'];
    }
}
