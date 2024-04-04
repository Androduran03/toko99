<?php

namespace App\Http\Controllers;

use App\Models\regresilinier;
use App\Models\persamaanregresi;
use App\Models\Datatraining;
use App\Models\total;
use Illuminate\Http\Request;


class RegresilinierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('training.index',[
            'title'=>'Input Data Training',
            'trainings'=>Datatraining::all()
        ]);
    }

    
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        
    }

    
    public function show(regresilinier $regresilinier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\regresilinier  $regresilinier
     * @return \Illuminate\Http\Response
     */
    public function edit(regresilinier $regresilinier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\regresilinier  $regresilinier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, regresilinier $regresilinier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\regresilinier  $regresilinier
     * @return \Illuminate\Http\Response
     */
    public function destroy(regresilinier $regresilinier)
    {
        //
    }
    public function simpan()
    {
        $datatrainings=Datatraining::all();
       
        regresilinier::truncate();
        foreach($datatrainings as $datatraining){
            regresilinier::create([
'X'=>$datatraining->bulan,
'Y'=>$datatraining->jml_penjualan,
'Xpangkat2'=>pow($datatraining->bulan,2),
'Ypangkat2'=>pow($datatraining->jml_penjualan,2),
'XY'=>$datatraining->bulan*$datatraining->jml_penjualan,
            ]);
        }
        $banyaktraining=datatraining::count();
        if($banyaktraining>0){
        persamaanregresi::truncate();
        $persamaanregresi=new persamaanregresi;
$sigmaX = regresilinier::sum('X');
$sigmaY = regresilinier::sum('Y');
$sigmaXpangkat2 = regresilinier::sum('Xpangkat2');
$sigmaYpangkat2 = regresilinier::sum('Ypangkat2');
$sigmaXY = regresilinier::sum('XY');
$penyebutA=(($sigmaY*$sigmaXpangkat2)-($sigmaX*$sigmaXY));
$penyebutB=(($banyaktraining*$sigmaXY)-($sigmaX*$sigmaY));
if($penyebutA||$penyebutB !=0){
    $a=(($sigmaY*$sigmaXpangkat2)-($sigmaX*$sigmaXY))/(($banyaktraining*$sigmaXpangkat2)-(pow($sigmaX,2)));
    $b=(($banyaktraining*$sigmaXY)-($sigmaX*$sigmaY))/(($banyaktraining*$sigmaXpangkat2)-(pow($sigmaX,2)));
}else{
    return redirect()->back()->with('error','Pembagian oleh nol tidak diizinkan');
}


$persamaanregresi->a=$a;
$persamaanregresi->b=$b;
$persamaanregresi->save();



        return redirect('/training');

    }else{
        return redirect()->back()->with('error', 'Data Tidak Bole Kosong');
    }
        
    

    }
}
