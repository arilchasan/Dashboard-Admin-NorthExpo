<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

class AuthController extends Controller
{
     public function register(Request $request){
       try{
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:20',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => Hash::make($request->password),
            'link' => Str::random(40),
        ]);
        
       
        Mail::to($user->email)->send(new VerificationEmail($user));
            
        
         return response()->json([
             'user' => $user,
             'message' => 'Berhasil Daftar!',
         ], 201);
       } catch (\Exception $e) {
           return response()->json([
               'message' => 'Gagal Daftar!',
               'error' => $e->getMessage()
           ], 409);
       }
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:20',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user){
            return response()->json([
                'message' => 'Email tidak terdaftar!'
            ], 401);
        }

        if ($user->status) {
            return response()->json([
                'message' => 'Pengguna diblokir!'
            ], 401);
        }

        if ($user->authenticated !== 'verified') {
            return response()->json([
                'message' => 'Anda belum melakukan verifikasi email!'
            ], 401);
        }

        if(!Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Password salah!'
            ], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        $response = [
            'message' => 'Berhasil Login!',
            'user' => $user,
            'token' => $token
        ];
        // return redirect()->to('/')->with('success', 'Berhasil Login!');
         return response()->json($response, 200);

        // return view('dashboard.wishlist.wishlist', [
        //     'wishlist' => Wishlist::all()]);
        
    }
    
    // public function loginWeb(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => 'required|email:dns',
    //         'password' => 'required'
    //      ]);
 
    //      if (Auth::attempt($credentials)) {
    //          $request->session()->regenerate();
    //          return redirect()->intended('/');
    //      }
 
    //      return back()->with('loginError', 'Login gagal');
    // }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Berhasil Logout !'
        ], 200);
    }

    public function emailVerifikasi() {
        
    }
}
