<?php

namespace App\Http\Controllers\Api\Admin;

ini_set('memory_limit', '256M');
set_time_limit(999999);

use App\Models\Contract;
use App\Models\Item;
use App\Models\Live;
use App\Models\Upgrade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ItemsController extends Controller
{
    public function load(): \Illuminate\Http\JsonResponse
    {
        return datatables(Item::query()->get())->toJson();
    }

    public function get(Request $request): array
    {
        $item = Item::query()->find($request->id);
        if (!$item) return ['success' => false, 'message' => 'Предмет не найден'];

        return ['success' => true, 'item' => $item];
    }

    public function edit(Request $request): array
    {
        $item = Item::query()->find($request->item['id']);

        if (!$item) return ['success' => false, 'message' => 'Предмет не найден'];

        if (!$request->item['market_hash_name']) return ['success' => false, 'message' => 'Вы не указали название предмета'];
        if (!$request->item['icon_url']) return ['success' => false, 'message' => 'Вы не указали картинку предмета'];
        if (!$request->item['price']) return ['success' => false, 'message' => 'Вы не указали цену предмета'];

        $item->update([
            'market_hash_name' => $request->item['market_hash_name'],
            'icon_url' => $request->item['icon_url'],
            'price' => $request->item['price'],
        ]);

        return ['success' => true, 'message' => 'Предмет изменен'];
    }

    public function delete(Request $request)
    {
        $item = Item::query()->find($request->id);

        if (!$item) return ['success' => false, 'message' => 'Предмет не найден'];

        Live::query()->where('item_id', $item->id)->delete();
        Contract::query()->where('item_id', $item->id)->delete();
        Upgrade::query()->where('item_id', $item->id)->orWhere('win_id', $item->id)->delete();

        $item->delete();

        return ['success' => true, 'message' => 'Предмет удалён'];
    }

    public function create(Request $r): array
    {
        $classid = $r->classid;

        $exist = Item::query()->where('classid', $classid)->first();
        if ($exist) return ['success' => false, 'message' => 'Предмет с таким CLASSID существует'];

        $steamRequest = Http::get('https://api.steampowered.com/ISteamEconomy/GetAssetClassInfo/v1/', [
            'key' => config('services.steam.api'),
            'appid' => 730,
            'class_count' => 1,
            'classid0' => $classid
        ])->json();

        $prices = Http::get('https://market.csgo.com/api/v2/prices/RUB.json')->json();

        if (!$prices['success']) return ['success' => false, 'message' => 'Цены не были получены'];
        $priceItem = $prices['items'];

        $steamResult = $steamRequest['result'];

        if ($steamResult['success']) {
            $availableRarity = ['★', 'Restricted', 'Mil-Spec', 'Industrial', 'Classified', 'Covert', 'Contraband'];

            $item = $steamResult[$classid];
            $price = 0;

            foreach ($priceItem as $itemPrice) {
                if ($item['market_hash_name'] == $itemPrice['market_hash_name']) {
                    $price = ceil($itemPrice['price']);
                }
            }

            if ($price === 0) return ['success' => false, 'message' => 'Для предмета нет цены'];

            $rarities = $item['type'];
            $rarity = explode(" ", $rarities);
            $itemRarity = '';

            foreach ($availableRarity as $available) {
                foreach ($rarity as $find) {
                    if ($available === $find) $itemRarity = $find;
                }
            }

            $exterior = str_replace(')', '', explode('(', $item['market_hash_name'])[1]);

            $db = Item::query()->create([
                'classid' => $classid,
                'market_hash_name' => $item['market_hash_name'],
                'market_name' => $item['market_hash_name'],
                'icon_url' => $item['icon_url'],
                'exterior' => $exterior,
                'rarity' => $itemRarity,
                'price' => $price,
            ]);

            return ['success' => true, 'message' => 'Предмет ' . $db->market_hash_name . ' добавлен'];
        } else {
            return ['success' => false, 'message' => 'Предмет не найден'];
        }
    }
}
