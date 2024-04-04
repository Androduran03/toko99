<?php

namespace App\Http\Controllers;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TrainingExport;
use App\Models\transaksi;
use Illuminate\Http\Request;


class SalesController extends Controller
{

    public function index()
{
    return view('laporan.index',[
        'title'=>'Laporan Penjualan'
    ]);
}

public function generateReport(Request $request)
{
    $startDate = $request->input('keterangan');
   

    $sales = transaksi::where('keterangan',$startDate)->get();

$keterangan=transaksi::select('keterangan')->where('keterangan',$startDate)->first();
if($keterangan!=null){
$ktr=$keterangan->keterangan;
        return view('laporan.tampil',[
        'title'=>'Preview',
        'data'=>$sales??'',
        'keterangan'=>$ktr ?? ''
    ]);
}else{
    return redirect()->back()->with('error','Transaksi Belum Ada');
}
}


public function exportExcel(Request $request){
    
    $bulan = $request->input('keterangan');
    $transaksi=transaksi::where('keterangan',$bulan)->get();
if(!$transaksi->isEmpty()){

    return Excel::download(new TrainingExport($bulan), 'laporan_penjualan.xlsx');
}else{
    return redirect()->back()->with('error','Data Belum Ada');
}

}





}
