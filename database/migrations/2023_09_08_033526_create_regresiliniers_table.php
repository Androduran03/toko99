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
        Schema::create('regresiliniers', function (Blueprint $table) {
            $table->id();
            $table->integer('X');
            $table->integer('Y');
            $table->integer('Xpangkat2');
            $table->integer('Ypangkat2');
            $table->integer('XY');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regresiliniers');
    }
};
