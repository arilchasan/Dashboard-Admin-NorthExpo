@extends('layouts.master')
@section('content')
    <style>
        .status-success {
            color: green;
            font-weight: 500;
        }
    
        .status-pending {
            color: red;
            font-weight: 500;
        }
        .btn {
             background: #002c4f;
             border: 1px solid #002c4f;
             color: white;
        }
        .btn:hover {
            background: white;
            color: #002c4f;
            border: 1px solid #002c4f;
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar;
                width: 350px;

            }

            table {
                width: 100px;
                height: 100%;
                border-collapse: collapse;
                border-spacing: 0;
            }

            th, td {
                border-bottom: 1px solid #ddd;
                font-size: 13px;
            }

            th {
                background-color: #f2f2f2;
            }
            
            .status-success, .status-pending {
                font-weight: 500;
            }
            .btn {
               height: 30px;
               /* padding: 3px 5px; */
               font-size: 13px;

            }
        }
        
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Poppins:wght@400&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/76557bdb99.js" crossorigin="anonymous"></script>
    <div class="page-wrapper">
    <div class="create-container">
        <div class="content container-fluid">
            <div class="content-container">
                <h3 class="text-center" style="margin-bottom: 20px;font-weight:bold">Data Transaksi {{ $namaDestinasi }}</h3>
                        <div class="table-responsive">
                            <table class="table table-white table-striped text-center">
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
                                        <h5>Order ID</h5>
                                    </th>
                                    <th>
                                        <h5>Status Tiket</h5>
                                    </th>
                                    <th>
                                        <h5>Opsi</h5>
                                    </th>
                                    {{-- <th>
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
                                    --}}
                                </tr>
                                <br>
                                <tbody>

                                    @if ($transaksiData->isEmpty())
                                        <tr class="text-center">
                                            <td colspan="11">Data Kosong</td>
                                        </tr>
                                    @endif 
                                        @foreach ($transaksiData as $data)
                                        <th style="">{{ $data->order_id }}</th>
                                        <th class="{{ $data->status_tiket === 'sudah terpakai' ? 'status-success' : 'status-pending' }}">
                                            {{ $data->status_tiket }}
                                        </th>
                                         <th>
                                                <a href="{{route('detail.transaksi', $data->order_id)}}"
                                                    class="btn">Detail</a>
                                        </th>
                                            {{-- <th>{{ $data->email }}</li>
                                            <th>{{ $data->qty }}</li>
                                            <th class="formatted-date">{{ $data->tanggal }}</th>   
                                            <th>Rp{{ number_format($data->total, 0, ',', '.') }}</li>
                                            <td class="{{ $data->status === 'success' ? 'status-success' : 'status-pending' }}">
                                                    {{ $data->status }}
                                            </td>
                                             --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
