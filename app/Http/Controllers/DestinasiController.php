<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Wilayah;
use App\Models\Kategori;
use App\Models\Komentar;
use App\Models\Destinasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\KomentarResource;
use App\Http\Resources\DestinasiResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\DestinasiStoreRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;


class DestinasiController extends Controller
{
    //
    public function index()
    {

        $destinasi = Destinasi::with(['kategori', 'wilayah','komentars.user'])->get();
        if ($destinasi->count() > 0) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil menampilkan data',
                'data' => DestinasiResource::collection($destinasi)
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak ada',
                'data' => $destinasi
            ], 404);
        }
    }
    public function all()
    {
        return view('/dashboard/destinasi/destinasi', ['destinasi' => Destinasi::all() ]);
    }
    public function create()
    {
        return view('/dashboard/destinasi/create', ['kategori' => Kategori::all(), 'wilayah' => Wilayah::all()]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'foto2' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'foto3' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'foto4' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'maps' => 'required',
            'operasional' => 'required',
            'status' => 'required',
            'wilayah_id' => 'required',
            'pelayanan' => 'required',
            'harga' => 'required',
            'kuota' => 'required'
            

        ]);
        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Terjadi kesalahan',
                    'data' => $validator->errors()
                ], 400);
            } else {
                return redirect('/dashboard/destinasi/create')->with('error', 'Terjadi kesalahan');
            }
        } else {
            $image = $request->file('foto');
            $image_name = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/foto'), $image_name);
            // Storage::putFileAs('/public/foto', $image, $image_name);

            $image2 = $request->file('foto2');
            $image_name2 = Str::random(10) . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('/foto'), $image_name2);

            $image3 = $request->file('foto3');
            $image_name3 = Str::random(10) . '.' . $image3->getClientOriginalExtension();
            $image3->move(public_path('/foto'), $image_name3);

            $image4 = $request->file('foto4');
            $image_name4 = Str::random(10) . '.' . $image4->getClientOriginalExtension();
            $image4->move(public_path('/foto'), $image_name4);

            $destinasi = Destinasi::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'foto' => $image_name,
                'foto2' => $image_name2,
                'foto3' => $image_name3,
                'foto4' => $image_name4,
                'deskripsi' => $request->deskripsi,
                'kategori_id' => $request->kategori_id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'maps' => $request->maps,
                'operasional' => $request->operasional,
                'status' => $request->status,
                'wilayah_id' => $request->wilayah_id,
                'pelayanan' => $request->pelayanan,
                'harga' => $request->harga,
                'kuota' => $request->kuota,
                

            ]);
            if ($destinasi) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 200,
                        'message' => 'Berhasil menambahkan data',
                        'data' => $destinasi
                    ], 200);
                } else {
                    return redirect('/dashboard/destinasi/all')->with('success', 'Berhasil menambahkan data');
                }
            } else {
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Gagal menambahkan data',
                        'data' => $destinasi
                    ], 400);
                } else {
                    return redirect('/dashboard/destinasi/all')->with('error', 'Gagal menambahkan data');
                }
            }
        }
        Destinasi::create($validator);
    }

    public function show($id)
    {
        $destinasi = Destinasi::with(['kategori','komentars.user'])->find($id);
        // $destinasi->load('komentars.user');
        if ($destinasi) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil menampilkan data',
                'data' => new DestinasiResource($destinasi)
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak ditemukan',
                'data' => $destinasi
            ], 404);
        }
    }

    public function detail($id)
    {
        return view('dashboard.destinasi.detail', ['destinasi' => Destinasi::find($id),'kategori' => Kategori::all() ]);
    }

    public function edit($id)
    {
        return view('dashboard.destinasi.edit', ['destinasi' => Destinasi::find($id)], ['kategori' => Kategori::all(), 'wilayah' => Wilayah::all()]);
    }

    public function update(int $id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'foto2' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'foto3' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'foto4' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'maps' => 'required',
            'operasional' => 'required',
            'status' => 'required',
            'wilayah_id' => 'required',
            'pelayanan' => 'required',
            'harga' => 'required',
            'kuota' => 'required',
            

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Terjadi kesalahan',
                'data' => $validator->errors()
            ], 400);
        } else {
            $destinasi = Destinasi::find($id);

            if (!$destinasi) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data tidak ditemukan',
                ], 404);
            }

            // hapus foto lama
            File::delete(public_path('foto/' . $destinasi->foto));
            File::delete(public_path('foto/' . $destinasi->foto2));
            File::delete(public_path('foto/' . $destinasi->foto3));
            File::delete(public_path('foto/' . $destinasi->foto4));

            // upload foto baru jika ada
            $image_name = $destinasi->foto;
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $image_name = Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/foto'), $image_name);
            }

            $image_name2 = $destinasi->foto2;
            if ($request->hasFile('foto2')) {
                $image2 = $request->file('foto2');
                $image_name2 = Str::random(10) . '.' . $image2->getClientOriginalExtension();
                $image2->move(public_path('/foto'), $image_name2);
            }

            $image_name3 = $destinasi->foto3;
            if ($request->hasFile('foto3')) {
                $image3 = $request->file('foto3');
                $image_name3 = Str::random(10) . '.' . $image3->getClientOriginalExtension();
                $image3->move(public_path('/foto'), $image_name3);
            }

            $image_name4 = $destinasi->foto4;
            if ($request->hasFile('foto4')) {
                $image4 = $request->file('foto4');
                $image_name4 = Str::random(10) . '.' . $image4->getClientOriginalExtension();
                $image4->move(public_path('/foto'), $image_name4);
            }

            $destinasi->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'foto' => $image_name,
                'foto2' => $image_name2,
                'foto3' => $image_name3,
                'foto4' => $image_name4,
                'deskripsi' => $request->deskripsi,
                'kategori_id' => $request->kategori_id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'maps' => $request->maps,
                'operasional' => $request->operasional,
                'status' => $request->status,
                'wilayah_id' => $request->wilayah_id,
                'pelayanan' => $request->pelayanan,
                'harga' => $request->harga,
                'kuota' => $request->kuota,
                
            ]);

            if ($destinasi) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 200,
                        'message' => 'Berhasil mengupdate data',
                        'data' => $destinasi
                    ], 200);
                } else {
                    return redirect('/dashboard/destinasi/all')->with('success', 'Berhasil mengupdate data');
                }
            } else {
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Gagal mengupdate data',
                        'data' => $destinasi
                    ], 400);
                } else {
                    return redirect('/dashboard/destinasi/all')->with('error', 'Gagal mengupdate data');
                }
            }
        }
    }


    public function destroy($id, Request $request)
    {
        $destinasi = Destinasi::find($id);
        if (!$destinasi) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data tidak ditemukan',
                ], 404);
            } else {
                return redirect('/dashboard/destinasi/all')->with('error', 'Data tidak ditemukan');
            }
        } else {
            File::delete(public_path('foto/' . $destinasi->foto));
            File::delete(public_path('foto/' . $destinasi->foto2));
            File::delete(public_path('foto/' . $destinasi->foto3));
            File::delete(public_path('foto/' . $destinasi->foto4));
            $destinasi->delete();
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil menghapus data',
                    'data' => $destinasi
                ], 200);
            } else {
                return redirect('/dashboard/destinasi/all')->with('success', 'Berhasil menghapus data');
            }
        }
    }

    //function search 
    public function search(Request $request)
    {
        // Menerima parameter pencarian dan penyaringan dari permintaan
        $searchTerm = $request->input('search');
        $kategori = $request->input('kategori');
        $wilayah = $request->input('wilayah');

        // Query database dengan menggunakan parameter pencarian dan penyaringan
        $query = Destinasi::query()->with('kategori')->with('wilayah');

        if ($searchTerm) {
            $query->where('nama', 'LIKE', "%$searchTerm%");
        }

        if ($kategori) {
            $query->whereHas('kategori', function ($query) use ($kategori) {
                $query->where('nama', $kategori);
            });
        }

        if ($wilayah) {
            $query->whereHas('wilayah', function ($query) use ($wilayah) {
                $query->where('nama', $wilayah);
            });
        }

        $results = $query->get();

        if ($results) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil menampilkan data',
                'data' => $results
            ], 200);
        }
    }

    public function komentar($id, Request $request)
    {
        if($request->wantsJson()){   
        $destinasi = Destinasi::findOrFail($id);

        $komentars = Komentar::with('user', 'destinasi')->where('destinasi_id',$id)->get();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menampilkan Komentar',
            'data' => KomentarResource::collection($komentars),
        ]);
        } else {
            $komentars = Komentar::with('user', 'destinasi')->where('destinasi_id',$id)->get();
            
            return view('dashboard.destinasi.komentar', ['komentar' => $komentars = KomentarResource::collection($komentars)->sortByDesc('created_at')]);
        }
    }
    //show all comments in destinasi
    public function showComment($id)
    {
        $destinasi = Destinasi::findOrFail($id);

        $komentars = Komentar::with('user', 'destinasi')->get();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menampilkan Komentar',
            'data' => KomentarResource::collection($komentars),
        ]);
    }

    
    public function sisaKuota( $id, $tanggal)
    {
        try {
            $destinasi = Destinasi::findOrFail($id);
            $selectedDate = Carbon::parse($tanggal)->format('Y-m-d');
    
            // Menghitung jumlah total tiket terjual pada tanggal yang dipilih
            $totalTerjualPadaTanggal = $destinasi->payments()
                ->where('status', 'success')
                ->whereDate('tanggal', $selectedDate)
                ->sum('qty');
    
            // Menghitung sisa kuota untuk tanggal yang dipilih
            $sisaKuota = $destinasi->kuota - ($totalTerjualPadaTanggal);
    
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil mendapatkan sisa kuota per hari',
                'data' => [
                    'sisa_kuota' => $sisaKuota,
                    'tanggal' => $selectedDate,
                ],
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Destinasi tidak ditemukan',
            ], 404);
        }
    }
    


    // public function sisakuota($id)
    // {
    // try {
    //     $destinasi = Destinasi::findOrFail($id);
    //     // Menghitung jumlah total tiket yang sudah terjual
    //     $totalTerjual = $destinasi->payments()->where('status', 'success')->sum('qty');
    //     // Menghitung sisa kuota
    //     $sisaKuota = $destinasi->sisa_kuota;

    //     return response()->json([
    //         'status' => 200,
    //         'message' => 'Berhasil mendapatkan sisa kuota',
    //         'data' => [
    //             'sisa_kuota' => $sisaKuota,
    //             'jumlah_kuota' => $destinasi->kuota,
    //         ],
    //     ]);
    // } catch (ModelNotFoundException $e) {
    //     return response()->json([
    //         'status' => 404,
    //         'message' => 'Destinasi tidak ditemukan',
    //     ], 404);
    // }

    // }


//     public function sisakuota(Request $request, $id, $tanggal)
// {
//     try {
//         $destinasi = Destinasi::findOrFail($id);
//         $selectedDate = Carbon::parse($tanggal)->format('Y-m-d');

//         // Menghitung jumlah total tiket terjual pada tanggal yang dipilih
//         $totalTerjual = $destinasi->payments()
//             ->where('status', 'success')
//             ->whereDate('created_at', $selectedDate)
//             ->sum('qty');

//         // Menghitung sisa kuota untuk tanggal yang dipilih
//         $sisaKuota = $destinasi->kuota - $totalTerjual;

//         return response()->json([
//             'status' => 200,
//             'message' => 'Berhasil mendapatkan sisa kuota per hari',
//             'data' => [
//                 'sisa_kuota' => $sisaKuota,
//                 'tanggal' => $selectedDate,
//             ],
//         ]);
//     } catch (ModelNotFoundException $e) {
//         return response()->json([
//             'status' => 404,
//             'message' => 'Destinasi tidak ditemukan',
//         ], 404);
//     }
}


