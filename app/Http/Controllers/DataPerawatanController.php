<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\DataPerawatan;
use App\Models\DataMesin;
use App\Models\DataPelanggan;
use App\Mail\PerawatanSelesaiMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Exports\DataPerawatanExport;
use Maatwebsite\Excel\Facades\Excel;


class DataPerawatanController extends Controller
{
    public function index(Request $request): View
    {
    // Memastikan user sudah login
    if (Auth::check()) {
        $role_id = Auth::user()->role_id;

        // Jika role_id adalah 2 (Admin)
        if ($role_id == 2) {
            // Mengambil data perawatan dengan join ke mesin dan pelanggan untuk Admin
            $data_perawatans = DataPerawatan::select('data_perawatans.*', 'data_mesins.nama_mesin', 'data_pelanggans.nama')
                ->leftJoin('data_mesins', 'data_perawatans.mesin_id', '=', 'data_mesins.id')
                ->leftJoin('data_pelanggans', 'data_perawatans.pemilik_id', '=', 'data_pelanggans.id')
                ->get();

            // Mengembalikan view untuk Admin dengan data yang diambil
            return view('admin.dataperawatan.data-perawatan_admin', compact('data_perawatans'));
        }
        // Jika role_id adalah 1 (Teknisi)
        elseif ($role_id == 1) {
            // Mengambil data perawatan untuk teknisi yang login
            $data_perawatans = DataPerawatan::select('data_perawatans.*', 'data_mesins.nama_mesin', 'data_pelanggans.nama')
                ->leftJoin('data_mesins', 'data_perawatans.mesin_id', '=', 'data_mesins.id')
                ->leftJoin('data_pelanggans', 'data_perawatans.pemilik_id', '=', 'data_pelanggans.id')
                ->where('data_perawatans.user_id', Auth::user()->id)
                ->get();

            // Mengembalikan view untuk teknisi dengan data yang diambil
            return view('admin.dataperawatan.data-perawatan', compact('data_perawatans'));
        }
    }

    // Jika user tidak login, arahkan ke halaman login
    return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
    }

    public function create(): View
    {
    // Cek jika user sudah login
    if (Auth::check()) {
        $role_id = Auth::user()->role_id;

        // Jika role_id == 2 (Admin)
        if ($role_id == 2) {
            // Ambil data teknisi dengan role_id == 1
            $teknisis = User::where('role_id', 1)->get();

            // Ambil daftar mesin untuk admin berdasarkan user_id yang sedang login
            $data_mesins = DataMesin::where('data_mesins.user_id', Auth::user()->id)->get();

            // Ambil semua data pelanggan
            $data_pelanggans = DataPelanggan::get();

            // Kembalikan view untuk admin dengan data yang diperlukan
            return view('admin.dataperawatan.create_admin', compact('data_mesins', 'data_pelanggans', 'teknisis'));
        }
        // Jika role_id == 1 (Teknisi)
        elseif ($role_id == 1) {
            // Ambil daftar mesin untuk teknisi berdasarkan user_id yang sedang login
            $data_mesins = DataMesin::where('data_mesins.user_id', Auth::user()->id)->get();

            // Ambil data pelanggan untuk teknisi
            $data_pelanggans = DataPelanggan::get();

            // Kembalikan view untuk teknisi dengan data yang diperlukan
            return view('admin.dataperawatan.create', compact('data_mesins', 'data_pelanggans'));
        }
    }
    // Jika user tidak login, arahkan ke halaman login
    return redirect()->route('login')->with('error', 'Anda harus login untuk menambahkan data perawatan.');
    }


    public function store(Request $request): RedirectResponse
    {
    // Cek jika user sudah login
    if (Auth::check()) {
        $role_id = Auth::user()->role_id;

        // Validasi form
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

        // Proses penyimpanan data berdasarkan role
        if ($role_id == 2) {
            // Jika role_id == 2 (Admin), set user_id dengan admin yang login
            DataPerawatan::create([
                'user_id' => Auth::user()->id,  // Gunakan Auth::user()->id untuk admin
                'user_id' => $request->user_id,
                'pemilik_id' => $request->pemilik_id,
                'mesin_id' => $request->mesin_id,
                'tanggal_perawatan' => $request->tanggal_perawatan,
                'aktivitas' => $request->aktivitas,
                'catatan' => $request->catatan,
                'status_perawatan' => $request->status_perawatan,
            ]);

            // Redirect ke halaman data perawatan admin
            return redirect()->route('data-perawatan_admin.index')->with('success', 'Data perawatan berhasil ditambahkan!');
        } elseif ($role_id == 1) {
            // Jika role_id == 1 (Teknisi), set user_id dengan teknisi yang login
            DataPerawatan::create([
                'user_id' => Auth::user()->id,  // Gunakan Auth::user()->id untuk teknisi
                'pemilik_id' => $request->pemilik_id,
                'mesin_id' => $request->mesin_id,
                'tanggal_perawatan' => $request->tanggal_perawatan,
                'aktivitas' => $request->aktivitas,
                'catatan' => $request->catatan,
                'status_perawatan' => $request->status_perawatan,
            ]);

            // Redirect ke halaman data perawatan teknisi
            return redirect()->route('data-perawatan.index')->with('success', 'Data perawatan berhasil ditambahkan!');
        }
    }

    // Jika tidak login, redirect ke halaman login
    return redirect()->route('login')->with('error', 'Anda harus login untuk menambahkan data perawatan.');
    }

