<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DataPerawatanController extends Controller
{
    public function index(): View
    {
        // $data_perawatans = DataPerawatan::latest()->paginate(5);

        return view('admin.data-perawatan');

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
