<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SertifikasiController;
use App\Http\Controllers\LabController;
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

    // Pasca Lapangan Routes
    Route::get('/pasca_lapangan', [SertifikasiController::class, 'pascaLapangan'])->name('pasca_lapangan.index');
    Route::get('/pasca_lapangan/tambah', [SertifikasiController::class, 'pascaTambah'])->name('pasca_lapangan.tambah');
    Route::get('/pasca_lapangan/lihat/{id}', [SertifikasiController::class, 'pascaLihat'])->name('pasca_lapangan.lihat');
    Route::get('/pasca_lapangan/pengolahan/{id}', [SertifikasiController::class, 'pascaPengolahan'])->name('pasca_lapangan.pengolahan');
    Route::post('/pasca_lapangan/update', [SertifikasiController::class, 'pascaUpdate'])->name('pasca_lapangan.update');
    Route::post('/pasca_lapangan/hapus', [SertifikasiController::class, 'pascaHapus'])->name('pasca_lapangan.hapus');
    Route::get('/pasca_lapangan/export_excel', [SertifikasiController::class, 'pascaExportExcel'])->name('pasca_lapangan.export_excel');
    Route::get('/pasca_lapangan/cetak/{jenis}/{id}', [SertifikasiController::class, 'pascaCetak'])->name('pasca_lapangan.cetak');

    // Konsep Label Routes
    Route::get('/label', [SertifikasiController::class, 'konsepLabel'])->name('konsep_label.index');
    Route::get('/label/permohonan', [SertifikasiController::class, 'permohonanKonsepLabel'])->name('konsep_label.permohonan');
    Route::get('/label/input/{id}', [SertifikasiController::class, 'konsepLabelInput'])->name('konsep_label.input');
    Route::post('/label/insert/{id}', [SertifikasiController::class, 'konsepLabelInsert'])->name('konsep_label.insert');
    Route::get('/label/ubah/{id}/{a}/{b}/{mode}', [SertifikasiController::class, 'konsepLabelUbah'])->name('konsep_label.ubah');
    Route::post('/label/update/{id}/{a}', [SertifikasiController::class, 'konsepLabelUpdate'])->name('konsep_label.update');
    Route::post('/label/delete', [SertifikasiController::class, 'konsepLabelDelete'])->name('konsep_label.delete');
    Route::get('/label/grid', [SertifikasiController::class, 'gridKonsepLabel'])->name('konsep_label.grid');
    Route::get('/label/grid_permohonan', [SertifikasiController::class, 'gridPermohonanKonsepLabel'])->name('konsep_label.grid_permohonan');

    // Konsep Label Standart Routes
    Route::get('/label_standart', [SertifikasiController::class, 'konsepLabelStandart'])->name('konsep_label_standart.index');
    Route::get('/label_standart/permohonan', [SertifikasiController::class, 'permohonanKonsepLabelStandart'])->name('konsep_label_standart.permohonan');
    Route::get('/label_standart/input/{id}', [SertifikasiController::class, 'konsepLabelStandartInput'])->name('konsep_label_standart.input');
    Route::post('/label_standart/insert/{id}', [SertifikasiController::class, 'konsepLabelStandartInsert'])->name('konsep_label_standart.insert');
    Route::get('/label_standart/ubah/{id}/{a}/{b}/{mode}', [SertifikasiController::class, 'konsepLabelStandartUbah'])->name('konsep_label_standart.ubah');
    Route::post('/label_standart/update/{id}/{a}', [SertifikasiController::class, 'konsepLabelStandartUpdate'])->name('konsep_label_standart.update');
    Route::post('/label_standart/delete', [SertifikasiController::class, 'konsepLabelStandartDelete'])->name('konsep_label_standart.delete');
    Route::get('/label_standart/grid', [SertifikasiController::class, 'gridKonsepLabelStandart'])->name('konsep_label_standart.grid');
    Route::get('/label_standart/grid_permohonan', [SertifikasiController::class, 'gridPermohonanKonsepLabelStandart'])->name('konsep_label_standart.grid_permohonan');
});

// Laboratorium Routes
Route::prefix('admin/lab')->name('lab.')->group(function () {
    Route::get('/uji', [LabController::class, 'index'])->name('uji_laboratorium.index');
    Route::get('/uji/tambah', [LabController::class, 'create'])->name('uji_laboratorium.create');
    Route::get('/uji/lihat/{id}/{a}/{b}/{mode}', [LabController::class, 'show'])->name('uji_laboratorium.show');
    Route::get('/uji/edit/{id}', [LabController::class, 'edit'])->name('uji_laboratorium.edit');
    Route::post('/uji/store', [LabController::class, 'store'])->name('uji_laboratorium.store');
    Route::post('/uji/update/{id}', [LabController::class, 'update'])->name('uji_laboratorium.update');
    Route::post('/uji/delete', [LabController::class, 'destroy'])->name('uji_laboratorium.delete');
    Route::get('/uji/cetak/{id}', [LabController::class, 'cetak'])->name('uji_laboratorium.cetak');
    Route::get('/buku-induk', [LabController::class, 'bukuInduk'])->name('buku_induk');
    Route::post('/buku-induk', [LabController::class, 'bukuIndukDownload'])->name('buku_induk.download');
});
