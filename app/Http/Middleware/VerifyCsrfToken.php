<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/api/admin/items/prices/steamp',
        '/api/checkItems',
        '/api/payment/postback',
        '/api/payment/postback/cryptocloud',
        '/api/payment/postback/betatransfer',
        '/api/payment/postback/exnode',
        '/api/payment/postback/rukassa',
        '/api/payment/postback/oneplat',
        '/api/wheel/setStatus',
        '/api/wheel/getGame',
        'api/wheel/startWheel',
        '/api/bot*',
        '/api/admin/raffle/hour/all',
        '/api/admin/raffle/day/all',
        '/api/admin/raffle/week/all',
        '/api/admin/wheel/load',
        '/api/admin/payment/load',
    ];
}
