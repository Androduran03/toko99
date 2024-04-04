@extends('dashboard.layouts.main')
@section('container')
<div class="container">


<form action="/user" method="post">
    @csrf
<div class="row">
  <div class="col-lg-10">
  <div class="mb-3 row">
    <label for="nama" class="col-sm-2 col-form-label">Nama User</label>
    <div class="col-sm-10">
      <input type="text" class="form-control nama @error('nama') is-invalid @enderror" value="{{old('nama')}}" id="nama"name="nama">

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
      <input type="email"class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" id="email"name="email">
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
      <input type="text" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}"id="password"name="password">
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
      <input type="text" class="form-control @error('hp') is-invalid @enderror" value="{{old('hp')}}"id="hp"name="hp">
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
  <textarea class="form-control form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" id="floatingTextarea2" value="{{old('alamat')}}" style="height: 100px"></textarea>
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
  <option value="0">0</option>
  <option value="1">1</option>
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
    <br>


<table class="transaksi mb-4" id="transaksi">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
    
      <th scope="col">Hp</th>
      <th scope="col">Alamat</th>
      <th scope="col">Aksi</th>
     
      
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$user->nama}}</td>
      <td>{{$user->email}}</td>
 
      <td>{{$user->hp}}</td>
      <td>{{$user->alamat}}</td>
     
      <td>
        <a href="/user/{{$user->id}}/edit" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
      
        
        <form action="/user/{{ $user->id }}"method="post" class="d-inline">
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
@endSection