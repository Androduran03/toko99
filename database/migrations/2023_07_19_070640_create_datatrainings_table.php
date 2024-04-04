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
        Schema::create('datatrainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id');
            $table->string('keterangan');
            $table->integer('bulan');
            $table->integer('jml_penjualan');
          
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
        Schema::dropIfExists('datatrainings');
    }
};
