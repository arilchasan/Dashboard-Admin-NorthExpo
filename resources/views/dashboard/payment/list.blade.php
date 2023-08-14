@extends('layouts.master')
@section('content')
    {{-- <div class="page-wrapper">
        <div class="content container-fluid"> 
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>    
        </div>
    </div> --}}
    <style>
        .status-success {
            color: green;
            font-weight: 500;
        }
    
        .status-pending {
            color: red;
            font-weight: 500;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Poppins:wght@400&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/76557bdb99.js" crossorigin="anonymous"></script>
    <div class="page-wrapper">
    <div class="create-container">
        <div class="content container-fluid">
            <div class="content-container">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h3 class="text-center" style="margin-top: 30px;margin-bottom: 20px;font-weight:bold">Daftar Transaksi</h3>


                            <table class="table table-warning table-striped text-center ">
                                @if (session()->has('success'))
                                    <div class="alert alert-success col-lg-12" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if (session()->has('error'))
                                    <div class="alert alert-danger col-lg-12" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="row">
                                @php
                                $totalTransaksi = 0;
                                foreach ($payment as $data) {
                                    if ($data->status == 'success') {
                                        $totalTransaksi += $data->total;
                                    }
                                }
                                @endphp
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header" style="font-weight: 500">
                                            Total Pendapatan Rp{{ number_format($totalTransaksi, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <form action="{{ route('dashboard.payment.filter') }}" method="GET">
                                        <select id="destinasiFilter" name="destinasiFilter" class="form-control" style="font-weight: 500;height:50px" onchange="this.form.submit()">
                                            <option value="">Semua Destinasi</option>
                                            @foreach ($namaDestinasi as $nama)
                                                <option value="{{ $nama }}" {{ $nama == $selectedDestinasi ? 'selected' : '' }}>{{ $nama }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                                
                                                                    
                            </div>
                                <tr class="text-center">
                                    <th>
                                        <h5>Order ID</h5>
                                    </th>
                                    <th>
                                        <h5>Destinasi</h5>
                                    </th>
                                    <th>
                                        <h5>Email</h5>
                                    </th>
                                    <th>
                                        <h5>Jumlah Orang</h5>
                                    </th>
                                    <th>
                                        <h5>Tanggal</h5>
                                    </th>
                                    <th>
                                        <h5>Total</h5>
                                    </th>
                                    <th>
                                        <h5>Status</h5>
                                    </th>
                                  
                                    {{-- <th>
                                        <h5>Opsi</h5>
                                    </th> --}}
                                    


                                </tr>
                                </thead>
                                <br>
                                <tbody>

                                    @if ($payment->isEmpty())
                                        <tr class="text-center">
                                            <td colspan="11">Data Kosong</td>
                                        </tr>
                                    @endif 
                                        @foreach ($payment as $data)
                                        <th>{{ $data->order_id }}</li>
                                            <th>{{ $data->destinasi->nama }}</li>
                                            <th>{{ $data->email }}</li>
                                            <th>{{ $data->qty }}</li>
                                            <th class="formatted-date">{{ $data->tanggal }}</th>   
                                            <th>Rp{{ number_format($data->total, 0, ',', '.') }}</li>
                                            <td class="{{ $data->status === 'success' ? 'status-success' : 'status-pending' }}">
                                                    {{ $data->status }}
                                            </td>
                                            {{-- <td><a type="button" class="btn btn-outline-info"
                                                    href="/dashboard/order/payment/{{ $data->id }}"><i
                                                        class="fa fa-ticket fa-lg"></i></a> </td> --}}
                                            {{-- <td><a type="button" class="btn btn-outline-danger"
                                                    href="/dashboard/order/notifikasi/{{ $data->id }}"><i>Kirim Notifikasi</i></a> </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var formattedDates = document.querySelectorAll('.formatted-date');
        formattedDates.forEach(function (element) {
            var tanggal = element.textContent; 
            var formattedDate = moment(tanggal).locale('id').format('DD MMMM YYYY');
            element.textContent = formattedDate; 
        });
    });
</script>

@endsection
