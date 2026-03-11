<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\UserBonus;
use App\Models\SubscriptionBonus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;


class BonusController extends Controller
{

    public function claimBonus(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return ["type" => "error", "message" => "Авторизуйтесь!"];
        }

        // Проверяем наличие минимального депозита
        $lastDeposit = Payment::where('user_id', $user->id)
            ->where('status', 1)
            ->where('sum', '>=', 1)
            ->latest('created_at')
            ->first();

        if (!$lastDeposit) {
            return [
                "type" => "error",
                "message" => "Необходимо сделать минимальный депозит"
            ];
        }

        $currentTime = Carbon::now();
        $timeSinceLastDeposit = Carbon::parse($lastDeposit->created_at)->diffInHours($currentTime);

        // Список бонусов
        $bonusAmounts = [2, 3, 4, 4, 5, 3, 6, 7, 9, 9];

        // Получаем все полученные бонусы пользователя
        $claimedBonuses = UserBonus::where('user_id', $user->id)
            ->whereNotNull('claimed_at')
            ->orderBy('claimed_at')
            ->get();

        $nextBonusDay = $claimedBonuses->count() + 1;

        if ($nextBonusDay > count($bonusAmounts)) {
            return [
                "type" => "error",
                "message" => "Все бонусы за 10 дней получены. Сделайте новый депозит."
            ];
        }

        // Проверяем время с последнего депозита (7 дней = 168 часов)
        if ($timeSinceLastDeposit > 168) {
            UserBonus::where('user_id', $user->id)->delete(); // Сбрасываем бонусы
            return [
                "type" => "error",
                "message" => "С последнего депозита прошло более 7 дней. Сделайте новый депозит для начала нового цикла бонусов."
            ];
        }

        // Проверяем время с последнего бонуса
        if ($claimedBonuses->isNotEmpty()) {
            $lastClaimed = $claimedBonuses->last();
            $timeSinceLastClaim = Carbon::parse($lastClaimed->claimed_at)->diffInHours($currentTime);

            if ($timeSinceLastClaim < 24) {
                return [
                    "type" => "error",
                    "message" => "Прошло менее 24 часов с последнего бонуса. Подождите еще " . (24 - $timeSinceLastClaim) . " ч."
                ];
            } elseif ($timeSinceLastClaim > 48) { // Меняем 24 на 48
                UserBonus::where('user_id', $user->id)->delete(); // Сбрасываем бонусы
                $nextBonusDay = 1; // Начинаем с первого дня
            }
        }

        // Создаем новый бонус
        $bonus = UserBonus::create([
            'user_id' => $user->id,
            'day' => $nextBonusDay,
            'amount' => $bonusAmounts[$nextBonusDay - 1],
            'claimed_at' => $currentTime,
        ]);

        // Обновляем баланс
        $user->update([
            'balance' => $user->balance + $bonus->amount
        ]);

        // Формируем список всех бонусов для ответа
        $bonuses = UserBonus::where('user_id', $user->id)
            ->orderBy('day')
            ->get()
            ->map(function ($bonus) {
                return [
                    'day' => $bonus->day,
                    'amount' => $bonus->amount,
                    'claimed_at' => $bonus->claimed_at,
                ];
            });

        return [
            "type" => "success",
            "message" => $nextBonusDay === 1 ? "Прогресс сброшен. Бонус за первый день получен." : "Бонус получен.",
            "amount" => $bonus->amount,
            "claimed_bonuses" => $bonuses,
        ];
    }


    public function getBonusHistory(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return ["type" => "error", "message" => "Авторизуйтесь!"];
        }

        $bonuses = UserBonus::where('user_id', $user->id)
            ->whereNotNull('claimed_at')
            ->orderBy('day')
            ->get()
            ->map(function ($bonus) {
                return [
                    'day' => $bonus->day,
                    'amount' => $bonus->amount,
                    'claimed_at' => $bonus->claimed_at,
                ];
            });

        // Показываем сумму последнего полученного бонуса, если он есть
        $amount = $bonuses->isEmpty() ? null : $bonuses->last()['amount'];

        if (!Auth::guest() && $user) {
            $userRegistrationDate = $user->created_at;
            $currentDate = Carbon::now();
            $daysRegistered = $currentDate->diffInDays($userRegistrationDate);
        } else {
            $daysRegistered = 0;
        }

        return [
            "type" => "success",
            "message" => "История бонусов.",
            "amount" => $amount,
            "claimed_bonuses" => $bonuses->toArray(),
            "regday" => $daysRegistered,
        ];
    }

    public function claimSubscriptionBonus(Request $request, $socialNetwork)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(["type" => "error", "msg" => "Авторизуйтесь!"]);
        }

        $validNetworks = [
            'vk' => 'ВКонтакте',
            'tg' => 'Telegram',
            'tik' => 'TikTok',
            'inst' => 'Instagram',
            'ds' => 'Discord'
        ];

        // Проверяем, что передана валидная соцсеть
        if (!array_key_exists($socialNetwork, $validNetworks)) {
            return response()->json(["type" => "error", "msg" => "Неверный тип подписки!"]);
        }

        $existingBonus = SubscriptionBonus::where('user_id', $user->id)
            ->where('bonus_type', $socialNetwork)
            ->first();

        if ($existingBonus) {
            return response()->json([
                "type" => "error",
                "msg" => "Бонус за подписку на {$validNetworks[$socialNetwork]} уже был получен."
            ]);
        }

        DB::transaction(function () use ($user, $socialNetwork) {
            $bonus = SubscriptionBonus::create([
                'user_id' => $user->id,
                'bonus_type' => $socialNetwork,
                'amount' => 5,
                'claimed_at' => null,
            ]);

            $user->balance += $bonus->amount;
            $user->save();
        });

        return response()->json([
            "type" => "success",
            "msg" => "Бонус успешно получен!",
            "amount" => 5
        ]);
    }
}
