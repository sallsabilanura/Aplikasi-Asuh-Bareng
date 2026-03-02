<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendMonthlyReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-monthly-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send monthly attendance reminders to Kakak Asuh who have not met the 2 offline + 2 online quota';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $kakakAsuhs = \App\Models\KakakAsuh::where('StatusAktif', 'aktif')->get();
        $sentCount = 0;

        foreach ($kakakAsuhs as $kakak) {
            // Check if they have an email address
            if (empty($kakak->Email)) {
                continue;
            }

            // Get offline attendance count
            $offlineCount = \App\Models\AbsensiPendampingan::where('KakakAsuhID', $kakak->KakakAsuhID)
                ->whereMonth('TanggalAbsensi', $currentMonth)
                ->whereYear('TanggalAbsensi', $currentYear)
                ->where('MetodePendampingan', 'offline')
                ->count();

            // Get online attendance count
            $onlineCount = \App\Models\AbsensiPendampingan::where('KakakAsuhID', $kakak->KakakAsuhID)
                ->whereMonth('TanggalAbsensi', $currentMonth)
                ->whereYear('TanggalAbsensi', $currentYear)
                ->where('MetodePendampingan', 'online')
                ->count();

            // If either quota is not met, send reminder
            if ($offlineCount < 2 || $onlineCount < 2) {
                try {
                    \Illuminate\Support\Facades\Mail::to($kakak->Email)->send(new \App\Mail\MonthlyAttendanceReminder($kakak));
                    $sentCount++;
                    $this->info("Sent reminder to: {$kakak->Email} (Offline: $offlineCount, Online: $onlineCount)");
                }
                catch (\Exception $e) {
                    $this->error("Failed to send reminder to {$kakak->Email}: " . $e->getMessage());
                }
            }
        }

        $this->info("Completed. Sent $sentCount reminders.");
        return 0;
    }
}
