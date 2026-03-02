<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\KakakAsuh;

class MonthlyAttendanceReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $kakakAsuh;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(KakakAsuh $kakakAsuh)
    {
        $this->kakakAsuh = $kakakAsuh;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pengingat: Absensi Pendampingan Bulan Ini Belum Lengkap')
            ->view('emails.monthly_attendance_reminder');
    }
}
