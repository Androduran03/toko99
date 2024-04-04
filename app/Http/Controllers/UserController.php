<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use App\Models\produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index',[
            'title'=>'Data user',
            'users'=>User::all()
            

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
'nama'=>'required',
'email'=>'required|unique:users|email',
'password'=>'required',
'hp'=>'required',
'alamat'=>'required',
'status'=>'required',
];
$validatedata=$request->validate($rules);
$validatedata['password']=bcrypt($validatedata['password']);
        user::create($validatedata);
        Alert::success(session('success','Data Berhasil Di Simpan'));
        return redirect('/user');
    }

   
    public function show(transaksi $transaksi)
    {
        //
    }

   
    public function edit($id)
    {
        return view('user.edit',[
            'title'=>'Edit User',
            'user'=>User::where('id',$id)->first()
    
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      
        $users=User::all();
        $user=User::where('id',$id)->first();
        $rules=[
'nama'=>'required',
'email' => [
    'required',
    'email',
    Rule::unique('users')->ignore($user->id), // Menyertakan ID saat ini untuk mengabaikan dirinya sendiri
],
'password'=>'required',
'hp'=>'required',
'alamat'=>'required',
'status'=>'required'
];

$validatedata=$request->validate($rules);
$validatedata['password']=bcrypt($validatedata['password']);
user::where('id',$user->id)->update($validatedata);
        Alert::success(session('success','Data Berhasil Di Edit'));
        return redirect('/user');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=user::where('id',$id)->first();

       $data->delete();
        Alert::success(session('success','Data Berhasil Di Hapus'));
        return redirect('/user');
    }
}
