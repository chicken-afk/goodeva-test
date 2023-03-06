<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function view()
    {
        // dd('asdfs');
        return view('users.dashboard');
    }
}
