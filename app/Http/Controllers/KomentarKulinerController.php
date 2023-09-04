<?php

namespace App\Http\Controllers;



use App\Models\Komentar_Kuliner;
use Illuminate\Routing\Controller;
use App\Http\Resources\Komentar_KulinerResource;
use App\Models\Kuliner;
use Illuminate\Http\Request;


class KomentarKulinerController extends Controller
{
    //
    public function store(Request $request, $id)
    {
        $request->validate([
            'komentar_kuliner' => 'required|string',
        ]);
        
        $user = $request->user();
        $kuliner = Kuliner::findOrFail($id);

        $komentar_kuliner = new Komentar_Kuliner([
            'user_id' => $user->id,
            'kuliner_id' => $kuliner->id,
            'komentar_kuliner' => $request->komentar_kuliner,
        ]);

        $komentar_kuliner->save();

        $kuliner->load('komentar_kuliners');

        return response()->json([
            'message' => 'Komentar berhasil ditambahkan',
            'data' => new Komentar_KulinerResource($komentar_kuliner),
        ], 201);
    }

    public function destroy($id, Request $re)
    {
        $komentar_kuliner = Komentar_Kuliner::findOrFail($id);
        $komentar_kuliner->delete();
        if($re->wantsJson()){   
            return response()->json([
                'message' => 'Komentar berhasil dihapus',
                'data' => new Komentar_KulinerResource($komentar_kuliner),
            ], 200);
        } else {
            return redirect('/dashboard/kuliner/all')->with('success', 'Komentar berhasil dihapus')->with('success', 'Komentar berhasil dihapus');
        }

    }

    public function destroyweb($id)
    {
        $komentar_kuliner = Komentar_Kuliner::findOrFail($id);
        // if else 
        if ($komentar_kuliner) {
            $komentar_kuliner->delete();   
            return redirect('/dashboard/kuliner/all')->with('success', 'Komentar berhasil dihapus');
        } else {
            return redirect('/dashboard/kuliner/all')->with('error', 'Komentar gagal dihapus');
        }

    }


}
