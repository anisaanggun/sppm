<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\DataMesin;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class PemilikMesinController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        
        //create data pemilik mesin
        PemilikMesin::create([
            'user_id' => Auth::user()->id,
            'mesin_id' => $request->nama_mesin,
        ]);

    }
}
