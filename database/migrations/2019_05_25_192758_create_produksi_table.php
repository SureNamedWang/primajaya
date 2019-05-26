<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produksi', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
            $table->integer('id_orders');
            $table->integer('id_karyawan');
            $table->dateTime('waktu');
            $table->string('detail_kegiatan',255);
            $table->string('foto',255);
            $table->integer('progress');
            $table->integer('id_admin');
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
        Schema::table('produksi', function (Blueprint $table) {
            //
        });
    }
}
