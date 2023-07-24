@extends('layouts.master')

@section('content')
<div class="create-container">
    <div class="content container-fluid">
        <div class="content-container">
                <h1 align="center">Tambah Data Kuliner</h1>
                <form action="/dashboard/kuliner/add" method="post" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label for="nama">Nama Kuliner</label>
                    <input type="text" class="form-control" id="nama_kuliner" name="nama_kuliner" value="{{ old('nama_kuliner') }}" placeholder="Masukkan Nama Kuliner">
                </div>
                <div class="col-md-6">
                    <label for="nama">Nama Kuliner</label>
                    <input type="text" class="form-control" id="nama_kuliner" name="nama_kuliner" value="{{ old('nama_kuliner') }}" placeholder="Masukkan Nama Kuliner">
                </div>
                <div class="col-md-6">
                    <label for="latitude">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Deskripsi Makanan">
                </div>
                <div class="col-md-6">
                    <label for="longitude">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" placeholder="Harga Makanan">
                </div>
                <div class="col-md-6">
                    <label for="foto">Foto </label>
                    <input type="file" class="form-control" id="foto" name="foto" value="{{ old('foto') }}" placeholder="Masukkan Foto ">
                </div>
                <div class="col-md-6">
                    <label for="foto2">Foto 2</label>
                    <input type="file" class="form-control" id="foto2" name="foto2" value="{{ old('foto2') }}" placeholder="Masukkan Foto ">
                </div>
                <div class="col-md-6">
                    <label for="foto3">Foto 3</label>
                    <input type="file" class="form-control" id="foto3" name="foto3" value="{{ old('foto3') }}" placeholder="Masukkan Foto ">
                </div>
                <br>
                <div class="col-md-12 mt-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/dashboard/kuliner/all" type="button" class="btn btn-secondary mx-2" >Kembali</a>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection