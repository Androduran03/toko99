<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\presentase;
use App\Models\hasilpresentase;
use App\Models\datatraining;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    return view('produk.index',[
        'title'=>'Data Produk',
        'produks'=>produk::all()

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
        $rules=[
            'nama_produk'=>'required|unique:produks',
            'harga'=>'required',
            'jml_stok'=>'required'
            
        ];
        $validatedata=$request->validate($rules);
                    produk::create($validatedata);
                    Alert::success(session('success','Tambah Produk Baru berhasil'));
                    return back();
    }

    public function show(produk $produk)
    {
        //
    }

    
    public function edit($id)
    {
        
        return view('produk.edit',[
            'title'=>'Edit Produk',
            'produks'=>produk::all(),
            'produk'=>produk::where('id',$id)->first()
    
        ]);
    }

  
    public function update(Request $request,$id)
    {
    $produk=produk::where('id',$id)->first();
    $rules=[
        'nama_produk'=>'required',
        'harga'=>'required',
        'jml_stok'=>'required'
    ];
    $validatedata=$request->validate($rules);
    produk::where('id',$produk->id)->update($validatedata);
    Alert::success(session('success','Edit Data Berhasil'));
    return redirect('/produk');
    }

    
    public function destroy($id)
    {

        $produk=produk::where('id',$id)->first();
        $datatraining=datatraining::where('id',$id)->first();
     
        $produk->delete();
        if($produk->id=$datatraining->produk_id){
datatraining::truncate();
presentase::truncate();
hasilpresentase::truncate();
        }
                    
        Alert::success(session('success','Hapus Produk Berhasil'));
                    return redirect('/produk');
    }
    public function getPrice($id)
    {
        // $product = produk::findOrFail($id);

        // return response()->json([
        //     'harga' => $product->harga,
        //     'ukuran' => $product->ukuran,
        // ]);
        // return $product?$product->harga:0;



        $product=produk::find($id);
        return response()->json([
            'harga' => $product->harga,
           
        ]);
    }
}
