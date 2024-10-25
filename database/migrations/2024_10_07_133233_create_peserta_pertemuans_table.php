<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaPertemuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_pertemuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertemuan_id')->nullable();
            $table->foreign('pertemuan_id')->references('id')->on('pertemuans')->onDelete('set null');

            $table->foreignId('anggota_id')->nullable();
            $table->foreign('anggota_id')->references('id')->on('anggotas')->onDelete('set null');

            $table->string('jam_kehadiran')->nullable();
            $table->integer('sholat_wajib')->nullable();
            $table->integer('tilawah_quran')->nullable();
            $table->integer('sholat_jamaah')->nullable();
            $table->integer('qiyamull_lail')->nullable();
            $table->integer('sholat_dhuha')->nullable();
            $table->integer('sholat_rawatib')->nullable();
            $table->integer('dzikir')->nullable();
            $table->integer('istighfar')->nullable();
            $table->integer('shaum_sunnah')->nullable();
            $table->integer('almatsurat')->nullable();
            $table->integer('baca_buku_islam')->nullable();
            $table->integer('riyadhoh')->nullable();

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
        Schema::dropIfExists('peserta_pertemuans');
    }
}
