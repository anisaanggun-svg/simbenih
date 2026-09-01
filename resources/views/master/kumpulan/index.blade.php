@extends("template.t_admin")

@section("title", "Master Kumpulan - Data Master")

@push("header")
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<style>
    #kumpulanTable th { white-space: nowrap; }
    #kumpulanTable td { vertical-align: middle; padding: 8px 10px; }
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
                <h3 class="card-title">Data Master &raquo; Manajemen Kumpulan</h3>
                <div class="card-tools">
                    <a href="{{ route('master.kumpulan.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                    <button type="button" class="btn btn-danger btn-sm ml-1" onclick="hapusData()">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                    <div class="input-group input-group-sm ml-2" style="width: 220px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="searchBox" class="form-control" placeholder="kata kunci pencarian" aria-controls="kumpulanTable">
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="kumpulanTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="40" class="text-center" data-priority="1">
                                    <input type="checkbox" id="checkAll" title="Pilih Semua">
                                </th>
                                <th width="50" class="text-center">No</th>
                                <th width="100" class="text-center">Kode Kumpulan</th>
                                <th width="160">Nama Kumpulan</th>
                                <th width="140">Nama Golongan</th>
                                <th width="100" class="text-center">Jenis Golongan</th>
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
        var table = $('#kumpulanTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('master.kumpulan.grid') }}",
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
                { "data": "kode_golongan", "className": "text-center" },
                { "data": "nama_golongan" },
                { "data": "nama_komoditas" },
                {
                    "data": "jenis_label",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        var badgeClass = row.jenis_badge || 'badge-secondary';
                        return '<span class="badge ' + badgeClass + '">' + (data || '-') + '</span>';
                    }
                },
                {
                    "data": "status_golongan",
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
                        var editUrl = '{{ url("admin/master/kumpulan/edit") }}/' + data;
                        var deleteUrl = '{{ url("admin/master/kumpulan/delete") }}/' + data;
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
            "searching": true,
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
            var total = $('#kumpulanTable tbody .checkItem').length;
            var checked = $('#kumpulanTable tbody .checkItem:checked').length;
            $('#checkAll').prop('checked', total > 0 && total === checked);
            $('#checkAll').prop('indeterminate', checked > 0 && checked < total);
        }

        // Perubahan checkbox tiap baris
        $('#kumpulanTable tbody').on('change', '.checkItem', function () {
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
            $('#kumpulanTable tbody .checkItem').prop('checked', isChecked);
            syncCheckAllState();
        });

        // Terapkan ulang status pilihan setelah DataTables redraw
        table.on('draw', function () {
            $('#kumpulanTable tbody .checkItem').each(function () {
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
            url: "{{ route('master.kumpulan.delete') }}",
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