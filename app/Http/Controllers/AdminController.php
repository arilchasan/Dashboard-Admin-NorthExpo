<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginAdmin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('role_admins')->attempt($credentials)) {
            return redirect()->intended('/'); // Ganti route dengan route dashboard admin
        } else {
            return back()->withErrors(['message' => 'Invalid credentials']);
        }
    }

    public function logoutAdmin()
    {
        Auth::guard('role_admins')->logout();
        return redirect()->route('login'); // Ganti route dengan route login admin
    }
}
