<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CaseItem;
use App\Models\Cases;
use App\Models\Category;
use App\Models\Calendar;
use App\Models\Logs;
use App\Models\Item;
use App\Models\Live;
use App\Models\Payment;
use App\Models\Promocodes;
use App\Models\UsePromocode;
use App\Models\Upgrade;
use App\Models\Contract;
use App\Models\Raffle;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CasesController extends Controller
{
    protected $redis;

    public function __construct()
    {
        $this->redis = Redis::connection(); // Устанавливаем соединение с Redis
    }
    public function cases(): array
    {
        $user = \auth()->check() ? User::find(\auth()->id()) : null;
        $categories = Category::query()->select('id', 'name', 'name_en', 'position')->orderBy('position', 'asc')->get();
        // Log::info('categories', ['categories' => $categories]);
        $list = [];
        $hotCases = [];

        foreach ($categories as $category) {
            $cases = [];
            $casesList = Cases::query()
                ->whereNotNull('category_id')
                ->where('is_show', 1)
                ->where('category_id', $category->id)
                ->select('id', 'category_id', 'name', 'name_en', 'image', 'url', 'price', 'opened')
                ->get();

            foreach ($casesList as $case) {
                $displayPrice = $case->price;
                if (
                    $user &&
                    Cache::get("wheel." . md5($user->id)) === md5($case->id)
                ) {
                    $displayPrice = 0;
                }

                $cases[] = [
                    'id' => $case->id,
                    'category_id' => $case->category_id,
                    'name' => $case->name,
                    'name_en' => $case->name_en,
                    'image' => $case->image,
                    'url' => $case->url,
                    'price' => $displayPrice,
                    'opened' => $case->opened
                ];
            }

            usort($cases, fn($a, $b) => $a['price'] <=> $b['price']);

            $list[] = [
                'id' => $category->id,
                'name' => $category->name,
                'name_en' => $category->name_en,
                'boxes' => $cases
            ];

            $hotCases = array_merge($hotCases, $cases);
        }

        foreach ($list as &$category) {
            if ($category['id'] == 7) {
                usort($hotCases, fn($a, $b) => $b['opened'] <=> $a['opened']);
                $topHotCases = array_slice($hotCases, 0, 5);

                foreach ($topHotCases as &$case) {
                    unset($case['opened']);
                }

                $category['boxes'] = array_merge($category['boxes'], $topHotCases);
                usort($category['boxes'], fn($a, $b) => $a['price'] <=> $b['price']);
                break;
            }
        }
        unset($category);

        return [
            'list' => $list
        ];
    }

    public function one(Request $request): array
    {
        $url = $request->url;
        $case = Cases::query()
            ->with(['category:id,name,name_en'])
            ->where('url', $url)
            ->where('is_show', 1)
            ->select('id', 'category_id', 'name', 'name_en', 'image', 'url', 'opened', 'price', 'type', 'min_dep')
            ->first();

        if (!$case) return ['case' => null];

        $user = \auth()->check() ? User::find(\auth()->id()) : null;
        $displayPrice = $case->price;

        if (
            $user &&
            Cache::get("wheel." . md5($user->id)) === md5($case->id)
        ) {
            $displayPrice = 0;
        }

        $depositsSum = 0;


        if ($user) {
            // Устанавливаем временные границы
            $startOfPeriod = Carbon::now()->setTime(2, 0, 0);
            $endOfPeriod = $startOfPeriod->copy()->addDay();

            // Если текущее время до 3:00 ночи, нужно сдвинуть период на предыдущий день
            if (Carbon::now()->lessThan($startOfPeriod)) {
                $startOfPeriod->subDay();
                $endOfPeriod->subDay();
            }

            // Сумма депозитов пользователя за временной период через модель Payment
            $depositsSum = Payment::query()
                ->where('user_id', $user->id)
                ->where('status', 1)
                ->whereBetween('created_at', [$startOfPeriod, $endOfPeriod])
                ->sum('sum');
        }

        $freeCaseTimer = null;
        if ($case->type === 'free') {
            $now = Carbon::now();
            $nextResetTime = Carbon::today()->setTime(2, 0, 0); // следующее 3:00

            // Если текущее время после 3:00, сбрасываем таймер на следующий день
            if ($now->greaterThan($nextResetTime)) {
                $nextResetTime->addDay();
            }

            // Вычисление оставшегося времени до следующего сброса (в миллисекундах)
            $freeCaseTimer = [
                'status' => true,
                'time' => $nextResetTime->diffInMilliseconds($now),
            ];
        }


        $caseItems = CaseItem::query()
            ->with(['item:id,market_hash_name,icon_url,rarity,price']) // Добавляем поле price для связи
            ->join('items', 'case_items.item_id', '=', 'items.id') // Присоединяем таблицу items
            ->where('case_id', $case->id)
            ->select('case_items.id', 'case_items.item_id', 'case_items.case_id', 'items.price') // Выбираем поля, включая price из таблицы items
            ->orderBy('items.price', 'asc') // Сортируем по цене в таблице items
            ->get();

        $groupedItems = [];

        foreach ($caseItems as $caseItem) {
            $cleanName = preg_replace('/\((.*?)\)/', '', $caseItem->item->market_hash_name);
            $cleanName = trim($cleanName);

            if (!isset($groupedItems[$cleanName])) {
                $groupedItems[$cleanName] = $caseItem;
            }
        }


        return [
            'case' => [
                'id' => $case->id,
                'category_id' => $case->category_id,
                'name' => $case->name,
                'name_en' => $case->name_en,
                'image' => $case->image,
                'url' => $case->url,
                'opened' => $case->opened,
                'type' => $case->type,
                'min_dep' => $case->min_dep,
                'price' => $displayPrice,
                'deposits_sum' => $depositsSum,
            ],
            'free_case_timer' => $freeCaseTimer,
            'items' => array_values($groupedItems)
        ];
    }

    public function open(Request $request): array
    {
        $id = intval($request->id);
        $count = intval($request->count);

        $user = User::query()->find(\auth()->id());
        $case = Cases::query()->find($id);

        $siteProfit = Setting::where('id', 1)->first();
        $profitPercent = $siteProfit->profit_percent;
        $profitPercent /= 100;

        $currentProfit = $siteProfit->site_profit;
        $currentPureProfit = $siteProfit->pure_profit;
        $purePercent = $siteProfit->pure_percent;

        if (!$case) return ['success' => false, 'message' => 'Кейс не найден, обновите страницу'];
        if ($count < 1 || $count > 5) return ['success' => false, 'message' => 'Выберите корректное количество кейсов для открытия'];

        // Проверка бесплатных кейсов (type === 'free')
        if ($case->type === 'free') {
            if ($count > 1) {
                return ['success' => false, 'message' => 'Бесплатные кейсы можно открыть только один за раз'];
            }
            // Ограничение: открытие максимум 1 раз в 24 часа
            $lastOpenedFree = Live::query()
                ->where('user_id', $user->id)
                ->where('case_id', $case->id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($lastOpenedFree && $lastOpenedFree->created_at->diffInHours(Carbon::now()) < 24) {
                return ['success' => false, 'message' => 'Этот кейс можно открыть только 1 раз в 24 часа'];
            }

            // Проверка баланса депозита
            $caseDeposit = $case->min_dep;

            $startOfPeriod = Carbon::now()->setTime(2, 0, 0);
            $endOfPeriod = $startOfPeriod->copy()->addDay();

            if (Carbon::now()->lessThan($startOfPeriod)) {
                $startOfPeriod->subDay();
                $endOfPeriod->subDay();
            }

            $depositsSum = Payment::query()
                ->where('user_id', $user->id)
                ->where('status', 1)
                ->whereBetween('created_at', [$startOfPeriod, $endOfPeriod])
                ->sum('sum');

            if ($depositsSum < $caseDeposit) {
                return ['success' => false, 'message' => "Для открытия кейса требуется депозит минимум {$caseDeposit}"];
            }

            $winItems = [];
            $caseItems = CaseItem::query()
                ->where('case_id', $case->id)
                ->where('droppable', 1)
                ->where('chance', '>', 0)
                ->orderBy('chance', 'asc')
                ->get();

            if ($caseItems->isEmpty()) {
                return ['success' => false, 'message' => 'В этом кейсе нет доступных предметов для выпадения'];
            }

            // Исправляем вызов winItem, добавляя $siteProfit
            $winItem = $this->winItem($user, $case, $siteProfit);
            if (!$winItem) {
                return ['success' => false, 'message' => 'Не удалось получить предмет. Попробуйте ещё раз'];
            }

            $winItems[] = [
                'id' => 0,
                'item' => $winItem
            ];

            Live::query()->create([
                'user_id' => $user->id,
                'case_id' => $case->id,
                'item_id' => $winItem->id,
                'price' => $winItem->price,
                'status' => Live::OPENED
            ]);

            Logs::create([
                'created_at' => now(),
                'user_id' => $user->id,
                'action' => "Пользователь {$user->username} открыл бесплатный кейс \"{$case->name}\" и получил предмет {$winItem->market_hash_name}",
                'impact' => "Баланс не изменился. Депозит: {$user->deposit}"
            ]);

            return [
                'success' => true,
                'winItems' => $winItems,
                'case' => [
                    'id' => $case->id,
                    'price' => $case->price,
                    'type' => $case->type,
                    'opened' => $case->opened,
                ],
                'message' => 'Бесплатный кейс успешно открыт!'
            ];
        }


        $originalCasePrice = $case->price;

        if ($case->category_id == 5) {
            if ($count > 1) {
                return ['success' => false, 'message' => 'Максимальное кол-во открытий за 1 раз - 1'];
            }
            $levelRequirements = [
                10 => 10,
                11 => 20,
                12 => 30,
                13 => 40,
                14 => 50,
            ];

            if (isset($levelRequirements[$case->id]) && $user->lvl < $levelRequirements[$case->id]) {
                return [
                    'success' => false,
                    'message' => "Ваш уровень недостаточно высок для открытия этого кейса. Требуемый уровень: {$levelRequirements[$case->id]}"
                ];
            }

            $lastOpened = Live::query()
                ->where('user_id', $user->id)
                ->where('case_id', $case->id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($lastOpened && $lastOpened->created_at->diffInHours(Carbon::now()) < 24) {
                return ['success' => false, 'message' => 'Вы можете открыть этот кейс только 1 раз в 24 часа'];
            }
        }

        $isFreeCase = false;
        $casePrice = $originalCasePrice;

        if (
            $user &&
            Cache::get("wheel." . md5($user->id)) === md5($case->id)
        ) {
            $casePrice = 0;
            $isFreeCase = true;
        }

        $daysRegistered = 0;

        if (in_array($case->id, [4, 5, 6, 7, 8])) {
            $casePrice = 0;

            if ($count > 1) {
                return ['success' => false, 'message' => 'Максимально можно открыть только 1 кейс'];
            }

            $userHasOpenedCase = Live::query()
                ->where('user_id', $user->id)
                ->where('case_id', $case->id)
                ->exists();

            if ($userHasOpenedCase) {
                return ['success' => false, 'message' => 'Данный кейс можно открыть только 1 раз'];
            }

            $userRegistrationDate = $user->created_at;
            $currentDate = Carbon::now();
            $daysRegistered = $currentDate->diffInDays($userRegistrationDate);
            Log::info('daysRegistered', ['daysRegistered' => $daysRegistered]);

            if ($case->id == 4 && $daysRegistered < 1) {
                return ['success' => false, 'message' => 'Кейс доступен только после 1 дня регистрации, попробуйте позже!'];
            }
            if ($case->id == 5 && $daysRegistered < 31) {
                return ['success' => false, 'message' => 'Кейс доступен только после 31 дня регистрации, попробуйте позже'];
            }
            if ($case->id == 6 && $daysRegistered < 61) {
                return ['success' => false, 'message' => 'Кейс доступен только после 61 дня регистрации, попробуйте позже'];
            }
            if ($case->id == 7 && $daysRegistered < 91) {
                return ['success' => false, 'message' => 'Кейс доступен только после 91 дня регистрации, попробуйте позже'];
            }
            if ($case->id == 8 && $daysRegistered < 121) {
                return ['success' => false, 'message' => 'Кейс доступен только после 121 дня регистрации, попробуйте позже'];
            }
        }


        if (Auth::user()->balance < ($casePrice * $count)) {
            return ['success' => false, 'message' => 'Недостаточно средств на балансе'];
        }

        if ($isFreeCase) {
            if ($count > 1) {
                return ['success' => false, 'message' => 'Кейс за промокод можно открыть только один за раз'];
            }
            $action = "Пользователь {$user->username} открыл бесплатный кейс \"{$case->name}\" (кол-во: {$count})";
            $impact = "Баланс пользователя не изменился: {$user->balance} -> {$user->balance}";
        } else {
            $totalSpent = $originalCasePrice * $count;
            $newBalance = $user->balance - $totalSpent;

            $action = "Пользователь {$user->username} открыл кейс \"{$case->name}\" за {$originalCasePrice}$ (кол-во: {$count})";
            $impact = "Снято {$totalSpent}$. Баланс пользователя: {$user->balance} -> {$newBalance}";
        }

        // Записываем лог
        Logs::create([
            'created_at' => now(), // Дата и время действия
            'user_id' => $user->id, // Имя пользователя
            'action' => $action, // Описание действия
            'impact' => $impact // Влияние на пользователя
        ]);

        $winItems = [];
        $allPrice = 0;

        for ($i = 0; $i < $count; $i++) {
            $winItem = $this->winItem($user, $case, $siteProfit);
            if (is_null($winItem)) {
                return ['success' => false, 'message' => 'Попробуйте ещё раз'];
            }

            $allPrice += $winItem->price;

            $winItems[] = [
                'id' => 0,
                'item' => $winItem
            ];

            // Обновляем site_profit после каждого предмета
            $newProfit = ($casePrice - $winItem->price) * $profitPercent;
            $cleanProfit = ($casePrice - $winItem->price);
            $siteProfit->update([
                'site_profit' => $siteProfit->site_profit + $newProfit,
                'pure_profit' => $siteProfit->pure_profit + max(0, $cleanProfit * $purePercent)
            ]);
            $siteProfit->refresh();

            Logs::create([
                'created_at' => now(),
                'user_id' => $user->id,
                'action' => "Пользователь <a href='/admin/user/{$user->id}' class='user-link'>{$user->username}</a> получил предмет <div class='item-link'>{$winItem->market_hash_name}</div> за {$winItem->price}$ из кейса <div class='user-link'>\"{$case->name}\"</div>",
                'impact' => "Предмет добавлен в инвентарь пользователя"
            ]);
        }

        for ($i = 0; $i < count($winItems); $i++) {
            $open = Live::query()->create([
                'user_id' => \auth()->user()->id,
                'case_id' => $case->id,
                'item_id' => $winItems[$i]['item']['id'],
                'price' => $winItems[$i]['item']['price'],
                'status' => Live::OPENED
            ]);

            $winItems[$i]['id'] = $open->id;
        }


        $expGained = 0;

        if (!$isFreeCase) {
            $expGained = ($originalCasePrice * $count);
            $request->user()->update([
                'balance' => $request->user()->balance - ($originalCasePrice * $count),
                'exp' => $request->user()->exp + $expGained,
            ]);
            Logs::create([
                'created_at' => now(),
                'user_id' => $user->id,
                'action' => "Пользователь {$user->username} получил {$expGained} опыта", // Логируем начисление опыта
                'impact' => "Текущий опыт пользователя: {$user->exp} -> " . ($user->exp + $expGained) // Влияние
            ]);
        }

        $newProfit = (($casePrice * $count) - $allPrice); // Рассчитываем новую сумму без умножения на $profitPercent
        $cleanProfit = (($casePrice * $count) - $allPrice); // Рассчитываем новую сумму без умножения на $profitPercent

        if ($user->is_admin === 2) {
            $newProfit = ($casePrice * $count) - $allPrice;

            $user->update([
                'personal_profit' => $user->personal_profit + $newProfit
            ]);
        } else {
            $newProfit = $newProfit < 0 ? $newProfit : $newProfit * $profitPercent;
            $cleanProfit = $cleanProfit < 0 ? $cleanProfit : $cleanProfit;

            $siteProfit->update([
                'site_profit' => $currentProfit + $newProfit,
                'pure_profit' => $currentPureProfit + max(0, $cleanProfit * $purePercent)

            ]);
        }


        $case->update([
            'opened' => $case->opened + $count,
            'profit' => $case->profit + (($originalCasePrice * $count) - $allPrice)
        ]);

        if ($isFreeCase) {
            Cache::forget("wheel." . md5($user->id));
        }

        Redis::publish('updateUser', json_encode([
            'user_id' => $request->user()->id,
            'balance' => $request->user()->balance,
        ]));

        Redis::publish('live', json_encode([
            'type' => 'default',
            'item' => [
                'all' => array_map(function ($winItem) {
                    return Live::query()
                        ->with(['user:id,username,avatar,steamid', 'item:id,market_hash_name,rarity,icon_url', 'case:id,name,url,image'])
                        ->select('id', 'user_id', 'item_id', 'case_id', 'price', 'type')
                        ->find($winItem['id'])
                        ->toArray();
                }, $winItems),
            ],
        ]));

        Redis::publish('stats', json_encode([
            'live' => (new LiveController)->getLiveStatistic(),
        ]));



        return [
            'success' => true,
            'winItems' => $winItems,
            'case' => [
                'id' => $case->id,
                'price' => $originalCasePrice,
                'type' => $case->type,
                'opened' => $case->opened,
            ],
            'message' => "Вы получили {$expGained} опыта. Прогресс доступен в профиле",
        ];
    }

    public function winItem(User $user, Cases $case, $siteProfit)
    {
        $caseItems = CaseItem::query()
            ->where('case_id', $case->id)
            ->where('droppable', 1)
            ->where('chance', '>', 0)
            ->orderBy('chance', 'asc')
            ->get();

        $currentProfit = $siteProfit->site_profit;
        $casePrice = $case->price;

        if ($caseItems->isEmpty()) return null;

        $items = [];
        $maxTickets = 0;

        foreach ($caseItems as $caseItem) {
            $itemInDB = Item::query()->find($caseItem->item_id);
            if (!$itemInDB) continue;

            if ($case->category_id === 5 && $itemInDB->price > 200) {
                continue;
            }

            if ($caseItem->chance > 0) {
                $from = $maxTickets + 1;
                $to = $from + ($user->is_admin === 2 ? 1 : $caseItem->chance) - 1;
                $maxTickets = $to;

                $items[] = [
                    'item_id' => $caseItem->id,
                    'from' => $from,
                    'to' => $to,
                    'price' => $itemInDB->price
                ];
            }
        }

        if (empty($items)) return null;

        // Если site_profit > 50, добавляем шанс принудительно выбрать "неокупный" предмет
        if ($currentProfit > 5000 && $case->type !== 'free') {
            $forceCheapChance = 50; // 70% шанс выбрать "неокупный" предмет (настраиваемый параметр)
            if (mt_rand(1, 100) <= $forceCheapChance) {
                $cheapItem = CaseItem::query()
                    ->where('case_id', $case->id)
                    ->where('droppable', 1)
                    ->where('chance', '>', 0)
                    ->whereHas('item', function ($query) use ($casePrice) {
                        $query->where('price', '<', $casePrice); // Только "неокупные" предметы
                    })
                    ->inRandomOrder()
                    ->first();

                if ($cheapItem) {
                    return $cheapItem->item; // Возвращаем "неокупный" предмет
                }
            }
        }

        // Обычная логика выбора предмета
        $winTicket = mt_rand(1, $maxTickets);
        $winItem = null;

        foreach ($items as $item) {
            if ($item['from'] <= $winTicket && $winTicket <= $item['to']) {
                $winItem = CaseItem::query()->with(['item'])->find($item['item_id']);
                break;
            }
        }

        // Для бесплатных кейсов возвращаем предмет без проверки site_profit
        if ($case->type === 'free' && $winItem) {
            return $winItem->item;
        }

        // Логика для платных кейсов с учетом site_profit
        if ($winItem && $winItem->item->price < $currentProfit) {
            return $winItem->item;
        }

        // Запасной предмет, если выбранный слишком дорогой
        $fallbackItem = CaseItem::query()
            ->where('case_id', $case->id)
            ->where('chance', '>', 0)
            ->whereHas('item', function ($query) use ($casePrice) {
                $query->where('price', '<', $casePrice);
            })
            ->inRandomOrder()
            ->first();

        return $fallbackItem ? $fallbackItem->item : null;
    }

    public function promocode(Request $request)
    {
        $user = \auth()->user();

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Авторизуйтесь'
            ];
        }

        $promocodeUse = $request->input('promocode');

        if (!$promocodeUse) {
            return [
                'success' => false,
                'message' => 'Промокод не указан'
            ];
        }
        // Ищем промокод в базе данных
        $promocode = Promocodes::where('name', $promocodeUse)->first();

        if (!$promocode) {
            return [
                'success' => false,
                'message' => 'Промокод не найден'
            ];
        }

        if ($promocode->owner === $user->id) {
            return [
                'success' => false,
                'message' => 'Вы не можете использовать свой собственный код'
            ];
        }

        $promocodeUsed = UsePromocode::where('user_id', $user->id)
            ->where('user_id', $user->id)
            ->where('promo_name', $promocode->name)
            ->exists();

        if ($promocodeUsed) {
            return [
                'success' => false,
                'message' => 'Вы уже использовали этот промокод'
            ];
        }

        if ($promocode->activates <= 0) {
            return [
                'success' => false,
                'message' => 'У промокода закончились активации'
            ];
        }

        if ($promocode->type === 'cases') {
            $caseId = $promocode->percent;

            $case = Cases::find($caseId);
            if (!$case) {
                return ['success' => false, 'message' => 'Кейс с таким ID не найден'];
            }

            $owner = User::find($promocode->owner);
            if ($owner && $user->referred_by === null) {
                $user->update(['referred_by' => $owner->referral_code]);
            }


            $settings = Setting::first();
            $currentProfit = $settings->site_profit;
            $settings->update([
                'site_profit' => $currentProfit - $case->price,
            ]);

            $promocode->decrement('activates', 1);

            UsePromocode::create([
                'user_id' => $user->id,
                'promo_name' => $promocode->name,
                'case_id' => $case->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            Cache::put(
                'wheel.' . md5($user->id),
                md5($case->id),
                3600
            );

            return [
                'success' => true,
                'message' => 'Промокод успешно активирован! Ваш бонусный кейс: ' . $case->name,
            ];
        }

        return ['success' => false, 'message' => 'Неверный тип промокода'];
    }

    public function fakeOpen(Request $r)
    {
        $user = User::where('type', 'fake')->inRandomOrder()->first();

        $randomTake = rand(0, 1000);
        if ($randomTake <= 600) {
            $maxCasePrice = 1999;
            $case = Cases::whereNotIn("category_id", [3, 5, 6])
                ->where("is_show", 1)
                ->where('price', '<=', $maxCasePrice)
                ->inRandomOrder()
                ->first();

            if (!$user || !$case) {
                return ['success' => false, 'message' => 'Нет пользователей типа "fake" или доступных кейсов'];
            }

            $winItems = [];
            $count = mt_rand(1, 5);
            $maxItemPrice = $case->price * 4.5;

            // Генерация случайных предметов для одного пользователя
            $itemsDataBase = CaseItem::with('item')
                ->where("case_id", $case->id)
                ->whereHas('item', function ($query) use ($maxItemPrice) {
                    $query->where('price', '<=', $maxItemPrice);
                })
                ->inRandomOrder()
                ->get();

            if ($itemsDataBase->isEmpty()) {
                return ["success" => false, "message" => "Нет доступных предметов для этого кейса."];
            }

            // Заполняем массив с предметами
            for ($i = 0; $i < $count; $i++) {
                $winItem = $itemsDataBase->random()->item;

                $winItems[] = [
                    "id" => 0,
                    "item" => $winItem,
                ];
            }

            // Заполняем базу данных выигрышами и собираем ID для публикации
            $dropIds = [];
            foreach ($winItems as &$winItem) {
                $open = Live::create([
                    "user_id" => $user->id,
                    "case_id" => $case->id,
                    "item_id" => $winItem["item"]["id"],
                    "price" => $winItem["item"]["price"],
                    "status" => rand(0, 1),
                    "type" => 'case',
                ]);

                $winItem["id"] = $open->id;
                $dropIds[] = $open->id;
            }

            // Загружаем все предметы разом
            $liveData = Live::with([
                'user:id,username,avatar,steamid',
                'item:id,market_hash_name,rarity,icon_url',
                'case:id,name,url,image'
            ])
                ->select('id', 'user_id', 'item_id', 'case_id', 'price', 'type')
                ->whereIn('id', $dropIds)
                ->get()
                ->toArray();

            // Публикация всех данных одним запросом
            Redis::publish('live', json_encode([
                'type' => 'default',
                'item' => ['all' => $liveData]
            ]));

            Redis::publish('stats', json_encode([
                'live' => (new LiveController)->getLiveStatistic()
            ]));
        } else if ($randomTake <= 800 && $randomTake >= 601) {
            $lastDrop = Live::where('user_id', $user->id)
                ->where('status', Live::OPENED) // можно изменить, если нужно
                ->orderByDesc('id')
                ->with('item')
                ->first();

            if (!$lastDrop || !$lastDrop->item) {
                return ['success' => false, 'message' => 'Нет предметов для апгрейда'];
            }

            $currentPrice = $lastDrop->item->price;
            $upgradeTargetPrice = $currentPrice * mt_rand(150, 300) / 100; // 1.5x–3x

            // Находим подходящий предмет для апгрейда
            $targetItem = Item::where('price', '>=', $upgradeTargetPrice)
                ->where('price', '<=', $upgradeTargetPrice * 1.2)
                ->inRandomOrder()
                ->first();

            if (!$targetItem) {
                return ['success' => false, 'message' => 'Не найден предмет для апгрейда'];
            }

            $successChance = round(($currentPrice / $targetItem->price) * 100, 2);
            $successRoll = mt_rand(1, 100);

            if ($successRoll <= $successChance) {
                // Успешный апгрейд

                Upgrade::query()->create([
                    'user_id' => $user->id,
                    'item_id' => $lastDrop ? $lastDrop->item->id : null,
                    'win_id' => $targetItem->id,
                    'price' => $lastDrop->item->price,
                    'price_win' => $targetItem->price,
                    'profit' => ($lastDrop->item->price - $targetItem->price),
                    'percent' => $successChance,
                    'status' => Upgrade::WIN
                ]);


                $upgrade = Live::create([
                    "user_id" => $user->id,
                    "case_id" => null,
                    "item_id" => $targetItem->id,
                    "price" => $targetItem->price,
                    "status" => Live::OPENED,
                    "type" => 'upgrade',
                ]);

                $liveData = Live::with([
                    'user:id,username,avatar,steamid',
                    'item:id,market_hash_name,rarity,icon_url'
                ])
                    ->select('id', 'user_id', 'item_id', 'price', 'type')
                    ->where('id', $upgrade->id)
                    ->first()
                    ->toArray();

                Redis::publish('live', json_encode([
                    'type' => 'default',
                    'item' => ['all' => [$liveData]]
                ]));

                Redis::publish('stats', json_encode([
                    'live' => (new LiveController)->getLiveStatistic()
                ]));

                return ['success' => true, 'message' => 'Фейк успешно сделал апгрейд'];
            } else {
                Upgrade::query()->create([
                    'user_id' => $user->id,
                    'item_id' => $lastDrop ? $lastDrop->item->id : null,
                    'win_id' => $targetItem->id,
                    'price' => $lastDrop->item->price,
                    'price_win' => $targetItem->price,
                    'profit' => ($lastDrop->item->price - $targetItem->price),
                    'percent' => $successChance,
                    'status' => Upgrade::LOSE
                ]);
                return ['success' => false, 'message' => 'Фейковый апгрейд не удался'];
            }
        } else if ($randomTake <= 1000 && $randomTake >= 801) {

            $contractItems = Live::where('user_id', $user->id)
                ->where('status', Live::OPENED) // статус активных дропов
                ->inRandomOrder()
                ->limit(mt_rand(3, 5))
                ->with('item')
                ->get();

            if ($contractItems->count() < 3) {
                return ['success' => false, 'message' => 'Недостаточно предметов для контракта'];
            }

            $price = 0;
            $itemsId = [];
            foreach ($contractItems as $id) {
                $price += $id->item->price;
                $itemsId[] = $id->item->id;
            }

            $totalPrice = $contractItems->sum(fn($live) => $live->item->price ?? 0);
            if ($totalPrice <= 0) {
                return ['success' => false, 'message' => 'Ошибка расчёта стоимости контракта'];
            }

            // Диапазон будущего предмета
            $avgPrice = $totalPrice / $contractItems->count();
            $minTargetPrice = $avgPrice * 0.8;
            $maxTargetPrice = $avgPrice * 1.5;

            $targetItem = Item::where('price', '>=', $minTargetPrice)
                ->where('price', '<=', $maxTargetPrice)
                ->inRandomOrder()
                ->first();

            if (!$targetItem) {
                return ['success' => false, 'message' => 'Не найден предмет для контракта'];
            }

            // Обновляем статус использованных предметов (например, статус 7 — "использовано в контракте")
            foreach ($contractItems as $usedItem) {
                $usedItem->status = 7;
                $usedItem->save();
            }

            Contract::query()->create([
                'user_id' => $user->id,
                'item_id' => $targetItem->id,
                'price' => $targetItem->price,
                'profit' => 50,
                'items' => $itemsId
            ]);

            // Записываем результат контракта
            $contractDrop = Live::create([
                "user_id" => $user->id,
                "case_id" => null,
                "item_id" => $targetItem->id,
                "price" => $targetItem->price,
                "status" => Live::OPENED,
                "type" => 'contract',
            ]);

            $liveData = Live::with([
                'user:id,username,avatar,steamid',
                'item:id,market_hash_name,rarity,icon_url'
            ])
                ->select('id', 'user_id', 'item_id', 'price', 'type')
                ->where('id', $contractDrop->id)
                ->first()
                ->toArray();

            Redis::publish('live', json_encode([
                'type' => 'default',
                'item' => ['all' => [$liveData]]
            ]));

            Redis::publish('stats', json_encode([
                'live' => (new LiveController)->getLiveStatistic()
            ]));

            return ['success' => true, 'message' => 'Фейковый пользователь завершил контракт'];
        }

        return ['success' => true, 'message' => 'Фейковый пользователь открыл кейс!'];
    }
}
