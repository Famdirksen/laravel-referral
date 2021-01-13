<?php

namespace Famdirksen\LaravelReferral\Contracts;

interface ReferralCookieDurationContract {
    public static function getMinutesToStore(): int;
}
