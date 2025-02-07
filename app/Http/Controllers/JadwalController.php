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
use App\Models\User;


class JadwalController extends Controller
{
    // Method untuk menampilkan halaman dengan filter
    public function index(Request $request): View
{
    // Memastikan user sudah login
    if (Auth::check()) {
        $role_id = Auth::user()->role_id;

        // Ambil data mesin untuk dropdown, Admin dapat melihat semua mesin
        if ($role_id == 2) {
            $data_mesins = DataMesin::all(); // Admin bisa melihat semua mesin
        } else {
            $data_mesins = DataMesin::where('user_id', Auth::user()->id)->get(); // Teknisi hanya bisa melihat mesin miliknya sendiri
        }

        // Ambil parameter filter dari request
        $mesin_id = $request->input('mesin_id');
        $tgl_mulai = $request->input('tgl_mulai');
        $tgl_selesai = $request->input('tgl_selesai');

        // Ambil data perawatan berdasarkan filter
        $query = DataPerawatan::select('data_perawatans.*', 'data_mesins.nama_mesin', 'data_pelanggans.nama as nama_pelanggan', 'data_perawatans.created_at')
            ->leftJoin('data_mesins', 'mesin_id', '=', 'data_mesins.id')
            ->leftJoin('data_pelanggans', 'data_perawatans.pemilik_id', '=', 'data_pelanggans.id');

        // Jika role adalah Admin (role_id = 2), Admin bisa memfilter berdasarkan mesin juga
        if ($role_id == 2) {
            // Admin tidak perlu filter user_id, bisa melihat semua data
        } elseif ($role_id == 1) {
            // Teknisi hanya bisa melihat data miliknya sendiri
            $query->where('data_perawatans.user_id', Auth::user()->id);
        }

        // Filter berdasarkan mesin_id jika ada
        if (isset($mesin_id) && !empty($mesin_id)) {
            $query->where('mesin_id', $mesin_id);
        }

        // Filter berdasarkan tanggal mulai jika ada
        if (isset($tgl_mulai) && !empty($tgl_mulai)) {
            $query->where('tanggal_perawatan', '>=', $tgl_mulai);
        }

        // Filter berdasarkan tanggal selesai jika ada
        if (isset($tgl_selesai) && !empty($tgl_selesai)) {
            $query->where('tanggal_perawatan', '<=', $tgl_selesai);
        }

        // Ambil data perawatan yang sudah difilter
        $data_perawatans = $query->get();

        // Ambil data perbaikan berdasarkan filter
        $query2 = DataPerbaikan::select('data_perbaikans.*', 'data_mesins.nama_mesin', 'data_pelanggans.nama as nama_pelanggan', 'data_perbaikans.created_at')
            ->leftJoin('data_mesins', 'mesin_id', '=', 'data_mesins.id')
            ->leftJoin('data_pelanggans', 'data_perbaikans.pemilik_id', '=', 'data_pelanggans.id', 'data_perbaikans.kerusakan');

        // Jika role adalah Admin (role_id = 2), Admin bisa memfilter berdasarkan mesin juga
        if ($role_id == 2) {
            // Admin tidak perlu filter user_id, bisa melihat semua data
        } elseif ($role_id == 1) {
            // Teknisi hanya bisa melihat data miliknya sendiri
            $query2->where('data_perbaikans.user_id', Auth::user()->id);
        }

        // Filter berdasarkan mesin_id jika ada
        if (isset($mesin_id) && !empty($mesin_id)) {
            $query2->where('mesin_id', $mesin_id);
        }

        // Filter berdasarkan tanggal mulai jika ada
        if (isset($tgl_mulai) && !empty($tgl_mulai)) {
            $query2->where('tanggal', '>=', $tgl_mulai);
        }

        // Filter berdasarkan tanggal selesai jika ada
        if (isset($tgl_selesai) && !empty($tgl_selesai)) {
            $query2->where('tanggal', '<=', $tgl_selesai);
        }

        // Ambil data perbaikan yang sudah difilter
        $data_perbaikans = $query2->get();

        // Gabungkan perawatan dan perbaikan dalam bentuk events
        $events = [];

        foreach ($data_perawatans as $perawatan) {
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

            $status = $statusClasses[
                $perawatan->status_perawatan
            ] ?? [
                'class' => 'badge-light',
                'text' => 'Status tidak diketahui',
            ];

            $events[] = [
                'title' => 'Perawatan ' . $perawatan->nama_mesin,
                'start' => Carbon::parse($perawatan->tanggal_perawatan)->toIso8601String(),
                'extendedProps' => [
                    'description' => 'Pemilik: ' . $perawatan->nama_pemilik,
                    'nama_pelanggan' => $perawatan->nama_pelanggan ?? '',
                    'created_at' => Carbon::parse($perawatan->created_at)->format('d-m-Y H:i'),
                    'aktivitas' => $perawatan->aktivitas ?? '',
                    'status' => $status,
                    'jenis' => 'perawatan'
                ],
                'className' => ['dot-event']
            ];
        }

        foreach ($data_perbaikans as $perbaikan) {
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

            $status = $statusClasses[
                $perbaikan->status_perbaikan
            ] ?? [
                'class' => 'badge-light',
                'text' => 'Status tidak diketahui',
            ];

            $events[] = [
                'title' => 'Perbaikan ' . $perbaikan->nama_mesin,
                'start' => Carbon::parse($perbaikan->tanggal)->toIso8601String(),
                'extendedProps' => [
                    'description' => 'Pemilik: ' . $perbaikan->nama_pemilik,
                    'nama_pelanggan' => $perbaikan->nama_pelanggan ?? '',
                    'created_at' => Carbon::parse($perbaikan->created_at)->format('d-m-Y H:i'),
                    'kerusakan' => $perbaikan->kerusakan ?? '',
                    'status' => $status,
                    'jenis' => 'perbaikan'
                ],
                'className' => ['dot-event']
            ];
        }

        // Kembalikan view dengan data yang sudah difilter
        return view('admin.datajadwal.jadwal', compact('data_mesins', 'mesin_id', 'tgl_mulai', 'tgl_selesai', 'events'));
    }
}


