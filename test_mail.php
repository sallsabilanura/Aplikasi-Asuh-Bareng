<?php

try {
    $pendaftar = \App\Models\PendaftarRekrutmen::latest()->first();
    if (!$pendaftar) {
        echo "No applicant found.\n";
        exit;
    }

    $admins = \App\Models\User::where('role', 'admin')->get();
    if ($admins->isEmpty()) {
        echo "No admin found.\n";
        exit;
    }

    foreach ($admins as $admin) {
        Illuminate\Support\Facades\Mail::to($admin->email)
            ->send(new \App\Mail\NewApplicantNotification($pendaftar));
        echo "Email sent to: " . $admin->email . "\n";
    }
}
catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
