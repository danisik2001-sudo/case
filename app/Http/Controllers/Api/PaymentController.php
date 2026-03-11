<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BattleSwitchLog;
use App\Models\Payment;
use App\Models\Promocodes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use App\Models\PaymentMethods;
use Illuminate\Support\Facades\Log;
use App\Models\Setting;
use GuzzleHttp\Client;

class PaymentController extends Controller
{

    public function get(Request $request): array
    {
        $currency = $request->currency;

        $paymentMethods = PaymentMethods::where('status', 1)
            ->whereIn('type', ['paymentMethods', 'cryptoMethods'])
            ->whereJsonContains('currency', $currency)
            ->get(['id', 'name', 'icon', 'apiUrl', 'min_dep', 'type', 'status']);

        // $cryptoMethods = PaymentMethods::where('status', 1)
        //     ->where('type', 'cryptoMethods')
        //     ->whereJsonContains('currency', $currency)
        //     ->get(['name', 'icon', 'apiUrl', 'min_dep', 'type', 'status']);

        return [
            'success' => true,
            'paymentMethods' => $paymentMethods,
            // 'cryptoMethods' => $cryptoMethods,
        ];
    }



    public function cryptoCloud(Request $request)
    {
        $apiKey = env('CRYPTO_CLOUD_API_KEY');
        $baseUrl = 'https://api.cryptocloud.plus/v2';
        $method_name = $request->method_name; // Например, "BTC" или "ETH"
        $sum = $request->sum;
        $promocode = $request->promocode;
        $amount = $sum;
        $currency = 'RUB';
        $shopId = env('CRYPTO_CLOUD_SHOP_ID');
        $order_id = time() . uniqid();

        $paymentMethod = PaymentMethods::where('name', $method_name)
            ->where('status', 1)
            ->first(['min_dep']);

        if (!$paymentMethod) {
            return [
                'success' => false,
                'message' => 'Метод оплаты не найден.'
            ];
        }

        $min_dep = $paymentMethod->min_dep;

        if ($sum < $min_dep) {
            return [
                'success' => false,
                'message' => 'Минимальный депозит по данному методу ' . $min_dep . " "
            ];
        }

        $promoResponse = $this->promoAccept($request);
        $invoicePromocode = $promoResponse['success'] ? $promocode : null;

        $newPayment = $request->user()->payments()->create([
            'type' => $method_name,
            'invoice' => $order_id,
            'promocode' => $invoicePromocode,
            'sum' => $sum,
            'description' => request()->getClientIp(true),
        ]);

        // Создаём переменную cryptocurrency и берём значение из method_name
        $cryptocurrency = $method_name;

        // Формируем postData с добавлением add_fields
        $postData = [
            'shop_id' => $shopId,
            'amount' => $amount,
            'currency' => $currency,
            'order_id' => $order_id,
            'add_fields' => [
                'cryptocurrency' => $cryptocurrency // Добавляем cryptocurrency в add_fields
            ]
        ];

        $response = Http::withHeaders([
            'Authorization' => "Token $apiKey",
        ])->post("{$baseUrl}/invoice/create", $postData);

        if ($response->successful()) {
            $data = $response->json();
            $url = $data['result']['link'];
            return [
                'success' => true,
                'message' => 'Переносим к оплате..',
                'url' => $url
            ];
        } else {
            Log::error('Ошибка от CryptoCloud:', [$response->status(), $response->body()]);
            return response()->json(['error' => 'Ошибка при создании инвойса', 'status' => $response->status()]);
        }
    }
    public function cryptoCloudCallback(Request $request)
    {
        $allowedIPs = ['35.233.203.43'];
        $userIP = request()->ip();

        if (!in_array($userIP, $allowedIPs)) {
            die('Hacking attempt!');
        }
        $data = $request->all();

        if ($request->status !== 'success') {
            die('Not payed');
        }

        $payment = Payment::where('invoice', $request->order_id)
            ->where('status', Payment::WAITING)
            ->first();

        if (!$payment) {
            die('Payment not found');
        }

        $promocode = $payment->promocode ? Promocodes::where('name', $payment->promocode)->first() : null;

        $settings = Setting::first();
        $currentProfit = $settings->site_profit;
        $cryptoBonus = ($payment->sum * 3) / 100;

        if ($promocode) {
            if ($promocode->activates > 0) {
                $promocode->decrement('activates');
            }

            $bonusPercent = $promocode->percent;
            $bonusAmount = ($payment->sum * $bonusPercent) / 100;

            $totalSum = $payment->sum + $bonusAmount + $cryptoBonus;

            // Снимаем бонус с профита сайта
            $newProfit = $currentProfit - $bonusAmount;

            $settings->update([
                'site_profit' => $newProfit,
            ]);

            $promocode->update([
                'total_deposit' => $promocode->total_deposit + $payment->sum,
            ]);

            if ($promocode->owner) {
                $refOwner = User::find($promocode->owner);

                if ($refOwner) {
                    $earningsPercent = $promocode->earnings_percent;
                    $refEarnings = ($payment->sum * $earningsPercent) / 100;

                    // Теперь отнимаем реферальные начисления от уже обновленного профита
                    $newProfit -= $refEarnings;

                    $settings->update([
                        'site_profit' => $newProfit,
                    ]);

                    $refOwner->update([
                        'referral_earned' => $refOwner->referral_earned + $refEarnings,
                        'balance' => $refOwner->balance + $refEarnings,
                    ]);
                }
            }
        } else {
            $totalSum = $payment->sum + $cryptoBonus;
        }

        $payment->update(['status' => Payment::PAYED]);

        $user = User::query()->where('id', $payment->user_id)->first();
        $user->update([
            'balance' => $user->balance + $totalSum
        ]);

        Redis::publish('notify', json_encode([
            'user_id' => $payment->user_id,
            'success' => true,
            'message' => 'Ваш баланс пополнен!'
        ]));

        die('Success');
    }

