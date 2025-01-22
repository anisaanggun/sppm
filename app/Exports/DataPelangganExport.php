<?php

namespace App\Exports;

use App\Models\DataPelanggan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Auth;

class DataPelangganExport implements FromCollection, WithHeadings, WithEvents 
{
    protected $data_pelanggans;

    public function __construct($data_pelanggans)
    {
        $this->data_pelanggans = $data_pelanggans;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $role_id = Auth::user()->role_id;
        
        // Ambil hanya kolom yang diinginkan
        return $this->data_pelanggans->map(function ($item) use ($role_id) {
            // Ambil data pelanggan biasa
            $data = [
                'nama' => $item->nama,
                'no_hp' => $item->no_hp,
                'alamat' => $item->alamat,
                'email' => $item->email,
            ];

            // Jika role adalah admin, tambahkan kolom teknisi
            if ($role_id == 2) {
                $data['teknisi'] = $item->user->name ?? 'Tidak ada teknisi';
            }

            return $data;
        });
    }

    /**
    * Menambahkan nama kolom di file Excel
    *
    * @return array
    */
    public function headings(): array
    {
        $role_id = Auth::user()->role_id;

        $headings = [
            'Nama',
            $role_id == 2 ? 'No HP Pelanggan' : 'No HP', 
            'Alamat',
            'Email',
        ];

        // Jika role adalah admin, tambahkan kolom Teknisi
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
