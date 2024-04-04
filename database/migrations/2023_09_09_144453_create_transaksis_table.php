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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('produk_id');
            $table->string('keterangan');
            $table->string('nama_produk');
            $table->decimal('harga',10, 2);;
            $table->integer('jml_beli');
            $table->decimal('jml_harga',10, 2);
            $table->decimal('jml_bayar',10, 2);
            $table->decimal('kembalian', 10, 2);
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
        Schema::dropIfExists('transaksis');
    }
};
