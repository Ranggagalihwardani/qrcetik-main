<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/admin');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            // cek role admin
            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return back()->with('error', 'Akses hanya untuk admin!');
            }

            return redirect('/admin');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}