<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatSarmutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_sarmuts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('laporan_id')->constrained('laporans'); // Assuming laporans table exists
            $table->string('sarmut')->nullable();

            $table->text('ket')->nullable();

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
        Schema::dropIfExists('riwayat_sarmuts');
    }
}
