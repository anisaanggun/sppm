<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\DataMesin;
use App\Models\DataPerawatan;
use App\Models\DataPerbaikan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class JadwalController extends Controller
{
    // Method untuk menampilkan halaman dengan filter
    public function index(Request $request): View
    {
        // Ambil data mesin untuk dropdown
        $data_mesins = DataMesin::where('user_id', Auth::user()->id)->get();

        // Ambil parameter filter dari request
        $mesin_id = $request->input('mesin_id');
        $tgl_mulai = $request->input('tgl_mulai');
        $tgl_selesai = $request->input('tgl_selesai');

        // Ambil data perawatan berdasarkan filter
        $query = DataPerawatan::select('data_perawatans.*', 'data_mesins.nama_mesin')
            ->leftJoin('data_mesins', 'mesin_id', '=', 'data_mesins.id')
            ->where('data_perawatans.user_id', Auth::user()->id);

        if (isset($mesin_id) && !empty($mesin_id)) {
            $query->where('mesin_id', $mesin_id);
        }

        if (isset($tgl_mulai) && !empty($tgl_mulai)) {
            $query->where('tanggal_perawatan', '>=', $tgl_mulai);
        }

        if (isset($tgl_selesai) && !empty($tgl_selesai)) {
            $query->where('tanggal_perawatan', '<=', $tgl_selesai);
        }

        $data_perawatans = $query->get();

        // Ambil data perbaikan berdasarkan filter
        $query2 = DataPerbaikan::select('data_perbaikans.*', 'data_mesins.nama_mesin')
            ->leftJoin('data_mesins', 'mesin_id', '=', 'data_mesins.id')
            ->where('data_perbaikans.user_id', Auth::user()->id);

        if (isset($mesin_id) && !empty($mesin_id)) {
            $query2->where('mesin_id', $mesin_id);
        }

        if (isset($tgl_mulai) && !empty($tgl_mulai)) {
            $query2->where('tanggal', '>=', $tgl_mulai);
        }

        if (isset($tgl_selesai) && !empty($tgl_selesai)) {
            $query2->where('tanggal', '<=', $tgl_selesai);
        }

        $data_perbaikans = $query2->get();

        // Gabungkan perawatan dan perbaikan dalam bentuk events
        $events = [];

        foreach ($data_perawatans as $perawatan) {
            $events[] = [
                'title' => 'Perawatan: ' . $perawatan->nama_mesin,
                'start' => Carbon::parse($perawatan->tanggal_perawatan)->toIso8601String(),
                'extendedProps' => [
                    'description' => 'Pemilik: ' . $perawatan->nama_pemilik
                ],
                'className' => ['dot-event']
            ];
        }

        foreach ($data_perbaikans as $perbaikan) {
            $events[] = [
                'title' => 'Perbaikan: ' . $perbaikan->nama_mesin,
                'start' => Carbon::parse($perbaikan->tanggal)->toIso8601String(),
                'extendedProps' => [
                    'description' => 'Pemilik: ' . $perbaikan->nama_pemilik
                ],
                'className' => ['dot-event']
            ];
        }

        // Kembalikan view dengan data yang sudah difilter
        return view('admin.datajadwal.jadwal', compact('data_mesins', 'mesin_id', 'tgl_mulai', 'tgl_selesai', 'events'));
    }

    // Method untuk mendapatkan events dalam format JSON
    public function getEvents(Request $request)
    {
        

        // Kembalikan response JSON dengan data events
        return response()->json($events);
    }
}
