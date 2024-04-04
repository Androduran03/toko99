<?php

namespace App\Http\Controllers;
use App\Imports\PrediksiImport;
use App\Models\prediksi;
use Illuminate\Http\Request;
use App\Models\persamaanregresi;
use App\Models\datatraining;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class PrediksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persamaanregresis=persamaanregresi::count();
     if($persamaanregresis > 0){

         return view('prediksi.index',[
             'title'=>'Proses Prediksi',
             'persamaanregrsis'=>persamaanregresi::all(),
             'prediksis'=>prediksi::all()
            ]);
        }else{
            Alert::error(session('error','Persamaan Regresi Belum Ada '));
            return redirect('/training');
        }
    }

  
    public function create()
    {
        
    }

//IMPORT EXCEl


    public function simpan(Request $request)
    {
        try {
            $this->validate($request, [
                'testing' => 'required|mimes:csv,xls,xlsx'
            ]);
            prediksi::truncate();
            $data=$request->file('testing');
           
           $namafile=$data->getClientOriginalName();
           
            $data->move('EmployeeData',$namafile);
           
            Excel::import(new PrediksiImport,\public_path('/EmployeeData/'.$namafile));
           
           Alert::success(session('success','Data Berhasil Di Simpan'));
           return redirect('/prediksi'); 

        } catch (\Exception $e) {
            
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor data. Silakan coba lagi.');
        };
        
 
    }
    //IMPORT SATU SATU
    public function store(Request $request)
    {
        
        $rules=[
            'bulan'=>'required',
            'keterangan'=>'required|unique:prediksis'
        ];
        
        // $validatedata=$request->validate($rules);
        // produk::create($validatedata);
$validatedata=$request->validate($rules);

// $validatedata['keterangan']=date('F-Y',strtotime($request->keterangan));
$validatedata['jml_penjualan']=0;
       prediksi::create($validatedata);
       Alert::success(session('success','Data Berhasil Di Simpan'));
       return redirect('/prediksi');
    }
   
     
    public function prediksi()
    {
        
        $persamaanregresis=persamaanregresi::all();
        $prediksis=prediksi::all();
        $hasil=prediksi::where('jml_penjualan','=',0)->get();
        $y=0;
    
        foreach($persamaanregresis as $persamaanregresi){
            $a=$persamaanregresi->a;
            $b=$persamaanregresi->b;

$updates = [];

foreach ($prediksis as $prediksi) {
    $x = $prediksi->bulan;
    $y = $a + $b * $prediksi->bulan;
    
    // Tambahkan data update ke dalam array
    $updates[] = [
        'id' => $prediksi->id,
        'keterangan' =>$prediksi->keterangan,
        'bulan' => $x,
        'jml_penjualan' => round($y),
    ];
}

// Lakukan update sekaligus pada semua baris yang sesuai dengan kondisi
prediksi::upsert($updates, ['id'], ['keterangan','bulan', 'jml_penjualan']);

return redirect('/prediksi');
        }
    }

   
    public function show(prediksi $prediksi)
    {
        //
    }

    public function edit($id)
    {
       $prediksi=prediksi::where('id',$id)->first();
        return view('prediksi.edit',[
'title'=>'Edit Data Testing',
'prediksi'=>$prediksi
        ]);

       
    }

    
    public function update(Request $request,$id)
    {
        $request->validate([

            'keterangan' => [
                'required',
                Rule::unique('prediksis')->ignore($id),
                // tambahkan aturan validasi lainnya jika diperlukan
            ],
            
        ]);
    
        // Proses pembaruan data setelah validasi sukses
        $data = prediksi::find($id);
        $data->keterangan = $request->keterangan;
        // tambahkan pembaruan untuk kolom-kolom lainnya
        $data->save();
    
        Alert::success(session('success','Data Berhasil Di Edit'));
        return redirect('/prediksi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\prediksi  $prediksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prediksi=prediksi::where('id',$id)->first();
        $prediksi->delete();
        Alert::success(session('success','Data Berhasil Hapus'));
        return redirect('/prediksi');
    }
    public function grafik()
    {

        $a=34.49945;
        $b=34.49945;
        $prdk=prediksi::where('jml_penjualan','>',0)->get();
        if(!$prdk->isEmpty()){
   
    $trainingData =datatraining::
    where('keterangan','>=','2023-01') // Misalnya, mulai dari bulan 24 hingga 35 untuk satu tahun terakhir
    ->select('keterangan', 'jml_penjualan', DB::raw("'Training' as sumber")) // Tambahkan sumber untuk tabel pertama
    ->get();

// Ambil data dari tabel kedua (misalnya, tabel 'prediksi')
$predictionData = prediksi::
    select('keterangan', 'jml_penjualan', DB::raw("'Prediksi' as sumber")) // Tambahkan sumber untuk tabel kedua
    ->get();
 $combinedData = $trainingData->concat($predictionData);
 $lastData = prediksi::orderBy('keterangan', 'desc')->first();
 $firstData = prediksi::orderBy('keterangan', 'asc')->first();

        return view('grafik.index',[
            'title'=>'Grafik',
            'persamaanregrsis'=>persamaanregresi::all(),
            'prediksis'=>prediksi::all(),
            'combinedData'=>$combinedData,
            'dataawal'=>$firstData->keterangan ? $firstData->keterangan:'',
            'dataakir'=>$lastData->keterangan ? $lastData->keterangan:'',
           ]);
    }
    Alert::error(session('error','Prediksi Belum Ada '));
    return back();
            // return redirect('/training');
}
}
