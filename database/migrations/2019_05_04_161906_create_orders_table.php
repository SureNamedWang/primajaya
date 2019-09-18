<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_user');
            $table->integer('subtotal');
            $table->integer('biaya_kirim');
            $table->integer('total');
            $table->integer('dp');
            $table->integer('total_pembayaran');
            $table->enum('status', ['Pending', 'Produksi', 'Pengiriman', 'Selesai']);
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
        Schema::dropIfExists('orders');
    }
}
