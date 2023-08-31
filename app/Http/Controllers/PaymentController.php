<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Mail\Notifikasi;
use App\Models\Destinasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\PaymentSuccessEvent;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SebastianBergmann\ResourceOperations\generate;
use Illuminate\Database\Eloquent\ModelNotFoundException;



class PaymentController extends Controller
{
    public function index($id)
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-KybnJbSUAgQioRzZC740lgND';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
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
            'enable_payments' => array('gopay', 'bank_transfer', 'qris')
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('dashboard.payment.pay', ['token' => $snapToken, 'destinasi' => $destinasi]);
    }
    public function getDataOrder(Request $request, $id)
    {
        $user = $request->user();
        $payment = Payment::where('id', $id)->first();

        if (!$payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        $destinasi = Destinasi::findOrFail($payment->destinasi_id);

        $responseData = [
            'payment' => $payment,
            'destinasi' => $destinasi,
            'user' => $user,
        ];

        return response()->json($responseData);
    }

    public function checkout(Request $request, $id)
    {
        $user = $request->user();
        $destinasi = Destinasi::findOrFail($id);
        $request->request->add([
            'email' => $user->email,
            'status' => 'pending',
            'destinasi_id' => $destinasi->id,
            'user_id' => $user->id,
            'total' => $request->qty * $destinasi->harga,
        ]);

        $order_id = 'NE' . Carbon::now()->timezone('Asia/Jakarta')->format('YmdHi');


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
                'email' => $user->email,
                'phone' => $payment->no_telp,
            ),

        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        
        $responseData = [
            'token' => $snapToken,
            'payment' => $payment,
            'destinasi' => $destinasi,
            'user' => $user,

        ];

        // Return the JSON response
        if ($request->wantsJson()) {
            return response()->json($responseData);
        } else {
            return view('dashboard.payment.checkout', ['token' => $snapToken, 'destinasi' => $destinasi, 'payment' => $payment]);
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

        if ($payment->status !== 'success') {
            $payment->update([
                'status' => 'success',
            ]);

            $this->notifikasi($payment->id);
        } 


        return response(['message' => 'Callback success']);
    }

    public function notifikasi($id)
    {
        
        $payment = Payment::find($id);

        if (!$payment) {
            return redirect()->back()->with('error', 'Payment not found');
        }
    
        if ($payment->status_tiket === 'belum terpakai') {
            $qrCodeData = "Order ID: " . $payment->order_id . "\n"
                . "Email: " . $payment->email . "\n"
                . "No Telepon: " . $payment->no_telp . "\n"
                . "Jumlah Orang: " . $payment->qty . " Orang" . "\n"
                . "Total Harga: Rp." . $payment->total . "\n"
                . "Berlaku Tanggal: " . $payment->tanggal . "\n"
                . "Status: " . $payment->status . "\n"
                . "Status Tiket: " . $payment->status_tiket . "\n";
            $path = 'qrcode/' . $payment->order_id . '.png';
    
            QrCode::format('png')->size('400')->generate($qrCodeData, public_path($path));
            $qrCode = url(asset($path));
    
            Mail::to($payment->email)->send(new Notifikasi($payment, $qrCode));
    
            return redirect()->back()->with('success', 'Notifikasi Email berhasil dikirim');
        } else {
            return redirect()->back()->with('error', 'QR Code Sudah Terpakai');
        }
    }

    public function pay(Request $request)
    {
        $token = $request->input('token');
        return view('dashboard.payment.pay', ['token' => $token]);
    }

    public function list(Request $request)
    {
        $payment = Payment::with('destinasi')->get();
        $namaDestinasi = Destinasi::pluck('nama')->unique();
        $selectedDestinasi = $request->input('destinasiFilter');
        if (!empty($selectedDestinasi)) {
            $payment->whereHas('destinasi', function ($query) use ($selectedDestinasi) {
                $query->where('nama', $selectedDestinasi);
            });
        }
        return view('dashboard.payment.list', [
            'payment' => $payment,
            'token' => 'cc32821a-3b32-4d64-ae8d-135e78ec9352',
            'namaDestinasi' => $namaDestinasi,
            'selectedDestinasi' => $selectedDestinasi,
        ]);
    }

    public function filter(Request $request)
    {
        $selectedDestinasi = $request->input('destinasiFilter');

        $payment = Payment::with('destinasi');

        if (!empty($selectedDestinasi)) {
            $payment->whereHas('destinasi', function ($query) use ($selectedDestinasi) {
                $query->where('nama', $selectedDestinasi);
            });
        }

        $payment = $payment->get();
        $namaDestinasi = Destinasi::pluck('nama')->unique();

        return view('dashboard.payment.list', [
            'payment' => $payment,
            'namaDestinasi' => $namaDestinasi,
            'selectedDestinasi' => $selectedDestinasi,
        ]);
    }

    public function all()
    {
        $payment = Payment::all();
        return view('dashboard.payment.index', ['payment' => $payment, 'destinasi' => Destinasi::all()]);
    }
    public function dataUser(Request $request, $user_id)
    {
        if ($request->wantsJson()) {
            try {
                $destinasi = Destinasi::findOrFail($user_id);

                $auth = Auth::user();
                $payment = Payment::with('user', 'destinasi')->where('user_id', $user_id)->get();

                return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil menampilkan Data User',
                    'data' => $payment,
                ]);
            } catch (ModelNotFoundException $e) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data tidak ditemukan',
                ], 404);
            }
        } else {
            $payment = Payment::with('user', 'destinasi')->where('user_id', $user_id)->get();

            return view('dashboard.payment.list', ['payment' => $payment]);
        }
    }

    public function sisakuota(){
            
    }
}
