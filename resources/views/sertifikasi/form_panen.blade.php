@extends("template.t_admin")

@section("title", "Fase Panen - Sertifikasi")

@section("header")
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
    /* Overall layout neatness */
    #panenContent .card { margin-bottom: 1.5rem; }
    #panenContent .form-group { margin-bottom: 1.1rem; }
</style>
@endsection

@section("content")
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Fase Panen (Jenis Tanaman Hibrida)</h3>
                <div class="card-tools">
                    <a href="{{ url('') }}/admin/sertifikasi/laporan_lapangan_hibrida/cetak/{{ $id ?? 105271 }}/16/1"
                       class="btn btn-sm btn-outline-secondary" target="_blank">
                        <i class="fas fa-print mr-1"></i> Print Laporan Lapangan
                    </a>
                </div>
            </div>
            <div class="card-body">

                @include('sertifikasi.partials.header_fase', ['active_fase' => 'panen', 'id_permohonan' => $id ?? 105271])

                <form action="{{ url('') }}/admin/sertifikasi/pengajuan/update" method="post" name="form_edit_fase_panen" id="form_edit_fase_panen">
                    @csrf

                    <div id="panenContent">

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
                                                    <td class="font-weight-bold">Kabupaten (Kode)</td>
                                                    <td>: Malang (07)</td>
                                                    <td class="font-weight-bold">Tanggal Rencana Tanam</td>
                                                    <td>: 14-08-2026</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== FASE PANEN ===================== -->
                        <div id="fase_panen">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Fase Panen</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="desc">Tanggal Pemeriksaan Panen <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="tanggal_pemeriksaan_panen" value="{{ old('tanggal_pemeriksaan_panen') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="desc">Tanggal Laporan <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="tgl_laporan" value="{{ old('tgl_laporan') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="desc">Pengawas Benih Lapangan <span class="text-danger">*</span></label>
                                        <select name="nama_pegawai" id="nama_pegawai" class="form-control select2">
                                            <option value="0">-- Pilih Pegawai --</option>
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
                                                <select name="nama_produsen" id="nama_produsen" class="form-control select2" onchange="dapatkan_alamat()">
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
                                                <label for="alamat_produsen">Alamat Produsen</label>
                                                <textarea class="form-control" name="alamat_produsen" id="alamat_produsen" rows="3" readonly="">{{ old('alamat_produsen') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== PEMERIKSAAN PERALATAN ===================== -->
                        <div id="pemeriksaan_peralatan">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pemeriksaan Peralatan Fase Panen</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="desc">Sabit <span class="text-danger">*</span></label>
                                                <select name="sabit" id="sabit" class="form-control">
                                                    <option value="0">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                    <option value="1">Tidak Memenuhi Syarat</option>
                                                    <option value="2" selected="">Memenuhi Syarat</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Timbangan <span class="text-danger">*</span></label>
                                                <select name="timbangan" id="timbangan" class="form-control">
                                                    <option value="0">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                    <option value="1">Tidak Memenuhi Syarat</option>
                                                    <option value="2" selected="">Memenuhi Syarat</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Alat Perontok <span class="text-danger">*</span></label>
                                                <select name="alat_perontok" id="alat_perontok" class="form-control">
                                                    <option value="0">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                    <option value="1">Tidak Memenuhi Syarat</option>
                                                    <option value="2" selected="">Memenuhi Syarat</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="desc">Karung Goni <span class="text-danger">*</span></label>
                                                <select name="karung_goni" id="karung_goni" class="form-control">
                                                    <option value="0">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                    <option value="1">Tidak Memenuhi Syarat</option>
                                                    <option value="2" selected="">Memenuhi Syarat</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Identitas Karung <span class="text-danger">*</span></label>
                                                <select name="identitas_karung" id="identitas_karung" class="form-control">
                                                    <option value="0">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                    <option value="1">Tidak Memenuhi Syarat</option>
                                                    <option value="2" selected="">Memenuhi Syarat</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== PENGAWASAN PANEN ===================== -->
                        <div id="pengawasan_panen">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pengawasan Panen</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="desc">Tanggal Panen Awal <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="tanggal_awal_panen" id="tanggal_awal_panen" value="{{ old('tanggal_awal_panen') }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Tanggal Panen Akhir <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="tanggal_akhir_panen" id="tanggal_akhir_panen" value="{{ old('tanggal_akhir_panen') }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Lama Panen <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="lama_panen" id="lama_panen" value="{{ old('lama_panen') }}" readonly=""> Hari <i>(otomatis)</i>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Umur Panen <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="umur_panen" id="umur_panen" value="{{ old('umur_panen') }}" readonly=""> Hari <i>(otomatis)</i>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Cuaca Fase Panen <span class="text-danger">*</span></label>
                                                <select name="pilihan_cuaca" id="pilihan_cuaca" class="form-control">
                                                    <option value="0">Cerah / Mendung / Hujan *)</option>
                                                    <option value="1">Cerah</option>
                                                    <option value="2">Mendung</option>
                                                    <option value="3">Hujan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="desc">Jumlah Panen <span class="text-danger">*</span> (Angka, contoh: 1000)</label>
                                                <input type="text" class="form-control" name="jumlah_panen" value="{{ old('jumlah_panen') }}">
                                                <input type="text" class="form-control" name="satuan_jumlah_panen" value="Kilogram" disabled="">
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Catatan Fase Panen</label>
                                                <textarea class="form-control" name="ket_panen" rows="5">{{ old('ket_panen') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="desc">Lokasi Pengolahan</label>
                                                <select name="LOKASI_OLAH" class="form-control">
                                                    <option value="">Pilih lokasi Pengolahan</option>
                                                    <option value="1">Surabaya</option>
                                                    <option value="2">Sidoarjo</option>
                                                    <option value="3">Jombang</option>
                                                    <option value="4">Gresik</option>
                                                    <option value="5">Lamongan</option>
                                                    <option value="6">Bojonegoro</option>
                                                    <option value="7">Tuban</option>
                                                    <option value="8">Bangkalan</option>
                                                    <option value="9">Sampang</option>
                                                    <option value="10">Pamekasan</option>
                                                    <option value="11">Sumenep</option>
                                                    <option value="12">Madiun</option>
                                                    <option value="13">Kota Madiun</option>
                                                    <option value="14">Ngawi</option>
                                                    <option value="15">Magetan</option>
                                                    <option value="16">Ponorogo</option>
                                                    <option value="17">Pacitan</option>
                                                    <option value="18">Kediri</option>
                                                    <option value="19">Kota Kediri</option>
                                                    <option value="20">Blitar</option>
                                                    <option value="21">Tulungagung</option>
                                                    <option value="22">Trenggalek</option>
                                                    <option value="23">Nganjuk</option>
                                                    <option value="24">Malang</option>
                                                    <option value="25">Kota Malang</option>
                                                    <option value="26">Kota Batu</option>
                                                    <option value="27">Pasuruan</option>
                                                    <option value="28">Kota Pasuruan</option>
                                                    <option value="29">Mojokerto</option>
                                                    <option value="30">Kota Mojokerto</option>
                                                    <option value="31">Probolinggo</option>
                                                    <option value="32">Kota Probolinggo</option>
                                                    <option value="33">Jember</option>
                                                    <option value="34">Lumajang</option>
                                                    <option value="35">Bondowoso</option>
                                                    <option value="36">Banyuwangi</option>
                                                    <option value="37">Situbondo</option>
                                                    <option value="38">Kota Blitar</option>
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
                                    <h3 class="card-title">Kesimpulan Fase <span class="text-danger">*</span></h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Kesimpulan Fase Panen <span class="text-danger">*</span></label>
                                        <div class="radio-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="kesimpulan_fase_2" name="kesimpulan_fase" value="2">
                                                <label for="kesimpulan_fase_2" class="custom-control-label">Memenuhi Syarat (Lulus) / Tidak Memenuhi Syarat (Tidak Lulus) *)</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="kesimpulan_fase_1" name="kesimpulan_fase" value="1" checked>
                                                <label for="kesimpulan_fase_1" class="custom-control-label">Memenuhi Syarat (Lulus)</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="kesimpulan_fase_0" name="kesimpulan_fase" value="0">
                                                <label for="kesimpulan_fase_0" class="custom-control-label">Tidak Memenuhi Syarat (Tidak Lulus)</label>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id_permohonan" value="{{ $id ?? 105271 }}">
                                    <input type="hidden" name="kode_fase" value="16">
                                    <input type="hidden" name="nama_fase" value="Panen">

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

var date_diff_indays = function(date1, date2) {
    dt1 = new Date(date1);
    dt2 = new Date(date2);
return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 60 * 60 * 24))+1;
}
function hitung_lama_panen(){
    let tanggal_awal_panen=new Date($('#tanggal_awal_panen').val());
    let tanggal_akhir_panen=new Date($('#tanggal_akhir_panen').val());
    $('#lama_panen').val(date_diff_indays(tanggal_awal_panen,tanggal_akhir_panen));
}
function hitung_umur_panen(){
    let tanggal_tanam=new Date('2026-08-21');
    let tanggal_awal_panen=new Date($('#tanggal_awal_panen').val());
    console.log(date_diff_indays(tanggal_tanam,tanggal_awal_panen));
    $('#umur_panen').val(date_diff_indays(tanggal_tanam,tanggal_awal_panen));
}
$('#tanggal_awal_panen').change(function(){
    console.log('trigger awal panen');
    hitung_lama_panen();
    hitung_umur_panen();
});
$('#tanggal_akhir_panen').change(function(){
    hitung_lama_panen();
});
hitung_lama_panen();
    hitung_umur_panen();

function dapatkan_alamat(){
    var prp = $("#nama_produsen").val();
    $.ajax({
            url: "{{ url('') }}/admin/sertifikasi/pengajuan/dapatkan_alamat_produsen/",
            global: false,
            type: "POST",
            async: false,
            dataType: "html",
            data: "id_produsen="+ prp,
            success: function (response) {
                 document.form_edit_fase_panen.alamat_produsen.value = response;
            }
    });
    return false;
}
</script>
@endsection
