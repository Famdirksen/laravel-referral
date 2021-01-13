<?php

namespace Famdirksen\LaravelReferral\Duration;

use Famdirksen\LaravelReferral\Contracts\ReferralCookieDurationContract;

class CookieDurationYear implements ReferralCookieDurationContract
{
    public static function getMinutesToStore(): int
    {
        // Store the cookie for one year (365 days).
        return 525600;
    }
}
