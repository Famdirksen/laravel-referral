<?php

namespace Famdirksen\LaravelReferral\Duration;

use Famdirksen\LaravelReferral\Contracts\ReferralCookieDurationContract;

class CookieDurationForever implements ReferralCookieDurationContract
{
    public static function getMinutesToStore(): int
    {
        // Store the cookie forever (5 years - 365 days * 5).
        return 2628000;
    }
}
