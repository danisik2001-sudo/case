<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KnifeGameLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class KnifeGameController extends Controller
{
    const MIN_BET = 0.25;
    const GRID_SIZE = 25;

    public function start(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Авторизуйтесь для игры']);
        }

        $bet = (float) $request->input('bet');
        $knifeCount = (int) $request->input('knife_count');

        if ($bet < self::MIN_BET) {
            return response()->json(['success' => false, 'message' => 'Минимальная ставка ' . self::MIN_BET . ' ₽']);
        }

        $validMines = [3, 5, 10, 20];
        if (!in_array($knifeCount, $validMines)) {
            return response()->json(['success' => false, 'message' => 'Выберите 3, 5, 10 или 20 мин']);
        }

        $balance = (float) $user->balance;
        if ($balance < $bet) {
            return response()->json(['success' => false, 'message' => 'Недостаточно средств на балансе']);
        }

        $activeGame = KnifeGameLog::where('user_id', $user->id)
            ->where('status', KnifeGameLog::STATUS_PLAYING)
            ->first();

        if ($activeGame) {
            return response()->json(['success' => false, 'message' => 'Завершите текущую игру']);
        }

        $indices = range(0, self::GRID_SIZE - 1);
        shuffle($indices);
        $knifeIndices = array_slice($indices, 0, $knifeCount);

        DB::beginTransaction();
        try {
            $user->decrement('balance', $bet);

            $game = KnifeGameLog::create([
                'user_id' => $user->id,
                'bet' => $bet,
                'knife_count' => $knifeCount,
                'knife_indices' => $knifeIndices,
                'revealed_indices' => [],
                'status' => KnifeGameLog::STATUS_PLAYING,
            ]);

            try {
                Redis::publish('updateUser', json_encode([
                    'user_id' => $user->id,
                    'balance' => $user->fresh()->balance,
                ]));
            } catch (\Exception $redisException) {
                // Redis может быть недоступен — не прерываем игру
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('KnifeGame start error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Ошибка сервера. Проверьте логи: ' . $e->getMessage()]);
        }

        return response()->json([
            'success' => true,
            'game_id' => $game->id,
            'balance' => (float) $user->fresh()->balance,
        ]);
    }

    public function active(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['success' => true, 'active' => null]);
        }

        $game = KnifeGameLog::where('user_id', $user->id)
            ->where('status', KnifeGameLog::STATUS_PLAYING)
            ->first();

        if (!$game) {
            return response()->json(['success' => true, 'active' => null]);
        }

        return response()->json([
            'success' => true,
            'active' => [
                'game_id' => $game->id,
                'bet' => (float) $game->bet,
                'knife_count' => $game->knife_count,
                'revealed_indices' => $game->revealed_indices ?? [],
                'balance' => (float) $user->balance,
            ],
        ]);
    }

    public function forfeit(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Авторизуйтесь']);
        }

        $game = KnifeGameLog::where('user_id', $user->id)
            ->where('status', KnifeGameLog::STATUS_PLAYING)
            ->first();

        if (!$game) {
            return response()->json(['success' => true, 'message' => 'Нет активной игры', 'balance' => (float) $user->balance]);
        }

        $bet = (float) $game->bet;
        $user->increment('balance', $bet);
        $game->update(['status' => KnifeGameLog::STATUS_LOSE]);

        try {
            Redis::publish('updateUser', json_encode([
                'user_id' => $user->id,
                'balance' => $user->fresh()->balance,
            ]));
        } catch (\Exception $redisException) {
        }

        return response()->json([
            'success' => true,
            'message' => 'Игра отменена',
            'balance' => (float) $user->fresh()->balance,
        ]);
    }

    public function reveal(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Авторизуйтесь']);
        }

        $gameId = $request->input('game_id');
        $cellIndex = (int) $request->input('cell_index');

        if ($cellIndex < 0 || $cellIndex >= self::GRID_SIZE) {
            return response()->json(['success' => false, 'message' => 'Неверная ячейка']);
        }

        $game = KnifeGameLog::where('id', $gameId)
            ->where('user_id', $user->id)
            ->where('status', KnifeGameLog::STATUS_PLAYING)
            ->first();

        if (!$game) {
            return response()->json(['success' => false, 'message' => 'Игра не найдена или завершена']);
        }

        $revealed = $game->revealed_indices ?? [];
        if (in_array($cellIndex, $revealed)) {
            return response()->json(['success' => false, 'message' => 'Ячейка уже открыта']);
        }

        $knifeIndices = $game->knife_indices;
        $hasKnife = in_array($cellIndex, $knifeIndices);

        if ($hasKnife) {
            $game->update([
                'status' => KnifeGameLog::STATUS_LOSE,
                'revealed_indices' => array_merge($revealed, [$cellIndex]),
            ]);

            return response()->json([
                'success' => true,
                'has_knife' => true,
                'game_over' => true,
                'win' => false,
            ]);
        }

        $newRevealed = array_merge($revealed, [$cellIndex]);
        $game->update(['revealed_indices' => $newRevealed]);

        $multiplier = $game->getCurrentMultiplier();
        $safeCount = self::GRID_SIZE - $game->knife_count;
        $allRevealed = count($newRevealed) >= $safeCount;

        if ($allRevealed) {
            $profit = round($game->bet * $multiplier, 2);
            $game->update([
                'status' => KnifeGameLog::STATUS_WIN,
                'profit' => $profit,
                'multiplier' => $multiplier,
            ]);
            $user->increment('balance', $profit);

            try {
                Redis::publish('updateUser', json_encode([
                    'user_id' => $user->id,
                    'balance' => $user->fresh()->balance,
                ]));
            } catch (\Exception $redisException) {
            }
        }

        return response()->json([
            'success' => true,
            'has_knife' => false,
            'multiplier' => round($multiplier, 2),
            'game_over' => $allRevealed,
            'win' => $allRevealed,
            'profit' => $allRevealed ? round($game->bet * $multiplier, 2) : null,
            'balance' => $allRevealed ? $user->fresh()->balance : null,
        ]);
    }

    public function cashout(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Авторизуйтесь']);
        }

        $gameId = $request->input('game_id');
        $requestedMult = (float) $request->input('multiplier');

        $game = KnifeGameLog::where('id', $gameId)
            ->where('user_id', $user->id)
            ->where('status', KnifeGameLog::STATUS_PLAYING)
            ->first();

        if (!$game) {
            return response()->json(['success' => false, 'message' => 'Игра не найдена или завершена']);
        }

        $currentMult = $game->getCurrentMultiplier();
        if ($requestedMult <= 0 || $requestedMult > $currentMult) {
            return response()->json(['success' => false, 'message' => 'Невозможно забрать выигрыш']);
        }

        $profit = round($game->bet * $requestedMult, 2);

        $game->update([
            'status' => KnifeGameLog::STATUS_WIN,
            'profit' => $profit,
            'multiplier' => $requestedMult,
        ]);
        $user->increment('balance', $profit);

        try {
            Redis::publish('updateUser', json_encode([
                'user_id' => $user->id,
                'balance' => $user->fresh()->balance,
            ]));
        } catch (\Exception $redisException) {
        }

        return response()->json([
            'success' => true,
            'win' => true,
            'profit' => $profit,
            'multiplier' => $requestedMult,
            'balance' => $user->fresh()->balance,
        ]);
    }

    public function history(Request $request)
    {
        $user = $request->user();
        $userId = $user ? $user->id : null;
        $limit = min((int) $request->input('limit', 20), 50);
        $games = KnifeGameLog::with('user:id,username,avatar')
            ->where('status', '!=', KnifeGameLog::STATUS_PLAYING)
            ->orderByDesc('id')
            ->limit($limit)
            ->get()
            ->map(function ($g) use ($userId) {
                $isOwn = $userId && $g->user_id === $userId;
                $item = [
                    'id' => $g->id,
                    'username' => $g->user->username ?? 'Игрок',
                    'avatar' => $g->user->avatar ?? null,
                    'knives' => $g->knife_count,
                    'bet' => (float) $g->bet,
                    'multiplier' => (float) $g->multiplier,
                    'win' => $g->status === KnifeGameLog::STATUS_WIN,
                    'profit' => (float) $g->profit,
                ];
                if ($isOwn && $g->status === KnifeGameLog::STATUS_LOSE) {
                    $item['knife_indices'] = $g->knife_indices ?? [];
                    $item['revealed_indices'] = $g->revealed_indices ?? [];
                }
                return $item;
            });

        return response()->json(['success' => true, 'history' => $games]);
    }

    public function gameDetails(Request $request, $id)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Авторизуйтесь']);
        }

        $game = KnifeGameLog::where('id', $id)
            ->where('user_id', $user->id)
            ->where('status', '!=', KnifeGameLog::STATUS_PLAYING)
            ->first();

        if (!$game) {
            return response()->json(['success' => false, 'message' => 'Игра не найдена']);
        }

        return response()->json([
            'success' => true,
            'game' => [
                'id' => $game->id,
                'bet' => (float) $game->bet,
                'knife_count' => $game->knife_count,
                'knife_indices' => $game->knife_indices ?? [],
                'revealed_indices' => $game->revealed_indices ?? [],
                'status' => $game->status,
                'profit' => (float) $game->profit,
                'multiplier' => (float) $game->multiplier,
            ],
        ]);
    }

    public function topWins(Request $request)
    {
        $limit = min((int) $request->input('limit', 10), 20);
        $games = KnifeGameLog::with('user:id,username,avatar')
            ->where('status', KnifeGameLog::STATUS_WIN)
            ->where('profit', '>', 0)
            ->orderByDesc('profit')
            ->limit($limit)
            ->get()
            ->map(function ($g) {
                return [
                    'username' => $g->user->username ?? 'Игрок',
                    'avatar' => $g->user->avatar ?? null,
                    'knives' => $g->knife_count,
                    'bet' => (float) $g->bet,
                    'multiplier' => (float) $g->multiplier,
                    'profit' => (float) $g->profit,
                ];
            });

        return response()->json(['success' => true, 'top' => $games]);
    }
}
