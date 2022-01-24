<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListReksadanas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('list_reksadana', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_reksadana', 100);
            $table->integer('biaya_pembelian');
            $table->integer('biaya_penjualan');
            $table->string('tingkat_resiko', 100);
            $table->integer('jenis_produk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('list_reksadana');
    }
}
