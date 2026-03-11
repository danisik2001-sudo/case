<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WheelItems extends Model
{

    const CONTRACTS = 12;
    const UPGRADE = 13;

    use HasFactory;

    protected $table = 'wheel_items';

    protected $fillable = [
        'image',
        'name',
        'desc',
        'chance'
    ];
}
