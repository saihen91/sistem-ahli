<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            audit_log('LOGIN', 'Auth', 'User login');
            return redirect()->route('dashboard')->with('success', 'Login berjaya');
        }

        return back()->with('error', 'Login gagal. Sila semak email dan password.');
    }

    public function logout(Request $request)
    {
        audit_log('LOGOUT', 'Auth', 'User logout');

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
