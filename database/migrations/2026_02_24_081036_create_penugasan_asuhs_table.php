<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenugasanAsuhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penugasan_asuhs', function (Blueprint $table) {
            $table->bigIncrements('PenugasanID');
            $table->unsignedBigInteger('AnakAsuhID');
            $table->unsignedBigInteger('KakakAsuhID');
            $table->date('TanggalMulai');
            $table->date('TanggalSelesai')->nullable();
            $table->timestamps();

            $table->foreign('AnakAsuhID')->references('id')->on('anak_asuhs')->onDelete('cascade');
            $table->foreign('KakakAsuhID')->references('KakakAsuhID')->on('kakak_asuhs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penugasan_asuhs');
    }
}
