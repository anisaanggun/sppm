<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\DataMesin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JadwalController extends Controller
{
    public function index(): View
    {
        $jadwals = Jadwal::latest()->paginate(10);

        return view('admin.datajadwal.jadwal', compact('jadwals'));
    }

    public function create(): View
    {
        //Daftar nama_mesin untuk select
        $data_mesins = DataMesin::get();
        return view('admin.datajadwal.create', compact('data_mesins'));
    }

    public function store(Request $request): RedirectResponse
    {
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
