<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Transfer;

class TransferController extends Controller
{
    public function tfAdmin(Request $request,$id) 
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

        return view('dashboard.detailpay',[
            'token' => $snapToken
        ]);
    }

    public function all(){

       


        $transfers = Transfer::all();
        $admin = Transfer::where('biaya_admin', '1500')->with('destinasi')->get();
        return view('dashboard.transfer.datatransfer', (['transfer' => $transfers, 'admin' => $admin]));
    }


}
