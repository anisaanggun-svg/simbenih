@extends("template.t_admin")

@section("title", "Edit Master Kecamatan - Data Master")

@section("content")
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Data Master Kecamatan</h3>
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
                    <p class="text-muted">User melakukan pengisian form untuk mengubah data kecamatan.</p>
                </div>

                <a href="{{ route('master.kecamatan.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data Kecamatan
                </a>

                <form action="{{ route('master.kecamatan.update', $kecamatan->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="kode_hidden" value="{{ $kecamatan->kode_kecamatan }}">

                    <div class="form-group">
                        <label for="kode_kecamatan">Kode Kecamatan <span class="text-danger">*</span></label>
                        <input type="text" name="kode_kecamatan" id="kode_kecamatan"
                               class="form-control @error('kode_kecamatan') is-invalid @enderror"
                               value="{{ old('kode_kecamatan', $kecamatan->kode_kecamatan) }}"
                               maxlength="10" placeholder="Masukkan Kode Kecamatan" required>
                        <small class="form-text text-muted">Maksimal 10 karakter. Kode ini harus unik.</small>
                        @error('kode_kecamatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kode_kecamatan_nasional">Kode Kecamatan Nasional <span class="text-danger">*</span></label>
                        <input type="text" name="kode_kecamatan_nasional" id="kode_kecamatan_nasional"
                               class="form-control @error('kode_kecamatan_nasional') is-invalid @enderror"
                               value="{{ old('kode_kecamatan_nasional', $kecamatan->kode_kecamatan_nasional) }}"
                               maxlength="10" placeholder="Masukkan Kode Kecamatan Nasional" required>
                        @error('kode_kecamatan_nasional')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_kecamatan">Nama Kecamatan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kecamatan" id="nama_kecamatan"
                               class="form-control @error('nama_kecamatan') is-invalid @enderror"
                               value="{{ old('nama_kecamatan', $kecamatan->nama_kecamatan) }}"
                               placeholder="Masukkan Nama Kecamatan" required>
                        @error('nama_kecamatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kabupaten_id">Nama Kabupaten <span class="text-danger">*</span></label>
                        <select name="kabupaten_id" id="kabupaten_id"
                                class="form-control @error('kabupaten_id') is-invalid @enderror" required>
                            <option value="0" {{ old('kabupaten_id', $kecamatan->kabupaten_id) == '0' ? 'selected' : '' }}>-- Pilih Kabupaten --</option>
                            @foreach($kabupatenList as $kabupaten)
                                <option value="{{ $kabupaten->id }}" {{ old('kabupaten_id', $kecamatan->kabupaten_id) == $kabupaten->id ? 'selected' : '' }}>{{ $kabupaten->nama_kabupaten }}</option>
                            @endforeach
                        </select>
                        @error('kabupaten_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_kecamatan">Status Master <span class="text-danger">*</span></label>
                        <select name="status_kecamatan" id="status_kecamatan"
                                class="form-control @error('status_kecamatan') is-invalid @enderror" required>
                            <option value="1" {{ old('status_kecamatan', $kecamatan->status_kecamatan) == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_kecamatan', $kecamatan->status_kecamatan) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_kecamatan')
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
