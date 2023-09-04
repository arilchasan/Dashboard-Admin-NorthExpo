<?php

namespace App\Http\Controllers;

use App\Exports\PaymentExport;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Payment;
use App\Models\Transfer;
use Barryvdh\DomPDF\PDF;
use App\Models\Destinasi;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use TCPDF as TCPDF;

Carbon::setLocale('id');
class HomeController extends Controller
{
    /** index page dashboard */
    public function index(Request $request)
    {
        $payment =  Payment::with(['destinasi', 'user'])->get();
        $success = Payment::where('status', 'success')->get();
        $tiket = $success->sum('qty');
        $tiketDestinasi = $success->groupBy('destinasi_id')->map(function ($item) {
            return $item->sum('qty');
        });
        $destinasi = Destinasi::with(['payments'])->where('status', 'true')->get();
        $feeA = Transfer::where('biaya_admin', '!=', '1')->get();
        $fee = $feeA->sum('biaya_admin');
        return view('dashboard.dashboard', ['payment' => $payment, 'tiket' => $tiket, 'destinasi' => $destinasi, 'tiketDestinasi' => $tiketDestinasi, 'fee' => $fee]);
    }

    public function data($id, Request $request)
    {
        $payment =  Payment::with(['destinasi', 'user'])->get();
        $destinasi = Destinasi::find($id);
        $success = Payment::where('status', 'success')->get();
        $filter = $success->where('destinasi_id', $id);
        $tiketDestinasi = $filter->sum('qty');
        $total = $filter->sum('total');
        $reqTanggal = $request->query('tanggal');
        $reqBulan = $request->query('bulan');
        $bulan = date('m', strtotime($reqBulan));


        return view('dashboard.laporan', [
            'destinasi' => $destinasi,
            'tiketDestinasi' => $tiketDestinasi,
            'total' => $total,
            'payment' => $payment,
            'reqTanggal' => $reqTanggal,
            'reqBulan' => $reqBulan,
            'success' => $success,
            'filter' => $filter,
        ]);
    }


