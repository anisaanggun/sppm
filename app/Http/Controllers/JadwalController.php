<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JadwalController extends Controller
{
    public function index(): View
    {
        $jadwals = Jadwal::latest()->paginate(10);

        return view('admin.datajadwal.jadwal');
    }
}
