@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="create-container">
        <div class="content container-fluid">
            <div class="content-container">
                <form class="row g-3">
                    <div class="container">
                        <h1>Daftar Komentar</h1>
                        @if ($komentar->isEmpty())
                        <p>Tidak ada komentar saat ini.</p>
                         @else 
                        @foreach ($komentar as $k)
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    
                                    <p class="card-text">{{ $k->komentar }}</p>
                                    <form action="/dashboard/destinasi/komentar/{{ $k->id }}"method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-outline-danger"
                                            onclick="return confirm('Yakin Mau Hapus ?')"><i
                                                class="fa fa-reguler fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </form>
                    <a class="btn btn-outline-primary" href="/dashboard/destinasi/all">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
