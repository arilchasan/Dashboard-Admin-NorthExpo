@extends('layouts.master')
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Poppins:wght@400&display=swap"
        rel="stylesheet">
    <div class="create-container">
        <div class="content container-fluid">
            <div class="content-container">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h3 class="text-center" style="margin-top: 30px;font-weight:bold">Daftar User Login</h3>
                            <table class="table table-success table-striped text-left ">
                                @if (session()->has('success'))
                                    <div class="alert alert-success col-lg-12" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <tr class="text-center">
                                    <th>
                                        <h5>ID</h5>
                                    </th>
                                    <th>
                                        <h5>Nama</h5>
                                    </th>
                                    <th>
                                        <h5>Email</h5>
                                    </th>
                                    <th>
                                        <h5>Password</h5>
                                    </th>
                                    <th>
                                        <h5>Email Verified at</h5>
                                    </th>
                                    <th>
                                        <h5>Opsi</h5>
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                    {{-- <div class="col-lg-7">
                <a  class="btn btn-outline-primary" href="/dashboard/create">Tambah Data</a>
            </div> --}}
                                    @if ($user->count())
                                        <tr class="text-center">
                                            @foreach ($user as $data)
                                                <th>{{ $data->id }}</th>
                                                <th>{{ $data->nama }}</th>
                                                <th>{{ $data->email }}</th>
                                                <th>{{ $data->password }}</th>
                                                <th>{{ $data->email_verified_at }}</th>
                                                <th>
                                                    <form action="/dashboard/userlogin/destroy/{{ $data->id }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-outline-danger"
                                                            onclick="return confirm('Yakin Mau Hapus ?')">Hapus</button>
                                                    </form>
                                                </th>

                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <tbody>
                                    <tr>
                                        <td colspan="10" class="text-center">Data Tidak Ada</td>
                                    </tr>
                                </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- {{ $data->links('pagination::bootstrap-5')}}  --}}

@endsection