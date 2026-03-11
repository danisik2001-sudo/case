<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KnifeGameLog extends Model
{
    const STATUS_PLAYING = 'playing';
    const STATUS_WIN = 'win';
    const STATUS_LOSE = 'lose';

    const GRID_SIZE = 25;

    protected $table = 'knife_game_logs';

    protected $fillable = [
        'user_id',
        'bet',
        'knife_count',
        'knife_indices',
        'revealed_indices',
        'status',
        'profit',
        'multiplier',
    ];

    protected $casts = [
        'knife_indices' => 'array',
        'revealed_indices' => 'array',
        'bet' => 'decimal:2',
        'profit' => 'decimal:2',
        'multiplier' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getMaxMultiplier(int $knifeCount): float
    {
        switch ($knifeCount) {
            case 3: return 4.0;
            case 5: return 6.0;
            case 10: return 12.0;
            case 20: return 25.0;
            default: return 4.0;
        }
    }

    public function getCurrentMultiplier(): float
    {
        $safeCount = self::GRID_SIZE - $this->knife_count;
        $revealedCount = count($this->revealed_indices ?? []);
        if ($safeCount <= 0) {
            return 1;
        }
        $maxMult = self::getMaxMultiplier($this->knife_count);
        $multPerCell = ($maxMult - 1) / $safeCount;
        return 1 + $revealedCount * $multPerCell;
    }
}
