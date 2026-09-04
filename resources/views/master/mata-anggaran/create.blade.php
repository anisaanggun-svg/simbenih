@extends("template.t_admin")

@section("title", "Tambah Master M. Anggaran - Data Master")

@section("content")
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Input Data Master M. Anggaran</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="info mb-3">
                    <p class="text-muted">User melakukan pengisian form untuk menambah data mata anggaran.</p>
                </div>

                <a href="{{ route('master.mata-anggaran.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data M. Anggaran
                </a>

                <form action="{{ route('master.mata-anggaran.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="kode_mata_anggaran">Kode Mata Anggaran <span class="text-danger">*</span></label>
                        <input type="text" name="kode_mata_anggaran" id="kode_mata_anggaran"
                               class="form-control @error('kode_mata_anggaran') is-invalid @enderror"
                               value="{{ old('kode_mata_anggaran') }}"
                               maxlength="50" placeholder="Contoh: N, D, P, AL" required>
                        <small class="form-text text-muted">Kode ini harus unik (contoh pada sistem sumber: N=APBN, D=APBD, P=Pemurnian, AL=Anggaran Lain).</small>
                        @error('kode_mata_anggaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_mata_anggaran">Nama Mata Anggaran <span class="text-danger">*</span></label>
                        <input type="text" name="nama_mata_anggaran" id="nama_mata_anggaran"
                               class="form-control @error('nama_mata_anggaran') is-invalid @enderror"
                               value="{{ old('nama_mata_anggaran') }}"
                               placeholder="Contoh: APBN, APBD, Pemurnian, Anggaran Lain" required>
                        @error('nama_mata_anggaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_mata_anggaran">Status Master <span class="text-danger">*</span></label>
                        <select name="status_mata_anggaran" id="status_mata_anggaran"
                                class="form-control @error('status_mata_anggaran') is-invalid @enderror" required>
                            <option value="1" {{ old('status_mata_anggaran', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_mata_anggaran') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_mata_anggaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection
