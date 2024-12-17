<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function index(): View
    {
        $brands = Brand::latest()->paginate(10);

        return view('admin.databrand.brand', compact('brands'));

    }

    public function create(): View
    {
        return view('admin.databrand.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ], [
            'brand_name.required' => 'Silakan masukan nama brand.',
        ]);

        //create data mesin
        Brand::create([
            'brand_name' => $request->brand_name,
        ]);

        return redirect()->route('brand.index')->with('success', 'Brand baru berhasil ditambahkan!');
    }

    public function edit(string $id): View
    {
        $brands = Brand::findOrFail($id);

        return view('admin.databrand.edit', compact('brands'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'brand_name' => 'required|string',
        ], [
            'brand_name.required' => 'Silakan masukan nama brand.',
        ]);

        $brands = Brand::findOrFail($id);

        $brands->update([
            'brand_name' => $request->brand_name,
        ]);

        return redirect()->route('brand.index')->with('success', 'Nama brand berhasil diubah!');
    }

    public function destroy($id): RedirectResponse
    {
        $brands = Brand::findOrFail($id);

        $brands->delete();

        return redirect()->route('brand.store')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
