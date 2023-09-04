@extends('layouts.master')
@section('content')
<div class="page-wrapper">
        <div class="content container-fluid">
            <div class="content-container">
                <h3 align="center">Detail Data Transaksi</h3>
                    <div class="row g-3 detail-wrapper">
                        <div class="col-md-6">
                            <label for="">Order ID</label>
                            <input type="text" class="form-control" id="" name=""
                                value="{{ $transaksiData->order_id }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Email</label>
                            <input type="text" class="form-control" id="" name=""
                                value="{{ $transaksiData->email }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Nomor Pembeli</label>
                            <input type="text" class="form-control" id="" name=""
                                value="{{ $transaksiData->no_telp }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Jumlah Orang</label>
                            <input type="text" class="form-control" id="" name=""
                                value="{{ $transaksiData->qty }} Orang" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Status Pembayaran</label>
                            <input type="text"
                                class="form-control {{ $transaksiData->status === 'success' ? 'status-success' : 'status-pending' }}"
                                id="" name="" value="{{ $transaksiData->status }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Status Tiket</label>
                            <input type="text"
                                class="form-control {{ $transaksiData->status_tiket === 'sudah terpakai' ? 'status-success' : 'status-belum' }}"
                                id="" name="" value="{{ $transaksiData->status_tiket }}" readonly>
                        </div>
                    </div>
                    <a href="/dashboard/order/datatrs"
                        class="btn btn-primary" style="margin-top:10px">Kembali</a>
            </div>
        </div>
</div>            
    <style>
        .col-md-6 {
            margin-top: 15px;
        }

        .status-success {
            color: green;
            font-weight: 500;
        }

        .status-pending {
            color: orange;
            font-weight: 500;
        }

        .status-belum {
            color: red;
            font-weight: 500;
        }
    </style>
@endsection
