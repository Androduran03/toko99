<?php

namespace App\Http\Controllers;

use App\Models\home;
use App\Models\produk;
use App\Models\prediksi;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=produk::query()->count();
        if($data==0){
$data=0;
        }
        $mostPurchasedProduct = DB::table('transaksis')
        ->select('nama_produk', DB::raw('SUM(jml_beli) as total_beli'))
        ->groupBy('nama_produk')
        ->orderByDesc('total_beli')
        ->first();
    // dd($mostPurchasedProduct);
      
    return view('home.index',[
        'title'=>'Home',
        'produks'=>$data,
        'produkterlaris'=>$mostPurchasedProduct ?$mostPurchasedProduct : 0,
        'transaksis'=>transaksi::all(),
        'prediksis'=>prediksi::all()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\home  $home
     * @return \Illuminate\Http\Response
     */
    public function show(home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\home  $home
     * @return \Illuminate\Http\Response
     */
    public function edit(home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\home  $home
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\home  $home
     * @return \Illuminate\Http\Response
     */
    public function destroy(home $home)
    {
        //
    }
}
