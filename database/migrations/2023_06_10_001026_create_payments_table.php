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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->unsignedBigInteger('destinasi_id');  
            $table->unsignedBigInteger('user_id');          
            $table->string('email');
            $table->string('no_telp');
            $table->integer('qty');
            $table->bigInteger('total');
            $table->enum('status', ['pending', 'success', 'failed']);
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('destinasi_id')->references('id')->on('destinasis')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
