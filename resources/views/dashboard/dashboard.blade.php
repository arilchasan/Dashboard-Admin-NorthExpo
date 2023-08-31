

@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome {{ auth('role_admins')->user()->username }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard Admin NorthExpo</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card" style="background-color: #f2f2f2;">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Pemasukan Admin</h5>
                            <p class="card-text">Total Fee Admin: Rp{{ number_format($fee, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card" style="background-color: #d1eaff;">
                        <div class="card-body">
                            <h5 class="card-title">Hasil Penjualan Tiket</h5>
                            <p class="card-text">Total Tiket Terjual: {{$tiket}} Tiket</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Laporan Setiap Destinasi </li>
                </ul>
            </div>
            <div class="row">
                @foreach ($destinasi as $data)
                <div class="col-md-6" >
                    <div class="card" style="background-color: #f2f2f2;" >
                        <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
                         
                            <h5 class="card-title">{{$data->nama}}</h5>
                            {{-- <p class="card-text"></p> --}}
                           
                            <a href="{{route('dashboard/laporan', $data->id)}}" class="btn btn-primary">Lihat</a>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- <div class="col-md-6">
                    <div class="card" style="background-color: #d1eaff;">
                        <div class="card-body">
                            <h5 class="card-title">Hasil Penjualan Tiket</h5>
                            <p class="card-text">Total Tiket Terjual: {{$tiket}} Tiket</p>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
