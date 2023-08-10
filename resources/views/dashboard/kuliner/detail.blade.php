@extends('layouts.master')

@section('content')
<div class="page-wrapper">
<div class="create-container">
    <div class="content container-fluid">
        <div class="content-container">
                <h1 align="center">Detail Data Kuliner</h1>
                <form action="/dashboard/kuliner/add" method="post" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label for="nama">Nama Warung</label>
                    <input type="text" class="form-control" id="nama_warung" name="nama_warung" value="{{ $kuliner->nama_warung }}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="nama">Nama Kuliner</label>
                    <input type="text" class="form-control" id="nama_kuliner" name="nama_kuliner" value="{{ $kuliner->nama_kuliner }}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="nama">Lokasi </label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $kuliner->alamat }}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="nama">Jam Operasional</label>
                    <input type="text" class="form-control" id="operasional" name="operasional" value="{{ $kuliner->operasional }}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="latitude">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $kuliner->deskripsi }}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="longitude">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" value="{{ $kuliner->harga }}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="customer_service">Customer Service</label>
                    <input type="text" class="form-control" id="customer_service" name="customer_service" value="{{ $kuliner->customer_service }}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="">Foto Kuliner</label>
                    <br>
                    <img src="{{asset('kuliner/'.$kuliner->foto)}}" alt="" width="300" class="image">
                </div>
                <div class="col-md-6">
                    <label for="">Foto Kuliner</label>
                    <br>
                    <img src="{{asset('kuliner/'.$kuliner->foto2)}}" alt="" width="300" class="image">
                </div>
                <div class="col-md-6">
                    <label for="">Foto Kuliner</label>
                    <br>
                    <img src="{{asset('kuliner/'.$kuliner->foto3)}}" alt="" width="300" class="image">
                </div>
                <br>
                <div class="col-md-12 mt-2">
                    <!--<button type="submit" class="btn btn-primary">Submit</button>-->
                    <a href="/dashboard/kuliner/all" type="button" class="btn btn-secondary mx-2" >Kembali</a>

                </div>
            </form>
        </div>
    </div>
</div>
</div>
<style>
    label{
        margin-top: 20px
    }
    .image{
        border: 1px solid #000000;
    }
</style>
@endsection