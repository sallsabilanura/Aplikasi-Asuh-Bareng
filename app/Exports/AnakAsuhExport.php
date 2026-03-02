<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class AnakAsuhExport implements FromArray, WithHeadings, WithTitle
{
    public function array(): array
    {
        return [
            [
                'Budi Santoso',
                'Jakarta',
                '2015-05-20',
                'L',
                'Jl. Mawar No. 123',
                'SDN 01 Jakarta',
                '3'
            ],
            [
                'Siti Aminah',
                'Bandung',
                '2016-08-15',
                'P',
                'Jl. Melati No. 45',
                'SDN 05 Bandung',
                '2'
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Alamat',
            'Sekolah',
            'Kelas'
        ];
    }

    public function title(): string
    {
        return 'Template Import Anak Asuh';
    }
}
