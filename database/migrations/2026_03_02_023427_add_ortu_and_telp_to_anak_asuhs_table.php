<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrtuAndTelpToAnakAsuhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('anak_asuhs', function (Blueprint $table) {
            $table->string('NamaOrangTua')->nullable()->after('NamaLengkap');
            $table->string('NomorTelp')->nullable()->after('NamaOrangTua');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anak_asuhs', function (Blueprint $table) {
            $table->dropColumn(['NamaOrangTua', 'NomorTelp']);
        });
    }
}
