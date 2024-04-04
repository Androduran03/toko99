@extends('dashboard.layouts.main')
@section('container')
<div class="container">
<form action="/laporan" method="POST">
    @csrf
    <div class="col-6">

        <label for="start_date">Tahun-Bulan</label>
        <input type="month" class="form-control" name="keterangan" required> <br>
        
        <button type="submit " class="btn btn-danger btn-sm"><i class="bi bi-file-pdf"></i></i> Generate pdf</button>
    </div>
</form>

<br>
<div class="col-6">

    @if(session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif
</div>

<form action="/export-excel" method="post">
        @csrf
<div class="col-6">

    <label for="keterangan">Tahun-Bulan</label>
    <input type="month" name="keterangan"class="form-control" required> <br>
    
    <button type="submit" class="btn-success btn-sm"><i class="bi bi-file-earmark-spreadsheet"></i>Generate Excel</button>
</div>
    </form>


</div>
@endSection