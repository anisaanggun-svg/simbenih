@extends("template.t_admin")

@section("title", "Fase Vegetatif - Sertifikasi")

@section("header")
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
    /* Split date fields (Vegetatif) */
    .split-date-wrap input {
        display: inline-block;
        text-align: center;
    }
    .split-date-wrap .w2em { width: 3rem; }
    .split-date-wrap .w4em { width: 4.5rem; }
    .split-date-wrap label { font-weight: 400; color: #6c757d; margin: 0 4px 0 2px; }
    .split-date-wrap img { cursor: pointer; margin-left: 6px; vertical-align: middle; }

    /* Isolasi grid */
    .isolasi-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    @media (max-width: 768px) {
        .isolasi-grid { grid-template-columns: 1fr; }
    }

    /* CVL number inputs */
    .cvl-input {
        width: 20px;
        display: inline-block;
        text-align: center;
    }
    .cvl-table td { padding: 4px 8px; vertical-align: middle; }

    /* Realisasi table */
    .tbl-realisasi th, .tbl-realisasi td {
        padding: 6px 10px;
        border: 1px solid #dee2e6;
        text-align: center;
    }
    .tbl-realisasi th { background-color: #f8f9fa; }

    .radio-group .custom-control { margin-bottom: .35rem; }

    /* Pemeriksaan Vegetatif - improve spacing/neatness */
    #pemeriksaan_vegetatif .form-group { margin-bottom: 1.25rem; }
    #pemeriksaan_vegetatif .tbl-realisasi { width: 100%; }
    #pemeriksaan_vegetatif .tbl-realisasi th,
    #pemeriksaan_vegetatif .tbl-realisasi td { padding: 8px 12px; }
    #pemeriksaan_vegetatif .tbl-realisasi th:first-child,
    #pemeriksaan_vegetatif .tbl-realisasi td:first-child { text-align: left; }
    #pemeriksaan_vegetatif .tbl-realisasi input[type="date"] { width: 100%; }

    /* Overall layout neatness for all sections */
    #vegetatifContent .card { margin-bottom: 1.5rem; }
    #vegetatifContent .form-group { margin-bottom: 1.1rem; }
    #vegetatifContent .cvl-table { width: 100%; max-width: 560px; }
</style>
@endsection

@section("content")
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Fase Vegetatif (Jenis Tanaman Hibrida)</h3>
                <div class="card-tools">
                    <a href="{{ url('') }}/admin/sertifikasi/laporan_lapangan_hibrida/cetak/{{ $id ?? 105271 }}/6/1"
                       class="btn btn-sm btn-outline-secondary" target="_blank">
                        <i class="fas fa-print mr-1"></i> Print Laporan Lapangan
                    </a>
                </div>
            </div>
            <div class="card-body">

                @include('sertifikasi.partials.header_fase', ['active_fase' => 'vegetatif', 'id_permohonan' => $id ?? 105271])

                <form action="{{ url('') }}/admin/sertifikasi/pengajuan/update" method="post" name="form_edit_fase_vegetatif" id="form_edit_fase_vegetatif">
                    @csrf

                    <div id="vegetatifContent">

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
                                                            <option value="{{ $p->id }}" {{ (isset($selected_produsen) && $selected_produsen == $p->id) ? 'selected' : '' }}>{{ $p->nama }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="alamat_produsen">Alamat Produsen</label>
                                                <textarea name="alamat_produsen" id="alamat_produsen" class="form-control" rows="3" readonly>Desa Genteng, Kec. Genteng, Kota Surabaya</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== PEMERIKSAAN VEGETATIF ===================== -->
                        <div id="pemeriksaan_vegetatif">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pemeriksaan Vegetatif</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tgl_vegetatif">Tanggal Vegetatif <span class="text-danger">*</span></label>
                                                <div class="split-date-wrap" id="newline-wrapper">
                                                    <input type="text" class="form-control w2em" id="date-31-dd" readonly name="tgl_vegetatif" maxlength="2" value="1" placeholder="DD"/>-
                                                    <input type="text" class="form-control w2em" id="date-31-mm" readonly name="bln_vegetatif" maxlength="2" value="8" placeholder="MM"/>-
                                                    <input type="text" class="form-control w4em highlight-days-67 split-date" readonly id="date-31" name="thn_vegetatif" maxlength="4" value="2026" placeholder="YYYY"/>
                                                    <i class="fas fa-eraser text-danger" style="cursor:pointer; margin-left:6px;" onclick="hapus_tanggal_tumbuh();" title="Hapus Tanggal"></i>
                                                </div>
                                                <small class="form-text text-muted">Format: DD-MM-YYYY</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="luas_lulus_v">Luas Lulus Vegetatif <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input autocomplete="off" class="form-control" name="luas_lulus_v" type="text" size="25" maxlength="25" value="1"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Hektare</span>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">Angka, contoh: 4 atau 3.4 jika desimal</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="kelas_benih">Kelas Benih <span class="text-danger">*</span></label>
                                                <select name="kelas_benih" id="kelas_benih" class="form-control">
                                                    <option value="0">---</option>
                                                    <option value="1">NS-N</option>
                                                    <option value="2">BS-S</option>
                                                    <option value="7">BD-D</option>
                                                    <option value="12">BP-P</option>
                                                    <option value="13">BP1-P1</option>
                                                    <option value="14">BP2-P2</option>
                                                    <option value="17" selected="selected">BR-R</option>
                                                    <option value="18">BR1-R1</option>
                                                    <option value="19">BR2-R2</option>
                                                    <option value="20">BR3-R3</option>
                                                    <option value="21">BR4-R4</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="pops_jantan">Populasi Pemeriksaan Jantan</label>
                                                <input class="form-control" readonly name="pops_jantan" type="text" size="25" maxlength="25" value="100"/>
                                            </div>

                                            <div class="form-group">
                                                <label for="jumlah_titik_contoh_jantan">Jumlah Titik Contoh Jantan</label>
                                                <input class="form-control" name="jumlah_titik_contoh_jantan" type="text" size="25" readonly maxlength="25" placeholder="(Otomatis)"/>
                                            </div>

                                            <div class="form-group">
                                                <label for="pops_betina">Populasi Pemeriksaan Betina</label>
                                                <input class="form-control" readonly name="pops_betina" type="text" size="25" maxlength="25" value="100"/>
                                            </div>

                                            <div class="form-group">
                                                <label for="jumlah_titik_contoh_betina">Jumlah Titik Contoh Betina</label>
                                                <input class="form-control" name="jumlah_titik_contoh_betina" type="text" size="25" readonly maxlength="25" placeholder="(Otomatis)"/>
                                            </div>

                                            <div class="form-group">
                                                <label for="rerumputan">Kondisi Rerumputan <span class="text-danger">*</span></label>
                                                <select name="rerumputan" id="rerumputan" class="form-control">
                                                    <option value="0" selected>Bersih/Tidak Bersih *)</option>
                                                    <option value="1">Tidak Bersih</option>
                                                    <option value="2">Bersih</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="sifat_pertanaman">Sifat Pertanaman <span class="text-danger">*</span></label>
                                                <select name="sifat_pertanaman" id="sifat_pertanaman" required class="form-control">
                                                    <option value="Sesuai / Tidak Sesuai *)" selected>Sesuai / Tidak Sesuai *)</option>
                                                    <option value="Sesuai">Sesuai</option>
                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="serangan_hama_penyakit">Serangan Hama/Penyakit <span class="text-danger">*</span></label>
                                                <select name="serangan_hama_penyakit" id="serangan_hama_penyakit" required class="form-control">
                                                    <option value="Ada Terkendali / Ada Tidak Terkendali / Tidak Ada Serangan *)" selected>Ada Terkendali / Ada Tidak Terkendali / Tidak Ada Serangan *)</option>
                                                    <option value="Ada Terkendali">Ada Terkendali</option>
                                                    <option value="Ada Tidak Terkendali">Ada Tidak Terkendali</option>
                                                    <option value="Tidak Ada Serangan">Tidak Ada Serangan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Realisasi</label>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-sm tbl-realisasi">
                                                        <thead class="thead-light">
                                                            <tr><th>Kegiatan</th><th class="text-center">BETINA</th><th class="text-center">JANTAN</th></tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Realisasi Tanam 1</td>
                                                                <td><input type="date" class="form-control form-control-sm" name="TGL_REALISASI" required value="2026-08-21"/></td>
                                                                <td><input type="date" class="form-control form-control-sm" name="TGL_REALISASI_TANAM_JANTAN_1" required value="2026-08-21"/></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Realisasi Tanam 2</td>
                                                                <td></td>
                                                                <td><input type="date" class="form-control form-control-sm" name="TGL_REALISASI_TANAM_JANTAN_2" value=""/></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Realisasi Tanam 3</td>
                                                                <td></td>
                                                                <td><input type="date" class="form-control form-control-sm" name="TGL_REALISASI_TANAM_JANTAN_3" value=""/></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Realisasi Semai 1</td>
                                                                <td><input type="date" class="form-control form-control-sm" name="TGL_REALISASI_SEMAI" value=""/></td>
                                                                <td><input type="date" class="form-control form-control-sm" name="TGL_REALISASI_SEMAI_JANTAN_1" value=""/></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Realisasi Semai 2</td>
                                                                <td></td>
                                                                <td><input type="date" class="form-control form-control-sm" name="TGL_REALISASI_SEMAI_JANTAN_2" value=""/></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Realisasi Semai 3</td>
                                                                <td></td>
                                                                <td><input type="date" class="form-control form-control-sm" name="TGL_REALISASI_SEMAI_JANTAN_3" value=""/></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="pegawai">Petugas Pengawas Benih <span class="text-danger">*</span></label>
                                                <select name="pegawai" id="pegawai" class="form-control select2">
                                                    <option value="0" selected="selected">-- Pilih Pegawai --</option>
                                                    @isset($pegawai_list)
                                                        @foreach($pegawai_list as $pg)
                                                            <option value="{{ $pg->id }}">{{ $pg->nama }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="hasil_periksa">Catatan Fase Vegetatif</label>
                                                <textarea class="form-control" name="hasil_periksa" id="hasil_periksa" rows="5" placeholder="Masukkan catatan fase vegetatif..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== CVL ===================== -->
                        <div id="cvl">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pemeriksaan Campuran Varietas Lain (CVL)</h3>
                                </div>
                                <div class="card-body">
                                    <h6 class="font-weight-bold">Tanaman Betina</h6>
                                    <div class="table-responsive mb-3">
                                        <table class="cvl-table">
                                            <tr>
                                                <td>1</td><td><input autocomplete="off" class="cvl-input" name="sb1" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sb();"/></td>
                                                <td>2</td><td><input autocomplete="off" class="cvl-input" name="sb2" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sb();"/></td>
                                                <td>3</td><td><input autocomplete="off" class="cvl-input" name="sb3" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sb();"/></td>
                                                <td>4</td><td><input autocomplete="off" class="cvl-input" name="sb4" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sb();"/></td>
                                                <td>5</td><td><input autocomplete="off" class="cvl-input" name="sb5" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sb();"/></td>
                                                <td>6</td><td><input autocomplete="off" class="cvl-input" name="sb6" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sb();"/></td>
                                                <td>7</td><td><input autocomplete="off" class="cvl-input" name="sb7" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sb();"/></td>
                                                <td>8</td><td><input autocomplete="off" class="cvl-input" name="sb8" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sb();"/></td>
                                                <td>TOTAL</td><td><input class="cvl-input" name="sb_total" type="text" size="3" maxlength="3" value="0" readonly/> %</td>
                                            </tr>
                                            <tr>
                                                <td>9</td><td><input autocomplete="off" class="cvl-input" name="sb9" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sb();"/></td>
                                                <td>10</td><td><input autocomplete="off" class="cvl-input" name="sb10" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sb();"/></td>
                                                <td>11</td><td><input autocomplete="off" class="cvl-input" name="sb11" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sb();"/></td>
                                                <td>12</td><td><input autocomplete="off" class="cvl-input" name="sb12" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sb();"/></td>
                                                <td>13</td><td><input autocomplete="off" class="cvl-input" name="sb13" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sb();"/></td>
                                                <td>14</td><td><input autocomplete="off" class="cvl-input" name="sb14" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sb();"/></td>
                                                <td>15</td><td><input autocomplete="off" class="cvl-input" name="sb15" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sb();"/></td>
                                                <td>16</td><td><input autocomplete="off" class="cvl-input" name="sb16" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sb();"/></td>
                                                <td>Penyelia</td><td><input class="cvl-input" autocomplete="off" name="sb_penyelia" type="text" size="3" maxlength="3" value="" onKeyup="cekTotal(this, 'b');"/> %</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <h6 class="font-weight-bold">Tanaman Jantan</h6>
                                    <div class="table-responsive">
                                        <table class="cvl-table">
                                            <tr>
                                                <td>1</td><td><input autocomplete="off" class="cvl-input" name="sj1" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sj();"/></td>
                                                <td>2</td><td><input autocomplete="off" class="cvl-input" name="sj2" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sj();"/></td>
                                                <td>3</td><td><input autocomplete="off" class="cvl-input" name="sj3" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sj();"/></td>
                                                <td>4</td><td><input autocomplete="off" class="cvl-input" name="sj4" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sj();"/></td>
                                                <td>5</td><td><input autocomplete="off" class="cvl-input" name="sj5" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sj();"/></td>
                                                <td>6</td><td><input autocomplete="off" class="cvl-input" name="sj6" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sj();"/></td>
                                                <td>7</td><td><input autocomplete="off" class="cvl-input" name="sj7" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sj();"/></td>
                                                <td>8</td><td><input autocomplete="off" class="cvl-input" name="sj8" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sj();"/></td>
                                                <td>TOTAL</td><td><input class="cvl-input" name="sj_total" type="text" size="3" maxlength="3" value="0" readonly/> %</td>
                                            </tr>
                                            <tr>
                                                <td>9</td><td><input autocomplete="off" class="cvl-input" name="sj9" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sj();"/></td>
                                                <td>10</td><td><input autocomplete="off" class="cvl-input" name="sj10" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sj();"/></td>
                                                <td>11</td><td><input autocomplete="off" class="cvl-input" name="sj11" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sj();"/></td>
                                                <td>12</td><td><input autocomplete="off" class="cvl-input" name="sj12" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sj();"/></td>
                                                <td>13</td><td><input autocomplete="off" class="cvl-input" name="sj13" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sj();"/></td>
                                                <td>14</td><td><input autocomplete="off" class="cvl-input" name="sj14" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sj();"/></td>
                                                <td>15</td><td><input autocomplete="off" class="cvl-input" name="sj15" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sj();"/></td>
                                                <td>16</td><td><input autocomplete="off" class="cvl-input" name="sj16" type="text" maxlength="2" value="" onKeyup="isInteger(this);sum_total_sj();"/></td>
                                                <td>Penyelia</td><td><input class="cvl-input" autocomplete="off" name="sj_penyelia" type="text" size="3" maxlength="3" value="" onKeyup="cekTotal(this, 'j');"/> %</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== ISOLASI JARAK ===================== -->
                        <div id="isolasi_jarak">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Isolasi Jarak</h3>
                                </div>
                                <div class="card-body">
                                    <div class="isolasi-grid">
                                        <div class="form-group">
                                            <label for="iso_timur">Isolasi Timur</label>
                                            <select name="iso_timur" id="iso_timur" class="form-control">
                                                <option value="-" selected>-</option>
                                                <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="iso_barat">Isolasi Barat</label>
                                            <select name="iso_barat" id="iso_barat" class="form-control">
                                                <option value="-" selected>-</option>
                                                <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="isolasi_waktu">Isolasi Waktu</label>
                                            <select name="isolasi_waktu" id="isolasi_waktu" class="form-control">
                                                <option value="-" selected>-</option>
                                                <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="iso_utara">Isolasi Utara</label>
                                            <select name="iso_utara" id="iso_utara" class="form-control">
                                                <option value="-" selected>-</option>
                                                <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="iso_selatan">Isolasi Selatan</label>
                                            <select name="iso_selatan" id="iso_selatan" class="form-control">
                                                <option value="-" selected>-</option>
                                                <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="iso_barier">Isolasi Barier</label>
                                            <select name="iso_barier" id="iso_barier" class="form-control">
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

                        <!-- ===================== HAMA PENYAKIT ===================== -->
                        <div id="hama_penyakit">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Hama Penyakit</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="hama1">Hama 1</label>
                                                <select name="hama1" id="hama1" class="form-control">
                                                    <option value="">Pilih Hama 1</option>
                                                    <option value='Aphid'>Aphid</option>
                                                    <option value='Diaphorina citri'>Diaphorina citri</option>
                                                    <option value='Lalat rimpang'>Lalat rimpang</option>
                                                    <option value='Mealbugs'>Mealbugs</option>
                                                    <option value='Mite'>Mite</option>
                                                    <option value='Nematoda'>Nematoda</option>
                                                    <option value='Nematoda sista kuning'>Nematoda sista kuning</option>
                                                    <option value='Pentalonia nigrohervosa'>Pentalonia nigrohervosa</option>
                                                    <option value='Lalat / Serangga penggerek'>Lalat / Serangga penggerek</option>
                                                    <option value='Wereng Batang Coklat'>Wereng Batang Coklat</option>
                                                    <option value='Kerusakan Mekanis'>Kerusakan Mekanis</option>
                                                    <option value='Penggerek Batang'>Penggerek Batang</option>
                                                    <option value='Boleng'>Boleng</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="hama2">Hama 2</label>
                                                <select name="hama2" id="hama2" class="form-control">
                                                    <option value="">Pilih Hama 2</option>
                                                    <option value='Aphid'>Aphid</option>
                                                    <option value='Diaphorina citri'>Diaphorina citri</option>
                                                    <option value='Lalat rimpang'>Lalat rimpang</option>
                                                    <option value='Mealbugs'>Mealbugs</option>
                                                    <option value='Mite'>Mite</option>
                                                    <option value='Nematoda'>Nematoda</option>
                                                    <option value='Nematoda sista kuning'>Nematoda sista kuning</option>
                                                    <option value='Pentalonia nigrohervosa'>Pentalonia nigrohervosa</option>
                                                    <option value='Lalat / Serangga penggerek'>Lalat / Serangga penggerek</option>
                                                    <option value='Wereng Batang Coklat'>Wereng Batang Coklat</option>
                                                    <option value='Kerusakan Mekanis'>Kerusakan Mekanis</option>
                                                    <option value='Penggerek Batang'>Penggerek Batang</option>
                                                    <option value='Boleng'>Boleng</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="hama3">Hama 3</label>
                                                <select name="hama3" id="hama3" class="form-control">
                                                    <option value="">Pilih Hama 3</option>
                                                    <option value='Aphid'>Aphid</option>
                                                    <option value='Diaphorina citri'>Diaphorina citri</option>
                                                    <option value='Lalat rimpang'>Lalat rimpang</option>
                                                    <option value='Mealbugs'>Mealbugs</option>
                                                    <option value='Mite'>Mite</option>
                                                    <option value='Nematoda'>Nematoda</option>
                                                    <option value='Nematoda sista kuning'>Nematoda sista kuning</option>
                                                    <option value='Pentalonia nigrohervosa'>Pentalonia nigrohervosa</option>
                                                    <option value='Lalat / Serangga penggerek'>Lalat / Serangga penggerek</option>
                                                    <option value='Wereng Batang Coklat'>Wereng Batang Coklat</option>
                                                    <option value='Kerusakan Mekanis'>Kerusakan Mekanis</option>
                                                    <option value='Penggerek Batang'>Penggerek Batang</option>
                                                    <option value='Boleng'>Boleng</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="penyakit1">Penyakit 1</label>
                                                <select name="penyakit1" id="penyakit1" class="form-control">
                                                    <option value="">Pilih Penyakit 1</option>
                                                    <option value='Altenaria brassiceae pv. Vesicatoria'>Altenaria brassiceae pv. Vesicatoria</option>
                                                    <option value='Altenaria brassisicola pv. Vesicatoria'>Altenaria brassisicola pv. Vesicatoria</option>
                                                    <option value='Altenaria porii'>Altenaria porii</option>
                                                    <option value='Bakteri'>Bakteri</option>
                                                    <option value='Botritis alii'>Botritis alii</option>
                                                    <option value='Bunchy Top Virus'>Bunchy Top Virus</option>
                                                    <option value='Banana Streak Virus'>Banana Streak Virus</option>
                                                    <option value='Busuk umbi'>Busuk umbi</option>
                                                    <option value='Cendawan'>Cendawan</option>
                                                    <option value='Colletotricum capsici'>Colletotricum capsici</option>
                                                    <option value='Colletotricum gloeosporoides'>Colletotricum gloeosporoides</option>
                                                    <option value='Colletotricum legenarium'>Colletotricum legenarium</option>
                                                    <option value='Colletotricum lindemuthianum'>Colletotricum lindemuthianum</option>
                                                    <option value='CMAV'>CMAV</option>
                                                    <option value='Cucumber mosaic Virus'>Cucumber mosaic Virus</option>
                                                    <option value='Cytrus floem degeration'>Cytrus floem degeration</option>
                                                    <option value='Cymbidium mozaic virus'>Cymbidium mozaic virus</option>
                                                    <option value='Erwinia carotovora'>Erwinia carotovora</option>
                                                    <option value='Exocortis'>Exocortis</option>
                                                    <option value='Fusarium sp'>Fusarium sp</option>
                                                    <option value='Hawar Daun Bakteri'>Hawar Daun Bakteri</option>
                                                    <option value='Karat daun'>Karat daun</option>
                                                    <option value='Kudis'>Kudis</option>
                                                    <option value='Layu Bakteri'>Layu Bakteri</option>
                                                    <option value='Layu Fusarium'>Layu Fusarium</option>
                                                    <option value='Leak yellow stripe virus'>Leak yellow stripe virus</option>
                                                    <option value='Odontoglossium ring spot virus'>Odontoglossium ring spot virus</option>
                                                    <option value='Onion Yellow Dwarf virus'>Onion Yellow Dwarf virus</option>
                                                    <option value='Phoma spp'>Phoma spp</option>
                                                    <option value='Peronospora destruktor'>Peronospora destruktor</option>
                                                    <option value='Pseudomonas lachrymans'>Pseudomonas lachrymans</option>
                                                    <option value='Phomopsis spp'>Phomopsis spp</option>
                                                    <option value='Psorosis'>Psorosis</option>
                                                    <option value='Phyllostica sp'>Phyllostica sp</option>
                                                    <option value='Pseudomonas syringae'>Pseudomonas syringae</option>
                                                    <option value='Phomopsis vexsans'>Phomopsis vexsans</option>
                                                    <option value='Ralstonia solanacearum'>Ralstonia solanacearum</option>
                                                    <option value='Shallot laten virus'>Shallot laten virus</option>
                                                    <option value='Tatter leaf'>Tatter leaf</option>
                                                    <option value='Tristeza'>Tristeza</option>
                                                    <option value='Virus'>Virus</option>
                                                    <option value='Vein enation'>Vein enation</option>
                                                    <option value='Xanthomonas campestris'>Xanthomonas campestris</option>
                                                    <option value='Xanthomonas campestris pv. Vesicatoria'>Xanthomonas campestris pv. Vesicatoria</option>
                                                    <option value='Xyloporosis'>Xyloporosis</option>
                                                    <option value='Tungro'>Tungro</option>
                                                    <option value='Bulai (Peronosclerospora maydis)'>Bulai (Peronosclerospora maydis)</option>
                                                    <option value='Hawar daun (Helminthosporium turcikum)'>Hawar daun (Helminthosporium turcikum)</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="penyakit2">Penyakit 2</label>
                                                <select name="penyakit2" id="penyakit2" class="form-control">
                                                    <option value="">Pilih Penyakit 2</option>
                                                    <option value='Altenaria brassiceae pv. Vesicatoria'>Altenaria brassiceae pv. Vesicatoria</option>
                                                    <option value='Altenaria brassisicola pv. Vesicatoria'>Altenaria brassisicola pv. Vesicatoria</option>
                                                    <option value='Altenaria porii'>Altenaria porii</option>
                                                    <option value='Bakteri'>Bakteri</option>
                                                    <option value='Botritis alii'>Botritis alii</option>
                                                    <option value='Bunchy Top Virus'>Bunchy Top Virus</option>
                                                    <option value='Banana Streak Virus'>Banana Streak Virus</option>
                                                    <option value='Busuk umbi'>Busuk umbi</option>
                                                    <option value='Cendawan'>Cendawan</option>
                                                    <option value='Colletotricum capsici'>Colletotricum capsici</option>
                                                    <option value='Colletotricum gloeosporoides'>Colletotricum gloeosporoides</option>
                                                    <option value='Colletotricum legenarium'>Colletotricum legenarium</option>
                                                    <option value='Colletotricum lindemuthianum'>Colletotricum lindemuthianum</option>
                                                    <option value='CMAV'>CMAV</option>
                                                    <option value='Cucumber mosaic Virus'>Cucumber mosaic Virus</option>
                                                    <option value='Cytrus floem degeration'>Cytrus floem degeration</option>
                                                    <option value='Cymbidium mozaic virus'>Cymbidium mozaic virus</option>
                                                    <option value='Erwinia carotovora'>Erwinia carotovora</option>
                                                    <option value='Exocortis'>Exocortis</option>
                                                    <option value='Fusarium sp'>Fusarium sp</option>
                                                    <option value='Hawar Daun Bakteri'>Hawar Daun Bakteri</option>
                                                    <option value='Karat daun'>Karat daun</option>
                                                    <option value='Kudis'>Kudis</option>
                                                    <option value='Layu Bakteri'>Layu Bakteri</option>
                                                    <option value='Layu Fusarium'>Layu Fusarium</option>
                                                    <option value='Leak yellow stripe virus'>Leak yellow stripe virus</option>
                                                    <option value='Odontoglossium ring spot virus'>Odontoglossium ring spot virus</option>
                                                    <option value='Onion Yellow Dwarf virus'>Onion Yellow Dwarf virus</option>
                                                    <option value='Phoma spp'>Phoma spp</option>
                                                    <option value='Peronospora destruktor'>Peronospora destruktor</option>
                                                    <option value='Pseudomonas lachrymans'>Pseudomonas lachrymans</option>
                                                    <option value='Phomopsis spp'>Phomopsis spp</option>
                                                    <option value='Psorosis'>Psorosis</option>
                                                    <option value='Phyllostica sp'>Phyllostica sp</option>
                                                    <option value='Pseudomonas syringae'>Pseudomonas syringae</option>
                                                    <option value='Phomopsis vexsans'>Phomopsis vexsans</option>
                                                    <option value='Ralstonia solanacearum'>Ralstonia solanacearum</option>
                                                    <option value='Shallot laten virus'>Shallot laten virus</option>
                                                    <option value='Tatter leaf'>Tatter leaf</option>
                                                    <option value='Tristeza'>Tristeza</option>
                                                    <option value='Virus'>Virus</option>
                                                    <option value='Vein enation'>Vein enation</option>
                                                    <option value='Xanthomonas campestris'>Xanthomonas campestris</option>
                                                    <option value='Xanthomonas campestris pv. Vesicatoria'>Xanthomonas campestris pv. Vesicatoria</option>
                                                    <option value='Xyloporosis'>Xyloporosis</option>
                                                    <option value='Tungro'>Tungro</option>
                                                    <option value='Bulai (Peronosclerospora maydis)'>Bulai (Peronosclerospora maydis)</option>
                                                    <option value='Hawar daun (Helminthosporium turcikum)'>Hawar daun (Helminthosporium turcikum)</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="penyakit3">Penyakit 3</label>
                                                <select name="penyakit3" id="penyakit3" class="form-control">
                                                    <option value="">Pilih Penyakit 3</option>
                                                    <option value='Altenaria brassiceae pv. Vesicatoria'>Altenaria brassiceae pv. Vesicatoria</option>
                                                    <option value='Altenaria brassisicola pv. Vesicatoria'>Altenaria brassisicola pv. Vesicatoria</option>
                                                    <option value='Altenaria porii'>Altenaria porii</option>
                                                    <option value='Bakteri'>Bakteri</option>
                                                    <option value='Botritis alii'>Botritis alii</option>
                                                    <option value='Bunchy Top Virus'>Bunchy Top Virus</option>
                                                    <option value='Banana Streak Virus'>Banana Streak Virus</option>
                                                    <option value='Busuk umbi'>Busuk umbi</option>
                                                    <option value='Cendawan'>Cendawan</option>
                                                    <option value='Colletotricum capsici'>Colletotricum capsici</option>
                                                    <option value='Colletotricum gloeosporoides'>Colletotricum gloeosporoides</option>
                                                    <option value='Colletotricum legenarium'>Colletotricum legenarium</option>
                                                    <option value='Colletotricum lindemuthianum'>Colletotricum lindemuthianum</option>
                                                    <option value='CMAV'>CMAV</option>
                                                    <option value='Cucumber mosaic Virus'>Cucumber mosaic Virus</option>
                                                    <option value='Cytrus floem degeration'>Cytrus floem degeration</option>
                                                    <option value='Cymbidium mozaic virus'>Cymbidium mozaic virus</option>
                                                    <option value='Erwinia carotovora'>Erwinia carotovora</option>
                                                    <option value='Exocortis'>Exocortis</option>
                                                    <option value='Fusarium sp'>Fusarium sp</option>
                                                    <option value='Hawar Daun Bakteri'>Hawar Daun Bakteri</option>
                                                    <option value='Karat daun'>Karat daun</option>
                                                    <option value='Kudis'>Kudis</option>
                                                    <option value='Layu Bakteri'>Layu Bakteri</option>
                                                    <option value='Layu Fusarium'>Layu Fusarium</option>
                                                    <option value='Leak yellow stripe virus'>Leak yellow stripe virus</option>
                                                    <option value='Odontoglossium ring spot virus'>Odontoglossium ring spot virus</option>
                                                    <option value='Onion Yellow Dwarf virus'>Onion Yellow Dwarf virus</option>
                                                    <option value='Phoma spp'>Phoma spp</option>
                                                    <option value='Peronospora destruktor'>Peronospora destruktor</option>
                                                    <option value='Pseudomonas lachrymans'>Pseudomonas lachrymans</option>
                                                    <option value='Phomopsis spp'>Phomopsis spp</option>
                                                    <option value='Psorosis'>Psorosis</option>
                                                    <option value='Phyllostica sp'>Phyllostica sp</option>
                                                    <option value='Pseudomonas syringae'>Pseudomonas syringae</option>
                                                    <option value='Phomopsis vexsans'>Phomopsis vexsans</option>
                                                    <option value='Ralstonia solanacearum'>Ralstonia solanacearum</option>
                                                    <option value='Shallot laten virus'>Shallot laten virus</option>
                                                    <option value='Tatter leaf'>Tatter leaf</option>
                                                    <option value='Tristeza'>Tristeza</option>
                                                    <option value='Virus'>Virus</option>
                                                    <option value='Vein enation'>Vein enation</option>
                                                    <option value='Xanthomonas campestris'>Xanthomonas campestris</option>
                                                    <option value='Xanthomonas campestris pv. Vesicatoria'>Xanthomonas campestris pv. Vesicatoria</option>
                                                    <option value='Xyloporosis'>Xyloporosis</option>
                                                    <option value='Tungro'>Tungro</option>
                                                    <option value='Bulai (Peronosclerospora maydis)'>Bulai (Peronosclerospora maydis)</option>
                                                    <option value='Hawar daun (Helminthosporium turcikum)'>Hawar daun (Helminthosporium turcikum)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== KESIMPULAN FASE ===================== -->
                        <div id="kesimpulan_fase">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Kesimpulan Fase</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Kesimpulan Fase Vegetatif <span class="text-danger">*</span></label>
                                        <div class="radio-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="kesimpulan_fase_2" name="kesimpulan_fase" value="2">
                                                <label for="kesimpulan_fase_2" class="custom-control-label">Memenuhi Syarat / Tidak Memenuhi Syarat *)</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="kesimpulan_fase_1" name="kesimpulan_fase" value="1" checked>
                                                <label for="kesimpulan_fase_1" class="custom-control-label">Memenuhi Syarat Areal Sertifikasi Benih</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="kesimpulan_fase_0" name="kesimpulan_fase" value="0">
                                                <label for="kesimpulan_fase_0" class="custom-control-label">Tidak Memenuhi Syarat Areal Sertifikasi Benih</label>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id_vegetatif" value="">
                                    <input type="hidden" name="id_permohonan" value="{{ $id ?? 105271 }}">
                                    <input type="hidden" name="kode_fase" value="6">
                                    <input type="hidden" name="nama_fase" value="Vegetatif">

                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save mr-1"></i> Simpan Data
                                        </button>
                                        <button type="reset" class="btn btn-secondary">
                                            <i class="fas fa-undo mr-1"></i> Reset
                                        </button>
                                    </div>
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

