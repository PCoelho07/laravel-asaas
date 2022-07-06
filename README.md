# Laravel wrapper for [Asaas](https://www.asaas.com/)

[![Total Downloads](https://poser.pugx.org/pcoelho/laravel-asaas/d/total.svg)](https://packagist.org/packages/pcoelho/laravel-asaas)
[![Latest Stable Version](https://poser.pugx.org/pcoelho/laravel-asaas/v/stable.svg)](https://packagist.org/packages/pcoelho/laravel-asaas)
[![Latest Unstable Version](https://poser.pugx.org/pcoelho/laravel-asaas/v/unstable.svg)](https://packagist.org/packages/pcoelho/laravel-asaas)
[![License](https://poser.pugx.org/pcoelho/laravel-asaas/license.svg)](https://packagist.org/packages/pcoelho/laravel-asaas)

## Instalation

You can install the package via composer:

```
composer require "pcoelho/laravel-asaas"
```

### Configuring the package

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Laravel\Asaas\AsaasServiceProvider"
```

This is the content of config file:

```php
<?php

use App\Packages\Asaas\Job\DefaultWebhookProcessorJob;

return [

    /*
    |-------------------------------------------------------------------------
    | Access token
    |-------------------------------------------------------------------------
    |
    | This value is the access token needed to make request to
    | Asaas's Http Api.
    */
    "access_token" => env('ASAAS_TOKEN', ''),

    /*
    |-------------------------------------------------------------------------
    | Is Sandbox environment
    |-------------------------------------------------------------------------
    |
    | This value indicates if you want to request to sanbox environment
    | (TRUE) or production environment.
    |
    */
    "is_sandbox" => env('ASAAS_IS_SANDBOX', ''),

    /*
    |--------------------------------------------------------------------------
    | Sandbox URL
    |--------------------------------------------------------------------------
    |
    | This value is only used when "is_sandbox" is TRUE,
    | it indicate the sandbox url.
    */
    "sandbox_url" => env('ASAAS_SANDBOX_URL', ''),

    /*
    |--------------------------------------------------------------------------
    | Production URL
    |--------------------------------------------------------------------------
    |
    | This value is only used when "is_sandbox" is FALSE,
    | it indicate the production url.
    */
    "production_url" => env('ASAAS_PRODUCTION_URL', ''),

    /*
    |--------------------------------------------------------------------------
    | Webhook config
    |--------------------------------------------------------------------------
    |
    */
    "webhook" => [
        'processor' => DefaultWebhookProcessorJob::class
    ]
];
```

And now, you have to set the env var with the data from your Asaas account.

- `ASAAS_TOKEN` - The api key for your account.
- `ASAAS_IS_SANDBOX` - Is sandbox environment or not.
- `ASAAS_SANDBOX_URL` - The sandbox url.
- `ASAAS_PRODUCTION_URL` - The production url (only used if `ASAAS_IS_SANDBOX` is `false`).

## Usage

For while, you can manage customers and subscriptions. As shown bellow.

### Customers

You can create, find or update a customer.

#### Create

- Params - `CustomerDto`
- Returns - `CustomerDto`

```php
$customer = Asaas::customer()->create(new CustomerDto(
    name: '<example>',
    cpf: '<example>'
))
```

#### Find

- Params - `CustomerDto`
- Returns - `CustomerDto`

```php
$customer = Asaas::customer()->find(new CustomerDto(
    name: '<example>',
    cpf: '<example>'
))
```

#### Update a customer

- Params - `CustomerDto`
- Returns - `CustomerDto`

```php
$customer = Asaas::customer()->updateCustomer(new CustomerDto(
    name: '<example>',
    cpf: '<example>'
))
```

### Subscriptions

#### Create

- Params - `RecurrenceDto`
- Returns - `RecurrenceDto`

```php
$subscription = Asaas::subscription()->create(new RecurrenceDto(
    customerId: $customer->external_code,
    billingType: RecurrenceDto::CREDIT_CARD,
    value: $plan->price,
    description: $plan->description,
    cycle: RecurrenceDto::CYCLE_MONTHLY,
    creditCardHolderName: $card->holder,
    creditCardNumber: $card->number,
    creditCardExpiryMonth: $card->expiration_month,
    creditCardExpiryYear: $card->expiration_year,
    creditCardCvv: $card->cvv,
    creditCardHolderInfoName: $card->holder,
    creditCardHolderInfoEmail: $card->holder_email,
    creditCardHolderInfoCpfCnpj: $card->holder_document,
    creditCardHolderInfoPostalCode: $card->holder_postal_code,
    creditCardHolderInfoAddressNumber: $card->holder_address_number,
    creditCardHolderInfoPhone: $card->holder_phone,
    nextDueDate: Carbon::now()->format("Y-m-d"),
    remoteIp: Request::ip(),
))
```

#### Delete

- Params - `string`
- Returns - `RecurrenceDto`

```php
$subscription = Asaas::subscription()->delete('<asaas-id-subscription>')
```

### Webhook

To register the webhook routes, you have to add this route:

```php
Route::asaasWebhook();
```

Behind the scenes, this will register a `POST` route called `/webhook/asaas` to a controller. And then, You must add route to the `except` array of the `VerifyCsrfToken` middleware:

```php
protected $except = [
    '/webhook/asaas',
];
```

## Error handling

The possible exceptions are:

- `BadRequestException`

  Status code: 400

  In this exception, you can call `$e->errors()` to see more details about the the error, see what fields are invalid or missing.

- `NotFoundException`

  Status code: 404

- `RequestForbiddenException`

  Status Code: 403

- `ServerErrorException`

  Status code: 500

- `TooManyRequestsException`

  Status Code: 429

- `UnauthorizedException`

  Status code: 401

## License

The MIT License (MIT).
