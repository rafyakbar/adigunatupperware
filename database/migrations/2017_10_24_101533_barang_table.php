<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table){
            $table->increments('id');
            $table->integer('kategori_id')->unsigned()->nullable();
            $table->foreign('kategori_id')->references('id')->on('kategori')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->string('kode')->unique();
            $table->string('nama')->unique();
            $table->text('keterangan')->nullable();
            $table->bigInteger('harga')->unsigned();
            $table->integer('stok');
            $table->boolean('dihapus');
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
}
