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
 * This is the abstract resource class.
 *
 * @author Brian Faust <brian@ark.io>
 */
abstract class AbstractAPI
{
    /**
     * The client connection.
     *
     * @var \Highjhacker\Paybear\Connection
     */
    public $connection;

    /**
     * Create a new API class instance.
     *
     * @param \Highjhacker\Paybear\Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Send a GET request with query parameters.
     *
     * @param string $path
     * @param array  $query
     *
     * @return array|string
     */
    protected function get(string $path, array $query = [])
    {
        $response = $this->connection->getHttpClient()->get($path, compact('query'));

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Send a POST request with JSON-encoded parameters.
     *
     * @param string $path
     * @param array  $parameters
     *
     * @return array|string
     */
    protected function post(string $path, array $parameters = [])
    {
        $response = $this->connection->getHttpClient()->post(
            $path,
            ['json' => $parameters]
        );

        return json_decode($response->getBody()->getContents(), true);
    }
}