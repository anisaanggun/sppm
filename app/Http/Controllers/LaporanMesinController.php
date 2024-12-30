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
        // Ambil data dari database
        $data_mesins = DataMesin::where('data_mesins.user_id', Auth::user()->id)->get();
        $brands = Brand::get();


        $jumlah_mesin_per_brand = [];

        foreach ($brands as $brand) {
        $jumlah_mesin_per_brand[$brand->brand_name] = $data_mesins->where('brand_id', $brand->id)->count();
        }

        return view('admin.laporan.laporan-mesin', compact('jumlah_mesin_per_brand'));

    }
}
