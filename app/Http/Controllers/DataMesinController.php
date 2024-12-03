<?php

namespace App\Http\Controllers;

use App\Models\DataMesin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DataMesinController extends Controller
{
    public function index(): View
    {
        $data_mesins = DataMesin::latest()->paginate(10);

        return view('admin.data-mesin', compact('data_mesins'));

    }

    public function create(): View
    {
        //Daftar nama_mesin untuk radio button
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
            'nama_mesin' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
        ], [
            'pemilik.required' => 'Silahkan masukkan nama anda.',
            'nama_mesin.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'brand.required' => 'Silahkan pilih nama brand mesin.',
            'model.required' => 'Silahkan pilih nama model mesin.',
        ]);

        //create data mesin
        DataMesin::create([
            'pemilik' => $request->pemilik,
            'nama_mesin' => $request->nama_mesin,
            'brand' => $request->brand,
            'model' => $request->model,
        ]);

        $selectednama_mesin = $request->input('nama_mesin');
        session()->flash('selectednama_mesin', $request->nama_mesin);
        $pemilik = $request->input('pemilik');

        return redirect()->route('data-mesin.index')->with('success', 'Data mesin  ' . $selectednama_mesin . ' milik ' . $pemilik . ' berhasil ditambahkan!');
    }

    public function edit(string $id): View
    {
        $data_mesins = DataMesin::findOrFail($id);
        $nama_mesin = [
            'Mitsubishi Heavy Industries' => 'Mitsubishi Heavy Industries',
            'LG Window AC' => 'LG Window AC',
            'Honeywell Portable AC' => 'Honeywell Portable AC',
            'Lainnya' => 'Lainnya',
        ];

        return view('admin.edit', compact('data_mesins', 'nama_mesin'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'pemilik' => 'required|string|max:255',
            'nama_mesin' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
        ], [
            'pemilik.required' => 'Silahkan masukkan nama anda.',
            'nama_mesin.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'brand.required' => 'Silahkan pilih nama brand mesin.',
            'model.required' => 'Silahkan pilih nama model mesin.',
        ]);

        $data_mesins = DataMesin::findOrFail($id);

        $data_mesins->update([
            'pemilik' => $request->pemilik,
            'nama_mesin' => $request->nama_mesin,
            'brand' => $request->brand,
            'model' => $request->model,
        ]);

        $selectednama_mesin = $request->input('nama_mesin');
        session()->flash('selectednama_mesin', $request->nama_mesin);
        $pemilik = $request->input('pemilik');

        return redirect()->route('data-mesin.index')->with('success', 'Data mesin  ' . $selectednama_mesin . ' milik ' . $pemilik . ' berhasil diubah!');
    }

    public function destroy($id): RedirectResponse
    {
        $data_mesins = DataMesin::findOrFail($id);

        $data_mesins->delete();

        return redirect()->route('data-mesin.store')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
