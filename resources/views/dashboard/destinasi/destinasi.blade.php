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
                            <h3 class="text-center" style="margin-top: 30px;font-weight:bold">Daftar Destinasi Wisata</h3>


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
                                        <h5>Nama</h5>
                                    </th>
                                    {{-- <th>
                            <h5>Alamat</h5>
                        </th> --}}
                                    <th>
                                        <h5>Foto</h5>
                                    </th>
                                    <th>
                                        <h5>Foto 2</h5>
                                    </th>
                                    <th>
                                        <h5>Foto 3</h5>
                                    </th>
                                    <th>
                                        <h5>Foto 4</h5>
                                    </th>
                                    <th>
                                        <h5>Kategori</h5>
                                    </th>
                                    <th>
                                        <h5></h5>
                                    </th>
                                    <th>
                                        <h5>Opsi</h5>
                                    </th>
                                    <th>
                                        <h5></h5>
                                    </th>


                                </tr>
                                </thead>
                                <div class="col-lg-7">
                                    <a class="btn btn-outline-primary" href="/dashboard/destinasi/create">Tambah Data</a>
                                </div>
                                <br>
                                <tbody>

                                    @if ($destinasi->isEmpty())
                                        <tr class="text-center">
                                            <td colspan="11">Data Kosong</td>
                                        </tr>
                                    @endif
                                    <tr class="text-center">
                                        @foreach ($destinasi as $data)
                                            <th>{{ $data->id }}</li>
                                            <th>{{ $data->nama }}</li>
                                                {{-- <th>{{ $data->alamat }}</li> --}}
                                            <td><img src="{{ asset('foto/' . $data->foto) }}" width="150"></td>
                                            <td><img src="{{ asset('foto/' . $data->foto2) }}" width="150"></td>
                                            <td><img src="{{ asset('foto/' . $data->foto3) }}" width="150"></td>
                                            <td><img src="{{ asset('foto/' . $data->foto4) }}" width="150"></td>
                                            <th>{{ $data->kategori->nama }}</li>
                                            <td><a type="button" class="btn btn-outline-info"
                                                    href="/dashboard/destinasi/detail/{{ $data->id }}"><i
                                                        class="fa fa-info-circle fa-lg"></i></a> </td>
                                            <td>
                                                <a type="button" class="btn btn-outline-success"
                                                    href="/dashboard/destinasi/edit/{{ $data->id }}"><i
                                                        class="fa fa-pen"></i></a>
                                                <a type="button" class="btn btn-outline-primary"
                                                    href="/dashboard/destinasi/komentar/{{ $data->id }}"><i
                                                        class="fa fa-comment"></i></a>
                                                
                                                        @if (!$data->isInWishlist)
                                                        <form action="{{ route('wishlist.add', ['destinasi_id' => $data->id]) }}" method="post">
                                                            @csrf <!-- CSRF token -->
                                                            <button type="submit" class="btn btn-outline-warning"><i class="fa-solid fa-heart-circle-plus"></i></button>
                                                        </form>
                                                    @else
                                                        <p>Destinasi is already in the wishlist.</p>
                                                    @endif







                                            </td>
                                            <td>
                                                <form
                                                    action="/dashboard/destinasi/destroy/{{ $data->id }}"method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-outline-danger"
                                                        onclick="return confirm('Yakin Mau Hapus ?')"><i
                                                            class="fa fa-reguler fa-trash"></i></button>
                                                </form>
                                            </td>
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
