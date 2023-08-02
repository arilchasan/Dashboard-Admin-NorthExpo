<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;
use App\Models\Wishlist;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class WishlistController extends Controller
{

    public function all(){
        $user = Auth::user();
        $wishlist = Wishlist::with('destinasi')
        ->where('user_id', $user->id)
        ->get();

        $dataMapped = $wishlist->map(function($item, $key){
            return $item->destinasi;
        });
        // $data = User::with('wishlistDestinasi')->get();
        // dd($dataMapped);
        return view('dashboard.wishlist.wishlist', compact('dataMapped'));
        // return response()->json([
        //     'message' => 'Berhasil menampilkan data wishlist',
        //     'data' => $dataMapped,
        // ], 200);
    }

    public function addToWishlist($destinasi_id){
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You need to be logged in to add destinations to the wishlist.');
        }
        $destinasi = Destinasi::find($destinasi_id);
        if (!$destinasi) {
            return redirect()->back()->with('error', 'Destinasi not found.');
        }
        $user = User::where('id', Auth::id())->first();
        // Check if the destination already exists in the user's wishlist
        if ($user->wishlist()->where('destinasi_id', $destinasi_id)->exists()) {
            return redirect()->back()->with('error', 'Destinasi is already in the wishlist.');
        }
        // Add the destination to the user's wishlist
        // $wishlist = new Wishlist([
        //     'user_id' => $user->id,
        //     'destinasi_id' => $destinasi_id,
        // ]);
        // $wishlist->save();
        try {
            $wishlist = Wishlist::create([
                'user_id' => $user->id,
                'destinasi_id' => $destinasi_id,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add destination to wishlist.');
        }    
        return redirect()->back()->with('success', 'Destinasi added to wishlist.');
    }   

    public function removeFromWishlist($destinasi_id){
        $user = Auth::user();
        // Dapatkan data wishlist pengguna berdasarkan produk yang ingin dihapus
        $wishlist = Wishlist::where([
            'user_id' => $user->id,
            'destinasi_id' => $destinasi_id,
        ]);
        // Periksa apakah data wishlist ditemukan
        if ($wishlist) {
            $wishlist->delete();
            return redirect()->back()->with('success', 'Destinasi removed from wishlist.');
        }
        return redirect()->back()->with('error', 'Destinasi is not found in the wishlist.');
    }

}
    

      


        
    
    
    
    

