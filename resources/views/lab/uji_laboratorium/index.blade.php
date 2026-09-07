@extends("template.t_admin")

@section("title", "Uji Laboratorium - Laboratorium")

@push("header")
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<style>
    /* === Table Responsive Wrapper & Layout (mengikuti pola Pengujian & fix scroll) === */
    .table-responsive-wrapper {
        width: 100%;
        overflow-x: auto;
        overflow-y: visible;
        -webkit-overflow-scrolling: touch;
        border: 1px solid #dee2e6;
        border-radius: 4px;
    }
    #ujiLabTable {
        width: 100% !important;
        table-layout: fixed;
        border-collapse: collapse !important;
        border-spacing: 0;
        margin-bottom: 0;
    }
    #ujiLabTable th,
    #ujiLabTable td {
        box-sizing: border-box;
        vertical-align: middle;
        padding: 8px 10px;
        font-size: 0.85rem;
        border: 1px solid #dee2e6;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    #ujiLabTable th {
        white-space: nowrap;
        background-color: #f4f6f6 !important;
        font-weight: 600 !important;
        font-size: 13px !important;
        color: #1f2d3d !important;
        letter-spacing: 0.2px;
        text-align: center;
    }
    #ujiLabTable td {
        white-space: normal;
    }

    /* Lebar kolom konsisten antara thead dan tbody */
    #ujiLabTable th:nth-child(1),  #ujiLabTable td:nth-child(1)  { width: 40px;  text-align: center; } /* Checkbox */
    #ujiLabTable th:nth-child(2),  #ujiLabTable td:nth-child(2)  { width: 50px;  text-align: center; } /* No */
    #ujiLabTable th:nth-child(3),  #ujiLabTable td:nth-child(3)  { width: 120px; text-align: center; } /* Komoditas */
    #ujiLabTable th:nth-child(4),  #ujiLabTable td:nth-child(4)  { width: 130px; text-align: center; } /* No Asal */
    #ujiLabTable th:nth-child(5),  #ujiLabTable td:nth-child(5)  { width: 110px; text-align: center; } /* No LAB */
    #ujiLabTable th:nth-child(6),  #ujiLabTable td:nth-child(6)  { width: 110px; text-align: center; } /* No LOT */
    #ujiLabTable th:nth-child(7),  #ujiLabTable td:nth-child(7)  { width: 160px; }                     /* Pengirim */
    #ujiLabTable th:nth-child(8),  #ujiLabTable td:nth-child(8)  { width: 130px; }                     /* Varietas */
    #ujiLabTable th:nth-child(9),  #ujiLabTable td:nth-child(9)  { width: 95px;  text-align: center; } /* Kelas Benih */
    #ujiLabTable th:nth-child(10), #ujiLabTable td:nth-child(10) { width: 120px; text-align: center; } /* Tgl Selesai Uji */
    #ujiLabTable th:nth-child(11), #ujiLabTable td:nth-child(11) { width: 130px; text-align: center; } /* Kesimpulan */
    #ujiLabTable th:nth-child(12), #ujiLabTable td:nth-child(12) { width: 120px; text-align: center; } /* Aksi */

    /* Toolbar & card tools */
    .card-tools {
        display: flex;
        gap: 0.4rem;
        flex-wrap: wrap;
        align-items: center;
    }
    .action-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: nowrap;
        gap: 0.3rem;
        white-space: nowrap;
    }
    .action-buttons .btn {
        margin: 0;
        padding: 0.25rem 0.45rem;
        font-size: 0.8rem;
    }

    /* Filter & Search Bar */
    .filter-panel {
        background-color: #f8f9fa;
        padding: 0.6rem 0.85rem;
        border: 1px solid #e9ecef;
        border-radius: 0.25rem;
        margin-bottom: 0.85rem;
    }
    .filter-panel .form-group {
        margin-bottom: 0;
        margin-right: 0.75rem;
    }
    .filter-panel label {
        margin-bottom: 0;
        margin-right: 0.4rem;
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* Petunjuk banner ala Pengujian (warna biru yang serasi) */
    .petunjuk-banner {
        background-color: #3c8dbc;
        color: #ffffff;
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 4px;
        margin-bottom: 12px;
        font-size: 0.85rem;
    }
    .petunjuk-banner marquee {
        vertical-align: middle;
    }

    /* Row highlight on selection ala Flexigrid */
    #ujiLabTable tbody tr {
        cursor: pointer;
        transition: background-color 0.15s ease;
    }
    #ujiLabTable tbody tr.table-selected,
    #ujiLabTable tbody tr.trSelected {
        background-color: #cfe2ff !important;
    }

    /* Soft colors for Kesimpulan badge */
    #ujiLabTable .badge {
        font-size: 0.75rem;
        padding: 0.35rem 0.5rem;
        font-weight: 500;
    }
    #ujiLabTable .badge.badge-success {
        background-color: #dff3e1 !important;
        color: #2e7d32 !important;
        border: 1px solid #c8e6c9;
    }
    #ujiLabTable .badge.badge-danger {
        background-color: #fde2e2 !important;
        color: #c62828 !important;
        border: 1px solid #efcfcf;
    }
    #ujiLabTable .badge.badge-warning {
        background-color: #fff8e1 !important;
        color: #f57f17 !important;
        border: 1px solid #ffe082;
    }

    /* DataTables wrapper alignment */
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        padding-top: 10px;
        font-size: 0.85rem;
    }
