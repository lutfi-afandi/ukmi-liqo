<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriwulan4sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('triwulan4s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('laporan_id')->constrained('laporans'); // Assuming laporans table exists
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
        Schema::dropIfExists('triwulan4s');
    }
}
