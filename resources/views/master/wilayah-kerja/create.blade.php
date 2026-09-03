@extends("template.t_admin")

@section("title", "Tambah Master Wilayah Kerja - Data Master")

@section("content")
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Input Data Master Wilayah Kerja</h3>
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
                    <p class="text-muted">User melakukan pengisian form untuk menambah data Wilayah Kerja (Satgas).</p>
                </div>

                <a href="{{ route('master.wilayah-kerja.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data Wilayah Kerja
                </a>

                <form action="{{ route('master.wilayah-kerja.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="kode_satgas">Kode Wilayah Kerja <span class="text-danger">*</span></label>
                        <input type="number" name="kode_satgas" id="kode_satgas"
                               class="form-control @error('kode_satgas') is-invalid @enderror"
                               value="{{ old('kode_satgas') }}"
                               min="0" max="255" placeholder="Contoh: 1, 2, 3" required>
                        <small class="form-text text-muted">Kode numerik 0-255. Kode ini harus unik dan digunakan sebagai referensi pada data Kabupaten.</small>
                        @error('kode_satgas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_satgas">Nama Wilayah Kerja <span class="text-danger">*</span></label>
                        <input type="text" name="nama_satgas" id="nama_satgas"
                               class="form-control @error('nama_satgas') is-invalid @enderror"
                               value="{{ old('nama_satgas') }}"
                               placeholder="Contoh: Surabaya, Madiun, Kediri, Malang, Jember, Banyuwangi" required>
                        @error('nama_satgas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_satgas">Status Master <span class="text-danger">*</span></label>
                        <select name="status_satgas" id="status_satgas"
                                class="form-control @error('status_satgas') is-invalid @enderror" required>
                            <option value="1" {{ old('status_satgas', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_satgas') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_satgas')
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