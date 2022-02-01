<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 100);
            $table->string('password', 100);
            $table->string('email', 100);
            $table->string('nama_lengkap', 100);
            $table->integer('umur');
            $table->string('status_pernikahan', 100);
            $table->string('perkerjaan', 100);
            $table->string('pendapatan_pertahun', 100);
            $table->string('alamat_ktp', 100);
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
        Schema::dropIfExists('users');
    }
}
