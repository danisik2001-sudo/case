<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function load()
    {
        $notifications = Notification::all()->map(function ($notification) {
            return [
                'title' => $notification->title,
                'content' => $notification->content,
                'link' => $notification->link,
                'created_at' => $notification->created_at,
            ];
        });

        return response()->json($notifications);
    }
}
