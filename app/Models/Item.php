<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'classid',
        'market_hash_name',
        'market_name',
        'icon_url',
        'exterior',
        'rarity',
        'price',
    ];

    /**
     * Возвращает массив исключенных раритетов.
     *
     * @return array
     */
    public static function getExcludedRarities(): array
    {
        return [
            'Remarkable Sticker',
            'High Grade Sticker',
            'Base Grade Tag',
            'High Grade Music Kit',
            'container',
            'Base Grade Key',
            'Base Grade Tool',
            'High Grade Collectible',
            'Extraordinary Sticker',
            'StatTrak™ High Grade Music Kit',
            'High Grade Patch',
            'Base Grade Graffiti',
            'Remarkable Collectible',
            'High Grade Graffiti',
            'Remarkable Patch',
            'Exotic Collectible',
            'Remarkable Graffiti',
            'Base Grade Pass',
            'Extraordinary Collectible',
            'Exotic Graffiti',
            'Exotic Patch',
            'Base Grade Gift',
            'Contraband Sticker',
            'Contraband Rifle',
            'High Grade Charm',
            'Remarkable Charm',
            'Extraordinary Charm',
            'Exotic Charm',
        ];
    }
}
