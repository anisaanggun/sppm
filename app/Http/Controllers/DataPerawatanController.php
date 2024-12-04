<?php

namespace App\Http\Controllers;

use App\Models\DataPerawatan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DataPerawatanController extends Controller
{
    public function index(): View
    {
        $data_perawatans = DataPerawatan::latest()->paginate(10);

        return view('admin.dataperawatan.data-perawatan', compact('data_perawatans'));

    }

    public function create(): View
    {
        //Daftar nama_mesin untuk checkbox
        $nama_mesin = [
            'Mitsubishi Heavy Industries' => 'Mitsubishi Heavy Industries',
            'LG Window AC' => 'LG Window AC',
            'Honeywell Portable AC' => 'Honeywell Portable AC',
            'Lainnya' => 'Lainnya',
        ];

        return view('admin.dataperawatan.create', compact('nama_mesin'));
    }

    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'pemilik' => 'required|string|max:255',
            'nama_mesin' => 'required|string',
            'tanggal' => 'required|date',
            'teknisi' => 'required|string',
            'aktivitas' => 'required|string',
            'catatan' => 'required|string',
        ], [
            'pemilik.required' => 'Silahkan masukkan nama anda.',
            'nama_mesin.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'tanggal.required' => 'Silahkan masukkan tanggal.',
            'teknisi.required' => 'Silahkan pilih teknisi.',
            'aktivitas.required' => 'Silahkan masukkan aktivitas mesin anda.',
            'catatan.required' => 'Silahkan masukkan catatan mesin anda.',
        ]);

        //create data perawatan
        DataPerawatan::create([
            'pemilik' => $request->pemilik,
            'nama_mesin' => $request->nama_mesin,
            'tanggal' => $request->tanggal,
            'teknisi' => $request->teknisi,
            'aktivitas' => $request->aktivitas,
            'catatan' => $request->catatan,
        ]);

        $selectednama_mesin = $request->input('nama_mesin');
        session()->flash('selectednama_mesin', $request->nama_mesin);
        $pemilik = $request->input('pemilik');

        return redirect()->route('data-perawatan.index')->with('success', 'Data perawatan  ' . $selectednama_mesin . ' milik ' . $pemilik . ' berhasil ditambahkan!');
    }

    public function edit(string $id): View
    {
        $data_perawatans = DataPerawatan::findOrFail($id);
        $nama_mesin = [
            'Mitsubishi Heavy Industries' => 'Mitsubishi Heavy Industries',
            'LG Window AC' => 'LG Window AC',
            'Honeywell Portable AC' => 'Honeywell Portable AC',
            'Lainnya' => 'Lainnya',
        ];

        return view('admin.dataperawatan.edit', compact('data_perawatan', 'nama_mesin'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'pemilik' => 'required|string|max:255',
            'nama_mesin' => 'required|string',
            'tanggal' => 'required|date',
            'teknisi' => 'required|string',
            'aktivitas' => 'required|string',
            'catatan' => 'required|string',
        ], [
            'pemilik.required' => 'Silahkan masukkan nama anda.',
            'nama_mesin.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'tanggal.required' => 'Silahkan masukkan tanggal.',
            'teknisi.required' => 'Silahkan masukkan nama teknisi.',
            'aktivitas.required' => 'Silahkan masukkan aktivitas mesin anda.',
            'catatan.required' => 'Masukkan catatan mesin anda.',
        ]);

        $data_perawatans = DataPerawatan::findOrFail($id);

        $data_perawatans->update([
            'pemilik' => $request->pemilik,
            'nama_mesin' => $request->nama_mesin,
            'tanggal' => $request->tanggal,
            'teknisi' => $request->teknisi,
            'aktivitas' => $request->aktivitas,
            'catatan' => $request->catatan,
        ]);

        $selectednama_mesin = $request->input('nama_mesin');
        session()->flash('selectednama_mesin', $request->nama_mesin);
        $pemilik = $request->input('pemilik');

        return redirect()->route('data-perawatan.index')->with('success', 'Data perawatan  ' . $selectednama_mesin . ' milik ' . $pemilik . ' berhasil diubah!');
    }

    public function destroy($id): RedirectResponse
    {
        $data_perawatans = DataPerawatan::findOrFail($id);

        $data_perawatans->delete();

        return redirect()->route('data-perawatan.store')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
