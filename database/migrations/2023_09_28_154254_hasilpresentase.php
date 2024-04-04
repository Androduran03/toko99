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
        Schema::create('hasilpresentases', function (Blueprint $table) {
            $table->id();
            $table->float('hasilMAD')->nullable();
            $table->float('hasilMSE')->nullable();
            $table->float('hasilMAPE')->nullable();
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
        Schema::dropIfExists('hasilpresentases');
    }
};
