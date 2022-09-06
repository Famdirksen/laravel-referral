<?php

namespace Famdirksen\LaravelReferral\Traits;

use Famdirksen\LaravelReferral\Models\ReferralAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait CanReferralTrait
{
    public function makeReferralAccount(string $name): ReferralAccount
    {
        /** @var Model $this */

        $referralAccount = new ReferralAccount;

        $referralAccount->referralable_type = get_class($this);
        $referralAccount->referralable_id = $this->getKey();
        $referralAccount->name = $name;

        $referralAccount->save();

        return $referralAccount;
    }

    public function referralAccounts(): MorphMany
    {
        return $this->morphMany(ReferralAccount::class, 'referralable');
    }

    //todo - hasManyThrough relation to the referrals
}
