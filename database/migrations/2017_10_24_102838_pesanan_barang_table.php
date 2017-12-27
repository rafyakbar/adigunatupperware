<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PesananBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_barang', function (Blueprint $table){
            $table->bigInteger('pesanan_id')->unsigned();
            $table->foreign('pesanan_id')->references('id')->on('pesanan')->onUpdate('CASCADE');
            $table->integer('barang_id')->unsigned();
            $table->foreign('barang_id')->references('id')->on('barang')->onUpdate('CASCADE');
            $table->bigInteger('harga_sekarang')->unsigned();
            $table->integer('jumlah')->unsigned();
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
}
