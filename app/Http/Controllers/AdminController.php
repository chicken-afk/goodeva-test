<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function loginPage()
    {
        return view('main.login');
    }

    public function login(Request $request)
    {
        // dd($request);

        // Check if user aktif
        $user = DB::table('users')->where('email', $request->email)->first();
        if ($user) {
            if ($user->is_active == 0) {
                alert('Gagal', 'Email Tidak Ditemukan', 'error');
                return redirect()->back();
            }
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
        } else {
            alert('Gagal', 'Email Tidak Ditemukan', 'error');
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
