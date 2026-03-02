<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaporAsuhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapor_asuhs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('AnakAsuhID');
            $table->unsignedBigInteger('KakakAsuhID');
            $table->integer('Tahun');
            $table->integer('Semester')->comment('1 = Ganjil, 2 = Genap');
            $table->text('RingkasanPerkembangan')->nullable();
            $table->timestamps();

            // Foreign constraints
            $table->foreign('AnakAsuhID')->references('id')->on('anak_asuhs')->onDelete('cascade');
            $table->foreign('KakakAsuhID')->references('KakakAsuhID')->on('kakak_asuhs')->onDelete('cascade');

            // Ensure only one report per child per semester per year
            $table->unique(['AnakAsuhID', 'Tahun', 'Semester'], 'unique_rapor_semester');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rapor_asuhs');
    }
}
