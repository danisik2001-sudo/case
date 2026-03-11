<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionBonus extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'bonus_type', 'amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
