<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuliner', function (Blueprint $table) {
            $table->id();
            $table->string('nama_warung');
            $table->string('alamat');
            $table->string('operasional');
            $table->string('nama_kuliner');
            $table->text('deskripsi');
            $table->string('harga');
            $table->string('foto');
            $table->string('foto2');
            $table->string('foto3');
            $table->string('customer_service');
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
        Schema::dropIfExists('kuliner');
    }
};
