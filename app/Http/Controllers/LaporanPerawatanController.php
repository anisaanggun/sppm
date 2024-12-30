<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\DataPerawatan;
use Illuminate\Http\Request;
use App\Models\LaporanPerawatan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LaporanPerawatanController extends Controller
{
    public function index(Request $request) : View
    {
        // Ambil bulan dari request, default ke bulan saat ini jika tidak ada
        $bulan = $request->input('bulan', date('m')); // Format bulan: '01' hingga '12'
        $tahun = $request->input('tahun', date('Y')); // Format tahun: 'YYYY'

        // Hitung jumlah hari dalam bulan yang dipilih
        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); // Menghitung jumlah hari

        // Ambil data perawatan dari database berdasarkan user yang sedang login
        $data_perawatans = DataPerawatan::where('user_id', Auth::user()->id)
            ->whereYear('tanggal_perawatan', $tahun) // Filter berdasarkan tahun
            ->whereMonth('tanggal_perawatan', $bulan) // Filter berdasarkan bulan
            ->get();
        
        // Siapkan array untuk menyimpan jumlah perawatan per tanggal
        $jumlah_perawatan_per_tanggal = array_fill(1, $jumlah_hari, 0); // Inisialisasi array dengan jumlah hari

        // Hitung jumlah perawatan berdasarkan tanggal
        foreach ($data_perawatans as $perawatan) {
            $tanggal = (int) date('d', strtotime($perawatan->tanggal_perawatan)); // Ambil tanggal (1-31)
            $jumlah_perawatan_per_tanggal[$tanggal]++; // Increment jumlah perawatan untuk tanggal tersebut
        }

        return view('admin.laporan.laporan-perawatan', compact('jumlah_perawatan_per_tanggal', 'bulan', 'tahun'));
    }
}