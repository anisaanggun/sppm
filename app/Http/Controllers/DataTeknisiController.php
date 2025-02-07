<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\DataTeknisi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use App\Exports\DataTeknisiExport;
use Maatwebsite\Excel\Facades\Excel;

class DataTeknisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_teknisis = User::get();

        return view('admin.datateknisi.teknisi', compact('data_teknisis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.datateknisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        // validasi form
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            // 'password' => 'required|min:6', 
            'no_hp' => 'required|numeric',
        ], [
            'name.required' => 'Silahkan masukkan nama teknisi.',
            'email.required' => 'Silahkan masukkan alamat email teknisi.',
            'no_hp.required' => 'Silahkan masukkan no hp teknisi.',
            
        ]);

        $password = $request->has('password') ? Hash::make($request->password) : Hash::make('default_password');
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'role_id' => 1,
            'password' => $password,
        ]);

        return redirect()->route('teknisi.index')->with('success', 'Teknisi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(DataTeknisi $dataTeknisi)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $data_teknisis = User::findOrFail($id);

        return view('admin.datateknisi.edit', compact('data_teknisis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'no_hp' => 'required|numeric',
            'password_baru' => 'nullable|min:6', 
        ], [
            'name.required' => 'Silahkan masukkan nama teknisi.',
            'email.required' => 'Silahkan masukkan alamat email teknisi.',
            'no_hp.required' => 'Silahkan masukkan no hp teknisi.',
            'password_baru.min' => 'Silahkan masukkan password minimal 6 karakter.',
        ]);

        $data_teknisis = User::findOrFail($id);

        $data_teknisis->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'password' => $request->password_baru ? Hash::make($request->password_baru) : $data_teknisis->password,
        ]);

        return redirect()->route('teknisi.index')->with('success', 'Data teknisi berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $data_teknisis = User::findOrFail($id);

        $data_teknisis->delete();

        return redirect()->route('teknisi.store')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function export_excel()
    {
        $data_teknisis = User::get();

        return Excel::download(new DataTeknisiExport($data_teknisis), 'data_teknisis.xlsx');
    }
}
