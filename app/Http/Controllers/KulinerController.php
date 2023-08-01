<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Kuliner;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class KulinerController extends Controller

{
    public function all()
    {
        return view('/dashboard/kuliner/kuliner', ["kuliner" => Kuliner::all()]);
    }
    public function detail($id)
    {
        return view('/dashboard/kuliner/detail', ["kuliner" => Kuliner::findOrFail($id)]);
    }
    public function create()
    {
        return view('/dashboard/kuliner/create');
    }
    public function edit($id)
    {
        return view('dashboard.kuliner.edit', ['kuliner' => Kuliner::find($id)], ['kuliners' => Kuliner::all()]);
    }
    //
    public function index()
    {
        $kuliners = Kuliner::all();
        if ($kuliners) {
            return response()->json([
                'success' => 200,
                'message' => 'Data Kuliners',
                'data' => $kuliners
            ], 200);
        } else {
            return response()->json([
                'success' => 404,
                'message' => 'Data Kuliners Tidak Ditemukan',
                'data' => ''
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_warung' => 'required',
            'alamat' => 'required',
            'operasional' => 'required',
            'nama_kuliner' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'foto2' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'foto3' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'customer_service'=> 'required',
        ]);
        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Data Kuliner Gagal Ditambahkan!',
                    'data' => $validator->errors()
                ], 400);
            } else {
                return redirect('/dashboard/kuliner/all')->with('error', 'Data Kuliner Gagal Ditambahkan!');
            }

        } else {
            $image = $request->file('foto');
            $image_name = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/kuliner'), $image_name);

            $image2 = $request->file('foto2');
            $image_name2 = Str::random(20) . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('/kuliner'), $image_name2);

            $image3 = $request->file('foto3');
            $image_name3 = Str::random(20) . '.' . $image3->getClientOriginalExtension();
            $image3->move(public_path('/kuliner'), $image_name3);

            $kuliner = Kuliner::create([
                'nama_warung' => $request->nama_warung,
                'nama_kuliner' => $request->nama_kuliner,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'foto' => $image_name,
                'foto2' => $image_name2,
                'foto3' => $image_name3,
                'customer_service' => $request->customer_service,
            ]);
            if ($kuliner) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'success' => 201,
                        'message' => 'Data Kuliner Berhasil Ditambahkan!',
                        'data' => $kuliner
                    ], 201);
                } else {
                    return redirect('/dashboard/kuliner/all')->with('status', 'Data Kuliner Berhasil Ditambahkan!');
                }
            } else {
                if ($request->wantsJson()) {
                    return response()->json([
                        'success' => 400,
                        'message' => 'Data Kuliner Gagal Ditambahkan!',
                        'data' => ''
                    ], 400);
                } else {
                    return redirect('/dashboard/kuliner/all')->with('status', 'Data Kuliner Gagal Ditambahkan!');
                }
            }
        }
        Kuliner::create($validator);
    }

    public function show($id)
    {
        $kuliner = Kuliner::whereId($id)->first();
        if ($kuliner) {
            return response()->json([
                'status' => 200,
                'message' => 'Detail Data Kuliner',
                'data' => $kuliner
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Kuliner Tidak Ditemukan!',
                'data' => ''
            ], 404);
        }
    }

    public function update(int $id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_warung' => 'required',
            'nama_kuliner' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'foto2' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'foto3' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'customer_service'=> 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => 400,
                'message' => 'Data Kuliner Gagal Diupdate!',
                'data' => $validator->errors()
            ], 400);
        } else {
            $kuliner = Kuliner::find($id);

            if (!$kuliner) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data Kuliner Tidak Ditemukan!',
                    'data' => ''
                ], 404);
            }
            //hapus foto yg lama
            File::delete(public_path('kuliner/' . $kuliner->foto));
            File::delete(public_path('kuliner/' . $kuliner->foto2));
            File::delete(public_path('kuliner/' . $kuliner->foto3));

            //upload yg baru
            $image_name = $kuliner->foto;
            if ($request->file('foto')) {
                $image = $request->file('foto');
                $image_name = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/kuliner'), $image_name);
            }

            $image_name2 = $kuliner->foto2;
            if ($request->file('foto2')) {
                $image2 = $request->file('foto2');
                $image_name2 = Str::random(20) . '.' . $image2->getClientOriginalExtension();
                $image2->move(public_path('/kuliner'), $image_name2);
            }

            $image_name3 = $kuliner->foto3;
            if ($request->file('foto3')) {
                $image3 = $request->file('foto3');
                $image_name3 = Str::random(20) . '.' . $image3->getClientOriginalExtension();
                $image3->move(public_path('/kuliner'), $image_name3);
            }
            $kuliner->update([
                'nama_warung' => $request->nama_warung,
                'nama_kuliner' => $request->nama_kuliner,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'foto' => $image_name,
                'foto2' => $image_name2,
                'foto3' => $image_name3,
                'customer_service' => $request->customer_service,
            ]);

            if ($kuliner) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'success' => 201,
                        'message' => 'Data Kuliner Berhasil Diupdate!',
                        'data' => $kuliner
                    ], 201);
                } else {
                    return redirect('/dashboard/kuliner/all')->with('status', 'Data Kuliner Berhasil Diupdate!');
                }
            } else {
                if ($request->wantsJson()) {
                    return response()->json([
                        'success' => 400,
                        'message' => 'Data Kuliner Gagal Diupdate!',
                        'data' => ''
                    ], 400);
                } else {
                    return redirect('/dashboard/kuliner/all')->with('status', 'Data Kuliner Gagal Diupdate!');
                }
            }
        }
    }


    public function destroy($id, Request $request)
    {
        $kuliner = Kuliner::find($id);
        if (!$kuliner) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data Kuliner Tidak Ditemukan!',
                    'data' => ''
                ], 404);
            } else {
                return redirect('/dashboard/kuliner/all')->with('status', 'Data Kuliner Tidak Ditemukan!');
            }

        }
        File::delete(public_path('kuliner/' . $kuliner->foto));
        File::delete(public_path('kuliner/' . $kuliner->foto2));
        File::delete(public_path('kuliner/' . $kuliner->foto3));
        $kuliner->delete();
        if ($kuliner) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Data Kuliner Berhasil Dihapus!',
                    'data' => $kuliner
                ], 200);
            } else {
                return redirect('/dashboard/kuliner/all')->with('status', 'Data Kuliner Berhasil Dihapus!');
            }
        } else {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Data Kuliner Gagal Dihapus!',
                    'data' => ''
                ], 400);
            } else {
                return redirect('/dashboard/kuliner/all')->with('status', 'Data Kuliner Gagal Dihapus!');
            }
        }
    }
}
