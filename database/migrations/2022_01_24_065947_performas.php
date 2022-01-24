<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Performas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('performas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('portofolio_id');
            $table->integer('modal_investasi');
            $table->integer('keuntungan_terealisasi');
            $table->integer('total_pembelian');
            $table->integer('total_penjualan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('performas');
        //
    }
}
