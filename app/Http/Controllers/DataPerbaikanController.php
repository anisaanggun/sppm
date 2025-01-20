<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\DataPerbaikan;
use App\Models\DataMesin;
use App\Models\DataPelanggan;
use App\Mail\PerbaikanSelesaiMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;

class DataPerbaikanController extends Controller
{
    public function index(Request $request): View
    {
        $query = DataPerbaikan::select('data_perbaikans.*', 'data_mesins.nama_mesin', 'data_pelanggans.nama')
        ->leftJoin('data_mesins', 'mesin_id', '=', 'data_mesins.id')
        ->leftJoin('data_pelanggans', 'data_perbaikans.pemilik_id', '=', 'data_pelanggans.id')
        ->where('data_perbaikans.user_id', Auth::user()->id);

        $data_perbaikans = $query->get();

        return view('admin.dataperbaikan.data-perbaikan', compact('data_perbaikans'));

    }

    public function create(): View
    {
        //Daftar nama_mesin untuk select
        $data_mesins = DataMesin::where('data_mesins.user_id', Auth::user()->id)->get();
        $data_pelanggans = DataPelanggan::get();
        // dd($data_mesins);
        return view('admin.dataperbaikan.create', compact('data_mesins', 'data_pelanggans'));
    }

    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'pemilik_id' => 'required',
            'mesin_id' => 'required',
            'tanggal' => 'required|date',
            'kerusakan' => 'required|string',
            'catatan' => 'required|string',
            'status_perbaikan' => 'required',
        ], [
            'pemilik_id.required' => 'Silahkan masukkan nama pelanggan.',
            'mesin_id.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'tanggal.required' => 'Silahkan masukkan tanggal.',
            'kerusakan.required' => 'Silahkan masukkan kerusakan mesin anda.',
            'catatan.required' => 'Masukkan catatan mesin anda.',
            'status_perbaikan.required' => 'Silahkan pilih status perbaikan.',
        ]);

        //create data perbaikan
        DataPerbaikan::create([
            'user_id' => Auth::user()->id,
            'pemilik_id' => $request->pemilik_id,
            'mesin_id' => $request->mesin_id,
            'tanggal' => $request->tanggal,
            'kerusakan' => $request->kerusakan,
            'catatan' => $request->catatan,
            'status_perbaikan' => $request->status_perbaikan,
        ]);

        $pemilik_id = $request->input('pemilik_id');

        return redirect()->route('data-perbaikan.index')->with('success', 'Data perbaikan milik ' . $pemilik_id . ' berhasil ditambahkan!');
    }

    public function edit(string $id): View
    {
        $data_perbaikans = DataPerbaikan::findOrFail($id);
        $data_mesins = DataMesin::where('data_mesins.user_id', Auth::user()->id)->get();
        $data_pelanggans = DataPelanggan::get();

        return view('admin.dataperbaikan.edit', compact('data_perbaikans', 'data_mesins', 'data_pelanggans'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'pemilik_id' => 'required',
            'mesin_id' => 'required',
            'tanggal' => 'required|date',
            'kerusakan' => 'required|string',
            'catatan' => 'required|string',
            'status_perbaikan' => 'required',
        ], [
            'pemilik_id.required' => 'Silahkan masukkan nama pelanggan.',
            'mesin_id.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'tanggal.required' => 'Silahkan masukkan tanggal.',
            'kerusakan.required' => 'Silahkan masukkan kerusakan mesin anda.',
            'catatan.required' => 'Masukkan catatan mesin anda.',
            'status_perbaikan.required' => 'Silahkan pilih status perbaikan.',
        ]);

        $data_perbaikans = DataPerbaikan::findOrFail($id);

        $data_perbaikans->update([
            'pemilik_id' => $request->pemilik_id,
            'mesin_id' => $request->mesin_id,
            'tanggal' => $request->tanggal,
            'kerusakan' => $request->kerusakan,
            'catatan' => $request->catatan,
            'status_perbaikan' => $request->status_perbaikan,
        ]);

        $pemilik_id = $request->input('pemilik_id');

        return redirect()->route('data-perbaikan.index')->with('success', 'Data perbaikan milik ' . $pemilik_id . ' berhasil diubah!');
    }

    public function destroy($id): RedirectResponse
    {
        $data_perbaikans = DataPerbaikan::findOrFail($id);

        $data_perbaikans->delete();

        return redirect()->route('data-perbaikan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
