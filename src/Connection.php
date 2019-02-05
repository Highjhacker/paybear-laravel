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

namespace Highjhacker\Paybear;

use RuntimeException;
use GuzzleHttp\Client;
use BadMethodCallException;
use GuzzleHttp\HandlerStack;

/**
 * This is the connection class.
 *
 * @author Highjhacker <jolanbeer@gmail.com>
 */
class Connection
{
    /**
     * The Guzzle Client instance.
     *
     * @var \GuzzleHttp\Client
     */
    public $httpClient;

    /**
     * Make a new connection instance.
     *
     * @param array $config
     * @param \GuzzleHttp\HandlerStack $handler
     */
    public function __construct(array $config, HandlerStack $handler = null)
    {
        $options = [
            'base_uri' => $config['host'], # https://api.paybear.io
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ];

        if ($handler instanceof HandlerStack) {
            $options['handler'] = $handler;
        }

        $this->httpClient = new Client($options);
    }

    /**
     * @param string $name
     * @param mixed  $args
     *
     * @throws BadMethodCallException
     *
     * @return ApiInterface
     */
    public function __call($name, $args)
    {
        try {
            return $this->api($name);
        } catch (RuntimeException $e) {
            throw new BadMethodCallException(sprintf('Undefined method called: "%s"', $name));
        }
    }

    /**
     * Make a new resource instance.
     *
     * @param string $name
     *
     * @return \Highjhacker\Paybear\API\AbstractAPI
     */
    public function api(string $name): API\AbstractAPI
    {
        $name = ucfirst($name);
        $class = "Highjhacker\\Paybear\\API\\{$name}";
        if (! class_exists($class)) {
            throw new RuntimeException("Class [$class] does not exist.");
        }
        return new $class($this);
    }

    /**
     * Get the Guzzle client instance.
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }
}