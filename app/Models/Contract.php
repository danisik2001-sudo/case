<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'price',
        'items',
        'profit'
    ];

    protected $casts = [
        'items' => 'array',
    ];

    public function winItem(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
