<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentMethods extends Model
{
    use HasFactory;

    protected $table = 'payment_method';

    protected $fillable = [
        'name',
        'icon',
        'apiUrl',
        'currency',
        'value',
        'min_dep',
        'type',
        'status',
    ];
}
