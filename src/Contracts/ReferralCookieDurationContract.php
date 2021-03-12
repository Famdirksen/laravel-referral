<?php

namespace Famdirksen\LaravelReferral\Contracts;

interface ReferralCookieDurationContract
{
    public function getMinutesToStore(): int;
}
