@extends("template.t_admin")

@section("title", "Master Daftar User - Data Master")

@push("header")
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<style>
    #userTable th { white-space: nowrap; }
    #userTable td { vertical-align: middle; padding: 8px 10px; }
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
    .role-badge {
        display: inline-block;
        padding: 0.25rem 0.6rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 0.25rem;
        background: #17a2b8;
        color: #fff;
        white-space: nowrap;
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
                <h3 class="card-title">Data Master &raquo; Manajemen Daftar User</h3>
                <div class="card-tools">
                    <a href="{{ route('master.daftar-user.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                    <button type="button" class="btn btn-danger btn-sm ml-1" onclick="hapusData()">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                    <div class="input-group input-group-sm ml-2" style="width: 220px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="searchBox" class="form-control" placeholder="kata kunci pencarian" aria-controls="userTable">
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="userTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="40" class="text-center" data-priority="1">
                                    <input type="checkbox" id="checkAll" title="Pilih Semua">
                                </th>
                                <th width="50" class="text-center">No</th>
                                <th width="120" class="text-center">Username</th>
                                <th width="160" class="text-center">Nama</th>
                                <th width="150" class="text-center">Role</th>
                                <th width="120" class="text-center">NIP</th>
                                <th width="160" class="text-center">Nama Pegawai</th>
                                <th width="100" class="text-center">Wewenang</th>
                                <th width="120" class="text-center">Satgas</th>
                                <th width="120" class="text-center">Kabupaten</th>
                                <th width="120" class="text-center" data-priority="1">Aksi</th>
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

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="modalKonfirmasiHapus" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalKonfirmasiHapusLabel">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus Data
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modalKonfirmasiHapusMessage">Apakah Anda yakin ingin menghapus User ini?</p>
                <p class="text-muted small">
                    <i class="fas fa-info-circle"></i>
                    Data User yang dihapus tidak dapat dikembalikan lagi.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="button" class="btn btn-danger" id="btnKonfirmasiHapus">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Reset Password -->
<div class="modal fade" id="modalResetPassword" tabindex="-1" role="dialog" aria-labelledby="modalResetPasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="modalResetPasswordLabel">
                    <i class="fas fa-key"></i> Reset Password User
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formResetPassword" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="new_password">Password Baru <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="new_password"
                               class="form-control" minlength="6" placeholder="Minimal 6 karakter" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" id="new_password_confirmation"
                               class="form-control" minlength="6" placeholder="Ulangi password baru" required>
                    </div>
                    <p class="text-muted small">
                        <i class="fas fa-info-circle"></i>
                        Password akan diperbarui dan disimpan dengan hashing otomatis.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push("footer")
<!-- DataTables -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(function () {
        var table = $('#userTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('master.daftar-user.grid') }}",
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
                { "data": "username", "className": "text-center" },
                { "data": "name", "className": "text-center" },
                {
                    "data": "role_label",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        return '<span class="role-badge">' + $('<div>').text(data || row.role || '-').html() + '</span>';
                    }
                },
                { "data": "nip", "className": "text-center" },
                { "data": "nama_pegawai", "className": "text-center" },
                {
                    "data": "wewenang_data",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        var label = data ? data : '-';
                        return $('<div>').text(label).html();
                    }
                },
                { "data": "nama_satgas", "className": "text-center" },
                { "data": "nama_kabupaten", "className": "text-center" },
                {
                    "data": "id",
                    "orderable": false,
                    "searchable": false,
                    "className": "text-center",
                    "width": "120",
                    "render": function (data) {
                        var editUrl      = '{{ url("admin/master/daftar-user/edit") }}/' + data;
                        var deleteUrl    = '{{ url("admin/master/daftar-user/delete") }}/' + data;
                        var resetUrl     = '{{ url("admin/master/daftar-user/reset-password") }}/' + data;
                        return '<div class="action-buttons">' +
                               '<button type="button" class="btn btn-info btn-sm btn-reset-password" data-id="' + data + '" data-url="' + resetUrl + '" title="Reset Password">' +
                               '<i class="fas fa-key"></i></button> ' +
                               '<a href="' + editUrl + '" class="btn btn-warning btn-sm" title="Edit">' +
                               '<i class="fas fa-edit"></i></a> ' +
                               '<a href="' + deleteUrl + '" class="btn btn-danger btn-sm btn-hapus-satu" title="Hapus">' +
                               '<i class="fas fa-trash"></i></a></div>';
                    }
                }
            ],
            "order": [[1, "asc"]],
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
            } else if (selectedCount === totalRows && totalRows > 0) {
                $('#checkAll').prop('checked', true);
                $('#checkAll').prop('indeterminate', false);
            } else {
                $('#checkAll').prop('checked', false);
                $('#checkAll').prop('indeterminate', true);
            }
        }

        // Perubahan checkbox tiap baris
        $('#userTable tbody').on('change', '.checkItem', function () {
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
            $('#userTable tbody .checkItem').prop('checked', isChecked);
            syncCheckAllState();
        });

        // Terapkan ulang status pilihan setelah DataTables redraw
        table.on('draw', function () {
            $('#userTable tbody .checkItem').each(function () {
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

        // Intercept klik hapus-satu (pakai modal konfirmasi)
        $(document).on('click', '#userTable .btn-hapus-satu', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $('#modalKonfirmasiHapusMessage').text(
                'Apakah Anda yakin ingin menghapus User ini? ' +
                'Tindakan ini tidak dapat dibatalkan.'
            );
            $('#modalKonfirmasiHapus').data('mode', 'single').data('url', url);
            $('#modalKonfirmasiHapus').modal('show');
        });

        // Intercept klik reset password
        $(document).on('click', '#userTable .btn-reset-password', function (e) {
            e.preventDefault();
            var url = $(this).data('url');
            $('#formResetPassword').attr('action', url);
            $('#new_password').val('');
            $('#new_password_confirmation').val('');
            $('#modalResetPassword').modal('show');
        });
    });

    function hapusData() {
        var itemlist = (typeof window.getSelectedIds === 'function') ? window.getSelectedIds() : [];

        if (itemlist.length === 0) {
            alert('Pilih data User yang akan dihapus terlebih dahulu.');
            return;
        }

        $('#modalKonfirmasiHapusMessage').text(
            'Apakah Anda yakin ingin menghapus ' + itemlist.length +
            ' User yang dipilih? Tindakan ini tidak dapat dibatalkan.'
        );
        $('#modalKonfirmasiHapus').data('mode', 'bulk').data('ids', itemlist);
        $('#modalKonfirmasiHapus').modal('show');
    }

    // Eksekusi hapus (single / bulk) ketika tombol konfirmasi ditekan
    $(document).on('click', '#btnKonfirmasiHapus', function () {
        var $modal = $('#modalKonfirmasiHapus');
        var mode = $modal.data('mode');

        if (mode === 'single') {
            var url = $modal.data('url');
            window.location.href = url;
        } else if (mode === 'bulk') {
            var itemlist = $modal.data('ids') || [];
            $modal.modal('hide');
            $.ajax({
                type: 'POST',
                url: "{{ route('master.daftar-user.delete') }}",
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
    });
</script>
@endpush
