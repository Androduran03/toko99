
    
    <h1>Laporan Penjualan</h1>
    <p>Periode: {{date('F-Y',strtotime($keterangan))}}</p>
    @php
    $totalPrice = 0;
@endphp
    <table class="table" id="table">
        <thead>
        <tr>
      <th scope="col">No</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Nama Produk</th>
      <th scope="col">Harga/pc</th>
      <th scope="col">Jml Stok</th>
      <th scope="col">jml Beli</th>
      <th scope="col">jml Harga</th>
    </tr>
        </thead>
        <tbody>
            @foreach ($data as $sale)
                <tr>
                    <th>{{$loop->iteration}}</th>
                    <td>{{ $sale->keterangan }}</td>
                    <td>{{ $sale->nama_produk }}</td>
                    <td>{{ $sale->harga}}</td>
                    <td>{{ $sale->produk->jml_stok }}</td>
                    <td>{{ $sale->jml_beli }}</td>
                    <td>{{ $sale->jml_harga }}</td>
                </tr>
                @php
                $totalPrice += $sale->jml_harga; // Menambahkan harga produk ke total
            @endphp
                @endforeach
               
        </tbody>
    </table>
 <p> Jumlah Uang
 Rp.{{ number_format($totalPrice) }}
 </p>   
    <button onclick="window.print()">Cetak Laporan</button>
    
   