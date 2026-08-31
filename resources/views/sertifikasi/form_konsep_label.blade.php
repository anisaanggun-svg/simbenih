@extends("template.t_admin")

@section("title", $mode == 'lihat' ? 'Lihat Konsep Label - Sertifikasi' : ($mode == 'kosong' ? 'Edit Konsep Label - Sertifikasi' : 'Form Konsep Label - Sertifikasi'))

@push("header")
<style>
    .form-label-group label {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    .readonly-field {
        background-color: #f0f0f0;
        color: #666;
        cursor: not-allowed;
        border: 1px solid #ccc;
        pointer-events: none;
    }
    .fieldset-custom {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }
    .fieldset-custom legend {
        width: auto;
        padding: 0 0.5rem;
        font-weight: 600;
        color: #495057;
        border-bottom: none;
        margin-bottom: 0;
    }
    .info-box {
        background-color: #f8f9fa;
        border-left: 4px solid #17a2b8;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
        border-radius: 0.25rem;
    }
    .info-box a {
        color: #17a2b8;
        text-decoration: none;
    }
    .info-box a:hover {
        text-decoration: underline;
    }
    .calculation-note {
        font-size: 0.875rem;
        color: #dc3545;
        margin-top: 0.25rem;
    }
    .btn-form {
        margin-right: 0.5rem;
    }
    .btn-form:last-child {
        margin-right: 0;
    }
</style>
@endpush

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    @if($mode == 'lihat')
                        Lihat Konsep Label
                    @elseif($mode == 'kosong')
                        Edit Konsep Label
                    @else
                        Form Konsep Label
                    @endif
                </h3>
                <div class="card-tools">
                    @if($mode == 'lihat' || $mode == 'kosong')
                    <a href="https://daftar.bpsbjatim.com/simbenihkonseplabel/c44cc3a1dafb37ba0bec93b81ee3796a/541" class="btn btn-sm btn-info" target="_blank">
                        <i class="fas fa-print mr-1"></i> Print Laporan
                    </a>
                    @endif
                    <a href="{{ url('') }}/admin/sertifikasi/label" class="btn btn-sm btn-outline-secondary ml-1">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Konsep Label
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="info-box">
                    <div>
                        @if($mode == 'lihat')
                            Menampilkan detail data Konsep Label
                        @else
                            User Melakukan Pengisian Form untuk mendapatkan No. Seri Label
                        @endif
                    </div>
                </div>

                <div class="fieldset-custom">
                    <form action="@if($mode == 'create' || $mode == 'kosong')
                        {{ url('') }}/admin/sertifikasi/label/{{ $mode == 'create' ? 'insert' : 'update' }}/{{ $id }}{{ $mode == 'kosong' ? '/' . ($a ?? '') : '' }}
                    @else
                        #
                    @endif" method="POST" name="form_konsep_label" id="formKonsepLabel">
                        @csrf
                        @if($mode == 'kosong')
                            @method('POST')
                        @endif

                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_induk">No. Induk Lengkap</label>
                                    <input type="text" class="form-control readonly-field" name="no_induk" id="no_induk"
                                        value="{{ $rekomendasi->no_induk ?? $konsep->no_induk ?? '' }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="no_asal">No. Asal</label>
                                    <input type="text" class="form-control readonly-field" name="no_asal" id="no_asal"
                                        value="{{ $rekomendasi->no_asal ?? $konsep->no_asal ?? '' }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="kelas_benih">Kelas Benih</label>
                                    <select name="kelas_benih" id="kelas_benih" class="form-control readonly-field" disabled>
                                        <option value="0">-</option>
                                        <option value="1" {{ ($rekomendasi->kelas_benih ?? $konsep->kelas_benih ?? '') == 'NS' ? 'selected' : '' }}>NS</option>
                                        <option value="2" {{ ($rekomendasi->kelas_benih ?? $konsep->kelas_benih ?? '') == 'BS' ? 'selected' : '' }}>BS</option>
                                        <option value="7" {{ ($rekomendasi->kelas_benih ?? $konsep->kelas_benih ?? '') == 'BD' ? 'selected' : '' }}>BD</option>
                                        <option value="12" {{ ($rekomendasi->kelas_benih ?? $konsep->kelas_benih ?? '') == 'BP' ? 'selected' : '' }}>BP</option>
                                        <option value="13" {{ ($rekomendasi->kelas_benih ?? $konsep->kelas_benih ?? '') == 'BP1' ? 'selected' : '' }}>BP1</option>
                                        <option value="14" {{ ($rekomendasi->kelas_benih ?? $konsep->kelas_benih ?? '') == 'BP2' ? 'selected' : '' }}>BP2</option>
                                        <option value="17" {{ ($rekomendasi->kelas_benih ?? $konsep->kelas_benih ?? '') == 'BR' ? 'selected' : '' }}>BR</option>
                                        <option value="18" {{ ($rekomendasi->kelas_benih ?? $konsep->kelas_benih ?? '') == 'BR1' ? 'selected' : '' }}>BR1</option>
                                        <option value="19" {{ ($rekomendasi->kelas_benih ?? $konsep->kelas_benih ?? '') == 'BR2' ? 'selected' : '' }}>BR2</option>
                                        <option value="20" {{ ($rekomendasi->kelas_benih ?? $konsep->kelas_benih ?? '') == 'BR3' ? 'selected' : '' }}>BR3</option>
                                        <option value="21" {{ ($rekomendasi->kelas_benih ?? $konsep->kelas_benih ?? '') == 'BR4' ? 'selected' : '' }}>BR4</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="NO_KONSEP">No. Konsep Label</label>
                                    <input type="text" class="form-control" name="NO_KONSEP" id="NO_KONSEP"
                                        value="{{ $konsep->no_konsep ?? old('NO_KONSEP') }}"
                                        {{ $mode == 'lihat' ? 'readonly' : 'required' }}>
                                </div>

                                <div class="form-group">
                                    <label for="TGL_KONSEP_LABEL">Tanggal Konsep Label</label>
                                    <input type="date" class="form-control" name="TGL_KONSEP_LABEL" id="TGL_KONSEP_LABEL"
                                        value="{{ $konsep->tgl_konsep_label ?? old('TGL_KONSEP_LABEL', date('Y-m-d')) }}"
                                        {{ $mode == 'lihat' ? 'readonly' : 'required' }}>
                                </div>

                                <div class="form-group">
                                    <label for="kadaluarsa">Tanggal Kadaluarsa</label>
                                    <input type="date" class="form-control readonly-field" name="kadaluarsa" id="kadaluarsa"
                                        value="{{ $rekomendasi->kadaluarsa ?? $konsep->kadaluarsa ?? '' }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="pengawas">Petugas Konsep Label</label>
                                    <select name="pengawas" id="pengawas" class="form-control" {{ $mode == 'lihat' ? 'disabled' : 'required' }}>
                                        <option value="">-- Pilih Pengawas --</option>
                                        @foreach($pegawai_list ?? [] as $pegawai)
                                        <option value="{{ $pegawai->id ?? $pegawai->id_pegawai ?? '' }}"
                                            {{ ($konsep->pengawas ?? '') == ($pegawai->id ?? $pegawai->id_pegawai ?? '') ? 'selected' : '' }}>
                                            {{ $pegawai->nama ?? $pegawai->name ?? '' }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="produsen">Produsen Pengaju Konsep Label</label>
                                    <select name="produsen" id="produsen" class="form-control readonly-field" disabled>
                                        <option value="">-- Pilih Pengolah Benih --</option>
                                        @foreach($produsen_list ?? [] as $produsen)
                                        <option value="{{ $produsen->id ?? '' }}"
                                            {{ ($rekomendasi->produsen ?? $konsep->produsen ?? '') == ($produsen->id ?? '') ? 'selected' : '' }}>
                                            {{ $produsen->nama ?? '' }} - {{ $produsen->jenis ?? '' }} - {{ $produsen->kabupaten ?? '' }} - {{ $produsen->pimpinan ?? '' }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="produsen_hidden" value="{{ $rekomendasi->produsen ?? $konsep->produsen ?? '' }}">
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="halogram">Bahan Label</label>
                                    <select name="halogram" id="halogram" class="form-control" {{ $mode == 'lihat' ? 'disabled' : 'required' }}>
                                        <option value="">-- Pilih Jenis Bahan --</option>
                                        <option value="1" {{ ($konsep->halogram ?? '') == '1' ? 'selected' : '' }}>Kertas</option>
                                        <option value="2" {{ ($konsep->halogram ?? '') == '2' ? 'selected' : '' }}>Stiker</option>
                                        <option value="3" {{ ($konsep->halogram ?? '') == '3' ? 'selected' : '' }}>Hologram</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Stok Benih</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control readonly-field" name="stok_benih" id="stok_benih"
                                            value="{{ $rekomendasi->stok_benih ?? $konsep->stok_benih ?? '0' }}" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                    <p class="calculation-note">Sisa Stok Benih: <i id='sisa_berat'>0</i> Kg</p>
                                </div>

                                <div class="form-group">
                                    <label for="BERAT_BERSIH">Berat Benih</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01" class="form-control" name="BERAT_BERSIH" id="BERAT_BERSIH"
                                            value="{{ $konsep->berat_bersih ?? old('BERAT_BERSIH', '0') }}"
                                            onkeyup="kalkulasi();" {{ $mode == 'lihat' ? 'readonly' : 'required' }}>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                    <p class="calculation-note">Benih Terlabel seberat: <i id='berat_label_keluar'>0</i> Kg</p>
                                </div>

                                <div class="form-group">
                                    <label for="berat_kemasan">Berat Kemasan (Kg)</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01" class="form-control" name="berat_kemasan" id="berat_kemasan"
                                            value="{{ $konsep->berat_kemasan ?? old('berat_kemasan', '') }}"
                                            onkeyup="kalkulasi();" {{ $mode == 'lihat' ? 'readonly' : 'required' }}>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Gunakan Titik sebagai Penanda Desimal</small>
                                </div>

                                <div class="form-group">
                                    <label for="jumlah_label">Jumlah Label</label>
                                    <input type="text" class="form-control readonly-field" name="jumlah_label" id="jumlah_label"
                                        value="{{ $konsep->jumlah_label ?? old('jumlah_label', '0') }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>No. Seri Label</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="label_awal" id="label_awal"
                                            value="{{ $konsep->label_awal ?? old('label_awal', '') }}"
                                            onkeyup="kalkulasi();" {{ $mode == 'lihat' ? 'readonly' : 'required' }}>
                                        <div class="input-group-append">
                                            <span class="input-group-text">s/d</span>
                                        </div>
                                        <input type="text" class="form-control readonly-field" name="label_akhir" id="label_akhir"
                                            value="{{ $konsep->label_akhir ?? old('label_akhir', '') }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="ket_konsep">Keterangan Konsep Label</label>
                                    <textarea class="form-control" name="ket_konsep" id="ket_konsep" rows="3"
                                        {{ $mode == 'lihat' ? 'readonly' : '' }}>{{ $konsep->ket_konsep ?? old('ket_konsep', '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        @if($mode == 'create')
                            <input type="hidden" name="id_rekomendasi" value="{{ $id ?? '' }}">
                            <input type="hidden" name="id_kaji_ulang" value="{{ $rekomendasi->id_kaji_ulang ?? '' }}">
                        @elseif($mode == 'kosong')
                            <input type="hidden" name="id_rekomendasi" value="{{ $konsep->id_rekomendasi ?? '' }}">
                            <input type="hidden" name="id_kaji_ulang" value="{{ $konsep->id_kaji_ulang ?? '' }}">
                        @endif

                        <div class="form-group mt-3">
                            @if($mode != 'lihat')
                            <button type="submit" class="btn btn-primary btn-form">
                                <i class="fas fa-save"></i> Simpan Data
                            </button>
                            @endif
                            <a href="{{ url('') }}/admin/sertifikasi/label" class="btn btn-secondary btn-form">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
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
<script>
function kalkulasi() {
    var berat_label_keluar = parseFloat({{ $rekomendasi->stok_benih ?? $konsep->stok_benih ?? 0 }});
    var stokBenihInput = document.getElementsByName("stok_benih")[0];
    var beratBersihInput = document.getElementsByName("BERAT_BERSIH")[0];
    var beratKemasanInput = document.getElementsByName("berat_kemasan")[0];
    var jumlahLabelInput = document.getElementsByName("jumlah_label")[0];
    var labelAwalInput = document.getElementsByName("label_awal")[0];
    var labelAkhirInput = document.getElementsByName("label_akhir")[0];

    var stokBenihValue = parseFloat(stokBenihInput.value) || 0;
    var beratBersihValue = parseFloat(beratBersihInput.value) || 0;
    var beratKemasanValue = parseFloat(beratKemasanInput.value) || 0;
    var labelAwalValue = parseFloat(labelAwalInput.value) || 0;
    var beratBersihValid = stokBenihValue - berat_label_keluar;

    // Menghitung jumlahLabel dengan pembulatan ke bawah
    var jumlahLabelValue = beratKemasanValue !== 0 ? Math.floor(beratBersihValue / beratKemasanValue) : 0;

    // validasi input
    if (beratBersihValue > beratBersihValid) {
        beratBersihInput.setCustomValidity("Nilai input tidak valid, melebihi nilai maksimum yang diizinkan.");
    } else {
        beratBersihInput.setCustomValidity("");
    }

    // Menghitung labelAkhir
    var labelAkhirValue = labelAwalValue + jumlahLabelValue - 1;

    // Menetapkan kembali nilai input
    stokBenihInput.value = stokBenihValue;
    beratBersihInput.value = beratBersihValue;
    beratKemasanInput.value = beratKemasanValue;
    jumlahLabelInput.value = jumlahLabelValue;
    labelAwalInput.value = labelAwalValue;
    labelAkhirInput.value = labelAkhirValue;
}

// Kalkulasi saat halaman dimuat
$(document).ready(function() {
    kalkulasi();
});
</script>
@endpush
