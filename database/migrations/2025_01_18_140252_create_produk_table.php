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
        Schema::create('produk', function (Blueprint $table) {
            $table->bigInteger('id',20)->unsigned();
            $table->string('nama_produk'); // Nama produk wajib diisi
            $table->string('kategori'); // Kategori wajib diisi
            $table->text('deskripsi')->nullable(); // Deskripsi boleh null
            $table->integer('harga'); // Kolom harga tanpa auto_increment
            $table->string('gambar_produk')->nullable(); // Gambar produk boleh null
            $table->integer('status')->default(1); // Status default 1 tanpa auto_increment
            $table->string('creaby')->nullable(); // Kolom created by boleh null
            $table->timestamp('creadate')->default(DB::raw('CURRENT_TIMESTAMP')); // Default current timestamp
            $table->string('updatedby')->nullable(); // Kolom updated by boleh null
            $table->timestamp('updateddate')->nullable(); // Updated date boleh null
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
        Schema::dropIfExists('produk');
    }
};
