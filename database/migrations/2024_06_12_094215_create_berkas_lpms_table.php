<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasLpmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas_lpms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategoris'); // Assuming kategoris table exists
            $table->foreignId('periode_id')->constrained('periodes'); // Assuming periodes table exists
            $table->string('nama_berkas');
            $table->string('file');

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
        Schema::dropIfExists('berkas_lpms');
    }
}
