<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCekKesehatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cek_kesehatans', function (Blueprint $table) {
            $table->bigIncrements('KesehatanID');
            $table->unsignedBigInteger('AnakAsuhID');
            $table->date('TanggalPemeriksaan');

            // Physical Data
            $table->decimal('BeratBadan', 5, 2);
            $table->decimal('TinggiBadan', 5, 2);
            $table->decimal('LingkarKepala', 5, 2)->nullable();
            $table->decimal('IMT', 5, 2)->nullable();

            // Health General
            $table->string('StatusGizi')->nullable(); // baik / kurang / berlebih
            $table->string('KesehatanMata')->nullable(); // normal / minus / plus / silinder
            $table->string('KesehatanGigi')->nullable(); // baik / berlubang / karang_gigi
            $table->string('Pendengaran')->nullable(); // normal / gangguan
            $table->text('RiwayatPenyakit')->nullable();

            // Motoric & Sensoric
            $table->string('MotorikKasar')->nullable(); // baik / perlu_latihan / gangguan
            $table->string('MotorikHalus')->nullable(); // baik / perlu_latihan / gangguan
            $table->string('ResponsSensorik')->nullable(); // baik / sensitif / kurang_responsif

            // Psychosocial
            $table->string('InteraksiSosial')->nullable(); // baik / perlu_pendampingan
            $table->string('FokusKonsentrasi')->nullable(); // baik / perlu_latihan
            $table->string('EkspresiEmosi')->nullable(); // stabil / cemas / pemalu / agresif / lainnya

            // Diet & Sleep
            $table->string('FrekuensiMakan')->nullable(); // 2x / 3x / 4x
            $table->string('JenisMakanan')->nullable(); // seimbang / kurang_sayur / sering_junkfood
            $table->string('PolaTidur')->nullable(); // cukup / kurang
            $table->time('WaktuTidur')->nullable();
            $table->time('WaktuBangun')->nullable();
            $table->string('KebiasaanTidur')->nullable(); // teratur / sering_bergadang / sering_terbangun

            // Closing
            $table->text('CatatanPemeriksaan')->nullable();
            $table->string('TandaTanganPemeriksa')->nullable();

            $table->string('Foto')->nullable();
            $table->timestamps();

            $table->foreign('AnakAsuhID')->references('id')->on('anak_asuhs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cek_kesehatans');
    }
}
