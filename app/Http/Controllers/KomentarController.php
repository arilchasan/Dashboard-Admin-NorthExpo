<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Destinasi;
use Illuminate\Http\Request;
use App\Http\Resources\KomentarResource;

class KomentarController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required|string',
        ]);
        
        $user = $request->user();
        $destinasi = Destinasi::findOrFail($id);

        $komentar = new Komentar([
            'user_id' => $user->id,
            'destinasi_id' => $destinasi->id,
            'komentar' => $request->komentar,
        ]);

        $komentar->save();

        $destinasi->load('komentars');

        return response()->json([
            'message' => 'Komentar berhasil ditambahkan',
            'data' => new KomentarResource($komentar),
        ], 201);
    }
      
    public function destroy($id, Request $re)
    {
        $komentar = Komentar::findOrFail($id);
        $komentar->delete();
        if($re->wantsJson()){   
            return response()->json([
                'message' => 'Komentar berhasil dihapus',
                'data' => new KomentarResource($komentar),
            ], 200);
        } else {
            return redirect('/dashboard/destinasi/all')->with('success', 'Komentar berhasil dihapus');
        }

    }
    public function destroyWeb($id)
    {
        $komentar = Komentar::findOrFail($id);
        // if else 
        if ($komentar) {
            $komentar->delete();   
            return redirect('/dashboard/destinasi/all')->with('success', 'Komentar berhasil dihapus');
        } else {
            return redirect('/dashboard/destinasi/all')->with('error', 'Komentar gagal dihapus');
        }

    }
}
