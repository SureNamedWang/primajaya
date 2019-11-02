<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogPembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_pembayarans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kategori',255);
            $table->string('data_awal',255)->nullable();
            $table->string('data_baru',255);
            $table->bigInteger('admin');
            $table->bigInteger('id_pembayaran');
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
        Schema::dropIfExists('log_pembayarans');
    }
}
