<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DataPelangganController extends Controller
{
    public function index(): View
    {
        $data_pelanggans = DataPelanggan::latest()->get();

        return view('admin.datapelanggan.pelanggan', compact('data_pelanggans'));
    }

    public function create(): View
    {
        return view('admin.datapelanggan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'nama' => 'required|string',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|email',
        ], [
            'nama.required' => 'Silakan masukkan nama pelanggan.',
            'no_hp.required' => 'Silakan masukkan no hp.',
            'alamat.required' => 'Silakan masukkan alamat.',
            'email.required' => 'Silakan masukkan email.',
        ]);

        DataPelanggan::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'email' => $request->email,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function edit(string $id): View
    {
        $data_pelanggans = DataPelanggan::findOrFail($id);

        return view('admin.datapelanggan.edit', compact('data_pelanggans'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|email',
        ], [
            'nama.required' => 'Silakan masukkan nama pelanggan.',
            'no_hp.required' => 'Silakan masukkan no hp.',
            'alamat.required' => 'Silakan masukkan alamat.',
            'email.required' => 'Silakan masukkan email.',
        ]);

        $data_pelanggans = DataPelanggan::findOrFail($id);

        $data_pelanggans->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'email' => $request->email,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diubah!');
    }

    public function destroy($id): RedirectResponse
    {
        $data_pelanggans = DataPelanggan::findOrFail($id);

        $data_pelanggans->delete();

        return redirect()->route('pelanggan.store')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}