<?php

namespace App\Http\Controllers\Api\Admin;


use App\Models\Live;
use App\Models\User;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function getUser(Request $request): array
    {
        return [
            'user' => $request->user()
        ];
    }

    public function load(): \Illuminate\Http\JsonResponse
    {
        return datatables(User::query())->toJson();
    }

    public function get(Request $request): array
    {
        $user = User::query()
            ->withSum('paymentsPayed', 'sum')
            ->withCount('cases', 'contracts', 'upgrades')
            ->find(intval($request->id));

        if (!$user) return ['success' => false];

        $withdrawed = Live::query()->where('user_id', $user->id)->where('status', Live::SEND)->sum('price');
        $user->withdrawed = $withdrawed;

        return ['success' => true, 'user' => $user];
    }

    public function save(Request $request): array
    {
        $user = User::query()->find(intval($request->id));

        if (!$user) return ['success' => false, 'message' => 'Пользователь не найден'];

        $data = $request->user;
        if ($data['balance'] < 0) return ['success' => false, 'message' => 'Вы не указали баланс'];
        // if (!$data['referral_code']) return ['success' => false, 'message' => 'Отсутсвутет реферальный код'];

        $user->update([
            'balance' => $data['balance'],
            'is_admin' => $data['is_admin'],
            'type' => $data['type'],
            'referral_code' => $data['referral_code'],
            'personal_profit' => $data['personal_profit'],
            'block_withdraw' => $data['block_withdraw'],
            'blocked' => $data['blocked']
        ]);

        return ['success' => true, 'message' => 'Пользователь обновлён'];
    }

    public function giveDrop(Request $request): array
    {
        $userId = intval($request->user_id);
        $itemId = intval($request->item_id);

        if (!$userId) {
            return ['success' => false, 'message' => 'ID пользователя не указан'];
        }
        $item = Item::find($itemId);
        if (!$item) {
            return ['success' => false, 'message' => 'Предмет не найден'];
        }

        $user = User::find($userId);
        if (!$user) {
            return ['success' => false, 'message' => 'Пользователь не найден'];
        }

        Live::create([
            'user_id' => $user->id,
            'case_id' => null,
            'item_id' => $itemId,
            'price' => $item->price,
            'status' => Live::OPENED,
            'type' => 'drop',
        ]);

        return ['success' => true, 'message' => 'Дроп успешно выдан'];
    }

    public function create(Request $r)
    {
        $steamApiKey = env('STEAM_API_KEY');

        if ($steamApiKey == NULL) {
            return [
                'type' => 'error',
                'message' => 'Не указан API ключ Steam',
                'success' => false
            ];
        }

        $steamId = $r->user;
        $type = $r->type;

        $request_params = [
            'key' => $steamApiKey,
            'steamids' => $steamId
        ];

        $get_params = http_build_query($request_params);
        $result = json_decode(file_get_contents('https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v2?' . $get_params));

        if (!isset($result->response->players[0])) {
            return [
                'type' => 'error',
                'message' => 'Пользователь с таким SteamID не найден',
                'success' => false
            ];
        }

        if (User::where('steamid', $result->response->players[0]->steamid)->first()) {
            return [
                'type' => 'error',
                'message' => 'Такой пользователь уже существует',
                'success' => false
            ];
        }

        User::create([
            'username' => $result->response->players[0]->personaname,
            'steamid' => $result->response->players[0]->steamid,
            'avatar' => $result->response->players[0]->avatarfull,
            'platform' => 'steam',
            'type' => $type,
        ]);

        return [
            'type' => 'success',
            'message' => 'Пользователь добавлен',
            'success' => true
        ];
    }
}
