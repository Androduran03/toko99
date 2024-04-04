<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\transaksi;
use App\Models\produk;
use App\Models\produksementara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('transaksi.index',[
        //     'title'=>'Data Transaksi',
        //     'produks'=>produk::all(),
        //     'transaksis'=>transaksi::all()

        // ]);
        return view('transaksi.test',[
            'title'=>'Data Transaksi',
            'produks'=>produk::all(),
            'transaksis'=>transaksi::all(),
            'produksementaras'=>produksementara::all()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
if($request->total_harga > $request->jml_bayar){
return back()->with('kurang','Nominal Yang Anda masukan kurang');
}else{



        $produksementara=produksementara::all();
       
    
    //   $produks=produk::all();
      $carbon=Carbon::now();
      $waktusekarang=$carbon->format('Y-m');  
$totalharga=0;
foreach ($produksementara as $ps) {
    
        
        transaksi::create([
            'user_id' => Auth::user()->id,
            'produk_id' => $ps->produk_id,
            'keterangan' => $waktusekarang,
            'nama_produk' => $ps->nama_produk,
            'harga' => number_format($ps->harga),
            'jml_beli' => $ps->jml_beli,
            'jml_harga' => number_format($ps->jml_harga),
            'jml_bayar' => $request->jml_bayar,
            'kembalian' => $request->kembalian,
            // ... sesuaikan dengan kolom-kolom yang ada di tabel tujuan
        ]);
        
        
        // dd('sukses');
        
        
        // dd($ps->produk_id);
        $stok = produk::select('jml_stok')->where('id', $ps->produk_id)->first();
        
        $beli = $ps->jml_beli;
        
        $jml_stok = $stok->jml_stok;
        $sisastok=$jml_stok-$beli;
        // dd($sisastok);
        
        
        produk::where('id',$ps->produk_id)->update([
            'jml_stok'=>$sisastok
        ]);
    }
    produksementara::truncate();
     Alert::success(session('success','Data Berhasil Di Simpan'));        
        return redirect('/transaksi');
    }
    }
    
    public function show(transaksi $transaksi)
    {
        //
    }

    public function edit($id)
    {
        return view('transaksi.edit',[
            'title'=>'Edit Transaksi',
            'transaksis'=>transaksi::all(),
            'produks'=>produk::all(),
            // 'produks'=>produk::all(),
            'transaksi'=>transaksi::where('id',$id)->first()
    
        ]);
    }

    public function update(Request $request,$id)
    {
        $produks=produk::all();
        $transaksi=transaksi::where('id',$id)->first();
        $rules=[
'nama_produk'=>'required',
'harga'=>'required',
'jml_beli'=>'required',
'jml_harga'=>'required',
'jml_bayar'=>'required',
'kembalian'=>'required',
];
        
    $validatedata=$request->validate($rules);
    $validatedata['produk_id']=$request->nama_produk;
    

foreach($produks as $produk){

    if($produk->id==$validatedata['nama_produk']){
        $validatedata['nama_produk']=$produk->nama_produk;
        transaksi::where('id',$transaksi->id)->update($validatedata);
    
    }
    }
        Alert::success(session('success','Data Berhasil Di Edit'));
        return redirect('/transaksi');
    }

    public function transaksisementara(Request $request)
    {
        $produks=produk::all();
     
        $rules=[
'nama_produk'=>'required',
'harga'=>'required',
'jml_beli'=>'required',
'jml_harga'=>'required',

];
$validatedata=$request->validate($rules);
$validatedata['produk_id']=$request->nama_produk;

foreach($produks as $produk){

    if($produk->id==$validatedata['nama_produk']){
        // dd($produk->nama_produk);
        // dd($validatedata['nama_produk']);
        $validatedata['nama_produk']=$produk->nama_produk;
       
        // transaksi::create($validatedata);
        produksementara::create($validatedata);
    }
 }

        return redirect('/transaksi');

    }
    public function hapustransaksisementara($id)
    {
        $data=produksementara::where('id',$id)->first();
        $data->delete();
       
        return back();
    }
    public function destroy($id)
    {
        $data=transaksi::where('id',$id)->first();
       $data->delete();
        Alert::success(session('success','Data Berhasil Di Hapus'));
        return redirect('/transaksi');
    }


    public function laporan()
    {
        return view('laporan.index',[
            'title'=>'Laporan',
            'produks'=>produk::all(),
            'transaksis'=>transaksi::all()
        ]);
    }
}
