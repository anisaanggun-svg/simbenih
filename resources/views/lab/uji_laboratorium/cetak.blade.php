<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>{{ $mode === 'all' ? 'Daftar Uji Laboratorium' : 'LHU' }}</title>
    <style>
        body { font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: #000; }
        h2 { text-align: center; margin: 0 0 4px; }
        .subtitle { text-align: center; margin-bottom: 16px; color: #555; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 5px 7px; text-align: left; vertical-align: top; }
        th { background: #f0f0f0; }
        .label { width: 32%; font-weight: bold; background: #f7f7f7; }
        .center { text-align: center; }
        .badge-ok { color: #155724; font-weight: bold; }
        .badge-no { color: #721c24; font-weight: bold; }
    </style>
</head>
<body>
@if($mode === 'all')
    <h2>Daftar Uji Laboratorium</h2>
    <div class="subtitle">Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}</div>
    <table>
        <thead>
            <tr>
                <th class="center">No</th>
                <th>No. Induk Lapangan</th>
                <th>No. Berkas</th>
                <th>Nama Produsen</th>
                <th>Jenis Tanaman</th>
                <th>Varietas</th>
                <th>Kelas Benih</th>
                <th>No. LOT</th>
                <th>Tgl. LHU</th>
                <th>Kesimpulan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $row)
            <tr>
                <td class="center">{{ $i + 1 }}</td>
                <td>{{ $row->no_induk_lapangan ?? '-' }}</td>
                <td>{{ $row->no_berkas ?? '-' }}</td>
                <td>{{ $row->nama_produsen ?? '-' }}</td>
                <td>{{ $row->jenis_tanaman ?? '-' }}</td>
                <td>{{ $row->varietas ?? '-' }}</td>
                <td>{{ $row->kelas_benih ?? '-' }}</td>
                <td>{{ $row->no_lot ?? '-' }}</td>
                <td>{{ $row->tgl_lhu ? \Carbon\Carbon::parse($row->tgl_lhu)->format('d-m-Y') : '-' }}</td>
                <td>
                    @if($row->kesimpulan == '1')<span class="badge-ok">Memenuhi Syarat</span>
                    @elseif($row->kesimpulan == '0')<span class="badge-no">Tidak Memenuhi Syarat</span>
                    @else Belum Ditentukan
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="10" class="center">Belum ada data uji laboratorium.</td></tr>
            @endforelse
        </tbody>
    </table>
@else
    @php
        $k = $lhu->kesimpulan;
        $kesimpulan = $k == '1' ? 'Memenuhi Syarat' : ($k == '0' ? 'Tidak Memenuhi Syarat' : 'Belum Ditentukan');
    @endphp
    <h2>Laporan Hasil Uji (LHU)</h2>
    <div class="subtitle">No. Berkas: {{ $lhu->no_berkas ?? '-' }}</div>
    <table>
        <tr><td class="label">No. Induk Lapangan</td><td>{{ $lhu->no_induk_lapangan ?? '-' }}</td></tr>
        <tr><td class="label">No. Berkas</td><td>{{ $lhu->no_berkas ?? '-' }}</td></tr>
        <tr><td class="label">Nama Produsen</td><td>{{ $lhu->nama_produsen ?? '-' }}</td></tr>
        <tr><td class="label">Alamat Produsen</td><td>{{ $lhu->alamat_produsen ?? '-' }}</td></tr>
        <tr><td class="label">No. Asal</td><td>{{ $lhu->no_asal ?? '-' }}</td></tr>
        <tr><td class="label">No. Lab</td><td>{{ $lhu->no_lab ?? '-' }}</td></tr>
        <tr><td class="label">Jenis Tanaman</td><td>{{ $lhu->jenis_tanaman ?? '-' }}</td></tr>
        <tr><td class="label">Varietas</td><td>{{ $lhu->varietas ?? '-' }}</td></tr>
        <tr><td class="label">Kelas Benih</td><td>{{ $lhu->kelas_benih ?? '-' }}</td></tr>
        <tr><td class="label">No. LOT</td><td>{{ $lhu->no_lot ?? '-' }}</td></tr>
        <tr><td class="label">Tgl. Panen Awal</td><td>{{ $lhu->tgl_panen_awal ? \Carbon\Carbon::parse($lhu->tgl_panen_awal)->format('d-m-Y') : '-' }}</td></tr>
        <tr><td class="label">Tgl. Panen Akhir</td><td>{{ $lhu->tgl_panen_akhir ? \Carbon\Carbon::parse($lhu->tgl_panen_akhir)->format('d-m-Y') : '-' }}</td></tr>
        <tr><td class="label">Luas Lulus</td><td>{{ $lhu->luas_lulus ?? '-' }}</td></tr>
        <tr><td class="label">Tonase</td><td>{{ $lhu->tonase ?? '-' }}</td></tr>
        <tr><td class="label">Tgl. Selesai Pengujian</td><td>{{ $lhu->tgl_selesai_pengujian ? \Carbon\Carbon::parse($lhu->tgl_selesai_pengujian)->format('d-m-Y') : '-' }}</td></tr>
        <tr><td class="label">Kadar Air (%)</td><td>{{ $lhu->kadar_air ?? '-' }}</td></tr>
        <tr><td class="label">Benih Murni (%)</td><td>{{ $lhu->benih_murni ?? '-' }}</td></tr>
        <tr><td class="label">Kotoran Benih (%)</td><td>{{ $lhu->kotoran_benih ?? '-' }}</td></tr>
        <tr><td class="label">BTL Gulma (%)</td><td>{{ $lhu->btl_gulma ?? '-' }}</td></tr>
        <tr><td class="label">Daya Berkecambah (%)</td><td>{{ $lhu->daya_berkecambah ?? '-' }}</td></tr>
        <tr><td class="label">Biji Keras</td><td>{{ $lhu->biji_keras ?? '-' }}</td></tr>
        <tr><td class="label">Benih Warna Lain</td><td>{{ $lhu->benih_warna_lain ?? '-' }}</td></tr>
        <tr><td class="label">No. Induk LHU</td><td>{{ $lhu->no_induk_lhu ?? '-' }}</td></tr>
        <tr><td class="label">Tgl. LHU</td><td>{{ $lhu->tgl_lhu ? \Carbon\Carbon::parse($lhu->tgl_lhu)->format('d-m-Y') : '-' }}</td></tr>
        <tr><td class="label">Tgl. Kadaluarsa</td><td>{{ $lhu->tgl_kadaluarsa ? \Carbon\Carbon::parse($lhu->tgl_kadaluarsa)->format('d-m-Y') : '-' }}</td></tr>
        <tr><td class="label">Kesimpulan</td><td>{{ $kesimpulan }}</td></tr>
        <tr><td class="label">Keterangan</td><td>{{ $lhu->keterangan ?? '-' }}</td></tr>
    </table>
@endif
</body>
</html>
