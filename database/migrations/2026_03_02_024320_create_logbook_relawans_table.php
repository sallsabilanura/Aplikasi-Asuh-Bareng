<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbookRelawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('logbook_relawans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('RencanaProgramID')->constrained('rencana_programs')->onDelete('cascade');
            $table->date('TanggalAktivitas');
            $table->string('NamaAktivitas');
            $table->text('DeskripsiHasil');
            $table->string('FileBukti')->nullable();
            $table->enum('StatusValidasi', ['Belum Diperiksa', 'Valid', 'Revisi'])->default('Belum Diperiksa');
            $table->text('KomentarAdmin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbook_relawans');
    }
}
