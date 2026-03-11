<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cases;
use App\Models\Contract;
use App\Models\Live;
use App\Models\Upgrade;
use App\Models\User;
use App\Models\Promocodes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LiveController extends Controller
{
    public function updateLiveElements(): array
    {
        $all = Live::query()
            ->with(['user:id,username,avatar,steamid', 'item:id,market_hash_name,rarity,icon_url', 'case:id,name,url,image'])
            ->select('id', 'user_id', 'item_id', 'case_id', 'price', 'type')
            ->take(16)
            ->orderBy('id', 'desc')
            ->get();
        $best = Live::query()
            ->select('id', 'item_id', 'user_id', 'case_id', 'price', 'type')
            ->with(['user:id,username,steamid,avatar', 'item:id,rarity,market_hash_name,icon_url', 'case:id,name,url,image'])
            ->where('price', '>=', 20)
            ->take(16)
            ->orderBy('id', 'desc')
            ->get();

        return [
            'all' => $all,
            'best' => $best
        ];
    }

    public function getLiveStatistic(): array
    {
        $players = User::query()->count('id');
        $opens = Live::query()->where('type', Live::CASE_TYPE)->count('id');
        $upgrades = Upgrade::query()->count('id');
        $contracts = Contract::query()->count('id');

        return [
            'users' => $players,
            'cases' => $opens,
            'upgrades' => $upgrades + 128539,
            'contracts' => $contracts + 74824,
        ];
    }

    public function generatePromocodes(): array { 
        $today = Carbon::today();

        // Проверка, есть ли уже промокод на сегодня
        $promo = Promocodes::where('owner', 0)
            ->where('type', 'percent')
            ->where('percent', 35)
            ->whereDate('created_at', $today)
            ->first();

        // Если нет — создаём
        if (!$promo) {
            $promo = Promocodes::create([
                'name' => Str::upper(Str::random(12)),
                'type' => 'percent',
                'percent' => 35,
                'activates' => 10000,
                'owner' => 0,
                'earnings_percent' => NULL, 
                'total_deposit' => 0,
            ]);
        }

        return [
            'code' => $promo->name,
            'percent' => $promo->percent,
            'expires_at' => $promo->created_at->copy()->addDay()->format('Y-m-d H:i:s'),
        ];
    }
}
