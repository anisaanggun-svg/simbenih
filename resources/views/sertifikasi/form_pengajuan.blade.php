@extends("template.t_admin")

@section("title", "Pengajuan Sertifikasi")

@push("header")
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap4-duallistbox/css/bootstrap-duallistbox.min.css') }}">
<style>
    /* Enhanced Tab Styling */
    .nav-tabs {
        border-bottom: 2px solid #dee2e6;
    }
    .nav-tabs .nav-link {
        color: #495057;
        border: none;
        border-bottom: 3px solid transparent;
        border-radius: 0;
        padding: 0.75rem 1.25rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .nav-tabs .nav-link:hover {
        color: #007bff;
        border-bottom-color: #007bff;
        background-color: transparent;
    }
    .nav-tabs .nav-link.active {
        color: #007bff;
        font-weight: 600;
        border-bottom: 3px solid #007bff;
        background-color: transparent;
    }
    .nav-tabs .nav-item {
        margin-bottom: -2px;
    }

    /* Enhanced Phase Navigation */
    .phase-nav {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #dee2e6;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .phase-nav strong {
        color: #495057;
        font-weight: 600;
        margin-right: 0.75rem;
    }
    .phase-nav a {
        color: #495057;
        text-decoration: none;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        display: inline-block;
        margin-right: 0.25rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .phase-nav a:hover {
        background-color: #e3f2fd;
        color: #007bff;
        transform: translateY(-1px);
    }
    .phase-nav a.active {
        background-color: #007bff;
        color: #fff;
        box-shadow: 0 2px 4px rgba(0,123,255,0.3);
    }

    /* Enhanced Fieldset Tab */
    .fieldset-tab {
        border: 1px solid #e3e6f0;
        border-radius: 0.5rem;
        padding: 1.75rem;
        margin-bottom: 1.5rem;
        background-color: #fff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        transition: box-shadow 0.2s ease;
    }
    .fieldset-tab:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .fieldset-tab legend {
        width: auto;
        padding: 0 1rem;
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        border-bottom: none;
        margin-bottom: 1.25rem;
        background-color: #f8f9fa;
        border-radius: 0.375rem;
    }

    /* Enhanced Form Section Title */
    .form-section-title {
        font-size: 1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e3e6f0;
        display: flex;
        align-items: center;
    }
    .form-section-title::before {
        content: '';
        display: inline-block;
        width: 4px;
        height: 1.1rem;
        background-color: #007bff;
        margin-right: 0.75rem;
        border-radius: 2px;
    }

    /* Enhanced Info Box */
    .info-box {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border-left: 4px solid #2196f3;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .info-box .no-induk {
        font-weight: 700;
        color: #1565c0;
        background-color: rgba(255,255,255,0.7);
        padding: 0.15rem 0.5rem;
        border-radius: 0.25rem;
        font-family: 'Courier New', monospace;
        letter-spacing: 0.5px;
    }
    .info-box strong {
        color: #455a64;
    }

    /* Enhanced Tab Content */
    .tab-content {
        padding-top: 1.25rem;
    }

    /* Enhanced Form Groups */
    .form-group {
        margin-bottom: 1.25rem;
    }
    .form-group label {
        font-weight: 500;
        color: #37474f;
        margin-bottom: 0.5rem;
        font-size: 0.9375rem;
    }
    .form-control {
        border: 1px solid #cfd8dc;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.15);
    }
    .form-control[readonly] {
        background-color: #f5f5f5;
        opacity: 1;
    }

    /* Enhanced Input Group */
    .input-group-text {
        background-color: #f8f9fa;
        border-color: #cfd8dc;
        color: #495057;
        font-size: 0.875rem;
    }
    .input-group-text input {
        border: none;
        background: transparent;
        padding: 0;
        font-weight: 500;
        color: #007bff;
    }

    /* Enhanced Select2 */
    .select2-container--bootstrap4 .select2-selection {
        border: 1px solid #cfd8dc;
        border-radius: 0.375rem;
    }

    /* Enhanced Card */
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.5rem rgba(0,0,0,0.05);
        border-radius: 0.5rem;
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e3e6f0;
        padding: 1rem 1.5rem;
    }
    .card-title {
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
    }
    .card-body {
        padding: 1.5rem;
    }
    .card-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #e3e6f0;
        padding: 1rem 1.5rem;
    }

    /* Enhanced Buttons */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        border-radius: 0.375rem;
        transition: all 0.2s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,123,255,0.3);
    }
    .btn-secondary {
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        border-radius: 0.375rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .nav-tabs .nav-link {
            padding: 0.5rem 0.75rem;
            font-size: 0.8125rem;
        }
        .phase-nav a {
            padding: 0.4rem 0.75rem;
            font-size: 0.8125rem;
        }
        .fieldset-tab {
            padding: 1.25rem;
        }
    }
