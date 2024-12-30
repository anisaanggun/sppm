<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function dologin(Request $request)
    {
        // validasi
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // dd($data);die;

        if (Auth::attempt($data)) {
            return redirect()->intended('/beranda')->with('success', 'Selamat Datang ');
        } else {
            return redirect()->route('login')->with('failed', 'Error!');
        }
    }

    public function daftar()
    {
        return view('auth.daftar');
    }

    public function daftar_proses(Request $request)
    {
        //Validasi input
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6', // Bisa menambahkan minimum karakter untuk password
            'no_hp' => 'required|numeric',
        ]);

        // Simpan data pengguna
        $data = [
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ulangi_password' => $request->password,
            'no_hp' => $request->no_hp,
        ];

        User::create($data); // Simpan ke database

        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        //Redirect ke halaman login
        // if (Auth::attempt($login)) {
        //     return redirect()->intended('/login')->with('success', 'Registrasi berhasil! Silahkan login.');
        // } else {
        //     return redirect()->route('daftar')->with('failed', 'Error!');
        // }

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silahkan login.');
    }

    public function logout(Request $request)
    {
        // Logout pengguna
        auth()->logout();

        // Hapus session
        $request->session()->invalidate();

        // Regenerasi token CSRF
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }

}
