@extends("template.t_admin")

@section("title", "Uji Laboratorium - Laboratorium")

@push("header")
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
<style>
    #ujiLabTable th { white-space: nowrap; }
    #ujiLabTable td { vertical-align: middle; padding: 8px 10px; }
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
                <h3 class="card-title">Laboratorium > Uji Laboratorium</h3>
                <div class="card-tools">
                    <a href="{{ route('lab.uji_laboratorium.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                    <button type="button" class="btn btn-danger btn-sm ml-1" onclick="hapusData()">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                    <div class="input-group input-group-sm ml-2" style="width: 200px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="searchBox" class="form-control" placeholder="kata kunci pencarian" aria-controls="ujiLabTable">
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm ml-1" onclick="printData()">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Filter Form -->
                <form action="{{ route('lab.uji_laboratorium.index') }}" method="GET" class="filter-form form-inline">
                    <div class="form-group mr-3">
                        <label for="tahun" class="mr-2 font-weight-bold">Tahun :</label>
                        <select name="tahun" id="tahun" class="form-control form-control-sm" style="min-width: 120px;">
                            <option value="">-- Semua --</option>
                            <option value="2024" {{ request('tahun')=='2024'?'selected':'' }}>2024</option>
                            <option value="2025" {{ request('tahun')=='2025'?'selected':'' }}>2025</option>
                            <option value="2026" {{ request('tahun')=='2026'?'selected':'' }}>2026</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </form>

                <!-- Table -->
                <div class="table-responsive">
                    <table id="ujiLabTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="40" class="text-center" data-priority="1">
                                    <input type="checkbox" id="checkAll" title="Pilih Semua">
                                </th>
                                <th>No. Induk Lapangan</th>
                                <th>No. Berkas</th>
                                <th>Nama Produsen</th>
                                <th>Jenis Tanaman</th>
                                <th>Varietas</th>
                                <th>Kelas Benih</th>
                                <th>No. LOT</th>
                                <th>Tgl. LHU</th>
                                <th>Kesimpulan</th>
                                <th width="180" class="text-center" data-priority="1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $row)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="checkItem" name="items[]" value="{{ $row->id }}">
                                </td>
                                <td>{{ $row->no_induk_lapangan ?? '-' }}</td>
                                <td>{{ $row->no_berkas ?? '-' }}</td>
                                <td>{{ $row->nama_produsen ?? '-' }}</td>
                                <td>{{ $row->jenis_tanaman ?? '-' }}</td>
                                <td>{{ $row->varietas ?? '-' }}</td>
                                <td>{{ $row->kelas_benih ?? '-' }}</td>
                                <td>{{ $row->no_lot ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->tgl_lhu)->format('d-m-Y') ?? '-' }}</td>
                                <td>
                                    @if($row->kesimpulan == '1')
                                        <span class="badge badge-success">Memenuhi Syarat</span>
                                    @elseif($row->kesimpulan == '0')
                                        <span class="badge badge-danger">Tidak Memenuhi Syarat</span>
                                    @else
                                        <span class="badge badge-warning">Belum Ditentukan</span>
                                    @endif
                                </td>
                                <td class="text-center action-buttons">
                                    <a href="{{ route('lab.uji_laboratorium.show', [$row->id, 1, 1, 'lihat']) }}" class="btn btn-info btn-sm" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('lab.uji_laboratorium.edit', $row->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('lab.uji_laboratorium.cetak', $row->id) }}" class="btn btn-secondary btn-sm" title="Cetak" target="_blank">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="text-center">
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <p class="mb-0">Belum ada data uji laboratorium.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
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

@push("script")
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script>
    $(function () {
        var table = $('#ujiLabTable').DataTable({
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

        // Search functionality
        $('#searchBox').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Set to track selected item ids across pagination / search
        var selectedIds = new Set();

        // Sync the "check all" checkbox state (checked / indeterminate / unchecked)
        function syncCheckAllState() {
            var total = $('#ujiLabTable tbody .checkItem').length;
            var checked = $('#ujiLabTable tbody .checkItem:checked').length;
            $('#checkAll').prop('checked', total > 0 && total === checked);
            $('#checkAll').prop('indeterminate', checked > 0 && checked < total);
        }

        // Individual checkbox change
        $('#ujiLabTable tbody').on('change', '.checkItem', function () {
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
                    var cb = $(this.node()).find('.checkItem');
                    if (cb.length) {
                        selectedIds.add(cb.val());
                    }
                });
            } else {
                selectedIds.clear();
            }
            // Apply visual state to currently rendered rows
            $('#ujiLabTable tbody .checkItem').prop('checked', isChecked);
            syncCheckAllState();
        });

        // Re-apply selection state after DataTables redraw (search, pagination, sort, etc.)
        table.on('draw', function () {
            $('#ujiLabTable tbody .checkItem').each(function () {
                $(this).prop('checked', selectedIds.has($(this).val()));
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
            url: "{{ route('lab.uji_laboratorium.delete') }}",
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

    function printData() {
        window.open("{{ route('lab.uji_laboratorium.cetak', 'all') }}", "_blank");
    }
</script>
@endpush
