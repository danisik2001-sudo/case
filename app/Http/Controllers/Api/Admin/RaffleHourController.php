<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Item;
use App\Models\RaffleHourItems;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RaffleHourController extends Controller
{
  public function load(Request $r)
  {

    return ['success' => true, 'items' => RaffleHourItems::with(['item'])->get()];
  }

  public function create(Request $r)
  {
    if (!Item::find(intval($r->item_id)))  return ['type' => 'error', 'message' => 'Ошибка добавления. Обновите страницу.'];

    RaffleHourItems::create([
      'item_id' => intval($r->item_id)
    ]);

    return ['type' => 'success', 'message' => 'Предмет добавлен'];
  }

  public function get(Request $r)
  {
    $item = RaffleHourItems::with(['item'])->find($r->id);

    if ($item) {
      return ['success' => true, 'cases' => $item, 'item' => ['id' => $item->item_id, 'text' => $item->item->name . ' (' . $item->item->gold . ' з.)']];
    } else {
      return ['success' => false];
    }
  }


  public function del(Request $r)
  {
    $item = RaffleHourItems::find($r->id);

    if ($item) {
      $item->delete();
      return ['type' => 'success', 'message' => 'Предмет удален'];
    } else {
      return ['type' => 'error', 'message' => 'Предмет не найден'];
    }
  }

  public function all(Request $request): array
  {
    if ($request->search) {
      $pagination = Item::query()
        ->where('market_hash_name', 'LIKE', '%' . $request->search . '%')
        ->orWhere('price', 'LIKE', '%' . $request->search . '%')
        ->paginate(15);
    } else {
      $pagination = Item::query()->paginate(15);
    }
    $items = [];
    $more = true;

    if ($pagination->lastPage() === $pagination->currentPage()) $more = false;

    foreach ($pagination->items() as $item) {
      $items[] = [
        'id' => $item->id,
        'text' => $item->market_hash_name . ' (' . $item->price . '$)'
      ];
    }

    return [
      'results' => $items,
      'more' => $more
    ];
  }
}
