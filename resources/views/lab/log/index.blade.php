@extends("template.t_admin")

@section("title", "Laboratorium Log - Manajemen Aplikasi")

@push("header")
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<style>
    #logTable th { white-space: nowrap; }
    #logTable td { vertical-align: middle; padding: 8px 10px; }
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
    .log-cell {
        max-width: 500px;
        word-wrap: break-word;
        white-space: normal;
    }
</style>
@endpush

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laboratorium > Laboratorium Log</h3>
                <div class="card-tools">
                    <a href="{{ route('lab.log.download_excel') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel"></i> Excel
                    </a>
                    <button type="button" class="btn btn-danger btn-sm ml-1" onclick="hapusData()">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                    <div class="input-group input-group-sm ml-2" style="width: 200px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="searchBox" class="form-control" placeholder="kata kunci pencarian" aria-controls="logTable">
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Filter Form -->
                <form action="{{ route('lab.log.index') }}" method="GET" class="filter-form form-inline">
                    <div class="form-group mr-3">
                        <label for="tgl_awal" class="mr-2 font-weight-bold">Tgl Awal :</label>
                        <input type="date" name="tgl_awal" id="tgl_awal" class="form-control form-control-sm" value="{{ request('tgl_awal') }}">
                    </div>
                    <div class="form-group mr-3">
                        <label for="tgl_akhir" class="mr-2 font-weight-bold">Tgl Akhir :</label>
                        <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control form-control-sm" value="{{ request('tgl_akhir') }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </form>

                <!-- Info text -->
                <div class="alert alert-info py-2 mb-3">
                    <i class="fas fa-info-circle"></i>&nbsp;Silakan klik gambar "kaca pembesar" di kiri bawah untuk melakukan pencarian / filtering data.
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table id="logTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="40" class="text-center" data-priority="1">
                                    <input type="checkbox" id="checkAll" title="Pilih Semua">
                                </th>
                                <th width="50" class="text-center">No</th>
                                <th>Nama Pengguna</th>
                                <th>Aksi</th>
                                <th width="150" class="text-center">Tanggal</th>
                                <th width="100" class="text-center">Pengguna</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(function () {
        var table = $('#logTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('lab.log.grid') }}",
                "type": "GET",
                "data": function (d) {
                    d.tgl_awal = $('#tgl_awal').val();
                    d.tgl_akhir = $('#tgl_akhir').val();
                }
            },
            "columns": [
                {
                    "data": null,
                    "orderable": false,
                    "searchable": false,
                    "className": "text-center",
                    "width": "40",
                    "render": function (data, type, row, meta) {
                        return '<input type="checkbox" class="checkItem" name="items[]" value="' + row.id + '">';
                    }
                },
                { "data": "no", "className": "text-center", "width": "50" },
                { "data": "nama" },
                { "data": "log", "className": "log-cell" },
                { "data": "logdate", "className": "text-center" },
                { "data": "username", "className": "text-center" }
            ],
            "order": [[4, "desc"]],
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "columnDefs": [
                { "orderable": false, "targets": [0, 2] }
            ]
        });

        // Search functionality
        $('#searchBox').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Set to track selected item ids across pagination / search
        var selectedIds = new Set();

        // Sync the "check all" checkbox state (checked / indeterminate / unchecked)
        function syncCheckAllState() {
            var total = $('#logTable tbody .checkItem').length;
            var checked = $('#logTable tbody .checkItem:checked').length;
            $('#checkAll').prop('checked', total > 0 && total === checked);
            $('#checkAll').prop('indeterminate', checked > 0 && checked < total);
        }

        // Individual checkbox change
        $('#logTable tbody').on('change', '.checkItem', function () {
            var id = $(this).val();
            if (this.checked) {
                selectedIds.add(id);
            } else {
                selectedIds.delete(id);
            }
            syncCheckAllState();
        });

        // Check all / uncheck all (works across all pages via DataTables nodes)
        $('#checkAll').on('change', function () {
            var isChecked = this.checked;
            if (isChecked) {
                table.rows().every(function () {
                    var rowData = this.data();
                    if (rowData && rowData.id) {
                        selectedIds.add(String(rowData.id));
                    }
                });
            } else {
                selectedIds.clear();
            }
            // Apply visual state to currently rendered rows
            $('#logTable tbody .checkItem').prop('checked', isChecked);
            syncCheckAllState();
        });

        // Re-apply selection state after DataTables redraw (search, pagination, sort, etc.)
        table.on('draw', function () {
            $('#logTable tbody .checkItem').each(function () {
                var id = $(this).val();
                $(this).prop('checked', selectedIds.has(id));
            });
            syncCheckAllState();
        });

        // Expose helpers for the delete handler
        window.getSelectedIds = function () {
            return Array.from(selectedIds);
        };
        window.clearSelectedIds = function () {
            selectedIds.clear();
        };
    });

    function hapusData() {
        var itemlist = (typeof window.getSelectedIds === 'function') ? window.getSelectedIds() : [];

        if (itemlist.length === 0) {
            alert('Pilih data yang akan dihapus terlebih dahulu.');
            return;
        }

        if (!confirm('Apakah Anda yakin ingin menghapus ' + itemlist.length + ' data yang dipilih?')) {
            return;
        }

        $.ajax({
            type: 'POST',
            url: "{{ route('lab.log.delete') }}",
            data: { items: itemlist, _token: "{{ csrf_token() }}" },
            dataType: 'json',
            success: function (response) {
                alert((response && response.message) ? response.message : 'Data berhasil dihapus.');
                if (typeof window.clearSelectedIds === 'function') {
                    window.clearSelectedIds();
                }
                location.reload();
            },
            error: function (xhr) {
                var msg = 'Gagal menghapus data.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                } else if (xhr.status === 419) {
                    msg = 'Sesi kadaluarsa, silakan muat ulang halaman.';
                }
                alert('Terjadi kesalahan: ' + msg);
            }
        });
    }
</script>
@endpush
