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
        Schema::create('produksementaras', function (Blueprint $table) {
            $table->id();
            $table->integer('produk_id');
            $table->string('nama_produk');
            $table->decimal('harga',10, 2);
            $table->integer('jml_beli');
            $table->decimal('jml_harga', 10, 2);
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
        //
    }
};
