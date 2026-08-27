@extends("template.t_admin")

@section("title", "Fase Pendahuluan - Sertifikasi")

@section("header")
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
    /* Split date fields (Pendahuluan) */
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

    /* Radio group spacing */
    .radio-group .custom-control { margin-bottom: .35rem; }
</style>
@endsection

@section("content")
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Fase Pendahuluan (Jenis Tanaman Hibrida)
                </h3>
                <div class="card-tools">
                    <a href="{{ url('') }}/admin/sertifikasi/laporan_pendahuluan/cetak/{{ $id ?? 105271 }}/1/1"
                       class="btn btn-sm btn-outline-secondary" target="_blank">
                        <i class="fas fa-print mr-1"></i> Print Laporan Pendahuluan
                    </a>
                </div>
            </div>
            <div class="card-body">

                @include('sertifikasi.partials.header_fase', ['active_fase' => 'pendahuluan', 'id_permohonan' => $id ?? 105271])

                <form action="{{ url('') }}/admin/sertifikasi/pengajuan/update" method="post" name="form_edit_fase_pendahuluan" id="form_edit_fase_pendahuluan">
                    @csrf

                    <!-- Single-page layout: all sections displayed sequentially -->

                    <div id="pendahuluanContent">

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

                        <!-- ===================== PENDAHULUAN ===================== -->
                        <div id="pendahuluan">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pendahuluan</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tgl_pendahuluan">Tanggal Pendahuluan <span class="text-danger">*</span></label>
                                                <div class="split-date-wrap" id="newline-wrapper">
                                                    <input type="text" class="form-control w2em" id="date-21-dd" readonly name="tgl_pendahuluan" maxlength="2" value="" placeholder="DD"/>-
                                                    <input type="text" class="form-control w2em" id="date-21-mm" readonly name="bln_pendahuluan" maxlength="2" value="" placeholder="MM"/>-
                                                    <input type="text" class="form-control w4em highlight-days-67 split-date" readonly id="date-21" name="thn_pendahuluan" maxlength="4" value="" placeholder="YYYY"/>
                                                    <i class="fas fa-eraser text-danger" style="cursor:pointer; margin-left:6px;" onclick="hapus_tanggal_pendahuluan();" title="Hapus Tanggal"></i>
                                                </div>
                                                <small class="form-text text-muted">Format: DD-MM-YYYY</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="luas_lulus_pend">Luas Lulus Pendahuluan <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input autocomplete="off" class="form-control" name="luas_lulus_pend" type="text" size="25" maxlength="25" value="" placeholder="Angka, contoh: 4 atau 3.4 jika desimal"/>
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
                                                <label for="nama_pegawai">Petugas Lapangan <span class="text-danger">*</span></label>
                                                <select name="nama_pegawai" id="nama_pegawai" class="form-control select2">
                                                    <option value="0" selected="selected">-- Pilih Pegawai --</option>
                                                    @isset($pegawai_list)
                                                        @foreach($pegawai_list as $pg)
                                                            <option value="{{ $pg->id }}">{{ $pg->nama }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ket_pendahuluan">Catatan Fase Pendahuluan</label>
                                                <textarea class="form-control" name="ket_pendahuluan" id="ket_pendahuluan" rows="10" placeholder="Masukkan catatan fase pendahuluan..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== HASIL PERIKSA ===================== -->
                        <div id="hasil_periksa">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Hasil Periksa</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kebenaran Letak Areal</label>
                                                <div class="radio-group">
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" id="tentang_penangkaran_2" name="tentang_penangkaran" value="2" checked>
                                                        <label for="tentang_penangkaran_2" class="custom-control-label">Sesuai / Tidak Sesuai *)</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" id="tentang_penangkaran_1" name="tentang_penangkaran" value="1">
                                                        <label for="tentang_penangkaran_1" class="custom-control-label">Sesuai</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" id="tentang_penangkaran_0" name="tentang_penangkaran" value="0">
                                                        <label for="tentang_penangkaran_0" class="custom-control-label">Tidak Sesuai</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Benih Sumber yang digunakan</label>
                                                <div class="radio-group">
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" id="tentang_benih_guna_2" name="tentang_benih_guna" value="2" checked>
                                                        <label for="tentang_benih_guna_2" class="custom-control-label">Sesuai / Tidak Sesuai *)</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" id="tentang_benih_guna_1" name="tentang_benih_guna" value="1">
                                                        <label for="tentang_benih_guna_1" class="custom-control-label">Sesuai</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" id="tentang_benih_guna_0" name="tentang_benih_guna" value="0">
                                                        <label for="tentang_benih_guna_0" class="custom-control-label">Tidak Sesuai</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sejarah Lapangan</label>
                                                <div class="radio-group">
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" id="tentang_sejarah_2" name="tentang_sejarah" value="2" checked>
                                                        <label for="tentang_sejarah_2" class="custom-control-label">Sesuai / Tidak Sesuai *)</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" id="tentang_sejarah_1" name="tentang_sejarah" value="1">
                                                        <label for="tentang_sejarah_1" class="custom-control-label">Sesuai</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" id="tentang_sejarah_0" name="tentang_sejarah" value="0">
                                                        <label for="tentang_sejarah_0" class="custom-control-label">Tidak Sesuai</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Kebenaran Luas Areal</label>
                                                <div class="radio-group">
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" id="tentang_peta_2" name="tentang_peta" value="2" checked>
                                                        <label for="tentang_peta_2" class="custom-control-label">Sesuai / Tidak Sesuai *)</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" id="tentang_peta_1" name="tentang_peta" value="1">
                                                        <label for="tentang_peta_1" class="custom-control-label">Sesuai</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" id="tentang_peta_0" name="tentang_peta" value="0">
                                                        <label for="tentang_peta_0" class="custom-control-label">Tidak Sesuai</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                                <option value="-">-</option>
                                                <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="iso_barat">Isolasi Barat</label>
                                            <select name="iso_barat" id="iso_barat" class="form-control">
                                                <option value="-">-</option>
                                                <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="iso_utara">Isolasi Utara</label>
                                            <select name="iso_utara" id="iso_utara" class="form-control">
                                                <option value="-">-</option>
                                                <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="iso_selatan">Isolasi Selatan</label>
                                            <select name="iso_selatan" id="iso_selatan" class="form-control">
                                                <option value="-">-</option>
                                                <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="isolasi_waktu">Isolasi Waktu</label>
                                            <select name="isolasi_waktu" id="isolasi_waktu" class="form-control">
                                                <option value="-">-</option>
                                                <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="iso_barier">Isolasi Barier</label>
                                            <select name="iso_barier" id="iso_barier" class="form-control">
                                                <option value="-">-</option>
                                                <option value="Memenuhi Syarat / Tidak Memenuhi Syarat *)">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                                                <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                                            </select>
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
                                        <label>Kesimpulan Fase Pendahuluan <span class="text-danger">*</span></label>
                                        <div class="radio-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="kesimpulan_fase_2" name="kesimpulan_fase" value="2" checked>
                                                <label for="kesimpulan_fase_2" class="custom-control-label">Memenuhi Syarat / Tidak Memenuhi Syarat *)</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="kesimpulan_fase_1" name="kesimpulan_fase" value="1">
                                                <label for="kesimpulan_fase_1" class="custom-control-label">Memenuhi Syarat Areal Sertifikasi Benih</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="kesimpulan_fase_0" name="kesimpulan_fase" value="0">
                                                <label for="kesimpulan_fase_0" class="custom-control-label">Tidak Memenuhi Syarat Areal Sertifikasi Benih</label>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id_pendahuluan" value="">
                                    <input type="hidden" name="id_permohonan" value="{{ $id ?? 105271 }}">
                                    <input type="hidden" name="kode_fase" value="1">
                                    <input type="hidden" name="nama_fase" value="Pendahuluan">

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
            document.form_edit_fase_pendahuluan.alamat_produsen.value = response;
        }
    });
    return false;
}

function hapus_tanggal_pendahuluan(){
    document.form_edit_fase_pendahuluan.tgl_pendahuluan.value = '';
    document.form_edit_fase_pendahuluan.bln_pendahuluan.value = '';
    document.form_edit_fase_pendahuluan.thn_pendahuluan.value = '';
}
</script>
@endsection
