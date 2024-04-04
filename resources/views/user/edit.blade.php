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
<form action="/user/{{$user->id}}" method="post">
  @csrf
  @method('put')
<div class="row">
  <div class="col-lg-10">
  <div class="mb-3 row">
    <label for="nama" class="col-sm-2 col-form-label">Nama User</label>
    <div class="col-sm-10">
      <input type="text" class="form-control nama @error('nama') is-invalid @enderror" value="{{old('nama')?old('nama'):$user->nama}}" id="nama"name="nama">

      @error('nama')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>
  </div>
  <div class="mb-3 row">
    <label for="email" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email"class="form-control @error('email') is-invalid @enderror" value="{{old('email')?old('email'):$user->email}}" id="email"name="email">
      @error('email')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>
  </div>
  <div class="mb-3 row">
    <label for="password" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="text" class="form-control @error('password') is-invalid @enderror" value="{{old('password')?old('password'):$user->password}}"id="password"name="password">
      @error('password')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>
  </div>
  <div class="mb-3 row">
    <label for="hp" class="col-sm-2 col-form-label"> No hp</label>
    <div class="col-sm-10">
      <input type="text" class="form-control @error('hp') is-invalid @enderror" value="{{old('hp')?old('hp'):$user->hp}}"id="hp"name="hp">
      @error('hp')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>
  </div>

  <div class="mb-3 row">
    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
    <div class="col-sm-10">
    <div class="form-floating">
  <textarea class="form-control form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" id="floatingTextarea2" style="height: 100px">{{old('alamat')?old('alamat'):$user->alamat}}</textarea>
      @error('alamat')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>
  </div>
  </div>
  <div class="mb-3 row">
    <label for="status" class="col-sm-2 col-form-label">Status</label>
    <div class="col-sm-10">
    <select class="form-select form-control form-select-lg mb-3" name="status" aria-label="Large select example">
  <option selected>Pilih Status</option>
  <option value="0" @if ($user->status == 0) selected @endif>0</option>
        <option value="1" @if ($user->status == 1) selected @endif>1</option>
</select>
      @error('status')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>
  </div>
 
  <div class="mb-3 row">
    <button class="btn btn-primary btn-sm"><i class="bi bi-save"></i> Simpan</button>
    </div>
</div>
      </div>
  </form>

</div>



@endSection