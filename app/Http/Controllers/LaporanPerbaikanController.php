<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\DataPerbaikan;
use Illuminate\Http\Request;
use App\Models\LaporanPerbaikan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LaporanPerbaikanController extends Controller
{
    public function index(Request $request) : View
    {
        // Ambil bulan dari request, default ke bulan saat ini jika tidak ada
        $bulan = $request->input('bulan', date('m')); // Format bulan: '01' hingga '12'
        $tahun = $request->input('tahun', date('Y')); // Format tahun: 'YYYY'

        // Hitung jumlah hari dalam bulan yang dipilih
        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); // Menghitung jumlah hari

        // Ambil data perbaikan dari database berdasarkan user yang sedang login
        $data_perbaikans = DataPerbaikan::where('user_id', Auth::user()->id)
            ->whereYear('tanggal', $tahun) // Filter berdasarkan tahun
            ->whereMonth('tanggal', $bulan) // Filter berdasarkan bulan
            ->get();
        
        // Siapkan array untuk menyimpan jumlah perbaikan per tanggal
        $jumlah_perbaikan_per_tanggal = array_fill(1, $jumlah_hari, 0); // Inisialisasi array dengan jumlah hari

        // Hitung jumlah perbaikan berdasarkan tanggal
        foreach ($data_perbaikans as $perbaikan) {
            $tanggal = (int) date('d', strtotime($perbaikan->tanggal)); // Ambil tanggal (1-31)
            $jumlah_perbaikan_per_tanggal[$tanggal]++; // Increment jumlah perbaikan untuk tanggal tersebut
        }

        return view('admin.laporan.laporan-perbaikan', compact('jumlah_perbaikan_per_tanggal', 'bulan', 'tahun'));
    }
}