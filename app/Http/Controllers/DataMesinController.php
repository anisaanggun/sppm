<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\DataMesin;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DataMesinController extends Controller
{
    public function index(Request $request): View
    {
        $query = DataMesin::select('data_mesins.*', 'brands.brand_name')
        ->leftJoin('brands', 'brand_id', '=', 'brands.id')
        ->where('user_id', Auth::user()->id);
        
        $data_mesins = $query->get();

        return view('admin.datamesin.data-mesin', compact('data_mesins'));

    }

    public function create(): View
    {
        //Daftar brand_name untuk select
        $brands = Brand::get();

        return view('admin.datamesin.create', compact('brands'));
    }

    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'nama_mesin' => 'required|string',
            'brand_id' => 'required',
            'model' => 'required|string',
        ], [
            'brand_id.required' => 'Silahkan pilih nama brand mesin.',
            'nama_mesin.required' => 'Silahkan masukan nama mesin.',
            'model.required' => 'Silahkan pilih nama model mesin.',
        ]);

        //create data mesin
        DataMesin::create([
            'user_id' => Auth::user()->id,
            'nama_mesin' => $request->nama_mesin,
            'brand_id' => $request->brand_id,
            'model' => $request->model,
        ]);

        $selectednama_mesin = $request->input('nama_mesin');
        session()->flash('selectednama_mesin', $request->nama_mesin);

        return redirect()->route('data-mesin.index')->with('success', 'Data mesin  ' . $selectednama_mesin . ' berhasil ditambahkan!');
    }

    public function edit(string $id): View
    {
        $data_mesins = DataMesin::findOrFail($id);
        $brands = Brand::get();

        return view('admin.datamesin.edit', compact('data_mesins', 'brands'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'nama_mesin' => 'required|string',
            'brand_id' => 'required',
            'model' => 'required|string',
        ], [
            'nama_mesin.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'brand_id.required' => 'Silahkan pilih nama brand mesin.',
            'model.required' => 'Silahkan pilih nama model mesin.',
        ]);

        $data_mesins = DataMesin::findOrFail($id);

        $data_mesins->update([
            'nama_mesin' => $request->nama_mesin,
            'brand_id' => $request->brand_id,
            'model' => $request->model,
        ]);

        $selectednama_mesin = $request->input('nama_mesin');
        session()->flash('selectednama_mesin', $request->nama_mesin);

        return redirect()->route('data-mesin.index')->with('success', 'Data mesin  ' . $selectednama_mesin . ' berhasil diubah!');
    }

    public function destroy($id): RedirectResponse
    {
        $data_mesins = DataMesin::findOrFail($id);

        $data_mesins->delete();

        return redirect()->route('data-mesin.store')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    // public function search(Request $request)
    // {
    //     $keyword = $request->input('cari');
    //     $data_mesins = DataMesin::where('nama_mesin', 'like', "%" . $keyword . "%")->paginate(10);

    //     return view('admin.datamesin.data-mesin', compact('data_mesins'));
    // }
}
