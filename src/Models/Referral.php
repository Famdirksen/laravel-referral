<?php

namespace Famdirksen\LaravelReferral\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Referral extends Model
{
    protected $table = 'referrals';

    // Relations
    public function referralable(): MorphTo
    {
        return $this->morphTo('referralable');
    }

    public function referralAccount(): BelongsTo
    {
        return $this->belongsTo(ReferralAccount::class, 'id', 'referral_account_id');
    }
}
