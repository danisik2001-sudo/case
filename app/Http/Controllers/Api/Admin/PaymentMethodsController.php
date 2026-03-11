<?php

namespace App\Http\Controllers\Api\Admin;

ini_set('memory_limit', '256M');
ini_set('max_execution_time', '0');


use App\Models\PaymentMethods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentMethodsController  extends Controller
{
    public function load()
    {
        return datatables(PaymentMethods::query())->toJson();
    }


    public function get(Request $r)
    {
        $item = PaymentMethods::find($r->id);

        if ($item) {
            return ['success' => true, 'item' => $item];
        } else {
            return ['success' => false];
        }
    }

    public function edit(Request $r)
    {
        $item = PaymentMethods::find($r->item['id']);

        if ($item) {
            $item->update($r->item);
            return ['type' => 'success', 'message' => 'Предмет изменен'];
        } else {
            return ['type' => 'error', 'message' => 'Предмет не найден'];
        }
    }
}
