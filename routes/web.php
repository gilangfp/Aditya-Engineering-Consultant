<?php

use App\Models\LaporanKegiatan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\JenisKegiatanController;
use App\Http\Controllers\LaporanKegiatanController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', [DashboardController::class,'dashboard']);

Route::middleware(['auth'])->group(function () {
//dashboard
//laporan-kegiatan
Route::get('/laporankegiatan', [LaporanKegiatanController::class,'index']);
Route::get('/laporankegiatan/tambahlaporankegiatan', [LaporanKegiatanController::class,'tambahlaporankegiatan']);
Route::post('/laporankegiatan/store', [LaporanKegiatanController::class,'store']);
Route::get('/laporankegiatan/{id}/ubah', [LaporanKegiatanController::class,'ubah']);
Route::put('/laporankegiatan/{id}', [LaporanKegiatanController::class,'update']);
Route::delete('/laporankegiatan/{id}', [LaporanKegiatanController::class,'destroy']);
Route::get('/laporankegiatan/export', [LaporanKegiatanController::class,'export']);
Route::get('laporankegiatan/approve/{id}',[LaporanKegiatanController::class,'approve']);
Route::get('/laporankegiatan/view/{id}',[LaporanKegiatanController::class,'view']);
//departemen
Route::get('/departemen', [DepartemenController::class,'index']);
Route::get('/departemen/tambahdepartemen', [DepartemenController::class,'tambahdepartemen']);
Route::post('/departemen/store', [DepartemenController::class,'store']);
Route::get('/departemen/{id}/ubah', [DepartemenController::class,'ubah']);
Route::put('/departemen/{id}', [DepartemenController::class,'update']);
Route::delete('/departemen/{id}', [DepartemenController::class,'destroy']);
Route::get('/laporankegiatan/export', [LaporanKegiatanController::class,'export']);
Route::get('laporankegiatan/approve/{id}',[LaporanKegiatanController::class,'approve']);
Route::get('laporankegiatan/rejected/{id}',[LaporanKegiatanController::class,'rejected']);
Route::get('/laporankegiatan/view/{id}',[LaporanKegiatanController::class,'view']);

//sub
Route::get('/sub', [SubController::class,'index']);
Route::get('/sub/tambahsub', [SubController::class,'tambahsub']);
Route::post('/sub/store', [SubController::class,'store']);
Route::get('/sub/{id_sub}/ubah', [SubController::class,'ubah']);
Route::put('/sub/{id_sub}', [SubController::class,'update']);
Route::delete('/sub/{id_sub}', [SubController::class,'destroy']);
Route::get('/laporankegiatan/export', [LaporanKegiatanController::class,'export']);
Route::get('laporankegiatan/approve/{id}',[LaporanKegiatanController::class,'approve']);
Route::get('/laporankegiatan/view/{id}',[LaporanKegiatanController::class,'view']);

//jenis
Route::get('/jenis', [JenisKegiatanController::class,'index']);
Route::get('/jenis/tambahjenis', [JenisKegiatanController::class,'tambahjenis']);
Route::post('/jenis/store', [JenisKegiatanController::class,'store']);
Route::get('/jenis/{id_jenis}/ubah', [JenisKegiatanController::class,'ubah']);
Route::put('/jenis/{id_jenis}', [JenisKegiatanController::class,'update']);
Route::delete('/jenis/{id_jenis}', [JenisKegiatanController::class,'destroy']);
Route::get('/jenis/export', [JenisKegiatanController::class,'export']);


//proyek
Route::get('/proyek', [ProyekController::class,'index']);
Route::get('/proyek/tambahproyek', [ProyekController::class,'tambahproyek']);
Route::post('/proyek/store', [ProyekController::class,'store']);
Route::get('/proyek/{id}/ubah', [ProyekController::class,'ubah']);
Route::put('/proyek/{id}', [ProyekController::class,'update']);
Route::delete('/proyek/{id}', [ProyekController::class,'destroy']);
//karyawan
Route::get('/karyawan', [KaryawanController::class,'index']);
Route::get('/karyawan/tambahkaryawan', [KaryawanController::class,'tambahkaryawan']);
Route::post('/karyawan/store', [KaryawanController::class,'store']);
Route::get('/karyawan/{id}/ubah', [KaryawanController::class,'ubah']);
Route::put('/karyawan/{id}', [KaryawanController::class,'update']);
Route::delete('/karyawan/{id}', [KaryawanController::class,'destroy']);

Route::post('/get-proyek', [ProyekController::class, 'get_proyek']);
Route::post('/get-sub', [JenisKegiatanController::class, 'get_sub']);
Route::post('/get-jenis-kegiatan', [JenisKegiatanController::class, 'get_jenis_kegiatan']);


});

