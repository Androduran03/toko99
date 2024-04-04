@extends('dashboard.layouts.main')
@section('container')


<div class="container">
  <form action="/produk/{{$produk->id}}" method="post">
    @csrf
    @method('put')
<div class="row">
  <div class="col-lg-10">
  <div class="mb-3 row">
    <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
    <div class="col-sm-10">
      <input type="text" class="form-control nama_produk @error('nama_produk') is-invalid @enderror" value="{{old('nama_produk') ? old('nama_produk'):$produk->nama_produk}}" id="nama_produk"name="nama_produk">

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
      <input type="number" min="0" class="form-control @error('harga') is-invalid @enderror" value="{{old('harga') ? old('harga'):$produk->harga}}" id="harga"name="harga">
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
      <input type="number" min="0" class="form-control @error('jml_stok') is-invalid @enderror" value="{{old('jml_stok') ? old('jml_stok'):$produk->jml_stok}}" id="jml_stok"name="jml_stok">
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



@endSection