<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    const PAYED = 1;
    const WAITING = 0;

    protected $fillable = [
        'user_id',
        'sum',
        'type',
        'status',
        'description',
        'promocode',
        'invoice',
        'transaction_id',
        'created_at',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function promo(): HasOne
    {
        return $this->hasOne(Promocodes::class, 'id', 'name');
    }
}