@section("footer")
<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
$(function () {
    // Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });
});

function dapatkan_alamat(){
    var prp = $("#nama_produsen").val();
    $.ajax({
        url: "{{ url('') }}/admin/sertifikasi/pengajuan/dapatkan_alamat_produsen",
        global: false,
        type: "POST",
        async: false,
        dataType: "html",
        data: "id_produsen="+ prp,
        success: function (response) {
            document.form_edit_fase_vegetatif.alamat_produsen.value = response;
        }
    });
    return false;
}

function hapus_tanggal_tumbuh(){
    document.form_edit_fase_vegetatif.tgl_vegetatif.value = '';
    document.form_edit_fase_vegetatif.bln_vegetatif.value = '';
    document.form_edit_fase_vegetatif.thn_vegetatif.value = '';
}

function isInteger(s){
    var p = s.value.toString();
    for (var i = 0; i < p.length; i++){
        var c = p.charAt(i);
        if (isNaN(c)) {
            alert("Harap masukan Angka");
            s.value="";
            return false;
        }
    }
    return true;
}

function cekTotal(s, jenis){
    if (jenis == 'b')
        var tot = document.form_edit_fase_vegetatif.sb_total.value;
    if (jenis == 'j')
        var tot = document.form_edit_fase_vegetatif.sj_total.value;

    if (tot == ''){
        alert('Harap mengisi nilai sample lebih dahulu');
        s.value="";
        return false;
    }
    else{
        if (isNaN(parseFloat(s.value.toString()))) {
            alert("Harap masukan Angka");
            s.value="";
            return false;
        }
    }
    return true;
}

