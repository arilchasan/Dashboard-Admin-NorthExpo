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
                <h3 class="text-center" style="margin-top: 30px;font-weight:bold">Daftar wisata favorit </h3>


                <table class="table table-danger table-striped text-left ">
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
                            <h5>Nama</h5>
                        </th>
                    </tr>
                    </thead>
                    <br>
                    <tbody>

                        @if ($dataMapped->isEmpty())
                            <tr class="text-center">
                                <td colspan="11">Data Kosong, mohon login terlebih dahulu</td>
                            </tr>
                        @endif
                        <tr class="text-center" >
                            @foreach ($dataMapped as $data)
                                    <th>{{ $data->id }}</li>
                                    <th>{{$data->nama}}</th>
                                    <th>
                                        {{-- <a href="/dashboard/wishlist/delete/{{ $data->id }}" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a> --}}
                                            <form action="/dashboard/wishlist/remove/{{ $data->id }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-outline-danger"
                                                    onclick="return confirm('Yakin Mau Hapus ?')"><i
                                                        class="fa fa-reguler fa-trash"></i></button>
                                            </form>

                            </th>
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

                {{-- {{ $data->links('pagination::bootstrap-5')}}  --}}
            @endsection