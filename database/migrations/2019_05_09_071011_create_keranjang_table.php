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
            $table->bigInteger('id_user');
            $table->bigInteger('id_orders')->nullable();
            $table->bigInteger('id_products');
            $table->integer('jumlah');
            $table->bigInteger('id_produk');
            $table->bigInteger('id_logo')->nullable();
            $table->string('desain', 255)->nullable();
            $table->integer('harga');
            $table->integer('total_harga');
            $table->enum('quality_control',['Pending','Approved','Denied']);
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
