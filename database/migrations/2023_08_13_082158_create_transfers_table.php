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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->unsignedBigInteger('destinasi_id'); 
            $table->enum('status', ['pending', 'success', 'failed']);
            $table->integer('nominal');
            $table->integer('biaya_admin');
            $table->date('tanggal');
            $table->timestamps();
            
            $table->foreign('destinasi_id')->references('id')->on('destinasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
};
