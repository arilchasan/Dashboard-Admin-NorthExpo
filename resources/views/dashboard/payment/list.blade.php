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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Poppins:wght@400&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/76557bdb99.js" crossorigin="anonymous"></script>
    <div class="create-container">
        <div class="content container-fluid">
            <div class="content-container">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h3 class="text-center" style="margin-top: 30px;font-weight:bold">Daftar Transaksi</h3>


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
                                <tr class="text-center">
                                    <th>
                                        <h5>ID</h5>
                                    </th>
                                    <th>
                                        <h5>Order ID</h5>
                                    </th>
                                    <th>
                                        <h5>Email</h5>
                                    </th>
                                    <th>
                                        <h5>Jumlah Orang</h5>
                                    </th>
                                    <th>
                                        <h5>Total</h5>
                                    </th>
                                    <th>
                                        <h5>Status</h5>
                                    </th>
                                  
                                    <th>
                                        <h5>Opsi</h5>
                                    </th>
                                    


                                </tr>
                                </thead>
                                <br>
                                <tbody>

                                    @if ($payment->isEmpty())
                                        <tr class="text-center">
                                            <td colspan="11">Data Kosong</td>
                                        </tr>
                                    @endif
                                    <tr class="text-center">
                                        @foreach ($payment as $data)
                                        <th>{{ $data->id }}</li>
                                        <th>NE{{ $data->id }}</li>
                                            <th>{{ $data->email }}</li>
                                            <th>{{ $data->qty }}</li>
                                            <th>Rp. {{ $data->total }}</li>
                                                <th>{{ $data->status }}</li>
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

@endsection