    public function exnode(Request $request)
    {
        $publicKey = env('EXNODE_PUBLIC_KEY');
        $privateKey = env('EXNODE_PRIVATE_KEY');
        $baseUrl = 'https://my.exnode.ru';
        $siteUrl = env('APP_URL');
        $method_name = (string)  $request->method_name;
        $sum = (float) $request->sum;
        $promocode = $request->promocode;
        $amount = $sum;
        $currency = 'USD';
        $order_id = (string) time() . uniqid();

        $paymentMethod = PaymentMethods::where('name', $method_name)
            ->where('status', 1)
            ->first(['min_dep']);

        if (!$paymentMethod) {
            return [
                'success' => false,
                'message' => 'Метод оплаты не найден.'
            ];
        }

        $min_dep = $paymentMethod->min_dep;

        if ($sum < $min_dep) {
            return [
                'success' => false,
                'message' => 'Минимальный депозит по данному методу ' . $min_dep . " "
            ];
        }

        $promoResponse = $this->promoAccept($request);
        $invoicePromocode = $promoResponse['success'] ? $promocode : null;

        $newPayment = $request->user()->payments()->create([
            'type' => $method_name,
            'invoice' => $order_id,
            'promocode' => $invoicePromocode,
            'sum' => $sum,
            // 'description' => request()->getClientIp(true),
            'description' => 'test',
        ]);

        $postData = [
            'token' => $method_name,
            'amount' =>  $sum,
            'fiat_currency' => (string) 'USD',
            'client_transaction_id' => $order_id,
            'payform' => true,
            'call_back_url' => (string) "{$siteUrl}/api/payment/postback/exnode",
            'payment_ratio_type' => (string)  'CRYPTO'
        ];


        $timestamp = (string) time();


        $requestBody = json_encode($postData);

        $sign = hash_hmac('sha512', $timestamp . $requestBody, $privateKey);


        $response = Http::withHeaders([
            'ApiPublic' => $publicKey,
            'Signature' => $sign,
            'Timestamp' => $timestamp,
        ])->post("{$baseUrl}/api/crypto/invoice/create", $postData);

        if ($response->successful()) {
            $data = $response->json();
            $url = $data['payment_url'];
            return [
                'success' => true,
                'message' => 'Переносим к оплате..',
                'url' => $url
            ];
        } else {
            Log::error('Ошибка от exnode:', [$response->status(), $response->body()]);
            return response()->json(['error' => 'Ошибка при создании инвойса', 'status' => $response->status()]);
        }
    }

    public function exnodeCallback(Request $request)
    {

        $data = $request->all();
        die('Success');
    }



