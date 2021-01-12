<?php

namespace Famdirksen\LaravelReferral\Traits;

use Famdirksen\LaravelReferral\Models\Referral;
use Famdirksen\LaravelReferral\Models\ReferralAccount;
use Illuminate\Support\Facades\Cookie;

trait HandleReferralTrait
{
    protected static function boot()
    {
        parent::boot();

        static::created(function (self $referableModel) {
            $referableModel->toReferralIfNeededBasedOnCookie();
        });
    }

    public function toReferralIfNeededBasedOnCookie(): void
    {
        // Check if there is a cookie set
        $referralCookieName = config('referral.cookie_name');

        if ($referredToken = Cookie::get($referralCookieName)) {
            // Check if the referral account still exists
            if ($referralAccount = ReferralAccount::byReferralToken($referredToken)) {
                // Register the model for the referralToken
                $this->toReferral($referralAccount);
            }
        }
    }

    public function toReferral(ReferralAccount $referralAccount): Referral
    {
        //todo - register only once per referral_account
        $referral = new Referral;

        $referral->object_type = get_class($this);
        $referral->object_id = $this->getKey();
        $referral->referral_account_id = $referralAccount->id;

        $referral->save();

        return $referral;
    }
}
