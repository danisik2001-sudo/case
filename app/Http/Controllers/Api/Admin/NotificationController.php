<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function load()
    {
        $notification = Notification::get();

        return $notification;
    }

    public function create(Request $r)
    {

        $notificationData = $r->notification;
        $notificationData['created_at'] = now();

        Notification::create($notificationData);

        return ['success' => true, 'message' => 'Промокод создан'];
    }

    public function get(Request $r)
    {
        $item = Notification::find($r->id);

        if ($item) {
            return ['success' => true, 'notification' => $item];
        } else {
            return ['success' => false];
        }
    }

    public function edit(Request $r)
    {
        $item = Notification::find($r->notification['id']);

        if ($item) {
            $item->update($r->notification);
            return ['success' => true, 'message' => 'Уведомление изменено'];
        } else {
            return ['success' => false, 'message' => 'Уведомление не найдено'];
        }
    }

    public function del(Request $r)
    {
        $item = Notification::find($r->id);

        if ($item) {
            $item->delete();
            return ['type' => 'success', 'message' => 'Уведомление удалено'];
        } else {
            return ['type' => 'error', 'message' => 'Уведомление не найдено'];
        }
    }
}
