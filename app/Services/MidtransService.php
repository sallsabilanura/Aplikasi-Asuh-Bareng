<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        if (!class_exists('\Midtrans\Config')) {
            require_once base_path('vendor/midtrans/midtrans-php/Midtrans.php');
        }
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    public function getSnapToken($donation)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $donation->order_id,
                'gross_amount' => (int) $donation->amount,
            ],
            'customer_details' => [
                'first_name' => $donation->user->name,
                'email' => $donation->user->email,
            ],
        ];

        if ($donation->anakAsuh) {
            $params['item_details'][] = [
                'id' => 'ANAK-' . $donation->anak_asuh_id,
                'price' => (int) $donation->amount,
                'quantity' => 1,
                'name' => 'Donasi untuk ' . $donation->anakAsuh->NamaLengkap,
            ];
        } else {
            $params['item_details'][] = [
                'id' => 'GEN-DONATION',
                'price' => (int) $donation->amount,
                'quantity' => 1,
                'name' => 'Donasi Umum Asuh Bareng',
            ];
        }

        return Snap::getSnapToken($params);
    }
}
