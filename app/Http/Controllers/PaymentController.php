<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Mail\Notifikasi;
use App\Models\Destinasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class PaymentController extends Controller
{
    public function index($id)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-KybnJbSUAgQioRzZC740lgND';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $destinasi = Destinasi::find($id);
        
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $destinasi->harga,
            ),
            'customer_details' => array(
                'first_name' => 'budi',
                'last_name' => 'pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
            'enable_payments' => array('gopay','bank_transfer','qris')
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('dashboard.payment.pay',['token' => $snapToken, 'destinasi' => $destinasi]);

    }

    public function checkout(Request $request , $id)
    {
    
      $destinasi = Destinasi::find($id);    
      $request->request->add(['total' => $request->qty * $destinasi->harga , 'status' => 'pending', ]);
      $order_id = rand();

      // Add the order_id to the request data
      $request->request->add(['order_id' => $order_id]);


      \Midtrans\Config::$serverKey = config('midtrans.server_key');
      \Midtrans\Config::$isProduction = false;
      \Midtrans\Config::$isSanitized = true;
      \Midtrans\Config::$is3ds = true;

      
      $payment = Payment::create($request->all());
      $params = array(
          'transaction_details' => array(
              'order_id' => $order_id,
              'gross_amount' => $payment->total,
          ),
          'customer_details' => array(
              'email' => $payment->email,
              'phone' => $payment->no_telp,
          ),
        //   'enable_payments' => array('gopay','bank_transfer','qris')
      );

      $snapToken = \Midtrans\Snap::getSnapToken($params);
          // Prepare the JSON response data
    $responseData = [
        'token' => $snapToken,
        'destinasi' => $destinasi,
        'payment' => $payment,
    ];

        // Return the JSON response
        if ($request->wantsJson()) {
            return response()->json($responseData);      
        } else {
            return view('dashboard.payment.checkout',['token' => $snapToken, 'destinasi' => $destinasi , 'payment' => $payment]);
        }

    }   

    public function callback(Request $request) 
    {
        $serverKey = config('midtrans.server_key');
        $hasehd = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hasehd !== $request->signature_key) {
            return response(['message' => 'Invalid signature'], 403);
        }
        $payment = Payment::where('order_id', $request->order_id)->first(); 
        if (!$payment) {
            return response(['message' => 'Payment not found'], 404);
        }
        $payment->update([
            'status' => 'success',
        ]);
        return response(['message' => 'Callback success']);
       
    }
    

    public function pay()
    {
        return view('dashboard.payment.pay');
    }

    public function list(){
        $payment = Payment::all();
        return view('dashboard.payment.list',['payment' => $payment]);
    }

    public function all(){
        $payment = Payment::all();
        return view('dashboard.payment.index',['payment' => $payment , 'destinasi' => Destinasi::all()]);
    }

    public function notifikasi($id) 
    {
            // Ambil data Payment berdasarkan ID atau kondisi tertentu sesuai kebutuhan Anda
            $payment = Payment::find($id); // Ganti $id dengan ID yang sesuai untuk notifikasi tertentu

            if (!$payment) {
                return redirect()->back()->with('error', 'Payment not found');
            }
                    // Convert the Payment data to a JSON string
                    $qrCode = "Email: " . $payment->email . "\n"
                    . "No Telepon: " . $payment->no_telp . "\n"
                    . "Jumlah Orang: " . $payment->qty . "\n"
                    . "Total Harga: Rp." . $payment->total . "\n"
                    . "Status: " . $payment->status . "\n";

            Mail::to('northexpo.develop@gmail.com')->send(new Notifikasi($payment , $qrCode));
            
            return redirect()->back()->with('success', 'Notifikasi Email berhasil dikirim');
        }
}
