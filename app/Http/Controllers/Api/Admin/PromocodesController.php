<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promocodes;
use Illuminate\Http\Request;

class PromocodesController extends Controller
{
    public function load()
    {
        $promocodes = Promocodes::get();

        return $promocodes;
    }

    public function create(Request $r)
    {
        $existingPromocode = Promocodes::where('name', $r->promocode['name'])->first();

        if ($existingPromocode) {
            return ['success' => false, 'message' => 'Промокод уже существует'];
        }

        $promocodeData = $r->promocode;
        $promocodeData['created_at'] = now();

        Promocodes::create($promocodeData);

        return ['success' => true, 'message' => 'Промокод создан'];
    }

    public function get(Request $r)
    {
        $item = Promocodes::find($r->id);

        if ($item) {
            return ['success' => true, 'promocode' => $item];
        } else {
            return ['success' => false];
        }
    }

    public function edit(Request $r)
    {
        $item = Promocodes::find($r->promocode['id']);

        if ($item) {
            $item->update($r->promocode);
            return ['success' => true, 'message' => 'Промокод изменен'];
        } else {
            return ['success' => false, 'message' => 'Промокод не найден'];
        }
    }

    public function del(Request $r)
    {
        $item = Promocodes::find($r->id);

        if ($item) {
            $item->delete();
            return ['type' => 'success', 'message' => 'Промокод удален'];
        } else {
            return ['type' => 'error', 'message' => 'Промокод не найден'];
        }
    }

    public function checkPromocode(Request $r)
    {
        $promo = Promocodes::where('name', $r->code)->first();

        if ($promo) {
            return ['success' => true, 'percent' => $promo->percent];
        } else {
            return ['success' => false];
        }
    }
}
