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

/**
 * This is the Paybear resource class.
 *
 * @author Highjhacker <jolanbeer@gmail.com>
 */

class Paybear extends AbstractAPI
{
    public function getCurrencies() {
        # Should probably use secret_key instead
        return $this->get('/v2/currencies', ['token' => config('paybear.public_key')]);
    }
}