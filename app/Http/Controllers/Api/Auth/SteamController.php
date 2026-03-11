<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Invisnik\LaravelSteamAuth\SteamAuth;

class SteamController extends Controller
{
    /**
     * The SteamAuth instance.
     *
     * @var SteamAuth
     */
    protected $steam;

    /**
     * The redirect URL.
     *
     * @var string
     */
    protected $redirectURL = '/auth/callback';

    /**
     * AuthController constructor.
     *
     * @param SteamAuth $steam
     */
    public function __construct(SteamAuth $steam)
    {
        $this->steam = $steam;
    }

    /**
     * Redirect the user to the authentication page
     *
     * @return string
     */
    public function redirectToSteam()
    {
        return $this->steam->redirect();
    }

    public function handle()
    {
        session_start();

        if ($this->steam->validate()) {
            $info = $this->steam->getUserInfo();

            if (!is_null($info)) {
                $user = User::query()->where('steamid', $info->steamID64)->first();

                if ($user) {
                    $user->update([
                        'username' => $info->personaname,
                        'avatar' => $info->avatarfull,
                        'last_ip' => request()->getClientIp(true),
                    ]);
                } else {
                    $user = User::query()->create([
                        'username' => $info->personaname,
                        'steamid' => $info->steamID64,
                        'avatar' => $info->avatarfull,
                        'reg_ip' => request()->getClientIp(true),
                        'referral_code' => null,
                        'social' => 'steam',
                        'lvl' => '1',
                        'balance' => '0'

                    ]);
                }
                $token = $user->createToken('access_token')->plainTextToken;
                Auth::login($user, true);
                return redirect($this->redirectURL . '?token=' . $token);
            }

            return redirect($this->redirectURL);
        }

        return redirect($this->redirectURL);
    }
}
