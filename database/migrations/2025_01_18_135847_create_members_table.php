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
        Schema::create('members', function (Blueprint $table) {
            $table->bigInteger('id',20)->unsigned();
            $table->string('nama'); // Nama wajib diisi
            $table->string('username'); // Username wajib diisi
            $table->string('no_hp'); // No HP wajib diisi
            $table->integer('point')->default(0); // Kolom point tanpa auto_increment
            $table->string('level')->default('Bronze'); // Default level 'Bronze'
            $table->integer('status')->default(1); // Default status 1 tanpa auto_increment
            $table->string('creaby')->nullable(); // Kolom nullable
            $table->timestamp('creadate')->nullable(); // Kolom timestamp nullable
            $table->string('updatedby')->nullable(); // Kolom nullable
            $table->timestamp('updateddate')->nullable(); // Kolom timestamp nullable
            $table->timestamps(); // created_at dan updated_at otomatis
            $table->integer('add_point')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};
