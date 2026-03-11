<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Item;
use App\Models\WheelItems;
use App\Models\WheelLogs;
use App\Models\Live;
use App\Models\Promocodes;

class WheelController extends Controller
{

    function timerToNextDay()
    {
        $currentDateTime = Carbon::now();
        $currentDateTime = $currentDateTime->format('Y-m-d');
        $real = Carbon::now()->diffInRealMilliseconds();
        $add = Carbon::parse($currentDateTime)
            ->addDay()
            ->diffInRealMilliseconds();
        $time = $add - $real;
        return $time;
    }

    public function wheelItems()
    {
        $user = Auth::user();
        // Получаем все элементы колесо
        $items = WheelItems::all();

        // Получаем случайные 7 элементов колесо
        $itemsRullet = WheelItems::inRandomOrder()
            ->limit(12)
            ->get();

        // Статус по умолчанию
        $status = true;
        $time = 0;


        // Проверяем авторизацию пользователя
        if (Auth::check()) {
            // Проверка, есть ли запись в журнале колесо для сегодняшнего дня
            $checkWheelLogs = WheelLogs::where('user_id', $user->id)
                ->whereDate('created_at', today())  // Используем today() для получения даты без времени
                ->first();

            if ($checkWheelLogs) {
                // Если есть запись, устанавливаем статус в false
                $status = false;
            }
        }

        return [
            'success' => true,
            'items' => $items,
            'rullet' => [
                'items' => $itemsRullet,
                'status' => $status,
                'time' => $this->timerToNextDay(),  // Предполагается, что эта функция вычисляет время до следующего дня
            ],
        ];
    }

