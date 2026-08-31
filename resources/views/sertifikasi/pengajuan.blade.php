@extends("template.t_admin")

@section("title", "Pengajuan & Fase Lapangan")

@push("header")
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
<style>
    .dataTables_wrapper .dataTables_filter input {
        margin-left: 0.5em;
    }
    .table-responsive {
        overflow-x: auto;
    }
    .btn-group .dropdown-toggle {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    .action-buttons .btn {
        margin-right: 0.25rem;
    }
    .action-buttons .btn:last-child {
        margin-right: 0;
    }
    #pengajuanTable th {
        white-space: nowrap;
    }
    #pengajuanTable td {
        vertical-align: middle;
    }
    .filter-form {
        background-color: #f8f9fa;
        padding: 0.5rem 0.75rem;
        border-radius: 0.25rem;
        margin-bottom: 0.75rem;
    }
    .filter-form .form-group {
        margin-bottom: 0;
        margin-right: 1rem;
    }
    .filter-form label {
        margin-bottom: 0;
        margin-right: 0.5rem;
        font-weight: 600;
        font-size: 0.875rem;
    }
    .card-tools {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        align-items: center;
    }
    .card-tools .input-group {
        margin-bottom: 0;
    }
</style>
@endpush

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Sertifikasi > Data Pengajuan & Fase Lapangan</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-success btn-sm" onclick="tambahData()">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                    <button type="button" class="btn btn-danger btn-sm ml-1" onclick="hapusData()">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                    <div class="input-group input-group-sm ml-2" style="width: 200px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="searchBox" class="form-control" placeholder="kata kunci pencarian" aria-controls="pengajuanTable">
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm ml-1" onclick="printData()">
                        <i class="fas fa-print"></i> Print
                    </button>
                    <button type="button" class="btn btn-success btn-sm ml-1" onclick="exportExcel()">
                        <i class="fas fa-file-excel"></i> Excel
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Filter Form -->
                <form action="{{ url('') }}/admin/sertifikasi/pengajuan" method="GET" class="filter-form form-inline">
                    <div class="form-group mr-3">
                        <label for="jenis_data" class="mr-2 font-weight-bold">Jenis Data :</label>
                        <select name="jenis_data" id="jenis_data" class="form-control" style="min-width: 150px;">
                            <option value="a" {{ request('jenis_data') == 'a' ? 'selected' : '' }}>Semua</option>
                            <option value="v" {{ request('jenis_data') == 'v' ? 'selected' : '' }}>Vegetatif</option>
                            <option value="g" {{ request('jenis_data') == 'g' ? 'selected' : '' }}>Generatif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </form>

                <!-- Table -->
                <div class="table-responsive">
                    <table id="pengajuanTable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="40" class="text-center">
                                    <input type="checkbox" id="checkAll" title="Pilih Semua">
                                </th>
                                <th class="text-center">No</th>
                                <th class="text-center" width="60">Lihat</th>
                                <th class="text-center" width="60">Edit</th>
                                <th class="text-center">MT</th>
                                <th>Nomer Berkas</th>
                                <th>Nomer Induk</th>
                                <th>Wil.Kerja-Kab</th>
                                <th>Nama Produsen</th>
                                <th>Alamat Produsen</th>
                                <th>Komoditas</th>
                                <th>Varietas</th>
                                <th>Blok</th>
                                <th class="text-right">Luas Aju</th>
                                <th class="text-right">Luas Fase Terakhir</th>
                                <th class="text-center">Satuan</th>
                                <th class="text-center">Kls Bnh Awal</th>
                                <th class="text-center">Kls Bnh Akhir</th>
                                <th class="text-center">Tgl Permohonan</th>
                                <th class="text-center">Tgl Realisasi Tanam</th>
                                <th class="text-center">Tgl Entri Data</th>
                                <th>Nama Fase Terakhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data ?? [] as $item)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="row-check" value="{{ $item->id ?? '' }}">
                                </td>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center action-buttons">
                                    <a href="{{ url('') }}/admin/sertifikasi/pengajuan/lihat/{{ $item->id ?? '' }}" class="btn btn-xs btn-info" title="Lihat Detail">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </td>
                                <td class="text-center action-buttons">
                                    <a href="{{ url('') }}/admin/sertifikasi/pengajuan/edit/{{ $item->id ?? '' }}" class="btn btn-xs btn-warning" title="Edit Data">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td class="text-center">{{ $item->musim_tanam ?? '-' }}</td>
                                <td>{{ $item->kode_unik_sertifikasi ?? '-' }}</td>
                                <td>{{ $item->no_induk_lapangan ?? '-' }}</td>
                                <td>{{ $item->kode_wilayah ?? '-' }}</td>
                                <td>{{ $item->nama_produsen ?? '-' }}</td>
                                <td>{{ $item->nama_kabupaten_produsen ?? '-' }}</td>
                                <td>{{ $item->nama_tanaman ?? '-' }}</td>
                                <td>{{ $item->nama_varietas ?? '-' }}</td>
                                <td>{{ $item->blok ?? '-' }}</td>
                                <td class="text-right">{{ $item->luas_aju ?? '-' }}</td>
                                <td class="text-right">{{ $item->luas_fase ?? '-' }}</td>
                                <td class="text-center">{{ $item->nama_satuan ?? '-' }}</td>
                                <td class="text-center">{{ $item->kelas_benih_aju ?? '-' }}</td>
                                <td class="text-center">{{ $item->current_kelas_benih ?? '-' }}</td>
                                <td class="text-center">{{ $item->tgl_permohonan ?? '-' }}</td>
                                <td class="text-center">{{ $item->tgl_tanam_betina_awal ?? '-' }}</td>
                                <td class="text-center">{{ $item->tgl_entri ?? '-' }}</td>
                                <td>{{ $item->nama_fase ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="22" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <p class="mb-0">Tidak ada data tersedia</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            @if(isset($data) && count($data) > 0)
            <div class="card-footer clearfix">
                <div class="float-left">
                    Menampilkan {{ count($data) }} data
                </div>
            </div>
            @endif
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

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
@endsection

@push("footer")
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
$(function() {
    $("#pengajuanTable").DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength": 25,
        "lengthMenu": [10, 25, 50, 100],
        "order": [[1, "asc"]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json"
        },
        "dom": 'lrtip',
        "columnDefs": [
            { "orderable": false, "targets": [0, 2, 3] },
            { "className": "text-center", "targets": [0, 1, 2, 3, 4, 13, 14, 15, 16, 17, 18, 19, 20] },
            { "className": "text-right", "targets": [13, 14] }
        ]
    });

    // Check all checkbox
    $("#checkAll").click(function() {
        $(".row-check").prop("checked", this.checked);
    });

    // Custom search box
    $('#searchBox').on('keyup', function() {
        table.search(this.value).draw();
    });
    var table = $('#pengajuanTable').DataTable();
});

function tambahData() {
    $('#modalInputPermohonan').modal('show');
}

function pilihTipeForm() {
    var tipeForm = document.getElementById("tipeFormPermohonan").value;
    if (!tipeForm) {
        alert('Pilih tipe form terlebih dahulu!');
        return false;
    }
    window.location.href = "{{ url('') }}/admin/sertifikasi/pengajuan/tambah?tipe=" + tipeForm;
}

function hapusData() {
    var selected = $(".row-check:checked");
    if (selected.length === 0) {
        alert("Pilih data yang akan dihapus!");
        return false;
    }
    if (confirm("Anda yakin ingin menghapus " + selected.length + " buah data?")) {
        var itemlist = selected.map(function() { return this.value; }).get().join(",");
        $.post("{{ url('') }}/admin/sertifikasi/pengajuan/hapus", {_token:"{{ csrf_token() }}", items: itemlist}, function(d){
            alert(d.message || 'Berhasil');
            location.reload();
        });
    }
}

function printData() {
    window.open("{{ url('') }}/admin/sertifikasi/pengajuan/cetak", "_blank");
}

function exportExcel() {
    window.location.href = "{{ url('') }}/admin/sertifikasi/pengajuan/get_laporan";
}
</script>
@endpush
