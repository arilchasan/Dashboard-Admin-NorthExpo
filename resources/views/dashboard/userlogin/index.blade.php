@extends('layouts.master')
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Poppins:wght@400&display=swap"
        rel="stylesheet">
        <div class="page-wrapper">

     
    <div class="create-container">
        <div class="content container-fluid">
            <div class="content-container">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h3 class="text-center" style="margin-top: 30px;font-weight:bold">Daftar User Login</h3>
                            <table class="table table-success table-striped text-center ">

                                @if (session()->has('success'))
                                <div class="alert alert-success col-lg-12" role="alert">
                                    {{ session('success') }}
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
                                    <th>
                                        <h5>Email</h5>
                                    </th>
                                    <th>
                                        <h5>Avatar</h5>
                                    </th>
                                    {{-- <th>
                                        <h5>Email Verified at</h5>
                                    </th> --}}
                                    <th>
                                        <h5>Opsi</h5>
                                    </th>

                                </tr>
                                </thead>
                                <tbody>

                                    @if ($user->count())
                                        <tr class="text-center">
                                            @foreach ($user as $data)
                                                <th>{{ $data->id }}</th>
                                                <th>{{ $data->name }}</th>
                                                <th>{{ $data->email }}</th>
                                                <th><img src="{{ asset('/assets/img/avatar/' . $data->avatar) }}"
                                                        width="80px"></th>
                                                {{-- <th>{{ $data->email_verified_at }}</th> --}}
                                                <th>
                                                    @if ($data->status)
                                                        <form action="/api/auth/user/unblock/{{ $data->id }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-danger">Unban User</button>
                                                        </form>
                                                    @else
                                                        <form action="/api/auth/user/block/{{ $data->id }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-danger">Ban User</button>
                                                        </form>
                                                    @endif
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
</div>
@endsection
