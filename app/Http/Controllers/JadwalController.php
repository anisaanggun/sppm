<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\DataMesin;
use App\Models\DataPerawatan;
use App\Models\DataPerbaikan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index(): View
{
        // Ambil data perawatan
        $data_perawatans = DataPerawatan::select('data_perawatans.*', 'data_mesins.nama_mesin')
            ->leftJoin('data_mesins', 'mesin_id', '=', 'data_mesins.id')
            ->where('data_perawatans.user_id', Auth::user()->id)
            ->get();


        // Ambil data perbaikan
        $data_perbaikans = DataPerbaikan::select('data_perbaikans.*', 'data_mesins.nama_mesin')
            ->leftJoin('data_mesins', 'mesin_id', '=', 'data_mesins.id')
            ->where('data_perbaikans.user_id', Auth::user()->id)
            ->get();
            // dd($data_perbaikans);

        // Ambil data mesin untuk dropdown
        $data_mesins = DataMesin::where('user_id', Auth::user()->id)->get();

        // Ambil data jadwal dengan nama mesin
        $jadwals = Jadwal::select('jadwals.*', 'data_mesins.nama_mesin')
            ->leftJoin('data_mesins', 'jadwals.mesin_id', '=', 'data_mesins.id') // Pastikan 'mesin_id' adalah kolom yang benar
            ->latest()
            ->paginate(10);

        Carbon::setLocale('id');
        $today = now()->locale('id')->isoFormat('dddd, D MMMM Y');

        // Kembalikan view dengan data jadwal, data mesin, dan tanggal hari ini
        return view('admin.datajadwal.jadwal', compact('data_perawatans', 'data_perbaikans', 'jadwals', 'data_mesins', 'today'));
}

    public function create(): View
    {

        //Daftar nama_mesin untuk select
        $data_mesins = DataMesin::where('user_id', Auth::user()->id)->get();
        return view('admin.datajadwal.create', compact('data_mesins'));
    }

    public function store(Request $request): RedirectResponse
    {

        // Validasi input
        $request->validate([
        'mesin_id' => 'required|exists:data_mesins,id', // Pastikan ID mesin valid
        // Validasi lainnya...
        ]);

        // Ambil ID mesin yang dipilih
        $mesinId = $request->input('mesin_id');

        //validasi form
        $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'mesin_id' => 'required',
            'no_hp' => 'required|numeric',
            'tanggal' => 'required|date',
            'tempat' => 'required|string',
            'jenis_jasa' => 'required|string',
        ], [
            'nama_pemilik.required' => 'Silahkan masukan nama pemilik.',
            'mesin_id.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'no_hp.required' => 'Silahkan masukan no hp yang aktif',
            'tanggal.required' => 'Silahkan pilih tanggal',
            'tempat.required' => 'Silahkan masukan tempat servis',
            'jenis_jasa.required' => 'Silahkan pilih jasa yang diingnkan',
        ]);

        //create data jadwal
        Jadwal::create([
            'nama_pemilik' => $request->nama_pemilik,
            'mesin_id' => $request->mesin_id,
            'no_hp' => $request->no_hp,
            'tanggal' => $request->tanggal,
            'tempat' => $request->tempat,
            'jenis_jasa' => $request->jenis_jasa,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function edit(string $id): View
    {
        $jadwals = Jadwal::findOrFail($id);

        return view('admin.datajadwal.edit', compact('jadwals'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'nama_pemilik' => 'required|string|max:255',
            'no_hp' => 'required|numeric',
            'tanggal' => 'required|date',
            'tempat' => 'required|string',
            'jenis_jasa' => 'required|string',
        ], [
            'nama_pemilik' => 'Silahkan masukan nama pemilik',
            'no_hp' => 'Silahkan masukan no hp',
            'tanggal' => 'Silahkan pilih tanggal',
            'tempat' => 'Silahkan masukan tempat',
            'jenis_jasa' => 'Silahkan pilih jasa',
        ]);

        $jadwals = Jadwal::findOrFail($id);

        $jadwals->update([
            'nama_pemilik' => $request->nama_pemilik,
            'no_hp' => $request->no_hp,
            'tanggal' => $request->tanggal,
            'tempat' => $request->tempat,
            'jenis_jasa' => $request->jenis_jasa,
        ]);

        $nama_pemilik = $request->input('nama_pemilik');

        return redirect()->route('jadwal.index')->with('success', 'Jadwal milik ' . $nama_pemilik . ' berhasil diubah!');
    }

    public function destroy($id): RedirectResponse
    {
        $jadwals = Jadwal::findOrFail($id);

        $jadwals->delete();

        return redirect()->route('jadwal.store')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
