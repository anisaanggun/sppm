<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DataPerbaikanController extends Controller
{
    public function index(): View
    {
        // $data_perbaikans = DataPerbaikan::latest()->paginate(5);

        return view('admin.data-perbaikan');
    }

    public function create(): View
    {

    }

    public function store(Request $request): RedirectResponse
    {

    }

    public function update(Request $request, $id): RedirectResponse
    {

    }

    public function destroy($id): RedirectResponse
    {

    }
}
