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
        Schema::create('destinasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->string('foto');
            $table->string('foto2');
            $table->string('foto3');
            $table->string('foto4');
            $table->text('deskripsi');
            $table->string('kategori_id');
            $table->string('wilayah_id');
            $table->string('status');            
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->text('maps');
            $table->string('pelayanan');
            $table->string('operasional');
            $table->integer('harga');
            $table->integer('kuota');               
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
        Schema::dropIfExists('destinasis');
    }
};