    public function filter(Request $request, $id)
    {
        $selectedDate = $request->input('tanggal');
        $destinasi = Destinasi::find($id);

        $success = Payment::where('status', 'success')
            ->where('destinasi_id', $id)
            ->whereDate('tanggal', $selectedDate)
            ->get();

        $filterTiket = Payment::where('status', 'success')
            ->where('destinasi_id', $id)
            ->whereDate('tanggal', $selectedDate)
            ->count();

        $tiketDestinasi = $success->sum('qty');
        $total = max(1, $success->sum('total'));

        $reqTanggal = $request->query('tanggal');
        $tanggal = date('m/d/Y', strtotime($reqTanggal));
        $biaya_admin = max(1, $total * (5 / 100));
        $gross_amount = max(1, $total - $biaya_admin);
        $reqBulan = $request->query('bulan');
        //pembayaran
        // dd($reqBulan);
        $transfer = Transfer::all();
        $order_id = 'TFA' . Carbon::now()->timezone('Asia/Jakarta')->format('YmdHi');

        $dataTf = [
            'order_id' => $order_id,
            'destinasi_id' => $destinasi->id,
            'status' => 'success',
            'tanggal' => $reqTanggal,
            'nominal' => $total,
            'biaya_admin' => $biaya_admin,
            'created_at' => Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ];

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        DB::table('transfers')->insert($dataTf);
        $params = array(
            'transaction_details' => array(
                'order_id' => $order_id,
                'gross_amount' => $gross_amount,
            ),
            'customer_details' => array(
                'From' => 'Aril',
                'To' => 'Admin' . $destinasi->nama,
            ),

        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $responseData = [
            'token' => $snapToken,
            'transfer' => $transfer,
            'destinasi' => $destinasi,
        ];

        return view('dashboard.datesearch', [
            'destinasi' => $destinasi,
            'tiketDestinasi' => $tiketDestinasi,
            'total' => $total,
            'filterTiket' => $filterTiket,
            'tanggal' => $tanggal,
            'reqTanggal' => $reqTanggal,
            'token' => $snapToken,
            'transfer' => $transfer,
            'reqBulan' => $reqBulan,
            'success' => $success,
        ]);
    }

    public function downloadExcel(Request $request, $id)
    {
        $destinasi = Destinasi::find($id);
        $bulan = $request->query('bulan');
        $success = Payment::where('status', 'success')->where('destinasi_id', $id)->whereMonth('tanggal', Carbon::parse($bulan)->month)->get();
        $namaBulan = Carbon::parse($bulan)->format('F');
        $totalTiket = $success->sum('qty');
        $totalPendapatan = $success->sum('total');
        $namaTempat = $destinasi->nama;
        
        $exportData = [
        'success' => $success,
        'namaBulan' => $namaBulan,
        'totalTiket' => $totalTiket,
        'totalPendapatan' => $totalPendapatan,
        'namaTempat' => $namaTempat,
        ];

        return Excel::download(new PaymentExport($exportData), 'Laporan_bulanan_' . $namaTempat . '_'. $namaBulan . '.xlsx');

        // return view('dashboard.pdf', [
        //     'success' => $success,
        //     'namaBulan' => $namaBulan,
        //     'totalTiket' => $totalTiket,
        //     'totalPendapatan' => $totalPendapatan,
        //     'namaTempat' => $namaTempat,
        // ]);
        // $content = view('dashboard.pdf', [
        //     'success' => $success,
        //     'namaBulan' => $namaBulan,
        //     'totalTiket' => $totalTiket,
        //     'totalPendapatan' => $totalPendapatan,
        //     'namaTempat' => $namaTempat,
        // ])->render();

        // $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        // $pdf->SetPrintHeader(false);
        // $pdf->SetPrintFooter(false);
        // $pdf->AddPage();

        // $pdf->writeHTML($content, true, false, true, false, '');
            
        // $pdfFileName = 'Laporan_bulanan_' . $namaTempat . '_'. $namaBulan . '.pdf';

        // $pdf->Output($pdfFileName, 'D');
    }

    public function transfer(Request $request, $id)
    {
        $selectedDate = $request->input('tanggal');
        $destinasi = Destinasi::find($id);

        $success = Payment::where('status', 'success')
            ->where('destinasi_id', $id)
            ->whereDate('tanggal', $selectedDate)
            ->get();

        $filterTiket = Payment::where('status', 'success')
            ->where('destinasi_id', $id)
            ->whereDate('tanggal', $selectedDate)
            ->count();

        $tiketDestinasi = $success->sum('qty');
        $total = max(1, $success->sum('total'));

        $reqTanggal = $request->query('tanggal');
        $tanggal = date('m/d/Y', strtotime($reqTanggal));
        //pembayaran
        $transfer = Transfer::all();
        $order_id = 'TFA' . Carbon::now()->timezone('Asia/Jakarta')->format('YmdH');
        $request->request->add([
            'order_id' => $order_id,
            'destinasi_id' => $destinasi->id,
            'status' => 'pending',
            'tanggal' => $reqTanggal,
            'nominal' => $total,
        ]);

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;


        $transfer = Transfer::create($request->all());
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
            'transfer' => $transfer,
            'destinasi' => $destinasi,
        ];

        return view('dashboard.detailpay', [
            'destinasi' => $destinasi,
            'tiketDestinasi' => $tiketDestinasi,
            'total' => $total,
            'filterTiket' => $filterTiket,
            'tanggal' => $tanggal,
            'reqTanggal' => $reqTanggal,
            'transfer' => $transfer,
            'destinasi' => $destinasi,
        ]);
    }


    /** index page register */
    public function register()
    {
        return view('user.register', ['user' => User::all()]);
    }

    /** index page login */
    public function login()
    {
        return view('user.login', ['admin' => Admin::all()]);
    }

    /** index page verify */
    public function verifyview()
    {
        return view('auth.verify', ['data_user' => User::all()]);
    }
}
