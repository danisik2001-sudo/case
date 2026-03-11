<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;
use function Symfony\Component\Translation\t;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    const REF_PERCENT_40 = 40;

    const REF_PAY_15 = 3;
    const REF_PAY_50 = 5;
    const REF_PAY_100 = 7;
    protected $fillable = [
        'username',
        'steamid',
        'avatar',
        'balance',
        'is_admin',
        'type',
        'level',
        'lvl',
        'exp',
        'personal_profit',
        'referral_code',
        'referral_earned',
        'referred_by',
        'trade_link',
        'block_withdraw',
        'blocked',
        'reg_ip',
        'last_ip',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function referredBy()
    {
        return $this->belongsTo(self::class, 'referral_code', 'referred_by');
    }

    public function referrals()
    {
        return $this->belongsTo(self::class, 'referred_by', 'referral_code');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }

    public function paymentsPayed(): HasMany
    {
        return $this->hasMany(Payment::class, 'user_id', 'id')->where('status', Payment::PAYED);
    }


    public function live(): HasMany
    {
        return $this->hasMany(Live::class)->orderBy('id', 'desc');
    }

    public function cases(): HasMany
    {
        return $this->live()->where('type', Live::CASE_TYPE);
    }

    public function upgrades(): HasMany
    {
        return $this->hasMany(Upgrade::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }
}
