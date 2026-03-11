<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function settings(): object
    {
        $settings = Setting::query()->first();

        return (object) [
            'sitename' => $settings->sitename,
            'tg_group' => $settings->tg_group,
            'youtube_link' => $settings->youtube_link,
            'discord_link' => $settings->discord_link,
            'tg_auth_bot' => $settings->tg_auth_bot
        ];
    }
    public function main(Request $request)
    {
        return view('welcome');
    }

    public function referral()
    {
        return view('referral');
    }

    public function admin()
    {
        return view('admin');
    }
}
