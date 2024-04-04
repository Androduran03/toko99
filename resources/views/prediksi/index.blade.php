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
    <div class="row">
        <div class="col-md-6">
            <form action="/testing" method="post" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                    <label for="nama1">Input Bulan(excel):</label>
                  <input type="file" name="testing" class="form-control testing @error('testing') is-invalid @enderror" value="{{old('testing')}}" id="testing">
                  @error('testing');
                  <div class="invalid-feedback">
                  {{$message}}
              </div>
                @enderror

                </div>
                <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-save"></i> Simpan</button>
            </form>
        </div>
        <div class="col-md-6">
            <form action="/prediksi" method="post">
               @csrf
                <div class="form-group">
                    <label for="nama2">Input Bulan (Nilai X) :</label>
                    <input type="number" min="0" name="bulan" class="form-control bulan @error('bulan') is-invalid @enderror" value="{{old('bulan')}}" name="bulan" required>
                    @error('bulan');
                    <div class="invalid-feedback">
                    {{$message}}
                </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="keterangan">Keterengan</label>
                  <input type="month" name="keterangan" class="form-control keterangan @error('keterangan') is-invalid @enderror" value="{{old('keterangan')}}" id="keterangan" required>
                  @error('keterangan');
                  <div class="invalid-feedback">
                  {{$message}}
              </div>
                @enderror
                </div>

                <!-- Tambahkan elemen input dan elemen form lainnya untuk Form 2 -->
                <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>
<br>
<br> <br>
<table class="table"id="tabel">
  <thead >
    <tr>
      <th scope="col">No</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Bulan</th>
      <th scope="col">Prediksi</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
  @foreach($prediksis as $prediksi)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{date('F-Y',strtotime($prediksi->keterangan))}}</td>
      <td>{{$prediksi->bulan}}</td>
      <td>?</td>
      
      <td>
        <a href="/prediksi/{{$prediksi->id}}/edit" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
      
        <form action="/prediksi/{{ $prediksi->id }}"method="post" class="d-inline">
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
<a href="/prosesprediksi"class="btn btn-primary "><i class="bi bi-arrow-repeat"></i>Proses</a>

<br>
<br>
<table class="table"id="transaksi">
  <thead >
    <tr>
      <th scope="col">No</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Bulan</th>
      <th scope="col">Prediksi</th>
     
    </tr>
  </thead>
  <tbody>
  @foreach($prediksis as $prediksi)
  @if($prediksi->jml_penjualan > 0)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{date('F-Y',strtotime($prediksi->keterangan))}}</td>
      <td>{{$prediksi->bulan}}</td>
      <td>{{$prediksi->jml_penjualan}}</td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
<br>
<a href="/grafik" class="btn btn-primary">Lihat Grafik</a>

@endSection