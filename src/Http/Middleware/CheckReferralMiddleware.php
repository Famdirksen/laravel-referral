<?php

namespace Famdirksen\LaravelReferral\Http\Middleware;

use Closure;
use Famdirksen\LaravelReferral\Contracts\ReferralCookieDurationContract;
use Famdirksen\LaravelReferral\Events\ReferralLinkVisitEvent;
use Famdirksen\LaravelReferral\Models\ReferralAccount;
use Illuminate\Http\Request;

class CheckReferralMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $referralCookieName = config('referral.cookie_name');

        if ($request->hasCookie($referralCookieName) && ! config('referral.overwrite_previous_referral', false)) {
            // Return next action when there is a referral cookie set
            return $next($request);
        }

        if (($ref = $request->query('r')) && $referralAccount = ReferralAccount::byReferralToken($ref)) {
            if (! $request->hasCookie($referralCookieName) || $request->cookie($referralCookieName) !== $ref) {
                // Register cookie as link-visited
                event(new ReferralLinkVisitEvent($referralAccount));
            }

            $cookieDuration = config('referral.cookie_duration');
            $cookieDuration = new $cookieDuration();

            if (! $cookieDuration instanceof ReferralCookieDurationContract) {
                throw new \Exception('Invalid `cookie_duration` class defined in configuration.');
            }

            $redirect = redirect($request->fullUrl())
                ->withCookie(
                    cookie()->make($referralCookieName, $ref, (new $cookieDuration)->getMinutesToStore())
                );

            foreach(config('referral.cookie_domains', []) as $cookieDomain) {
                $redirect->withCookie(
                    cookie()->make($referralCookieName, $ref, (new $cookieDuration)->getMinutesToStore(), null, $cookieDomain)
                );
            }

            return $redirect;
        }

        return $next($request);
    }
}
