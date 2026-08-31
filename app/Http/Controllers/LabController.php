<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produsen;
use App\Models\Pegawai;
use App\Models\UjiLaboratorium;
use Barryvdh\DomPDF\Facade\Pdf;

class LabController extends Controller
{
    /**
     * Display the Uji Laboratorium index page.
     */
    public function index(Request $request)
    {
        $query = UjiLaboratorium::query();

        if ($request->filled('tahun')) {
            $query->whereYear('tgl_lhu', $request->tahun);
        }

        $data = $query->orderBy('id')->get();

        return view('lab.uji_laboratorium.index', compact('data'));
    }

    /**
     * Show form to create new LHU.
     */
    public function create()
    {
        $produsen_list = Produsen::orderBy('nama')->get();
        $pegawai_list = Pegawai::orderBy('nama')->get();
        $pegawai_ttd_list = Pegawai::whereIn('id', [270, 280, 353, 394, 407, 417, 464])->orderBy('nama')->get();
        $mode = 'create';
        
        return view('lab.uji_laboratorium.form', compact('produsen_list', 'pegawai_list', 'pegawai_ttd_list', 'mode'));
    }

    /**
     * Show detail/view of an LHU record.
     */
    public function show($id, $a = null, $b = null, $mode = 'lihat')
    {
        // TODO: Fetch from database
        $lhu = (object) [
            'id' => $id,
            'no_induk_lapangan' => 'PdnQI.P.3523070.0041.0001',
            'no_berkas' => 'TP24.107.0001',
            'nama_produsen' => 'UD. AGRO TANI',
            'alamat_produsen' => 'Desa Sokosari, Kec. Soko, Kab. Tuban',
            'no_asal' => 'SP.0229.11.124',
            'no_lab' => 'S.0202.1.24',
            'jenis_tanaman' => 'Padi Inbrida',
            'varietas' => 'Inpari 32 HDB',
            'kelas_benih' => 'BP',
            'no_lot' => '01/01',
            'tgl_panen_awal' => '2024-04-03',
            'tgl_panen_akhir' => '2024-04-05',
            'luas_lulus' => '5.5 Ha (Fase Terakhir)',
            'tonase' => '17500 Kilogram',
            'tgl_selesai_pengujian' => '2024-06-21',
            'kadar_air' => '11.8',
            'benih_murni' => '99.7',
            'kotoran_benih' => '0.3',
            'btl_gulma' => '0.0',
            'daya_berkecambah' => '93',
            'biji_keras' => '0',
            'benih_warna_lain' => '-',
            'no_induk_lhu' => 'PdnQI.P.3523070.0041.0001',
            'tgl_lhu' => '2024-06-21',
            'petugas_lhu' => 434,
            'tgl_kadaluarsa' => '2024-12-21',
            'kesimpulan' => '1',
            'keterangan' => '',
            'id_pegawai_ttd' => 270,
        ];
        
        $produsen_list = Produsen::orderBy('nama')->get();
        $pegawai_list = Pegawai::orderBy('nama')->get();
        $pegawai_ttd_list = Pegawai::whereIn('id', [270, 280, 353, 394, 407, 417, 464])->orderBy('nama')->get();
        
        return view('lab.uji_laboratorium.form', compact('lhu', 'produsen_list', 'pegawai_list', 'pegawai_ttd_list', 'mode'));
    }

    /**
     * Show edit form for an LHU record.
     */
    public function edit($id)
    {
        return $this->show($id);
    }

    /**
     * Store new LHU data.
     */
    public function store(Request $request)
    {
        // TODO: Implement store logic
        return redirect()->route('lab.uji_laboratorium.index')->with('success', 'Data LHU berhasil disimpan.');
    }

    /**
     * Update LHU data.
     */
    public function update(Request $request, $id)
    {
        // TODO: Implement update logic
        return redirect()->route('lab.uji_laboratorium.index')->with('success', 'Data LHU berhasil diperbarui.');
    }

    /**
     * Delete LHU record.
     */
    public function destroy(Request $request)
    {
        $ids = $request->input('items', []);
        if (!empty($ids)) {
            UjiLaboratorium::whereIn('id', $ids)->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Data LHU berhasil dihapus.'
        ]);
    }

    /**
     * Print/export LHU to PDF.
     */
    public function cetak($id)
    {
        if ($id === 'all') {
            $data = UjiLaboratorium::orderBy('id')->get();
            $pdf = Pdf::loadView('lab.uji_laboratorium.cetak', [
                'mode' => 'all',
                'data' => $data,
            ])->setPaper('a4', 'landscape');

            return $pdf->download('daftar-uji-laboratorium.pdf');
        }

        $lhu = UjiLaboratorium::findOrFail($id);
        $pdf = Pdf::loadView('lab.uji_laboratorium.cetak', [
            'mode' => 'single',
            'lhu' => $lhu,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('lhu-' . ($lhu->no_berkas ?? $lhu->id) . '.pdf');
    }

    /**
     * Show the Buku Induk Pengujian filter form.
     */
    public function bukuInduk()
    {
        return view('lab.uji_laboratorium.buku_induk');
    }

    /**
     * Generate and download the Buku Induk Pengujian report (PDF) for a date range.
     */
    public function bukuIndukDownload(Request $request)
    {
        $request->validate([
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
        ], [
            'tgl_awal.required' => 'Tanggal Terima Awal wajib diisi.',
            'tgl_akhir.required' => 'Tanggal Terima Akhir wajib diisi.',
            'tgl_awal.date' => 'Format Tanggal Terima Awal tidak valid.',
            'tgl_akhir.date' => 'Format Tanggal Terima Akhir tidak valid.',
        ]);

        $data = UjiLaboratorium::whereBetween('tgl_lhu', [$request->tgl_awal, $request->tgl_akhir])
            ->orderBy('tgl_lhu')
            ->orderBy('id')
            ->get();

        $pdf = Pdf::loadView('lab.uji_laboratorium.buku_induk_pdf', [
            'data' => $data,
            'tgl_awal' => $request->tgl_awal,
            'tgl_akhir' => $request->tgl_akhir,
        ])->setPaper('a4', 'landscape');

        $filename = 'buku-induk-pengujian-' . $request->tgl_awal . '_' . $request->tgl_akhir . '.pdf';

        return $pdf->download($filename);
    }
}
