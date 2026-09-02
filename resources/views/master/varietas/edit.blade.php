@extends("template.t_admin")

@section("title", "Edit Master Varietas - Data Master")

@section("content")
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Data Master Varietas</h3>
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
                    <p class="text-muted">User melakukan pengisian form untuk mengubah varietas.</p>
                </div>

                <a href="{{ route('master.varietas.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data Varietas
                </a>

                <form action="{{ route('master.varietas.update', $varietas->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode_varietas">Kode Varietas <span class="text-danger">*</span></label>
                                <input type="text" name="kode_varietas" id="kode_varietas"
                                       class="form-control @error('kode_varietas') is-invalid @enderror"
                                       value="{{ old('kode_varietas', $varietas->kode_varietas) }}"
                                       maxlength="20" placeholder="Masukkan Kode Varietas" required>
                                @error('kode_varietas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama_varietas">Nama Varietas <span class="text-danger">*</span></label>
                                <input type="text" name="nama_varietas" id="nama_varietas"
                                       class="form-control @error('nama_varietas') is-invalid @enderror"
                                       value="{{ old('nama_varietas', $varietas->nama_varietas) }}"
                                       placeholder="Masukkan Nama Varietas" required>
                                @error('nama_varietas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_tanaman_id">Nama Tanaman</label>
                                <select name="jenis_tanaman_id" id="jenis_tanaman_id"
                                        class="form-control @error('jenis_tanaman_id') is-invalid @enderror">
                                    <option value="">-- Pilih Tanaman --</option>
                                    @foreach($jenisTanamanList as $jenis)
                                        <option value="{{ $jenis->id }}" {{ old('jenis_tanaman_id', $varietas->jenis_tanaman_id) == $jenis->id ? 'selected' : '' }}>
                                            {{ $jenis->kode_tanaman }} - {{ $jenis->nama_tanaman }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_tanaman_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status_varietas">Status Master <span class="text-danger">*</span></label>
                                <select name="status_varietas" id="status_varietas"
                                        class="form-control @error('status_varietas') is-invalid @enderror" required>
                                    <option value="Aktif" {{ old('status_varietas', $varietas->status_varietas) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('status_varietas', $varietas->status_varietas) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('status_varietas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="{{ route('master.varietas.index') }}" class="btn btn-secondary ml-2">
                                <i class="fas fa-undo"></i> Batal
                            </a>
                        </div>
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
