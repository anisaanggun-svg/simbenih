@extends("template.t_admin")

@section("title", "Permohonan Konsep Label - Sertifikasi")

@push("header")
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
<style>
    #permohonanTable th { white-space: nowrap; }
    #permohonanTable td { vertical-align: middle; padding: 8px 10px; }
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
                <h3 class="card-title">Sertifikasi > Permintaan No Seri Label > Daftar Data Rekomendasi Benih</h3>
                <div class="card-tools">
                    <a href="{{ url('') }}/admin/sertifikasi/label" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Konsep Label
                    </a>
                    <div class="input-group input-group-sm ml-2" style="width: 200px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="searchBox" class="form-control" placeholder="kata kunci pencarian" aria-controls="permohonanTable">
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Table -->
                <div class="table-responsive">
                    <table id="permohonanTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center" width="50">Input</th>
                                <th>Nomor Induk Lengkap</th>
                                <th>Nomor Lot</th>
                                <th>Nomor Asal</th>
                                <th>Kelas Benih</th>
                                <th class="text-center">Berat Benih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data ?? [] as $i => $row)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td class="text-center action-buttons">
                                    <a href="{{ $row->input ?? '#' }}" class="btn btn-xs btn-success" title="Input Konsep Label">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>{{ $row->no_dokumen ?? '-' }}</td>
                                <td>{{ $row->no_lot ?? '-' }}</td>
                                <td>{{ $row->no_asal ?? '-' }}</td>
                                <td>{{ $row->nama_kelas_benih ?? '-' }}</td>
                                <td class="text-center">{{ $row->berat_kelompok_benih ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <p class="mb-0">Belum ada data permohonan konsep label.</p>
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
    var table = $("#permohonanTable").DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength": 10,
        "lengthMenu": [5, 10, 25, 50],
        "order": [[0, "asc"]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json"
        },
        "dom": 'lrtip',
        "columnDefs": [
            { "orderable": false, "targets": [1] },
            { "className": "text-center", "targets": [0, 1, 6] }
        ]
    });

    // Custom search box
    $('#searchBox').on('keyup', function() {
        table.search(this.value).draw();
    });
});
</script>
@endpush
