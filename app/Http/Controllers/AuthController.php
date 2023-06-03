<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;

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
            'password' => Hash::make($request->password)
        ]);
        
        $user->sendEmailVerificationNotification();
            
        // return redirect()->to('/verify-view')->with('success', 'Email verifikasi telah dikirim!');
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
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Berhasil Logout !'
        ], 200);
    }
   
}
