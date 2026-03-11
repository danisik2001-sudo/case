<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use App\Models\RaffleHourItems;
use App\Models\RaffleDayItems;
use App\Models\RaffleWeekItems;

class Raffle extends Model
{

  protected $table = 'raffle';

  protected $fillable = [
    'win_user_id',
    'win_place',
    'places',
    'item_id',
    'status',
    'type',
    'created_at'
  ];

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'win_user_id', 'id');
  }

  public function item()
  {
    return $this->belongsTo('App\Models\Item', 'item_id', 'id');
  }

  public static function getActualHourRaffle()
  {
    // Ищем актуальный розыгрыш с типом 'hour' и статусом 0
    $getRaffle = Raffle::where('status', 0)
      ->where('type', 'hour')  // Добавлена проверка на тип 'hour'
      ->orderBy('id', 'desc')
      ->first();

    // Если розыгрыш не найден, создаем новый с типом 'hour'
    if (!$getRaffle) {
      $getRaffle = Raffle::create([
        'item_id' => RaffleHourItems::inRandomOrder()->first()->item_id,
        'places' => 1,
        'created_at' => Carbon::now()->startOfHour(), // Для точности
        'type' => 'hour', // Устанавливаем тип 'hour'
      ]);
    }

    return $getRaffle;
  }
  public static function getActualDayRaffle()
  {
    // Ищем актуальный розыгрыш с типом 'day' и статусом 0
    $getRaffle = Raffle::where('status', 0)
      ->where('type', 'day')  // Добавлена проверка на тип 'day'
      ->orderBy('id', 'desc')
      ->first();

    // Если розыгрыш не найден, создаем новый с типом 'day'
    if (!$getRaffle) {
      $getRaffle = Raffle::create([
        'item_id' => RaffleDayItems::inRandomOrder()->first()->item_id,
        'places' => 1,
        'created_at' => date('Y-m-d') . ' 10:00:00', // Устанавливаем время 13:00
        'type' => 'day', // Устанавливаем тип 'day'
      ]);
    }

    return $getRaffle;
  }

  public static function getActualWeekRaffle()
  {
    // Ищем актуальный розыгрыш с типом 'week' и статусом 0
    $getRaffle = Raffle::where('status', 0)
      ->where('type', 'week')  // Добавлена проверка на тип 'week'
      ->orderBy('id', 'desc')
      ->first();

    // Если розыгрыш не найден, создаем новый с типом 'week'
    if (!$getRaffle) {
      $getRaffle = Raffle::create([
        'item_id' => RaffleWeekItems::inRandomOrder()->first()->item_id,
        'places' => 1,
        'created_at' => date('Y-m-d') . ' 21:00:00', // Устанавливаем время 00:00 понедельника
        'type' => 'week', // Устанавливаем тип 'week'
      ]);
    }

    return $getRaffle;
  }


  public static function getItemInfo($id)
  {
    $item = Item::select('market_hash_name', 'icon_url', 'price', 'rarity')->where('id', $id)->get();


    return $item[0];
  }
}
