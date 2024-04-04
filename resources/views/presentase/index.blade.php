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
    
<table class="table" id="regresilinier">
  <thead>
    <tr>
    <th scope="col">No</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Bulan(X)</th>
      <th scope="col">Jml Penjualan(Y)</th>
      <th scope="col">Prediksi(Y')</th>
      <th scope="col">Y-Y'</th>
      <th scope="col">(Y-Y')^2</th>
      <th scope="col">((Y-Y')/Y)</th>
     
    </tr>
  </thead>
  <tbody>
  @foreach($presentases as $presentase)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{date('F-Y',strtotime($presentase->keterangan))}}</td>
      <td>{{$presentase->X}}</td>
      <td>{{$presentase->Y}}</td>
      <td>?</td>
      <td>?</td>
      <td>?</td>
      <td>?</td>
      
      
    </tr>
    @endforeach
  </tbody>
</table>
<a href="/prosespresentase"class="btn btn-primary "><i class="bi bi-arrow-repeat"></i>Proses</a>

<br>
<br>
<table class="table"id="transaksi">
  <thead>
    <tr>
    <th scope="col">No</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Bulan(X)</th>
      <th scope="col">Jml Penjualan(Y)</th>
      <th scope="col">Prediksi(Y')</th>
      <th scope="col">Y-Y'</th>
      <th scope="col">(Y-Y')^2</th>
      <th scope="col">((Y-Y')/Y)</th>
     
    </tr>
  </thead>
  <tbody>
  @foreach($presentases as $presentase)
  @if($presentase->prediksi>0)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{date('F-Y',strtotime($presentase->keterangan))}}</td>
      <td>{{$presentase->X}}</td>
      <td>{{$presentase->Y}}</td>
      <td>{{$presentase->prediksi}}</td>
      <td>{{$presentase->MAD}}</td>
      <td>{{$presentase->MSE}}</td>
      <td>{{$presentase->MAPE}}</td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>

<br> 
@foreach($hasilpresentases as $hasilpresentase)
@if($hasilpresentase!=null)
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Hasil!</h4>
 
  <p>Hasil dari prediksi untuk penjualan <strong>{{$namaproduk?$namaproduk:'Barang Tidak Di Kenal!'}}</strong> pada Toko 99  menggunakan Metode  Regresi Linear Sederhana adalah sebagai berikut: <br>

1.Mean Absolute Deviation (MAD): <strong>{{$hasilpresentase->hasilMAD}}</strong>  <br>
2.Mean Squared Error (MSE): <strong>{{$hasilpresentase->hasilMSE}}</strong> <br>
3.Mean Absolute Percentage Error (MAPE): <strong>{{$hasilpresentase->hasilMAPE}}</strong> 
</p>
  <hr>
  <h5>Kesimpulan:</h5>
  @if($hasilpresentase->hasilMAPE < 0.1)
  <p>Berdasarkan nilai MAPE yang diperoleh, dapat disimpulkan bahwa MAPE tersebut berada dalam kategori <strong>TINGGI</strong>.</p>
  
  @elseif($hasilpresentase->hasilMAPE > 0.1 && $hasilpresentase->hasilMAPE <= 0.2)
  <p>Berdasarkan nilai MAPE yang diperoleh, dapat disimpulkan bahwa MAPE tersebut berada dalam kategori <strong>BAIK</strong>.</p>
 
  @elseif($hasilpresentase->hasilMAPE > 0.2 && $hasilpresentase->hasilMAPE <= 0.5)
  <p>Berdasarkan nilai MAPE yang diperoleh, dapat disimpulkan bahwa MAPE tersebut berada dalam kategori <strong>REASONABLE</strong>.</p>
 
  @elseif($hasilpresentase->hasilMAPE > 0.5)
  <p>Berdasarkan nilai MAPE yang diperoleh, dapat disimpulkan bahwa MAPE tersebut berada dalam kategori <strong>RENDAH</strong>.</p>
 @endif
</div>
@endif
@endforeach

@endSection