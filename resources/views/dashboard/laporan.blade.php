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

                <div class="col-md-3">
                    <label for="">Tiket Terjual</label>
                    <input type="text" class="form-control" id="" name=""  class="tanggal" value="{{ isset($filterTiket) ? $filterTiket . ' Tiket Terjual pada tanggal ' . ( $tanggal ?? '') : $tiketDestinasi . ' Tiket Total' }}" readonly>
                </div>
                <br>
                <div class="col-md-4">
                    <label for="">Total Pendapatan</label>
                    <input type="text" class="form-control" id="" name="nominal" value="Rp{{ number_format($total, 0, ',', '.') }} " readonly>
                </div>
                <div class="col-md-5">
                    <label for="">Bulan</label>
                    <form action="{{ route('downloadExcel',['id' => $destinasi->id]) }}" method="GET">
                    <div class="action-month">
                        <input class="form-control" type="month" name="bulan" value="">
                        <button type="submit" class="btn btn-success mx-2"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
                    </div>  
                    </form> 
                </div>
                @if(isset($tanggal))
                <div class="col-md-6" style="margin-top:1%">
                    <p class="p-transfer">*Transfer hanya bisa dilakukan maksimal 1x Sehari</p>
                </div>
                @endif
                <div class="col-md-12">
                    <table class="table table-warning table-striped text-center " style="margin-top: 30px">
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
                                <h5>No HP</h5>
                            </th>
                            <th>
                                <h5>Tanggal</h5>
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
                            
                        </tr>
                        @if ($filter->isEmpty())
                        <tr class="text-center">
                            <td colspan="11">Data Kosong</td>
                        </tr>
                        @endif 
                        @foreach ($filter as $item)
                        <tbody>
                            <th>{{ $item->order_id }}</li>
                            <th>{{ $item->destinasi->nama }}</li>
                            <th>{{ $item->email }}</li>
                            <th>{{ $item->no_telp }}</li>
                            <th class="formatted-date">{{ $item->tanggal }}</li>
                            <th>{{ $item->qty }} Orang</li>
                            <th>Rp{{ number_format($item->total, 0 ,',' , '.' )  }}</li>
                            <th class="status-success">{{ $item->status }}</th>    
                            </tbody>
                            @endforeach

                    </table>
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
        .status-success {
                color: green;
                font-weight: 500;
            }
    </style>

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
