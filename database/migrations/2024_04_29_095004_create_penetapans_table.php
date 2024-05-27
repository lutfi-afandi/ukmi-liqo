<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CretePenetapansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penetapans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_standar');
            $table->foreignId('kategori_id')->constrained('kategoris');
            $table->foreignId('user_id')->constrained('users');
            $table->date('tgl_penetapan');
            $table->text('file_standar');
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
        Schema::dropIfExists('penetapans');
    }
}
