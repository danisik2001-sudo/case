<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Upgrade extends Model
{
    use HasFactory;

    const WIN = 1;
    const LOSE = 0;

    protected $table = 'upgrades';

    protected $fillable = [
        'user_id',
        'item_id',
        'win_id',
        'price',
        'price_win',
        'profit',
        'percent',
        'status'
    ];

    public function usedItem(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function winItem(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'win_id', 'id');
    }
}
