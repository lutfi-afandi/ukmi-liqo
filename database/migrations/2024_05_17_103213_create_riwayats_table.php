<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key as bigInt
            $table->foreignId('laporan_id')->constrained('laporans'); // Assuming laporans table exists

            $table->string('progja')->nullable();
            $table->string('sarmut')->nullable();

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
        Schema::dropIfExists('riwayats');
    }
}
