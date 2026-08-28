@php
    // Shared identity header for ALL sertifikasi phases.
    // Values are passed by the parent view; defaults kept for backward compatibility.
    $no_berkas = $no_berkas ?? 'TP26.401.0339';
    $no_induk_lapangan = $no_induk_lapangan ?? 'JghHI.R.3507120.0911.0339';
    $id_permohonan = $id_permohonan ?? 105271;
    $active_fase = $active_fase ?? 'pengajuan';
@endphp

<!-- Shared header styles (info-box + phase-nav) -->
<style>
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

<!-- Info Box -->
<div class="info-box">
    <div class="row align-items-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <strong>No. Berkas:</strong><br>
                    <span class="no-induk">{{ $no_berkas }}</span>
                </div>
                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                    <strong>No Induk Lapangan:</strong><br>
                    <span class="no-induk">{{ $no_induk_lapangan }}</span>
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

<!-- Phase Navigation -->
<div class="phase-nav">
    <strong>Fase:</strong>
    <a href="{{ url('') }}/admin/sertifikasi/pengajuan/edit/{{ $id_permohonan }}" {{ $active_fase == 'pengajuan' ? 'class="active"' : '' }}>Pengajuan</a>
    <a href="{{ url('') }}/admin/sertifikasi/pengajuan/fase_pendahuluan/{{ $id_permohonan }}" {{ $active_fase == 'pendahuluan' ? 'class="active"' : '' }}>Pendahuluan</a>
    <a href="{{ url('') }}/admin/sertifikasi/pengajuan/fase_vegetatif/{{ $id_permohonan }}" {{ $active_fase == 'vegetatif' ? 'class="active"' : '' }}>Vegetatif</a>
    <a href="{{ url('') }}/admin/sertifikasi/pengajuan/fase_berbunga/{{ $id_permohonan }}" {{ $active_fase == 'berbunga' ? 'class="active"' : '' }}>Berbunga</a>
    <a href="{{ url('') }}/admin/sertifikasi/pengajuan/fase_berbunga_ulangan/{{ $id_permohonan }}" {{ $active_fase == 'berbunga_ulangan' ? 'class="active"' : '' }}>Berb.Ulangan</a>
    <a href="{{ url('') }}/admin/sertifikasi/pengajuan/fase_masak/{{ $id_permohonan }}" {{ $active_fase == 'masak' ? 'class="active"' : '' }}>Masak</a>
    <a href="{{ url('') }}/admin/sertifikasi/pengajuan/fase_panen/{{ $id_permohonan }}" {{ $active_fase == 'panen' ? 'class="active"' : '' }}>Panen</a>
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
