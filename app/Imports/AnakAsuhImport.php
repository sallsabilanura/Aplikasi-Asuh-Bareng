<?php

namespace App\Imports;

use App\Models\AnakAsuh;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class AnakAsuhImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Log row for debugging
        \Illuminate\Support\Facades\Log::info('Importing Row:', $row);

        // Normalize Name mapping
        $nama = $row['nama_lengkap'] ?? $row['nama'] ?? $row['full_name'] ?? null;
        if (!$nama) {
            \Illuminate\Support\Facades\Log::warning('Skip row: "Nama Lengkap" is missing or header mismatch.', $row);
            return null;
        }

        // Normalize Date mapping (handle various slugged versions of "Tanggal Lahir")
        $tglLahirRaw = $row['tanggal_lahir'] ??
            $row['tanggal_lahir_yyyy_mm_dd'] ??
            $row['tgl_lahir'] ??
            $row['birth_date'] ??
            $row['tanggal'] ??
            null;

        $tanggalLahir = null;
        if ($tglLahirRaw) {
            try {
                if (is_numeric($tglLahirRaw)) {
                    $tanggalLahir = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($tglLahirRaw)->format('Y-m-d');
                }
                else {
                    $tanggalLahir = Carbon::parse($tglLahirRaw)->format('Y-m-d');
                }
            }
            catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Date Parse Error for ' . $nama . ': ' . $e->getMessage());
            }
        }

        if (!$tanggalLahir) {
            \Illuminate\Support\Facades\Log::warning('Skip row: "Tanggal Lahir" is missing, invalid, or header mismatch for ' . $nama);
            return null;
        }

        return new AnakAsuh([
            'NamaLengkap' => $nama,
            'TempatLahir' => $row['tempat_lahir'] ?? $row['tempat'] ?? null,
            'TanggalLahir' => $tanggalLahir,
            'JenisKelamin' => strtoupper($row['jenis_kelamin'] ?? $row['jk'] ?? $row['gender'] ?? 'L'),
            'Alamat' => $row['alamat'] ?? $row['address'] ?? null,
            'Sekolah' => $row['sekolah'] ?? $row['school'] ?? null,
            'Kelas' => $row['kelas'] ?? $row['grade'] ?? null,
            'Status' => 'aktif',
        ]);
    }
}
