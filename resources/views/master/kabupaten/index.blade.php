@extends("template.t_admin")

@section("title", "Master Kabupaten - Data Master")

@push("header")
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<style>
    #kabupatenTable th { white-space: nowrap; }
    #kabupatenTable td { vertical-align: middle; padding: 8px 10px; }
    .card-tools {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        align-items: center;
    }
    .card-tools .input-group {
        margin-bottom: 0;
    }
    .action-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: nowrap;
        gap: 0.35rem;
        white-space: nowrap;
    }
    .action-buttons .btn {
        margin: 0;
    }
    /* Soft colors for Aktif / Tidak Aktif badges */
    #kabupatenTable .badge.badge-success {
        background-color: #dff3e1 !important;
        color: #2e7d32 !important;
        border: 1px solid #c8e6c9;
    }
    #kabupatenTable .badge.badge-danger {
        background-color: #fde2e2 !important;
        color: #c62828 !important;
        border: 1px solid #efcfcf;
    }
</style>
@endpush

@section("content")
<div class="row">
    <div class="col-12">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fas fa-check"></i> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Master &raquo; Manajemen Kabupaten</h3>
                <div class="card-tools">
                    <a href="{{ route('master.kabupaten.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                    <button type="button" class="btn btn-danger btn-sm ml-1" onclick="hapusData()">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                    <div class="input-group input-group-sm ml-2" style="width: 220px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="searchBox" class="form-control" placeholder="kata kunci pencarian" aria-controls="kabupatenTable">
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="kabupatenTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="40" class="text-center" data-priority="1">
                                    <input type="checkbox" id="checkAll" title="Pilih Semua">
                                </th>
                                <th width="50" class="text-center">No</th>
                                <th width="120" class="text-center">Kode Satgas-Kabupaten</th>
                                <th width="120" class="text-center">Kode Nasional</th>
                                <th>Nama Kabupaten</th>
                                <th width="140" class="text-center">Satgas</th>
                                <th width="100" class="text-center">Status</th>
                                <th width="90" class="text-center" data-priority="1">Aksi</th>
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
        var table = $('#kabupatenTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('master.kabupaten.grid') }}",
                "type": "GET",
                "error": function (xhr, error, thrown) {
                    console.error('DataTables AJAX error:', error, thrown);
                    alert('Error loading data. Silakan periksa console untuk detail.');
                }
            },
            "columns": [
                {
                    "data": "id",
                    "orderable": false,
                    "searchable": false,
                    "className": "text-center",
                    "width": "40",
                    "render": function (data) {
                        return '<input type="checkbox" class="checkItem" name="items[]" value="' + data + '">';
                    }
                },
                {
                    "data": null,
                    "orderable": false,
                    "searchable": false,
                    "className": "text-center",
                    "width": "50",
                    "render": function (data, type, row, meta) {
                        return meta.row + 1 + meta.settings._iDisplayStart;
                    }
                },
                { "data": "kode_satkab", "className": "text-center" },
                { "data": "kode_kabupaten_nasional", "className": "text-center" },
                { "data": "nama_kabupaten" },
                {
                    "data": "satgas_label",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        return (data || '-');
                    }
                },
                {
                    "data": "status_kabupaten",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        var badgeClass = row.status_badge || 'badge-secondary';
                        var label = row.status_label || (data == '1' ? 'Aktif' : 'Tidak Aktif');
                        return '<span class="badge ' + badgeClass + '">' + label + '</span>';
                    }
                },
                {
                    "data": "id",
                    "orderable": false,
                    "searchable": false,
                    "className": "text-center",
                    "width": "90",
                    "render": function (data) {
                        var editUrl = '{{ url("admin/master/kabupaten/edit") }}/' + data;
                        var deleteUrl = '{{ url("admin/master/kabupaten/delete") }}/' + data;
                        return '<div class="action-buttons">' +
                               '<a href="' + editUrl + '" class="btn btn-warning btn-sm" title="Edit">' +
                               '<i class="fas fa-edit"></i></a> ' +
                               '<a href="' + deleteUrl + '" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">' +
                               '<i class="fas fa-trash"></i></a></div>';
                    }
                }
            ],
            "order": [[2, "asc"]],
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            }
        });

        // Live search pada kotak pencarian di header
        $('#searchBox').on('keyup', function () {
            table.search(this.value).draw();
        });

        // Set untuk melacak ID yang dipilih lintas halaman / search
        var selectedIds = new Set();

        function syncCheckAllState() {
            var totalRows = table.rows().count();
            var selectedCount = selectedIds.size;

            if (selectedCount === 0) {
                $('#checkAll').prop('checked', false);
                $('#checkAll').prop('indeterminate', false);
            } else if (selectedCount === totalRows) {
                $('#checkAll').prop('checked', true);
                $('#checkAll').prop('indeterminate', false);
            } else {
                $('#checkAll').prop('checked', false);
                $('#checkAll').prop('indeterminate', true);
            }
        }

        // Perubahan checkbox tiap baris
        $('#kabupatenTable tbody').on('change', '.checkItem', function () {
            var id = $(this).val();
            if (this.checked) {
                selectedIds.add(id);
            } else {
                selectedIds.delete(id);
            }
            syncCheckAllState();
        });

        // Check all (mencakup semua halaman via DataTables rows())
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
            $('#kabupatenTable tbody .checkItem').prop('checked', isChecked);
            syncCheckAllState();
        });

        // Terapkan ulang status pilihan setelah DataTables redraw
        table.on('draw', function () {
            $('#kabupatenTable tbody .checkItem').each(function () {
                var id = $(this).val();
                $(this).prop('checked', selectedIds.has(id));
            });
            syncCheckAllState();
        });

        // Helper agar dapat diakses oleh tombol Hapus
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
            url: "{{ route('master.kabupaten.delete') }}",
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