    public function edit(string $id): View
    {
    // Cek apakah user sudah login
    if (Auth::check()) {
        $role_id = Auth::user()->role_id;

        // Cari data perawatan berdasarkan ID
        $data_perawatans = DataPerawatan::findOrFail($id);

        // Ambil mesin terkait dengan user yang sedang login
        $data_mesins = DataMesin::where('data_mesins.user_id', Auth::user()->id)->get();

        // Ambil semua data pelanggan
        $data_pelanggans = DataPelanggan::get();

        // Jika role_id = 2 (Admin), ambil data teknisi
        if ($role_id == 2) {
            $teknisis = User::where('role_id', 1)->get();
            return view('admin.dataperawatan.edit_admin', compact('data_perawatans', 'data_mesins', 'data_pelanggans', 'teknisis'));
        }

        // Jika role_id = 1 (Teknisi), hanya data perawatan dan mesin yang relevan
        if ($role_id == 1) {
            return view('admin.dataperawatan.edit_admin', compact('data_perawatans', 'data_mesins', 'data_pelanggans'));
        }
    }

    // Jika user tidak terautentikasi, redirect ke login atau tampilkan pesan error
    return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;

            // Validasi input request
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

            // Jika role_id adalah 2 (admin)
            if ($role_id == 2) {
                // Cari data perawatan berdasarkan ID
                $data_perawatan = DataPerawatan::findOrFail($id);

                // Simpan status sebelum update
                $status_before = $data_perawatan->status_perawatan;

                // Update data perawatan
                $data_perawatan->update([
                    'user_id' => $request->user_id,
                    'pemilik_id' => $request->pemilik_id,
                    'mesin_id' => $request->mesin_id,
                    'tanggal_perawatan' => $request->tanggal_perawatan,
                    'aktivitas' => $request->aktivitas,
                    'catatan' => $request->catatan,
                    'status_perawatan' => $request->status_perawatan,
                ]);

                // Kirim email jika status perawatan berubah menjadi selesai
                if ($request->status_perawatan == 1 && $status_before != 1) {
                    // Cari data pemilik berdasarkan ID yang baru dipilih
                    $pemilik = DataPelanggan::find($request->pemilik_id);

                    // Pastikan pemilik ada dan memiliki email
                    if ($pemilik && $pemilik->email) {
                        // Kirim email pemberitahuan
                        Mail::to($pemilik->email)->send(new PerawatanSelesaiMail([
                            'subject' => 'Perawatan Mesin Selesai! 🎉',
                            'title' => 'Perawatan Mesin Anda Telah Selesai! 🎉',
                            'nama' => $pemilik->nama,
                        ]));
                    }
                }

                // Redirect dengan pesan sukses
                return redirect()->route('data-perawatan_admin.index')->with('success', 'Data perawatan milik ' . $request->pemilik_id . ' berhasil diubah!');
            }

            // Jika role_id adalah 1 (teknisi), hanya bisa mengedit data tertentu
            if ($role_id == 1) {
                // Cari data perawatan berdasarkan ID yang dimiliki oleh teknisi
                $data_perawatan = DataPerawatan::findOrFail($id);

                // Cek apakah teknisi hanya boleh mengedit status atau catatan tertentu
                // Misalnya, teknisi hanya bisa mengubah catatan dan aktivitas, bukan pemilik atau status perawatan
                $data_perawatan->update([
                    'aktivitas' => $request->aktivitas,
                    'catatan' => $request->catatan,
                ]);

                // Setelah update, redirect dengan pesan sukses
                return redirect()->route('data-perawatan.index')->with('success', 'Data perawatan milik ' . $request->pemilik_id . ' berhasil diperbarui oleh teknisi!');
            }
        }

        // Jika pengguna tidak memiliki akses
        return redirect()->route('data-perawatan.index')->with('error', 'Anda tidak memiliki izin untuk mengedit data perawatan ini.');
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