    public function betaTransfer(Request $request): array
    {
        // Логируем информацию об аккаунте перед платежом
        // $accountInfo = $this->getBetaTransferPaymentSystems();

        // Входящие данные
        $method_name = $request->method_name;
        $sum = $request->sum;
        $promocode = $request->promocode;
        $order_id = time() . uniqid();
        $fullCallBack = 1;
        $token = env('BETATRANSFER_TOKEN');
        $secret = env('BETATRANSFER_SECRET');

        $paymentMethod = PaymentMethods::where('name', $method_name)
            ->where('status', 1)
            ->first(['min_dep', 'value']);

        if (!$paymentMethod) {
            return [
                'success' => false,
                'message' => 'Метод оплаты не найден.'
            ];
        }
        $currency = $paymentMethod->value;

        $min_dep = $paymentMethod->min_dep;

        if ($sum < $min_dep) {
            return [
                'success' => false,
                'message' => 'Минимальный депозит по данному методу ' . $min_dep . " "
            ];
        }

        $promoResponse = $this->promoAccept($request);
        $invoicePromocode = $promoResponse['success'] ? $promocode : null;

        $request->user()->payments()->create([
            'type' => $method_name,
            'invoice' => $order_id,
            'promocode' => $invoicePromocode,
            'sum' => $sum,
            'description' => request()->getClientIp(true),
        ]);

        $options = [
            'amount' => $sum,
            'currency' => $currency,
            'orderId' => $order_id,
            'fullCallback' => $fullCallBack,
            'paymentSystem' => $method_name,
        ];

        $options['sign'] = md5(implode("", $options) . $secret);

        $queryData = [
            'token' => $token,
        ];

        $client = new Client();
        $response = $client->post('https://merchant.betatransfer.io/api/payment?' . http_build_query($queryData), [
            'form_params' => $options
        ]);

        $responseData = json_decode($response->getBody(), true);

        if (
            isset($responseData['status']) && $responseData['status'] === 'success'
            && isset($responseData['urlPayment'])
        ) {
            return [
                'success' => true,
                'message' => 'Переносим к оплате..',
                'url' => $responseData['urlPayment']
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Ошибка переноса. Попробуйте позже.',
            ];
        }
    }

    public function beta_postback(Request $request)
    {
        $allowedIPs = ['188.34.194.128', '57.128.173.85'];
        $userIP = request()->ip();

        if (!in_array($userIP, $allowedIPs)) {
            die('Hacking attempt!');
        }
        $data = $request->all();

        if ($request->status !== 'success') {
            die('Not payed');
        }

        $payment = Payment::where('invoice', $request->orderId)
            ->where('status', Payment::WAITING)
            ->first();


        if (!$payment) {
            die('Payment not found');
        }

        $promocode = $payment->promocode ? Promocodes::where('name', $payment->promocode)->first() : null;
        $paidAmount = $request->paidAmount * $request->exchangeRate;
        $settings = Setting::first();
        $currentProfit = $settings->site_profit;

        if ($promocode) {
            if ($promocode->activates > 0) {
                $promocode->decrement('activates');
            }


            $bonusPercent = $promocode->percent;
            $bonusAmount = ($paidAmount * $bonusPercent) / 100;
            $totalSum = $paidAmount + $bonusAmount;


            $newProfit = $currentProfit - $bonusAmount;

            $settings->update([
                'site_profit' => $newProfit,
            ]);

            $promocode->update([
                'total_deposit' => $promocode->total_deposit + $paidAmount,
            ]);

            if ($promocode->owner) {
                $refOwner = User::find($promocode->owner);

                if ($refOwner) {
                    $earningsPercent = $promocode->earnings_percent;
                    $refEarnings = ($paidAmount * $earningsPercent) / 100;

                    $newProfit -= $refEarnings;

                    $settings->update([
                        'site_profit' => $newProfit,
                    ]);

                    $refOwner->update([
                        'referral_earned' => $refOwner->referral_earned + $refEarnings,
                        'balance' => $refOwner->balance + $refEarnings,
                    ]);
                }
            }
        } else {
            $totalSum = $paidAmount;
        }



        $payment->update([
            'status' => Payment::PAYED,
            'transaction_id' => $request->id
        ]);
        $user = User::query()->where('id', $payment->user_id)->first();

        $user->update([
            'balance' => $user->balance + $totalSum
        ]);


        Redis::publish('notify', json_encode([
            'user_id' => $payment->user_id,
            'success' => true,
            'message' => 'Ваш баланс пополнен!'
        ]));
        die('Success');
    }