</style>
@endpush

@section("content")
<div class="row">
    <div class="col-12">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fas fa-exclamation-triangle mr-1"></i> {{ session('error') }}
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laboratorium > Uji Laboratorium</h3>
                <div class="card-tools">
                    <a href="{{ route('lab.uji_laboratorium.create') }}" class="btn btn-success btn-sm" title="Tambah Data Uji Lab">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                    <button type="button" class="btn btn-danger btn-sm ml-1" id="btnHapusMassal" onclick="hapusData()" disabled title="Hapus Data Terpilih">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                    <a href="{{ route('lab.buku_induk') }}" class="btn btn-info btn-sm ml-1" title="Rekap Pengujian Lab">
                        <i class="fas fa-book"></i> Rekap Pengujian Lab
                    </a>
                    <button type="button" class="btn btn-secondary btn-sm ml-1" onclick="printData()" title="Cetak Seluruh Data">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <!-- Filter & Search Toolbar (mengikuti UX Pengujian) -->
                <div class="filter-panel form-inline">
                    <div class="form-group mr-2">
                        <label for="filterTahun">Tahun:</label>
                        <select id="filterTahun" class="form-control form-control-sm" style="min-width: 100px;">
                            <option value="">-- Semua --</option>
                            <option value="2024" {{ request('tahun')=='2024'?'selected':'' }}>2024</option>
                            <option value="2025" {{ request('tahun')=='2025'?'selected':'' }}>2025</option>
                            <option value="2026" {{ request('tahun')=='2026'?'selected':'' }}>2026</option>
                        </select>
                    </div>

                    <div class="form-group mr-2">
                        <label for="searchField">Cari Berdasarkan:</label>
                        <select id="searchField" class="form-control form-control-sm" style="min-width: 140px;">
                            <option value="">Semua Kolom</option>
                            <option value="jenis_tanaman">Komoditas</option>
                            <option value="no_asal">No. Asal (Pengiriman)</option>
                            <option value="no_lab">No. LAB</option>
                            <option value="no_lot">No. LOT</option>
                            <option value="nama_produsen">Pengirim / Produsen</option>
                            <option value="varietas">Varietas</option>
                            <option value="kelas_benih">Kelas Benih</option>
                        </select>
                    </div>

                    <div class="form-group mr-2">
                        <div class="input-group input-group-sm" style="width: 220px;">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <input type="text" id="searchBox" class="form-control" placeholder="kata kunci pencarian...">
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-sm" id="btnFilter">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>

                <!-- Petunjuk Banner ala Halaman Pengujian -->
                <div class="petunjuk-banner">
                    <marquee align="center" scrollamount="3" behavior="alternate">&nbsp;Silakan klik baris atau kotak centang untuk memilih data, atau gunakan kolom pencarian untuk menyaring pengujian laboratorium.</marquee>
                </div>

                <!-- Table Wrapper (sejajar dan tidak goyang saat scroll horizontal) -->
                <div class="table-responsive-wrapper">
                    <table id="ujiLabTable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="40" class="text-center" data-priority="1">
                                    <input type="checkbox" id="checkAll" title="Pilih Semua di Halaman Ini">
                                </th>
                                <th width="50" class="text-center">No</th>
                                <th>Komoditas</th>
                                <th>No. Asal (Pengiriman)</th>
                                <th>No. LAB</th>
                                <th>No. LOT</th>
                                <th>Pengirim</th>
                                <th>Varietas</th>
                                <th>Kelas Benih</th>
                                <th>Tgl. Selesai Uji</th>
                                <th width="130" class="text-center">Kesimpulan</th>
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
@endsection

