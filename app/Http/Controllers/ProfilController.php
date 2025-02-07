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
            'name.required' => 'Silahkan masukkan nama anda.',
            'email.required' => 'Silahkan masukkan alamat email anda.',
            'password_baru.required' => 'Silahkan masukkan password.',
            'no_hp.required' => 'Silahkan masukkan no hp anda.',
        ]);

        $users = User::findOrFail($id);

        $users->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password_baru),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->intended('/beranda')->with(['success', 'Data mesin berhasil diubah!']);
    }


    public function destroy($id): RedirectResponse
    {
        $users = User::find($id);
    	$users->delete();
 
    	return redirect('/users');
    }
}
