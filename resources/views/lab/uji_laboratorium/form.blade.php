@extends("template.t_admin")

@section("title", (isset($mode) && $mode == 'lihat' ? 'Lihat' : (isset($mode) && $mode == 'edit' ? 'Edit' : 'Tambah')) . " LHU - Laboratorium")

@push("header")
<style>
    .desc1 {
        font-size: 16px;
        font-weight: bold;
        font-family: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif;
    }
    .fieldset_default {
        border: 1px solid #ddd;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 4px;
    }
    .fieldset_default legend {
        width: auto;
        padding: 0 10px;
        font-weight: bold;
        color: #333;
    }
    .info {
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 15px;
    }
    .info a {
        margin-right: 15px;
    }
    .grey {
        background: #D9D9DB;
        color: #000000 !important;
        padding: 5px !important;
    }
    .form-label-group label {
        font-weight: 600;
    }
    .readonly-field {
        background-color: #e9ecef;
        cursor: not-allowed;
    }
    .hasil-ujian {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }
    .hasil-ujian label {
        width: 150px;
        margin-bottom: 0;
    }
    .hasil-ujian .desc1 {
        width: 100px;
    }
    .hasil-ujian input {
        width: 80px;
    }
</style>
@endpush

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laboratorium > Form Laporan Lengkap Hasil Uji (LHU)</h3>
                <div class="card-tools">
                    <a href="{{ route('lab.uji_laboratorium.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                    </a>
                    @if(isset($lhu) && $lhu)
                    <a href="https://daftar.bpsbjatim.com/simbenih_lhu/69d1fc78dbda242c43ad6590368912d4" class="btn btn-info btn-sm ml-1" target="_blank">
                        <i class="fas fa-print"></i> Print Laporan
                    </a>
                    @endif
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ isset($lhu) && $lhu ? route('lab.uji_laboratorium.update', $lhu->id) : route('lab.uji_laboratorium.store') }}" 
                      method="POST" 
                      name="form_lhu" 
                      id="formLhu">
                    @csrf
                    @if(isset($lhu) && $lhu)
                        @method('PUT')
                    @endif

                    <div class="info">
                        <div>
                            @if(isset($mode) && $mode == 'lihat')
                                User Melihat Data LHU.
                            @elseif(isset($mode) && $mode == 'edit')
                                User Mengedit Data LHU.
                            @else
                                User Sedang Mengisi Form LHU Baru.
                            @endif
                        </div>
                    </div>

                    <!-- Header Info Section -->
                    <fieldset class="fieldset_default">
                        <legend>| Informasi Dasar |</legend>
                        <ul>
                            <li>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><label class="desc">Nomor Induk Lapangan</label></td>
                                        <td>:&nbsp;</td>
                                        <td class="desc1" width="270">
                                            {{ $lhu->no_induk_lapangan ?? old('no_induk_lapangan', 'PdnQI.P.3523070.0041.0001') }}
                                        </td>
                                        <td>&nbsp;</td>
                                        <td><label class="desc">No Berkas</label></td>
                                        <td>:&nbsp;</td>
                                        <td class="desc1">
                                            {{ $lhu->no_berkas ?? old('no_berkas', 'TP24.107.0001') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="desc">Nama Produsen</label></td>
                                        <td>:&nbsp;</td>
                                        <td class="desc1" width="270">
                                            {{ $lhu->nama_produsen ?? old('nama_produsen', 'UD. AGRO TANI') }}
                                        </td>
                                        <td>&nbsp;</td>
                                        <td><label class="desc">Alamat</label></td>
                                        <td>:&nbsp;</td>
                                        <td class="desc1">
                                            {{ $lhu->alamat_produsen ?? old('alamat_produsen', 'Desa Sokosari, Kec. Soko, Kab. Tuban') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="desc">Nomor Asal</label></td>
                                        <td>:&nbsp;</td>
                                        <td class="desc1">
                                            {{ $lhu->no_asal ?? old('no_asal', 'SP.0229.11.124') }}
                                        </td>
                                        <td>&nbsp;</td>
                                        <td><label class="desc">NO LAB</label></td>
                                        <td>:&nbsp;</td>
                                        <td class="desc1">
                                            {{ $lhu->no_lab ?? old('no_lab', 'S.0202.1.24') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="desc">Jenis Tanaman</label></td>
                                        <td>:&nbsp;</td>
                                        <td class="desc1">
                                            {{ $lhu->jenis_tanaman ?? old('jenis_tanaman', 'Padi Inbrida') }}
                                        </td>
                                        <td>&nbsp;</td>
                                        <td><label class="desc">Varietas</label></td>
                                        <td>:&nbsp;</td>
                                        <td class="desc1">
                                            {{ $lhu->varietas ?? old('varietas', 'Inpari 32 HDB') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="desc">Kelas Benih</label></td>
                                        <td>:&nbsp;</td>
                                        <td class="desc1">
                                            {{ $lhu->kelas_benih ?? old('kelas_benih', 'BP') }}
                                        </td>
                                        <td>&nbsp;</td>
                                        <td><label class="desc">No LOT</label></td>
                                        <td>:&nbsp;</td>
                                        <td class="desc1">
                                            {{ $lhu->no_lot ?? old('no_lot', '01/01') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="desc">Tgl Panen Awal</label></td>
                                        <td>:&nbsp;</td>
                                        <td class="desc1">
                                            {{ \Carbon\Carbon::parse($lhu->tgl_panen_awal ?? old('tgl_panen_awal', '2024-04-03'))->format('d-m-Y') }}
                                        </td>
                                        <td>&nbsp;</td>
                                        <td><label class="desc">CVL</label></td>
                                        <td>:&nbsp;</td>
                                        <td class="desc1">
                                            0.3 %
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="desc">Tgl Panen Akhir</label></td>
                                        <td>:&nbsp;</td>
                                        <td class="desc1">
                                            {{ \Carbon\Carbon::parse($lhu->tgl_panen_akhir ?? old('tgl_panen_akhir', '2024-04-05'))->format('d-m-Y') }}
                                        </td>
                                        <td>&nbsp;</td>
                                        <td><label class="desc">Luas Lulus Terakhir</label></td>
                                        <td>:&nbsp;</td>
                                        <td class="desc1">
                                            {{ $lhu->luas_lulus ?? old('luas_lulus', '5.5 Ha (Fase Terakhir)') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="desc">Tonase Kelompok Benih</label></td>
                                        <td>:&nbsp;</td>
                                        <td class="desc1">
                                            {{ $lhu->tonase ?? old('tonase', '17500') }} Kilogram
                                        </td>
                                        <td>&nbsp;</td>
                                        <td><label class="desc">Tgl Selesai Pengujian</label></td>
                                        <td>: </td>
                                        <td class="desc1">
                                            {{ \Carbon\Carbon::parse($lhu->tgl_selesai_pengujian ?? old('tgl_selesai_pengujian', '2024-06-21'))->format('d-m-Y') }}
                                        </td>
                                    </tr>
                                </table>
                            </li>
                        </ul>
                    </fieldset>

                    <!-- Hasil Pengujian Laboratorium -->
                    <fieldset class="fieldset_default">
                        <legend>| Hasil Pengujian Laboratorium |</legend>
                        <table>
                            <tr>
                                <td width="50%">
                                    <ul>
                                        <li class="hasil-ujian">
                                            <label>Kadar Air</label>
                                            <div class="desc1">: {{ $lhu->kadar_air ?? old('kadar_air', '11,8') }} %</div>
                                        </li>
                                        <li class="hasil-ujian">
                                            <label>Benih Murni</label>
                                            <div class="desc1">: {{ $lhu->benih_murni ?? old('benih_murni', '99,7') }} %</div>
                                            <input type="text" class="form-control form-control-sm d-inline-block ml-2" width="3" 
                                                   name="BENIH_MURNI" id="BENIH_MURNI" 
                                                   value="{{ $lhu->benih_murni ?? old('benih_murni', '99,7') }}" 
                                                   style="width: 80px;">
                                        </li>
                                        <li class="hasil-ujian">
                                            <label>Kotoran Benih</label>
                                            <div class="desc1">: {{ $lhu->kotoran_benih ?? old('kotoran_benih', '0,3') }} %</div>
                                            <input type="text" class="form-control form-control-sm d-inline-block ml-2" 
                                                   name="KOTORAN_BENIH" id="KOTORAN_BENIH" 
                                                   value="{{ $lhu->kotoran_benih ?? old('kotoran_benih', '0,3') }}" 
                                                   style="width: 80px;">
                                        </li>
                                        <li class="hasil-ujian">
                                            <label>BTL/Gulma</label>
                                            <div class="desc1">: {{ $lhu->btl_gulma ?? old('btl_gulma', '0,0') }} %</div>
                                            <input type="text" class="form-control form-control-sm d-inline-block ml-2" 
                                                   name="BERAT_BTL" id="BERAT_BTL" 
                                                   value="{{ $lhu->btl_gulma ?? old('btl_gulma', '0,0') }}" 
                                                   style="width: 80px;">
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <li class="hasil-ujian">
                                            <label>Daya Berkecambah</label>
                                            <div class="desc1">: {{ $lhu->daya_berkecambah ?? old('daya_berkecambah', '93') }} %</div>
                                        </li>
                                        <li class="hasil-ujian">
                                            <label>Biji Keras</label>
                                            <div class="desc1">: {{ $lhu->biji_keras ?? old('biji_keras', '0') }} %</div>
                                        </li>
                                        <li class="hasil-ujian">
                                            <label>Benih Warna lain</label>
                                            <div class="desc1">: {{ $lhu->benih_warna_lain ?? old('benih_warna_lain', '-') }} %</div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </fieldset>

                    <!-- Form LHU -->
                    <fieldset class="fieldset_default">
                        <table>
                            <tbody>
                                <tr>
                                    <td width="50%" valign="top">
                                        <ul>
                                            <li class="form-group">
                                                <label for="no_induk">Nomor Induk LHU</label>
                                                <input type="text" class="form-control" name="NO_INDUK_REKOM" id="no_induk"
                                                       value="{{ $lhu->no_induk_lhu ?? old('no_induk_lhu', 'PdnQI.P.3523070.0041.0001') }}"
                                                       {{ isset($mode) && $mode == 'lihat' ? 'readonly' : '' }}>
                                            </li>
                                            <li class="form-group">
                                                <label for="nama_produsen">Nama Produsen</label>
                                                <select name="nama_produsen" id="nama_produsen" class="form-control select2" style="width:100%;" {{ isset($mode) && $mode == 'lihat' ? 'disabled' : '' }}>
                                                    <option value="">-- Pilih Produsen --</option>
                                                    @foreach($produsen_list as $p)
                                                        <option value="{{ $p->id }}"
                                                                {{ (isset($lhu) && $lhu->nama_produsen == $p->nama) || old('nama_produsen') == $p->nama ? 'selected' : '' }}>
                                                                    {{ $p->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </li>
                                            <li class="form-group">
                                                <label for="kelas_benih">Kelas Benih</label>
                                                <select name="kelas_benih" id="kelas_benih" class="form-control" {{ isset($mode) && $mode == 'lihat' ? 'disabled' : '' }}>
                                                    <option value="">-- Pilih Kelas Benih --</option>
                                                    <option value="0" {{ ($lhu->kelas_benih ?? old('kelas_benih')) == '0' ? 'selected' : '' }}>---</option>
                                                    <option value="1" {{ ($lhu->kelas_benih ?? old('kelas_benih')) == '1' ? 'selected' : '' }}>NS-N</option>
                                                    <option value="2" {{ ($lhu->kelas_benih ?? old('kelas_benih')) == '2' ? 'selected' : '' }}>BS-S</option>
                                                    <option value="7" {{ ($lhu->kelas_benih ?? old('kelas_benih')) == '7' ? 'selected' : '' }}>BD-D</option>
                                                    <option value="12" {{ ($lhu->kelas_benih ?? old('kelas_benih')) == '12' ? 'selected' : '' }}>BP-P</option>
                                                    <option value="13" {{ ($lhu->kelas_benih ?? old('kelas_benih')) == '13' ? 'selected' : '' }}>BP1-P1</option>
                                                    <option value="14" {{ ($lhu->kelas_benih ?? old('kelas_benih')) == '14' ? 'selected' : '' }}>BP2-P2</option>
                                                    <option value="17" {{ ($lhu->kelas_benih ?? old('kelas_benih')) == '17' ? 'selected' : '' }}>BR-R</option>
                                                    <option value="18" {{ ($lhu->kelas_benih ?? old('kelas_benih')) == '18' ? 'selected' : '' }}>BR1-R1</option>
                                                    <option value="19" {{ ($lhu->kelas_benih ?? old('kelas_benih')) == '19' ? 'selected' : '' }}>BR2-R2</option>
                                                    <option value="20" {{ ($lhu->kelas_benih ?? old('kelas_benih')) == '20' ? 'selected' : '' }}>BR3-R3</option>
                                                    <option value="21" {{ ($lhu->kelas_benih ?? old('kelas_benih')) == '21' ? 'selected' : '' }}>BR4-R4</option>
                                                </select>
                                            </li>
                                            <li class="form-group">
                                                <label for="warna_label">Warna Label</label>
                                                <select name="WARNA_LABEL" id="warna_label" class="form-control" {{ isset($mode) && $mode == 'lihat' ? 'disabled' : '' }} required>
                                                    <option value="">Pilih warna label</option>
                                                    <option value="Ungu" {{ ($lhu->warna_label ?? old('warna_label', 'Ungu')) == 'Ungu' ? 'selected' : '' }}>Ungu</option>
                                                    <option value="Putih" {{ ($lhu->warna_label ?? old('warna_label')) == 'Putih' ? 'selected' : '' }}>Putih</option>
                                                    <option value="Biru" {{ ($lhu->warna_label ?? old('warna_label')) == 'Biru' ? 'selected' : '' }}>Biru</option>
                                                </select>
                                            </li>
                                            <li class="form-group">
                                                <label for="TGL_LHU">Tanggal LHU</label>
                                                <input type="date" class="form-control"
                                                       value="{{ $lhu->tgl_lhu ?? old('tgl_lhu', date('Y-m-d')) }}"
                                                       name='TGL_LHU' id='TGL_LHU' {{ isset($mode) && $mode == 'lihat' ? 'readonly' : '' }}>
                                            </li>
                                            <li class="form-group">
                                                <label for="nama_pegawai">Petugas LHU</label>
                                                <select name="nama_pegawai" id="nama_pegawai" class="form-control select2" style="width:100%;" {{ isset($mode) && $mode == 'lihat' ? 'disabled' : '' }}>
                                                    <option value="">-- Pilih Pegawai --</option>
                                                    @foreach($pegawai_list as $peg)
                                                        <option value="{{ $peg->id }}"
                                                                {{ (isset($lhu) && $lhu->petugas_lhu == $peg->id) || old('nama_pegawai') == $peg->id ? 'selected' : '' }}>
                                                                    {{ $peg->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </li>
                                            <li class="form-group">
                                                <label for="tgl_kadaluarsa">Tanggal Kadaluarsa</label>
                                                <input type="date" class="form-control"
                                                       value="{{ $lhu->tgl_kadaluarsa ?? old('tgl_kadaluarsa', date('Y-m-d', strtotime('+1 year'))) }}"
                                                       name='TGL_KADALUARSA' id='tgl_kadaluarsa' {{ isset($mode) && $mode == 'lihat' ? 'readonly' : '' }}>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            <li class="form-group">
                                                <label for="alamat_produsen">Alamat Produsen</label>
                                                <textarea class="form-control" name="alamat_produsen" id="alamat_produsen" rows="4" readonly>{{ $lhu->alamat_produsen ?? old('alamat_produsen', 'Desa Sokosari, Kec. Soko, Kab. Tuban') }}</textarea>
                                            </li>
                                            <li class="form-group">
                                                <label>Kesimpulan 1</label>
                                                <div class="radio-group">
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" name="kesimpulan_fase" id="kesimpulan_1" value="1"
                                                               {{ ($lhu->kesimpulan ?? old('kesimpulan', '1')) == '1' ? 'checked' : '' }} {{ isset($mode) && $mode == 'lihat' ? 'disabled' : '' }}>
                                                        <label class="custom-control-label" for="kesimpulan_1">Memenuhi Syarat Sertifikasi</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" name="kesimpulan_fase" id="kesimpulan_0" value="0"
                                                               {{ ($lhu->kesimpulan ?? old('kesimpulan')) == '0' ? 'checked' : '' }} {{ isset($mode) && $mode == 'lihat' ? 'disabled' : '' }}>
                                                        <label class="custom-control-label" for="kesimpulan_0">Tidak Memenuhi Syarat Sertifikasi</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="form-group">
                                                <label for="KETERANGAN">Catatan LHU</label>
                                                <textarea class="form-control" name="KETERANGAN" id="KETERANGAN" rows="5" {{ isset($mode) && $mode == 'lihat' ? 'readonly' : '' }}>{{ $lhu->keterangan ?? old('keterangan', '') }}</textarea>
                                            </li>
                                            <li class="form-group">
                                                <label for="ID_PEGAWAI_TTD">PenanggungJawab TTD Sertifikat</label>
                                                <select name="ID_PEGAWAI_TTD" id="ID_PEGAWAI_TTD" class="form-control" {{ isset($mode) && $mode == 'lihat' ? 'disabled' : '' }} required>
                                                    <option value="">-- Pilih Pegawai --</option>
                                                    @foreach($pegawai_ttd_list as $peg)
                                                        <option value="{{ $peg->id }}"
                                                                {{ (isset($lhu) && $lhu->id_pegawai_ttd == $peg->id) || old('ID_PEGAWAI_TTD') == $peg->id ? 'selected' : '' }}>
                                                                    {{ $peg->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="buttons mt-3">
                            <input type="hidden" name="id_uji" value="{{ $lhu->id ?? old('id_uji', '2252') }}">
                            <input type="hidden" name="id_permohonan" value="{{ $lhu->id_permohonan ?? old('id_permohonan', '74267') }}">
                            <input type="hidden" name="berat_benih" value="{{ $lhu->berat_benih ?? old('berat_benih', '17500') }}">
                            <input type="hidden" name="kelas_benih" value="{{ $lhu->kelas_benih ?? old('kelas_benih', '12') }}">
                            
                            @if(!isset($mode) || $mode != 'lihat')
                                <button type="submit" class="btn btn-primary" onclick='return confirm("Pastikan Data Yang di Input Sudah Benar !!! Karena akan dikunci otomatis.")'>
                                    <i class="fas fa-save"></i> Simpan Data
                                </button>
                            @endif
                            <a href="{{ route('lab.uji_laboratorium.index') }}" class="btn btn-secondary ml-2">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </fieldset>
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

@push("script")
<script>
    var no_induk_pengajuan = '{{ $lhu->no_induk_lapangan ?? old('no_induk_lapangan', 'PdnQI.P.3523070.0041.0001') }}';
    var sp = no_induk_pengajuan.split('.');
    var no_induk = '{{ $lhu->no_induk_lapangan ?? old('no_induk_lapangan', 'PdnQI.P.3523070.0041.0001') }}';
    var split = no_induk.split('.');
    var kode_varietas = sp[0];
    var kode_kelas_benih = split[1];
    var kodelokasi = sp[2];
    var kode_produsen = split[3];
    var nourut_sertifikasi = split[4];
    
    function generate_nomer_induk() {
        let no_induk = kode_varietas + "." + kode_kelas_benih + "." + kodelokasi + "." + kode_produsen + "." + nourut_sertifikasi;
        $('#no_induk').val(no_induk);
    }
    
    $('#kelas_benih').change(function () {
        let textnya = $("#kelas_benih option:selected").text();
        set_warna(textnya)
        kdv = textnya.split('-')
        kode_kelas_benih = kdv.at(-1).trim();
        generate_nomer_induk();
    });
    
    function set_warna(warna){
        let kode=warna.charAt(1);
        if(kode=='D'){
            $('#warna_label').val('Putih');
        }else if(kode=='P'){
            $('#warna_label').val('Ungu');
        }else{
            $('#warna_label').val('Biru');
        }
    }
    
    function dapatkan_alamat() {
        var prp = $("#nama_produsen").val();
        $.ajax({
            url: "{{ route('sertifikasi.pengajuan.dapatkan_alamat') }}",
            global: false,
            type: "POST",
            async: false,
            dataType: "html",
            data: "id_produsen=" + prp,
            success: function (response) {
                document.form_lhu.alamat_produsen.value = response;
            }
        });
        return false;
    }
    
    function isInteger(str) {
        if (isNaN(str.value.toString()))
            alert('Harap masukkan angka');
    }
    
    function set_disable() {
        for (var i = 0; i < document.form_lhu.kesimpulan_fase.length; i++) {
            if (document.form_lhu.kesimpulan_fase[i].checked) {
                var rad_val = document.form_lhu.kesimpulan_fase[i].value;
                if (rad_val == '0') {
                    document.form_lhu.kelas_benih_rekomendasi.disabled = true;
                    document.form_lhu.kelas_benih_rekomendasi.value = 12;
                } else {
                    document.form_lhu.kelas_benih_rekomendasi.disabled = false;
                }
            }
        }
    }
    
    $(document).ready(function() {
        generate_nomer_induk();
        set_disable();
        
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%'
        });
    });
</script>
@endpush
