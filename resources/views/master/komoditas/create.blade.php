@extends("template.t_admin")

@section("title", "Tambah Master Golongan - Data Master")

@section("content")
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Input Data Master Golongan</h3>
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
                    <p class="text-muted">User melakukan pengisian form untuk menambah data golongan</p>
                </div>

                <a href="{{ route('master.komoditas.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data Komoditas
                </a>

                <form action="{{ route('master.komoditas.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kode_komoditas">Kode Golongan <span class="text-danger">*</span></label>
                        <input type="text" name="kode_komoditas" id="kode_komoditas"
                               class="form-control @error('kode_komoditas') is-invalid @enderror"
                               value="{{ old('kode_komoditas') }}"
                               maxlength="5" placeholder="Masukkan Kode Golongan" required>
                        @error('kode_komoditas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_komoditas">Nama Golongan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_komoditas" id="nama_komoditas"
                               class="form-control @error('nama_komoditas') is-invalid @enderror"
                               value="{{ old('nama_komoditas') }}"
                               placeholder="Masukkan Nama Golongan" required>
                        @error('nama_komoditas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_komoditas">Status Master <span class="text-danger">*</span></label>
                        <select name="status_komoditas" id="status_komoditas"
                                class="form-control @error('status_komoditas') is-invalid @enderror" required>
                            <option value="1" {{ old('status_komoditas', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_komoditas') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_komoditas')
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
