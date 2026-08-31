<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Buku Induk Pengujian</title>
    <style>
        body { font-family: Helvetica, Arial, sans-serif; font-size: 11px; color: #000; }
        h2 { text-align: center; margin: 0 0 4px; }
        .subtitle { text-align: center; margin-bottom: 4px; color: #555; }
        .periode { text-align: center; margin-bottom: 14px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 4px 6px; text-align: left; vertical-align: top; }
        th { background: #f0f0f0; }
        .center { text-align: center; }
        .badge-ok { color: #155724; font-weight: bold; }
        .badge-no { color: #721c24; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Buku Induk Pengujian Standar 1|4</h2>
    <div class="subtitle">Sistem Informasi Perbenihan</div>
    <div class="periode">Periode: {{ \Carbon\Carbon::parse($tgl_awal)->format('d-m-Y') }} s.d. {{ \Carbon\Carbon::parse($tgl_akhir)->format('d-m-Y') }}</div>
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
            <tr><td colspan="10" class="center">Tidak ada data pada periode tersebut.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
