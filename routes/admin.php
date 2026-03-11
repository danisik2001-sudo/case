<?php

use App\Http\Controllers\Api\Admin\BattleSwitchController;
use App\Http\Controllers\Api\Admin\CasesController;
use App\Http\Controllers\Api\Admin\CasesItemsController;
use App\Http\Controllers\Api\Admin\CategoriesController;
use App\Http\Controllers\Api\Admin\LevelsController;
use App\Http\Controllers\Api\Admin\PaymentsController;
use App\Http\Controllers\Api\Admin\SettingsController;
use App\Http\Controllers\Api\Admin\UsersController;
use App\Http\Controllers\Api\Admin\WithdrawsController;
use App\Http\Controllers\Api\Admin\LogsController;
use App\Http\Controllers\Api\Admin\PromocodesController;
use App\Http\Controllers\Api\Admin\NotificationController;
use App\Http\Controllers\Api\Admin\RaffleHourController;
use App\Http\Controllers\Api\Admin\RaffleDayController;
use App\Http\Controllers\Api\Admin\RaffleWeekController;
use App\Http\Controllers\Api\Admin\WithdrawsReferralController;
use App\Http\Controllers\Api\Admin\WithdrawSystemsController;
use App\Http\Controllers\Api\Admin\CalendarController;
use App\Http\Controllers\Api\Admin\WheelController;
use App\Http\Controllers\Api\Admin\PaymentMethodsController;
use App\Http\Controllers\Api\CSGOBackPackApi\ItemsController;
use App\Http\Controllers\Api\MarketCSGOApi\MarketController;
use App\Models\Payment;
use \Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function () {

    Route::get('/user/get', [UsersController::class, 'getUser']);

    Route::prefix('/cases')->group(function () {
        Route::controller(CasesController::class)->group(function () {
            Route::get('/load', 'load');
            Route::post('/get', 'get');
            Route::post('/edit', 'edit');
            Route::post('/create', 'create');
            Route::post('/delete', 'delete');
        });

        Route::prefix('/items')->group(function () {
            Route::controller(CasesItemsController::class)->group(function () {
                Route::post('/load', 'load');
                Route::post('/create', 'create');
                Route::post('/get', 'get');
                Route::post('/edit', 'edit');
                Route::post('/delete', 'delete');
                Route::get('/all', 'all');
                Route::post('/calc', 'calc_chance');
                Route::post('/generate', 'generateCaseItems');
            });
        });
    });

    Route::controller(CategoriesController::class)->prefix('/categories')->group(function () {
        Route::post('/load', 'load');
        Route::post('/get', 'get');
        Route::post('/edit', 'edit');
        Route::post('/create', 'create');
        Route::post('/del', 'delete');
    });

    Route::controller(UsersController::class)->prefix('/users')->group(function () {
        Route::get('/load', 'load');
        Route::post('/get', 'get');
        Route::post('/save', 'save');
        Route::post('/give', 'giveDrop');
        Route::post('/create', 'create');
    });


    Route::controller(\App\Http\Controllers\Api\Admin\ItemsController::class)->prefix('/items')->group(function () {
        Route::get('/load', 'load');
        Route::post('/create', 'create');
        Route::post('/get', 'get');
        Route::post('/edit', 'edit');
        Route::post('/delete', 'delete');
    });

    Route::controller(PaymentsController::class)->prefix('/payments')->group(function () {
        Route::post('/load', 'load');
        Route::post('/delete', 'delete');
        Route::post('/create', 'create');
    });

    Route::controller(WithdrawsController::class)->prefix('/withdraws')->group(function () {
        Route::get('/load', 'load');
    });

    Route::controller(RaffleHourController::class)->prefix('/raffle/hour')->group(function () {
        Route::post('/load', 'load');
        Route::post('/create', 'create');
        Route::post('/get', 'get');
        Route::post('/del', 'del');
        Route::post('/all', 'all');
    });
    Route::controller(RaffleDayController::class)->prefix('/raffle/day')->group(function () {
        Route::post('/load', 'load');
        Route::post('/create', 'create');
        Route::post('/get', 'get');
        Route::post('/del', 'del');
        Route::post('/all', 'all');
    });
    Route::controller(RaffleWeekController::class)->prefix('/raffle/week')->group(function () {
        Route::post('/load', 'load');
        Route::post('/create', 'create');
        Route::post('/get', 'get');
        Route::post('/del', 'del');
        Route::post('/all', 'all');
    });

    Route::controller(WheelController::class)->prefix('/wheel')->group(function () {
        Route::post('/load', 'load');
        Route::post('/get', 'get');
        Route::post('/edit', 'edit');
    });
    Route::controller(PaymentMethodsController::class)->prefix('/payment')->group(function () {
        Route::post('/load', 'load');
        Route::post('/get', 'get');
        Route::post('/edit', 'edit');
    });

    Route::controller(PromocodesController::class)->prefix('/promocodes')->group(function () {
        Route::post('/load', 'load');
        Route::post('/create', 'create');
        Route::post('/get', 'get');
        Route::post('/edit', 'edit');
        Route::post('/del', 'del');
    });

    Route::controller(NotificationController::class)->prefix('/notification')->group(function () {
        Route::post('/load', 'load');
        Route::post('/create', 'create');
        Route::post('/get', 'get');
        Route::post('/edit', 'edit');
        Route::post('/del', 'del');
    });

    Route::controller(CalendarController::class)->prefix('/calendar')->group(function () {
        Route::post('/load', 'load');
        Route::post('/create', 'create');
        Route::post('/get', 'get');
        Route::post('/edit', 'edit');
        Route::post('/del', 'del');
    });

    Route::controller(LogsController::class)->prefix('/logs')->group(function () {
        Route::post('/load', 'load');
    });





    Route::controller(SettingsController::class)->prefix('/settings')->group(function () {
        Route::post('/load', 'load');
        Route::post('/save', 'save');
        Route::get('/online-multiplied', 'getMultipliedOnline');
    });

    Route::get('/stats', [SettingsController::class, 'statistic']);
    Route::get('/market/balance', [SettingsController::class, 'getBalance']);

    // Parse items & prices
    Route::prefix('/items')->group(function () {
        Route::post('/steamp', [MarketController::class, 'updateItemsPricesSteamp']);
        Route::post('/market', [MarketController::class, 'updateItemsPricesMarket']);
        Route::post('/list', [MarketController::class, 'updateItemsList']);
    });
});
