<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    // login 
    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginAdmin()
    {
        $credentials =  request()->only('email', 'password');
        $remember_me = false;
        if (request('remember_me')) {
            $remember_me = true;
        }
        if (Auth::attempt($credentials, $remember_me)) {

            return redirect('/admin');
        } else {
            return redirect('/admin/login')->with('error', 'wrong email or password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
