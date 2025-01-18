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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigInteger('id',20)->unsigned();
            $table->bigInteger('total_harga'); // Kolom tanpa auto_increment
            $table->string('bukti_pembayaran')->nullable(); // Kolom nullable
            $table->timestamps(); // Kolom created_at dan updated_at
            $table->unsignedBigInteger('created_by')->nullable(); // Kolom tanpa auto_increment
            $table->integer('status')->default(1); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};