</style>
@endpush

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pengajuan Sertifikasi (Jenis Tanaman Hibrida)</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Info Box -->
                <div class="info-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <div>
                                    <strong>No. Berkas:</strong><br>
                                    <span class="no-induk">TP26.401.0339</span>
                                </div>
                                <div class="vr d-none d-md-block"></div>
                                <div>
                                    <strong>No Induk Lapangan:</strong><br>
                                    <span class="no-induk">JghHI.R.3507120.0911.0339</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-right mt-3 mt-md-0">
                            <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalInputPermohonan">
                                <i class="fas fa-plus mr-1"></i> Input Permohonan Baru
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal Input Permohonan Baru -->
                <div class="modal fade" id="modalInputPermohonan" tabindex="-1" role="dialog" aria-labelledby="modalInputPermohonanLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalInputPermohonanLabel">
                                    <i class="fas fa-file-alt mr-2"></i> Pilih Tipe Form Permohonan
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="tipeFormPermohonan">Tipe Form <span class="text-danger">*</span></label>
                                    <select name="tipe_form" id="tipeFormPermohonan" class="form-control">
                                        <option value="">-- Pilih Tipe Form --</option>
                                        <option value="1">Form Tipe Hibrida</option>
                                        <option value="2">Form Tipe Non Hibrida</option>
                                        <option value="4">Form Tipe Umbi/Rimpang</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    <i class="fas fa-times mr-1"></i> Batal
                                </button>
                                <button type="button" class="btn btn-primary" onclick="pilihTipeForm()">
                                    <i class="fas fa-check mr-1"></i> OK
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                </div>

                <!-- Phase Navigation -->
                <div class="phase-nav">
                    <strong>Fase:</strong>
                    <a href="#" class="active">Pengajuan</a>
                    <a href="#">Pendahuluan</a>
                    <a href="#">Vegetatif</a>
                    <a href="#">Berbunga</a>
                    <a href="#">Berb.Ulangan</a>
                    <a href="#">Masak</a>
                    <a href="#">Panen</a>
                </div>

                <form action="{{ url('') }}/admin/sertifikasi/pengajuan/update" method="POST">
                    @csrf
                    <input type="hidden" name="id_permohonan" value="105271">

                    <!-- Section 1: Nomer Permohonan Sertifikasi -->
                    <div class="fieldset-tab">
                        <legend>Nomer Permohonan Sertifikasi</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NOMER INDUK NASIONAL (Otomatis)</label>
                                    <input type="text" class="form-control" name="nomor_induk" id="no_induk" value="JghHI.R.3507120.0911.0339" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Berkas Sertifikasi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="kode_unik_sertifikasi" id="kode_unik_sertifikasi" value="TP26.401.0339" maxlength="13" onkeyup="uppercase()">
                                </div>
                                <div class="form-group">
                                    <label>Nomor Unik Sertifikasi <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nomer_serti" value="0339" maxlength="4" size="4">
                                        <input type="hidden" name="hide_noSerti" value="0339">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Masa Tanam / Tahun Anggaran <span class="text-danger">*</span></label>
                                    <select name="masa_tebar" id="masa_tebar" class="form-control">
                                        <option value="">-- Pilih Masa Tanam --</option>
                                        @for($y = 2021; $y <= 2029; $y++)
                                        <option value="{{ $y }}" {{ $y == 2026 ? 'selected' : '' }}>{{ $y }}</option>
                                        @endfor
                                    </select>
                                    <input type="hidden" name="hide_tahun" value="2026">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mata Anggaran <span class="text-danger">*</span></label>
                                    <select name="mata_anggaran" id="mata_anggaran" class="form-control">
                                        <option value="">-- Pilih Mata Anggaran --</option>
                                        <option value="1">N - APBN</option>
                                        <option value="2" selected>D - APBD</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Permohonan Sertifikasi <span class="text-danger">*</span></label>
                                    <div class="input-group date" id="tgl_permohonan" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#tgl_permohonan" name="tgl_permohonan" value="10-08-2026">
                                        <div class="input-group-append" data-target="#tgl_permohonan" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Pemohon -->
                    <div class="fieldset-tab">
                        <legend>Pemohon</legend>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Produsen <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="nama_produsen" id="nama_produsen" class="form-control select2" onChange="dapatkan_alamat()">
                                            <option value="0">-- Pilih Produsen --</option>
                                            <option value="2424" selected>LIMAGRAIN AGRICON INDONESIA - PT. - Surabaya - 0911</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Alamat Produsen</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="alamat_produsen" rows="3" readonly>Desa Genteng, Kec. Genteng, Kota Surabaya</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Sertifikasi Untuk -->
                    <div class="fieldset-tab">
                        <legend>Sertifikasi Untuk</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="form-section-title">Data Komoditas</h6>
                                <div class="form-group">
                                    <label>Golongan <span class="text-danger">*</span></label>
                                    <select name="nama_komoditas" id="nama_komoditas" class="form-control" onChange="dapatkan_golongan()">
                                        <option value="0">-- Pilih Golongan Tanaman --</option>
                                        <option value="1" selected>1 - Pangan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kumpulan <span class="text-danger">*</span></label>
                                    <select name="golongan" id="golongan" class="form-control" onChange="dapatkan_jenis_tanaman()">
                                        <option value="0">-- Pilih Kumpulan Tanaman --</option>
                                        <option value="1" selected>SR - Serealia</option>
                                        <option value="2">KCP - Aneka Kacang</option>
                                        <option value="3">UBP - Aneka Umbi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Tanaman <span class="text-danger">*</span></label>
                                    <select name="jenis_tanaman" id="jenis_tanaman" class="form-control" onChange="dapatkan_varietas(); dapatkan_satuan_produk(); dapatkan_satuan_penangkarian();">
                                        <option value="0">-- Pilih Jenis Tanaman --</option>
                                        <option value="7" selected>Jagung Hibrida - Jgh - Hibrida - .</option>
                                        <option value="3">Padi Hibrida - Pdh - Hibrida - Tiga galur</option>
                                        <option value="4">Padi Hibrida - Pdh - Hibrida - CMS</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Varietas <span class="text-danger">*</span></label>
                                    <input type="text" name="varietas_hide" id="varietas_hide" class="form-control" value="4707" size="20">
                                </div>
                                <div class="form-group">
                                    <label>Kelas Benih Aju <span class="text-danger">*</span></label>
                                    <select name="kelas_benih_sertifikat" id="kelas_benih_sertifikat" class="form-control">
                                        <option value="">-- Pilih Kelas Benih --</option>
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
                                    <label>Luas Pertanaman <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="luas_tanam" value="0.15">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Satuan: <input type="text" class="form-control-plaintext" name="satuan_penangkaran" value="Hektare" readonly></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6 class="form-section-title">Jadwal Tebar</h6>
                                <div class="form-group">
                                    <label>Tanggal Tebar Jantan 1 <span class="text-danger">*</span></label>
                                    <div class="input-group date" id="date-1" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#date-1" name="tgl_sbr_jantan_1">
                                        <div class="input-group-append" data-target="#date-1" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Tebar Jantan 2 <span class="text-danger">*</span></label>
                                    <div class="input-group date" id="date-2" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#date-2" name="tgl_sbr_jantan_2">
                                        <div class="input-group-append" data-target="#date-2" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Tebar Jantan 3 <span class="text-danger">*</span></label>
                                    <div class="input-group date" id="date-3" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#date-3" name="tgl_sbr_jantan_3">
                                        <div class="input-group-append" data-target="#date-3" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Tebar Betina <span class="text-danger">*</span></label>
                                    <div class="input-group date" id="date-6" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#date-6" name="tgl_tebar_betina">
                                        <div class="input-group-append" data-target="#date-6" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tanggal Tanam Jantan 1 <span class="text-danger">*</span></label>
                                            <div class="input-group date" id="date-4" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#date-4" name="tgl_tanam_jantan_awal" value="14-08-2026">
                                                <div class="input-group-append" data-target="#date-4" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                                </div>
                                            </div>
                                            <div class="input-group mt-1">
                                                <input type="text" class="form-control" name="lama_tgl" placeholder="Lama">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-secondary" onclick="getTanggal_jantan()">
                                                        <i class="fas fa-calculator"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Tanam Jantan 2 <span class="text-danger">*</span></label>
                                            <div class="input-group date" id="date-52" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#date-52" name="tgl_tanam_jantan_2">
                                                <div class="input-group-append" data-target="#date-52" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Tanam Jantan 3 <span class="text-danger">*</span></label>
                                            <div class="input-group date" id="date-5" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#date-5" name="tgl_tanam_jantan_akhir">
                                                <div class="input-group-append" data-target="#date-5" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Tanam Betina Awal <span class="text-danger">*</span></label>
                                            <div class="input-group date" id="date-7" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#date-7" name="tgl_tanam_betina_awal" value="14-08-2026">
                                                <div class="input-group-append" data-target="#date-7" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                                </div>
                                            </div>
                                            <div class="input-group mt-1">
                                                <input type="text" class="form-control" name="lama_tgl2" placeholder="Lama">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-secondary" onclick="getTanggal_betina()">
                                                        <i class="fas fa-calculator"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Tanam Betina Akhir <span class="text-danger">*</span></label>
                                            <div class="input-group date" id="date-8" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#date-8" name="tgl_tanam_betina_akhir" value="14-08-2026">
                                                <div class="input-group-append" data-target="#date-8" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Lokasi / Letak Areal -->
