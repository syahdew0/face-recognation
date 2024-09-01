<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PengajuanizinController;
use App\Http\Controllers\RekapabsensiController;
use App\Http\Controllers\FlaskTestController;
use Illuminate\Support\Facades\Route;

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

// Login Page
Route::get('/', [AutentikasiController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [AutentikasiController::class, 'login']);
Route::post('/logout', [AutentikasiController::class, 'logout'])->name('logout');

// Dashboard Page
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Data Divisi Page
Route::get('/datadivisi', [DivisiController::class, 'index'])->middleware('auth')->name('datadivisi');
Route::get('/datadivisi/tambah', [DivisiController::class, 'tambahPage'])->middleware('auth');
Route::post('/datadivisi/tambahdivisi', [DivisiController::class, 'tambahDivisi']);
Route::post('/datadivisi/hapus', [DivisiController::class, 'hapusDivisi']);

// Data Karyawan Page
Route::get('/datakaryawan', [KaryawanController::class, 'index'])->middleware('auth')->name('datakaryawan');
Route::get('/datakaryawan/tambah', [KaryawanController::class, 'tambahPage'])->middleware('auth');
Route::post('/datakaryawan/tambahkaryawan', [KaryawanController::class, 'tambahKaryawan']);
Route::post('/datakaryawan/hapus', [KaryawanController::class, 'hapusKaryawan']);
Route::get('/datakaryawan/edit', [KaryawanController::class, 'editPage'])->middleware('auth');
Route::post('/datakaryawan/editkaryawan', [KaryawanController::class, 'editKaryawan']);
Route::get('/datakaryawan/cari', [KaryawanController::class, 'cariKaryawan'])->middleware('auth');
Route::get('/api/get-karyawan/{id}', [KaryawanController::class, 'getKaryawan']);

// Pengajuan Izin Page
Route::get('/pengajuanizin', [PengajuanizinController::class, 'index'])->middleware('auth')->name('pengajuanizin');
Route::get('/pengajuanizin/tambah', [PengajuanizinController::class, 'tambahPage'])->middleware('auth');
Route::post('/pengajuanizin/ajukan', [PengajuanizinController::class, 'ajukanIzin']);

// Monitoring Absensi Page
Route::get('/monitoringabsensi', [AbsensiController::class, 'monitoringPage'])->middleware('auth')->name('monitoringabsensi');
Route::get('/monitoringabsensi/cari', [AbsensiController::class, 'cariAbsensi'])->middleware('auth');

// Rekap Absensi Page
Route::get('/rekapabsensi', [RekapabsensiController::class, 'index'])->middleware('auth')->name('rekapabsensi');
Route::post('/rekapabsensi/cetak', [RekapabsensiController::class, 'cetak']);

// Home Page
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

// Absensi Page
Route::get('/absensi', [AbsensiController::class, 'index'])->middleware('auth')->name('absensi');
Route::post('/absensi/lakukan', [AbsensiController::class, 'store']);

// Flask Test Page
Route::get('/flask-test', [FlaskTestController::class, 'accessTestEndpoint'])->middleware('auth');
Route::get('/upload-image', [FlaskTestController::class, 'uploadImage'])->middleware('auth')->name('upload.image');

// Test Dashboard
Route::match(['get', 'post'], '/test', [FlaskTestController::class, 'showDashboard'])->middleware('auth')->name('test');

// Ajukanizin Page
Route::get('/pengajuanizin/tambah', [PengajuanizinController::class, 'tambahPage'])->middleware('auth');
Route::post('/pengajuanizin/ajukan', [PengajuanizinController::class, 'ajukanIzin']);
