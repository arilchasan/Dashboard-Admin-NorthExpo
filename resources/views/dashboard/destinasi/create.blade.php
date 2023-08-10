@extends('layouts.master')

@section('content')
<div class="page-wrapper">
<div class="create-container">
    <div class="content container-fluid">
        <div class="content-container">
                <h1 align="center">Tambah Data Wisata</h1>
                <form action="/dashboard/destinasi/add" method="post" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label for="nama">Nama Wisata</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Wisata">
                </div>
                
                <div class="col-md-6 kategori">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select" name="kategori_id" id="kategori_id" >
                        <option value="{{ old('kategori_id')}}">  Pilih Jenis Kategori  </option>
                        @foreach ($kategori as $class)
                            <option value="{{ $class->id }}">{{ $class->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 kategori">
                    <label for="wilayah_id" class="form-label">Kategori</label>
                    <select class="form-select" name="wilayah_id" id="wilayah_id" >
                        <option value="{{ old('wilayah_id')}}">  Pilih Wilayah  </option>
                        @foreach ($wilayah as $class)
                            <option value="{{ $class->id }}">{{ $class->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" id="status" name="status" value="{{ old('status') }}" placeholder="Masukkan Status (true/false)">
                </div>
                <div class="col-md-6">
                    <label for="latitude">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude') }}" placeholder="Masukkan Latitude">
                </div>
                <div class="col-md-6">
                    <label for="longitude">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude') }}" placeholder="Masukkan Longitude">
                </div>
                
                <div class="col-md-6">
                    <label for="foto">Foto Wisata</label>
                    <input type="file" class="form-control" id="foto" name="foto" value="{{ old('foto') }}" placeholder="Masukkan Foto Wisata">
                </div>
                <div class="col-md-6">
                    <label for="foto2">Foto Wisata 2</label>
                    <input type="file" class="form-control" id="foto2" name="foto2" value="{{ old('foto2') }}" placeholder="Masukkan Foto Wisata">
                </div>
                <div class="col-md-6">
                    <label for="foto3">Foto Wisata 3</label>
                    <input type="file" class="form-control" id="foto3" name="foto3" value="{{ old('foto3') }}" placeholder="Masukkan Foto Wisata">
                </div>
                <div class="col-md-6">
                    <label for="foto4">Foto Wisata 4</label>
                    <input type="file" class="form-control" id="foto4" name="foto4" value="{{ old('foto4') }}" placeholder="Masukkan Foto Wisata">
                </div>
                <div class="col-md-6">
                    <label for="operasional">Jam Operasional</label>
                    <input type="text" class="form-control" id="operasional" name="operasional" value="{{ old('operasional') }}" placeholder="Masukkan Jam Operasioanal">
                </div>
                <div class="col-md-6">
                    <label for="pelayanan">Jam Pelayanan</label>
                    <input type="text" class="form-control" id="pelayanan" name="pelayanan" value="{{ old('pelayanan') }}" placeholder="Masukkan Jam Pelayanan Tiket">
                </div>
                <div class="col-md-6">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" placeholder="Masukkan Nominal Harga (10000)">
                </div>
                <div class="col-md-6">
                    <label for="kuota">Kuota Pelanggan </label>
                    <input type="text" class="form-control" id="kuota" name="kuota" value="{{ old('kuota') }}" placeholder="Masukkan Kuota (100)">
                </div>
                <div class="col-md-12">
                    <label for="alamat">Lokasi Wisata</label>
                    <textarea type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan Alamat Wisata"></textarea>
                </div>
                <div class="col-md-6">
                    <label for="deskripsi">Deskripsi Wisata</label>
                    <textarea style="height: 200px" type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Masukkan Deskripsi Wisata"></textarea>
                </div>
                <div class="col-md-6">
                    <label for="maps">Maps Wisata</label>
                    <textarea style="height: 200px" type="text" class="form-control" id="maps" name="maps" value="{{ old('maps') }}" placeholder="Masukkan Maps Wisata"></textarea>
                </div>
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
    label {
        margin-top: 20px;
    }
    .kategori {
        display: flex;
        flex-direction: column;       
    }

    .kategori select {
        height: 2.5rem;
        text-align: center;
    }
</style>