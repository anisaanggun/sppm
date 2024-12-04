<?php

namespace App\Http\Controllers;

use App\Models\DataPerbaikan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DataPerbaikanController extends Controller
{
    public function index(): View
    {
        $data_perbaikans = DataPerbaikan::latest()->paginate(10);

        return view('admin.data-perbaikan', compact('data_perbaikans'));

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

        return view('admin.create', compact('nama_mesin'));
    }

    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'pemilik' => 'required|string|max:255',
            'nama_mesin' => 'required|array|min:1',
            'nama_mesin.*' => 'string',
            'tanggal' => 'required|date',
            'teknisi' => 'required|string',
            'kerusakan' => 'required|string',
            'catatan' => 'required|string',
        ], [
            'pemilik.required' => 'Silahkan masukkan nama anda.',
            'nama_mesin.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'nama_mesin.min' => 'Silahkan pilih setidaknya satu nama mesin.',
            'tanggal.required' => 'Silahkan masukkan tanggal.',
            'teknisi.required' => 'Silahkan nama teknisi.',
            'kerusakan.required' => 'Silahkan masukkan kerusakan mesin anda.',
            'catatan.required' => 'Masukkan catatan mesin anda.',
        ]);

        //create data perbaikan
        DataPerbaikan::create([
            'pemilik' => $request->pemilik,
            'nama_mesin' => json_encode($request->nama_mesin),
            'tanggal' => $request->tanggal,
            'teknisi' => $request->teknisi,
            'kerusakan' => $request->kerusakan,
            'catatan' => $request->catatan,
        ]);

        $selectednama_mesin = $request->input('nama_mesin', []);
        session()->flash('selectednama_mesin', $request->nama_mesin);
        $pemilik = $request->input('pemilik');

        return redirect()->route('data-perbaikan.index')->with('success', 'Data perbaikan  ' . implode(', ', $selectednama_mesin) . ' milik ' . $pemilik . ' berhasil ditambahkan!');
    }

    public function edit(string $id): View
    {
        $data_perbaikans = DataPerbaikan::findOrFail($id);
        $nama_mesin = [
            'Mitsubishi Heavy Industries' => 'Mitsubishi Heavy Industries',
            'LG Window AC' => 'LG Window AC',
            'Honeywell Portable AC' => 'Honeywell Portable AC',
            'Lainnya' => 'Lainnya',
        ];

        return view('admin.edit', compact('data_perbaikans', 'nama_mesin'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'pemilik' => 'required|string|max:255',
            'nama_mesin' => 'required|array|min:1',
            'nama_mesin.*' => 'string',
            'tanggal' => 'required|date',
            'teknisi' => 'required|string',
            'kerusakan' => 'required|string',
            'catatan' => 'required|string',
        ], [
            'pemilik.required' => 'Silahkan masukkan nama anda.',
            'nama_mesin.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'nama_mesin.min' => 'Silahkan pilih setidaknya satu nama mesin.',
            'tanggal.required' => 'Silahkan masukkan tanggal.',
            'teknisi.required' => 'Silahkan masukkan nama teknisi.',
            'kerusakan.required' => 'Silahkan masukkan kerusakan mesin anda.',
            'catatan.required' => 'Masukkan catatan mesin anda.',
        ]);

        $data_perbaikans = DataPerbaikan::findOrFail($id);

        $data_perbaikans->update([
            'pemilik' => $request->pemilik,
            'nama_mesin' => json_encode($request->nama_mesin),
            'tanggal' => $request->tanggal,
            'teknisi' => $request->teknisi,
            'kerusakan' => $request->kerusakan,
            'catatan' => $request->catatan,
        ]);

        $selectednama_mesin = $request->input('nama_mesin', []);
        session()->flash('selectednama_mesin', $request->nama_mesin);
        $pemilik = $request->input('pemilik');

        return redirect()->route('data-perbaikan.index')->with('success', 'Data perbaikan  ' . implode(', ', $selectednama_mesin) . ' milik ' . $pemilik . ' berhasil diubah!');
    }

    public function destroy($id): RedirectResponse
    {
        $data_perbaikans = DataPerbaikan::findOrFail($id);

        $data_perbaikans->delete();

        return redirect()->route('data-perbaikan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
