<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsePromocode extends Model
{
    use HasFactory;

    // Указываем таблицу, если имя таблицы не соответствует имени модели
    protected $table = 'use_promocodes';

    // Указываем, какие поля можно массово заполнять (fillables)
    protected $fillable = [
        'user_id',
        'promo_name',
        'case_id',
    ];

    // Указываем, что нам нужны временные метки
    public $timestamps = true;

    // Определение связи с пользователем (User)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Определение связи с кейсом (Case)
    public function case(): BelongsTo
    {
        return $this->belongsTo(Cases::class);
    }
}
