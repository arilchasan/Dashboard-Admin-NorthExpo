@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <h2 align="center">Laporan Detinasi Wisata</h2>

            <div class="row g-3" style="margin-top: 20px">
                <div class="col-md-6">
                    <label for="">Nama Destinasi</label>
                    <input type="text" class="form-control" id="" name="" value="{{$destinasi->nama}}" readonly>
                </div>

                <div class="col-md-6">
                    <form method="get" action="{{ route('filter-tanggal',['id' => $destinasi->id]) }}" >
                    <label for="tanggal" >Tanggal</label>
                        <div class="action-date">
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $reqTanggal ? $reqTanggal : date('Y-m-d') }}" placeholder="Masukkan Tanggal" >
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a class="btn btn-outline-success" href="{{ route('dashboard/laporan',['id' => $destinasi->id]) }}"><i class="la la-refresh "></i></a>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <label for="">Tiket Terjual</label>
                    <input type="text" class="form-control" id="" name=""  class="tanggal" value="{{ isset($filterTiket) ? $filterTiket . ' Tiket Terjual pada tanggal ' . ( $tanggal ?? '') : $tiketDestinasi . ' Tiket Total' }}" readonly>
                </div>
                <br>
                <div class="col-md-6">
                    <label for="">Total Pendapatan</label>
                    <input type="text" class="form-control" id="" name="nominal" value="Rp{{ number_format($total, 0, ',', '.') }} " readonly>
                </div>
                @if(isset($tanggal))
                <div class="col-md-6" style="margin-top:1%">
                    <p class="p-transfer">*Transfer hanya bisa dilakukan maksimal 1x Sehari</p>
                </div>
                @endif
                <div class="col-md-6">
                    <label for="">Bulan</label>
                    <form action="{{ route('downloadPDF',['id' => $destinasi->id]) }}" method="GET">
                    <div class="action-month">
                        <input class="form-control pdf" type="month" name="bulan" value="">
                        <button type="submit" class="btn btn-danger mx-2">Unduh PDF</button>
                    </div>  
                    </form> 
                </div>
                <div class="col-md-12" style="margin-top:1%">
                    <a href="/dashboard/page" type="button" class="btn btn-secondary mx-2" >Kembali</a>
                    @if(isset($tanggal))
                    <a href="" type="button" class="btn btn-primary mx-2" id="pay-button">Transfer ke Admin {{$destinasi->nama}}</a>
                    @endif               
                </div>  
            </div>
       
        </div>
    </div>
    <style>
        form {
            width: 100%;
        }
        label {
            margin-top: 20px;
        }
        .action-date {
            display: flex;
        }
        .action-month {
            display: flex;
        }
        .action-month .pdf {
            height: 60px;
        }
        .action-date button {
            margin-left: 10px;
            margin-right: 10px
        }
        .action-date a {
            margin-top: 3px;
            height: 38px;
        }
        .action-date input {
            width: 100%;
        }
        .p-transfer {
            font-size: 12px;
            color: red;
        }
    </style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tanggalInput = document.getElementById("tanggal");
        if (!tanggalInput.value) {
            const today = new Date().toISOString().split('T')[0];
            tanggalInput.value = today;
        }
    });
</script>
{{-- <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{ $token }}');
        // customer will be redirected after completing payment pop-up
    });
</script> --}}

@endsection
