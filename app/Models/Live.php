<?php

namespace App\Models;

use App\Observers\LiveUpdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;

class Live extends Model
{
    use HasFactory;

    const OPENED = 0;
    const SELL = 1;
    const SENDING = 2;
    const WAIT_SELLER = 3;
    const WAIT_ORDER = 4;
    const ORDER_READY = 5;
    const SEND = 6;
    const CONTRACTS = 7;
    const UPGRADE = 8;
    const REPLACED = 9;
    const REPLACE = 10;
    const WHEEL_UPGRADE = 12;
    const WHEEL_CONTRACTS = 13;

    const CASE_TYPE = 'case';
    const UPGRADE_TYPE = 'upgrade';
    const CONTRACT_TYPE = 'contract';

    protected $table = 'lives';

    protected $fillable = [
        'user_id',
        'case_id',
        'item_id',
        'price',
        'status',
        'trade_id',
        'market_id',
        'custom_id',
        'type'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function case(): BelongsTo
    {
        return $this->belongsTo(Cases::class);
    }
}
