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
            $role = auth('role_admins')->user()->role;
            if ($role == 'penjaga') {
                return redirect('/dashboard/scan');
            } elseif ($role == 'superadmin') {
                return redirect('/');
            }
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
