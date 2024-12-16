<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index(): View
    {
        return view('admin.user.profil');
    }

    public function create(): View
    {
        //
    }

    public function store(Request $request): RedirectResponse
    {
        //
    }

    public function edit(string $id): View
    {
        //
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password_baru' => 'required|min:6',
            'no_hp' => 'required|numeric|min:11',
            'alamat' => 'string',
        ], [
            'name.required' => 'Masukan nama anda.',
            'email.required' => 'Masukan email.',
            'password_baru.required' => 'Masukan password.',
            'no_hp.required' => 'Masukan no hp.',
        ]);

        $users = User::findOrFail($id);

        $users->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password_baru),
            'ulangi_password' => $request->password_baru,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->intended('/beranda')->with(['success', 'Data mesin berhasil diubah!']);
    }


    public function destroy($id): RedirectResponse
    {
        //
    }
}
