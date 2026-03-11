<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MissionsDone extends Model
{
    use HasFactory;

    const WIN = 1;
    const LOSE = 0;

    protected $table = 'missionsdone';

    protected $fillable = [
        'user_id',
        'missions_id',
        'prize',
    ];

    public function prizeItem(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
