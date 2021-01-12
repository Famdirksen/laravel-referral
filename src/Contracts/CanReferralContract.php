<?php

namespace Famdirksen\LaravelReferral\Contracts;

use Famdirksen\LaravelReferral\Models\ReferralAccount;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface CanReferralContract
{
    public function makeReferralAccount(string $name): ReferralAccount;

    public function referralAccounts(string $name): MorphMany;
}
