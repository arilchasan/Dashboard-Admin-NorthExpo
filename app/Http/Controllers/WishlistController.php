<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;
use App\Models\Wishlist;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class WishlistController extends Controller
{
    public function all()
{
    // Check if the user is authenticated
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You need to be logged in to view the wishlist.');
    } else {
        $user = Auth::user();
        $userWishlist = $user->wishlist->pluck('destinasi_id')->toArray();

        $destinasi = Destinasi::with('kategori')->get()->map(function ($destinasi) use ($userWishlist) {
            $destinasi->isInWishlist = in_array($destinasi->id, $userWishlist);
            return $destinasi;
        });

        return view('dashboard.wishlist.wishlist', [
            'wishlist' => Wishlist::all() 
        ]);
    }

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
        $wishlist = new Wishlist([
            'user_id' => $user->id,
            'destinasi_id' => $destinasi_id,
        ]);
        $wishlist->save();
    
        return redirect()->back()->with('success', 'Destinasi added to wishlist.');
    }
        
    public function removeFromWishlist(Destinasi $destinasi){
        $user = Auth::user();
        // Dapatkan data wishlist pengguna berdasarkan produk yang ingin dihapus
        $wishlist = Wishlist::where('user_id', $user->id)
            ->where('destinasi_id', $destinasi->id)
            ->first();
    
        // Periksa apakah data wishlist ditemukan
        if ($wishlist) {
            $wishlist->delete();
            return redirect()->back()->with('success', 'Destinasi removed from wishlist.');
        }
    
        return redirect()->back()->with('error', 'Destinasi is not found in the wishlist.');
    }
    
}