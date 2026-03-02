<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLogbookStatusEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First update existing data if any
        \Illuminate\Support\Facades\DB::table('logbook_relawans')
            ->where('StatusValidasi', 'Valid')
            ->update(['StatusValidasi' => 'Disetujui']);

        // Then change column definition
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE logbook_relawans MODIFY COLUMN StatusValidasi ENUM('Belum Diperiksa', 'Disetujui', 'Revisi') DEFAULT 'Belum Diperiksa'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE logbook_relawans MODIFY COLUMN StatusValidasi ENUM('Belum Diperiksa', 'Valid', 'Revisi') DEFAULT 'Belum Diperiksa'");
    }
}
