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

return [
    'public_key' => env('PAYBEAR_PUBLIC_KEY'),
    'private_key' => env('PAYBEAR_PRIVATE_KEY')
];