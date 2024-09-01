<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutentikasiController extends Controller
{
    public function index()
    {
        return view('autentikasi.login');
    }

    public function login(Request $request)
    {
        // validasi
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        // cek apakah user ada
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $role = auth()->user()->role;

            if ($role == '2') {
                // pindahkan ke halaman home
                return redirect()->intended('/home');
            } else if ($role == '1') {
                // pindahkan ke halaman dashboard
                return redirect()->intended('/dashboard');
            }
        }
        // jika user tidak ada didalam database
        return back()->with('Error', 'Login Gagal!');
    }

    public function logout (Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
