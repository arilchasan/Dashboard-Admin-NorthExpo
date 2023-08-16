<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;
use App\Models\Wishlist;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


use function PHPSTORM_META\map;

class WishlistController extends Controller
{
    
    public function create(Request $request, $id)
    {
        $user = Auth::user();
        $request->validate([
            'destinasi_id' => 'required',
        ]);

        $user = $request->user();
        $destinasi = Destinasi::findOrFail($id);

        $wishlist = new Wishlist([
            'user_id' => $user->id,
            'destinasi_id' => $destinasi->id,
        ]);

        $wishlist->save();

        $destinasi->load('wishlists');

        return response()->json([
            'message' => 'Wishlist berhasil ditambahkan',
            'data' => $wishlist,
        ], 201);
    }



    // public function store(Request $request){
    //     $user = Auth::user();
    //     $validator = Validator::make($request->all(), [// 'user_id' => 'required|exists:users,id
             
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'message' => 'Validation error',
    //             'errors' => $validator->errors(),
    //         ], 400);
    //     } else {
    //         $wishlist = Wishlist::create([
    //             'user_id' => $user->id,
    //             'destinasi_id' => $request->destinasi_id,
    //         ]);
    //         if ($wishlist) {
    //             return response()->json([
    //                 'message' => 'Wishlist created successfully',
    //                 'data' => $wishlist,
    //             ], 201);
    //         }
    //         return response()->json([
    //             'message' => 'Failed to create wishlist',
    //         ], 500);
    //     }
    // }
    public function destroy($id, Request $re){
        $user = Auth::user();
        $wishlist = Wishlist::where([
            'user_id' => $user->id,
            'destinasi_id' => $id,
        ]);
        if ($re->wantsJson()) {
            $wishlist->delete();
            return response()->json([
                'message' => 'Wishlist deleted successfully',
            ], 200);
        }
        return response()->json([
            'message' => 'Wishlist not found',
        ], 404);
    }
}
    

      


        
    
    
    
    

