@extends("template.t_admin")

@section("title", "Edit Master Konfigurasi User - Data Master")

@section("content")
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Data Master Konfigurasi User</h3>
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
                    <p class="text-muted">User melakukan pengisian form untuk mengubah data konfigurasi.</p>
                </div>

                <a href="{{ route('master.konfigurasi-user.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data Konfigurasi User
                </a>

                <form action="{{ route('master.konfigurasi-user.update', $konfigurasiUser->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="nama_hidden" value="{{ $konfigurasiUser->nama_konfigurasi }}">

                    <div class="form-group">
                        <label for="nama_konfigurasi">Nama Konfigurasi <span class="text-danger">*</span></label>
                        <input type="text" name="nama_konfigurasi" id="nama_konfigurasi"
                               class="form-control @error('nama_konfigurasi') is-invalid @enderror"
                               value="{{ old('nama_konfigurasi', $konfigurasiUser->nama_konfigurasi) }}"
                               maxlength="255" placeholder="Masukkan Nama Konfigurasi" required>
                        <small class="form-text text-muted">Nama parameter konfigurasi (contoh pada sistem sumber: tahun, satgas, Otomatisasi no asal).</small>
                        @error('nama_konfigurasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nilai_konfigurasi">Nilai Konfigurasi <span class="text-danger">*</span></label>
                        <textarea name="nilai_konfigurasi" id="nilai_konfigurasi" rows="4"
                                  class="form-control @error('nilai_konfigurasi') is-invalid @enderror"
                                  placeholder="Masukkan Nilai Konfigurasi">{{ old('nilai_konfigurasi', $konfigurasiUser->nilai_konfigurasi) }}</textarea>
                        <small class="form-text text-muted">Nilai konfigurasi dalam bentuk string dinamis (contoh pada sistem sumber: 2026, Surabaya, false).</small>
                        @error('nilai_konfigurasi')
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
