<?php

namespace App\Http\Controllers;
use App\Imports\TrainingImport;
use App\Imports\PresentaseImport;
use App\Models\Datatraining;
use App\Models\regresilinier;
use App\Models\persamaanregresi;
use App\Models\prediksi;
use App\Models\transaksi;
use App\Models\produk;
use App\Models\presentase;
use App\Models\hasilpresentase;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
class DatatrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=datatraining::select('produk_id')->first();
$namaproduk=$data->produk->nama_produk ?? '';

        return view('training.index',[
            'title'=>'Regresi Linier',
            'trainings'=>Datatraining::all(),
            'regresiliniers'=>regresilinier::all(),
            'persamaanregresi'=>persamaanregresi::all(),
            'produks'=>produk::all(),
            'nama_produk'=>$namaproduk ?? ''
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request){

try{

        $this->validate($request, [
			'training' => 'required|mimes:csv,xls,xlsx'
		]);
Datatraining::truncate();
regresilinier::truncate();
persamaanregresi::truncate();
prediksi::truncate();
presentase::truncate();
hasilpresentase::truncate();
 $data=$request->file('training');

$namafile=$data->getClientOriginalName();


 $data->move('EmployeeData',$namafile);


 Excel::import(new TrainingImport,\public_path('/EmployeeData/'.$namafile));
 Excel::import(new PresentaseImport,\public_path('/EmployeeData/'.$namafile));
//  Excel::import(new NaivebayesImport,\public_path('/EmployeeData/'.$namafile));
Alert::success(session('success','Data Berhasil Di Simpan'));
return redirect('/training');
}catch(\Exception $e){
return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor data. Silakan coba lagi.');
}
 
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
        $datatrainings=datatraining::where('produk_id',$request->idproduk)->get();
        if($datatrainings->isEmpty()){
           
            datatraining::truncate();
       

        }
            $datas=datatraining::where('produk_id',$request->idproduk)->where('keterangan',$request->keterangan)->get();
            if($datas->isEmpty()){
        $transaksis=transaksi::where('produk_id',$request->idproduk)->where('keterangan',$request->keterangan)->get();
        $jumlahstok=$transaksis->sum('jml_beli');
        $nomorUrutTerakhir = datatraining::max('bulan') ?? 0;
        if($jumlahstok > 0){
        $no = $nomorUrutTerakhir + 1;
      
$rules=[
'idproduk'=>'required',
'keterangan'=>'required|unique:datatrainings',

];
$validatedata=$request->validate($rules);
$validatedata['produk_id']=$request->idproduk;
$validatedata['keterangan']=$request->keterangan;
$validatedata['bulan']=$no;
$validatedata['jml_penjualan']=$jumlahstok;

datatraining::create($validatedata);

Alert::success(session('success','Data Berhasil Di Simpan'));
return redirect('/training');
        }else{
            return redirect()->back()->with('error', 'Jumlah Penjualan Belum Ada');
        }
            }else{
                return redirect()->back()->with('error', 'Data Sudah Ada');
    }
}
    public function show(Datatraining $datatraining)
    {
        




    }

   
    public function edit($id)
    {
        $training=datatraining::where('id',$id)->first();
      
        return view('training.edit',[
'title'=>'Edit Training',
'training'=>$training

        ]);
    }

    
    public function update(Request $request,$id)
    {
        $datatrainings=datatraining::where('id',$id)->first();
        $rules=[
            'bulan'=>'required',
            'jml_penjualan'=>'required',
            'keterangan'=>[
Rule::unique('datatrainings')->ignore($datatrainings->id)

                ]
            ];
            $validatedata=$request->validate($rules);
           
            datatraining::where('id',$datatrainings->id)->update($validatedata);
                    Alert::success(session('success','Data Berhasil Di Edit'));
                    return redirect('/training');
       
        }
    

    


    public function destroy($id)
    {
     
        $datatraining=datatraining::where('id',$id)->first();
        
        $datatraining->delete();  
        
        
        Alert::success(session('success','Hapus Data Training Berhasil'));
                    return redirect('/training'); 
    }
    public function truncate()
    {
        
        datatraining::truncate();
        persamaanregresi::truncate();
        prediksi::truncate();
        presentase::truncate();
        hasilpresentase::truncate();
        regresilinier::truncate();
     
        return redirect('training');
        Alert::success(session('error','Tabel Berhasil di Kosongakn'));
    }
}
