<?php

namespace App\Exports;

use App\Models\DataMesin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

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
        return $this->data_mesins->map(function ($item) {
            return [
                'nama_mesin' => $item->nama_mesin,
                'brand_name' => $item->brand ? $item->brand->brand_name : 'Tidak Ditemukan',
                'model' => $item->model,
                'pemilik' => $item->pemilik ? $item->pemilik->nama : 'Tidak Ditemukan',
                'no_hp' => $item->pemilik ? $item->pemilik->no_hp : 'Tidak Ditemukan',
                'deskripsi' => $item->deskripsi,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Mesin',
            'Brand',
            'Model',
            'Pelanggan',
            'No Hp',
            'Deskripsi',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:F1'; // Rentang header
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
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(30);
                
                // Menambahkan border ke seluruh tabel
                $event->sheet->getDelegate()->getStyle('A1:F' . $event->sheet->getHighestRow())->applyFromArray([
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
