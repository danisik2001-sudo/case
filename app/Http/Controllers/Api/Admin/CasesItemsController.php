<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\CaseItem;
use App\Models\Cases;
use App\Models\Contract;
use App\Models\Item;
use App\Models\Live;
use App\Models\Upgrade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CasesItemsController extends Controller
{
    public function load(Request $request): array
    {
        $box = Cases::query()->find($request->id);

        if ($box) {
            return ['success' => true, 'box' => $box, 'items' => CaseItem::query()->with(['item'])->where('case_id', $box->id)->get()];
        }

        return ['success' => false];
    }

    public function create(Request $request): array
    {
        // if (!$request->chance) return ['success' => false, 'message' => 'Вы не указали шанс'];
        $chance = $request->chance ? intval($request->chance) : 100;


        CaseItem::query()->create([
            'case_id' => $request->case_id,
            'item_id' => intval($request->item_id),
            'chance' => $chance
        ]);

        return ['success' => true, 'message' => 'Предмет добавлен'];
    }

    public function get(Request $request): array
    {
        $item = CaseItem::with(['item'])->find($request->id);

        if ($item) {
            return ['success' => true, 'cases' => $item, 'item' => ['id' => $item->id, 'text' => $item->item->market_hash_name . ' (' . $item->item->price . '$)']];
        }

        return ['success' => false, 'message' => 'Данный предмет не найден'];
    }

    public function edit(Request $request): array
    {
        $item = CaseItem::query()->find($request->id);
        if (!$item) return ['success' => false, 'message' => 'Предмет не найден'];

        $item->update([
            'chance' => intval($request->chance)
        ]);

        return ['success' => true, 'message' => 'Шанс изменён'];
    }

    public function delete(Request $request): array
    {
        $item = CaseItem::query()->find($request->id);
        if (!$item) return ['success' => false, 'message' => 'Предмет не найден'];

        Live::query()->where('item_id', $item->id)->delete();
        Upgrade::query()->where('item_id', $item->id)->orWhere('win_id', $item->id)->delete();
        Contract::query()->where('item_id', $item->id)->delete();

        $item->delete();
        return ['success' => true, 'message' => 'Предмет удалён'];
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
    public function calc_chance(Request $request): array
    {
        $box = Cases::query()->find($request->id);
        if (!$box) {
            return ['success' => false, 'message' => 'Кейс не найден'];
        }

        $caseItems = CaseItem::query()->with(['item'])->where('case_id', $box->id)->get();
        $chances = [];

        foreach ($caseItems as $caseItem) {
            $itemPrice = $caseItem->item->price;
            if ($itemPrice <= 0) {
                $chance = 1;
            } else {
                // Вычисление шанса без округления
                $chance = ($box->price * 100) / $itemPrice;
                $chance = min(95, $chance); // максимальный шанс 100
                $chance = max(0.01, $chance); // минимальный шанс 1
            }

            $chances[] = [
                'item_id' => $caseItem->item->id,
                'market_hash_name' => $caseItem->item->market_hash_name,
                'price' => $itemPrice,
                'chance' => $chance,
            ];

            $caseItem->update(['chance' => $chance]);
        }

        return ['success' => true, 'chances' => $chances];
    }
    public function generateCaseItems(Request $request): array
    {
        $box = Cases::query()->find($request->id);
        if (!$box) {
            return ['success' => false, 'message' => 'Кейс не найден'];
        }

        $maxPrice = $box->price * 25;
        $minPrice = $box->price / 10;

        $items = Item::query()
            ->where('price', '>', 0)
            ->where('price', '<=', $maxPrice)
            ->where('price', '>=', $minPrice)
            ->get();

        if ($items->isEmpty()) {
            return ['success' => false, 'message' => 'Нет доступных предметов'];
        }

        // Настройки генерации
        $notProfitPercentage = 50; // % неокупных предметов
        $profitPercentage = 50; // % окупных предметов
        $totalItems = mt_rand(18, 25); // Количество предметов в кейсе

        $notProfitItems = $items->filter(fn($item) => $item->price < $box->price);
        $profitItems = $items->filter(fn($item) => $item->price >= $box->price);

        if ($notProfitItems->isEmpty() || $profitItems->isEmpty()) {
            return ['success' => false, 'message' => 'Некорректный баланс предметов'];
        }

        // Определяем количество окупных и неокупных предметов
        $notProfitCount = intval(($notProfitPercentage / 100) * $totalItems);
        $profitCount = $totalItems - $notProfitCount;

        // Выбираем случайные предметы
        $selectedNotProfit = $notProfitItems->random($notProfitCount);
        $selectedProfit = $profitItems->random($profitCount);

        // Итоговый список предметов
        $finalItems = $selectedNotProfit->merge($selectedProfit)->shuffle();

        CaseItem::where('case_id', $box->id)->delete();

        // Записываем предметы в таблицу CaseItem
        foreach ($finalItems as $item) {
            CaseItem::create([
                'case_id' => $box->id,
                'item_id' => $item->id,
                'price' => $item->price,
            ]);
        }


        return $this->calc_chance($request);
    }
}
