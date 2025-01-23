<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\DataMesin;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\LaporanMesin;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class LaporanMesinController extends Controller
{
    public function index()
    {
        $role_id = Auth::user()->role_id; // Ambil role_id dari user yang sedang login

        // Jika role = 2 (Admin), ambil semua data mesin
        // Jika role = 1 (Teknisi), ambil hanya mesin milik user yang login
        if ($role_id == 2) {
            // Admin dapat melihat data mesin dari semua teknisi/user
            $data_mesins = DataMesin::all();
        } else {
            // Teknisi hanya dapat melihat data mesin miliknya sendiri
            $data_mesins = DataMesin::where('user_id', Auth::user()->id)->get();
        }

        // Ambil semua brand untuk laporan
        $brands = Brand::all();

        // Hitung jumlah mesin per brand
        $jumlah_mesin_per_brand = [];

        foreach ($brands as $brand) {
            $jumlah_mesin_per_brand[$brand->brand_name] = $data_mesins->where('brand_id', $brand->id)->count();
        }

        // Mengirim data ke view
        return view('admin.laporan.laporan-mesin', compact('jumlah_mesin_per_brand'));
    }

}
