<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DatatrainingController;
use App\Http\Controllers\RegresilinierController;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PresentaseController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ImportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/home',HomeController::class)->middleware('auth');
Route::resource('/training',DatatrainingController::class)->middleware('admin');
Route::resource('/prediksi',PrediksiController::class)->middleware('admin');

Route::resource('/transaksi',TransaksiController::class);

Route::post('/transaksisementara',[TransaksiController::class, 'transaksisementara'])->middleware('admin');
Route::delete('/transaksisementara/{id}',[TransaksiController::class, 'hapustransaksisementara']);



Route::resource('/produk',ProdukController::class)->middleware('admin');
// Route::resource('/user',UserController::class);
Route::resource('/user',UserController::class)->middleware('admin');
Route::get('/',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout']);
Route::get('/get-product-price/{id}', [ProdukController::class, 'getPrice']);

// routes/web.php atau routes/api.php



// Route::resource('/dashboard',DashboardProdukController::class)->middleware('auth');
Route::get('/regresilinier',[RegresilinierController::class,'simpan'])->middleware('admin');
Route::post('/testing',[PrediksiController::class,'simpan']);
Route::get('/prosesprediksi',[PrediksiController::class,'prediksi'])->middleware('admin');
Route::get('/grafik',[PrediksiController::class,'grafik'])->middleware('admin');
Route::post('/importcontroller',[DatatrainingController::class,'import']);

// Laporan
Route::get('/laporan', [SalesController::class, 'index']);
Route::post('/laporan', [SalesController::class, 'generateReport'])->name('generate-report');
Route::post('/export-excel', [SalesController::class,'exportExcel']);

// presentase error
Route::resource('/presentase',PresentaseController::class)->middleware('admin');
Route::get('/prosespresentase',[PresentaseController::class,'simpan'])->middleware('admin');

//truncate
Route::get('/truncate',[DatatrainingController::class,'truncate'])->middleware('admin');
