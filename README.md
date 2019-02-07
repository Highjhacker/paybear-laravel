***WIP : Don't use at the moment.***

# Laravel Paybear
> Laravel package allowing to use Paybear with ease.

## Installation

With composer

```bash
$ composer require highjhacker/laravel-paybear
```

## Usage example

Publish the migration and config file from the package : 
```bash
$ php artisan vendor:publish --provider="Highjhacker\Paybear\PaybearServiceProvider" --tag="migrations"
$ php artisan vendor:publish --provider="Highjhacker\Paybear\PaybearServiceProvider" --tag="config"
```

Next, run the migration : 
```bash
$ php artisan migrate
```

Finally, setup your environment variables by creating an `.env` file and adding your credentials to it : 
```yaml
PAYBEAR_PUBLIC_KEY='mypublickey'
PAYBEAR_PRIVATE_KEY='myprivatekey'
PAYBEAR_CALLBACK_URL='https://my.callback.url'
```

Initialize the client :

```php
use Highjhacker\Paybear\Connection

$connection = new Connection(['host' => 'https://api.paybear.io']);
...
```

Get activated currencies on the Paybear account : 

```php
$connection->paybear()->getCurrencies();
```

Create payment request :

```php
# First parameter is the cryptocurrency to accept (eth, btc, bch, ltc, dash, btg, etc)
# Second parameter is the OrderID to use for making a callback
$connection->paybear()->createPaymentRequest('eth', '7e691214bebe31eaa4b813c59825391b');
```

Callback : 

```php
# To implement
```

Get market rates for all cryptocurrencies :

```php
# By default using euro
$connection->paybear()->getMarketRates();

# Or with dollar
$connection->paybear()->getMarketRates('usd');
```

Get market rate for a specific cryptocurrency : 
```php
# By default with the rate of BTC in euros 
$connection->paybear()->getMarketRate();

# Or 
$connection->paybear()->getMarketRate('usd', 'eth');
```


## Development setup

```sh
TODO
```

## Release History

* 0.0.1
    * Work in progress

## Contributing

1. Fork it (<https://github.com/Highjhacker/paybear-laravel>)
2. Create your feature branch (`git checkout -b feature/fooBar`)
3. Commit your changes (`git commit -am 'Add some fooBar'`)
4. Push to the branch (`git push origin feature/fooBar`)
5. Create a new Pull Request

## Credits

- [Highjhacker](https://github.com/Highjhacker)
- [Brian Faust](https://github.com/faustbrian)

## License

Distributed under the MIT license. See [LICENSE](https://github.com/Highjhacker/paybear-laravel/blob/master/LICENSE) for more information.
