<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiPendampingansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi_pendampingans', function (Blueprint $table) {
            $table->bigIncrements('AbsensiID');
            $table->unsignedBigInteger('AnakAsuhID');
            $table->unsignedBigInteger('KakakAsuhID');
            $table->enum('JenisPendampingan', ['Offline', 'Online']);
            $table->date('Tanggal');
            $table->time('WaktuMulai');
            $table->time('WaktuSelesai');
            $table->text('DeskripsiPerkembangan');
            $table->integer('NilaiPendampingan')->nullable(); // Can be 1-100 or mapping to A/B/C in logic
            $table->string('NilaiHuruf', 2)->nullable(); // Optional if user wants A/B/C stored
            $table->text('Kendala')->nullable();
            $table->string('FotoBukti')->nullable();
            $table->enum('StatusValidasi', ['Pending', 'Disetujui', 'Ditolak'])->default('Pending');
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
        Schema::dropIfExists('absensi_pendampingans');
    }
}
