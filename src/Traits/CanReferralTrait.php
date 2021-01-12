<?php

namespace Famdirksen\LaravelReferral\Traits;

use Famdirksen\LaravelReferral\Models\ReferralAccount;
use Illuminate\Database\Eloquent\Model;

trait CanReferralTrait {
    public function makeReferralAccount(string $name) {
        /** @var Model $this */

        $referralAccount = new ReferralAccount;

        $referralAccount->object_type = get_class($this);
        $referralAccount->object_id = $this->getKey();
        $referralAccount->name = $name;

        $referralAccount->save();

        return $referralAccount;
    }

    public function referralAccounts() {
        /** @var Model $this */
        return $this->morphMany(ReferralAccount::class, 'object');
    }

    //todo - hasManyThrough relation to the referrals
}
