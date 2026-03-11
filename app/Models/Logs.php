<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Logs extends Model
{
    use HasFactory;

    protected $table = 'user_logs';

    protected $fillable = [
        'user_id',
        'action',
        'impact',
        'created_at'
    ];

    // Указываем, что нам нужны временные метки
    public $timestamps = false;

    // Определение связи с пользователем (User)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
