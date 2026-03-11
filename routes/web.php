<?php

use App\Http\Controllers\Api\Auth\GeneralController;
use App\Http\Controllers\Api\Auth\SteamController;
use App\Http\Controllers\Api\Auth\TelegramController;
use App\Http\Controllers\Api\CasesController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\ContractsController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\LiveController;
use App\Http\Controllers\Api\LiveTradesController;
use App\Http\Controllers\Api\MarketCSGOApi\MarketController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ReferralController;
use App\Http\Controllers\Api\UpgradeController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\WheelController;
use App\Http\Controllers\Api\BonusController;
use App\Http\Controllers\Api\CalendarController;
use App\Http\Controllers\Api\MissionsController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\RaffleHourController;
use App\Http\Controllers\Api\RaffleDayController;
use App\Http\Controllers\Api\RaffleWeekController;
use App\Http\Controllers\Api\KnifeGameController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/api')->group(function () {

    Route::middleware('admin')->group(function () {
        require 'admin.php';
    });

    Route::prefix('/user')->group(function () {
        Route::controller(UsersController::class)->group(function () {
            Route::get('/get', 'getUser');
            Route::post('/profile', 'profile');
            Route::post('/profile-other', 'getProfile');
            Route::get('/profile-other/history', 'getProfileHistory');
            Route::get('/profile/history', 'getUserHistory');
            Route::post('/profile/sale-items/get', 'getItemsForSale');
            Route::post('/update-trade-link', 'tradeLinkSave');
            Route::post('/getItems', 'getSimilarItems');
            Route::post('/replace', 'replaceItem');
            Route::get('/deposit/stats', 'depositStats');

            Route::post('/guest', 'user');
            Route::post('/logout', 'logout');
        });

        Route::prefix('/items')->group(function () {
            Route::post('/sell', [UsersController::class, 'sellItems']);
            Route::post('/sell/case', [UsersController::class, 'sellItemsCase']);
            Route::post('/sellItem', [UsersController::class, 'sell']);
            Route::post('/withdraw', [MarketController::class, 'withdraw']);
        });
    });

    Route::group(['prefix' => '/bot', 'middleware' => 'bot'], function () {
        Route::post('/RaffleNew', [RaffleHourController::class, 'RaffleNew']);
        Route::post('/RaffleDayNew', [RaffleDayController::class, 'RaffleNew']);
        Route::post('/RaffleWeekNew', [RaffleWeekController::class, 'RaffleNew']);
        Route::post('/RaffleWeekNew', [RaffleWeekController::class, 'RaffleNew']);
        Route::post('/fakeOpen', [CasesController::class, 'fakeOpen']);
        Route::any('/market', [MarketController::class, 'updateItemsPricesMarket']);
    });



    Route::controller(CalendarController::class)->prefix('/calendar')->group(function () {
        Route::get('/get', 'get');
        Route::post('/claim-bonus', 'claimBonus');
    });

    Route::controller(CasesController::class)->prefix('/case')->group(function () {
        Route::get('/getAll', 'cases');
        Route::get('/one', 'one');
        Route::post('/open', 'open');
        Route::post('/promocode', 'promocode');
    });

    Route::controller(BonusController::class)->prefix('/bonus')->group(function () {
        Route::post('/claim-bonus', 'claimBonus');
        Route::post('/getBonusHistory', 'getBonusHistory');
        Route::post('/subscription/{socialNetwork}', 'claimSubscriptionBonus');
    });

    Route::controller(WheelController::class)->prefix('/wheel')->group(function () {
        Route::post('/get', 'wheelItems');
        Route::post('/open', 'wheelOpen');
    });

    Route::controller(ContractsController::class)->prefix('/contracts')->group(function () {
        Route::post('/create', 'create');
        Route::get('/user/items', 'userItems');
        Route::get('/settings', 'getSettings');
    });

    Route::controller(UpgradeController::class)->prefix('/upgrades')->group(function () {
        Route::get('/user/items', 'loadItems');
        Route::post('/site/items', 'loadSiteItems');
        Route::post('/create', 'create');
    });

    Route::controller(KnifeGameController::class)->prefix('/knife-game')->group(function () {
        Route::post('/start', 'start');
        Route::post('/reveal', 'reveal');
        Route::post('/cashout', 'cashout');
        Route::get('/history', 'history');
        Route::get('/top', 'topWins');
    });

    Route::controller(MissionsController::class)->prefix('/missions')->group(function () {
        Route::get('/get', 'index');
        Route::post('/complete', 'complete');
    });

    Route::controller(NotificationController::class)->prefix('/notification')->group(function () {
        Route::get('/get', 'load');
    });

    Route::controller(RaffleHourController::class)->prefix('/raffle/hour')->group(function () {
        Route::post('/get', 'getRaffle');
        Route::post('/open', 'RaffleOpen');
    });

    Route::controller(RaffleDayController::class)->prefix('/raffle/day')->group(function () {
        Route::post('/get', 'getRaffle');
        Route::post('/open', 'RaffleOpen');
    });
    Route::controller(RaffleWeekController::class)->prefix('/raffle/week')->group(function () {
        Route::post('/get', 'getRaffle');
        Route::post('/open', 'RaffleOpen');
    });

    Route::get('/settings', [MainController::class, 'settings']);
    Route::get('/live', [LiveController::class, 'updateLiveElements']);
    Route::get('/live/statistic', [LiveController::class, 'getLiveStatistic']);
    Route::get('/live/dailyPromo', [LiveController::class, 'generatePromocodes']);
    Route::post('/checkItems', [MarketController::class, 'checkItems']);

    Route::controller(ReferralController::class)->prefix('/referral')->group(function () {
        Route::get('/get', 'get');
        Route::post('/get/statistic', 'getStatistic');
        Route::post('/createCode', 'newRefCode');
        Route::post('/createCase', 'newCaseCode');
    });

    Route::controller(PaymentController::class)->prefix('/payment')->group(function () {
        Route::get('/get', 'get');
        Route::post('/promocode/approve', 'promoAccept');
        Route::post('/create/cryptocloud', 'cryptoCloud');
        Route::post('/create/betatransfer', 'betaTransfer');
        Route::post('/create/exnode', 'exnode');
        Route::post('/create/rukassa', 'rukassa');
        Route::post('/create/onePlat', 'onePlat');
        Route::post('/postback/rukassa', 'rukassa_postback');
        Route::post('/postback/oneplat', 'onePlat_callback');
        Route::post('/postback/cryptocloud', 'cryptoCloudCallback');
        Route::post('/postback/exnode', 'exnodeCallback');
        Route::post('/postback/betatransfer', 'beta_postback');
    });


    Route::get('/auth/steam', [SteamController::class, 'redirectToSteam']);
    Route::get('/auth/callback', [SteamController::class, 'handle']);
});

Route::get('/admin{any}', [MainController::class, 'admin'])->where('any', '.*')->middleware('admin');




Route::get('/{any}', [MainController::class, 'main'])->where('any', '.*');
