@extends("template.t_admin")

@section("title", "Konsep Label - Sertifikasi")

@push("header")
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
<style>
    #konsepLabelTable th { white-space: nowrap; }
    #konsepLabelTable td { vertical-align: middle; padding: 8px 10px; }
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
                <h3 class="card-title">Sertifikasi > Konsep Label</h3>
                <div class="card-tools">
                    <a href="{{ url('') }}/admin/sertifikasi/label/permohonan" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                    <button type="button" class="btn btn-danger btn-sm ml-1" onclick="hapusData()">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                    <div class="input-group input-group-sm ml-2" style="width: 200px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="searchBox" class="form-control" placeholder="kata kunci pencarian" aria-controls="konsepLabelTable">
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm ml-1" onclick="printData()">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Table -->
                <div class="table-responsive">
                    <table id="konsepLabelTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="40" class="text-center">
                                    <input type="checkbox" id="checkAll" title="Pilih Semua">
                                </th>
                                <th class="text-center">No</th>
                                <th class="text-center" width="60">Lihat</th>
                                <th class="text-center" width="60">Edit</th>
                                <th class="text-center" width="60">Print</th>
                                <th>No. Asal</th>
                                <th>PRODUSEN</th>
                                <th>Nomor Induk</th>
                                <th>No. Konsep</th>
                                <th>No. LOT</th>
                                <th class="text-center">Stok Benih</th>
                                <th class="text-center">Berat Bersih</th>
                                <th class="text-center">Isi Kemasan</th>
                                <th>No. Seri Label Awal</th>
                                <th>No. Seri Label Akhir</th>
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
                                    <a href="{{ $row->lihat ?? '#' }}" class="btn btn-xs btn-info" title="Lihat Detail" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td class="text-center action-buttons">
                                    <a href="{{ $row->edit ?? '#' }}" class="btn btn-xs btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td class="text-center action-buttons">
                                    <a href="{{ $row->print ?? '#' }}" class="btn btn-xs btn-secondary" title="Print" target="_blank">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </td>
                                <td>{{ $row->no_asal ?? '-' }}</td>
                                <td>{{ $row->nama_produsen ?? '-' }}</td>
                                <td>{{ $row->no_induk_lapangan ?? '-' }}</td>
                                <td>{{ $row->no_konsep ?? '-' }}</td>
                                <td>{{ $row->no_kelompok_benih ?? '-' }}</td>
                                <td class="text-center">{{ $row->stok_benih ?? '-' }}</td>
                                <td class="text-center">{{ $row->berat_bersih ?? '-' }}</td>
                                <td class="text-center">{{ $row->berat_kemasan ?? '-' }}</td>
                                <td>{{ $row->label_awal ?? '-' }}</td>
                                <td>{{ $row->label_akhir ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="15" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <p class="mb-0">Belum ada data konsep label.</p>
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

<script>
$(function() {
    var table = $("#konsepLabelTable").DataTable({
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
            { "orderable": false, "targets": [0, 2, 3, 4] },
            { "className": "text-center", "targets": [0, 1, 2, 3, 4, 9, 10, 11] }
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
});

function hapusData() {
    var selected = $(".row-check:checked");
    if (selected.length === 0) {
        alert("Pilih data yang akan dihapus!");
        return false;
    }
    // Show confirmation modal
    $('#hapusCount').text(selected.length);
    $('#modalKonfirmasiHapus').modal('show');
    
    // Handle confirm button click
    $('#btnConfirmHapus').off('click').on('click', function() {
        var itemlist = selected.map(function() { return this.value; }).get().join(",");
        $.ajax({
            type: 'POST',
            url: "{{ route('sertifikasi.konsep_label.delete') }}",
            data: { items: itemlist, _token: "{{ csrf_token() }}" },
            success: function(data) {
                $('#modalKonfirmasiHapus').modal('hide');
                alert(data.message);
                location.reload();
            }
        });
    });
}

function printData() {
    window.open("{{ url('') }}/admin/sertifikasi/label/cetak", "_blank");
}
</script>
@endpush