<div class="fieldset-tab">
    <legend>Lokasi / Letak Areal</legend>
    <div class="row">
        <!-- Kolom 1: Wilayah Administratif -->
        <div class="col-md-4">
            <h6 class="form-section-title">Wilayah Administratif</h6>
            <div class="form-group">
                <label>Blok <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="blok" value="135" maxlength="50">
            </div>
            <div class="form-group">
                <label>Kabupaten <span class="text-danger">*</span></label>
                <select name="nama_kabupaten" id="nama_kabupaten" class="form-control select2" onChange="dapatkan_kecamatan()">
                    <option value="">-- Pilih Kabupaten --</option>
                    <option value="24" selected>Malang-07</option>
                </select>
            </div>
        </div>

        <!-- Kolom 2: Detail Lokasi -->
        <div class="col-md-4">
            <h6 class="form-section-title">Detail Lokasi</h6>
            <div class="form-group">
                <label>Kecamatan <span class="text-danger">*</span></label>
                <input type="text" name="nama_kecamatan_hide" id="nama_kecamatan_hide" class="form-control" value="347" size="20">
            </div>
            <div class="form-group">
                <label>Desa</label>
                <input type="text" class="form-control" name="desa" value="Wonokasian">
            </div>
        </div>

        <!-- Kolom 3: Informasi Tambahan (Opsional: Ditambah field kosong/pendukung agar seimbang) -->
        <div class="col-md-4">
            <h6 class="form-section-title">Informasi Tambahan</h6>
            <div class="form-group">
                <label>Dukuh</label>
                <input type="text" class="form-control" name="dukuh" value="Wonokasian">
            </div>
            <!-- Contoh tambahan jika ingin mengisi kekosongan kolom ke-3 agar simetris -->
            <div class="form-group">
                <label>Kodepos / Keterangan Lain</label>
                <input type="text" class="form-control" name="keterangan_lokasi" placeholder="Opsional">
            </div>
        </div>
    </div>
