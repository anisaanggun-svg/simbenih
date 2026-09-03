@extends("template.t_admin")

@section("title", "Edit Master Kabupaten - Data Master")

@section("content")
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Data Master Kabupaten</h3>
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
                    <p class="text-muted">User melakukan pengisian form untuk mengubah data kabupaten.</p>
                </div>

                <a href="{{ route('master.kabupaten.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data Kabupaten
                </a>

                <form action="{{ route('master.kabupaten.update', $kabupaten->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="kode_hidden" value="{{ $kabupaten->kode_satkab }}">

                    <div class="form-group">
                        <label for="satgas">Satgas <span class="text-danger">*</span></label>
                        <select name="satgas" id="satgas"
                                class="form-control @error('satgas') is-invalid @enderror" required>
                            <option value="0" {{ old('satgas', $kabupaten->satgas) == '0' ? 'selected' : '' }}>-- Pilih Satgas --</option>
                            @foreach(\App\Models\Kabupaten::satgasOptions() as $key => $label)
                                <option value="{{ $key }}" {{ old('satgas', $kabupaten->satgas) == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('satgas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kode_satkab">Kode Kabupaten <span class="text-danger">*</span></label>
                        <input type="text" name="kode_satkab" id="kode_satkab"
                               class="form-control @error('kode_satkab') is-invalid @enderror"
                               value="{{ old('kode_satkab', $kabupaten->kode_satkab) }}"
                               maxlength="10" placeholder="Masukkan Kode Kabupaten" required>
                        <small class="form-text text-muted">Maksimal 10 karakter. Kode ini digunakan sebagai Kode Satgas-Kabupaten dan harus unik.</small>
                        @error('kode_satkab')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kode_kabupaten_nasional">Kode Kabupaten Nasional <span class="text-danger">*</span></label>
                        <input type="text" name="kode_kabupaten_nasional" id="kode_kabupaten_nasional"
                               class="form-control @error('kode_kabupaten_nasional') is-invalid @enderror"
                               value="{{ old('kode_kabupaten_nasional', $kabupaten->kode_kabupaten_nasional) }}"
                               maxlength="10" placeholder="Masukkan Kode Kabupaten Nasional" required>
                        @error('kode_kabupaten_nasional')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_kabupaten">Nama Kabupaten <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kabupaten" id="nama_kabupaten"
                               class="form-control @error('nama_kabupaten') is-invalid @enderror"
                               value="{{ old('nama_kabupaten', $kabupaten->nama_kabupaten) }}"
                               placeholder="Masukkan Nama Kabupaten" required>
                        @error('nama_kabupaten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_kabupaten">Status Master <span class="text-danger">*</span></label>
                        <select name="status_kabupaten" id="status_kabupaten"
                                class="form-control @error('status_kabupaten') is-invalid @enderror" required>
                            <option value="1" {{ old('status_kabupaten', $kabupaten->status_kabupaten) == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_kabupaten', $kabupaten->status_kabupaten) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_kabupaten')
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