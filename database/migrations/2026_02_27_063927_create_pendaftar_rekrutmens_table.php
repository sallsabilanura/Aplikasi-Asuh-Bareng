<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftarRekrutmensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftar_rekrutmens', function (Blueprint $table) {
            $table->id('PendaftarID');
            $table->string('NamaLengkap');
            $table->string('NamaPanggilan');
            $table->string('JenisKelamin');
            $table->integer('Usia');
            $table->string('Domisili');
            $table->string('NoWhatsapp');
            $table->string('PendidikanTerakhir');
            $table->string('AsalInstansi');
            $table->string('KesibukanSaatIni');
            $table->unsignedBigInteger('PosisiID');
            $table->text('AlasanMendaftar');
            $table->text('HalMenarik');
            $table->text('PengalamanRelevan');
            $table->text('ArtiKomitmen');
            $table->boolean('SiapKontrak');
            $table->boolean('KendaraanPribadi');
            $table->boolean('LaptopPribadi');
            $table->boolean('SiapSOP');
            $table->string('CVPath');
            $table->string('FotoPath');
            $table->string('PortofolioPath')->nullable();
            $table->timestamps();

            $table->foreign('PosisiID')->references('PosisiID')->on('posisi_rekrutmens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftar_rekrutmens');
    }
}
