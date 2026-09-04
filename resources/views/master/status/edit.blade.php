@extends("template.t_admin")

@section("title", "Edit Master Status - Data Master")

@section("content")
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Data Master Status</h3>
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
                    <p class="text-muted">User melakukan pengisian form untuk mengubah data status.</p>
                </div>

                <a href="{{ route('master.status.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data Status
                </a>

                <form action="{{ route('master.status.update', $status->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="kode_hidden" value="{{ $status->kode_status }}">

                    <div class="form-group">
                        <label for="kode_status">Kode Status <span class="text-danger">*</span></label>
                        <input type="number" name="kode_status" id="kode_status"
                               class="form-control @error('kode_status') is-invalid @enderror"
                               value="{{ old('kode_status', $status->kode_status) }}"
                               min="0" max="25" placeholder="Masukkan Kode Status" required>
                        <small class="form-text text-muted">Kode numerik (0-25). Kode ini harus unik.</small>
                        @error('kode_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_status">Nama Status <span class="text-danger">*</span></label>
                        <input type="text" name="nama_status" id="nama_status"
                               class="form-control @error('nama_status') is-invalid @enderror"
                               value="{{ old('nama_status', $status->nama_status) }}"
                               placeholder="Masukkan Nama Status" required>
                        @error('nama_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_status">Status Master <span class="text-danger">*</span></label>
                        <select name="status_status" id="status_status"
                                class="form-control @error('status_status') is-invalid @enderror" required>
                            <option value="1" {{ old('status_status', $status->status_status) == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_status', $status->status_status) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_status')
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