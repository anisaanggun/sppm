<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataPerbaikanController extends Controller
{
    public function index() {
        return view('admin.data-perbaikan');

    }
}
