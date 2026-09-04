@extends("template.t_admin")

@section("title", "Master Pegawai - Data Master")

@push("header")
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<style>
    #pegawaiTable th { white-space: nowrap; }
    #pegawaiTable td { vertical-align: middle; padding: 8px 10px; }
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
    #pegawaiTable .badge.badge-success {
        background-color: #dff3e1 !important;
        color: #2e7d32 !important;
        border: 1px solid #c8e6c9;
    }
    #pegawaiTable .badge.badge-danger {
        background-color: #fde2e2 !important;
        color: #c62828 !important;
        border: 1px solid #efcfcf;
    }
    /* Soft colors for Is Ka Korwil badges (primary/secondary) */
    #pegawaiTable .badge.badge-primary {
        background-color: #d6e4ff !important;
        color: #1e40af !important;
        border: 1px solid #bfd3ff;
    }
    #pegawaiTable .badge.badge-secondary {
        background-color: #e5e7eb !important;
        color: #4b5563 !important;
        border: 1px solid #d1d5db;
    }
    #pegawaiTable td.col-truncate {
        max-width: 220px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
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
                <h3 class="card-title">Data Master &raquo; Manajemen Pegawai</h3>
                <div class="card-tools">
                    <a href="{{ route('master.pegawai.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                    <button type="button" class="btn btn-danger btn-sm ml-1" onclick="konfirmasiHapusMassal()">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                    <div class="input-group input-group-sm ml-2" style="width: 220px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="searchBox" class="form-control" placeholder="kata kunci pencarian" aria-controls="pegawaiTable">
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="pegawaiTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="40" class="text-center" data-priority="1">
                                    <input type="checkbox" id="checkAll" title="Pilih Semua">
                                </th>
                                <th width="50" class="text-center">No</th>
                                <th width="80" class="text-center">Edit</th>
                                <th width="120" class="text-center">Nama satgas</th>
                                <th width="170" class="text-center">NIP Pegawai</th>
                                <th>Nama Pegawai</th>
                                <th width="220" class="text-center">Jabatan</th>
                                <th width="120" class="text-center">No Telp</th>
                                <th width="90" class="text-center">Status</th>
                                <th width="90" class="text-center">Ka Korwil</th>
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

<!-- Modal Konfirmasi Hapus (Massal) -->
<div class="modal fade" id="modalKonfirmasiHapus" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiHapusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalKonfirmasiHapusLabel">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus Data Pegawai
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modalKonfirmasiHapusBody">Apakah Anda yakin ingin menghapus data Pegawai yang dipilih?</p>
                <p class="text-muted small mb-0">
                    <i class="fas fa-info-circle"></i>
                    Data yang dihapus tidak dapat dikembalikan. Pastikan data yang dipilih sudah benar.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="button" class="btn btn-danger" id="btnKonfirmasiHapusMassal">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus (Tunggal) -->
<div class="modal fade" id="modalKonfirmasiHapusSingle" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiHapusSingleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalKonfirmasiHapusSingleLabel">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus Data Pegawai
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data Pegawai ini?</p>
                <p class="text-muted small mb-0">
                    <i class="fas fa-info-circle"></i>
                    Data yang dihapus tidak dapat dikembalikan. Pastikan data yang dipilih sudah benar.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <a href="#" class="btn btn-danger" id="btnKonfirmasiHapusSingle">
                    <i class="fas fa-trash"></i> Hapus
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push("footer")
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(function () {
        var table = $('#pegawaiTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('master.pegawai.grid') }}",
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
                {
                    "data": "id",
                    "orderable": false,
                    "searchable": false,
                    "className": "text-center",
                    "width": "80",
                    "render": function (data) {
                        var editUrl = '{{ url("admin/master/pegawai/edit") }}/' + data;
                        return '<a href="' + editUrl + '" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>';
                    }
                },
                {
                    "data": "nama_satgas",
                    "className": "text-center"
                },
                {
                    "data": "nip_pegawai",
                    "className": "text-center col-truncate",
                    "render": function (data) {
                        return data ? data : '<span class="text-muted">-</span>';
                    }
                },
                {
                    "data": "nama_pegawai"
                },
                {
                    "data": "jabatan",
                    "className": "text-center col-truncate",
                    "render": function (data) {
                        return data ? data : '<span class="text-muted">-</span>';
                    }
                },
                {
                    "data": "no_telp",
                    "className": "text-center",
                    "render": function (data) {
                        return data ? data : '<span class="text-muted">-</span>';
                    }
                },
                {
                    "data": "status_pegawai",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        var badgeClass = row.status_pegawai_badge || 'badge-secondary';
                        var label = row.status_pegawai_label || (data == '1' ? 'Aktif' : 'Tidak Aktif');
                        return '<span class="badge ' + badgeClass + '">' + label + '</span>';
                    }
                },
                {
                    "data": "is_ka_satgas",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        var badgeClass = row.is_ka_satgas_badge || 'badge-secondary';
                        var label = row.is_ka_satgas_label || (data == '1' ? 'YA' : 'Tidak');
                        return '<span class="badge ' + badgeClass + '">' + label + '</span>';
                    }
                }
            ],
            "order": [[5, "asc"]],
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": false,
            "scrollX": true,
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
        $('#pegawaiTable tbody').on('change', '.checkItem', function () {
            var id = $(this).val();
            if (this.checked) {
                selectedIds.add(id);
            } else {
                selectedIds.delete(id);
            }
            syncCheckAllState();
        });

        // Check all
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
            $('#pegawaiTable tbody .checkItem').prop('checked', isChecked);
            syncCheckAllState();
        });

        // Terapkan ulang status pilihan setelah DataTables redraw
        table.on('draw', function () {
            $('#pegawaiTable tbody .checkItem').each(function () {
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

    /**
     * Buka modal konfirmasi hapus massal.
     * Memicu proses hapus hanya jika user menekan tombol "Hapus"
     * pada modal (memilih "Hapus"). Tombol "Batal" membatalkan.
     */
    function konfirmasiHapusMassal() {
        var itemlist = (typeof window.getSelectedIds === 'function') ? window.getSelectedIds() : [];

        if (itemlist.length === 0) {
            alert('Pilih data yang akan dihapus terlebih dahulu.');
            return;
        }

        $('#modalKonfirmasiHapusBody').html(
            'Apakah Anda yakin ingin menghapus <strong>' + itemlist.length + '</strong> data Pegawai yang dipilih?'
        );
        $('#modalKonfirmasiHapus').modal('show');

        // Pasang handler satu kali pakai pada tombol konfirmasi
        $('#btnKonfirmasiHapusMassal').off('click').on('click', function () {
            $('#modalKonfirmasiHapus').modal('hide');
            hapusDataMassal();
        });
    }

    /**
     * Eksekusi penghapusan massal via AJAX (dipanggil dari modal).
     */
    function hapusDataMassal() {
        var itemlist = (typeof window.getSelectedIds === 'function') ? window.getSelectedIds() : [];

        if (itemlist.length === 0) {
            return;
        }

        $.ajax({
            type: 'POST',
            url: "{{ route('master.pegawai.delete') }}",
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
