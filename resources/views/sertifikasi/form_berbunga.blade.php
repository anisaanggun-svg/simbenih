@extends("template.t_admin")

@section("title", "Fase Berbunga - Sertifikasi")

@section("header")
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
    #berbungaContent .card { margin-bottom: 1.5rem; }
    #berbungaContent .form-group { margin-bottom: 1.1rem; }
    .cvl-table td { padding: 4px 8px; vertical-align: middle; }
    .cvl-input { width: 50px; display: inline-block; text-align: center; }
    .tbl-realisasi th, .tbl-realisasi td { padding: 6px 10px; border: 1px solid #dee2e6; text-align: center; }
    .tbl-realisasi th { background-color: #f8f9fa; }
</style>
@endsection

@section("content")
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Fase Berbunga (Jenis Tanaman Hibrida)</h3>
                <div class="card-tools">
                    <a href="{{ url('') }}/admin/sertifikasi/laporan_lapangan_hibrida/cetak/{{ $id ?? 105271 }}/12/1"
                       class="btn btn-sm btn-outline-secondary" target="_blank">
                        <i class="fas fa-print mr-1"></i> Print Laporan Lapangan
                    </a>
                </div>
            </div>
            <div class="card-body">

                @include('sertifikasi.partials.header_fase', ['active_fase' => 'berbunga', 'id_permohonan' => $id ?? 105271])

                <form action="{{ url('') }}/admin/sertifikasi/pengajuan/update" method="post" name="form_edit_fase_berbunga" id="form_edit_fase_berbunga">
                    @csrf
                    <input type="hidden" value="12" name="kode_fase" />
                    <input type="hidden" value="Berbunga" name="nama_fase" />

                    <div id="berbungaContent">
                        <!-- ===================== INFORMASI ===================== -->
                        <div id="informasi">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Informasi</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td width="25%" class="font-weight-bold">Jenis Tanaman</td>
                                                    <td width="25%">: Jagung Hibrida</td>
                                                    <td width="25%" class="font-weight-bold">Desa</td>
                                                    <td width="25%">: Wonokasian</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Varietas (Kode Var)</td>
                                                    <td>: LG 38778 (JghHI)</td>
                                                    <td class="font-weight-bold">Kecamatan (Kode)</td>
                                                    <td>: Turen (120)</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Tanggal Rencana Tanam</td>
                                                    <td>: 14-08-2026</td>
                                                    <td class="font-weight-bold">Kabupaten (Kode)</td>
                                                    <td>: Malang (07)</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== PEMOHON ===================== -->
                        <div id="pemohon">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">| Pemohon |</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_induk">NOMER INDUK NASIONAL (Otomatis)</label>
                                                <input required autocomplete="off" class="form-control grey" readonly
                                                    title="***.*.***.******.****.****.****.**.***" name="nomor_induk_fase_lapangan"
                                                    value="JghHI.R.3507120.0911.0339"
                                                    id="no_induk" type="text" />
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_produsen">Nama Produsen <span class="text-danger">*</span></label>
                                                <select name="nama_produsen" id="nama_produsen" class="form-control select2" onChange="dapatkan_alamat()">
                                                    <option value="0">-- Pilih Produsen --</option>
                                                    @isset($produsen_list)
                                                        @foreach($produsen_list as $p)
                                                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Alamat Produsen</label>
                                                <textarea class="form-control" name="alamat_produsen" rows="3" readonly>Desa Genteng, Kec. Genteng, Kota Surabaya</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_pegawai">Nama Petugas <span class="text-danger">*</span></label>
                                                <select name="nama_pegawai" id="nama_pegawai" class="form-control select2">
                                                    <option value="0">-- Pilih Petugas --</option>
                                                    @isset($pegawai_list)
                                                        @foreach($pegawai_list as $p)
                                                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== PEMERIKSAAN BERBUNGA ===================== -->
                        <div id="pemeriksaan_berbunga">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pemeriksaan Berbunga</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="desc">Tanggal Berbunga*</label>
                                                <input type="date" class="form-control" name="tanggal_berbunga" value="{{ old('tanggal_berbunga') }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Luas Lulus Berbunga* (Angka, contoh: 4 atau 3.4 jika desimal)</label>
                                                <input type="text" class="form-control" name="luas_lulus_berbunga" value="{{ old('luas_lulus_berbunga') }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Kelas Benih*</label>
                                                <select name="kelas_benih" id="kelas_benih" class="form-control select2">
                                                    <option value="0">---</option>
                                                    <option value="1">NS-N</option>
                                                    <option value="2">BS-S</option>
                                                    <option value="7">BD-D</option>
                                                    <option value="12">BP-P</option>
                                                    <option value="13">BP1-P1</option>
                                                    <option value="14">BP2-P2</option>
                                                    <option value="17" selected>BR-R</option>
                                                    <option value="18">BR1-R1</option>
                                                    <option value="19">BR2-R2</option>
                                                    <option value="20">BR3-R3</option>
                                                    <option value="21">BR4-R4</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Populasi Pemeriksaan Jantan</label>
                                                <input type="text" class="form-control" name="pops_jantan" value="100">
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Jumlah Titik Contoh Jantan</label>
                                                <input type="text" class="form-control" name="jumlah_titik_contoh_jantan" readonly> (Otomatis)
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Jumlah Titik Contoh Induk Yang Tertinggal</label>
                                                <input type="text" class="form-control" name="jumlah_titik_contoh_pbjtpi" readonly> (Otomatis)
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Populasi Pemeriksaan Betina</label>
                                                <input type="text" class="form-control" name="pops_betina" value="100">
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Jumlah Titik Contoh Betina</label>
                                                <input type="text" class="form-control" name="jumlah_titik_contoh_betina" readonly> (Otomatis)
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Kondisi Rerumputan*</label>
                                                <select name="rerumputan" id="rerumputan" class="form-control select2">
                                                    <option value="0" selected>Bersih/Tidak Bersih *)</option>
                                                    <option value="1">Tidak Bersih</option>
                                                    <option value="2">Bersih</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Sifat Pertanaman*</label>
                                                <select name="sifat_pertanaman" id="sifat_pertanaman" required class="form-control select2">
                                                    <option value="Sesuai / Tidak Sesuai *)" selected>Sesuai / Tidak Sesuai *)</option>
                                                    <option value="Sesuai">Sesuai</option>
                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Serangan Hama/Penyakit*</label>
                                                <select name="serangan_hama_penyakit" id="serangan_hama_penyakit" required class="form-control select2">
                                                    <option value="Ada Terkendali / Ada Tidak Terkendali / Tidak Ada Serangan *)" selected>Ada Terkendali / Ada Tidak Terkendali / Tidak Ada Serangan *)</option>
                                                    <option value="Ada Terkendali">Ada Terkendali</option>
                                                    <option value="Ada Tidak Terkendali">Ada Tidak Terkendali</option>
                                                    <option value="Tidak Ada Serangan">Tidak Ada Serangan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="desc">Tanggal Realisasi</label>
                                                <table class="table tbl-realisasi">
                                                    <thead>
                                                        <tr><th>&nbsp;</th><th>BETINA</th><th>JANTAN</th></tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Realisasi Tanam 1</td>
                                                            <td><input type="date" name="TGL_REALISASI" value="2026-08-21" /></td>
                                                            <td><input type="date" name="TGL_REALISASI_TANAM_JANTAN_1" value="2026-08-21" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Realisasi Tanam 2</td>
                                                            <td></td>
                                                            <td><input type="date" name="TGL_REALISASI_TANAM_JANTAN_2" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Realisasi Tanam 3</td>
                                                            <td></td>
                                                            <td><input type="date" name="TGL_REALISASI_TANAM_JANTAN_3" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Realisasi Semai 1</td>
                                                            <td><input type="date" name="TGL_REALISASI_SEMAI" /></td>
                                                            <td><input type="date" name="TGL_REALISASI_SEMAI_JANTAN_1" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Realisasi Semai 2</td>
                                                            <td></td>
                                                            <td><input type="date" name="TGL_REALISASI_SEMAI_JANTAN_2" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Realisasi Semai 3</td>
                                                            <td></td>
                                                            <td><input type="date" name="TGL_REALISASI_SEMAI_JANTAN_3" /></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Petugas Pengawas Benih*</label>
                                                <select name="pegawai" id="pegawai" class="form-control select2">
                                                    <option value="0">-- Pilih Pegawai --</option>
                                                    @isset($pegawai_list)
                                                        @foreach($pegawai_list as $p)
                                                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Catatan Fase Berbunga</label>
                                                <textarea class="form-control" name="catatan_berbunga" rows="3">{{ old('catatan_berbunga') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== CVL ===================== -->
                        <div id="pemeriksaan_cvl">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pemeriksaan Campuran Varietas Lain (CVL)</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="desc">Tanaman Betina</label>
                                        <table class="table cvl-table">
                                            <tr>
                                                <td>1</td><td><input type="text" class="cvl-input" name="sb1" maxlength="2"></td>
                                                <td>2</td><td><input type="text" class="cvl-input" name="sb2" maxlength="2"></td>
                                                <td>3</td><td><input type="text" class="cvl-input" name="sb3" maxlength="2"></td>
                                                <td>4</td><td><input type="text" class="cvl-input" name="sb4" maxlength="2"></td>
                                                <td>5</td><td><input type="text" class="cvl-input" name="sb5" maxlength="2"></td>
                                                <td>6</td><td><input type="text" class="cvl-input" name="sb6" maxlength="2"></td>
                                                <td>7</td><td><input type="text" class="cvl-input" name="sb7" maxlength="2"></td>
                                                <td>8</td><td><input type="text" class="cvl-input" name="sb8" maxlength="2"></td>
                                                <td>TOTAL</td><td><input type="text" class="cvl-input" name="sb_total" readonly> %</td>
                                            </tr>
                                            <tr>
                                                <td>9</td><td><input type="text" class="cvl-input" name="sb9" maxlength="2"></td>
                                                <td>10</td><td><input type="text" class="cvl-input" name="sb10" maxlength="2"></td>
                                                <td>11</td><td><input type="text" class="cvl-input" name="sb11" maxlength="2"></td>
                                                <td>12</td><td><input type="text" class="cvl-input" name="sb12" maxlength="2"></td>
                                                <td>13</td><td><input type="text" class="cvl-input" name="sb13" maxlength="2"></td>
                                                <td>14</td><td><input type="text" class="cvl-input" name="sb14" maxlength="2"></td>
                                                <td>15</td><td><input type="text" class="cvl-input" name="sb15" maxlength="2"></td>
                                                <td>16</td><td><input type="text" class="cvl-input" name="sb16" maxlength="2"></td>
                                                <td>Penyelia</td><td><input type="text" class="cvl-input" name="sb_penyelia"> %</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <label class="desc">Tanaman Jantan</label>
                                        <table class="table cvl-table">
                                            <tr>
                                                <td>1</td><td><input type="text" class="cvl-input" name="sj1" maxlength="2"></td>
                                                <td>2</td><td><input type="text" class="cvl-input" name="sj2" maxlength="2"></td>
                                                <td>3</td><td><input type="text" class="cvl-input" name="sj3" maxlength="2"></td>
                                                <td>4</td><td><input type="text" class="cvl-input" name="sj4" maxlength="2"></td>
                                                <td>5</td><td><input type="text" class="cvl-input" name="sj5" maxlength="2"></td>
                                                <td>6</td><td><input type="text" class="cvl-input" name="sj6" maxlength="2"></td>
                                                <td>7</td><td><input type="text" class="cvl-input" name="sj7" maxlength="2"></td>
                                                <td>8</td><td><input type="text" class="cvl-input" name="sj8" maxlength="2"></td>
                                                <td>TOTAL</td><td><input type="text" class="cvl-input" name="sj_total" readonly> %</td>
                                            </tr>
                                            <tr>
                                                <td>9</td><td><input type="text" class="cvl-input" name="sj9" maxlength="2"></td>
                                                <td>10</td><td><input type="text" class="cvl-input" name="sj10" maxlength="2"></td>
                                                <td>11</td><td><input type="text" class="cvl-input" name="sj11" maxlength="2"></td>
                                                <td>12</td><td><input type="text" class="cvl-input" name="sj12" maxlength="2"></td>
                                                <td>13</td><td><input type="text" class="cvl-input" name="sj13" maxlength="2"></td>
                                                <td>14</td><td><input type="text" class="cvl-input" name="sj14" maxlength="2"></td>
                                                <td>15</td><td><input type="text" class="cvl-input" name="sj15" maxlength="2"></td>
                                                <td>16</td><td><input type="text" class="cvl-input" name="sj16" maxlength="2"></td>
                                                <td>Penyelia</td><td><input type="text" class="cvl-input" name="sj_penyelia"> %</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== BUNGA JANTAN TERTINGGAL ===================== -->
                        <div id="pemeriksaan_pbjtpi">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Bunga Jantan Tertinggal Pada Induk Betina</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <table class="table cvl-table">
                                            <tr>
                                                <td>1</td><td><input type="text" class="cvl-input" name="pbjtpi1" maxlength="2"></td>
                                                <td>2</td><td><input type="text" class="cvl-input" name="pbjtpi2" maxlength="2"></td>
                                                <td>3</td><td><input type="text" class="cvl-input" name="pbjtpi3" maxlength="2"></td>
                                                <td>4</td><td><input type="text" class="cvl-input" name="pbjtpi4" maxlength="2"></td>
                                                <td>5</td><td><input type="text" class="cvl-input" name="pbjtpi5" maxlength="2"></td>
                                                <td>6</td><td><input type="text" class="cvl-input" name="pbjtpi6" maxlength="2"></td>
                                                <td>7</td><td><input type="text" class="cvl-input" name="pbjtpi7" maxlength="2"></td>
                                                <td>8</td><td><input type="text" class="cvl-input" name="pbjtpi8" maxlength="2"></td>
                                                <td>TOTAL</td><td><input type="text" class="cvl-input" name="pbjtpi_total" readonly> %</td>
                                            </tr>
                                            <tr>
                                                <td>9</td><td><input type="text" class="cvl-input" name="pbjtpi9" maxlength="2"></td>
                                                <td>10</td><td><input type="text" class="cvl-input" name="pbjtpi10" maxlength="2"></td>
                                                <td>11</td><td><input type="text" class="cvl-input" name="pbjtpi11" maxlength="2"></td>
                                                <td>12</td><td><input type="text" class="cvl-input" name="pbjtpi12" maxlength="2"></td>
                                                <td>13</td><td><input type="text" class="cvl-input" name="pbjtpi13" maxlength="2"></td>
                                                <td>14</td><td><input type="text" class="cvl-input" name="pbjtpi14" maxlength="2"></td>
                                                <td>15</td><td><input type="text" class="cvl-input" name="pbjtpi15" maxlength="2"></td>
                                                <td>16</td><td><input type="text" class="cvl-input" name="pbjtpi16" maxlength="2"></td>
                                                <td>Penyelia</td><td><input type="text" class="cvl-input" name="pbjtpi_penyelia"> %</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== ISOLASI JARAK ===================== -->
                        <div id="pemeriksaan_isolasi">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Isolasi Jarak</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="desc">Isolasi Timur</label>
                                                <select name="iso_timur" class="form-control select2">
                                                    <option value="-" selected>-</option>
                                                    <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                    <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                    <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Isolasi Barat</label>
                                                <select name="iso_barat" class="form-control select2">
                                                    <option value="-" selected>-</option>
                                                    <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                    <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                    <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Isolasi Waktu</label>
                                                <select name="isolasi_waktu" class="form-control select2">
                                                    <option value="-" selected>-</option>
                                                    <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                    <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                    <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="desc">Isolasi Utara</label>
                                                <select name="iso_utara" class="form-control select2">
                                                    <option value="-" selected>-</option>
                                                    <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                    <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                    <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Isolasi Selatan</label>
                                                <select name="iso_selatan" class="form-control select2">
                                                    <option value="-" selected>-</option>
                                                    <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                    <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                    <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Isolasi Barier</label>
                                                <select name="iso_barier" class="form-control select2">
                                                    <option value="-" selected>-</option>
                                                    <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                    <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                    <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== HAMA PENYAKIT ===================== -->
                        <div id="pemeriksaan_hama_penyakit">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Hama Penyakit</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="desc">Hama 1</label>
                                                <select name="hama1" class="form-control select2">
                                                    <option value="">Pilih Hama 1</option>
                                                    <option value="Aphid">Aphid</option>
                                                    <option value="Diaphorina citri">Diaphorina citri</option>
                                                    <option value="Lalat rimpang">Lalat rimpang</option>
                                                    <option value="Mealbugs">Mealbugs</option>
                                                    <option value="Mite">Mite</option>
                                                    <option value="Nematoda">Nematoda</option>
                                                    <option value="Penggerek Batang">Penggerek Batang</option>
                                                    <option value="Wereng Batang Coklat">Wereng Batang Coklat</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Hama 2</label>
                                                <select name="hama2" class="form-control select2">
                                                    <option value="">Pilih Hama 2</option>
                                                    <option value="Aphid">Aphid</option>
                                                    <option value="Diaphorina citri">Diaphorina citri</option>
                                                    <option value="Lalat rimpang">Lalat rimpang</option>
                                                    <option value="Mealbugs">Mealbugs</option>
                                                    <option value="Mite">Mite</option>
                                                    <option value="Nematoda">Nematoda</option>
                                                    <option value="Penggerek Batang">Penggerek Batang</option>
                                                    <option value="Wereng Batang Coklat">Wereng Batang Coklat</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Hama 3</label>
                                                <select name="hama3" class="form-control select2">
                                                    <option value="">Pilih Hama 3</option>
                                                    <option value="Aphid">Aphid</option>
                                                    <option value="Diaphorina citri">Diaphorina citri</option>
                                                    <option value="Lalat rimpang">Lalat rimpang</option>
                                                    <option value="Mealbugs">Mealbugs</option>
                                                    <option value="Mite">Mite</option>
                                                    <option value="Nematoda">Nematoda</option>
                                                    <option value="Penggerek Batang">Penggerek Batang</option>
                                                    <option value="Wereng Batang Coklat">Wereng Batang Coklat</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="desc">Penyakit 1</label>
                                                <select name="penyakit1" class="form-control select2">
                                                    <option value="">Pilih Penyakit 1</option>
                                                    <option value="Fusarium sp">Fusarium sp</option>
                                                    <option value="Bakteri">Bakteri</option>
                                                    <option value="Virus">Virus</option>
                                                    <option value="Cendawan">Cendawan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Penyakit 2</label>
                                                <select name="penyakit2" class="form-control select2">
                                                    <option value="">Pilih Penyakit 2</option>
                                                    <option value="Fusarium sp">Fusarium sp</option>
                                                    <option value="Bakteri">Bakteri</option>
                                                    <option value="Virus">Virus</option>
                                                    <option value="Cendawan">Cendawan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Penyakit 3</label>
                                                <select name="penyakit3" class="form-control select2">
                                                    <option value="">Pilih Penyakit 3</option>
                                                    <option value="Fusarium sp">Fusarium sp</option>
                                                    <option value="Bakteri">Bakteri</option>
                                                    <option value="Virus">Virus</option>
                                                    <option value="Cendawan">Cendawan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== KESIMPULAN ===================== -->
                        <div id="kesimpulan">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Kesimpulan Fase*</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="desc">Kesimpulan Fase Berbunga</label>
                                        <div>
                                            <input type="radio" name="kesimpulan_fase" value="2"> Memenuhi Syarat / Tidak Memenuhi Syarat *)<br>
                                            <input type="radio" name="kesimpulan_fase" value="1" checked> Memenuhi Syarat <br>
                                            <input type="radio" name="kesimpulan_fase" value="0"> Tidak Memenuhi Syarat
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
