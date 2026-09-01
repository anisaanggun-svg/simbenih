@extends("template.t_admin")

@section("title", "Edit Master Kumpulan - Data Master")

@section("content")
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Data Master Kumpulan</h3>
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
                    <p class="text-muted">User melakukan pengisian form untuk mengubah data kumpulan.</p>
                </div>

                <a href="{{ route('master.kumpulan.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data Kumpulan
                </a>

                <form action="{{ route('master.kumpulan.update', $kumpulan->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="kode_hidden" value="{{ $kumpulan->kode_golongan }}">

                    <div class="form-group">
                        <label for="kode_golongan">Kode Kumpulan <span class="text-danger">*</span></label>
                        <input type="text" name="kode_golongan" id="kode_golongan"
                               class="form-control @error('kode_golongan') is-invalid @enderror"
                               value="{{ old('kode_golongan', $kumpulan->kode_golongan) }}"
                               maxlength="5" placeholder="Masukkan Kode Kumpulan" required>
                        <small class="form-text text-muted">Maksimal 5 karakter.</small>
                        @error('kode_golongan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_golongan">Nama Kumpulan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_golongan" id="nama_golongan"
                               class="form-control @error('nama_golongan') is-invalid @enderror"
                               value="{{ old('nama_golongan', $kumpulan->nama_golongan) }}"
                               placeholder="Masukkan Nama Kumpulan" required>
                        @error('nama_golongan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="komoditas_id">Nama Golongan <span class="text-danger">*</span></label>
                        <select name="komoditas_id" id="komoditas_id"
                                class="form-control @error('komoditas_id') is-invalid @enderror" required>
                            <option value="0">-- Pilih Golongan --</option>
                            @foreach($komoditasList ?? [] as $k)
                                <option value="{{ $k->id }}" {{ (string) old('komoditas_id', $kumpulan->komoditas_id) === (string) $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_komoditas }} ({{ $k->kode_komoditas }})
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Pilih Master Golongan (Komoditas) sebagai parent.</small>
                        @error('komoditas_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenis_golongan">Jenis Golongan <span class="text-danger">*</span></label>
                        <select name="jenis_golongan" id="jenis_golongan"
                                class="form-control @error('jenis_golongan') is-invalid @enderror" required>
                            @foreach(\App\Models\Golongan::jenisOptions() as $key => $label)
                                <option value="{{ $key }}" {{ old('jenis_golongan', $kumpulan->jenis_golongan) == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('jenis_golongan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_golongan">Status Master <span class="text-danger">*</span></label>
                        <select name="status_golongan" id="status_golongan"
                                class="form-control @error('status_golongan') is-invalid @enderror" required>
                            <option value="1" {{ old('status_golongan', $kumpulan->status_golongan) == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_golongan', $kumpulan->status_golongan) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_golongan')
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