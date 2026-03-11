<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promocodes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'percent',
        'activates',
        'owner',
        'earnings_percent',
        'total_deposit',
        'created_at',
    ];
}
