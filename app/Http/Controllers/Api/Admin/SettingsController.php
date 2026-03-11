<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Cases;
use App\Models\Contract;
use App\Models\Live;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\Upgrade;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class SettingsController extends Controller
{
    public function load()
    {
        return Setting::query()->first();
    }

    public function save(Request $request): array
    {
        Setting::query()->first()->update($request->settings);

        return [
            'success' => true,
            'message' => 'Настройки сохранены'
        ];
    }


    public function statistic(): array
    {
        $payments = [
            'today' => Payment::query()->where('status', Payment::PAYED)->where('created_at', '>=', Carbon::today())->sum('sum'),
            'week' => Payment::query()->where('status', Payment::PAYED)->where('created_at', '>=', Carbon::now()->subDays(7))->sum('sum'),
            'month' => Payment::query()->where('status', Payment::PAYED)->where('created_at', '>=', Carbon::now()->subDays(31))->sum('sum'),
            'all' => Payment::query()->where('status', Payment::PAYED)->sum('sum')
        ];

        $withdraws = [
            'today' => Live::query()->where('status', Live::SEND)->where('created_at', '>=', Carbon::today())->sum('price'),
            'week' => Live::query()->where('status', Live::SEND)->where('created_at', '>=', Carbon::now()->subDays(7))->sum('price'),
            'month' => Live::query()->where('status', Live::SEND)->where('created_at', '>=', Carbon::now()->subDays(31))->sum('price'),
            'all' => Live::query()->where('status', Live::SEND)->sum('price'),
        ];

        $users = [
            'today' => User::query()->where('created_at', '>=', Carbon::today())->count('id'),
            'week' => User::query()->where('created_at', '>=', Carbon::now()->subDays(7))->count('id'),
            'month' => User::query()->where('created_at', '>=', Carbon::now()->subDays(31))->count('id'),
            'all' => User::query()->count('id'),
        ];

        $opens = Live::query()->with(['item'])->where('status', Live::SEND)->get();
        $sumSell = 0;

        foreach ($opens as $open) {
            $sumSell += $open->item->price;
        }

        $profit = [
            'cases' => Cases::query()->sum('profit'),
            'contracts' => Contract::query()->sum('profit'),
            'upgrades' => Upgrade::query()->sum('profit'),
            'withdraw_sum' => Live::query()->where('status', Live::SEND)->sum('price')
        ];

        $stats = [
            'users' => User::query()->count('id'),
            'opens' => Live::query()->where('type', Live::CASE_TYPE)->count('id'),
            'contracts' => Contract::query()->count('id'),
            'upgrades' => Upgrade::query()->count('id')
        ];

        $lastPayments = Payment::query()->with(['user'])->where('status', Payment::PAYED)->orderBy('id', 'desc')->limit(10)->get();

        foreach ($lastPayments as $payment) {
            $payment->time = Carbon::parse($payment->created_at)->diffForHumans();
        }

        $lastUsers = User::query()->orderBy('id', 'desc')->limit(10)->get();

        foreach ($lastUsers as $user) {
            $user->time = Carbon::parse($user->created_at)->diffForHumans();
        }

        return [
            'payments' => $payments,
            'withdraws' => $withdraws,
            'users' => $users,
            'stats' => $stats,
            'profit' => $profit,
            'lastPayments' => $lastPayments,
            'lastUsers' => $lastUsers
        ];
    }

    public function getMultipliedOnline(Request $request): array
    {
        $online  = $request->input('online', 0);
        $multiplier = Setting::query()->value('multiplier') ?? 1;

        return [
            'success' => true,
            'online' => $online  * $multiplier,
        ];
    }

    public function getBalance(): array
    {
        $response = Http::get('https://market.csgo.com/api/v2/get-money', [
            'key' => $this->settings->market_key
        ]);

        if ($response->failed()) {
            return ['success' => false];
        }

        $url = $response->json();

        return ['success' => true, 'balance' => $url['money']];
    }
}
