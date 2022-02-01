<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transaksis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('transakses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_order', 100);
            $table->integer('nilai_jual');
            $table->string('jenis_transaksi', 100);
            $table->integer('reksadana_id');
            $table->integer('jumlah_unit');
            $table->integer('rekening_id');
            $table->string('status', 100);
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

        Schema::dropIfExists('transakses');
    }
}
