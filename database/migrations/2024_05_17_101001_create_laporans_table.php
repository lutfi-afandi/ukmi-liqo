<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key as bigInt
            $table->foreignId('periode_id')->constrained('periodes'); // Assuming periodes table exists
            $table->foreignId('user_id')->constrained('users'); // Assuming users table exists

            $table->string('progja')->nullable();
            $table->string('sarmut')->nullable();

            $table->text('ket_progja')->nullable();
            $table->text('ket_sarmut')->nullable();

            $table->enum('konf_progja', ['belum', 'sedang', 'diterima', 'ditolak'])->nullable();
            $table->enum('konf_sarmut', ['belum', 'sedang', 'diterima', 'ditolak'])->nullable();

            $table->dateTime('tgl_upload_progja')->nullable();
            $table->dateTime('tgl_konf_progja')->nullable();

            $table->dateTime('tgl_upload_sarmut')->nullable();
            $table->dateTime('tgl_konf_sarmut')->nullable();

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
        Schema::dropIfExists('laporans');
    }
}
