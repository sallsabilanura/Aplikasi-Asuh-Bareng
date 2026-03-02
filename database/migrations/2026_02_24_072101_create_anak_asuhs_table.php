<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnakAsuhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anak_asuhs', function (Blueprint $table) {
            $table->id();
            $table->string('NamaLengkap');
            $table->string('TempatLahir');
            $table->date('TanggalLahir');
            $table->enum('JenisKelamin', ['L', 'P']);
            $table->text('Alamat');
            $table->string('Sekolah');
            $table->string('Kelas');
            $table->enum('Status', ['aktif', 'nonaktif'])->default('aktif');
            $table->string('FotoAnak')->nullable();
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
        Schema::dropIfExists('anak_asuhs');
    }
}
