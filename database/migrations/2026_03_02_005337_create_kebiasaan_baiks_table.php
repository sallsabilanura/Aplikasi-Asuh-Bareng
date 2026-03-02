<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKebiasaanBaiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kebiasaan_baiks', function (Blueprint $table) {
            $table->bigIncrements('KebiasaanID');
            $table->unsignedBigInteger('AnakAsuhID');
            $table->unsignedBigInteger('KakakAsuhID');

            // Period
            $table->integer('Bulan');
            $table->integer('Tahun');

            // Daily Habit Totals (Max 31)
            $table->integer('SholatSubuh')->default(0);
            $table->integer('SholatZuhur')->default(0);
            $table->integer('SholatAshar')->default(0);
            $table->integer('SholatMagrib')->default(0);
            $table->integer('SholatIsya')->default(0);
            $table->integer('Mengaji')->default(0);
            $table->integer('BerangkatSekolah')->default(0);
            $table->integer('BantuOrangTua')->default(0);

            $table->timestamps();

            // Foreign keys referencing the correct case
            $table->foreign('AnakAsuhID')->references('id')->on('anak_asuhs')->onDelete('cascade');
            $table->foreign('KakakAsuhID')->references('KakakAsuhID')->on('kakak_asuhs')->onDelete('cascade');

            // A child should have only one record per month/year context
            $table->unique(['AnakAsuhID', 'Bulan', 'Tahun']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kebiasaan_baiks');
    }
}
