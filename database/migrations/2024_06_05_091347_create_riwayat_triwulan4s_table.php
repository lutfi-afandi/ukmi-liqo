<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatTriwulan4sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_triwulan4s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('triwulan4_id')->constrained('triwulan4s'); // Assuming triwulan4s table exists
            $table->string('file_tw4')->nullable();

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
        Schema::dropIfExists('riwayat_triwulan4s');
    }
}
