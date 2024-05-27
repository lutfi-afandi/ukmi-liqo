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

            $table->string('progja');
            $table->string('sarmut');

            $table->string('tw1')->nullable();
            $table->string('tw2')->nullable();
            $table->string('tw3')->nullable();
            $table->string('tw4')->nullable();

            $table->text('ket_progja')->nullable();
            $table->text('ket_sarmut')->nullable();

            $table->text('ket_tw1')->nullable();
            $table->text('ket_tw2')->nullable();
            $table->text('ket_tw3')->nullable();
            $table->text('ket_tw4')->nullable();

            $table->enum('konf_progja', ['belum', 'sedang', 'diterima', 'ditolak'])->default('belum');
            $table->enum('konf_sarmut', ['belum', 'sedang', 'diterima', 'ditolak'])->default('belum');

            $table->enum('konf_tw1', ['belum', 'sedang', 'diterima', 'ditolak'])->default('belum');
            $table->enum('konf_tw2', ['belum', 'sedang', 'diterima', 'ditolak'])->default('belum');
            $table->enum('konf_tw3', ['belum', 'sedang', 'diterima', 'ditolak'])->default('belum');
            $table->enum('konf_tw4', ['belum', 'sedang', 'diterima', 'ditolak'])->default('belum');

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
