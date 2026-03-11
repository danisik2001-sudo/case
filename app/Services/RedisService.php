<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class RedisService
{

    protected $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    public function event(string $channel, array $data)
    {
        $this->redis->publish($channel, json_encode($data));
    }
}
