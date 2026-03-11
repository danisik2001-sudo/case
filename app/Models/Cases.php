<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cases extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'name_en',
        'image',
        'url',
        'opened',
        'max_opened',
        'type',
        'min_dep',
        'price',
        'price_old',
        'exp',
        'profit',
        'is_show'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
