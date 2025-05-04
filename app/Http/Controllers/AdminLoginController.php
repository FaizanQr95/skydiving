<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminLoginController extends Controller
{
//    public function showLoginForm()
//    {
//        return view('admin.login');
//    }

//    public function login(Request $request)
//    {
//        $request->validate([
//            'email' => 'required|email',
//            'password' => 'required',
//        ]);
//
//        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
//            $request->session()->regenerate();
//            return redirect()->intended('/admin/dashboard');
//        }
//
//        return back()->withErrors([
//            'email' => 'Invalid credentials.',
//        ]);
//    }

//    public function logout(Request $request)
//    {
//        Auth::logout();
//        $request->session()->invalidate();
//        $request->session()->regenerateToken();
//        return redirect('/admin/login');
//    }
}
