<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPerawatan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LaporanPerawatanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.laporan-perawatan');
    }
}
