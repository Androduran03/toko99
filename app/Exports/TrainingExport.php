<?php

namespace App\Exports;

use App\Models\transaksi;
use App\Models\user;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;
class TrainingExport implements FromQuery, WithHeadings, ShouldAutoSize
{
    protected $bulan;

   
    public function __construct($bulan)
    {
        $this->keterangan = $bulan;
    }
    public function query(){
        return transaksi::where('keterangan', $this->keterangan)
        ->select('keterangan', 'nama_produk','nama_produk','harga','jml_beli','jml_harga','jml_bayar','kembalian');

    }
   


    public function headings(): array
    {
        return [
            
            'Tahun-Bulan',
            'Nama Produk',
            'Harga',
            'Jml Beli',
            'Total Harga',
            'Jml Bayar',
            'Kembalian',
        ];
    }








}
