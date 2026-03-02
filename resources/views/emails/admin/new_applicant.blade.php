@component('mail::message')
# Aplikasi Volunteer Baru 🎉

Halo Admin,

Terdapat pelamar volunteer baru yang baru saja mendaftar melalui website Asuh Bareng.
Berikut adalah rincian singkatnya:

**Nama Lengkap:** {{ $pendaftar->NamaLengkap }}
**Nomor WhatsApp:** {{ $pendaftar->NoWhatsapp }}
**Posisi yang Dilamar:** {{ $pendaftar->posisi->NamaPosisi ?? '-' }}
**Domisili:** {{ $pendaftar->Domisili }}

Silakan login ke Dashboard Admin untuk meninjau formulir pendaftaran, esai motivasi, dan berkas lampiran pelamar secara lengkap.

@component('mail::button', ['url' => route('admin.rekrutmen.pendaftar.show', $pendaftar->PendaftarID), 'color' => 'success'])
Tinjau Detail Pelamar
@endcomponent

Terima kasih,<br>
Sistem Notifikasi {{ config('app.name') }}
@endcomponent
