<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SertifikasiController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\MasterController;
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

    // Laboratorium Log Routes
    Route::get('/log', [LabController::class, 'logIndex'])->name('log.index');
    Route::get('/log/grid', [LabController::class, 'logGrid'])->name('log.grid');
    Route::get('/log/download-excel', [LabController::class, 'logDownloadExcel'])->name('log.download_excel');
    Route::post('/log/export-excel', [LabController::class, 'logExportExcel'])->name('log.export_excel');
    Route::post('/log/delete', [LabController::class, 'logDestroy'])->name('log.delete');
});

// Master Data Routes
Route::prefix('admin/master')->name('master.')->group(function () {
    // Komoditas (Master Golongan) Routes
    Route::get('/komoditas', [MasterController::class, 'komoditasIndex'])->name('komoditas.index');
    Route::get('/komoditas/grid', [MasterController::class, 'komoditasGrid'])->name('komoditas.grid');
    Route::get('/komoditas/create', [MasterController::class, 'komoditasCreate'])->name('komoditas.create');
    Route::post('/komoditas/store', [MasterController::class, 'komoditasStore'])->name('komoditas.store');
    Route::get('/komoditas/edit/{id}', [MasterController::class, 'komoditasEdit'])->name('komoditas.edit');
    Route::post('/komoditas/update/{id}', [MasterController::class, 'komoditasUpdate'])->name('komoditas.update');
    Route::post('/komoditas/delete', [MasterController::class, 'komoditasDestroy'])->name('komoditas.delete');
    Route::get('/komoditas/delete/{id}', [MasterController::class, 'komoditasDelete'])->name('komoditas.delete.single');

    // Kumpulan (Master Kumpulan) Routes
    Route::get('/kumpulan', [MasterController::class, 'kumpulanIndex'])->name('kumpulan.index');
    Route::get('/kumpulan/grid', [MasterController::class, 'kumpulanGrid'])->name('kumpulan.grid');
    Route::get('/kumpulan/create', [MasterController::class, 'kumpulanCreate'])->name('kumpulan.create');
    Route::post('/kumpulan/store', [MasterController::class, 'kumpulanStore'])->name('kumpulan.store');
    Route::get('/kumpulan/edit/{id}', [MasterController::class, 'kumpulanEdit'])->name('kumpulan.edit');
    Route::post('/kumpulan/update/{id}', [MasterController::class, 'kumpulanUpdate'])->name('kumpulan.update');
    Route::post('/kumpulan/delete', [MasterController::class, 'kumpulanDestroy'])->name('kumpulan.delete');
    Route::get('/kumpulan/delete/{id}', [MasterController::class, 'kumpulanDelete'])->name('kumpulan.delete.single');

    // Jenis Tanaman (Master Jenis Tanaman) Routes
    Route::get('/jenis-tanaman', [MasterController::class, 'jenisTanamanIndex'])->name('jenis-tanaman.index');
    Route::get('/jenis-tanaman/grid', [MasterController::class, 'jenisTanamanGrid'])->name('jenis-tanaman.grid');
    Route::get('/jenis-tanaman/create', [MasterController::class, 'jenisTanamanCreate'])->name('jenis-tanaman.create');
    Route::post('/jenis-tanaman/store', [MasterController::class, 'jenisTanamanStore'])->name('jenis-tanaman.store');
    Route::get('/jenis-tanaman/edit/{id}', [MasterController::class, 'jenisTanamanEdit'])->name('jenis-tanaman.edit');
    Route::post('/jenis-tanaman/update/{id}', [MasterController::class, 'jenisTanamanUpdate'])->name('jenis-tanaman.update');
    Route::post('/jenis-tanaman/delete', [MasterController::class, 'jenisTanamanDestroy'])->name('jenis-tanaman.delete');
    Route::get('/jenis-tanaman/delete/{id}', [MasterController::class, 'jenisTanamanDelete'])->name('jenis-tanaman.delete.single');
});
