@extends("template.t_admin")

@section("title", "Tambah Master Satuan - Data Master")

@section("content")
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Input Data Master Satuan</h3>
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
                    <p class="text-muted">User melakukan pengisian form untuk menambah data satuan.</p>
                </div>

                <a href="{{ route('master.satuan.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data Satuan
                </a>

                <form action="{{ route('master.satuan.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="kode_satuan">Kode Satuan <span class="text-danger">*</span></label>
                        <input type="text" name="kode_satuan" id="kode_satuan"
                               class="form-control @error('kode_satuan') is-invalid @enderror"
                               value="{{ old('kode_satuan') }}"
                               maxlength="50" placeholder="Contoh: Ton, Kg, Gr, Btg" required>
                        <small class="form-text text-muted">Maksimal 50 karakter. Kode ini harus unik (contoh pada sistem sumber: Ton, Kg, Gr, Btg, Knol, Planlet, Ha).</small>
                        @error('kode_satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_satuan">Nama Satuan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_satuan" id="nama_satuan"
                               class="form-control @error('nama_satuan') is-invalid @enderror"
                               value="{{ old('nama_satuan') }}"
                               placeholder="Contoh: Ton, Kilogram, Gram, Batang" required>
                        @error('nama_satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenis_satuan">Jenis Satuan <span class="text-danger">*</span></label>
                        <select name="jenis_satuan" id="jenis_satuan"
                                class="form-control @error('jenis_satuan') is-invalid @enderror" required>
                            <option value="0" {{ old('jenis_satuan', '0') == '0' ? 'selected' : '' }}>-- Pilih Jenis Satuan --</option>
                            @foreach(\App\Models\Satuan::jenisSatuanOptions() as $jenis)
                                <option value="{{ $jenis }}" {{ old('jenis_satuan') == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                            @endforeach
                        </select>
                        @error('jenis_satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="pengali">Pengali <span class="text-danger">*</span></label>
                        <input type="number" name="pengali" id="pengali"
                               class="form-control @error('pengali') is-invalid @enderror"
                               value="{{ old('pengali', 1) }}"
                               min="1" step="1" placeholder="Contoh: 1000" required>
                        <small class="form-text text-muted">Pengali ke satuan terkecil (MiliGram untuk Satuan Berat, Meter Persegi untuk Satuan Luas). Isikan nilai "1" jika satuan tidak bisa dikonversikan.</small>
                        @error('pengali')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_satuan">Status Master <span class="text-danger">*</span></label>
                        <select name="status_satuan" id="status_satuan"
                                class="form-control @error('status_satuan') is-invalid @enderror" required>
                            <option value="1" {{ old('status_satuan', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_satuan') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_satuan')
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
