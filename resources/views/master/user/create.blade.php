@extends("template.t_admin")

@section("title", "Tambah Master Daftar User - Data Master")

@section("content")
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Input Data Master Daftar User</h3>
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
                    <p class="text-muted">User melakukan pengisian form untuk menambah data user aplikasi.</p>
                </div>

                <a href="{{ route('master.daftar-user.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data Daftar User
                </a>

                <form action="{{ route('master.daftar-user.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" id="username"
                                       class="form-control @error('username') is-invalid @enderror"
                                       value="{{ old('username') }}"
                                       maxlength="255" placeholder="Masukkan username" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}"
                                       maxlength="255" placeholder="Nama tampilan user" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       maxlength="255" placeholder="Email user (opsional)">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       minlength="6" placeholder="Minimal 6 karakter" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="form-control"
                                       minlength="6" placeholder="Ulangi password" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">Role <span class="text-danger">*</span></label>
                                <select name="role" id="role"
                                        class="form-control @error('role') is-invalid @enderror"
                                        required>
                                    <option value="">-- Pilih Role --</option>
                                    @foreach($roles as $value => $label)
                                        <option value="{{ $value }}" {{ old('role') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Pilih role yang menentukan hak akses user.</small>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="wewenang_data">Wewenang Data</label>
                                <select name="wewenang_data" id="wewenang_data"
                                        class="form-control @error('wewenang_data') is-invalid @enderror">
                                    <option value="">-- Pilih Wewenang Data --</option>
                                    <option value="1" {{ old('wewenang_data') == '1' ? 'selected' : '' }}>Pangan</option>
                                    <option value="2" {{ old('wewenang_data') == '2' ? 'selected' : '' }}>Hortikultura</option>
                                    <option value="3" {{ old('wewenang_data') == '3' ? 'selected' : '' }}>Perkebunan</option>
                                    <option value="4" {{ old('wewenang_data') == '4' ? 'selected' : '' }}>Semua Golongan</option>
                                    <option value="5" {{ old('wewenang_data') == '5' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                <small class="form-text text-muted">Wewenang data yang boleh diakses oleh user (sesuai sistem sumber).</small>
                                @error('wewenang_data')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_pegawai">Pegawai</label>
                                <select name="id_pegawai" id="id_pegawai"
                                        class="form-control @error('id_pegawai') is-invalid @enderror">
                                    <option value="">-- Pilih Pegawai (opsional) --</option>
                                    @foreach($pegawai as $p)
                                        <option value="{{ $p->id }}" {{ old('id_pegawai') == $p->id ? 'selected' : '' }}>
                                            [{{ $p->nip_pegawai ?? '-' }}] {{ $p->nama_pegawai ?? $p->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Pegawai terkait dengan user (untuk tampil di NIP / Nama).</small>
                                @error('id_pegawai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_satgas">Satgas</label>
                                <select name="id_satgas" id="id_satgas"
                                        class="form-control @error('id_satgas') is-invalid @enderror">
                                    <option value="">-- Pilih Satgas (opsional) --</option>
                                    @foreach($satgasList as $s)
                                        <option value="{{ $s->id_satgas }}" {{ old('id_satgas') == $s->id_satgas ? 'selected' : '' }}>
                                            {{ $s->id_satgas }} - {{ $s->nama_satgas ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_satgas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kode_kabupaten">Kabupaten</label>
                                <select name="kode_kabupaten" id="kode_kabupaten"
                                        class="form-control @error('kode_kabupaten') is-invalid @enderror">
                                    <option value="">-- Pilih Kabupaten (opsional) --</option>
                                    @foreach($kabupaten as $k)
                                        <option value="{{ $k->kode_kabupaten }}" {{ old('kode_kabupaten') == $k->kode_kabupaten ? 'selected' : '' }}>
                                            {{ $k->kode_kabupaten }} - {{ $k->nama_kabupaten ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kode_kabupaten')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_komoditas">Komoditas (Wewenang Golongan)</label>
                                <select name="id_komoditas" id="id_komoditas"
                                        class="form-control @error('id_komoditas') is-invalid @enderror">
                                    <option value="">-- Pilih Komoditas (opsional) --</option>
                                    @foreach($komoditas as $km)
                                        <option value="{{ $km->id }}" {{ old('id_komoditas') == $km->id ? 'selected' : '' }}>
                                            [{{ $km->kode_komoditas }}] {{ $km->nama_komoditas }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Digunakan untuk wewenang data berdasarkan Komoditas.</small>
                                @error('id_komoditas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
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

@push("footer")
<script>
    // disable_wewenang() - mengaktifkan/menonaktifkan wewenang_data
    // sesuai role (mengikuti sistem sumber: hanya untuk role tertentu)
    function disable_wewenang() {
        var role = $('#role').val();
        var $wewenang = $('#wewenang_data');

        // Aturan disalin dari sistem sumber atur_user:
        // - Role admin & manager tidak butuh wewenang_data.
        var needsWewenang = (role !== 'admin' && role !== 'manager');

        $wewenang.prop('disabled', !needsWewenang);
        if (!needsWewenang) {
            $wewenang.val('');
        }
    }

    $(function () {
        $('#role').on('change', disable_wewenang);
        disable_wewenang();
    });
</script>
@endpush

@endsection
