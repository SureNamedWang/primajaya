<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_orders');
            $table->integer('jumlah');
            $table->string('bukti', 255);
            $table->string('keterangan', 255)->nullable();
            $table->enum('approval', ['Pending', 'Approved', 'Denied'])->default('Pending');
            $table->datetime('tanggal_bayar');
            $table->datetime('tanggal_approval')->nullable();
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
        Schema::dropIfExists('pembayaran');
    }
}
