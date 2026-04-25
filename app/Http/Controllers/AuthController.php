<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login'); // bikin view login.blade.php
    }

    public function login(Request $request)
{
    $credentials = $request->only('email','password');

    if (Auth::attempt($credentials)) {

        $user = Auth::user();

        // 🔥 CEK ROLE
        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        return redirect('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah'
    ]);
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
