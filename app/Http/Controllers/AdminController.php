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
            if (Auth::user()->role_id == 1) {
                return redirect()->route('dashboard');
            } elseif (Auth::user()->role_id == 2) {
                return redirect()->route('getOrders');
            } elseif (Auth::user()->role_id == 3) {
                return redirect()->route('liveOrder');
            }
        } else {
            alert('Gagal', 'Kombinasi Email Dan Password Salah', 'error');
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('loginPageAdmin');
    }
}
