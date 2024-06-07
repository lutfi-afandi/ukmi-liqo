<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatTriwulan1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_triwulan1s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('triwulan1_id')->constrained('triwulan1s'); // Assuming triwulan1s table exists
            $table->string('file_tw1')->nullable();

            $table->text('ket')->nullable();

            $table->enum('konf', ['belum', 'sedang', 'diterima', 'ditolak'])->nullable();

            $table->dateTime('tgl_upload')->nullable();
            $table->dateTime('tgl_konf')->nullable();

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
        Schema::dropIfExists('riwayat_triwulan1s');
    }
}
