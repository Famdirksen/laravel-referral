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

        $referralAccount->object_type = get_class($this);
        $referralAccount->object_id = $this->getKey();
        $referralAccount->name = $name;

        $referralAccount->save();

        return $referralAccount;
    }

    public function referralAccounts(): MorphMany
    {
        /** @var Model $this */
        return $this->morphMany(ReferralAccount::class, 'object');
    }

    //todo - hasManyThrough relation to the referrals
}
