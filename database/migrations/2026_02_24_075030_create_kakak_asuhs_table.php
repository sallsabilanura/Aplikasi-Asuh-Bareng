<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKakakAsuhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kakak_asuhs', function (Blueprint $table) {
            $table->bigIncrements('KakakAsuhID');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('NamaLengkap');
            $table->string('NomorHP');
            $table->string('Email')->unique();
            $table->text('Alamat');
            $table->enum('StatusAktif', ['aktif', 'nonaktif'])->default('aktif');
            $table->string('Foto')->nullable();
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
        Schema::dropIfExists('kakak_asuhs');
    }
}
