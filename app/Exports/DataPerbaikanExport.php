<?php

namespace App\Exports;

use App\Models\DataPerbaikan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DataPerbaikanExport implements FromCollection, WithHeadings, WithEvents 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $statusClasses = [
            3 => [
                'class' => 'badge-secondary',
                'text' => 'Pending',
            ],
            2 => [
                'class' => 'badge-primary',
                'text' => 'Diproses',
            ],
            1 => [
                'class' => 'badge-success',
                'text' => 'Selesai',
            ],
        ];

        // Ambil data perawatan dengan relasi untuk mendapatkan nama pelanggan dan mesin
        return DataPerbaikan::with(['pemilik', 'mesin'])->get()->map(function ($item) use ($statusClasses) {
            // Mendapatkan status perawatan dalam bentuk teks
            $status = $statusClasses[$item->status_perbaikan] ?? [
                'class' => 'badge-light',
                'text' => 'Status tidak diketahui',
            ];

            return [
                'pemilik' => $item->pemilik ? $item->pemilik->nama : 'Tidak Ditemukan',
                'no_hp' => $item->pemilik ? $item->pemilik->no_hp : 'Tidak Ditemukan',
                'alamat' => $item->pemilik ? $item->pemilik->alamat : 'Tidak Ditemukan',
                'mesin' => $item->mesin ? $item->mesin->nama_mesin : 'Tidak Ditemukan',
                'tanggal' => $item->tanggal,
                'kerusakan' => $item->kerusakan,
                'catatan' => $item->catatan,
                'status_perbaikan' => $status['text'], // Tampilkan teks status
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Pelanggan',
            'No Hp',
            'Alamat',
            'Nama Mesin',
            'Tanggal',
            'Kerusakan',
            'Catatan',
            'Status Perbaikan',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:H1'; // Rentang header
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => ['argb' => 'FFFFFFFF'], // Warna teks putih
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FF0000FF'], // Warna latar belakang biru
                    ],
                ]);

                // Mengatur lebar kolom
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(25);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(25);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(25);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(25);

                
                // Menambahkan border ke seluruh tabel
                $event->sheet->getDelegate()->getStyle('A1:H' . $event->sheet->getHighestRow())->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'], // Warna border hitam
                        ],
                    ],
                ]);
            },
        ];
    }
}
