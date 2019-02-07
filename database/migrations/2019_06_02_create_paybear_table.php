<?php

/*
 * This file is part of Laravel Paybear.
 *
 * (c) Highjhacker <jolanbeer@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PaybearTable extends Migration
{
    public function up()
    {
        Schema::create('paybear', function (Blueprint $table) {
            $table->increments('id');
            #$table->morphs('increment_id'); # varchar, not sure
            $table->unsignedDecimal('order_total', 20, 2);
            $table->string('fiat_currency');
            $table->string('fiat_sign');
            $table->string('status');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('paybear');
    }
}