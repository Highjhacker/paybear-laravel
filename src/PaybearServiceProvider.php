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

use Illuminate\Support\ServiceProvider;

class PaybearServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../config/paybear.php' => config_path('paybear.php'),
        ], 'config');
    }

    /**
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/paybear.php', 'paybear');
    }
     */
}