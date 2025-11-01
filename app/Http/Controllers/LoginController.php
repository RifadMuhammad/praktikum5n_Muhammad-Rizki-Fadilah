<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Jika login berhasil, cek role user
            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect('/admin');
            }

            return redirect('/kasir');
        }

        // Jika login gagal, kembalikan ke halaman login
        return redirect('/')->with('error', 'Username atau password salah');
    }
}