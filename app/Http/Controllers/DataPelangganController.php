<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\DataPelanggan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Exports\DataPelangganExport;
use Maatwebsite\Excel\Facades\Excel;

class DataPelangganController extends Controller
{
    public function index(): View
    {
        if (Auth::check()) {
            // Ambil role user yang sedang login
            $role_id = Auth::user()->role_id;
    
            // Jika role_id adalah 2 (admin), ambil semua pelanggan
            if ($role_id == 2) {
                $data_pelanggans2 = DataPelanggan::with('user')->get();
                return view('admin.datapelanggan.pelanggan_admin', compact('data_pelanggans2'));
            }
            // Jika role_id adalah 1 (user biasa), ambil pelanggan berdasarkan user_id
            elseif ($role_id == 1) {
                $data_pelanggans = DataPelanggan::where('user_id', Auth::user()->id)->get();
                return view('admin.datapelanggan.pelanggan', compact('data_pelanggans'));
            }
        }
    }

    public function create(): View
    {
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
    
            if ($role_id == 2) {
                // Ambil semua pelanggan atau teknisi untuk admin
                $teknisis = User::where('role_id', 1)->get();
                // dd($teknisis);
                return view('admin.datapelanggan.create_admin', compact('teknisis'));
            } elseif ($role_id == 1) {
                return view('admin.datapelanggan.create');
            }
        }

    }

    public function store(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
    
            // Validasi data
            $validatedData = $request->validate([
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
    
            // Proses data sesuai dengan role_id
            if ($role_id == 2) {
                // Jika admin (role_id == 2), ambil user_id dari request
                DataPelanggan::create([
                    'user_id' => $request->user_id,
                    'nama' => $validatedData['nama'],
                    'no_hp' => $validatedData['no_hp'],
                    'alamat' => $validatedData['alamat'],
                    'email' => $validatedData['email'],
                ]);

                return redirect()->route('pelanggan_admin.index')->with('success', 'Pelanggan berhasil ditambahkan!');

            } elseif ($role_id == 1) {
                // Jika user (role_id == 1), gunakan Auth::user()->id untuk user_id
                DataPelanggan::create([
                    'user_id' => Auth::user()->id,
                    'nama' => $validatedData['nama'],
                    'no_hp' => $validatedData['no_hp'],
                    'alamat' => $validatedData['alamat'],
                    'email' => $validatedData['email'],
                ]);
                
                return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
            }
        }
    }

    public function edit(string $id): View
    {
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
    
            // Jika role_id adalah 2 (admin), admin bisa mengedit pelanggan apapun
            if ($role_id == 2) {

                $data_pelanggans2 = DataPelanggan::findOrFail($id);

                $teknisis = User::where('role_id', 1)->get();

                return view('admin.datapelanggan.edit_admin', compact('data_pelanggans2', 'teknisis'));
            }
    
            // Jika role_id adalah 1 (user biasa), user hanya bisa mengedit pelanggan mereka sendiri
            elseif ($role_id == 1) {

                $data_pelanggans = DataPelanggan::findOrFail($id);
    
                return view('admin.datapelanggan.edit', compact('data_pelanggans'));
            }
        }
        
    }

    public function update(Request $request, $id): RedirectResponse
    {
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
    
            // Validasi data
            $validatedData = $request->validate([
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
    
            // Proses data sesuai dengan role_id
            if ($role_id == 2) {
                // Admin (role_id == 2) bisa mengubah data pelanggan milik siapa saja
                $data_pelanggans2 = DataPelanggan::findOrFail($id);
    
                // Update data pelanggan
                $data_pelanggans2->update([
                    'user_id' => $request->user_id,  // Admin memilih user_id untuk data pelanggan
                    'nama' => $validatedData['nama'],
                    'no_hp' => $validatedData['no_hp'],
                    'alamat' => $validatedData['alamat'],
                    'email' => $validatedData['email'],
                ]);
    
                return redirect()->route('pelanggan_admin.index')->with('success', 'Data pelanggan berhasil diubah!');
    
            } elseif ($role_id == 1) {
                // User (role_id == 1) hanya bisa mengubah data pelanggan mereka sendiri
                $data_pelanggans = DataPelanggan::findOrFail($id);
    
                // Update data pelanggan
                $data_pelanggans->update([
                    'user_id' => Auth::user()->id,  // User akan memperbarui dengan user_id mereka sendiri
                    'nama' => $validatedData['nama'],
                    'no_hp' => $validatedData['no_hp'],
                    'alamat' => $validatedData['alamat'],
                    'email' => $validatedData['email'],
                ]);
    
                return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diubah!');
            }
        }
    }

    public function destroy($id): RedirectResponse
    {
        $data_pelanggans = DataPelanggan::findOrFail($id);

        $data_pelanggans->delete();

        return redirect()->route('pelanggan.store')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function export_excel()
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            // Ambil role_id dari pengguna yang sedang login
            $role_id = Auth::user()->role_id;

            if ($role_id == 2) {
                // Jika role adalah admin (role_id == 2), ambil semua data pelanggan
                $data_pelanggans = DataPelanggan::with(['user']) // Dapatkan data pelanggan beserta data teknisi (user)
                    ->get();
            } elseif ($role_id == 1) {
                // Jika role adalah user (role_id == 1), ambil data pelanggan milik teknisi yang sedang login
                $data_pelanggans = DataPelanggan::with(['user']) // Dapatkan data pelanggan beserta data teknisi (user)
                    ->where('user_id', Auth::user()->id)
                    ->get();
            }

            // Mengunduh file Excel
            return Excel::download(new DataPelangganExport($data_pelanggans), 'data_pelanggans.xlsx');
        }
        
    }
}
