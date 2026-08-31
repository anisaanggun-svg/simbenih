@extends("template.t_admin")

@section("title", "Buku Induk Pengujian - Laboratorium")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laboratorium &nbsp;>&nbsp; Buku Induk</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="callout callout-info">
                    <h5 class="mb-0">Filter Berdasarkan Tanggal Terima</h5>
                </div>

                <form action="{{ route('lab.buku_induk.download') }}" method="POST" class="form-inline">
                    @csrf
                    <div class="form-group mr-3 mb-2">
                        <label for="tgl_awal" class="mr-2 font-weight-bold">Tgl Terima Awal :</label>
                        <input type="date" name="tgl_awal" id="tgl_awal" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group mr-3 mb-2">
                        <label for="tgl_akhir" class="mr-2 font-weight-bold">Tgl Terima Akhir :</label>
                        <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control form-control-sm" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mb-2">
                        <i class="fas fa-download"></i> Download Laporan
                    </button>
                </form>

                <hr>

                <p class="text-muted mb-0">
                    Laporan <strong>Buku Induk Pengujian Standar 1|4</strong> akan diunduh dalam format PDF
                    berdasarkan rentang Tanggal Terima (LHU) yang dipilih.
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection
