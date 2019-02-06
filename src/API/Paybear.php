<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Paybear package.
 *
 * (c) Highjhacker <jolanbeer@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Highjhacker\Paybear\API;

use Highjhacker\Paybear\Connection;

/**
 * This is the Paybear resource class.
 *
 * @author Highjhacker <jolanbeer@gmail.com>
 *
 * https://github.com/Paybear/paybear-samples/blob/master/README.md
 * https://github.com/Paybear/paybear-samples/blob/master/php/paybear.php
 */

class Paybear extends AbstractAPI
{
    private $token;

    public function __construct(Connection $connection)
    {
        parent::__construct($connection);

        $this->token = config('paybear.public_key');
    }

    /**
     * Create a payment request on PayBear with a GET request
     *
     * @param string $crypto
     * @param string $orderId
     * @return array
     */
    public function createPaymentRequest($crypto='eth', $orderId='7e691214bebe31eaa4b813c59825391b') : array
    {
        $CONFIRMATIONS = 3;
        $callbackUrl = urlencode(config('paybear.callback_url') . "?id=${orderId}");
        return $this->get("/v2/{$crypto}/payment/${callbackUrl}", ['token' => $this->token]);
    }

    /**
     * Get the activated cryptocurrency
     *
     * @return array
     */
    public function getCurrencies() : array
    {
        return $this->get("/v2/currencies", ['token' => $this->token]);
    }

    /**
     * Get the current average market rates
     *
     * @param string $fiat
     * @return array
     */
    public function getMarketRates($fiat='eur') : array
    {
        return $this->get("/v2/exchange/${fiat}/rate");
    }

    /**
     * Get the current exchange rate for the specified cryptocurrency
     *
     * @param string $fiat
     * @param string $crypto
     * @return array
     */
    public function getMarketRate($fiat='eur', $crypto='btc') : array
    {
        return $this->get("/v2/${crypto}/exchange/{$fiat}/rate");
    }
}