function sum_total_sb(){
    if(document.form_edit_fase_vegetatif.pops_betina.value == ''){
        alert('Populasi Pemeriksaan Kosong !\nTidak dapat melakukan perhitungan CVL');
        document.form_edit_fase_vegetatif.sb1.value='';
        document.form_edit_fase_vegetatif.sb2.value='';
        document.form_edit_fase_vegetatif.sb3.value='';
        document.form_edit_fase_vegetatif.sb4.value='';
        document.form_edit_fase_vegetatif.sb5.value='';
        document.form_edit_fase_vegetatif.sb6.value='';
        document.form_edit_fase_vegetatif.sb7.value='';
        document.form_edit_fase_vegetatif.sb8.value='';
        document.form_edit_fase_vegetatif.sb9.value='';
        document.form_edit_fase_vegetatif.sb10.value='';
        document.form_edit_fase_vegetatif.sb11.value='';
        document.form_edit_fase_vegetatif.sb12.value='';
        document.form_edit_fase_vegetatif.sb13.value='';
        document.form_edit_fase_vegetatif.sb14.value='';
        document.form_edit_fase_vegetatif.sb15.value='';
        document.form_edit_fase_vegetatif.sb16.value='';
    }else{
        var populasi = 100/parseInt(document.form_edit_fase_vegetatif.pops_betina.value);
        var p1 = parseInt(document.form_edit_fase_vegetatif.sb1.value==''?0:document.form_edit_fase_vegetatif.sb1.value);
        var p2 = parseInt(document.form_edit_fase_vegetatif.sb2.value==''?0:document.form_edit_fase_vegetatif.sb2.value);
        var p3 = parseInt(document.form_edit_fase_vegetatif.sb3.value==''?0:document.form_edit_fase_vegetatif.sb3.value);
        var p4 = parseInt(document.form_edit_fase_vegetatif.sb4.value==''?0:document.form_edit_fase_vegetatif.sb4.value);
        var p5 = parseInt(document.form_edit_fase_vegetatif.sb5.value==''?0:document.form_edit_fase_vegetatif.sb5.value);
        var p6 = parseInt(document.form_edit_fase_vegetatif.sb6.value==''?0:document.form_edit_fase_vegetatif.sb6.value);
        var p7 = parseInt(document.form_edit_fase_vegetatif.sb7.value==''?0:document.form_edit_fase_vegetatif.sb7.value);
        var p8 = parseInt(document.form_edit_fase_vegetatif.sb8.value==''?0:document.form_edit_fase_vegetatif.sb8.value);
        var p9 = parseInt(document.form_edit_fase_vegetatif.sb9.value==''?0:document.form_edit_fase_vegetatif.sb9.value);
        var p10 = parseInt(document.form_edit_fase_vegetatif.sb10.value==''?0:document.form_edit_fase_vegetatif.sb10.value);
        var p11 = parseInt(document.form_edit_fase_vegetatif.sb11.value==''?0:document.form_edit_fase_vegetatif.sb11.value);
        var p12 = parseInt(document.form_edit_fase_vegetatif.sb12.value==''?0:document.form_edit_fase_vegetatif.sb12.value);
        var p13 = parseInt(document.form_edit_fase_vegetatif.sb13.value==''?0:document.form_edit_fase_vegetatif.sb13.value);
        var p14 = parseInt(document.form_edit_fase_vegetatif.sb14.value==''?0:document.form_edit_fase_vegetatif.sb14.value);
        var p15 = parseInt(document.form_edit_fase_vegetatif.sb15.value==''?0:document.form_edit_fase_vegetatif.sb15.value);
        var p16 = parseInt(document.form_edit_fase_vegetatif.sb16.value==''?0:document.form_edit_fase_vegetatif.sb16.value);

        var digit_counter = 0;
        if(document.form_edit_fase_vegetatif.sb1.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sb2.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sb3.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sb4.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sb5.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sb6.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sb7.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sb8.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sb9.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sb10.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sb11.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sb12.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sb13.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sb14.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sb15.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sb16.value != '' )digit_counter = digit_counter+1;
        var rata_sample = (p1+p2+p3+p4+p5+p6+p7+p8+p9+p10+p11+p12+p13+p14+p15+p16)/digit_counter;
        var hasil_penyakit = rata_sample*populasi;
        var result = set_result(hasil_penyakit);
        document.form_edit_fase_vegetatif.sb_total.value = result;
        document.form_edit_fase_vegetatif.jumlah_titik_contoh_betina.value = digit_counter;
    }
}
sum_total_sb();

