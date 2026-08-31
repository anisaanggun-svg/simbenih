@extends("template.t_admin")

@section("title", "Form Pengolahan Pasca Lapangan")

@push("header")
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
    .info-table td { padding: 4px 8px; font-size: 0.9rem; }
    .info-table td:first-child { font-weight: 600; color: #555; width: 200px; }
    #pascaContent .card { margin-bottom: 0.75rem; }
    #pascaContent .card-body { padding: 0.85rem; }
    #pascaContent .card-header { padding: 0.5rem 0.85rem; }
    #pascaContent .form-group { margin-bottom: 0.6rem; }
    #pascaContent label { margin-bottom: 0.1rem; font-size: 0.87rem; }
    #pascaContent .form-control { font-size: 0.875rem; }
</style>
@endpush

@section("content")
<style>
    .info-table td { padding: 4px 8px; font-size: 0.9rem; }
    .info-table td:first-child { font-weight: 600; color: #555; width: 200px; }
    #pascaContent .card { margin-bottom: 0.75rem; }
    #pascaContent .card-body { padding: 0.85rem; }
    #pascaContent .card-header { padding: 0.5rem 0.85rem; }
    #pascaContent .form-group { margin-bottom: 0.6rem; }
    #pascaContent label { margin-bottom: 0.1rem; font-size: 0.87rem; }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Fase Pengolahan Pasca Lapangan</h3>
                <div class="card-tools">
                    <a href="{{ url('') }}/admin/sertifikasi/pasca_lapangan/cetak/pengolahan/{{ $id ?? '' }}" class="btn btn-sm btn-info" target="_blank">
                        <i class="fas fa-print mr-1"></i> Print Laporan
                    </a>
                    <a href="{{ url('') }}/admin/sertifikasi/pasca_lapangan" class="btn btn-sm btn-outline-secondary ml-1">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Pasca Lapangan
                    </a>
                </div>
            </div>
            <div class="card-body">

                <form action="{{ url('') }}/admin/sertifikasi/pasca_lapangan/update" method="post" id="form_pengolahan">
                    @csrf
                    <input type="hidden" name="id_pasca" value="{{ $id ?? '' }}">

                    <div id="pascaContent">

                        <!-- ===== INFO FASE LAPANG ===== -->
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">| Info Fase Lapang |</h3></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="info-table">
                                            <tr><td>No. Berkas</td><td>: {{ $pasca->kode_unik_sertifikasi ?? '-' }}</td></tr>
                                            <tr><td>No. Induk</td><td>: {{ $pasca->no_induk_lapangan ?? '-' }}</td></tr>
                                            <tr><td>Nama Produsen</td><td>: {{ $pasca->nama_produsen_aju ?? '-' }}</td></tr>
                                            <tr><td>Alamat Pemohon</td><td>: {{ $pasca->alamat_produsen ?? '-' }}</td></tr>
                                            <tr><td>Jenis Tanaman</td><td>: {{ $pasca->nama_tanaman ?? '-' }}</td></tr>
                                            <tr><td>Varietas</td><td>: {{ $pasca->nama_varietas ?? '-' }}</td></tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="info-table">
                                            <tr><td>CVL Fase Berbunga (Jantan)</td><td>: {{ $pasca->cvl_berbunga_jantan ?? '-' }} %</td></tr>
                                            <tr><td>CVL Fase Berbunga (Betina)</td><td>: {{ $pasca->cvl_berbunga_betina ?? '-' }} %</td></tr>
                                            <tr><td>Bunga Jantan Tertinggal</td><td>: {{ $pasca->bunga_jantan_tertinggal ?? '-' }} %</td></tr>
                                            <tr><td>CVL Fase Masak (Betina)</td><td>: {{ $pasca->cvl_masak_betina ?? '-' }} %</td></tr>
                                            <tr><td>Induk Jantan Tertinggal (masak)</td><td>: {{ $pasca->induk_jantan_tertinggal ?? '-' }} %</td></tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===== FASE PENGOLAHAN ===== -->
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">| Fase Pengolahan |</h3></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Pemeriksaan <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="TGL_PEMERIKSAAN" required value="{{ $pasca->tgl_pemeriksaan ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Laporan</label>
                                            <input type="date" class="form-control" name="TGL_LAPORAN" value="{{ $pasca->tgl_laporan ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Pengawas Benih Lapangan <span class="text-danger">*</span></label>
                                            <select name="nama_pegawai" class="form-control select2" required>
                                                <option value="0">-- Pilih Pegawai --</option>
                                                @isset($pegawai_list)
                                                    @foreach($pegawai_list as $pg)
                                                    <option value="{{ $pg->id }}" {{ isset($pasca) && $pasca->id_pegawai == $pg->id ? 'selected' : '' }}>{{ $pg->nama }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi PCB <span class="text-danger">*</span></label>
                                            <select name="LOKASI_PCB" class="form-control" required>
                                                <option value="">-- Pilih Lokasi PCB --</option>
                                                <option value="1" {{ isset($pasca) && $pasca->lokasi_pcb==1?'selected':'' }}>Surabaya</option>
                                                <option value="2" {{ isset($pasca) && $pasca->lokasi_pcb==2?'selected':'' }}>Sidoarjo</option>
                                                <option value="3" {{ isset($pasca) && $pasca->lokasi_pcb==3?'selected':'' }}>Jombang</option>
                                                <option value="4" {{ isset($pasca) && $pasca->lokasi_pcb==4?'selected':'' }}>Gresik</option>
                                                <option value="5" {{ isset($pasca) && $pasca->lokasi_pcb==5?'selected':'' }}>Lamongan</option>
                                                <option value="6" {{ isset($pasca) && $pasca->lokasi_pcb==6?'selected':'' }}>Bojonegoro</option>
                                                <option value="7" {{ isset($pasca) && $pasca->lokasi_pcb==7?'selected':'' }}>Tuban</option>
                                                <option value="8" {{ isset($pasca) && $pasca->lokasi_pcb==8?'selected':'' }}>Bangkalan</option>
                                                <option value="9" {{ isset($pasca) && $pasca->lokasi_pcb==9?'selected':'' }}>Sampang</option>
                                                <option value="10" {{ isset($pasca) && $pasca->lokasi_pcb==10?'selected':'' }}>Pamekasan</option>
                                                <option value="11" {{ isset($pasca) && $pasca->lokasi_pcb==11?'selected':'' }}>Sumenep</option>
                                                <option value="12" {{ isset($pasca) && $pasca->lokasi_pcb==12?'selected':'' }}>Madiun</option>
                                                <option value="13" {{ isset($pasca) && $pasca->lokasi_pcb==13?'selected':'' }}>Kota Madiun</option>
                                                <option value="14" {{ isset($pasca) && $pasca->lokasi_pcb==14?'selected':'' }}>Ngawi</option>
                                                <option value="15" {{ isset($pasca) && $pasca->lokasi_pcb==15?'selected':'' }}>Magetan</option>
                                                <option value="16" {{ isset($pasca) && $pasca->lokasi_pcb==16?'selected':'' }}>Ponorogo</option>
                                                <option value="17" {{ isset($pasca) && $pasca->lokasi_pcb==17?'selected':'' }}>Pacitan</option>
                                                <option value="18" {{ isset($pasca) && $pasca->lokasi_pcb==18?'selected':'' }}>Kediri</option>
                                                <option value="19" {{ isset($pasca) && $pasca->lokasi_pcb==19?'selected':'' }}>Kota Kediri</option>
                                                <option value="20" {{ isset($pasca) && $pasca->lokasi_pcb==20?'selected':'' }}>Blitar</option>
                                                <option value="21" {{ isset($pasca) && $pasca->lokasi_pcb==21?'selected':'' }}>Tulungagung</option>
                                                <option value="22" {{ isset($pasca) && $pasca->lokasi_pcb==22?'selected':'' }}>Trenggalek</option>
                                                <option value="23" {{ isset($pasca) && $pasca->lokasi_pcb==23?'selected':'' }}>Nganjuk</option>
                                                <option value="24" {{ isset($pasca) && $pasca->lokasi_pcb==24?'selected':'' }}>Malang</option>
                                                <option value="25" {{ isset($pasca) && $pasca->lokasi_pcb==25?'selected':'' }}>Kota Malang</option>
                                                <option value="26" {{ isset($pasca) && $pasca->lokasi_pcb==26?'selected':'' }}>Kota Batu</option>
                                                <option value="27" {{ isset($pasca) && $pasca->lokasi_pcb==27?'selected':'' }}>Pasuruan</option>
                                                <option value="28" {{ isset($pasca) && $pasca->lokasi_pcb==28?'selected':'' }}>Kota Pasuruan</option>
                                                <option value="29" {{ isset($pasca) && $pasca->lokasi_pcb==29?'selected':'' }}>Probolinggo</option>
                                                <option value="30" {{ isset($pasca) && $pasca->lokasi_pcb==30?'selected':'' }}>Kota Probolinggo</option>
                                                <option value="31" {{ isset($pasca) && $pasca->lokasi_pcb==31?'selected':'' }}>Lumajang</option>
                                                <option value="32" {{ isset($pasca) && $pasca->lokasi_pcb==32?'selected':'' }}>Jember</option>
                                                <option value="33" {{ isset($pasca) && $pasca->lokasi_pcb==33?'selected':'' }}>Situbondo</option>
                                                <option value="34" {{ isset($pasca) && $pasca->lokasi_pcb==34?'selected':'' }}>Bondowoso</option>
                                                <option value="35" {{ isset($pasca) && $pasca->lokasi_pcb==35?'selected':'' }}>Banyuwangi</option>
                                                <option value="36" {{ isset($pasca) && $pasca->lokasi_pcb==36?'selected':'' }}>Mojokerto</option>
                                                <option value="37" {{ isset($pasca) && $pasca->lokasi_pcb==37?'selected':'' }}>Kota Mojokerto</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Tanaman Akhir</label>
                                            <input type="text" class="form-control" name="JENIS_TANAMAN_AKHIR" value="{{ $pasca->jenis_tanaman_akhir ?? '' }}" placeholder="Jenis Tanaman Akhir">
                                        </div>
                                        <div class="form-group">
                                            <label>Varietas Akhir</label>
                                            <input type="text" class="form-control" name="VARIETAS_AKHIR" value="{{ $pasca->varietas_akhir ?? '' }}" placeholder="Varietas Akhir">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Produsen LHU (Akhir)</label>
                                            <select name="PRODUSEN_LHU" class="form-control select2">
                                                <option value="0">-- Pilih Produsen Akhir --</option>
                                                @isset($produsen_list)
                                                    @foreach($produsen_list as $p)
                                                    <option value="{{ $p->id }}" {{ isset($pasca) && $pasca->id_produsen_lhu == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Kelas Benih Akhir</label>
                                            <select name="KELAS_BENIH_AKHIR" class="form-control">
                                                <option value="">-- Kelas Benih --</option>
                                                <option value="NS" {{ isset($pasca) && $pasca->kelas_benih_akhir=='NS'?'selected':'' }}>NS-N</option>
                                                <option value="BS" {{ isset($pasca) && $pasca->kelas_benih_akhir=='BS'?'selected':'' }}>BS-S</option>
                                                <option value="BD" {{ isset($pasca) && $pasca->kelas_benih_akhir=='BD'?'selected':'' }}>BD-D</option>
                                                <option value="BP" {{ isset($pasca) && $pasca->kelas_benih_akhir=='BP'?'selected':'' }}>BP-P</option>
                                                <option value="BR" {{ isset($pasca) && $pasca->kelas_benih_akhir=='BR'?'selected':'' }}>BR-R</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Produksi Benih (kg)</label>
                                            <input type="text" class="form-control" name="PRODUKSI_BENIH" value="{{ $pasca->produksi_benih ?? '' }}" placeholder="kg">
                                        </div>
                                        <div class="form-group">
                                            <label>Berat Kemasan (kg/sak)</label>
                                            <input type="text" class="form-control" name="BERAT_KEMASAN" value="{{ $pasca->berat_kemasan ?? '' }}" placeholder="kg/sak">
                                        </div>
                                        <div class="form-group">
                                            <label>No. LOT Pengolahan</label>
                                            <input type="text" class="form-control" name="NO_KELOMPOK_BENIH" value="{{ $pasca->no_kelompok_benih ?? '' }}" placeholder="No LOT Olah">
                                        </div>
                                        <div class="form-group">
                                            <label>No. LOT PCB</label>
                                            <input type="text" class="form-control" name="NO_KELOMPOK_BENIH_PCB" value="{{ $pasca->no_kelompok_benih_pcb ?? '' }}" placeholder="No LOT PCB">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===== HASIL UJI LABORATORIUM ===== -->
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">| Hasil Uji Laboratorium |</h3></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. LHU</label>
                                            <input type="text" class="form-control" name="NO_LHU" value="{{ $pasca->no_lhu ?? '' }}" placeholder="No. LHU">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal LHU</label>
                                            <input type="date" class="form-control" name="TGL_LHU" value="{{ $pasca->tgl_lhu ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Kadar Air (%)</label>
                                            <input type="text" class="form-control" name="KA" value="{{ $pasca->ka ?? '' }}" placeholder="Kadar Air %">
                                        </div>
                                        <div class="form-group">
                                            <label>Kemurnian (%)</label>
                                            <input type="text" class="form-control" name="KEMURNIAN" value="{{ $pasca->kemurnian ?? '' }}" placeholder="Kemurnian %">
                                        </div>
                                        <div class="form-group">
                                            <label>Daya Kecambah (%)</label>
                                            <input type="text" class="form-control" name="DK" value="{{ $pasca->dk ?? '' }}" placeholder="Daya Kecambah %">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Benih Murni (gram/1000 butir)</label>
                                            <input type="text" class="form-control" name="BENIH_MURNI" value="{{ $pasca->benih_murni ?? '' }}" placeholder="gram/1000 butir">
                                        </div>
                                        <div class="form-group">
                                            <label>Kotoran Benih (%)</label>
                                            <input type="text" class="form-control" name="KOTORAN_BENIH" value="{{ $pasca->kotoran_benih ?? '' }}" placeholder="Kotoran Benih %">
                                        </div>
                                        <div class="form-group">
                                            <label>Biji Gulma (/kg)</label>
                                            <input type="text" class="form-control" name="BIJI_GULMA" value="{{ $pasca->biji_gulma ?? '' }}" placeholder="Biji Gulma /kg">
                                        </div>
                                        <div class="form-group">
                                            <label>Kesimpulan LHU</label>
                                            <select name="KESIMPULAN_LHU" class="form-control">
                                                <option value="">-- Pilih Kesimpulan --</option>
                                                <option value="Memenuhi Syarat" {{ isset($pasca) && $pasca->kesimpulan_lhu=='Memenuhi Syarat'?'selected':'' }}>Memenuhi Syarat</option>
                                                <option value="Tidak Memenuhi Syarat" {{ isset($pasca) && $pasca->kesimpulan_lhu=='Tidak Memenuhi Syarat'?'selected':'' }}>Tidak Memenuhi Syarat</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===== KONSEP LABEL ===== -->
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">| Konsep Label |</h3></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. Konsep Label</label>
                                            <input type="text" class="form-control" name="NO_KONSEP" value="{{ $pasca->no_konsep ?? '' }}" placeholder="No Konsep Label">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Konsep Label</label>
                                            <input type="date" class="form-control" name="TGL_KONSEP" value="{{ $pasca->tgl_konsep ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Kemasan (sak)</label>
                                            <input type="text" class="form-control" name="JUMLAH_KEMASAN" value="{{ $pasca->jumlah_kemasan ?? '' }}" placeholder="Jumlah Sak">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Total Berat Benih (kg)</label>
                                            <input type="text" class="form-control" name="TOTAL_BERAT" value="{{ $pasca->total_berat ?? '' }}" placeholder="Total Berat kg">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Kadaluarsa Label</label>
                                            <input type="date" class="form-control" name="TGL_KADALUARSA" value="{{ $pasca->tgl_kadaluarsa ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" name="KETERANGAN" rows="2" placeholder="Keterangan tambahan...">{{ $pasca->keterangan ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===== TOMBOL SIMPAN ===== -->
                        <div class="card">
                            <div class="card-body">
                                <button type="button" class="btn btn-primary" onclick="konfirmasiSimpan()">
                                    <i class="fas fa-save mr-1"></i> Simpan Data
                                </button>
                                <button type="reset" class="btn btn-secondary ml-2">
                                    <i class="fas fa-undo mr-1"></i> Reset
                                </button>
                            </div>
                        </div>

                        <!-- Modal Konfirmasi Simpan -->
                        <div class="modal fade" id="modalKonfirmasiSimpan" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiSimpanLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                        <h5 class="modal-title" id="modalKonfirmasiSimpanLabel">
                                            <i class="fas fa-exclamation-triangle mr-2"></i> Konfirmasi Simpan Data
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-0">Pastikan Data Yang di Input Sudah Benar !!! Karena akan dikunci otomatis.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            <i class="fas fa-times mr-1"></i> Batal
                                        </button>
                                        <button type="button" class="btn btn-primary" onclick="submitForm()">
                                            <i class="fas fa-check mr-1"></i> Oke
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- /#pascaContent -->
                </form>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@push("footer")
<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
$(function () {
    $('.select2').select2({ theme: 'bootstrap4', width: '100%' });
});

function konfirmasiSimpan() {
    $('#modalKonfirmasiSimpan').modal('show');
}

function submitForm() {
    $('#modalKonfirmasiSimpan').modal('hide');
    $('#form_pengolahan').submit();
}
</script>
@endpush
