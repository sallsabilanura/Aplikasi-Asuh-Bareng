<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingRekrutmensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_rekrutmens', function (Blueprint $table) {
            $table->id('SettingID');
            $table->boolean('IsActive')->default(false);
            $table->text('Pengenalan')->nullable();
            $table->text('Tujuan')->nullable();
            $table->text('KetentuanUmum')->nullable();
            $table->text('SistemKafalah')->nullable();
            $table->text('Mekanisme')->nullable();
            $table->text('Penutup')->nullable();
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
        Schema::dropIfExists('setting_rekrutmens');
    }
}
