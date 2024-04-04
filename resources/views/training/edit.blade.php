@extends('dashboard.layouts.main')
@section('container')

<div class="col-6">
@if(session()->has('error'))
<div class="alert alert-danger" role="alert">
{{session('error')}}
</div>
@endif
</div>


<div class="container">
<form action="/training/{{$training->id}}" method="post">
  @csrf
  @method('put')
  <div class="mb-3 row">
    <label for="bulan" class="col-sm-2 col-form-label">Bulan</label>
    <div class="col-sm-10">
      <input type="number" min="1" class="form-control" id="bulan"name="bulan"value="{{$training->bulan}}"required>
    </div>
  </div>
 

  <div class="mb-3 row">
    <label for="jml_penjualan" class="col-sm-2 col-form-label">jml_penjualan</label>
    <div class="col-sm-10">
      <input type="number" min="1" class="form-control" id="jml_penjualan"name="jml_penjualan"value="{{$training->jml_penjualan}}"required>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
    <div class="col-sm-10">
      <input type="month" min="1" class="form-control @error('keterangan') ? is-invalid @enderror" id="keterangan"name="keterangan"value="{{old('keterangan')?old('keterangan'):$training->keterangan}}"required>
      @error('keterangan')
      <div class="is-invalid">
        {{$message}}
      </div>
      @enderror
      
    </div>
  </div>
  <div class="mb-3 row">
    <button class="btn btn-primary">Simpan</button>
    </div>
  </div>
  </div>
  </form>

</div>


@endSection