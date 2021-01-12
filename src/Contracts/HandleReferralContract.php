<?php

namespace Famdirksen\LaravelReferral\Contracts;

use Famdirksen\LaravelReferral\Models\Referral;
use Famdirksen\LaravelReferral\Models\ReferralAccount;

interface HandleReferralContract {
    public function toReferral(ReferralAccount $referralAccount): Referral;
    public function toReferralIfNeededBasedOnCookie(): void;
}
