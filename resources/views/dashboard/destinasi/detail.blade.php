@extends('layouts.master')

@section('content')
<div class="detailpeta">
        <div class="create-content">
                <h1 align="center">Detail Detinasi Wisata</h1>
                <form class="row g-3">
                
                <div class="col-md-6">
                    <label for="">Nama Tempat</label>
                    <input type="text" class="form-control" id="" name="" value="{{$destinasi->nama}}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="">Kategori</label>
                    <input type="text" class="form-control" id="" name="" value="{{$destinasi->kategori->nama}}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="">Wilayah</label>
                    <input type="text" class="form-control" id="" name="" value="{{$destinasi->wilayah->nama}}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="">Status</label>
                    <input type="text" class="form-control" id="" name="" value="{{$destinasi->status}}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="">Latitude</label>
                    <input type="text" class="form-control" id="" name="" value="{{$destinasi->latitude}}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="">Longitude</label>
                    <input type="text" class="form-control" id="" name="" value="{{$destinasi->longitude}}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="">Jam Operaional</label>
                    <input type="text" class="form-control" id="" name="" value="{{$destinasi->operasional}}" readonly>
                </div>               
                <div class="col-md-6">
                    <label for="">Jam Pelayanan Tiket</label>
                    <input type="text" class="form-control" id="" name="" value="{{$destinasi->pelayanan}}" readonly>
                </div>               
                <div class="col-md-12">
                    <label for="">Lokasi</label>
                    <input type="text" class="form-control" id="" name="" value="{{$destinasi->alamat}}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="">Harga Tiket</label>
                    <input type="text" class="form-control" id="" name="" value="Rp. {{$destinasi->harga}}" readonly>
                </div>               
                <div class="col-md-6">
                    <label for="">Kuota Pelanggan</label>
                    <input type="text" class="form-control" id="" name="" value="{{$destinasi->kuota}}" readonly>
                </div>                 
                <div class="col-md-6">
                    <label for="">Maps</label>
                    <textarea  style="height:200px" type="textarea" class="form-control" id="" name="" value="{{$destinasi->maps}}" readonly>{{$destinasi->maps}} </textarea>
                </div>
                <div class="col-md-6">
                    <label for="">Deskripsi</label>
                    <textarea  style="height:200px" type="textarea" class="form-control" id="" name="" value="{{$destinasi->deskripsi}}" readonly>{{$destinasi->deskripsi}} </textarea>
                </div>
            
                    <div class="col-md-6">
                        <label for="">Foto Wisata 1</label>
                        <br>
                        <img src="{{asset('foto/'.$destinasi->foto)}}" alt="" width="500" class="image">
                    </div>
                    <div class="col-md-6">
                        <label for="">Foto Wisata 2</label>
                        <br>
                        <img src="{{asset('foto/'.$destinasi->foto2)}}" alt="" width="500" class="image">
                    </div>
                    <div class="col-md-12">
                        <label>
                            
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label for="">Foto Wisata 3</label>
                        <br>
                        <img src="{{asset('foto/'.$destinasi->foto3)}}" alt="" width="500" class="image">
                    </div>
                    <div class="col-md-6">
                        <label for="">Foto Wisata 4</label>
                        <br>
                        <img src="{{asset('foto/'.$destinasi->foto4)}}" alt="" width="500" class="image">
                    </div>

                <div class="col-md-12" style="margin-top:4%">
                    <a href="/dashboard/destinasi/all" type="button" class="btn btn-secondary mx-2" >Kembali</a>
                
                </div>       
            </form>
        </div>
        
</div>

@endsection
<style>
    .detailpeta {
        /* padding: 5vh; */
    margin-top: 7%;
    /* background-color: #722525; */
    height: 75vh;
    margin-left: 30vh;
    width: 165vh;
    overflow-y: scroll;
    position: relative;
    }
    label{
        margin-top: 20px
    }
    .image{
        border: 1px solid #000000;
    }
</style>