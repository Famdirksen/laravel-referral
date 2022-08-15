<?php

namespace Famdirksen\LaravelReferral\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property int id
 * @property string referralable_type
 * @property int referralable_id
 * @property string name
 * @property string token
 *
 * @method static referralTokenExists($token)
 * @method static byReferralToken($token)
 */
class ReferralAccount extends Model
{
    protected $table = 'referral_accounts';

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $referralAccount) {
            $referralAccount->token = self::generateReferralToken();
        });
    }

    // Relations
    public function referrals()
    {
        return $this->hasMany(Referral::class, 'referral_account_id', 'id');
    }

    // Scopes
    public static function scopeReferralTokenExists(Builder $query, $token)
    {
        return $query->where('token', $token)
            ->exists();
    }

    public static function scopeByReferralToken(Builder $query, $token)
    {
        return $query->where('token', $token)
            ->first();
    }

    // Methods
    public function getReferralLink($link = null)
    {
        if ($link) {
            return $link.'?r='.$this->getReferralToken();
        }

        return url('/?r='.$this->getReferralToken());
    }

    public function getReferralToken()
    {
        return $this->token;
    }

    protected static function generateReferralToken()
    {
        $length = config('referral.code_length', 5);

        do {
            $token = Str::random($length);
        } while (static::referralTokenExists($token));

        return $token;
    }
}
