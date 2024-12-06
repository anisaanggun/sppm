<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanMesin;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class LaporanMesinController extends Controller
{
    public function index()
    {
        return view('admin.laporan.laporan-mesin');
    }
}