    public function wheelOpen(Request $r)
    {
        $user = Auth::user();
        $updateBalance = false;

        if (Auth::guest()) {
            return [
                'success' => false,
                'type' => 'error',
                'msg' => 'Авторизуйтесь!',
            ];
        }

        $checkWheelLogs = WheelLogs::where('user_id', $user->id)
            ->where('created_at', '>=', date("Y-m-d 00:00:00"))
            ->first();
        if ($checkWheelLogs) {
            return [
                'success' => false,
                'msg' => 'Колесо удачи можно крутить раз в 24 часа!',
                'type' => 'error',
                'status' => 1,
                'time' => $this->timerToNextDay(),
            ];
        }

        $winItem = $this->winItem($user);  // Получаем выигранный предмет
        if (is_null($winItem)) {
            return ['success' => false, 'message' => 'Попробуйте еще раз'];
        }

        // Если выигранный предмет уже есть в рулетке, просто исключаем его из случайного выбора
        $itemsRullet = WheelItems::where('id', '!=', $winItem->id)  // Исключаем выигранный предмет
            ->inRandomOrder()
            ->limit(12)
            ->get();


        if ($winItem->id == 1) {
            // Генерация уникального кода
            $uniqueCode = bin2hex(random_bytes(8));

            Promocodes::create([
                'name' => $uniqueCode,
                'type' => 'percent',
                'percent' => 10,
                'activates' => 1,
                'owner' => null,
                'earnings_percent' => null,
                'total_deposit' => 0.00,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            WheelLogs::create([
                'user_id' => $user->id,
                'item_id' => $winItem->id,
            ]);

            return [
                'success' => true,
                'updateBalance' => $updateBalance,
                'msg' => 'Вы выиграли уникальный промокод!',
                'promo_code' => $uniqueCode,
                'rullet' => ['items' => $itemsRullet],
                'item' => $winItem,
                'time' => $this->timerToNextDay(),
            ];
        }
        if ($winItem->id == 2) {
            // Генерация уникального кода
            $uniqueCode = bin2hex(random_bytes(8));

            Promocodes::create([
                'name' => $uniqueCode,
                'type' => 'percent',
                'percent' => 20,
                'activates' => 1,
                'owner' => null,
                'earnings_percent' => null,
                'total_deposit' => 0.00,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            WheelLogs::create([
                'user_id' => $user->id,
                'item_id' => $winItem->id,
            ]);

            return [
                'success' => true,
                'updateBalance' => $updateBalance,
                'msg' => 'Вы выиграли уникальный промокод!',
                'promo_code' => $uniqueCode,
                'rullet' => ['items' => $itemsRullet],
                'item' => $winItem,
                'time' => $this->timerToNextDay(),
            ];
        }

        if ($winItem->id == 3) {
            $randomSkin = Item::where('price', '<=', 1)
                ->inRandomOrder()
                ->first();

            if ($randomSkin) {
                Live::create([
                    'user_id' => $user->id,
                    'case_id' => null,
                    'item_id' => $randomSkin->id,
                    'price' => $randomSkin->price,
                    'status' => Live::WHEEL_UPGRADE,
                    'type' => 'wheel'
                ]);
            }
        }

        if ($winItem->id == 4) {
            $randomSkin = Item::where('price', '<=', 1)
                ->inRandomOrder()
                ->limit(2)
                ->get();

            if ($randomSkin->count() ==  2) {
                foreach ($randomSkin as $skin) {
                    Live::create([
                        'user_id' => $user->id,
                        'case_id' => null,
                        'item_id' => $skin->id,
                        'price' => $skin->price,
                        'status' => Live::WHEEL_UPGRADE,
                        'type' => 'wheel'
                    ]);
                }
            }
        }

        if ($winItem->id == 5) {
            $randomSkin = Item::where('price', '<=', 1)
                ->inRandomOrder()
                ->limit(2)
                ->get();

            if ($randomSkin->count() ==  2) {
                foreach ($randomSkin as $skin) {
                    Live::create([
                        'user_id' => $user->id,
                        'case_id' => null,
                        'item_id' => $skin->id,
                        'price' => $skin->price,
                        'status' => Live::WHEEL_CONTRACTS,
                        'type' => 'wheel'
                    ]);
                }
            }
        }

        if ($winItem->id == 6) {
            $randomSkin = Item::where('price', '<=', 1)
                ->inRandomOrder()
                ->limit(3)
                ->get();

            if ($randomSkin->count() ==  3) {
                foreach ($randomSkin as $skin) {
                    Live::create([
                        'user_id' => $user->id,
                        'case_id' => null,
                        'item_id' => $skin->id,
                        'price' => $skin->price,
                        'status' => Live::WHEEL_CONTRACTS,
                        'type' => 'wheel'
                    ]);
                }
            }
        }

        if ($winItem->id == 7) {  // Если выигранный предмет имеет id 7, разыгрываем случайный скин
            $randomSkin = Item::where('price', '<=', 10)
                ->inRandomOrder()
                ->first();

            if ($randomSkin) {
                Live::create([
                    'user_id' => $user->id,
                    'case_id' => null,
                    'item_id' => $randomSkin->id,
                    'price' => $randomSkin->price,
                    'status' => 0,
                    'type' => 'wheel'
                ]);
            }
        }

        // Создаем запись в WheelLogs с выигранным предметом
        WheelLogs::create([
            'user_id' => $user->id,
            'item_id' => $winItem->id,
        ]);

        return [
            'success' => true,
            'updateBalance' => $updateBalance,
            'msg' => 'Вы успешно крутанули колесо! Ваш выигрыш ' . $winItem->name,
            'rullet' => ['items' => $itemsRullet],
            'item' => $winItem,
            'time' => $this->timerToNextDay(),
        ];
    }




    public function winItem($user)
    {
        $itemsDataBase = WheelItems::orderBy('chance', 'asc')
            ->inRandomOrder()
            ->get();
        if (count($itemsDataBase) === 0) {
            return null;
        }
        $items = [];
        $i = 0;
        $maxTickets = 0;
        foreach ($itemsDataBase as $item) {
            if ($item->chance === 0) {
                continue;
            }
            if ($i == 0) {
                $from = 1;
            } else {
                $from = $items[$i - 1]['to'] + 1;
            }
            $to = $from + $item->chance;
            $maxTickets = $to;
            $items[$i] = ['item_id' => $item->id, 'from' => $from, 'to' => $to];
            $i++;
        }
        try {
            $winTicket = mt_rand(1, $maxTickets);
        } catch (\Exception $e) {
            return null;
        }
        $winItem = null;
        foreach ($items as $item) {
            if ($item['from'] <= $winTicket && $item['to'] >= $winTicket) {
                $winItem = WheelItems::find($item['item_id']);
                break;
            }
        }
        return $winItem;
    }
}
