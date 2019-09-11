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
            $table->integer('id_admin');
            $table->integer('id_keranjang');
            $table->integer('id_karyawan');
            $table->integer('jumlah');
            $table->string('detail_kegiatan',255)->nullable();
            $table->string('foto_awal',255)->nullable();
            $table->string('foto_akhir',255)->nullable();
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
