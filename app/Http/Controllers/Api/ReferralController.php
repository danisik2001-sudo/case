<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promocodes;
use App\Models\Payment;
use App\Models\User;
use App\Services\RedisService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReferralController extends Controller
{
    protected $redis;

    public function __construct()
    {
        $this->redis = new RedisService();
    }

    public function get()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'case_promocode' => null,
                'percent' => 0,
                'earnings_percent' => 0,
                'count' => 0,
                'promocode' => null,
                'total_deposit' => 0,
                'count_deposit' => 0,
                'referral_earned' => null,
                'level' => 1
            ]);
        }

        $promocode = Promocodes::where('owner', $user->id)->first();
        $casePromocode = Promocodes::where('owner', $user->id)
            ->where('type', 'cases')
            ->pluck('name')
            ->first();

        if (!$promocode) {
            return response()->json([
                'case_promocode' => null,
                'percent' => 0,
                'earnings_percent' => 0,
                'count' => 0,
                'promocode' => null,
                'total_deposit' => 0,
                'count_deposit' => 0,
                'referral_earned' => null,
                'level' => 1
            ]);
        }

        $referralCount = User::where('referred_by', $user->referral_code)->count();
        $percent = $promocode->percent;
        $earnings_percent = $promocode->earnings_percent;
        $count = $referralCount;
        $promocode_name = $promocode->name;
        $total_deposit = $promocode->total_deposit;

        // Обновление earnings_percent в зависимости от total_deposit
        if ($total_deposit > 150 && $total_deposit < 500) {
            $promocode->earnings_percent = 5;
            $promocode->percent = 40;
        } elseif ($total_deposit >= 500) {
            $promocode->earnings_percent = 7;
            $promocode->percent = 40;
        }


        // Сохраняем изменения в базе данных
        $promocode->save();

        $count_deposit = Payment::where('promocode', $promocode_name)
            ->where('status', 1) // Учитываем только депозиты со статусом 1
            ->count();


        $referral_earned = $user->referral_earned ?? 0;
        $referral_code = $user->referral_code;

        $referral_level = $user->level;

        if ($total_deposit >= 500) {
            $referral_level = 3;
        } elseif ($total_deposit >= 150) {
            $referral_level = 2;
        }

        if ($user->level !== $referral_level) {
            $user->update(['level' => $referral_level]);
        }

        $statistics = [
            'percent' => $percent,
            'earnings_percent' => $earnings_percent,
            'count' => $count,
            'promocode' => $referral_code,
            'case_promocode' => $casePromocode,
            'total_deposit' => $total_deposit,
            'count_deposit' => $count_deposit,
            'referral_earned' => $referral_earned,
            'level' => $referral_level
        ];

        return response()->json($statistics);
    }



    public function newRefCode(Request $request)
    {
        $user = Auth::user();
        $inputCode = $request->input('promocodeID');

        if (!$user) {
            return [
                "success" => false,
                "message" => "Авторизуйтесь!"
            ];
        }

        if ($user->referral_code != null) {
            return [
                "success" => false,
                "message" => "Вы уже создали промокод, его нельзя изменить!"
            ];
        }

        if (empty($inputCode)) {
            return [
                "success" => false,
                "message" => "Промокод не может быть пустым!"
            ];
        }

        // Проверка на английские символы и цифры
        if (!preg_match('/^[a-zA-Z0-9]+$/', $inputCode)) {
            return [
                "success" => false,
                "message" => "Промокод может содержать только английские буквы и цифры!"
            ];
        }

        $existingCode = User::where('referral_code', $inputCode)->first();
        if ($existingCode) {
            return [
                "success" => false,
                "message" => "Промокод уже используется!"
            ];
        }

        \Log::info('Input promocodeID:', ['promocodeID' => $inputCode]);

        $user->update([
            'referral_code' => $inputCode
        ]);

        Promocodes::create([
            'name' => $inputCode,
            'percent' => 40,         // Фиксированный процент
            'activates' => 99999,    // Фиксированное количество активаций
            'owner' => $user->id,
            'earnings_percent' => 3,  // ID пользователя как владелец промокода
            'total_deposit' => 0,     // Сумма депозитов
            'created_at' => now(),    // Время создания
            'updated_at' => now()     // Время обновления
        ]);

        return [
            "success" => true,
            "message" => "Промокод успешно создан! Ваш код: \"$inputCode\"",
            "referral_code" => $inputCode
        ];
    }
}
