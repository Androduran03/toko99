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
<form action="/transaksi/{{$transaksi->id}}" method="post">
  @csrf
  @method('put')
<div class="row">
  <div class="col-lg-10">
      @csrf
  <div class="mb-3 row">
    <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
    <div class="col-sm-10">
    <select class="form-select form-control"name="nama_produk" id="nama_produk" aria-label="Default select example">
    @foreach ($produks as $produk)
                <option value="{{ $produk->id }}" {{ $produk->id == $transaksi->produk_id ? 'selected' : '' }}>
                    {{ $produk->nama_produk}}
                   
                </option>
            @endforeach
            </select>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
    <div class="col-sm-10">
      <input type="number" min="1" class="form-control" id="harga"name="harga"value="{{$transaksi->harga}}" readonly>
    </div>
  </div>

  
  <div class="mb-3 row">
    <label for="jml_beli" class="col-sm-2 col-form-label">Jumlah Beli</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="jml_beli"name="jml_beli" value="{{$transaksi->jml_beli}}">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="jml_harga" class="col-sm-2 col-form-label">Jumlah Harga</label>
    <div class="col-sm-10">
      <input type="number" min="0" class="form-control" id="jml_harga"name="jml_harga"value="{{$transaksi->jml_harga}}"  readonly>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="jml_bayar" class="col-sm-2 col-form-label">Jumlah Bayar</label>
    <div class="col-sm-10">
      <input type="number" min="1" class="form-control" id="jml_bayar"name="jml_bayar"value="{{$transaksi->jml_bayar}}">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="kembalian" class="col-sm-2 col-form-label">Kembalian</label>
    <div class="col-sm-10">
     <input type="number" min="1" class="form-control" id="kembalian"name="kembalian"value="{{$transaksi->kembalian}}" readonly>
    </div>
  </div>
  <div class="mb-3 row">
    <button class="btn btn-primary">Simpan</button>
    </div>
  </div>
  </div>
  </form>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
      $('#nama_produk').change(function() {
            var productId = $(this).val();
            $.get('/get-product-price/' + productId, function(data) {
                $('#harga').val(data.harga);
               
            });
        });

        $('#jml_beli').on('input', function() {
            var quantity = $(this).val();
            var price = $('#harga').val();
            var total_price = parseFloat(quantity) * parseFloat(price);

            if (!isNaN(total_price)) {
                $('#jml_harga').val(total_price.toFixed(2));
            } else {
                $('#jml_harga').val('');
            }
        });
        $('#jml_beli, #jml_bayar').on('input', function() {
            var quantity = $('#jml_beli').val();
            var price = $('#harga').val();
            var total_price = parseFloat(quantity) * parseFloat(price);
            var paid_amount = $('#jml_bayar').val();
            var change = parseFloat(paid_amount) - total_price;

            if (!isNaN(total_price)) {
                $('#jml_harga').val(total_price.toFixed(2));
            } else {
                $('#jml_harga').val('');
            }

            if (!isNaN(change) && change >= 0) {
                $('#kembalian').val(change.toFixed(2));
            } else {
                $('#kembalian').val('');
            }
        });
        });
        
    //     calculateTotalPrice();
    // });
    // $('#jml_beli').keyup(function() {
    //         calculateTotalPrice();
    //     });
    //     function calculateTotalPrice() {
    //         var productId = $('#nama_produk').val();
    //         var quantity = parseInt($('#jml_beli').val()) || 1; // Menggunakan 1 jika jumlah beli tidak valid
    //         $.get('/get-product-price/' + productId, function(data) {
    //             var price = parseFloat(data);
    //             var totalPrice = price * quantity;
    //             $('#harga').val(price.toFixed(2));
    //             $('#jml_harga').val(totalPrice.toFixed(2));
    //         });
    //     }
    //     $('#jml_bayar').keyup(function() {
    //         calculateChange();
    //     });

    //     function calculateChange() {
    //         var total_price = parseFloat($('#jml_harga').val());
    //         var payment = parseFloat($('#jml_bayar').val()) || 0;
    //         var change = payment - total_price;
    //         $('#kembalian').val(change.toFixed(2));
    //     }
    


    // // Fungsi untuk mengambil harga dari database atau sumber data lainnya
    // function getProductPrice(productId) {
    //     // Implementasikan logika pengambilan harga sesuai dengan produk yang dipilih
    //     // Contoh: Anda bisa mengirim permintaan AJAX ke server untuk mengambil harga berdasarkan productId
    //     // atau Anda bisa memiliki array JavaScript dengan harga yang sesuai dan mengambilnya dari sana
    //     // Sesuaikan dengan struktur aplikasi Anda.
    //     return 0; // Gantilah dengan harga yang sesuai
    // }
</script>

@endSection