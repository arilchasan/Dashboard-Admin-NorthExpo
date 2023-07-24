@extends('layouts.master')

@section('content')
<div class="create-container">
    <div class="content container-fluid">
        <div class="content-container">
                <h1 align="center">Edit Destinasi Wisata</h1>
                <form action="/dashboard/destinasi/update/{{$destinasi->id}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

            
                <div class="col-md-6">
                    <label class="label" for="nama">Nama Wisata</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama',$destinasi->nama) }}" >
                </div>
             
                    <div class="col-md-6 kategori">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select class="form-select" name="kategori_id" id="kategori_id" >
                            @foreach ($kategori as $class)
                                @if(old('kategori_id',$destinasi->kategori_id) == $class->id)
                                    <option value="{{ $class->id }}" selected>{{ $class->nama }}</option>
                                @else
                                <option value="{{ $class->id }}">{{ $class->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-6 wilayah">
                        <label for="wilayah_id" class="form-label">Kategori</label>
                        <select class="form-select" name="wilayah_id" id="wilayah_id" >
                            @foreach ($wilayah as $class)
                                @if(old('wilayah_id',$destinasi->wilayah_id) == $class->id)
                                    <option value="{{ $class->id }}" selected>{{ $class->nama }}</option>
                                @else
                                <option value="{{ $class->id }}">{{ $class->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
               
                <div class="col-md-6">
                    <label class="label" for="status">Status</label>
                    <input type="text" class="form-control" id="status" name="status" required value="{{ old('status',$destinasi->status) }}">
                </div>
               
                <div class="col-md-6">
                    <label class="label" for="latitude">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" required value="{{ old('latitude',$destinasi->latitude) }}">
                </div>
                <div class="col-md-6">
                    <label class="label" for="longitude">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" required value="{{ old('longitude',$destinasi->longitude) }}">
                </div>
                <div class="col-md-6">
                    <label class="label" for="operasional">Jam Operasional</label>
                    <input type="text" class="form-control" id="operasional" name="operasional" value="{{ old('operasional',$destinasi->operasional) }}" >
                </div>
                <div class="col-md-6">
                    <label class="label" for="pelayanan">Jam Pelayanan Tiket</label>
                    <input type="text" class="form-control" id="pelayanan" name="pelayanan" value="{{ old('pelayanan',$destinasi->pelayanan) }}" >
                </div>
                <div class="col-md-12">
                    <label class="label" for="alamat">Lokasi Wisata</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat',$destinasi->alamat) }}" >
                </div>
                <div class="col-md-6">
                    <label class="harga" for="harga">Harga Tiket</label>
                    <input type="text" class="form-control" id="harga" name="harga" value="{{ old('harga',$destinasi->harga) }}" >
                </div>
                <div class="col-md-6">
                    <label class="kuota" for="kuota">Kuota</label>
                    <input type="text" class="form-control" id="kuota" name="kuota" value="{{ old('kuota',$destinasi->kuota) }}" >
                </div>
                <div class="col-md-6">
                    <label class="label" for="foto">Foto Wisata</label>
                    <input type="file" class="form-control" id="foto" name="foto" required value="{{ old('foto',$destinasi->foto) }}">
                    <br>
                    @if($destinasi->foto)
                        <img src="{{ asset('foto/'.$destinasi->foto) }}" alt="" width="500">
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="label" for="foto">Foto Wisata</label>
                    <input type="file" class="form-control" id="foto2" name="foto2" required>
                    <br>
                    @if($destinasi->foto2)
                        <img src="{{ asset('foto/'.$destinasi->foto2) }}" alt="" width="500">
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="label" for="foto">Foto Wisata</label>
                    <input type="file" class="form-control" id="foto3" name="foto3" required>
                    <br>
                    @if($destinasi->foto3)
                        <img src="{{ asset('foto/'.$destinasi->foto3) }}" alt="" width="500">
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="label" for="foto">Foto Wisata</label>
                    <input type="file" class="form-control" id="foto4" name="foto4" required>
                    <br>
                    @if($destinasi->foto4)
                        <img src="{{ asset('foto/'.$destinasi->foto4) }}" alt="" width="500">
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="label" for="maps">Maps Wisata</label>
                    <textarea style="height:200px" type="text" class="form-control" id="maps" name="maps" required value="{{ old('maps',$destinasi->maps) }}"> {{ old('maps',$destinasi->maps) }} </textarea>
                </div>

                <div class="col-md-6">
                    <label class="label" for="deskripsi">Deskripsi Wisata</label>
                    <textarea style="height:200px" type="text" class="form-control" id="deskripsi" name="deskripsi" required value="{{ old('deskripsi',$destinasi->deskripsi) }}"> {{ old('deskripsi',$destinasi->deskripsi) }} </textarea>
                </div>
              
                <br>
                <br>
                <div class="col-md-12 mt-2">
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/dashboard/destinasi/all" type="button" class="btn btn-secondary mx-2" >Kembali</a>

                </div>
            </form>
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
    .wilayah {
        display: flex;
        flex-direction: column;       
    }

    .wilayah select {
        height: 2.5rem;
        text-align: center;
    }
</style>