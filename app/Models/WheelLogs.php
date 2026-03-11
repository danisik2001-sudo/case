<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WheelLogs extends Model
{
    use HasFactory;

    protected $table = 'wheel_logs';

    protected $fillable = [
        'user_id',
        'item_id'
    ];
}
