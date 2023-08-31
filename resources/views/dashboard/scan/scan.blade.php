@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <h2 style="text-align: center;margin-top:10px;margin-bottom:30px;">Scan Tiket North Expo </h2>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card bg-white shadow rounded-3 p-3 border-0">
                <div class="row">
                    <div class="col-md-8" style="height: fit-content;">
                        <video id="preview" style="width: 100%;height:100%"></video>
                        <form action="{{ route('scanQR') }}" method="POST" id="form">
                            @csrf

                            <input type="hidden" name="order_id" id="order_id">
                            <input type="hidden" name="email" id="email">
                            <input type="hidden" name="no_telp" id="no_telp">
                            <input type="hidden" name="qty" id="qty">
                            <input type="hidden" name="total" id="total">
                            <input type="hidden" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}">
                        </form>
                        <div class="camera-switch">
                            <label>
                                <input type="radio" name="options" value="2" checked> Kamera Laptop
                            </label>
                            <label>
                                <input type="radio" name="options" value="1"> Kamera Handphone
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @if(session('cekData'))
                        <h3>Detail Tiket</h3>     
                            <h5>Order ID: {{ session('cekData')->order_id }} </h5>
                            <h5>Email: {{ session('cekData')->email }}</h5>
                            <h5>No Telepon: {{ session('cekData')->no_telp }}</h5>
                            <h5>Jumlah Orang: {{ session('cekData')->qty }}</h5>
                            <h5>Total Harga: {{ session('cekData')->total }}</h5>
                            <h5>Berlaku Tanggal: {{ session('cekData')->tanggal }}</h5>
                            <h5>Status Pembayaran: {{ session('cekData')->status }}</h5>
                            <h5>Status Tiket: {{ session('cekData')->status_tiket }}</h5>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript">
        const scanner = new Instascan.Scanner({
            video: document.getElementById('preview'),
            scanPeriod: 5,
            mirror: false
        });
        scanner.addListener('scan', function(content) {
            console.log(content);
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
        $('[name="options"]').on('change', function() {
            const selectedCamera = $(this).val();
            if (selectedCamera == 1 && cameras[0]) {
                scanner.start(cameras[0]);
            } else if (selectedCamera == 2 && cameras[1]) {
                scanner.start(cameras[1]);
            } else {
                console.error('Selected camera not available.');
                alert('Selected camera not available.');
            }
        });

        scanner.start(cameras[1]);
    } else {
        console.error('No cameras found.');
        alert('No cameras found.');
    }
}).catch(function(e) {
    console.error(e);
    alert(e);
});

        scanner.addListener('scan', function(c) {
            const qrCodeLines = c.split('\n');

            const order_id = qrCodeLines[0].replace('Order ID: ', '');
            const email = qrCodeLines[1].replace('Email: ', '');
            const no_telp = qrCodeLines[2].replace('No Telepon: ', '');
            const qty = parseInt(qrCodeLines[3].replace('Jumlah Orang: ', '').split(' ')[0]);
            const total = parseInt(qrCodeLines[4].replace('Total Harga: Rp.', ''));
            const tanggal = qrCodeLines[5].replace('Berlaku Tanggal: ', '');


            document.getElementById("order_id").value = order_id;
            document.getElementById("email").value = email;
            document.getElementById("no_telp").value = no_telp;
            document.getElementById("qty").value = qty;
            document.getElementById("total").value = total;
            document.getElementById("tanggal").value = tanggal;

            
            document.getElementById("form").submit();

        });
    </script>
@endsection
