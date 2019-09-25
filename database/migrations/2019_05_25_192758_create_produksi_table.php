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
            $table->bigInteger('id_admin',20);
            $table->bigInteger('id_keranjang',20);
            $table->bigInteger('id_karyawan'),20;
            $table->integer('jumlah');
            $table->string('detail_kegiatan',255)->nullable();
            $table->string('foto_awal',255)->nullable();
            $table->datetime('waktu_mulai');
            $table->string('foto_akhir',255)->nullable();
            $table->datetime('waktu_selesai')->nullable();
            $table->double('progress');
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
