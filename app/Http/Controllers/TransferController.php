<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Payment;
use App\Models\Transfer;
use App\Models\Destinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    public function tfAdmin(Request $request, $id)
    {
        $selectedDate = $request->input('tanggal');
        $reqTanggal = $request->query('tanggal');
        $tanggal = date('m/d/Y', strtotime($reqTanggal));
        $order_id = 'TFA' . $tanggal;
        $destinasi = Destinasi::find($id);
        $total = Payment::where('status', 'success')
            ->where('destinasi_id', $id)
            ->whereDate('tanggal', $selectedDate)
            ->sum('qty')->get();
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order_id,
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'From' => 'Aril',
                'To' => 'Admin' . $destinasi->nama,
            ),

        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $responseData = [
            'token' => $snapToken,

            'destinasi' => $destinasi,
        ];

        return view('dashboard.detailpay', [
            'token' => $snapToken
        ]);
    }

    public function all()
    {
        $transfers = Transfer::all();
        $admin = Transfer::where('biaya_admin', '!=', '1')->with('destinasi')->get();
        return view('dashboard.transfer.datatransfer', (['transfer' => $transfers, 'admin' => $admin]));
    }

    public function scan()
    {
        return view('dashboard.scan.scan');
    }

    public function scanQR(Request $request)
    {
        try {
            $cekData = Payment::where([
                'order_id' => $request->order_id,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'qty' => $request->qty,
                'total' => $request->total,
                'status' => 'success',
                'tanggal' => $request->tanggal,
                'status_tiket' => 'belum terpakai'
            ])->first();

            if ($cekData) {
                $cekData->update([
                    'status_tiket' => 'sudah terpakai'
                ]);
                return redirect('/dashboard/scan')->with([
                    'success' => 'Berhasil Scan QR Code',
                    'cekData' => $cekData
                ]);
            } else {
                return redirect('/dashboard/scan')->with('error', 'QR Code Sudah Terpakai');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Scan QR Code');
        }
    }

    public function datatrs()
    {
        $adminNama = auth('role_admins')->user()->username;


        $adminDestinasiMapping = [
            'AdminGardu' => 1,
            'AdminTheHillsVaganza' => 2,
            'AdminKedungGender' => 3,
            'AdminWaterpark' => 6,
        ];
        
        $adminNamaMapping = [
            'AdminGardu' => 'Gardu Pandang',
            'AdminTheHillsVaganza' => 'The Hills Vaganza',
            'AdminKedungGender' => 'Air Terjun Kedung Gender',
            'AdminWaterpark' => 'Waterpark Mulia Wisata',
        ];

        if (isset($adminDestinasiMapping[$adminNama]) || isset($adminNamaMapping[$adminNama])) {
            $destinasiId = $adminDestinasiMapping[$adminNama];
            $destinasiNama = $adminNamaMapping[$adminNama];

            $transaksiData = DB::table('payments')
                ->where('destinasi_id', $destinasiId)
                ->get();

            $namaDestinasi = DB::table('destinasis')->where('nama', $destinasiNama)->first();
            $nama = $namaDestinasi->nama;
            return view('dashboard.payment.transaksidestinasi',['transaksiData' => $transaksiData , 'namaDestinasi' => $nama]);
        } else {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }
    }

    public function detail($id)
    {
        $transaksiData = DB::table('payments')
            ->where('order_id', $id)
            ->first();

        return view('dashboard.payment.detailtransaksi', ['transaksiData' => $transaksiData]);
    }
}
