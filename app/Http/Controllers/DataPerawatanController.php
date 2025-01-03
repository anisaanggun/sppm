<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\DataPerawatan;
use App\Models\DataMesin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DataPerawatanController extends Controller
{
    public function index(Request $request): View
    {
        $query = DataPerawatan::select('data_perawatans.*', 'data_mesins.nama_mesin')
        ->leftJoin('data_mesins', 'mesin_id', '=', 'data_mesins.id')
        ->where('data_perawatans.user_id', Auth::user()->id);
        
        $data_perawatans = $query->get();

        return view('admin.dataperawatan.data-perawatan', compact('data_perawatans'));

    }

    public function create(): View
    {
        //Daftar nama_mesin untuk select
        $data_mesins = DataMesin::where('data_mesins.user_id', Auth::user()->id)->get();
        // dd($data_mesins);

        return view('admin.dataperawatan.create', compact('data_mesins'));

    }

    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'pemilik' => 'required|string|max:255',
            'mesin_id' => 'required',
            'tanggal_perawatan' => 'required|date',
            'teknisi' => 'required|string',
            'aktivitas' => 'required|string',
            'catatan' => 'required|string',
        ], [
            'pemilik.required' => 'Silahkan masukkan nama anda.',
            'mesin_id.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'tanggal_perawatan.required' => 'Silahkan masukkan tanggal.',
            'teknisi.required' => 'Silahkan pilih teknisi.',
            'aktivitas.required' => 'Silahkan masukkan aktivitas mesin anda.',
            'catatan.required' => 'Silahkan masukkan catatan mesin anda.',
        ]);

        //create data perawatan
        DataPerawatan::create([
            'user_id' => Auth::user()->id,
            'pemilik' => $request->pemilik,
            'mesin_id' => $request->mesin_id,
            'tanggal_perawatan' => $request->tanggal_perawatan,
            'teknisi' => $request->teknisi,
            'aktivitas' => $request->aktivitas,
            'catatan' => $request->catatan,
        ]);

        $pemilik = $request->input('pemilik');

        return redirect()->route('data-perawatan.index')->with('success', 'Data perawatan milik ' . $pemilik . ' berhasil ditambahkan!');
    }

    public function edit(string $id): View
    {
        $data_perawatans = DataPerawatan::findOrFail($id);
        $data_mesins = DataMesin::where('data_mesins.user_id', Auth::user()->id)->get();
        // dd($data_mesins, $data_perawatans);
        

        return view('admin.dataperawatan.edit', compact('data_perawatans', 'data_mesins'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'pemilik' => 'required|string|max:255',
            'mesin_id' => 'required',
            'tanggal_perawatan' => 'required|date',
            'teknisi' => 'required|string',
            'aktivitas' => 'required|string',
            'catatan' => 'required|string',
        ], [
            'pemilik.required' => 'Silahkan masukkan nama anda.',
            'mesin_id.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'tanggal_perawatan.required' => 'Silahkan masukkan tanggal.',
            'teknisi.required' => 'Silahkan masukkan nama teknisi.',
            'aktivitas.required' => 'Silahkan masukkan aktivitas mesin anda.',
            'catatan.required' => 'Masukkan catatan mesin anda.',
        ]);

        $data_perawatans = DataPerawatan::findOrFail($id);

        $data_perawatans->update([
            'pemilik' => $request->pemilik,
            'mesin_id' => $request->mesin_id,
            'tanggal_perawatan' => $request->tanggal_perawatan,
            'teknisi' => $request->teknisi,
            'aktivitas' => $request->aktivitas,
            'catatan' => $request->catatan,
        ]);

        $pemilik = $request->input('pemilik');

        return redirect()->route('data-perawatan.index')->with('success', 'Data perawatan milik ' . $pemilik . ' berhasil diubah!');
    }

    public function destroy($id): RedirectResponse
    {
        $data_perawatans = DataPerawatan::findOrFail($id);

        $data_perawatans->delete();

        return redirect()->route('data-perawatan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
