<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Live;
use Illuminate\Http\Request;

class WithdrawsController extends Controller
{
    public function load(): \Illuminate\Http\JsonResponse
    {
        return datatables(Live::query()
            ->with('user', 'item')
            ->where('status', Live::SENDING)
            ->orWhere('status', Live::WAIT_SELLER)
            ->orWhere('status', Live::WAIT_ORDER)
            ->orWhere('status', Live::ORDER_READY)
            ->orWhere('status', Live::SEND)
            ->get()
        )->toJson();
    }
}
