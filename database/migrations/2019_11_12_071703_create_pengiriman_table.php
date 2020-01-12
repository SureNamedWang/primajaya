<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('orders_id');
            $table->string('kode',255)->nullable();
            $table->enum('pengirim', ['CV.Prima Jaya Tenda', 'Tiki', 'JNE', 'Pos']);
            $table->integer('eta');
            $table->string('bukti_pengiriman',255)->nullable();
            $table->string('bukti_penerimaan',255)->nullable();
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
        Schema::dropIfExists('pengirimen');
    }
}
