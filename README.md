KATSANA SDK for PHP
==============

[![Latest Stable Version](https://poser.pugx.org/katsana/katsana-sdk-php/v/stable)](https://packagist.org/packages/katsana/katsana-sdk-php)
[![Total Downloads](https://poser.pugx.org/katsana/katsana-sdk-php/downloads)](https://packagist.org/packages/katsana/katsana-sdk-php)
[![Latest Unstable Version](https://poser.pugx.org/katsana/katsana-sdk-php/v/unstable)](https://packagist.org/packages/katsana/katsana-sdk-php)
[![License](https://poser.pugx.org/katsana/katsana-sdk-php/license)](https://packagist.org/packages/laravie/codex)


* [Installation](#installation)


## Installation

To install through composer, simply put the following in your `composer.json` file:

```json
{
    "require": {
        "katsana/katsana-sdk-php": "~0.1",
        "php-http/guzzle6-adapter": "^1.1"
    }
}
```

### HTTP Adapter

Instead of utilizing `php-http/guzzle6-adapter` you might want to use any other adapter that implements `php-http/client-implementation`. Check [Clients & Adapters](http://docs.php-http.org/en/latest/clients.html) for PHP-HTTP.

