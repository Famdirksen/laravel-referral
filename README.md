# A package for Laravel to register referrals

[![Latest Version on Packagist](https://img.shields.io/packagist/v/famdirksen/laravel-referral.svg?style=flat-square)](https://packagist.org/packages/famdirksen/laravel-referral)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/famdirksen/laravel-referral/Tests?label=tests)](https://github.com/famdirksen/laravel-referral/actions?query=workflow%3ATests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/famdirksen/laravel-referral.svg?style=flat-square)](https://packagist.org/packages/famdirksen/laravel-referral)


With this package you can easily register referrals for your users/models.

![Package info](https://banners.beyondco.de/Laravel%20Referral.png?theme=light&packageManager=composer+require&packageName=famdirksen%2Flaravel-referral&pattern=architect&style=style_1&description=Register+referrals+in+your+application+with+ease.&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

## Installation

You can install the package via composer:

```bash
composer require famdirksen/laravel-referral
```

## Usage

This example shows an users (`App\Models\User`) who can have multiple `referralAccounts`. Based on orders (`App\Models\Order`) made in the system it will register the referral for the referral account.

Add the `CanReferralContract` & `CanReferralTrait` in `App\Models\User`;
```php
<?php

namespace App\Models;

use Famdirksen\LaravelReferral\Contracts\CanReferralContract;
use Famdirksen\LaravelReferral\Traits\CanReferralTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements CanReferralContract
{
    use CanReferralTrait;
    
    //...
}
```

Add the `HandleReferralContract` & `HandleReferralTrait` in `App\Models\Order`;
```php
<?php

namespace App;

use Famdirksen\LaravelReferral\Contracts\HandleReferralContract;
use Famdirksen\LaravelReferral\Traits\HandleReferralTrait;
use Illuminate\Database\Eloquent\Model;

class Order extends Model implements HandleReferralContract
{
    use HandleReferralTrait;
    
    //...
}
```

Last, you need to register the middleware that's keeping track of the referrals.

Add the `CheckReferralMiddleware` to `App\Http\Kernel`:
```php
<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            //...
            
            \Famdirksen\LaravelReferral\Http\Middleware\CheckReferralMiddleware::class,
            
            //...
        ],
    ];
    
    //...
}
```
 ## Usage

- Create a referral account for the user
```php
$user = auth()->user();

// create a referral account for the user
// `name` parameter is used for many type of referral systems
$user->makeReferralAccount('default');
```

- Get all referral accounts, referral link, and referrals for a referral account
```php
$user = auth()->user();

// get all referralAccounts for the current authenticated user
$referralAccounts = $user->referralAccounts;

// get the default referral account
$defaultReferralAccount = $referralAccounts->first();

// get the referral link for the default referral account
$referralLink = $defaultReferralAccount->getReferralLink();

// get all referrals for a referral account
$referrals = $defaultReferralAccount->referrals->get();
```

- When `Order` model hits the `created` event, 
it will register the referral for the referral account based on the 
`referral` cookie.


## Configuration

| Key | Description |
|---|---|
| `overwrite_previous_referral` | When a user is redirected multiple times, overwrite the previous referral. |
| `code_length` | The length in random characters a referral token needs to be. |
| `clear_cookie_on_referral` | Remove the cookie, so it's handled only once. |
| `cookie_name` | The name that will be used in the referral cookie registration. |
| `cookie_duration` | Needs to be an instance of `Famdirksen\LaravelReferral\Contracts\ReferralCookieDurationContract`. |
| `cookie_domains` | Optional, define on which domains a cookie needs to be set. |

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Robin Dirksen](https://github.com/robindirksen1)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