    public function rukassa(Request $request): array
    {
        // Логируем информацию об аккаунте перед платежом
        // $accountInfo = $this->getBetaTransferPaymentSystems();

        // Входящие данные
        $method_name = $request->method_name;
        $promocode = $request->promocode;
        $shop_id = env('RUKASSA_SHOPID');
        $order_id = time() . uniqid();
        $sum = $request->sum;
        $token = env('RUKASSA_API');

        $paymentMethod = PaymentMethods::where('name', $method_name)
            ->where('status', 1)
            ->first(['min_dep', 'value']);

        if (!$paymentMethod) {
            return [
                'success' => false,
                'message' => 'Метод оплаты не найден.'
            ];
        }
        $currency = $paymentMethod->value;

        $min_dep = $paymentMethod->min_dep;

        if ($sum < $min_dep) {
            return [
                'success' => false,
                'message' => 'Минимальный депозит по данному методу ' . $min_dep . " "
            ];
        }

        $promoResponse = $this->promoAccept($request);
        $invoicePromocode = $promoResponse['success'] ? $promocode : null;

        $request->user()->payments()->create([
            'type' => $method_name,
            'invoice' => $order_id,
            'promocode' => $invoicePromocode,
            'sum' => $sum,
            'description' => request()->getClientIp(true),
        ]);

        $options = [
            'shop_id' => $shop_id,
            'order_id' => $order_id,
            'amount' => $sum,
            'token' => $token,
            'method' => $method_name,
            'user_code' => request()->getClientIp(true),
        ];

        $client = new Client();
        $response = $client->post('https://lk.rukassa.io/api/v1/create?' . http_build_query($options), [
            'form_params' => $options
        ]);

        $responseData = json_decode($response->getBody(), true);

        if (isset($responseData['url'])) {
            return [
                'success' => true,
                'message' => 'Переносим к оплате..',
                'url' => $responseData['url']
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Ошибка переноса. Попробуйте позже.',
            ];
        }
    }

    public function rukassa_postback(Request $request)
    {


        $data = $request->all();

        if ($request->status !== 'PAID') {
            die('Not payed');
        }

        $payment = Payment::where('invoice', $request->order_id)
            ->where('status', Payment::WAITING)
            ->first();


        if (!$payment) {
            die('Payment not found');
        }

        $promocode = $payment->promocode ? Promocodes::where('name', $payment->promocode)->first() : null;
        $paidAmount = $payment->sum;
        $settings = Setting::first();
        $currentProfit = $settings->site_profit;

        if ($promocode) {
            if ($promocode->activates > 0) {
                $promocode->decrement('activates');
            }


            $bonusPercent = $promocode->percent;
            $bonusAmount = ($paidAmount * $bonusPercent) / 100;
            $totalSum = $paidAmount + $bonusAmount;


            $newProfit = $currentProfit - $bonusAmount;

            $settings->update([
                'site_profit' => $newProfit,
            ]);

            $promocode->update([
                'total_deposit' => $promocode->total_deposit + $paidAmount,
            ]);

            if ($promocode->owner) {
                $refOwner = User::find($promocode->owner);

                if ($refOwner) {
                    $earningsPercent = $promocode->earnings_percent;
                    $refEarnings = ($paidAmount * $earningsPercent) / 100;

                    $newProfit -= $refEarnings;

                    $settings->update([
                        'site_profit' => $newProfit,
                    ]);

                    $refOwner->update([
                        'referral_earned' => $refOwner->referral_earned + $refEarnings,
                        'balance' => $refOwner->balance + $refEarnings,
                    ]);
                }
            }
        } else {
            $totalSum = $paidAmount;
        }



        $payment->update([
            'status' => Payment::PAYED,
        ]);
        $user = User::query()->where('id', $payment->user_id)->first();

        $user->update([
            'balance' => $user->balance + $totalSum
        ]);


        Redis::publish('notify', json_encode([
            'user_id' => $payment->user_id,
            'success' => true,
            'message' => 'Ваш баланс пополнен!'
        ]));
        die('Success');
    }

