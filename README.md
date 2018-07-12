KATSANA SDK for PHP
==============

[![Build Status](https://travis-ci.org/katsana/katsana-sdk-php.svg?branch=master)](https://travis-ci.org/katsana/katsana-sdk-php)
[![Latest Stable Version](https://poser.pugx.org/katsana/katsana-sdk-php/v/stable)](https://packagist.org/packages/katsana/katsana-sdk-php)
[![Total Downloads](https://poser.pugx.org/katsana/katsana-sdk-php/downloads)](https://packagist.org/packages/katsana/katsana-sdk-php)
[![Latest Unstable Version](https://poser.pugx.org/katsana/katsana-sdk-php/v/unstable)](https://packagist.org/packages/katsana/katsana-sdk-php)
[![License](https://poser.pugx.org/katsana/katsana-sdk-php/license)](https://packagist.org/packages/katsana/katsana-sdk-php)
[![Coverage Status](https://coveralls.io/repos/github/katsana/katsana-sdk-php/badge.svg?branch=master)](https://coveralls.io/github/katsana/katsana-sdk-php?branch=master)

* [Installation](#installation)
* [Usages](#usages)
    - [Creating Client](#creating-client)
    - [Handling Response](#handling-response)
    - [Using the API](#using-the-api)

## Installation

To install through composer, simply put the following in your `composer.json` file:

```json
{
    "require": {
        "katsana/katsana-sdk-php": "^1.0",
        "php-http/guzzle6-adapter": "^1.1.1"
    }
}
```

### HTTP Adapter

Instead of utilizing `php-http/guzzle6-adapter` you might want to use any other adapter that implements `php-http/client-implementation`. Check [Clients & Adapters](http://docs.php-http.org/en/latest/clients.html) for PHP-HTTP.

## Usages

### Creating Client

You can start by creating a client by using the following code (which uses `php-http/guzzle6-adapter` and `php-http/discovery` to automatically pick available adapter installed via composer):

```php
<?php

use Katsana\Sdk\Client;

$katsana = Client::make('client-id', 'client-secret');
```

In most cases, you will be using the client with Personal Access Token. You can initiate the client using the following code:

```php
<?php

use Katsana\Sdk\Client;

$katsana = Client::personal('personal-access-token');
```

### Handling Response

Every API request using the API would return an instance of `Katsana\Sdk\Response` which can fallback to `\Psr\Http\Message\ResponseInterface`, this allow developer to further inspect the response. 

As an example:

```php
$response = $katsana->uses('Welcome')->hello();

var_dump($response->toArray());
```

```json
{
    "platform": "v4.5.13",
    "api": [
        "v1"
    ]
}
```
#### Getting the Response

You can get the raw response using the following:

```php
$response->getBody();
```

However we also create a method to parse the return JSON string to array.

```php
$response->toArray();
```

#### Checking the Response HTTP Status

You can get the response status code via:

```php
$response->getStatusCode();

$response->isSuccessful();

$response->isUnauthorized();
```

#### Checking the Response Header

You can also check the response header via the following code:

```php
$response->getHeaders(); // get all headers as array.
$response->hasHeader('Content-Type'); // check if `Content-Type` header exist.
$response->getHeader('Content-Type'); // get `Content-Type` header.
```

### Using the API

There are two way to request an API:

#### Using API Resolver

This method allow you as the developer to automatically select the current selected API version without having to modify the code when KATSANA release new API version.

```php
$vehicles = $katsana->uses('Vehicles'); 

$response = $vehicles->all(); 
```

> This would resolve an instance of `Katsana\Sdk\One\Vehicles` class (as `v1` would resolve to `One` namespace).

#### Explicit API Resolver

This method allow you to have more control on which version to be used.

```php
$vehicles = $katsana->via(new Katsana\Sdk\One\Vehicles());

$response = $vehicles->all();
```
