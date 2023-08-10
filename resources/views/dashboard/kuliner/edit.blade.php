@extends('layouts.master')

@section('content')
<div class="page-wrapper">
<div class="create-container">
    <div class="content container-fluid">
        <div class="content-container">
                <h1 align="center">Edit Destinasi Wisata</h1>
                <form action="/dashboard/kuliner/update/{{$kuliner->id}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

            
                <div class="col-md-6">
                    <label class="label" for="nama_warung">Nama Warung</label>
                    <input type="text" class="form-control" id="nama_warung" name="nama_warung" value="{{ old('nama_warung',$kuliner->nama_warung) }}" >
                </div>               
                <div class="col-md-6">
                    <label class="label" for="nama_kuliner">Nama Kuliner</label>
                    <input type="text" class="form-control" id="nama_kuliner" name="nama_kuliner" value="{{ old('nama_kuliner',$kuliner->nama_kuliner) }}" >
                </div>               
                <div class="col-md-6">
                    <label class="label" for="alamat">Lokasi</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat',$kuliner->alamat) }}" >
                </div>               
                <div class="col-md-6">
                    <label class="label" for="operasional">Nama Kuliner</label>
                    <input type="text" class="form-control" id="operasional" name="operasional" value="{{ old('operasional',$kuliner->operasional) }}" >
                </div>               
                <div class="col-md-6">
                    <label class="label" for="deskripsi">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ old('deskripsi',$kuliner->deskripsi) }}">
                </div>
                <div class="col-md-6">
                    <label class="label" for="harga">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga"  value="{{ old('harga',$kuliner->harga) }}">
                </div>
                <div class="col-md-6">
                    <label class="customer_service" for="harga">Customer Service</label>
                    <input type="text" class="form-control" id="customer_service" name="customer_service"  value="{{ old('customer_service',$kuliner->customer_service) }}">
                </div>
                <div class="col-md-6">
                    <label class="label" for="foto">Foto Wisata</label>
                    <input type="file" class="form-control" id="foto" name="foto"  value="{{ old('foto',$kuliner->foto) }}">
                    <br>
                    <img src="{{ asset('kuliner/'.$kuliner->foto) }}" alt="" width="300"  >
                </div>
                <div class="col-md-6">
                    <label class="label" for="foto2">Foto Wisata</label>
                    <input type="file" class="form-control" id="foto2" name="foto2"  value="{{ old('foto2',$kuliner->foto2) }}">
                    <br>
                    <img src="{{ asset('kuliner/'.$kuliner->foto2) }}" alt="" width="300"  >
                </div>
                <div class="col-md-6">
                    <label class="label" for="foto3">Foto Wisata</label>
                    <input type="file" class="form-control" id="foto3" name="foto3"  value="{{ old('foto3',$kuliner->foto3) }}">
                    <br>
                    <img src="{{ asset('kuliner/'.$kuliner->foto3) }}" alt="" width="300"  >
                </div>
                <br>
                <br>
                <div class="col-md-12 mt-2">
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/dashboard/kuliner/all" type="button" class="btn btn-secondary mx-2" >Kembali</a>

                </div>
            </form>
        </div>
        </div>
    </div>  
</div>   
</div>

@endsection

<style>
    label{
        margin-top: 15px;
    }
    .kategori {
        display: flex;
        flex-direction: column;       
    }

    .kategori select {
        height: 2.5rem;
        text-align: center;
    }
    label{
        margin-top: 20px
    }
    .image{
        border: 1px solid #000000;
    }
</style>