@push("footer")
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
    $(function () {
        // Pastikan menu sidebar Laboratorium -> Uji Laboratorium aktif dan terbuka
        (function ensureSidebarActive() {
            var targetUrl = "{{ route('lab.uji_laboratorium.index') }}";
            $('.nav-sidebar .nav-link').each(function () {
                var href = $(this).attr('href');
                if (href && (href === targetUrl || href.indexOf('admin/lab/uji') !== -1)) {
                    $(this).addClass('active');
                    $(this).closest('.nav-treeview').show()
                        .parent().addClass('menu-open')
                        .find('> a.nav-link').addClass('active');
                }
            });
        })();

        // Set tracking ID yang terpilih
        var selectedIds = new Set();

        // Inisialisasi DataTable server-side
        var table = $('#ujiLabTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('lab.uji_laboratorium.grid') }}",
                "type": "GET",
                "data": function (d) {
                    d.tahun = $('#filterTahun').val();
                    d.search_field = $('#searchField').val();
                    d.search.value = $('#searchBox').val();
                },
                "error": function (xhr, error, thrown) {
                    console.error('DataTables AJAX error:', error, thrown);
                    alert('Error loading data. Periksa console untuk detail.');
                }
            },
            "columns": [
                {
                    "data": "id",
                    "orderable": false,
                    "searchable": false,
                    "className": "text-center",
                    "render": function (data) {
                        var checked = selectedIds.has(String(data)) ? 'checked' : '';
                        return '<input type="checkbox" class="checkItem" value="' + data + '" ' + checked + ' onclick="event.stopPropagation();">';
                    }
                },
                {
                    "data": null,
                    "orderable": false,
                    "searchable": false,
                    "className": "text-center",
                    "render": function (data, type, row, meta) {
                        return meta.row + 1 + meta.settings._iDisplayStart;
                    }
                },
                {
                    "data": "jenis_tanaman",
                    "className": "text-center",
                    "render": function (data) {
                        return data ? '<strong>' + data + '</strong>' : '-';
                    }
                },
                { "data": "no_asal", "className": "text-center" },
                { "data": "no_lab", "className": "text-center" },
                { "data": "no_lot", "className": "text-center" },
                { "data": "nama_produsen" },
                { "data": "varietas" },
                { "data": "kelas_benih", "className": "text-center" },
                { "data": "tgl_selesai_pengujian", "className": "text-center" },
                {
                    "data": "kesimpulan",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        return '<span class="badge ' + (row.kesimpulan_badge || 'badge-secondary') + '">' + (row.kesimpulan_label || '-') + '</span>';
                    }
                },
                {
                    "data": "id",
                    "orderable": false,
                    "searchable": false,
                    "className": "text-center",
                    "render": function (data) {
                        var showUrl = '{{ url("admin/lab/uji/lihat") }}/' + data + '/1/1/lihat';
                        var editUrl = '{{ url("admin/lab/uji/edit") }}/' + data;
                        var cetakUrl = '{{ url("admin/lab/uji/cetak") }}/' + data;
                        return '<div class="action-buttons" onclick="event.stopPropagation();">' +
                               '<a href="' + showUrl + '" class="btn btn-info btn-xs" title="Lihat"><i class="fas fa-eye"></i></a>' +
                               '<a href="' + editUrl + '" class="btn btn-warning btn-xs" title="Edit"><i class="fas fa-edit"></i></a>' +
                               '<a href="' + cetakUrl + '" class="btn btn-secondary btn-xs" title="Cetak LHU" target="_blank"><i class="fas fa-print"></i></a>' +
                               '</div>';
                    }
                }
            ],
            "order": [[9, "desc"]],
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": false,
            "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6">>rtip',
            "language": {
                "sProcessing": "Memproses...",
                "sLengthMenu": "Tampilkan _MENU_ data",
                "sZeroRecords": "Tidak ditemukan data yang sesuai",
                "sInfo": "Menampilkan: _START_ hingga _END_ dari _TOTAL_ hasil.",
                "sInfoEmpty": "Menampilkan: 0 hingga 0 dari 0 hasil.",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sSearch": "Cari:",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "&laquo;",
                    "sNext": "&raquo;",
                    "sLast": "Terakhir"
                }
            },
            "drawCallback": function () {
                $('#ujiLabTable tbody tr').each(function () {
                    var chk = $(this).find('.checkItem');
                    if (chk.length) {
                        var id = String(chk.val());
                        if (selectedIds.has(id)) {
                            $(this).addClass('table-selected');
                            chk.prop('checked', true);
                        } else {
                            $(this).removeClass('table-selected');
                            chk.prop('checked', false);
                        }
                    }
                });
                syncSelectionUI();
            }
        });

        function syncSelectionUI() {
            var count = selectedIds.size;
            var visibleRows = $('#ujiLabTable tbody .checkItem').length;
            var visibleChecked = $('#ujiLabTable tbody .checkItem:checked').length;

            $('#checkAll').prop('checked', visibleRows > 0 && visibleRows === visibleChecked);
            $('#checkAll').prop('indeterminate', visibleChecked > 0 && visibleChecked < visibleRows);

            if (count > 0) {
                $('#btnHapusMassal').prop('disabled', false);
            } else {
                $('#btnHapusMassal').prop('disabled', true);
            }
        }

        $('#ujiLabTable tbody').on('click', 'tr', function (e) {
            if ($(e.target).closest('a, button, input').length) return;

            var chk = $(this).find('.checkItem');
            if (chk.length) {
                var id = String(chk.val());
                if (selectedIds.has(id)) {
                    selectedIds.delete(id);
                    $(this).removeClass('table-selected');
                    chk.prop('checked', false);
                } else {
                    selectedIds.add(id);
                    $(this).addClass('table-selected');
                    chk.prop('checked', true);
                }
                syncSelectionUI();
            }
        });

        $('#ujiLabTable tbody').on('change', '.checkItem', function () {
            var id = String($(this).val());
            var tr = $(this).closest('tr');
            if (this.checked) {
                selectedIds.add(id);
                tr.addClass('table-selected');
            } else {
                selectedIds.delete(id);
                tr.removeClass('table-selected');
            }
            syncSelectionUI();
        });

        $('#checkAll').on('change', function () {
            var isChecked = this.checked;
            $('#ujiLabTable tbody .checkItem').each(function () {
                var id = String($(this).val());
                var tr = $(this).closest('tr');
                if (isChecked) {
                    selectedIds.add(id);
                    tr.addClass('table-selected');
                    $(this).prop('checked', true);
                } else {
                    selectedIds.delete(id);
                    tr.removeClass('table-selected');
                    $(this).prop('checked', false);
                }
            });
            syncSelectionUI();
        });

        $('#btnFilter').on('click', function () {
            table.ajax.reload();
        });

        var searchTimer = null;
        $('#searchBox').on('input', function () {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function () {
                table.ajax.reload();
            }, 250);
        });

        $('#filterTahun, #searchField').on('change', function () {
            table.ajax.reload();
        });

        window.getSelectedUjiIds = function () {
            return Array.from(selectedIds);
        };
        window.clearSelectedUjiIds = function () {
            selectedIds.clear();
            syncSelectionUI();
        };
    });

    function hapusData() {
        var items = (typeof window.getSelectedUjiIds === 'function') ? window.getSelectedUjiIds() : [];

        if (items.length === 0) {
            alert('Pilih data yang akan dihapus terlebih dahulu.');
            return;
        }

        if (!confirm('Anda yakin ingin menghapus ' + items.length + ' buah data?')) {
            return;
        }

        $.ajax({
            type: 'POST',
            url: "{{ route('lab.uji_laboratorium.delete') }}",
            data: {
                items: items,
                _token: "{{ csrf_token() }}"
            },
            dataType: 'json',
            success: function (response) {
                alert((response && response.message) ? response.message : 'Data berhasil dihapus.');
                if (typeof window.clearSelectedUjiIds === 'function') {
                    window.clearSelectedUjiIds();
                }
                $('#ujiLabTable').DataTable().ajax.reload(null, false);
            },
            error: function (xhr) {
                var msg = 'Gagal menghapus data.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                } else if (xhr.status === 419) {
                    msg = 'Sesi telah kadaluarsa, silakan muat ulang halaman.';
                }
                alert('Terjadi kesalahan: ' + msg);
            }
        });
    }

    function printData() {
        window.open("{{ route('lab.uji_laboratorium.cetak', 'all') }}", "_blank");
    }
</script>
@endpush
