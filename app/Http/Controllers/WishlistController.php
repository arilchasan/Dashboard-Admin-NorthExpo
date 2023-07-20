<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;
use App\Models\Wishlist;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class WishlistController extends Controller
{
    //
    public function all(){
        return view('/dashboard/wishlist/wishlist', ['wishlist' => Wishlist::all()]);
    }
    


public function addToWishlist(Destinasi $destinasi)
{
    $user = User::where('id', Auth::id())->with(["wishlist"])->first();
    // Cek apakah produk sudah ada di wishlist pengguna
    if ($user->where('destinasi_id', $destinasi->nama)->exists()) {
        return redirect()->back()->with('error', 'Destinasi is already in the wishlist.');
    }
    // Tambahkan produk ke wishlist pengguna
    $wishlist = new Wishlist([
        'user_id' => $user->id,
        'destinasi_id' => $destinasi->id,
    ]);
    $wishlist->save();
    return redirect()->back()->with('success', 'Destinasi added to wishlist.');
}
public function removeFromWishlist(Destinasi $destinasi)
{
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