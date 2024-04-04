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
            <form action="/prediksi/{{$prediksi->id}}" method="post">
              @csrf
              @method('put')
                <div class="form-group">
                  <label for="testing">Edit Bulan( Nilai X)</label>
                  <input type="number" min="0" name="testing" class="form-control testing @error('testing') is-invalid @enderror" value="{{old('testing')? old('testing'):$prediksi->bulan}}" id="testing" required>
                  @error('testing');
                  <div class="invalid-feedback">
                  {{$message}}
              </div>
                @enderror
                </div>
                <div class="form-group">
                  <label for="keterangan">Keterengan</label>
                  <input type="month" name="keterangan" class="form-control keterangan @error('keterangan') is-invalid @enderror" value="{{old('keterangan')? old('keterangan'):$prediksi->keterangan}}" id="keterangan" required>
                  @error('keterangan');
                  <div class="invalid-feedback">
                  {{$message}}
              </div>
                @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>
<br>



@endSection