    public function onePlat(Request $request): array
    {
        $shopId = env('ONEPLAT_SHOP_ID'); // ваш x-shop
        $secret = env('ONEPLAT_SECRET'); // ваш x-secret
        $baseUrl = 'https://1plat.cash';

        // Входящие данные
        $method_name = $request->method_name;
        $promocode = $request->promocode;
        $merchantOrderId = time() . uniqid();
        $amount = $request->sum;

        $paymentMethod = PaymentMethods::where('name', $method_name)
            ->where('status', 1)
            ->first(['min_dep', 'value']);

        if (!$paymentMethod) {
            return [
                'success' => false,
                'message' => 'Метод оплаты не найден.'
            ];
        }
        $currency = $paymentMethod->value;

        $min_dep = $paymentMethod->min_dep;

        if ($amount < $min_dep) {
            return [
                'success' => false,
                'message' => 'Минимальный депозит по данному методу ' . $min_dep . " "
            ];
        }

        $promoResponse = $this->promoAccept($request);
        $invoicePromocode = $promoResponse['success'] ? $promocode : null;

        $request->user()->payments()->create([
            'type' => $method_name,
            'invoice' => $merchantOrderId,
            'promocode' => $invoicePromocode,
            'sum' => $amount,
            'description' => request()->getClientIp(true),
        ]);

        $sign = md5($shopId . ':' . $secret . ':' . $amount . ':' . $merchantOrderId);

        $options = [
            'merchant_order_id' => $merchantOrderId,
            'user_id' => $request->user()->id,
            'amount' => $amount,
            'email' => 'testuser@gmail.com',
            'method' => $method_name,
        ];

        $response = Http::withHeaders([
            'x-shop' => "$shopId",
            'x-secret' => "$secret",
        ])->post("{$baseUrl}/api/merchant/order/create/by-api", $options);

        if ($response->successful()) {
            $data = $response->json();
            $url = $data['url'];
            return [
                'success' => true,
                'message' => 'Переносим к оплате..',
                'url' => $url
            ];
        } else {
            Log::error('Ошибка от onePlat:', [$response->status(), $response->body()]);
            return response()->json(['error' => 'Ошибка при создании инвойса', 'status' => $response->status()]);
        }
    }

    public function onePlat_callback(Request $request)
    {
        $data = $request->all();
        Log::info($data);

        if ($request->status !== '0') {
            die('Not payed');
        }

        $payment = Payment::where('invoice', $request->merchant_id)
            ->where('status', Payment::WAITING)
            ->first();


        if (!$payment) {
            die('Payment not found');
        }

        $promocode = $payment->promocode ? Promocodes::where('name', $payment->promocode)->first() : null;
        $paidAmount = $payment->sum;
        $settings = Setting::first();
        $currentProfit = $settings->site_profit;

        if ($promocode) {
            if ($promocode->activates > 0) {
                $promocode->decrement('activates');
            }


            $bonusPercent = $promocode->percent;
            $bonusAmount = ($paidAmount * $bonusPercent) / 100;
            $totalSum = $paidAmount + $bonusAmount;


            $newProfit = $currentProfit - $bonusAmount;

            $settings->update([
                'site_profit' => $newProfit,
            ]);

            $promocode->update([
                'total_deposit' => $promocode->total_deposit + $paidAmount,
            ]);

            if ($promocode->owner) {
                $refOwner = User::find($promocode->owner);

                if ($refOwner) {
                    $earningsPercent = $promocode->earnings_percent;
                    $refEarnings = ($paidAmount * $earningsPercent) / 100;

                    $newProfit -= $refEarnings;

                    $settings->update([
                        'site_profit' => $newProfit,
                    ]);

                    $refOwner->update([
                        'referral_earned' => $refOwner->referral_earned + $refEarnings,
                        'balance' => $refOwner->balance + $refEarnings,
                    ]);
                }
            }
        } else {
            $totalSum = $paidAmount;
        }



        $payment->update([
            'status' => Payment::PAYED,
        ]);
        $user = User::query()->where('id', $payment->user_id)->first();

        $user->update([
            'balance' => $user->balance + $totalSum
        ]);


        Redis::publish('notify', json_encode([
            'user_id' => $payment->user_id,
            'success' => true,
            'message' => 'Ваш баланс пополнен!'
        ]));
        die('Success');
    }

    public function promoAccept(Request $request)
    {

        $user = $request->user();

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Авторизуйтесь'
            ];
        }

        $promocode = $request->promocode;

        $promoCheck = Promocodes::query()->where('name', $request->promocode)->first();

        if (!$promoCheck) {
            return [
                'success' => false,
                'message' => 'Промокод не найден'

            ];
        }

        if ($promoCheck->owner === $user->id) {
            return [
                'success' => false,
                'message' => 'Вы не можете использовать свой код'
            ];
        }

        if ($promoCheck->type !== 'percent') {
            return [
                'success' => false,
                'message' => 'Этот промокод не предназначен для депозита'
            ];
        }
        if ($promoCheck->activates <= 0) {
            return [
                'success' => false,
                'message' => 'У промокода закончились активации'
            ];
        }
        if ($promoCheck->type === 'percent') {
            return [
                'success' => true,
                'percent' => $promoCheck->percent,
                'message' => 'Ваш бонус ' . $promoCheck->percent . '% к депозиту'
            ];
        }
    }

    /**
     * @param array $array
     * @return string
     */
    public function createSign(array $array): string
    {
        return hash('sha256', implode(':', [$array]));
    }
}
