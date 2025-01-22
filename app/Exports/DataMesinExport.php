<?php

namespace App\Exports;

use App\Models\DataMesin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Auth;

class DataMesinExport implements FromCollection, WithHeadings, WithEvents 
{
    protected $data_mesins;

    public function __construct($data_mesins)
    {
        $this->data_mesins = $data_mesins;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $role_id = Auth::user()->role_id;

        return $this->data_mesins->map(function ($item) use ($role_id) {
            $data = [
                'nama_mesin' => $item->nama_mesin,
                'brand_name' => $item->brand ? $item->brand->brand_name : 'Tidak Ditemukan',
                'model' => $item->model,
                'pemilik' => $item->pemilik ? $item->pemilik->nama : 'Tidak Ditemukan',
                'no_hp' => $item->pemilik ? $item->pemilik->no_hp : 'Tidak Ditemukan',
                'deskripsi' => $item->deskripsi,
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
            'Nama Mesin',
            'Brand',
            'Model',
            'Pelanggan',
            $role_id == 2 ? 'No HP Pelanggan' : 'No HP', 
            'Deskripsi',
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