    // Method untuk mendapatkan events dalam format JSON
    public function getEvents(Request $request)
{
    // Pastikan user sudah login
    if (Auth::check()) {
        $role_id = Auth::user()->role_id;

        // Ambil data perawatan
        $query = DataPerawatan::select('data_perawatans.*', 'data_mesins.nama_mesin')
            ->leftJoin('data_mesins', 'mesin_id', '=', 'data_mesins.id');

        // Filter berdasarkan role
        if ($role_id == 1) {
            $query->where('data_perawatans.user_id', Auth::user()->id);
        }

        // Ambil data perawatan
        $data_perawatans = $query->get();

        // Ambil data perbaikan
        $query2 = DataPerbaikan::select('data_perbaikans.*', 'data_mesins.nama_mesin')
            ->leftJoin('data_mesins', 'mesin_id', '=', 'data_mesins.id');

        // Filter berdasarkan role
        if ($role_id == 1) {
            $query2->where('data_perbaikans.user_id', Auth::user()->id);
        }

        // Ambil data perbaikan
        $data_perbaikans = $query2->get();

        // Gabungkan perawatan dan perbaikan dalam bentuk events
        $events = [];

        foreach ($data_perawatans as $perawatan) {
            $events[] = [
                'title' => 'Perawatan: ' . $perawatan->nama_mesin,
                'start' => Carbon::parse($perawatan->tanggal_perawatan)->toIso8601String(),
                'extendedProps' => [
                    'description' => 'Pemilik: ' . $perawatan->nama_pemilik,
                    'pemilik_id' => $perawatan->pemilik->nama ?? 'Tidak ada', // Ambil nama pelanggan dari relasi
                    'aktivitas' => 'Perawatan', // Pastikan ini diisi
                    'status' => $perawatan->status_perawatan, // Pastikan ini diisi
                ],
                'className' => ['dot-event']
            ];
        }

        foreach ($data_perbaikans as $perbaikan) {
            $events[] = [
                'title' => 'Perbaikan: ' . $perbaikan->nama_mesin,
                'start' => Carbon::parse($perbaikan->tanggal)->toIso8601String(),
                'extendedProps' => [
                    'description' => 'Pemilik: ' . $perbaikan->nama_pemilik,
                    'pemilik_id' => $perbaikan->pemilik->nama ?? 'Tidak ada', // Ambil nama pelanggan dari relasi
                    'aktivitas' => 'Perbaikan', // Pastikan ini diisi
                    'status' => $perbaikan->status_perbaikan, // Pastikan ini diisi
                ],
                'className' => ['dot-event']
            ];
        }

        // Kembalikan response JSON dengan data events
        return response()->json($events);
    }

    // Jika user belum login, kembalikan array kosong
    return response()->json([]);
}
}
