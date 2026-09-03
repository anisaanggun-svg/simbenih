@extends("template.t_admin")

@section("title", "Tambah Master Penyakit - Data Master")

@section("content")
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Input Data Master Penyakit</h3>
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
                    <p class="text-muted">User melakukan pengisian form untuk menambah data penyakit.</p>
                </div>

                <a href="{{ route('master.penyakit.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data Penyakit
                </a>

                <form action="{{ route('master.penyakit.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="kode_penyakit">Kode Penyakit <span class="text-danger">*</span></label>
                        <input type="text" name="kode_penyakit" id="kode_penyakit"
                               class="form-control @error('kode_penyakit') is-invalid @enderror"
                               value="{{ old('kode_penyakit') }}"
                               maxlength="10" placeholder="Contoh: A, B1, P-01" required>
                        <small class="form-text text-muted">Maksimal 10 karakter.</small>
                        @error('kode_penyakit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kelompok_penyakit">Kelompok Penyakit <span class="text-danger">*</span></label>
                        <select name="kelompok_penyakit" id="kelompok_penyakit"
                                class="form-control @error('kelompok_penyakit') is-invalid @enderror" required>
                            <option value="">-- Pilih Kelompok Penyakit --</option>
                            @foreach(\App\Models\Penyakit::kelompokOptions() as $key => $label)
                                <option value="{{ $key }}" {{ old('kelompok_penyakit') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('kelompok_penyakit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_penyakit">Nama Penyakit <span class="text-danger">*</span></label>
                        <input type="text" name="nama_penyakit" id="nama_penyakit"
                               class="form-control @error('nama_penyakit') is-invalid @enderror"
                               value="{{ old('nama_penyakit') }}"
                               placeholder="Contoh: Aphid, Blas, Hawar Daun" required>
                        @error('nama_penyakit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="ket_penyakit">Keterangan Penyakit</label>
                        <input type="text" name="ket_penyakit" id="ket_penyakit"
                               class="form-control @error('ket_penyakit') is-invalid @enderror"
                               value="{{ old('ket_penyakit') }}"
                               maxlength="255" placeholder="Keterangan singkat (opsional)">
                        @error('ket_penyakit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_penyakit">Status Master <span class="text-danger">*</span></label>
                        <select name="status_penyakit" id="status_penyakit"
                                class="form-control @error('status_penyakit') is-invalid @enderror" required>
                            <option value="1" {{ old('status_penyakit', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_penyakit') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_penyakit')
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