<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Portofolios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('portofolios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_portofolio', 100);
            $table->integer('target_dana');
            $table->timestamp('tanggal_tercapai', $precision = 0);
            $table->integer('nilai_portofolio');
            $table->integer('keuntungan');
            $table->integer('imba_hasil');
            $table->integer('reksadana_id');
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
        Schema::dropIfExists('portofolios');
    }
}