</div>

                        <!-- Section 5: Sejarah Lapang -->
                        <div class="fieldset-tab">
                            <legend>Sejarah Lapang</legend>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Bero</label>
                                        <div class="col-sm-4">
                                            <select name="bero" id="bero" class="form-control" onchange="toggleBero()">
                                                <option value="0">-- Pilih Bero --</option>
                                                <option value="1" selected>Tidak Ada Bero</option>
                                                <option value="2">Ada Bero</option>
                                            </select>
                                            <input type="text" class="form-control mt-2" name="bulan_bero" readonly style="display: none;" placeholder="Bulan (Angka, contoh: 5)">
                                        </div>
                                        <label class="col-sm-2 col-form-label">Varietas Sebelumnya</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="varietas_sebelumnya" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tanaman Sebelumnya</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="tanaman_sebelumnya" value="Padi">
                                        </div>
                                    </div>
                                    <div class="alert alert-info mt-3">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        <strong>Informasi:</strong> Isi data sejarah lapangan untuk mencatat kondisi lahan sebelumnya.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 6: Asal Benih Sumber -->
                        <div class="fieldset-tab">
                            <legend>Asal Benih Sumber</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="form-section-title">Induk Betina</h6>
                                        <div class="form-group">
                                            <label>Asal Induk Betina <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="asal_betina" value="Surabaya">
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Induk Betina <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="kode_betina" value="SAP 20">
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Induk Betina <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="jumlah_betina" value="3" size="10" maxlength="10">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Satuan: <input type="text" class="form-control-plaintext" name="satuan_betina" value="Kilogram" readonly></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kelas Benih Betina <span class="text-danger">*</span></label>
                                            <select name="kelas_benih_betina" id="kelas_benih_betina" class="form-control">
                                                <option value="">-- Pilih Kelas Benih --</option>
                                                <option value="0">---</option>
                                                <option value="1">NS-N</option>
                                                <option value="2" selected>BS-S</option>
                                                <option value="7">BD-D</option>
                                                <option value="12">BP-P</option>
                                                <option value="13">BP1-P1</option>
                                                <option value="14">BP2-P2</option>
                                                <option value="17">BR-R</option>
                                                <option value="18">BR1-R1</option>
                                                <option value="19">BR2-R2</option>
                                                <option value="20">BR3-R3</option>
                                                <option value="21">BR4-R4</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Produsen Benih <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="produsen_betina" value="PT. LIMAGRAIN AGRICON INDONESIA">
                                        </div>
                                        <div class="form-group">
                                            <label>No Kelompok Benih <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="kelompok_betina" value="003/PS-B/LG/2026">
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Label <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="label_betina" value="3" size="10" maxlength="10">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Lembar</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Catatan</label>
                                            <textarea class="form-control" name="catatan_asal_benih" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <h6 class="form-section-title">Induk Jantan</h6>
                                        <div class="form-group">
                                            <label>Asal Induk Jantan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="asal_jantan" value="Surabaya">
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Induk Jantan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="kode_jantan" value="SAP 21">
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Induk Jantan <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="jumlah_jantan" value="1" size="10" maxlength="10">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Satuan: <input type="text" class="form-control-plaintext" name="satuan_jantan" value="Kilogram" readonly></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kelas Benih Jantan <span class="text-danger">*</span></label>
                                            <select name="kelas_benih_jantan" id="kelas_benih_jantan" class="form-control">
                                                <option value="">-- Pilih Kelas Benih --</option>
                                                <option value="0">---</option>
                                                <option value="1">NS-N</option>
                                                <option value="2" selected>BS-S</option>
                                                <option value="7">BD-D</option>
                                                <option value="12">BP-P</option>
                                                <option value="13">BP1-P1</option>
                                                <option value="14">BP2-P2</option>
                                                <option value="17">BR-R</option>
                                                <option value="18">BR1-R1</option>
                                                <option value="19">BR2-R2</option>
                                                <option value="20">BR3-R3</option>
                                                <option value="21">BR4-R4</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Produsen Benih <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="produsen_jantan" value="PT. LIMAGRAIN AGRICON INDONESIA">
                                        </div>
                                        <div class="form-group">
                                            <label>No Kelompok Benih <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="kelompok_jantan" value="003/PS-J/LG/2026">
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Label <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="label_jantan" value="1" size="10" maxlength="10">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Lembar</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Form Actions -->
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Simpan Data Pengajuan
                                </button>
                                <button type="reset" class="btn btn-secondary ml-2">
                                    <i class="fas fa-undo mr-1"></i> Reset
                                </button>
                            </div>
                            <div class="text-muted small">
                                <i class="fas fa-clock mr-1"></i> Terakhir disimpan: -
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@push("footer")
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap4.min.css') }}">

