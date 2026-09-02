@extends("template.t_admin")

@section("title", "Tambah Master Kelas Benih - Data Master")

@section("content")
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Input Data Master Kelas Benih</h3>
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
                    <p class="text-muted">User melakukan pengisian form untuk menambah data kelas benih.</p>
                </div>

                <a href="{{ route('master.kelas-benih.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data Kelas Benih
                </a>

                <form action="{{ route('master.kelas-benih.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="kode_kb">Kode Kelas Benih <span class="text-danger">*</span></label>
                        <input type="text" name="kode_kb" id="kode_kb"
                               class="form-control @error('kode_kb') is-invalid @enderror"
                               value="{{ old('kode_kb') }}"
                               maxlength="5" placeholder="Contoh: N, S, S1, D, D1" required>
                        <small class="form-text text-muted">Maksimal 5 karakter.</small>
                        @error('kode_kb')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_kb">Nama Kelas Benih <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kb" id="nama_kb"
                               class="form-control @error('nama_kb') is-invalid @enderror"
                               value="{{ old('nama_kb') }}"
                               placeholder="Contoh: Benih Inti, Benih Penjenis" required>
                        @error('nama_kb')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="grup_kelas_benih_id">Nama Grup Kelas Benih <span class="text-danger">*</span></label>
                        <select name="grup_kelas_benih_id" id="grup_kelas_benih_id"
                                class="form-control @error('grup_kelas_benih_id') is-invalid @enderror">
                            <option value="">-- Pilih Grup Kelas Benih --</option>
                            @foreach($grupKelasBenihList as $grup)
                                <option value="{{ $grup->id }}" {{ old('grup_kelas_benih_id') == $grup->id ? 'selected' : '' }}>
                                    {{ $grup->nama_grup_kelas_benih }}
                                </option>
                            @endforeach
                        </select>
                        @error('grup_kelas_benih_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_kelas_benih">Status Master <span class="text-danger">*</span></label>
                        <select name="status_kelas_benih" id="status_kelas_benih"
                                class="form-control @error('status_kelas_benih') is-invalid @enderror" required>
                            <option value="1" {{ old('status_kelas_benih', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_kelas_benih') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_kelas_benih')
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
