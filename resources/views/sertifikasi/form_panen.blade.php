@extends("template.t_admin")

@section("title", "Fase Panen - Sertifikasi")

@section("header")
<style>
    #panenContent .card { margin-bottom: 1.5rem; }
    #panenContent .form-group { margin-bottom: 1.1rem; }
</style>
@endsection

@section("content")
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Fase Panen (Jenis Tanaman Hibrida)</h3>
            </div>
            <div class="card-body">

                @include('sertifikasi.partials.header_fase', ['active_fase' => 'panen', 'id_permohonan' => $id ?? 105271])

                <form action="{{ url('') }}/admin/sertifikasi/pengajuan/update" method="post" name="form_edit_fase_panen" id="form_edit_fase_panen">
                    @csrf
                    <input type="hidden" value="16" name="kode_fase" />
                    <input type="hidden" value="Panen" name="nama_fase" />

                    <div id="panenContent">
                        <div id="informasi">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Informasi</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td width="25%" class="font-weight-bold">Jenis Tanaman</td>
                                                    <td width="25%">: Jagung Hibrida</td>
                                                    <td width="25%" class="font-weight-bold">Desa</td>
                                                    <td width="25%">: Wonokasian</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Varietas (Kode Var)</td>
                                                    <td>: LG 38778 (JghHI)</td>
                                                    <td class="font-weight-bold">Kecamatan (Kode)</td>
                                                    <td>: Turen (120)</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Tanggal Rencana Tanam</td>
                                                    <td>: 14-08-2026</td>
                                                    <td class="font-weight-bold">Kabupaten (Kode)</td>
                                                    <td>: Malang (07)</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="pemohon">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">| Pemohon |</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_produsen">Nama Produsen <span class="text-danger">*</span></label>
                                                <select name="nama_produsen" id="nama_produsen" class="form-control select2">
                                                    <option value="0">-- Pilih Produsen --</option>
                                                    @isset($produsen_list)
                                                        @foreach($produsen_list as $p)
                                                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_pegawai">Nama Petugas <span class="text-danger">*</span></label>
                                                <select name="nama_pegawai" id="nama_pegawai" class="form-control select2">
                                                    <option value="0">-- Pilih Petugas --</option>
                                                    @isset($pegawai_list)
                                                        @foreach($pegawai_list as $p)
                                                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="pemeriksaan_panen">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pemeriksaan Panen</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="desc">Tanggal Panen*</label>
                                                <input type="date" class="form-control" name="tanggal_panen" value="{{ old('tanggal_panen') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="desc">Luas Lulus Panen* (Angka, contoh: 4 atau 3.4 jika desimal)</label>
                                                <input type="text" class="form-control" name="luas_lulus_panen" value="{{ old('luas_lulus_panen') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="desc">Catatan Fase Panen</label>
                                        <textarea class="form-control" name="catatan_panen" rows="3">{{ old('catatan_panen') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="kesimpulan">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Kesimpulan Fase*</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="desc">Kesimpulan Fase Panen</label>
                                        <textarea class="form-control" name="kesimpulan_panen" rows="3">{{ old('kesimpulan_panen') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
