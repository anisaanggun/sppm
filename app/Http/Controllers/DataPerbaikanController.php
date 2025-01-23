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
use App\Exports\DataPerbaikanExport;
use Maatwebsite\Excel\Facades\Excel;

class DataPerbaikanController extends Controller
{
    public function index(Request $request): View
    {
        if (Auth::check()){
            $role_id = Auth::user()->role_id;

            if ($role_id == 2){
            $data_perbaikans = DataPerbaikan::select('data_perbaikans.*', 'data_mesins.nama_mesin', 'data_pelanggans.nama')
                ->leftJoin('data_mesins', 'mesin_id', '=', 'data_mesins.id')
                ->leftJoin('data_pelanggans', 'data_perbaikans.pemilik_id', '=', 'data_pelanggans.id')
                ->get();

                return view('admin.dataperbaikan.data-perbaikan_admin', compact('data_perbaikans'));
            }
            elseif ($role_id == 1){
                $data_perbaikans = DataPerbaikan::select('data_perbaikans.*', 'data_mesins.nama_mesin', 'data_pelanggans.nama')
                ->leftJoin('data_mesins', 'mesin_id', '=', 'data_mesins.id')
                ->leftJoin('data_pelanggans', 'data_perbaikans.pemilik_id', '=', 'data_pelanggans.id')
                ->where('data_perbaikans.user_id', Auth::user()->id)
                ->get();

                return view('admin.dataperbaikan.data-perbaikan', compact('data_perbaikans'));
            }
        }
        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
    }

    public function create(): View
    {
        if (Auth::check()){
            $role_id = Auth::user()->role_id;

            if ($role_id == 2){
                $teknisis = User::where('role_id', 1)->get();
                //Daftar nama_mesin untuk select
                $data_mesins = DataMesin::get();
                $data_pelanggans = DataPelanggan::get();
                // dd($data_mesins);
                return view('admin.dataperbaikan.create_admin', compact('data_mesins', 'data_pelanggans', 'teknisis'));
            }
            elseif ($role_id == 1){
                $data_mesins = DataMesin::where('data_mesins.user_id', Auth::user()->id)->get();
                $data_pelanggans = DataPelanggan::get();
                // dd($data_mesins);
                return view('admin.dataperbaikan.create', compact('data_mesins', 'data_pelanggans'));
            }
        }
        return redirect()->route('login')->with('error', 'Anda harus login untuk menambahkan data perbaikan.');
    }

    public function store(Request $request): RedirectResponse
    {
        if (Auth::check()){
            $role_id = Auth::user()->role_id;
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

            if ($role_id == 2){
                //create data perbaikan
                DataPerbaikan::create([
                    // 'user_id' => Auth::user()->id,
                    'user_id' => $request->user_id,
                    'pemilik_id' => $request->pemilik_id,
                    'mesin_id' => $request->mesin_id,
                    'tanggal' => $request->tanggal,
                    'kerusakan' => $request->kerusakan,
                    'catatan' => $request->catatan,
                    'status_perbaikan' => $request->status_perbaikan,
                ]);

                return redirect()->route('data-perbaikan_admin.index')->with('success', 'Data perbaikan berhasil ditambahkan!');
            } elseif ($role_id == 1){
                DataPerbaikan::create([
                    'user_id' => Auth::user()->id,
                    'pemilik_id' => $request->pemilik_id,
                    'mesin_id' => $request->mesin_id,
                    'tanggal' => $request->tanggal,
                    'kerusakan' => $request->kerusakan,
                    'catatan' => $request->catatan,
                    'status_perbaikan' => $request->status_perbaikan,
                ]);

                return redirect()->route('data-perbaikan.index')->with('success', 'Data perbaikan berhasil ditambahkan!');
            }
        }
        return redirect()->route('login')->with('error', 'Anda harus login untuk menambahkan data perbaikan.');
    }

