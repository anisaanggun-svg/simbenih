@extends("template.t_admin")

@section("title", "Tambah Master Jenis Tanaman - Data Master")

@section("content")
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Input Data Master Jenis Tanaman</h3>
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
                    <p class="text-muted">User melakukan pengisian form untuk menambah data jenis tanaman.</p>
                </div>

                <a href="{{ route('master.jenis-tanaman.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Master Data Jenis Tanaman
                </a>

                <form action="{{ route('master.jenis-tanaman.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode_tanaman">Kode Tanaman <span class="text-danger">*</span></label>
                                <input type="text" name="kode_tanaman" id="kode_tanaman"
                                       class="form-control @error('kode_tanaman') is-invalid @enderror"
                                       value="{{ old('kode_tanaman') }}"
                                       maxlength="10" placeholder="Masukkan Kode Tanaman" required>
                                @error('kode_tanaman')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama_tanaman">Nama Tanaman <span class="text-danger">*</span></label>
                                <input type="text" name="nama_tanaman" id="nama_tanaman"
                                       class="form-control @error('nama_tanaman') is-invalid @enderror"
                                       value="{{ old('nama_tanaman') }}"
                                       placeholder="Masukkan Nama Tanaman" required>
                                @error('nama_tanaman')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="klasifikasi">Jenis Perbanyakan</label>
                                <select name="klasifikasi" id="klasifikasi"
                                        class="form-control @error('klasifikasi') is-invalid @enderror">
                                    <option value="">-- Pilih Jenis Perbanyakan --</option>
                                    <option value="Hibrida" {{ old('klasifikasi') == 'Hibrida' ? 'selected' : '' }}>Hibrida</option>
                                    <option value="Non Hibrida" {{ old('klasifikasi') == 'Non Hibrida' ? 'selected' : '' }}>Non Hibrida</option>
                                </select>
                                @error('klasifikasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama_perbanyakan">Nama Perbanyakan</label>
                                <input type="text" name="nama_perbanyakan" id="nama_perbanyakan"
                                       class="form-control @error('nama_perbanyakan') is-invalid @enderror"
                                       value="{{ old('nama_perbanyakan') }}"
                                       placeholder="Masukkan Nama Perbanyakan">
                                @error('nama_perbanyakan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="satuan_penangkaran">Satuan Penangkaran</label>
                                <input type="text" name="satuan_penangkaran" id="satuan_penangkaran"
                                       class="form-control @error('satuan_penangkaran') is-invalid @enderror"
                                       value="{{ old('satuan_penangkaran') }}"
                                       placeholder="Contoh: Hektare">
                                @error('satuan_penangkaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="satuan_produk">Satuan Produk</label>
                                <input type="text" name="satuan_produk" id="satuan_produk"
                                       class="form-control @error('satuan_produk') is-invalid @enderror"
                                       value="{{ old('satuan_produk') }}"
                                       placeholder="Contoh: Kilogram, Ton">
                                @error('satuan_produk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama_satuan">Satuan Kemasan</label>
                                <input type="text" name="nama_satuan" id="nama_satuan"
                                       class="form-control @error('nama_satuan') is-invalid @enderror"
                                       value="{{ old('nama_satuan') }}"
                                       placeholder="Contoh: Kilogram">
                                @error('nama_satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="populasi_pemeriksaan">Populasi Pemeriksaan</label>
                                <input type="number" name="populasi_pemeriksaan" id="populasi_pemeriksaan"
                                       class="form-control @error('populasi_pemeriksaan') is-invalid @enderror"
                                       value="{{ old('populasi_pemeriksaan') }}"
                                       placeholder="0" min="0">
                                @error('populasi_pemeriksaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="populasi_pemeriksaan_jantan">Populasi Pemeriksaan Jantan</label>
                                <input type="number" name="populasi_pemeriksaan_jantan" id="populasi_pemeriksaan_jantan"
                                       class="form-control @error('populasi_pemeriksaan_jantan') is-invalid @enderror"
                                       value="{{ old('populasi_pemeriksaan_jantan') }}"
                                       placeholder="0" min="0">
                                @error('populasi_pemeriksaan_jantan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="populasi_pemeriksaan_betina">Populasi Pemeriksaan Betina</label>
                                <input type="number" name="populasi_pemeriksaan_betina" id="populasi_pemeriksaan_betina"
                                       class="form-control @error('populasi_pemeriksaan_betina') is-invalid @enderror"
                                       value="{{ old('populasi_pemeriksaan_betina') }}"
                                       placeholder="0" min="0">
                                @error('populasi_pemeriksaan_betina')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status Master <span class="text-danger">*</span></label>
                                <select name="status" id="status"
                                        class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="Aktif" {{ old('status', 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h5 class="mb-3">Fase Pengembangan</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Pendahuluan</label>
                                <select name="pendahuluan" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('pendahuluan') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('pendahuluan') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Vegetatif</label>
                                <select name="vegetatif" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('vegetatif') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('vegetatif') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Vegetatif 1</label>
                                <select name="vegetatif1" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('vegetatif1') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('vegetatif1') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Vegetatif 2</label>
                                <select name="vegetatif2" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('vegetatif2') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('vegetatif2') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Vegetatif 3</label>
                                <select name="vegetatif3" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('vegetatif3') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('vegetatif3') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Vegetatif Ulangan</label>
                                <select name="vegetatif_ulangan" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('vegetatif_ulangan') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('vegetatif_ulangan') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Berbunga 1</label>
                                <select name="berbunga1" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('berbunga1') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('berbunga1') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Berbunga 2</label>
                                <select name="berbunga2" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('berbunga2') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('berbunga2') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Berbunga 3</label>
                                <select name="berbunga3" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('berbunga3') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('berbunga3') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Berbunga Ulangan</label>
                                <select name="berbunga_ulangan" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('berbunga_ulangan') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('berbunga_ulangan') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Masak</label>
                                <select name="masak" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('masak') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('masak') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Masak Ulangan</label>
                                <select name="masak_ulangan" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('masak_ulangan') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('masak_ulangan') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Panen</label>
                                <select name="panen" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('panen') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('panen') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Pengolahan</label>
                                <select name="pengolahan" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('pengolahan') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('pengolahan') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Siap Siar</label>
                                <select name="siap_siar" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('siap_siar') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('siap_siar') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Ambil Contoh</label>
                                <select name="pengambilan_contoh" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('pengambilan_contoh') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('pengambilan_contoh') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Kirim Contoh</label>
                                <select name="pengiriman_contoh" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('pengiriman_contoh') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('pengiriman_contoh') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Kaji Ulang</label>
                                <select name="kaji_ulang" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('kaji_ulang') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('kaji_ulang') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Uji Kadar Air</label>
                                <select name="uji_kadar_air" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('uji_kadar_air') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('uji_kadar_air') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Uji Kemurnian</label>
                                <select name="uji_kemurnian" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('uji_kemurnian') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('uji_kemurnian') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Uji CVL</label>
                                <select name="uji_cvl" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('uji_cvl') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('uji_cvl') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Uji Warna Lain</label>
                                <select name="uji_warna_lain" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('uji_warna_lain') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('uji_warna_lain') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Penilaian</label>
                                <select name="penilaian" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('penilaian') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('penilaian') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Seri Label</label>
                                <select name="seri_label" class="form-control">
                                    <option value="">-</option>
                                    <option value="Ya" {{ old('seri_label') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('seri_label') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
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
