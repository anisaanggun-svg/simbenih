@extends("template.t_admin")

@section("title", "Fase Masak - Sertifikasi")

@section("header")
<style>
    #masakContent .card { margin-bottom: 1.5rem; }
    #masakContent .form-group { margin-bottom: 1.1rem; }

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

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .phase-nav a {
            padding: 0.4rem 0.75rem;
            font-size: 0.8125rem;
        }
    }
</style>
@endsection

@section("content")
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Fase Masak (Jenis Tanaman Hibrida)</h3>
            </div>
            <div class="card-body">

                <!-- Info Box -->
                <div class="info-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <strong>No. Berkas:</strong><br>
                                    <span class="no-induk">TP26.401.0339</span>
                                </div>
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
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
                                    <span aria-hidden="true">×</span>
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

                <!-- Phase Navigation -->
                <div class="phase-nav">
                    <strong>Fase:</strong>
                    <a href="{{ url('') }}/admin/sertifikasi/pengajuan/edit/{{ $id ?? 1 }}">Pengajuan</a>
                    <a href="{{ url('') }}/admin/sertifikasi/pengajuan/fase_pendahuluan/{{ $id ?? 1 }}">Pendahuluan</a>
                    <a href="{{ url('') }}/admin/sertifikasi/pengajuan/fase_vegetatif/{{ $id ?? 1 }}">Vegetatif</a>
                    <a href="{{ url('') }}/admin/sertifikasi/pengajuan/fase_berbunga/{{ $id ?? 1 }}">Berbunga</a>
                    <a href="{{ url('') }}/admin/sertifikasi/pengajuan/fase_berbunga_ulangan/{{ $id ?? 1 }}">Berb.Ulangan</a>
                    <a href="{{ url('') }}/admin/sertifikasi/pengajuan/fase_masak/{{ $id ?? 1 }}" class="active">Masak</a>
                    <a href="{{ url('') }}/admin/sertifikasi/pengajuan/fase_panen/{{ $id ?? 1 }}">Panen</a>
                </div>

                <script>
                function pilihTipeForm() {
                    var tipeForm = document.getElementById("tipeFormPermohonan").value;
                    if (!tipeForm) {
                        alert('Pilih tipe form terlebih dahulu!');
                        return false;
                    }
                    window.location.href = "{{ url('') }}/admin/sertifikasi/pengajuan/tambah?tipe=" + tipeForm;
                }
                </script>

                <form action="{{ url('') }}/admin/sertifikasi/pengajuan/update" method="post" name="form_edit_fase_masak" id="form_edit_fase_masak">
                    @csrf
                    <input type="hidden" value="15" name="kode_fase">
                    <input type="hidden" value="Masak" name="nama_fase">

                    <div id="masakContent">
                        <!-- Informasi -->
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

                        <!-- Fase Masak -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Fase Masak</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="desc">Tanggal Pemeriksaan Masak*</label>
                                            <input type="date" class="form-control" name="tanggal_pemeriksaan_masak" value="{{ old('tanggal_pemeriksaan_masak') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="desc">Tanggal Laporan*</label>
                                            <input type="date" class="form-control" name="tgl_laporan" value="{{ old('tgl_laporan') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="desc">Pengawas Benih Lapangan*</label>
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

                        <!-- Pemohon -->
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

                        <!-- Pemeriksaan Peralatan Fase Masak -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pemeriksaan Peralatan Fase Masak</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="desc">Sabit*</label>
                                            <select name="sabit" id="sabit" class="form-control">
                                                <option value="0">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                <option value="1">Tidak Memenuhi Syarat</option>
                                                <option value="2" selected="">Memenuhi Syarat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="desc">Timbangan*</label>
                                            <select name="timbangan" id="timbangan" class="form-control">
                                                <option value="0">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                <option value="1">Tidak Memenuhi Syarat</option>
                                                <option value="2" selected="">Memenuhi Syarat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="desc">Alat Perontok*</label>
                                            <select name="alat_perontok" id="alat_perontok" class="form-control">
                                                <option value="0">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                <option value="1">Tidak Memenuhi Syarat</option>
                                                <option value="2" selected="">Memenuhi Syarat</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="desc">Karung Goni*</label>
                                            <select name="karung_goni" id="karung_goni" class="form-control">
                                                <option value="0">Memenuhi Syarat / Tidak Memenuhi Syarat *)</option>
                                                <option value="1">Tidak Memenuhi Syarat</option>
                                                <option value="2" selected="">Memenuhi Syarat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="desc">Identitas Karung*</label>
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

                        <!-- Pengawasan Masak -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pengawasan Masak</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="desc">Tanggal Masak Awal*</label>
                                            <input type="date" class="form-control" name="tanggal_masak_awal" id="tanggal_masak_awal" value="{{ old('tanggal_masak_awal') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="desc">Tanggal Masak Akhir*</label>
                                            <input type="date" class="form-control" name="tanggal_masak_akhir" id="tanggal_masak_akhir" value="{{ old('tanggal_masak_akhir') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="desc">Lama Masak*</label>
                                            <input type="number" class="form-control" name="lama_masak" id="lama_masak" value="{{ old('lama_masak') }}" readonly=""> Hari <i>(otomatis)</i>
                                        </div>
                                        <div class="form-group">
                                            <label class="desc">Umur Masak*</label>
                                            <input type="number" class="form-control" name="umur_masak" id="umur_masak" value="{{ old('umur_masak') }}" readonly=""> Hari <i>(otomatis)</i>
                                        </div>
                                        <div class="form-group">
                                            <label class="desc">Cuaca Fase Masak*</label>
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
                                            <label class="desc">Jumlah Masak* (Angka, contoh: 1000)</label>
                                            <input type="text" class="form-control" name="jumlah_masak" value="{{ old('jumlah_masak') }}">
                                            <input type="text" class="form-control" name="satuan_jumlah_masak" value="Kilogram" disabled="">
                                        </div>
                                        <div class="form-group">
                                            <label class="desc">Catatan Fase Masak</label>
                                            <textarea class="form-control" name="catatan_masak" rows="5">{{ old('catatan_masak') }}</textarea>
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

                        <!-- Kesimpulan Fase -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Kesimpulan Fase*</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="desc">Kesimpulan Fase Masak</label>
                                    <div>
                                        <input type="radio" name="kesimpulan_fase" value="2"> Memenuhi Syarat (Lulus) / Tidak Memenuhi Syarat (Tidak Lulus) *)<br>
                                        <input type="radio" name="kesimpulan_fase" value="1" checked=""> Memenuhi Syarat (Lulus) <br>
                                        <input type="radio" name="kesimpulan_fase" value="0"> Tidak Memenuhi Syarat (Tidak Lulus)
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    var date_diff_indays = function(date1, date2) {
        dt1 = new Date(date1);
        dt2 = new Date(date2);
    return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 60 * 60 * 24))+1;
    }
    function hitung_lama_masak(){
        let tanggal_masak_awal=new Date($('#tanggal_masak_awal').val());
        let tanggal_masak_akhir=new Date($('#tanggal_masak_akhir').val());
        $('#lama_masak').val(date_diff_indays(tanggal_masak_awal,tanggal_masak_akhir));
    }
    function hitung_umur_masak(){
        let tanggal_tanam=new Date('2026-08-21');
        let tanggal_masak_awal=new Date($('#tanggal_masak_awal').val());
        console.log(date_diff_indays(tanggal_tanam,tanggal_masak_awal));
        $('#umur_masak').val(date_diff_indays(tanggal_tanam,tanggal_masak_awal));
    }
    $('#tanggal_masak_awal').change(function(){
        console.log('trigger awal masak');
        hitung_lama_masak();
        hitung_umur_masak();
    });
    $('#tanggal_masak_akhir').change(function(){
        hitung_lama_masak();
    });
    hitung_lama_masak();
        hitung_umur_masak();

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
                     document.form_edit_fase_masak.alamat_produsen.value = response;
                }
        });
        return false;
    }
</script>
@endsection
