@extends("template.t_admin")

@section("title", "Master Jenis Tanaman - Data Master")

@push("header")
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<style>
    /* === Tabel fix: header & body tetap sejajar saat horizontal scroll === */
    .table-responsive-wrapper {
        width: 100%;
        overflow-x: auto;
        overflow-y: visible;
        -webkit-overflow-scrolling: touch;
        border: 1px solid #dee2e6;
        border-radius: 4px;
    }
    #jenisTanamanTable {
        width: 100% !important;
        max-width: 100%;
        table-layout: fixed;
        border-collapse: collapse !important;
        border-spacing: 0;
        margin-bottom: 0;
    }
    #jenisTanamanTable th,
    #jenisTanamanTable td {
        box-sizing: border-box;
        vertical-align: middle;
        padding: 6px 8px;
        font-size: 0.85rem;
        border: 1px solid #dee2e6;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    #jenisTanamanTable th {
        white-space: nowrap;
        background-color: #f4f6f6 !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        color: #1f2d3d !important;
        letter-spacing: 0.2px;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
        padding-left: 12px !important;
        padding-right: 12px !important;
    }
    #jenisTanamanTable td {
        white-space: normal;
        font-size: 0.85rem;
    }
    #jenisTanamanTable .badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.4rem;
    }

    /* Lebar kolom konsisten antara thead dan tbody */
    #jenisTanamanTable th:nth-child(1),  #jenisTanamanTable td:nth-child(1)  { width: 60px;  text-align: center; }
    #jenisTanamanTable th:nth-child(2),  #jenisTanamanTable td:nth-child(2)  { width: 120px; text-align: center; }
    #jenisTanamanTable th:nth-child(3),  #jenisTanamanTable td:nth-child(3)  { width: 220px; }
    #jenisTanamanTable th:nth-child(4),  #jenisTanamanTable td:nth-child(4)  { width: 150px; text-align: center; }
    #jenisTanamanTable th:nth-child(5),  #jenisTanamanTable td:nth-child(5)  { width: 180px; }
    #jenisTanamanTable th:nth-child(6),  #jenisTanamanTable td:nth-child(6)  { width: 170px; text-align: center; }
    #jenisTanamanTable th:nth-child(7),  #jenisTanamanTable td:nth-child(7)  { width: 130px; text-align: center; }
    #jenisTanamanTable th:nth-child(8),  #jenisTanamanTable td:nth-child(8)  { width: 140px; text-align: center; }
    #jenisTanamanTable th:nth-child(9),  #jenisTanamanTable td:nth-child(9)  { width: 150px; text-align: center; }
    #jenisTanamanTable th:nth-child(10), #jenisTanamanTable td:nth-child(10) { width: 130px; text-align: center; }
    #jenisTanamanTable th:nth-child(11), #jenisTanamanTable td:nth-child(11) { width: 130px; text-align: center; }
    #jenisTanamanTable th:nth-child(n+12):not(:last-child),
    #jenisTanamanTable td:nth-child(n+12):not(:last-child) { width: 95px; text-align: center; }
    #jenisTanamanTable th:last-child, #jenisTanamanTable td:last-child { width: 110px; text-align: center; }

    /* Card tools */
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
        gap: 0.25rem;
        white-space: nowrap;
    }
    .action-buttons .btn {
        margin: 0;
        padding: 0.25rem 0.5rem;
        font-size: 0.8rem;
    }

    /* Soft colors for Ya / Tidak badges */
    #jenisTanamanTable .badge.badge-success {
        background-color: #dff3e1 !important;
        color: #2e7d32 !important;
        border: 1px solid #c8e6c9;
    }
    #jenisTanamanTable .badge.badge-danger {
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
                <h3 class="card-title">Data Master &raquo; Manajemen Jenis Tanaman</h3>
                <div class="card-tools">
                    <a href="{{ route('master.jenis-tanaman.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                    <button type="button" class="btn btn-danger btn-sm ml-1" onclick="hapusData()">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                    <div class="input-group input-group-sm ml-2" style="width: 200px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="searchBox" class="form-control" placeholder="kata kunci pencarian" aria-controls="jenisTanamanTable">
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Table -->
                <div class="table-responsive-wrapper">
                    <table id="jenisTanamanTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="40" class="text-center all" data-priority="1">
                                    <input type="checkbox" id="checkAll" title="Pilih Semua">
                                </th>
                                <th width="50" class="text-center">No</th>
                                <th width="100" class="text-center">Kode</th>
                                <th width="180">Nama Tanaman</th>
                                <th width="120" class="text-center">Jenis Perbanyakan</th>
                                <th width="150">Nama Perbanyakan</th>
                                <th width="120" class="text-center">Satuan Penangkaran</th>
                                <th width="100" class="text-center">Satuan Produk</th>
                                <th width="100" class="text-center">Satuan Kemasan</th>
                                <th width="100" class="text-center">Pop. Pemeriksaan</th>
                                <th width="100" class="text-center">Pop. Jantan</th>
                                <th width="100" class="text-center">Pop. Betina</th>
                                <th width="80" class="text-center">Pend</th>
                                <th width="80" class="text-center">Veg</th>
                                <th width="80" class="text-center">Veg 1</th>
                                <th width="80" class="text-center">Veg 2</th>
                                <th width="80" class="text-center">Veg 3</th>
                                <th width="80" class="text-center">Veg.Ulang</th>
                                <th width="80" class="text-center">Bunga1</th>
                                <th width="80" class="text-center">Bunga2</th>
                                <th width="80" class="text-center">Bunga3</th>
                                <th width="80" class="text-center">Bunga U.</th>
                                <th width="80" class="text-center">Masak</th>
                                <th width="80" class="text-center">Masak U.</th>
                                <th width="80" class="text-center">Panen</th>
                                <th width="80" class="text-center">Pngolahn</th>
                                <th width="80" class="text-center">Siap Siar</th>
                                <th width="80" class="text-center">Ambil Cnth</th>
                                <th width="80" class="text-center">Kirim Cnth</th>
                                <th width="80" class="text-center">Kaji U.</th>
                                <th width="80" class="text-center">Uji Air</th>
                                <th width="80" class="text-center">Uji Murni</th>
                                <th width="80" class="text-center">Uji CVL</th>
                                <th width="80" class="text-center">Uji Wrn Lain</th>
                                <th width="80" class="text-center">Penilaian</th>
                                <th width="80" class="text-center">Seri Label</th>
                                <th width="80" class="text-center">Status</th>
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

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="modalKonfirmasiHapus" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalKonfirmasiHapusLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i> Konfirmasi Hapus Data
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus <strong id="hapusCount" class="text-danger">0</strong> data yang dipilih?</p>
                <p class="text-muted small mb-0"><i class="fas fa-info-circle mr-1"></i> Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Batal
                </button>
                <button type="button" class="btn btn-danger" id="btnConfirmHapus">
                    <i class="fas fa-trash mr-1"></i> Ya, Hapus
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
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(function () {
        var table = $('#jenisTanamanTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('master.jenis-tanaman.grid') }}",
                "type": "GET",
                "error": function (xhr, error, thrown) {
                    console.error('DataTables AJAX error:', error, thrown);
                    alert('Error loading data. Silakan periksa console untuk detail.');
                }
            },
            "scrollX": false,
            "autoWidth": false,
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
                { "data": "kode_tanaman", "className": "text-center" },
                { "data": "nama_tanaman" },
                {
                    "data": "klasifikasi",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        return (data || '-');
                    }
                },
                { "data": "nama_perbanyakan" },
                { "data": "satuan_penangkaran", "className": "text-center" },
                { "data": "satuan_produk", "className": "text-center" },
                { "data": "nama_satuan", "className": "text-center" },
                { "data": "populasi_pemeriksaan", "className": "text-center" },
                { "data": "populasi_pemeriksaan_jantan", "className": "text-center" },
                { "data": "populasi_pemeriksaan_betina", "className": "text-center" },
                {
                    "data": "pendahuluan",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "vegetatif",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "vegetatif1",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "vegetatif2",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "vegetatif3",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "vegetatif_ulangan",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "berbunga1",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "berbunga2",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "berbunga3",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "berbunga_ulangan",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "masak",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "masak_ulangan",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "panen",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "pengolahan",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "siap_siar",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "pengambilan_contoh",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "pengiriman_contoh",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "kaji_ulang",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "uji_kadar_air",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "uji_kemurnian",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "uji_cvl",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "uji_warna_lain",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "penilaian",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "seri_label",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        if (data == 'Ya') return '<span class="badge badge-success">Ya</span>';
                        if (data == 'Tidak') return '<span class="badge badge-danger">Tidak</span>';
                        return '<span class="badge badge-secondary">-</span>';
                    }
                },
                {
                    "data": "status",
                    "className": "text-center",
                    "render": function (data, type, row) {
                        var badgeClass = row.status_badge || 'badge-secondary';
                        return '<span class="badge ' + badgeClass + '">' + (data || '-') + '</span>';
                    }
                },
                {
                    "data": "id",
                    "orderable": false,
                    "searchable": false,
                    "className": "text-center",
                    "render": function (data, type, row) {
                        var editUrl = '{{ url("admin/master/jenis-tanaman/edit") }}/' + data;
                        var deleteUrl = '{{ url("admin/master/jenis-tanaman/delete") }}/' + data;
                        return '<div class="action-buttons"><a href="' + editUrl + '" class="btn btn-warning btn-sm" title="Edit">' +
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
            "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6">>rtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "drawCallback": function(settings) {
                console.log('DataTables draw callback', settings.json);
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
        $('#jenisTanamanTable tbody').on('change', '.checkItem', function () {
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
            $('#jenisTanamanTable tbody .checkItem').prop('checked', isChecked);
            syncCheckAllState();
        });

        // Terapkan ulang status pilihan setelah DataTables redraw
        table.on('draw', function () {
            $('#jenisTanamanTable tbody .checkItem').each(function () {
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

        // Konfirmasi hapus via modal
        $('#btnConfirmHapus').on('click', function () {
            $('#modalKonfirmasiHapus').modal('hide');
            var itemlist = (typeof window.getSelectedIds === 'function') ? window.getSelectedIds() : [];
            if (itemlist.length === 0) return;
            $.ajax({
                type: 'POST',
                url: "{{ route('master.jenis-tanaman.delete') }}",
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
        });
    });

    function hapusData() {
        var itemlist = (typeof window.getSelectedIds === 'function') ? window.getSelectedIds() : [];

        if (itemlist.length === 0) {
            alert('Pilih data yang akan dihapus terlebih dahulu.');
            return;
        }

        $('#hapusCount').text(itemlist.length);
        $('#modalKonfirmasiHapus').modal('show');
    }
</script>
@endpush
