<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Destinasi;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /** index page dashboard */
    public function index()
    {
        return view('dashboard.dashboard');
    }
    public function data () {
        return view('dashboard.data',['destinasi' => Destinasi::all()]);
    }

    /** index page register */
    public function register()
    {
        return view('user.register',['user' => User::all()]);
    }

    /** index page login */
    public function login()
    {
        return view('user.login',['admin' => Admin::all()]);
    }

    /** index page verify */
    public function verifyview()
    {
        return view('auth.verify',['data_user' => User::all()]);
    }
}
