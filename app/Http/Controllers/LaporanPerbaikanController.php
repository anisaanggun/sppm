<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPerbaikan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LaporanPerbaikanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.laporan-perbaikan');
    }
}
