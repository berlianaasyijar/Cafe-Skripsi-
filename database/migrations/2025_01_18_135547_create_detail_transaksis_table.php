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
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->bigInteger('id',20)->unsigned();
		    $table->bigInteger('transaksi_id',20)->unsigned();
		    $table->bigInteger('produk_id',20)->unsigned();
		    $table->integer('jumlah',11);
		    $table->timestamp('created_at')->nullable()->default('NULL');
		    $table->timestamp('updated_at')->nullable()->default('NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transaksis');
    }
};
