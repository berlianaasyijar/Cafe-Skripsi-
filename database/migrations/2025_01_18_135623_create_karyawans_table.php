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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->bigInteger('id',20)->unsigned();
            $table->string('nama');
            $table->string('username');
            $table->string('no_hp');
            $table->string('password');
            $table->string('email');
            $table->string('foto')->nullable(); // Boleh NULL tanpa default 'NULL'
            $table->integer('point')->default(0); // Default tanpa auto_increment
            $table->boolean('status')->default(1); // Default 1 tanpa auto_increment
            $table->string('created_by')->nullable();
            $table->timestamp('created_date')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_date')->nullable();
            $table->timestamps(); // Kolom created_at dan updated_at
            $table->string('role')->nullable(); // Boleh NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
};
