@extends('dashboard.layouts.main')
@section('container')
<div class="col-12">
@if(session()->has('error'))
<div class="alert alert-danger text-center" role="alert">
{{session('error')}}
</div>
@endif
</div>
<div class="alert alert-warning" role="alert">
  <p><i class="bi bi-check-circle"></i>  <Strong>Input Data Training! </Strong>mengunakan dua jenis inputan yaitu data penjualan dari file Excel berisi informasi id_produk, keterangan, bulan, dan jumlah penjualan, serta data langsung dari sistem seperti nama produk dan priode.. </p>
</div>
<div class="row">

<div class="col-md-6">
<form action="importcontroller" method="post" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                <label for="training" class="form-label">Input Data (Excel) </label><br>
    <input type="file" name="training" class="form-control training @error('training') is-invalid @enderror" value="{{old('training')}}" name="training" required>
    @error('training');
    <div class="invalid-feedback">
    {{$message}}
</div>
   @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-save"></i> Simpan</button>
            </form>
        </div>

        <div class="col-md-6">
            <form action="/training" method="post">
               @csrf
                <div class="form-group">
                    <label for="idproduk">Input Produk :</label>
                    <select class="form-select form-control idproduk @error('idproduk') is-invalid @enderror" value="{{old('idproduk')}}" name="idproduk" required>
                    
  <option selected>Pilih Produk</option>
  @foreach($produks as $produk)
  <option value="{{$produk->id}}">{{$produk->nama_produk}}</option>
  @endforeach
</select>
@error('nilaiX');
                    <div class="invalid-feedback">
                    {{$message}}
                </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="keterangan">Priode</label>
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


<br>
<div class="container">
<div class="row">
    <div class="col-lg-12">
   
   
 <h5> Nama Produk : <strong> {{$nama_produk}}</strong> </h5>



<table class="table"id="tabel">
  <thead >
    <tr>
      <th scope="col">No</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Bulan</th>
      <th scope="col">Jumlah Penjualan</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
  @foreach($trainings as $training)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{date('F-Y',strtotime($training->keterangan))}}</td>
      <td>{{$training->bulan}}</td>
      <td>{{$training->jml_penjualan}}</td>
      <td>
        <a href="/training/{{$training->id}}/edit" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
      
        
        <form action="/training/{{ $training->id }}"method="post" class="d-inline">
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
<div>
<div>
<a href="/regresilinier" class="btn btn-primary"><i class="bi bi-arrow-repeat"></i>Proses</a>
<br>
<br>
<h5 class="text-center mb-4">Proses Perhitungan Regresi Linier Sederhana</h5>
<div class="alert alert-secondary" role="alert">
Rumus perhitungan Regresi Linear Sederhana adalah: <strong>𝑌=𝑎+𝑏𝑋</strong> <br>
Dimana : <br>
Y = Variabel dependen <br>
X = Variabel independen <br>
a = Konstanta / Intercept <br> 
b = Koefisien regresi / Slope <br>
Dengan : <br>
<img src="/img/rumusA.png" alt="rumusA">
<p> dengan y adalah kuantiti penjualan, x adalah periode penjualan atau bulan penjualan, a adalah konstanta yang menunjukan besarnya nilai y apabila x = 0, dan b adalah besaran perubahan nilai y</p>
</div>
  <div class="row">
    <div class="col-lg-12">
<table class="table "id="regresilinier">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Bulan(X)</th>
      <th scope="col">Jumlah Penjualan(Y)</th>
      <th scope="col">X^2</th>
      <th scope="col">Y^2</th>
      <th scope="col">XY</th>
    </tr>
  </thead>
  <tbody>
  @foreach($regresiliniers as $regresilinier)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$regresilinier->X}}</td>
      <td>{{$regresilinier->Y}}</td>
      <td>{{$regresilinier->Xpangkat2}}</td>
      <td>{{$regresilinier->Ypangkat2}}</td>
      <td>{{$regresilinier->XY}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<br>

@foreach($persamaanregresi as $persamaanregresi)

<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Persamaan Regeresi : <strong>Y=a+bx </strong></h4>
  
  Hasil perhitungan di atas menggunakan persamaan regresi linier sederhana menghasilkan nilai A sebesar <strong>{{$persamaanregresi->a}}</strong> dan nilai B sebesar <strong>{{$persamaanregresi->b}} </strong> .
  <hr>
  <p class="mb-0">Berdasarkan perhitungan diatas maka di perolehlah persamaan regresinya yaitu : <strong>Y={{$persamaanregresi->a}}</strong> + <strong>{{$persamaanregresi->b}} X</strong>.Nilai Persamaan ini nantinya akan di jadikan sebagai acuan untuk memprediksi jumlah penjualan produk pada bulan atau priode berikutnya</p>
</div>
@endforeach
</div>
  </div>
</div>
@endSection