@extends("template.t_admin")

@section("title", "Pasca Lapangan - Sertifikasi")

@push("header")
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
<style>
    #pascaTable th { white-space: nowrap; }
    #pascaTable td { vertical-align: middle; padding: 8px 10px; }
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
    .action-buttons .btn {
        margin-right: 0.25rem;
    }
    .action-buttons .btn:last-child {
        margin-right: 0;
    }
    .table-responsive {
        overflow-x: auto;
    }
</style>
@endpush

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Sertifikasi > Data Pasca Lapangan</h3>
                <div class="card-tools">
                    <a href="{{ url('') }}/admin/sertifikasi/pasca_lapangan/tambah" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                    <button type="button" class="btn btn-danger btn-sm ml-1" onclick="hapusData()">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                    <div class="input-group input-group-sm ml-2" style="width: 200px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="searchBox" class="form-control" placeholder="kata kunci pencarian" aria-controls="pascaTable">
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
                <form action="{{ url('') }}/admin/sertifikasi/pasca_lapangan" method="GET" class="filter-form form-inline">
                    <div class="form-group mr-3">
                        <label for="musim_tanam" class="mr-2 font-weight-bold">Musim Tanam :</label>
                        <select name="musim_tanam" id="musim_tanam" class="form-control form-control-sm" style="min-width: 120px;">
                            <option value="">-- Semua --</option>
                            <option value="2024" {{ request('musim_tanam')=='2024'?'selected':'' }}>2024</option>
                            <option value="2025" {{ request('musim_tanam')=='2025'?'selected':'' }}>2025</option>
                            <option value="2026" {{ request('musim_tanam')=='2026'?'selected':'' }}>2026</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </form>

                <!-- Table -->
                <div class="table-responsive">
                    <table id="pascaTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="40" class="text-center">
                                    <input type="checkbox" id="checkAll" title="Pilih Semua">
                                </th>
                                <th class="text-center">No</th>
                                <th class="text-center" width="60">Lihat</th>
                                <th class="text-center" width="60">Edit</th>
                                <th>No Berkas</th>
                                <th>No Asal</th>
                                <th>Produsen Awal</th>
                                <th>Nomor Induk</th>
                                <th>Produsen Akhir</th>
                                <th>No LOT Olah</th>
                                <th>No LOT PCB</th>
                                <th class="text-center" width="80">Print Pengolahan</th>
                                <th class="text-center" width="80">Print PCB</th>
                                <th class="text-center" width="80">Print Pengiriman</th>
                                <th class="text-center" width="80">Hasil Uji Lengkap</th>
                                <th class="text-center" width="80">Sertifikat</th>
                                <th>No Konsep</th>
                                <th>Kemasan</th>
                                <th class="text-center" width="80">Supervisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data ?? [] as $i => $row)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="row-check" value="{{ $row->id ?? '' }}">
                                </td>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td class="text-center action-buttons">
                                    <a href="{{ url('') }}/admin/sertifikasi/pasca_lapangan/lihat/{{ $row->id ?? '' }}" class="btn btn-xs btn-info" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td class="text-center action-buttons">
                                    <a href="{{ url('') }}/admin/sertifikasi/pasca_lapangan/pengolahan/{{ $row->id ?? '' }}" class="btn btn-xs btn-warning" title="Edit Pengolahan">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>{{ $row->kode_unik_sertifikasi ?? '-' }}</td>
                                <td>{{ $row->no_asal ?? '-' }}</td>
                                <td>{{ $row->nama_produsen_aju ?? '-' }}</td>
                                <td>{{ $row->no_induk_lapangan ?? '-' }}</td>
                                <td>{{ $row->produsen_lhu ?? '-' }}</td>
                                <td>{{ $row->no_kelompok_benih ?? '-' }}</td>
                                <td>{{ $row->no_kelompok_benih_pcb ?? '-' }}</td>
                                <td class="text-center action-buttons">
                                    <a href="{{ url('') }}/admin/sertifikasi/pasca_lapangan/cetak/pengolahan/{{ $row->id ?? '' }}" class="btn btn-xs btn-secondary" target="_blank" title="Cetak Pengolahan">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </td>
                                <td class="text-center action-buttons">
                                    <a href="{{ url('') }}/admin/sertifikasi/pasca_lapangan/cetak/pcb/{{ $row->id ?? '' }}" class="btn btn-xs btn-warning" target="_blank" title="Cetak PCB">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </td>
                                <td class="text-center action-buttons">
                                    <a href="{{ url('') }}/admin/sertifikasi/pasca_lapangan/cetak/pengiriman/{{ $row->id ?? '' }}" class="btn btn-xs btn-info" target="_blank" title="Cetak Pengiriman">
                                        <i class="fas fa-truck"></i>
                                    </a>
                                </td>
                                <td class="text-center action-buttons">
                                    <a href="{{ url('') }}/admin/sertifikasi/pasca_lapangan/cetak/uji_lengkap/{{ $row->id ?? '' }}" class="btn btn-xs btn-primary" target="_blank" title="Hasil Uji Lengkap">
                                        <i class="fas fa-flask"></i>
                                    </a>
                                </td>
                                <td class="text-center action-buttons">
                                    <a href="{{ url('') }}/admin/sertifikasi/pasca_lapangan/cetak/sertifikat/{{ $row->id ?? '' }}" class="btn btn-xs btn-success" target="_blank" title="Cetak Sertifikat">
                                        <i class="fas fa-certificate"></i>
                                    </a>
                                </td>
                                <td>{{ $row->no_konsep ?? '-' }}</td>
                                <td>{{ $row->berat_kemasan ?? '-' }}</td>
                                <td class="text-center action-buttons">
                                    <a href="{{ url('') }}/admin/sertifikasi/pasca_lapangan/cetak/supervisi/{{ $row->id ?? '' }}" class="btn btn-xs btn-dark" target="_blank" title="Cetak Supervisi">
                                        <i class="fas fa-user-check"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="19" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <p class="mb-0">Belum ada data pasca lapangan.</p>
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
@endsection

@push("footer")
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
$(function() {
    $("#pascaTable").DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength": 10,
        "lengthMenu": [5, 10, 25, 50],
        "order": [[4, "asc"]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json"
        },
        "dom": 'lrtip',
        "columnDefs": [
            { "orderable": false, "targets": [0, 2, 3, 11, 12, 13, 14, 15, 18] },
            { "className": "text-center", "targets": [0, 1, 2, 3, 11, 12, 13, 14, 15, 18] }
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
    var table = $('#pascaTable').DataTable();
});

function hapusData() {
    var selected = $(".row-check:checked");
    if (selected.length === 0) {
        alert("Pilih data yang akan dihapus!");
        return false;
    }
    if (confirm("Anda yakin ingin menghapus " + selected.length + " buah data?")) {
        var itemlist = selected.map(function() { return this.value; }).get().join(",");
        // AJAX delete here
        alert("Data terpilih: " + itemlist);
    }
}

function printData() {
    window.open("{{ url('') }}/admin/sertifikasi/pasca_lapangan/cetak", "_blank");
}

function exportExcel() {
    window.location.href = "{{ url('') }}/admin/sertifikasi/pasca_lapangan/export_excel";
}
</script>
@endpush
