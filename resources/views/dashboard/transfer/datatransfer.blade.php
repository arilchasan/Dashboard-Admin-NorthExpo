@extends('layouts.master')
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Poppins:wght@400&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/76557bdb99.js" crossorigin="anonymous"></script>
    <div class="page-wrapper">



        <style>
.status-success {
    color: green;
    font-weight: 500; 
}




        </style>
    <div class="create-container">
        <div class="content container-fluid">
            <div class="content-container">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h3 class="text-center" style="margin-top: 30px;font-weight:bold">Data Tranfer</h3>
                            <table class="table table-warning table-striped text-center ">
                                <tr class="text-center">
                                    <th>
                                        <h5>ID</h5>
                                    </th>
                                    <th>
                                        <h5>Order ID</h5>
                                    </th>
                                    <th>
                                        <h5>Destinasi</h5>
                                    </th>

                                    <th>
                                        <h5>Nominal</h5>
                                    </th>
                                    <th>
                                        <h5>Biaya admin</h5>
                                    </th>
                                    <th>
                                        <h5>Tanggal</h5>
                                    </th>
                                    <th>
                                        <h5>Status</h5>
                                    </th>
                                    
                                    


                                </tr>

                                {{-- @foreach ($transfer as $item) --}}
                                @foreach ($admin as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->order_id }}</td>
                                        <td>{{ $data->destinasi->nama }}</td>
                                        
                                        <td>{{ $data->nominal }}</td>
                                        <td></td>{{ $data->biaya_admin }}</td>
                                        <th class="formatted-date">{{ $data->tanggal }}</th>
                                        <td class="status-success">{{ $data->status }}</td>
                                {{-- @endforeach --}}
                                @endforeach
                                    </tr>
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
    document.addEventListener("DOMContentLoaded", function()) {
        var formattedDates = document.querySelectorAll('.formatted-date');
        formattedDates.forEach(function (element) {
            var tanggal = element.textContent; 
            var formattedDate = moment(tanggal).locale('id').format('DD MMMM YYYY');
            element.textContent = formattedDate; 
        });
    });
</script>

    {{-- {{ $data->links('pagination::bootstrap-5')}}  --}}
@endsection
