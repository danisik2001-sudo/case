<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaffleHourItems extends Model
{
    protected $table = 'raffle_hour_items';

    protected $fillable = [
        'item_id'
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id', 'id');
    }
}
