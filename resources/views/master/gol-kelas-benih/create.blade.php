@extends("template.t_admin")

@section("title", "Tambah Master Gol Kelas Benih - Data Master")

@section("content")
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Input Data Master Gol Kelas Benih</h3>
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
                    <p class="text-muted">User melakukan pengisian form untuk menambah data gol kelas benih.</p>
                </div>

                <a href="{{ route('master.gol-kelas-benih.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data Gol Kelas Benih
                </a>

                <form action="{{ route('master.gol-kelas-benih.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="kode_grup_kelas_benih">Kode Gol Kelas Benih <span class="text-danger">*</span></label>
                        <input type="text" name="kode_grup_kelas_benih" id="kode_grup_kelas_benih"
                               class="form-control @error('kode_grup_kelas_benih') is-invalid @enderror"
                               value="{{ old('kode_grup_kelas_benih') }}"
                               maxlength="10" placeholder="Contoh: NS, BS, BD" required>
                        <small class="form-text text-muted">Maksimal 10 karakter.</small>
                        @error('kode_grup_kelas_benih')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_grup_kelas_benih">Nama Gol Kelas Benih <span class="text-danger">*</span></label>
                        <input type="text" name="nama_grup_kelas_benih" id="nama_grup_kelas_benih"
                               class="form-control @error('nama_grup_kelas_benih') is-invalid @enderror"
                               value="{{ old('nama_grup_kelas_benih') }}"
                               placeholder="Contoh: Benih Inti, Benih Penjenis" required>
                        @error('nama_grup_kelas_benih')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="digit">Digit Label <span class="text-danger">*</span></label>
                        <input type="text" name="digit" id="digit"
                               class="form-control @error('digit') is-invalid @enderror"
                               value="{{ old('digit') }}"
                               maxlength="10" placeholder="Angka, contoh: 7" required>
                        <small class="form-text text-muted">Angka untuk digit label.</small>
                        @error('digit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="warna_label">Warna Label <span class="text-danger">*</span></label>
                        <input type="text" name="warna_label" id="warna_label"
                               class="form-control @error('warna_label') is-invalid @enderror"
                               value="{{ old('warna_label') }}"
                               maxlength="50" placeholder="Contoh: Kuning, Putih, Biru" required>
                        @error('warna_label')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_grup">Status Master <span class="text-danger">*</span></label>
                        <select name="status_grup" id="status_grup"
                                class="form-control @error('status_grup') is-invalid @enderror" required>
                            <option value="1" {{ old('status_grup', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_grup') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_grup')
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
