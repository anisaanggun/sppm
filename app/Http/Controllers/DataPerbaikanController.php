<?php

namespace App\Http\Controllers;

use App\Models\DataPerbaikan;
use App\Models\DataMesin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DataPerbaikanController extends Controller
{
    public function index(): View
    {
        $data_perbaikans = DataPerbaikan::latest()->paginate(10);

        return view('admin.dataperbaikan.data-perbaikan', compact('data_perbaikans'));

    }

    public function create(): View
    {
        //Daftar nama_mesin untuk select
        $data_mesins = DataMesin::get();
        // dd($data_mesins);
        return view('admin.dataperbaikan.create', compact('data_mesins'));
    }

    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'pemilik' => 'required|string|max:255',
            'mesin_id' => 'required',
            'tanggal' => 'required|date',
            'teknisi' => 'required|string',
            'kerusakan' => 'required|string',
            'catatan' => 'required|string',
        ], [
            'pemilik.required' => 'Silahkan masukkan nama anda.',
            'mesin_id.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'tanggal.required' => 'Silahkan masukkan tanggal.',
            'teknisi.required' => 'Silahkan nama teknisi.',
            'kerusakan.required' => 'Silahkan masukkan kerusakan mesin anda.',
            'catatan.required' => 'Masukkan catatan mesin anda.',
        ]);

        //create data perbaikan
        DataPerbaikan::create([
            'pemilik' => $request->pemilik,
            'mesin_id' => $request->mesin_id,
            'tanggal' => $request->tanggal,
            'teknisi' => $request->teknisi,
            'kerusakan' => $request->kerusakan,
            'catatan' => $request->catatan,
        ]);

        $pemilik = $request->input('pemilik');

        return redirect()->route('data-perbaikan.index')->with('success', 'Data perbaikan  ' . ' milik ' . $pemilik . ' berhasil ditambahkan!');
    }

    public function edit(string $id): View
    {
        $data_perbaikans = DataPerbaikan::findOrFail($id);
        $data_mesins = DataMesin::get();

        return view('admin.dataperbaikan.edit', compact('data_perbaikan', 'mesin_id'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'pemilik' => 'required|string|max:255',
            'mesin_id' => 'required',
            'tanggal' => 'required|date',
            'teknisi' => 'required|string',
            'kerusakan' => 'required|string',
            'catatan' => 'required|string',
        ], [
            'pemilik.required' => 'Silahkan masukkan nama anda.',
            'mesin_id.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'tanggal.required' => 'Silahkan masukkan tanggal.',
            'teknisi.required' => 'Silahkan masukkan nama teknisi.',
            'kerusakan.required' => 'Silahkan masukkan kerusakan mesin anda.',
            'catatan.required' => 'Masukkan catatan mesin anda.',
        ]);

        $data_perbaikans = DataPerbaikan::findOrFail($id);

        $data_perbaikans->update([
            'pemilik' => $request->pemilik,
            'mesin_id' => $request->mesin_id,
            'tanggal' => $request->tanggal,
            'teknisi' => $request->teknisi,
            'kerusakan' => $request->kerusakan,
            'catatan' => $request->catatan,
        ]);

        $selectedID = $request->input('mesin_id');
        session()->flash('selectedID', $request->mesin_id);
        $pemilik = $request->input('pemilik');

        return redirect()->route('data-perbaikan.index')->with('success', 'Data perbaikan dengan ID  ' . $selectedID . ' milik ' . $pemilik . ' berhasil diubah!');
    }

    public function destroy($id): RedirectResponse
    {
        $data_perbaikans = DataPerbaikan::findOrFail($id);

        $data_perbaikans->delete();

        return redirect()->route('data-perbaikan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