function sum_total_sj(){
    if(document.form_edit_fase_vegetatif.pops_jantan.value == ''){
        alert('Populasi Pemeriksaan Jantan Kosong !\nTidak dapat melakukan perhitungan CVL');
        document.form_edit_fase_vegetatif.sj1.value='';
        document.form_edit_fase_vegetatif.sj2.value='';
        document.form_edit_fase_vegetatif.sj3.value='';
        document.form_edit_fase_vegetatif.sj4.value='';
        document.form_edit_fase_vegetatif.sj5.value='';
        document.form_edit_fase_vegetatif.sj6.value='';
        document.form_edit_fase_vegetatif.sj7.value='';
        document.form_edit_fase_vegetatif.sj8.value='';
        document.form_edit_fase_vegetatif.sj9.value='';
        document.form_edit_fase_vegetatif.sj10.value='';
        document.form_edit_fase_vegetatif.sj11.value='';
        document.form_edit_fase_vegetatif.sj12.value='';
        document.form_edit_fase_vegetatif.sj13.value='';
        document.form_edit_fase_vegetatif.sj14.value='';
        document.form_edit_fase_vegetatif.sj15.value='';
        document.form_edit_fase_vegetatif.sj16.value='';
    }
    else{
        var populasi = 100/parseInt(document.form_edit_fase_vegetatif.pops_jantan.value);
        var p1 = parseInt(document.form_edit_fase_vegetatif.sj1.value==''?0:document.form_edit_fase_vegetatif.sj1.value);
        var p2 = parseInt(document.form_edit_fase_vegetatif.sj2.value==''?0:document.form_edit_fase_vegetatif.sj2.value);
        var p3 = parseInt(document.form_edit_fase_vegetatif.sj3.value==''?0:document.form_edit_fase_vegetatif.sj3.value);
        var p4 = parseInt(document.form_edit_fase_vegetatif.sj4.value==''?0:document.form_edit_fase_vegetatif.sj4.value);
        var p5 = parseInt(document.form_edit_fase_vegetatif.sj5.value==''?0:document.form_edit_fase_vegetatif.sj5.value);
        var p6 = parseInt(document.form_edit_fase_vegetatif.sj6.value==''?0:document.form_edit_fase_vegetatif.sj6.value);
        var p7 = parseInt(document.form_edit_fase_vegetatif.sj7.value==''?0:document.form_edit_fase_vegetatif.sj7.value);
        var p8 = parseInt(document.form_edit_fase_vegetatif.sj8.value==''?0:document.form_edit_fase_vegetatif.sj8.value);
        var p9 = parseInt(document.form_edit_fase_vegetatif.sj9.value==''?0:document.form_edit_fase_vegetatif.sj9.value);
        var p10 = parseInt(document.form_edit_fase_vegetatif.sj10.value==''?0:document.form_edit_fase_vegetatif.sj10.value);
        var p11 = parseInt(document.form_edit_fase_vegetatif.sj11.value==''?0:document.form_edit_fase_vegetatif.sj11.value);
        var p12 = parseInt(document.form_edit_fase_vegetatif.sj12.value==''?0:document.form_edit_fase_vegetatif.sj12.value);
        var p13 = parseInt(document.form_edit_fase_vegetatif.sj13.value==''?0:document.form_edit_fase_vegetatif.sj13.value);
        var p14 = parseInt(document.form_edit_fase_vegetatif.sj14.value==''?0:document.form_edit_fase_vegetatif.sj14.value);
        var p15 = parseInt(document.form_edit_fase_vegetatif.sj15.value==''?0:document.form_edit_fase_vegetatif.sj15.value);
        var p16 = parseInt(document.form_edit_fase_vegetatif.sj16.value==''?0:document.form_edit_fase_vegetatif.sj16.value);

        var digit_counter = 0;
        if(document.form_edit_fase_vegetatif.sj1.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sj2.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sj3.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sj4.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sj5.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sj6.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sj7.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sj8.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sj9.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sj10.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sj11.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sj12.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sj13.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sj14.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sj15.value != '' )digit_counter = digit_counter+1;
        if(document.form_edit_fase_vegetatif.sj16.value != '' )digit_counter = digit_counter+1;
        var rata_sample = (p1+p2+p3+p4+p5+p6+p7+p8+p9+p10+p11+p12+p13+p14+p15+p16)/digit_counter;
        var hasil_sj = rata_sample*populasi;
        var result = set_result(hasil_sj);
        document.form_edit_fase_vegetatif.sj_total.value = result;
        document.form_edit_fase_vegetatif.jumlah_titik_contoh_jantan.value = digit_counter;
    }
}
sum_total_sj();

function set_result(rata_sample){
    result = Number(rata_sample).toFixed(2);
    return result;
}
</script>
@endsection</