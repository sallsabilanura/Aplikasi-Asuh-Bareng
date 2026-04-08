@component('mail::message')
# Terima Kasih Atas Kebaikan Anda!

Halo **{{ $donation->user->name }}**,

Donasi Anda sebesar **Rp {{ number_format($donation->amount, 0, ',', '.') }}** telah kami terima dan diverifikasi.

@if($donation->anakAsuh)
Bantuan ini akan kami salurkan sepenuhnya untuk mendukung kebutuhan **{{ $donation->anakAsuh->NamaLengkap }}**.
@else
Bantuan ini akan kami salurkan untuk mendukung program pendidikan dan kesehatan anak asuh di AsuhBareng secara umum.
@endif

Kebaikan Anda sangat berarti bagi masa depan mereka. Semoga menjadi amal jariyah yang terus mengalir.

@component('mail::button', ['url' => route('donor.dashboard')])
Lihat Dashboard Saya
@endcomponent

Terima kasih,<br>
Tim {{ config('app.name') }}
@endcomponent
