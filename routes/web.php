<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SertifikasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::post('/logout', function () {
    return redirect('/login')->with('success', 'Logout berhasil.');
})->name('logout');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Sertifikasi Routes
Route::prefix('admin/sertifikasi')->name('sertifikasi.')->group(function () {
    Route::get('/pengajuan', [SertifikasiController::class, 'pengajuan'])->name('pengajuan');
    Route::get('/pengajuan/tambah', [SertifikasiController::class, 'tambah'])->name('pengajuan.tambah');
    Route::get('/pengajuan/lihat/{id}', [SertifikasiController::class, 'lihat'])->name('pengajuan.lihat');
    Route::get('/pengajuan/edit/{id}', [SertifikasiController::class, 'edit'])->name('pengajuan.edit');
    Route::post('/pengajuan/update', [SertifikasiController::class, 'update'])->name('pengajuan.update');
    Route::post('/pengajuan/hapus', [SertifikasiController::class, 'hapus'])->name('pengajuan.hapus');
    Route::get('/pengajuan/cetak', [SertifikasiController::class, 'cetak'])->name('pengajuan.cetak');
    Route::get('/pengajuan/get_laporan', [SertifikasiController::class, 'getLaporan'])->name('pengajuan.laporan');

    // Fase Pendahuluan Routes
    Route::get('/pengajuan/fase_pendahuluan/{id}', [SertifikasiController::class, 'fasePendahuluan'])->name('pengajuan.fase_pendahuluan');

    // Fase Vegetatif Routes
    Route::get('/pengajuan/fase_vegetatif/{id}', [SertifikasiController::class, 'faseVegetatif'])->name('pengajuan.fase_vegetatif');

    // Fase Berbunga Routes
    Route::get('/pengajuan/fase_berbunga/{id}', [SertifikasiController::class, 'faseBerbunga'])->name('pengajuan.fase_berbunga');

    // Fase Berbunga Ulangan Routes
    Route::get('/pengajuan/fase_berbunga_ulangan/{id}', [SertifikasiController::class, 'faseBerbungaUlangan'])->name('pengajuan.fase_berbunga_ulangan');

    // Fase Masak Routes
    Route::get('/pengajuan/fase_masak/{id}', [SertifikasiController::class, 'faseMasak'])->name('pengajuan.fase_masak');

    // Fase Panen Routes
    Route::get('/pengajuan/fase_panen/{id}', [SertifikasiController::class, 'fasePanen'])->name('pengajuan.fase_panen');

    // AJAX endpoint for getting produsen address
    Route::post('/pengajuan/dapatkan_alamat_produsen', [SertifikasiController::class, 'dapatkanAlamatProdusen'])->name('pengajuan.dapatkan_alamat');
});
