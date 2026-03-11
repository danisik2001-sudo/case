<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function load()
    {
        $calendars = Calendar::get();

        return $calendars;
    }

    public function create(Request $r)
    {
        $existingPromocode = Calendar::where('day', $r->calendar['day'])->first();

        if ($existingPromocode) {
            return ['type' => 'error', 'message' => 'Бонус уже существует для этого дня'];
        }

        Calendar::create($r->calendar);

        return ['success' => true, 'message' => 'Промокод создан'];
    }


    public function get(Request $r)
    {
        $item = Calendar::find($r->id);

        if ($item) {
            return ['success' => true, 'calendar' => $item];
        } else {
            return ['success' => false];
        }
    }

    public function edit(Request $r)
    {
        $item = Calendar::find($r->calendar['id']);

        if ($item) {
            $item->update($r->calendar);
            return ['success' => true, 'message' => 'Бонус изменен'];
        } else {
            return ['success' => false, 'message' => 'Бонус не найден'];
        }
    }

    public function del(Request $r)
    {
        $item = Calendar::find($r->id);

        if ($item) {
            $item->delete();
            return ['type' => 'success', 'message' => 'Бонус удален'];
        } else {
            return ['type' => 'error', 'message' => 'Бонус не найден'];
        }
    }
}
