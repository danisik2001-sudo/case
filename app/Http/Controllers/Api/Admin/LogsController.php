<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logs;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function load()
    {
        $logs = Logs::get();

        return $logs;
    }


    public function get(Request $r)
    {
        $item = Logs::find($r->id);

        if ($item) {
            return ['success' => true, 'logs' => $item];
        } else {
            return ['success' => false];
        }
    }
}
