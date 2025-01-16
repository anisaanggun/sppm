<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\DataPerawatan;
use App\Models\DataMesin;
use App\Models\DataPelanggan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Exports\DataPerawatanExport;
use Maatwebsite\Excel\Facades\Excel;

class DataPerawatanController extends Controller
{
    public function index(Request $request): View
    {
        $query = DataPerawatan::select('data_perawatans.*', 'data_mesins.nama_mesin', 'data_pelanggans.nama')
        ->leftJoin('data_mesins', 'mesin_id', '=', 'data_mesins.id')
        ->leftJoin('data_pelanggans', 'data_perawatans.pemilik_id', '=', 'data_pelanggans.id')
        ->where('data_perawatans.user_id', Auth::user()->id);

        $data_perawatans = $query->get();

        return view('admin.dataperawatan.data-perawatan', compact('data_perawatans'));

    }

    public function create(): View
    {
        //Daftar nama_mesin untuk select
        $data_mesins = DataMesin::where('data_mesins.user_id', Auth::user()->id)->get();
        $data_pelanggans = DataPelanggan::get();
        // dd($data_mesins);

        return view('admin.dataperawatan.create', compact('data_mesins', 'data_pelanggans'));

    }

    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'pemilik_id' => 'required',
            'mesin_id' => 'required',
            'tanggal_perawatan' => 'required|date',
            'aktivitas' => 'required|string',
            'catatan' => 'required|string',
            'status_perawatan' => 'required',
        ], [
            'pemilik_id.required' => 'Silahkan masukkan nama pelanggan.',
            'mesin_id.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'tanggal_perawatan.required' => 'Silahkan masukkan tanggal.',
            'aktivitas.required' => 'Silahkan masukkan aktivitas mesin Pemilik.',
            'catatan.required' => 'Silahkan masukkan catatan mesin Pemilik.',
            'status_perawatan.required' => 'Silahkan pilih status perawatan.',
        ]);

        //create data perawatan
        DataPerawatan::create([
            'user_id' => Auth::user()->id,
            'pemilik_id' => $request->pemilik_id,
            'mesin_id' => $request->mesin_id,
            'tanggal_perawatan' => $request->tanggal_perawatan,
            'aktivitas' => $request->aktivitas,
            'catatan' => $request->catatan,
            'status_perawatan' => $request->status_perawatan,
        ]);

        return redirect()->route('data-perawatan.index')->with('success', 'Data perawatan berhasil ditambahkan!');
    }

    public function edit(string $id): View
    {
        $data_perawatans = DataPerawatan::findOrFail($id);
        $data_mesins = DataMesin::where('data_mesins.user_id', Auth::user()->id)->get();
        $data_pelanggans = DataPelanggan::get();
        // dd($data_mesins, $data_perawatans);


        return view('admin.dataperawatan.edit', compact('data_perawatans', 'data_mesins', 'data_pelanggans'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'pemilik_id' => 'required',
            'mesin_id' => 'required',
            'tanggal_perawatan' => 'required|date',
            'aktivitas' => 'required|string',
            'catatan' => 'required|string',
            'status_perawatan' => 'required',
        ], [
            'pemilik_id.required' => 'Silahkan masukkan nama pelanggan.',
            'mesin_id.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'tanggal_perawatan.required' => 'Silahkan masukkan tanggal.',
            'aktivitas.required' => 'Silahkan masukkan aktivitas mesin anda.',
            'catatan.required' => 'Masukkan catatan mesin anda.',
            'status_perawatan.required' => 'Silahkan pilih status perawatan.',
        ]);

        $data_perawatans = DataPerawatan::findOrFail($id);

        $data_perawatans->update([
            'pemilik_id' => $request->pemilik_id,
            'mesin_id' => $request->mesin_id,
            'tanggal_perawatan' => $request->tanggal_perawatan,
            'aktivitas' => $request->aktivitas,
            'catatan' => $request->catatan,
            'status_perawatan' => $request->status_perawatan,
        ]);

        return redirect()->route('data-perawatan.index')->with('success', 'Data perawatan berhasil diubah!');
    }

    public function destroy($id): RedirectResponse
    {
        $data_perawatans = DataPerawatan::findOrFail($id);

        $data_perawatans->delete();

        return redirect()->route('data-perawatan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function export_excel()
    {
        return Excel::download(new DataPerawatanExport, 'data_perawatans.xlsx');
    }
}
