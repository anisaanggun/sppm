<?php

namespace App\Exports;

use App\Models\DataPerbaikan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Auth;

class DataPerbaikanExport implements FromCollection, WithHeadings, WithEvents
{
    protected $data_perbaikans;

    public function __construct($data_perbaikans)
    {
        $this->data_perbaikans = $data_perbaikans;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $role_id = Auth::user()->role_id;
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

        // Ambil data perbaikan dengan relasi untuk mendapatkan nama pelanggan dan mesin
        return $this->data_perbaikans->map(function ($item) use ($statusClasses, $role_id) {
            // Mendapatkan status perawatan dalam bentuk teks
            $status = $statusClasses[$item->status_perbaikan] ?? [
                'class' => 'badge-light',
                'text' => 'Status tidak diketahui',
            ];

            $data = [
                'pemilik' => $item->pemilik ? $item->pemilik->nama : 'Tidak Ditemukan',
                'no_hp' => $item->pemilik ? $item->pemilik->no_hp : 'Tidak Ditemukan',
                'alamat' => $item->pemilik ? $item->pemilik->alamat : 'Tidak Ditemukan',
                'mesin' => $item->mesin ? $item->mesin->nama_mesin : 'Tidak Ditemukan',
                'tanggal' => $item->tanggal,
                'kerusakan' => $item->kerusakan,
                'catatan' => $item->catatan,
                'status_perbaikan' => $status['text'], // Tampilkan teks status
            ];

            if ($role_id == 2) {
                $data['teknisi'] = $item->user->name ?? 'Tidak ada teknisi';
            }
        
            return $data;
        });
    }


    public function headings(): array
    {
        $role_id = Auth::user()->role_id;
        $headings = [
            'Pelanggan',
            $role_id == 2 ? 'No HP Pelanggan' : 'No HP', 
            'Alamat',
            'Nama Mesin',
            'Tanggal',
            'Kerusakan',
            'Catatan',
            'Status Perbaikan',
        ];

        if ($role_id == 2) {
            $headings[] = 'Teknisi';
        }

        return $headings;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Menghitung jumlah kolom dengan mengonversi ColumnIterator menjadi array
                $columns = iterator_to_array($event->sheet->getDelegate()->getColumnIterator());
                $columnCount = count($columns);

                // Rentang header dinamis
                $columnRange = $this->getColumnName($columnCount - 1); // Kolom terakhir
                $cellRange = 'A1:' . $columnRange . '1';  // Rentang header dinamis

                // Menambahkan gaya untuk header
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
                for ($col = 0; $col < $columnCount; $col++) {
                    $event->sheet->getDelegate()->getColumnDimension($this->getColumnName($col))->setWidth(20);
                }

                // Menambahkan border ke seluruh tabel
                $event->sheet->getDelegate()->getStyle('A1:' . $columnRange . $event->sheet->getHighestRow())->applyFromArray([
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

    // Fungsi untuk mengubah nomor indeks kolom menjadi nama kolom Excel (A, B, ..., Z, AA, AB, ..., AZ, dll.)
    private function getColumnName($index)
    {
        $letters = '';
        while ($index >= 0) {
            $letters = chr($index % 26 + 65) . $letters;
            $index = floor($index / 26) - 1;
        }
        return $letters;
    }
}
