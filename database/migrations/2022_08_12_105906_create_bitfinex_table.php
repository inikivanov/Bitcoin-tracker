<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitfinex', function (Blueprint $table) {
            $table->id();
            $table->float('last_price', 10, 2);
            $table->string('simbol');
            $table->timestamp('timestamp');
            $table->index('simbol');
            $table->index('timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bitfinex');
    }
};