<script>
function uppercase() {
    var txt = document.getElementById("kode_unik_sertifikasi");
    if (txt) txt.value = txt.value.toUpperCase();
}

function pilihTipeForm() {
    var tipeForm = document.getElementById("tipeFormPermohonan").value;
    if (!tipeForm) {
        alert('Pilih tipe form terlebih dahulu!');
        return false;
    }
    window.location.href = "{{ url('') }}/admin/sertifikasi/pengajuan/tambah?tipe=" + tipeForm;
}

function toggleBero() {
    var bero = document.getElementById("bero");
    var bulanBero = document.querySelector('input[name="bulan_bero"]');
    var varietasSebelumnya = document.querySelector('input[name="varietas_sebelumnya"]');
    var tanamanSebelumnya = document.querySelector('input[name="tanaman_sebelumnya"]');

    if (bero.value == 2) {
        bulanBero.removeAttribute('readonly');
        bulanBero.removeAttribute('disabled');
        varietasSebelumnya.setAttribute('readonly', true);
        varietasSebelumnya.setAttribute('disabled', true);
        tanamanSebelumnya.setAttribute('readonly', true);
        tanamanSebelumnya.setAttribute('disabled', true);
        varietasSebelumnya.value = '';
        tanamanSebelumnya.value = '';
    } else {
        varietasSebelumnya.removeAttribute('readonly');
        varietasSebelumnya.removeAttribute('disabled');
        tanamanSebelumnya.removeAttribute('readonly');
        tanamanSebelumnya.removeAttribute('disabled');
        bulanBero.setAttribute('readonly', true);
        bulanBero.setAttribute('disabled', true);
        bulanBero.value = '';
    }
}

