<?php

namespace App\Http\Controllers;

use App\Models\PemilikMesin;
use App\Models\DataMesin;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PemilikMesinController extends Controller
{
    public function index(): View
    {
        $pemilik_mesins = PemilikMesin::select('pemilik_mesins.*', 'data_mesins.nama_mesin', 'users.name')
        ->leftJoin('data_mesins', 'mesin_id', '=', 'data_mesins.id')
        ->leftJoin('users', 'user_id', '=', 'users.id')
        ->latest()->paginate(10);

        return view('admin.pemilik.pemilik-mesin', compact('pemilik_mesins'));

    }

    public function create(): View
    {
        //Daftar nama_mesin untuk select
        $data_mesins = DataMesin::get();
        $data_users = User::get();

        return view('admin.pemilik.create', compact('data_mesins', 'data_users'));

    }

    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'user_id' => 'required',
            'mesin_id' => 'required',
        ], [
            'user_id.required' => 'Silahkan pilih nama anda.',
            'mesin_id.required' => 'Silahkan pilih setidaknya satu nama mesin.',
        ]);

        //create data perawatan
        PemilikMesin::create([
            'user_id' => $request->user_id,
            'mesin_id' => $request->mesin_id,
        ]);

        return redirect()->route('pemilik-mesin.index')->with('success', 'Pemilik mesin berhasil ditambahkan!');
    }

    public function edit(string $id): View
    {
        $pemilik_mesins = PemilikMesin::findOrFail($id);
        $data_mesins = DataMesin::get();
        $data_users = User::get();

        return view('admin.pemilik.edit', compact('pemilik_mesins', 'data_users', 'data_mesins'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'user_id' => 'required',
            'mesin_id' => 'required',
        ], [
            'user_id.required' => 'Silahkan pilih nama anda.',
            'mesin_id.required' => 'Silahkan pilih setidaknya satu nama mesin.',
        ]);

        $pemilik_mesins = PemilikMesin::findOrFail($id);

        $pemilik_mesins->update([
            'user_id' => $request->user_id,
            'mesin_id' => $request->mesin_id,
        ]);

        return redirect()->route('pemilik-mesin.index')->with('success', 'Pemilik mesin berhasil diubah!');
    }

    public function destroy($id): RedirectResponse
    {
        $pemilik_mesins = PemilikMesin::findOrFail($id);

        $pemilik_mesins->delete();

        return redirect()->route('pemilik-mesin.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
