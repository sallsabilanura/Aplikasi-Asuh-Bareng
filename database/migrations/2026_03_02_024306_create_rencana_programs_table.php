<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('rencana_programs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('KakakAsuhID');
            $table->string('NamaProgram');
            $table->text('Deskripsi');
            $table->date('TargetSelesai');
            $table->enum('Status', ['Menunggu', 'Disetujui', 'Ditolak', 'Selesai'])->default('Menunggu');
            $table->text('KomentarAdmin')->nullable();
            $table->timestamps();

            $table->foreign('KakakAsuhID')->references('KakakAsuhID')->on('kakak_asuhs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_programs');
    }
}
