<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'sitename',
        'title',
        'description',
        'keywords',
        'pure_profit',
        'pure_percent',
        'site_profit',
        'profit_percent',
        'withdraw_min_sum',
        'market_key',
        'tg_group',
        'raffle_dep_hour',
        'raffle_dep_day',
        'raffle_dep_week',
        'multiplier',
        'youtube_link',
        'discord_link',
        'tg_auth_bot',
        'merchant_id',
        'merchant_secret_1',
        'merchant_secret_2',
        'min_dep',
        'battle_min_add_sum'
    ];
}
