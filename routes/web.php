<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
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

Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

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
    Route::get('/uji/grid', [LabController::class, 'ujiGrid'])->name('uji_laboratorium.grid');
    Route::get('/uji/tambah', [LabController::class, 'create'])->name('uji_laboratorium.create');
    Route::get('/uji/lihat/{id}/{a}/{b}/{mode}', [LabController::class, 'show'])->name('uji_laboratorium.show');
    Route::get('/uji/edit/{id}', [LabController::class, 'edit'])->name('uji_laboratorium.edit');
    Route::post('/uji/store', [LabController::class, 'store'])->name('uji_laboratorium.store');
    Route::post('/uji/update/{id}', [LabController::class, 'update'])->name('uji_laboratorium.update');
    Route::post('/uji/delete', [LabController::class, 'destroy'])->name('uji_laboratorium.delete');
    Route::get('/uji/delete/{id}', [LabController::class, 'destroySingle'])->name('uji_laboratorium.delete.single');
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

    // Varietas (Master Varietas) Routes
    Route::get('/varietas', [MasterController::class, 'varietasIndex'])->name('varietas.index');
    Route::get('/varietas/grid', [MasterController::class, 'varietasGrid'])->name('varietas.grid');
    Route::get('/varietas/create', [MasterController::class, 'varietasCreate'])->name('varietas.create');
    Route::post('/varietas/store', [MasterController::class, 'varietasStore'])->name('varietas.store');
    Route::get('/varietas/edit/{id}', [MasterController::class, 'varietasEdit'])->name('varietas.edit');
    Route::post('/varietas/update/{id}', [MasterController::class, 'varietasUpdate'])->name('varietas.update');
    Route::post('/varietas/delete', [MasterController::class, 'varietasDestroy'])->name('varietas.delete');
    Route::get('/varietas/delete/{id}', [MasterController::class, 'varietasDelete'])->name('varietas.delete.single');

    // Gol Kelas Benih (Master Gol Kelas Benih) Routes
    Route::get('/gol-kelas-benih', [MasterController::class, 'golKelasBenihIndex'])->name('gol-kelas-benih.index');
    Route::get('/gol-kelas-benih/grid', [MasterController::class, 'golKelasBenihGrid'])->name('gol-kelas-benih.grid');
    Route::get('/gol-kelas-benih/create', [MasterController::class, 'golKelasBenihCreate'])->name('gol-kelas-benih.create');
    Route::post('/gol-kelas-benih/store', [MasterController::class, 'golKelasBenihStore'])->name('gol-kelas-benih.store');
    Route::get('/gol-kelas-benih/edit/{id}', [MasterController::class, 'golKelasBenihEdit'])->name('gol-kelas-benih.edit');
    Route::post('/gol-kelas-benih/update/{id}', [MasterController::class, 'golKelasBenihUpdate'])->name('gol-kelas-benih.update');
    Route::post('/gol-kelas-benih/delete', [MasterController::class, 'golKelasBenihDestroy'])->name('gol-kelas-benih.delete');
    Route::get('/gol-kelas-benih/delete/{id}', [MasterController::class, 'golKelasBenihDelete'])->name('gol-kelas-benih.delete.single');

    // Kelas Benih (Master Kelas Benih) Routes
    Route::get('/kelas-benih', [MasterController::class, 'kelasBenihIndex'])->name('kelas-benih.index');
    Route::get('/kelas-benih/grid', [MasterController::class, 'kelasBenihGrid'])->name('kelas-benih.grid');
    Route::get('/kelas-benih/create', [MasterController::class, 'kelasBenihCreate'])->name('kelas-benih.create');
    Route::post('/kelas-benih/store', [MasterController::class, 'kelasBenihStore'])->name('kelas-benih.store');
    Route::get('/kelas-benih/edit/{id}', [MasterController::class, 'kelasBenihEdit'])->name('kelas-benih.edit');
    Route::post('/kelas-benih/update/{id}', [MasterController::class, 'kelasBenihUpdate'])->name('kelas-benih.update');
    Route::post('/kelas-benih/delete', [MasterController::class, 'kelasBenihDestroy'])->name('kelas-benih.delete');
    Route::get('/kelas-benih/delete/{id}', [MasterController::class, 'kelasBenihDelete'])->name('kelas-benih.delete.single');

    // Penyakit (Master Penyakit) Routes
    Route::get('/penyakit', [MasterController::class, 'penyakitIndex'])->name('penyakit.index');
    Route::get('/penyakit/grid', [MasterController::class, 'penyakitGrid'])->name('penyakit.grid');
    Route::get('/penyakit/create', [MasterController::class, 'penyakitCreate'])->name('penyakit.create');
    Route::post('/penyakit/store', [MasterController::class, 'penyakitStore'])->name('penyakit.store');
    Route::get('/penyakit/edit/{id}', [MasterController::class, 'penyakitEdit'])->name('penyakit.edit');
    Route::post('/penyakit/update/{id}', [MasterController::class, 'penyakitUpdate'])->name('penyakit.update');
    Route::post('/penyakit/delete', [MasterController::class, 'penyakitDestroy'])->name('penyakit.delete');
    Route::get('/penyakit/delete/{id}', [MasterController::class, 'penyakitDelete'])->name('penyakit.delete.single');

    // Kabupaten (Master Kabupaten) Routes
    Route::get('/kabupaten', [MasterController::class, 'kabupatenIndex'])->name('kabupaten.index');
    Route::get('/kabupaten/grid', [MasterController::class, 'kabupatenGrid'])->name('kabupaten.grid');
    Route::get('/kabupaten/create', [MasterController::class, 'kabupatenCreate'])->name('kabupaten.create');
    Route::post('/kabupaten/store', [MasterController::class, 'kabupatenStore'])->name('kabupaten.store');
    Route::get('/kabupaten/edit/{id}', [MasterController::class, 'kabupatenEdit'])->name('kabupaten.edit');
    Route::post('/kabupaten/update/{id}', [MasterController::class, 'kabupatenUpdate'])->name('kabupaten.update');
    Route::post('/kabupaten/delete', [MasterController::class, 'kabupatenDestroy'])->name('kabupaten.delete');
    Route::get('/kabupaten/delete/{id}', [MasterController::class, 'kabupatenDelete'])->name('kabupaten.delete.single');

    // Kecamatan (Master Kecamatan) Routes
    Route::get('/kecamatan', [MasterController::class, 'kecamatanIndex'])->name('kecamatan.index');
    Route::get('/kecamatan/grid', [MasterController::class, 'kecamatanGrid'])->name('kecamatan.grid');
    Route::get('/kecamatan/create', [MasterController::class, 'kecamatanCreate'])->name('kecamatan.create');
    Route::post('/kecamatan/store', [MasterController::class, 'kecamatanStore'])->name('kecamatan.store');
    Route::get('/kecamatan/edit/{id}', [MasterController::class, 'kecamatanEdit'])->name('kecamatan.edit');
    Route::post('/kecamatan/update/{id}', [MasterController::class, 'kecamatanUpdate'])->name('kecamatan.update');
    Route::post('/kecamatan/delete', [MasterController::class, 'kecamatanDestroy'])->name('kecamatan.delete');
    Route::get('/kecamatan/delete/{id}', [MasterController::class, 'kecamatanDelete'])->name('kecamatan.delete.single');

    // Satuan (Master Satuan) Routes
    Route::get('/satuan', [MasterController::class, 'satuanIndex'])->name('satuan.index');
    Route::get('/satuan/grid', [MasterController::class, 'satuanGrid'])->name('satuan.grid');
    Route::get('/satuan/create', [MasterController::class, 'satuanCreate'])->name('satuan.create');
    Route::post('/satuan/store', [MasterController::class, 'satuanStore'])->name('satuan.store');
    Route::get('/satuan/edit/{id}', [MasterController::class, 'satuanEdit'])->name('satuan.edit');
    Route::post('/satuan/update/{id}', [MasterController::class, 'satuanUpdate'])->name('satuan.update');
    Route::post('/satuan/delete', [MasterController::class, 'satuanDestroy'])->name('satuan.delete');
    Route::get('/satuan/delete/{id}', [MasterController::class, 'satuanDelete'])->name('satuan.delete.single');

    // Wilayah Kerja (Master Wilayah Kerja / Satgas) Routes
    Route::get('/wilayah-kerja', [MasterController::class, 'wilayahKerjaIndex'])->name('wilayah-kerja.index');
    Route::get('/wilayah-kerja/grid', [MasterController::class, 'wilayahKerjaGrid'])->name('wilayah-kerja.grid');
    Route::get('/wilayah-kerja/create', [MasterController::class, 'wilayahKerjaCreate'])->name('wilayah-kerja.create');
    Route::post('/wilayah-kerja/store', [MasterController::class, 'wilayahKerjaStore'])->name('wilayah-kerja.store');
    Route::get('/wilayah-kerja/edit/{id}', [MasterController::class, 'wilayahKerjaEdit'])->name('wilayah-kerja.edit');
    Route::post('/wilayah-kerja/update/{id}', [MasterController::class, 'wilayahKerjaUpdate'])->name('wilayah-kerja.update');
    Route::post('/wilayah-kerja/delete', [MasterController::class, 'wilayahKerjaDestroy'])->name('wilayah-kerja.delete');
    Route::get('/wilayah-kerja/delete/{id}', [MasterController::class, 'wilayahKerjaDelete'])->name('wilayah-kerja.delete.single');

    // Status (Master Status) Routes
    Route::get('/status', [MasterController::class, 'statusIndex'])->name('status.index');
    Route::get('/status/grid', [MasterController::class, 'statusGrid'])->name('status.grid');
    Route::get('/status/create', [MasterController::class, 'statusCreate'])->name('status.create');
    Route::post('/status/store', [MasterController::class, 'statusStore'])->name('status.store');
    Route::get('/status/edit/{id}', [MasterController::class, 'statusEdit'])->name('status.edit');
    Route::post('/status/update/{id}', [MasterController::class, 'statusUpdate'])->name('status.update');
    Route::post('/status/delete', [MasterController::class, 'statusDestroy'])->name('status.delete');
    Route::get('/status/delete/{id}', [MasterController::class, 'statusDelete'])->name('status.delete.single');

    // Produsen (Master Produsen) Routes
    Route::get('/produsen', [MasterController::class, 'produsenIndex'])->name('produsen.index');
    Route::get('/produsen/grid', [MasterController::class, 'produsenGrid'])->name('produsen.grid');
    Route::get('/produsen/create', [MasterController::class, 'produsenCreate'])->name('produsen.create');
    Route::post('/produsen/store', [MasterController::class, 'produsenStore'])->name('produsen.store');
    Route::get('/produsen/edit/{id}', [MasterController::class, 'produsenEdit'])->name('produsen.edit');
    Route::post('/produsen/update/{id}', [MasterController::class, 'produsenUpdate'])->name('produsen.update');
    Route::post('/produsen/delete', [MasterController::class, 'produsenDestroy'])->name('produsen.delete');
    Route::get('/produsen/delete/{id}', [MasterController::class, 'produsenDelete'])->name('produsen.delete.single');

    // Pegawai (Master Pegawai) Routes
    Route::get('/pegawai', [MasterController::class, 'pegawaiIndex'])->name('pegawai.index');
    Route::get('/pegawai/grid', [MasterController::class, 'pegawaiGrid'])->name('pegawai.grid');
    Route::get('/pegawai/create', [MasterController::class, 'pegawaiCreate'])->name('pegawai.create');
    Route::post('/pegawai/store', [MasterController::class, 'pegawaiStore'])->name('pegawai.store');
    Route::get('/pegawai/edit/{id}', [MasterController::class, 'pegawaiEdit'])->name('pegawai.edit');
    Route::post('/pegawai/update/{id}', [MasterController::class, 'pegawaiUpdate'])->name('pegawai.update');
    Route::post('/pegawai/delete', [MasterController::class, 'pegawaiDestroy'])->name('pegawai.delete');
    Route::get('/pegawai/delete/{id}', [MasterController::class, 'pegawaiDelete'])->name('pegawai.delete.single');

    // Mata Anggaran (Master M. Anggaran) Routes
    Route::get('/m-anggaran', [MasterController::class, 'mataAnggaranIndex'])->name('mata-anggaran.index');
    Route::get('/m-anggaran/grid', [MasterController::class, 'mataAnggaranGrid'])->name('mata-anggaran.grid');
    Route::get('/m-anggaran/create', [MasterController::class, 'mataAnggaranCreate'])->name('mata-anggaran.create');
    Route::post('/m-anggaran/store', [MasterController::class, 'mataAnggaranStore'])->name('mata-anggaran.store');
    Route::get('/m-anggaran/edit/{id}', [MasterController::class, 'mataAnggaranEdit'])->name('mata-anggaran.edit');
    Route::post('/m-anggaran/update/{id}', [MasterController::class, 'mataAnggaranUpdate'])->name('mata-anggaran.update');
    Route::post('/m-anggaran/delete', [MasterController::class, 'mataAnggaranDestroy'])->name('mata-anggaran.delete');
    Route::get('/m-anggaran/delete/{id}', [MasterController::class, 'mataAnggaranDelete'])->name('mata-anggaran.delete.single');

    // Konfigurasi User (Master Konfigurasi User) Routes
    Route::get('/konfigurasi-user', [MasterController::class, 'konfigurasiUserIndex'])->name('konfigurasi-user.index');
    Route::get('/konfigurasi-user/grid', [MasterController::class, 'konfigurasiUserGrid'])->name('konfigurasi-user.grid');
    Route::get('/konfigurasi-user/create', [MasterController::class, 'konfigurasiUserCreate'])->name('konfigurasi-user.create');
    Route::post('/konfigurasi-user/store', [MasterController::class, 'konfigurasiUserStore'])->name('konfigurasi-user.store');
    Route::get('/konfigurasi-user/edit/{id}', [MasterController::class, 'konfigurasiUserEdit'])->name('konfigurasi-user.edit');
    Route::post('/konfigurasi-user/update/{id}', [MasterController::class, 'konfigurasiUserUpdate'])->name('konfigurasi-user.update');
    Route::post('/konfigurasi-user/delete', [MasterController::class, 'konfigurasiUserDestroy'])->name('konfigurasi-user.delete');
    Route::get('/konfigurasi-user/delete/{id}', [MasterController::class, 'konfigurasiUserDelete'])->name('konfigurasi-user.delete.single');

    // Daftar User (Master Daftar User) Routes
    Route::get('/daftar-user', [MasterController::class, 'userIndex'])->name('daftar-user.index');
    Route::get('/daftar-user/grid', [MasterController::class, 'userGrid'])->name('daftar-user.grid');
    Route::get('/daftar-user/create', [MasterController::class, 'userCreate'])->name('daftar-user.create');
    Route::post('/daftar-user/store', [MasterController::class, 'userStore'])->name('daftar-user.store');
    Route::get('/daftar-user/edit/{id}', [MasterController::class, 'userEdit'])->name('daftar-user.edit');
    Route::post('/daftar-user/update/{id}', [MasterController::class, 'userUpdate'])->name('daftar-user.update');
    Route::post('/daftar-user/reset-password/{id}', [MasterController::class, 'userResetPassword'])->name('daftar-user.reset-password');
    Route::post('/daftar-user/delete', [MasterController::class, 'userDestroy'])->name('daftar-user.delete');
    Route::get('/daftar-user/delete/{id}', [MasterController::class, 'userDelete'])->name('daftar-user.delete.single');
});
