<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CalendarBonus extends Model
{
    use HasFactory;

    protected $table = 'calendar_bonuses';

    protected $fillable = [
        'user_id',
        'day',
        'bonus_balance',
        'case_id',
        'item_id',
        'promocode_id'
    ];

    public function Item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
    public function Promocode(): BelongsTo
    {
        return $this->belongsTo(Promocodes::class,  'id');
    }
    public function case(): BelongsTo
    {
        return $this->belongsTo(Cases::class);
    }
}
