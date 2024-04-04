<?php

namespace App\Http\Controllers;

use App\Models\presentase;
use App\Models\hasilpresentase;
use App\Models\persamaanregresi;
use App\Models\datatraining;
use App\Models\produk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class PresentaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hitungregresi=persamaanregresi::count();
        $datatraining=datatraining::select('produk_id')->first();
        if($datatraining!=null){
            $namaproduk=$datatraining->produk->nama_produk??'';
        }
        

        if($hitungregresi > 0){
        return view('presentase.index',[
            'title'=>'Perhitungan Akurasi',
            'presentases'=>presentase::all(),
            'hasilpresentases'=>hasilpresentase::all(),
            'namaproduk'=>$namaproduk??''
    
        ]);
    }
    Alert::error(session('error','Persamaan Regresi Belum Ada'));
    return back();
    }

    public function simpan()
    {
        $persamaanregresis=persamaanregresi::all();
        $presentases=presentase::all();
        hasilpresentase::truncate();
      
        // $hasil=prediksi::where('nilaiY','=',0)->get();
        $y=0;
    
        foreach($persamaanregresis as $persamaanregresi){
            $a=$persamaanregresi->a;
            $b=$persamaanregresi->b;

$updates = [];
foreach ($presentases as $presentase) {
    $x = $presentase->X;
    $y = $presentase->Y;
    $prediksi = $a + $b * $presentase->X;
    $mad =abs($y-$prediksi);
    $mse = pow($y-$prediksi,2);
    $mape = (abs($y-$prediksi)/$y);
    
    // Tambahkan data update ke dalam array
    $updates[] = [
        'id' => $presentase->id,
        'keterangan' =>$presentase->keterangan,
        'X' => $x,
        'Y' => $y,
        'prediksi' => $prediksi,
        'MAD' => $mad,
        'MSE' => $mse,
        'MAPE' => $mape,
    ];
}

// Lakukan update sekaligus pada semua baris yang sesuai dengan kondisi
presentase::upsert($updates, ['id'], ['keterangan','X', 'Y','prediksi','MAD','MSE','MAPE']);
}
$rataMad=presentase::avg('MAD');
$rataMse=presentase::avg('MSE');
$rataMape=presentase::avg('MAPE');

$hasilpresentase=new hasilpresentase;
$hasilpresentase->hasilMAD=$rataMad;
$hasilpresentase->hasilMSE=$rataMse;
$hasilpresentase->hasilMAPE=$rataMape;
$hasilpresentase->save();
return redirect('/presentase');
    }
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\presentase  $presentase
     * @return \Illuminate\Http\Response
     */
    public function show(presentase $presentase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\presentase  $presentase
     * @return \Illuminate\Http\Response
     */
    public function edit(presentase $presentase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\presentase  $presentase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, presentase $presentase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\presentase  $presentase
     * @return \Illuminate\Http\Response
     */
    public function destroy(presentase $presentase)
    {
        //
    }
}
