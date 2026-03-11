<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function load()
    {
        $payments = Payment::query()->with('user', 'promo')->get();

        return $payments;
    }

    public function delete(Request $request): array
    {
        $payment = Payment::query()->find($request->id);
        if (!$payment) return ['success' => false, 'message' => 'Такого платежа не существует'];

        $payment->delete();
        return ['success' => true, 'message' => 'Платеж удалён'];
    }
    public function create(Request $request): array
    {
        if (!$request->user_id) return ['success' => false, 'message' => 'Вы не указали пользователя'];
        if (!$request->sum) return ['success' => false, 'message' => 'Вы не указали сумму платежа'];
        if (!$request->type) return ['success' => false, 'message' => 'Вы не указали тип платежа'];
        if (!$request->status) return ['success' => false, 'message' => 'Вы не указали статус платежа'];
        if (!$request->description) return ['success' => false, 'message' => 'Вы не указали комментарий к платежу'];

        $user = User::find($request->user_id);
        if (!$user) {
            return ['success' => false, 'message' => 'Пользователь не найден'];
        }

        Payment::query()->create([
            'user_id' => $request->user_id,
            'sum' => $request->sum,
            'type' => $request->type,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        $user->update(['balance' => $user->balance + $request->sum]);

        return ['success' => true, 'message' => 'Фейковый депозит создан'];
    }
}
