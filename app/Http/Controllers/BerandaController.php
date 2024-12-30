<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\DataPerbaikan;
use App\Models\DataPerawatan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BerandaController extends Controller
{
    public function index(Request $request) : View
    {
        // Ambil bulan dan tahun dari request untuk perawatan
        $bulan_perawatan = $request->input('bulan_perawatan', date('m')); // Format bulan: '01' hingga '12'
        $tahun_perawatan = $request->input('tahun_perawatan', date('Y')); // Format tahun: 'YYYY'

        // Hitung jumlah hari dalam bulan perawatan yang dipilih
        $jumlah_hari_perawatan = cal_days_in_month(CAL_GREGORIAN, $bulan_perawatan, $tahun_perawatan); // Menghitung jumlah hari

        // Ambil data perawatan dari database berdasarkan user yang sedang login
        $data_perawatans = DataPerawatan::where('user_id', Auth::user()->id)
            ->whereYear('tanggal_perawatan', $tahun_perawatan) // Filter berdasarkan tahun
            ->whereMonth('tanggal_perawatan', $bulan_perawatan) // Filter berdasarkan bulan
            ->get();
            // Siapkan array untuk menyimpan jumlah perawatan per tanggal
        $jumlah_perawatan_per_tanggal = array_fill(1, $jumlah_hari_perawatan, 0); // Inisialisasi array dengan jumlah hari

        // Hitung jumlah perawatan berdasarkan tanggal
        foreach ($data_perawatans as $perawatan) {
            $tanggal = (int) date('d', strtotime($perawatan->tanggal_perawatan)); // Ambil tanggal (1-31)
            $jumlah_perawatan_per_tanggal[$tanggal]++; // Increment jumlah perawatan untuk tanggal tersebut
        }

        // Ambil bulan dan tahun dari request untuk perbaikan
        $bulan_perbaikan = $request->input('bulan_perbaikan', date('m')); // Format bulan: '01' hingga '12'
        $tahun_perbaikan = $request->input('tahun_perbaikan', date('Y')); // Format tahun: 'YYYY'

        // Hitung jumlah hari dalam bulan perbaikan yang dipilih
        $jumlah_hari_perbaikan = cal_days_in_month(CAL_GREGORIAN, $bulan_perbaikan, $tahun_perbaikan); // Menghitung jumlah hari

        // Ambil data perbaikan dari database berdasarkan user yang sedang login
        $data_perbaikans = DataPerbaikan::where('user_id', Auth::user()->id)
            ->whereYear('tanggal', $tahun_perbaikan) // Filter berdasarkan tahun
            ->whereMonth('tanggal', $bulan_perbaikan) // Filter berdasarkan bulan
            ->get();

        // Siapkan array untuk menyimpan jumlah perbaikan per tanggal
        $jumlah_perbaikan_per_tanggal = array_fill(1, $jumlah_hari_perbaikan, 0); // Inisialisasi array dengan jumlah hari

        // Hitung jumlah perbaikan berdasarkan tanggal
        foreach ($data_perbaikans as $perbaikan) {
            $tanggal = (int) date('d', strtotime($perbaikan->tanggal)); // Ambil tanggal (1-31)
            $jumlah_perbaikan_per_tanggal[$tanggal]++; // Increment jumlah perbaikan untuk tanggal tersebut
        }

        // Mengembalikan tampilan dengan data perawatan dan perbaikan
        return view('admin.beranda', compact(
            'jumlah_perawatan_per_tanggal',
            'jumlah_perbaikan_per_tanggal',
            'bulan_perawatan',
            'tahun_perawatan',
            'bulan_perbaikan',
            'tahun_perbaikan'
        ));
    }
}
