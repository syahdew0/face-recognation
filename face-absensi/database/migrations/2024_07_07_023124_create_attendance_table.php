<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->string('kode_absensi')->unique();
            $table->string('nama_lengkap');
            $table->string('nama_divisi');
            $table->date('tanggal_absensi');
            $table->time('jam_masuk');
            $table->time('jam_pulang')->nullable();
            $table->string('foto_masuk');
            $table->string('foto_pulang')->nullable();
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
        Schema::dropIfExists('attendance');
    }
}
