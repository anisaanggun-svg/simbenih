@extends("template.t_admin")

@section("title", "Tambah Master Produsen - Data Master")

@section("content")
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Input Data Master Produsen</h3>
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
                    <p class="text-muted">User melakukan pengisian form untuk menambah data produsen.</p>
                </div>

                <a href="{{ route('master.produsen.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data Produsen
                </a>

                <form action="{{ route('master.produsen.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="no_tdpb">No TDPB <span class="text-danger">*</span></label>
                        <input type="text" name="no_tdpb" id="no_tdpb"
                               class="form-control @error('no_tdpb') is-invalid @enderror"
                               value="{{ old('no_tdpb') }}"
                               maxlength="100" placeholder="Contoh: 0023/SKPeBH/BU/JTM/VII.2026" required>
                        <small class="form-text text-muted">Nomor TDPB harus unik.</small>
                        @error('no_tdpb')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_induk_produsen_nasional">No Induk Nasional</label>
                        <input type="text" name="no_induk_produsen_nasional" id="no_induk_produsen_nasional"
                               class="form-control @error('no_induk_produsen_nasional') is-invalid @enderror"
                               value="{{ old('no_induk_produsen_nasional') }}"
                               maxlength="100" placeholder="Nomor Induk Nasional Produsen (opsional)">
                        @error('no_induk_produsen_nasional')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="badan_usaha">Badan Usaha (Contoh: PT / CV / UD / Biarkan kosong jika tidak ada)</label>
                        <input type="text" name="badan_usaha" id="badan_usaha"
                               class="form-control @error('badan_usaha') is-invalid @enderror"
                               value="{{ old('badan_usaha') }}"
                               maxlength="50" placeholder="PT / CV / UD / kosong">
                        @error('badan_usaha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_produsen">Nama Produsen <span class="text-danger">*</span></label>
                        <input type="text" name="nama_produsen" id="nama_produsen"
                               class="form-control @error('nama_produsen') is-invalid @enderror"
                               value="{{ old('nama_produsen') }}"
                               maxlength="255" placeholder="Contoh: WILWATIKA AGRI MAKMUR" required>
                        @error('nama_produsen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kabupaten_id">Kabupaten</label>
                        <select name="kabupaten_id" id="kabupaten_id"
                                class="form-control @error('kabupaten_id') is-invalid @enderror">
                            <option value="0">-- Pilih Kabupaten --</option>
                            @foreach($kabupatenList as $kab)
                                <option value="{{ $kab->id }}" {{ old('kabupaten_id') == $kab->id ? 'selected' : '' }}>
                                    {{ $kab->nama_kabupaten }}
                                </option>
                            @endforeach
                        </select>
                        @error('kabupaten_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat <span class="text-danger">*</span></label>
                        <input type="text" name="alamat" id="alamat"
                               class="form-control @error('alamat') is-invalid @enderror"
                               value="{{ old('alamat') }}"
                               placeholder="Alamat lengkap produsen" required>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" name="no_telp" id="no_telp"
                               class="form-control @error('no_telp') is-invalid @enderror"
                               value="{{ old('no_telp') }}"
                               maxlength="50" placeholder="Contoh: 085200988999" required>
                        @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_id">Nama Status <span class="text-danger">*</span></label>
                        <select name="status_id" id="status_id"
                                class="form-control @error('status_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Status --</option>
                            @foreach($statusList as $s)
                                <option value="{{ $s->kode_status }}" {{ old('status_id') == $s->kode_status ? 'selected' : '' }}>
                                    {{ $s->nama_status }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Pilih dari Master Status (contoh: Dinas Pusat, Swasta, dll).</small>
                        @error('status_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_kontak">Nama Kontak <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kontak" id="nama_kontak"
                               class="form-control @error('nama_kontak') is-invalid @enderror"
                               value="{{ old('nama_kontak') }}"
                               maxlength="150" placeholder="Nama kontak yang dapat dihubungi" required>
                        @error('nama_kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jabatan_kontak">Jabatan Kontak <span class="text-danger">*</span></label>
                        <input type="text" name="jabatan_kontak" id="jabatan_kontak"
                               class="form-control @error('jabatan_kontak') is-invalid @enderror"
                               value="{{ old('jabatan_kontak') }}"
                               maxlength="100" placeholder="Contoh: Pimpinan, Manager, Staff" required>
                        @error('jabatan_kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_produsen">Status Master <span class="text-danger">*</span></label>
                        <select name="status_produsen" id="status_produsen"
                                class="form-control @error('status_produsen') is-invalid @enderror" required>
                            <option value="1" {{ old('status_produsen', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_produsen') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_produsen')
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
