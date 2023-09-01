<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function sendVerificationEmail(Request $request)
     {

        $request->user()->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Email verifikasi telah dikirim!'
        ]);
    }

    public function verify( Request $request , $link ){
        // $user = User::find($id);
        $user = User::where('link',$link)->first();
        if ($user) {
            $user->markEmailAsVerified();
            $user->update([
                'authenticated' => 'verified'
            ]);
            
            return view('dashboard.mail.successverif')->with('success', 'Email sudah diverifikasi!');
            
        } 

        return response()->json([
            'message' => 'User tidak ditemukan!'
        ], 404);
    }

    public function a ($id , Request $request) {
        $user = User::find($id);
        return view('dashboard.mail.verification',[
            'user' => $user
        ]);
    }

    public function emailSuccess () {
        return view('dashboard.mail.successverif');
    }
}
