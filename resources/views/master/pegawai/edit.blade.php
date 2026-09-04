@extends("template.t_admin")

@section("title", "Edit Master Pegawai - Data Master")

@section("content")
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Data Master Pegawai</h3>
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
                    <p class="text-muted">User melakukan pengisian form untuk mengubah data pegawai.</p>
                </div>

                <a href="{{ route('master.pegawai.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data Pegawai
                </a>

                <form action="{{ route('master.pegawai.update', $pegawai->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="kode_hidden" value="{{ $pegawai->nip_pegawai }}">

                    <div class="form-group">
                        <label for="nip_pegawai">NIP Pegawai <span class="text-danger">*</span></label>
                        <input type="text" name="nip_pegawai" id="nip_pegawai"
                               class="form-control @error('nip_pegawai') is-invalid @enderror"
                               value="{{ old('nip_pegawai', $pegawai->nip_pegawai) }}"
                               maxlength="50" placeholder="Masukkan NIP Pegawai" required>
                        @error('nip_pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_pegawai">Nama Pegawai <span class="text-danger">*</span></label>
                        <input type="text" name="nama_pegawai" id="nama_pegawai"
                               class="form-control @error('nama_pegawai') is-invalid @enderror"
                               value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}"
                               maxlength="255" placeholder="Masukkan Nama Pegawai" required>
                        @error('nama_pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="satgas_id">Nama satgas (Wilayah Kerja) <span class="text-danger">*</span></label>
                        <select name="satgas_id" id="satgas_id"
                                class="form-control @error('satgas_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Wilayah Kerja --</option>
                            @foreach($satgasList as $s)
                                <option value="{{ $s->kode_satgas }}" {{ old('satgas_id', $pegawai->satgas_id) == $s->kode_satgas ? 'selected' : '' }}>
                                    {{ $s->nama_satgas }}
                                </option>
                            @endforeach
                        </select>
                        @error('satgas_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jabatan">Jabatan <span class="text-danger">*</span></label>
                        <input type="text" name="jabatan" id="jabatan"
                               class="form-control @error('jabatan') is-invalid @enderror"
                               value="{{ old('jabatan', $pegawai->jabatan) }}"
                               maxlength="200" placeholder="Masukkan Jabatan" required>
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_telp">No Telp <span class="text-danger">*</span></label>
                        <input type="text" name="no_telp" id="no_telp"
                               class="form-control @error('no_telp') is-invalid @enderror"
                               value="{{ old('no_telp', $pegawai->no_telp) }}"
                               maxlength="50" placeholder="Masukkan No Telp" required>
                        @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_pegawai">Status Master <span class="text-danger">*</span></label>
                        <select name="status_pegawai" id="status_pegawai"
                                class="form-control @error('status_pegawai') is-invalid @enderror" required>
                            <option value="1" {{ old('status_pegawai', $pegawai->status_pegawai) == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_pegawai', $pegawai->status_pegawai) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="is_ka_satgas">Is Ka Korwil <span class="text-danger">*</span></label>
                        <select name="is_ka_satgas" id="is_ka_satgas"
                                class="form-control @error('is_ka_satgas') is-invalid @enderror" required>
                            <option value="1" {{ old('is_ka_satgas', $pegawai->is_ka_satgas) == '1' ? 'selected' : '' }}>YA</option>
                            <option value="0" {{ old('is_ka_satgas', $pegawai->is_ka_satgas) == '0' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('is_ka_satgas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('master.pegawai.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
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
