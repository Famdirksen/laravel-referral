<?php

namespace Famdirksen\LaravelReferral\Events;

use Famdirksen\LaravelReferral\Models\ReferralAccount;

class ReferralLinkVisitEvent
{
    public $referralAccount;

    public function __construct(ReferralAccount $referralAccount)
    {
        $this->referralAccount = $referralAccount;
    }
}
