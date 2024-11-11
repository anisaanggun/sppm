<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataPerawatanController extends Controller
{
    public function index() {
        return view('admin.data-perawatan');
    }
}

