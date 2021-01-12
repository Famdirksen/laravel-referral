# A package for Laravel to register referrals

[![Latest Version on Packagist](https://img.shields.io/packagist/v/famdirksen/laravel-referral.svg?style=flat-square)](https://packagist.org/packages/famdirksen/laravel-referral)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/famdirksen/laravel-referral/Tests?label=tests)](https://github.com/famdirksen/laravel-referral/actions?query=workflow%3ATests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/famdirksen/laravel-referral.svg?style=flat-square)](https://packagist.org/packages/famdirksen/laravel-referral)


With this package you can easily register referrals for your users/models.

## Installation

You can install the package via composer:

```bash
composer require famdirksen/laravel-referral
```

## Usage

```php
$skeleton = new Famdirksen\LaravelReferral();
echo $skeleton->echoPhrase('Hello, Famdirksen!');
```

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
