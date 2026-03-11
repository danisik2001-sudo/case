<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id',
        'item_id',
        'droppable',
        'chance'
    ];


    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function case(): BelongsTo
    {
        return $this->belongsTo(Cases::class);
    }
}
