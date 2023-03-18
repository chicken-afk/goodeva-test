<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginPage()
    {
        return view('main.login');
    }

    public function login(Request $request)
    {
        // dd($request);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            alert('Gagal', 'Kombinasi Email Dan Password Salah', 'error');
            return redirect()->back();
        }
    }
}
