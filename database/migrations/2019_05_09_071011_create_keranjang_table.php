<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeranjangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_carts_list');
            $table->integer('id_products');
            $table->integer('jumlah');
            $table->integer('id_harga');
            $table->integer('id_kain')->nullable();
            $table->integer('id_logo')->nullable();
            $table->string('desain', 255)->nullable();
            $table->integer('harga');
            $table->integer('total_harga')
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keranjang');
    }
}
