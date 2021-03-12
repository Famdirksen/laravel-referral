<?php

namespace Famdirksen\LaravelReferral\Duration;

use Famdirksen\LaravelReferral\Contracts\ReferralCookieDurationContract;

class CookieDurationMonth implements ReferralCookieDurationContract
{
    public function getMinutesToStore(): int
    {
        // Store the cookie for one month (31 days).
        return 44640;
    }
}