function getTanggal_jantan() {
    var tgl = document.querySelector('input[name="tgl_tanam_jantan_awal"]').value;
    var bln = ''; // Extract from date if needed
    var thn = ''; // Extract from date if needed
    var length = document.querySelector('input[name="lama_tgl"]').value;

    if (tgl && length) {
        // Simple date calculation - implement as needed
        alert('Fitur hitung tanggal akan diimplementasikan');
    }
}

function getTanggal_betina() {
    var tgl = document.querySelector('input[name="tgl_tanam_betina_awal"]').value;
    var length = document.querySelector('input[name="lama_tgl2"]').value;

    if (tgl && length) {
        alert('Fitur hitung tanggal akan diimplementasikan');
    }
}

function copy_tgl_jantan() {
    var awal = document.querySelector('input[name="tgl_tanam_jantan_awal"]').value;
    document.querySelector('input[name="tgl_tanam_jantan_akhir"]').value = awal;
    document.querySelector('input[name="tgl_tanam_jantan_2"]').value = awal;
}

function copy_tgl_betina() {
    var awal = document.querySelector('input[name="tgl_tanam_betina_awal"]').value;
    document.querySelector('input[name="tgl_tanam_betina_akhir"]').value = awal;
}

function dapatkan_alamat() {
    var prp = document.getElementById("nama_produsen").value;
    // AJAX call to get address
    console.log('Get alamat for produsen: ' + prp);
}

function dapatkan_golongan() {
    var prp = document.getElementById("nama_komoditas").value;
    // AJAX call
    console.log('Get golongan for komoditas: ' + prp);
}

function dapatkan_jenis_tanaman() {
    var prp = document.getElementById("golongan").value;
    // AJAX call
    console.log('Get jenis tanaman for golongan: ' + prp);
}

function dapatkan_varietas() {
    // AJAX call
    console.log('Get varietas');
}

function dapatkan_satuan_produk() {
    var prp = document.getElementById("jenis_tanaman").value;
    // AJAX call
    console.log('Get satuan produk: ' + prp);
}

function dapatkan_satuan_penangkarian() {
    var prp = document.getElementById("jenis_tanaman").value;
    // AJAX call
    console.log('Get satuan penangkarian: ' + prp);
}

function dapatkan_kecamatan() {
    var prp = document.getElementById("nama_kabupaten").value;
    // AJAX call
    console.log('Get kecamatan for kabupaten: ' + prp);
}

$(function() {
    // Initialize datetime pickers
    $('.datetimepicker-input').datetimepicker({
        format: 'DD-MM-YYYY',
        showClear: true,
        showClose: true
    });

    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });
});
</script>

<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap4.min.js') }}"></script>
@endpush