    public function edit(string $id): View
    {
        if (Auth::check()){
            $role_id = Auth::user()->role_id;
            $data_perbaikans = DataPerbaikan::findOrFail($id);
            $data_mesins = DataMesin::get();
            $data_pelanggans = DataPelanggan::get();

            if ($role_id == 2){
                $teknisis = User::where('role_id', 1)->get();
                return view('admin.dataperbaikan.edit_admin', compact('data_perbaikans', 'data_mesins', 'data_pelanggans', 'teknisis'));
            }
            if ($role_id == 1){
                return view('admin.dataperbaikan.edit', compact('data_perbaikans', 'data_mesins', 'data_pelanggans'));
            }
        }
        return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
    }

    public function update(Request $request, $id): RedirectResponse
{
    if (Auth::check()){
        $role_id = Auth::user()->role_id;

        // Validasi input dari form
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

       
        // Cek role_id
        if ($role_id == 2) {  // Admin
            $data_perbaikans = DataPerbaikan::findOrFail($id);

             // Simpan status sebelumnya sebelum update
            $status_before = $data_perbaikans->status_perbaikan;

            $data_perbaikans->update([
                'user_id' => $request->user_id,
                'pemilik_id' => $request->pemilik_id,
                'mesin_id' => $request->mesin_id,
                'tanggal' => $request->tanggal,
                'kerusakan' => $request->kerusakan,
                'catatan' => $request->catatan,
                'status_perbaikan' => $request->status_perbaikan,
            ]);

            // Cek jika status perbaikan berubah menjadi selesai (status 1)
            if ($request->status_perbaikan == 1 && $status_before != 1) {
                $pemilik = DataPelanggan::find($request->pemilik_id);

                if ($pemilik && $pemilik->email) {
                    Mail::to($pemilik->email)->send(new PerbaikanSelesaiMail([
                        'subject' => 'Perbaikan Mesin Selesai! 🎉',
                        'title' => 'Perbaikan Mesin Anda Telah Selesai! 🎉',
                        'nama' => $pemilik->nama,
                    ]));
                }
            }

            return redirect()->route('data-perbaikan_admin.index')->with('success', 'Data perbaikan berhasil diubah!');
       
        } elseif ($role_id == 1) {  // Teknisi
            $data_perbaikans = DataPerbaikan::findOrFail($id);

            // Simpan status sebelumnya sebelum update
            $status_before = $data_perbaikans->status_perbaikan;

            $data_perbaikans->update([
                
                'pemilik_id' => $request->pemilik_id,
                'mesin_id' => $request->mesin_id,
                'tanggal' => $request->tanggal,
                'kerusakan' => $request->kerusakan,
                'catatan' => $request->catatan,
                'status_perbaikan' => $request->status_perbaikan,
            ]);

            // Cek jika status perbaikan berubah menjadi selesai (status 1)
            if ($request->status_perbaikan == 1 && $status_before != 1) {
                $pemilik = DataPelanggan::find($request->pemilik_id);

                if ($pemilik && $pemilik->email) {
                    Mail::to($pemilik->email)->send(new PerbaikanSelesaiMail([
                        'subject' => 'Perbaikan Mesin Selesai! 🎉',
                        'title' => 'Perbaikan Mesin Anda Telah Selesai! 🎉',
                        'nama' => $pemilik->nama,
                    ]));
                }
            }

            return redirect()->route('data-perbaikan.index')->with('success', 'Data perbaikan berhasil diubah!');
        }

        // Jika role_id bukan 1 atau 2, tampilkan error
        return redirect()->route('data-perbaikan.index')->with('error', 'Anda tidak memiliki izin untuk mengedit data perbaikan ini.');
    }

    // Jika tidak login
    return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
}



    public function destroy($id): RedirectResponse
    {
        $data_perbaikans = DataPerbaikan::findOrFail($id);

        $data_perbaikans->delete();

        return redirect()->route('data-perbaikan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function export_excel()
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            // Ambil role_id dari pengguna yang sedang login
            $role_id = Auth::user()->role_id;

            if ($role_id == 2) {
                $data_perbaikans = DataPerbaikan::with(['pemilik', 'mesin', 'user'])
                ->get();
            } elseif ($role_id == 1) {
                $data_perbaikans = DataPerbaikan::with(['pemilik', 'mesin'])
                ->where('user_id', Auth::user()->id)
                ->get();
            }
            return Excel::download(new DataPerbaikanExport($data_perbaikans), 'data_perbaikans.xlsx');
        }
    }
}
