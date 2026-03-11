<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\RedisService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redis;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $settings;

    public function __construct()
    {
        $this->settings = Setting::query()->first();
    }
}
