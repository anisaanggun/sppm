<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function dologin(Request $request) {
        // validasi
        $request->validate([
            'email'     => 'required|email',
            'password' => 'required'
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // dd($data);die;

        if(Auth::attempt($data)){
            return redirect()->intended('/admin')->with('success', 'yey');
        }else{
            return redirect()->route('login')->with('failed', 'Error!');
        }




        // if (auth()->attempt($credentials)) {

        //     // buat ulang session login
        //     $request->session()->regenerate();

        //     if (auth()->user()->role_id === 1) {
        //         // jika user admin
        //         return redirect()->intended('/admin');
        //     } else if (auth()->user()->role_id === 2){
        //         // jika user teknisi
        //         return redirect()->intended('/teknisi');
        //     } else {
        //         // jika user customer
        //         return redirect()->intended('/customer');
        //     }
        // }
    }


        public function daftar() {
            return view('auth.daftar');
        }

        public function daftar_proses(Request $request){
            //Validasi input
            $request->validate([
                'nama' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6', // Bisa menambahkan minimum karakter untuk password
                'no_hp' => 'required|numeric'
            ]);


            // Simpan data pengguna
            $data = [
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            ];

            User::create($data); // Simpan ke database

            $login = [
                'email' => $request->email,
                'password' => $request->password,
                ];


            //Redirect ke halaman login
            if(Auth::attempt($login)){
                return redirect()->intended('/login')->with('success', 'Registrasi berhasil! Silahkan login.');
            }else{
                return redirect()->route('daftar')->with('failed', 'Error!');
            }


        }

        

        public function logout(Request $request) {
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

