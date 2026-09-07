@extends("template.t_admin")

@section("title", "Download Excel - Serti Log")

@section("content")
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Export Excel Data Serti Log</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="info mb-3">
                    <h5 class="text-primary">Pilih Filter Excel</h5>
                </div>

                <fieldset class="border p-3 mb-3">
                    <legend class="w-auto px-2" style="font-size: 1rem; font-weight: bold;">| Download Data Serti Log |</legend>
                    <form action="{{ route('app.serti_log.export_excel') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="tgl_awal" class="col-sm-3 col-form-label">Tgl Awal</label>
                            <div class="col-sm-9">
                                <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_akhir" class="col-sm-3 col-form-label">Tgl Akhir</label>
                            <div class="col-sm-9">
                                <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-download"></i> Download Excel
                                </button>
                                <a href="{{ route('app.serti_log.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection
