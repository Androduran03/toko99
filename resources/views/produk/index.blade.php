@extends('dashboard.layouts.main')
@section('container')
<div class="col-6">
@if(session()->has('gagal'))
<div class="alert alert-danger" role="alert">
{{session('gagal')}}
</div>
@endif
</div>


<div class="container">
  <form action="/produk" method="post">
    @csrf
<div class="row">
  <div class="col-lg-10">
  <div class="mb-3 row">
    <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
    <div class="col-sm-10">
      <input type="text" class="form-control nama_produk @error('nama_produk') is-invalid @enderror" value="{{old('nama_produk')}}" id="nama_produk"name="nama_produk"required>

      @error('nama_produk')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror


    </div>
  </div>
  <div class="mb-3 row">
    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
    <div class="col-sm-10">
      <input type="number" min="0" class="form-control @error('harga') is-invalid @enderror" value="{{old('harga')}}" id="harga"name="harga"required>
      @error('harga')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>
  </div>
  
  <div class="mb-3 row">
    <label for="jml_stok" class="col-sm-2 col-form-label">Jumlah Stok</label>
    <div class="col-sm-10">
      <input type="number" min="0" class="form-control @error('jml_stok') is-invalid @enderror" value="{{old('jml_stok')}}" id="jml_stok"name="jml_stok"required>
      @error('jml_stok')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>
  </div>
  
  <div class="mb-3 row">
    <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
    </div>
  


</div>
      </div>
    </form>
<div class="row mt-4">
  <div class="col">
  
<table class="table"id="tabel">
  <thead >
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Harga/Item</th>
     
      <th scope="col">Jumlah Stok</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
  @foreach($produks as $produk)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$produk->nama_produk}}</td>
      <td>{{$produk->harga}}</td>
  
      <td>{{$produk->jml_stok}}</td>
      <td>
        <a href="/produk/{{$produk->id}}/edit" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
      
        <form action="/produk/{{ $produk->id }}"method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin Ingin Hapus')"><i
                                                class="bi bi-trash"></i></button>
                                    </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
  
</div>
</div>
@endSection