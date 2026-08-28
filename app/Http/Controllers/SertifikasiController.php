<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produsen;
use App\Models\Pegawai;

class SertifikasiController extends Controller
{
    /**
     * Display the Pengajuan & Fase Lapangan page.
     */
    public function pengajuan(Request $request)
    {
        $jenisData = $request->get('jenis_data', 'a');

        // TODO: Replace with actual data from database
        // Example data structure based on old system columns
        $data = [
            (object) [
                'id' => 1,
                'musim_tanam' => '2024',
                'kode_unik_sertifikasi' => 'SERT-2024-001',
                'no_induk_lapangan' => 'NIL-001',
                'kode_wilayah' => 'MLG-001',
                'nama_produsen' => 'PT. Sumber Benih',
                'nama_kabupaten_produsen' => 'Malang',
                'nama_tanaman' => 'Padi',
                'nama_varietas' => 'IR-64',
                'blok' => 'A-01',
                'luas_aju' => '2.5',
                'luas_fase' => '2.0',
                'nama_satuan' => 'Ha',
                'kelas_benih_aju' => 'BTP',
                'current_kelas_benih' => 'BTP',
                'tgl_permohonan' => '2024-01-15',
                'tgl_tanam_betina_awal' => '2024-02-01',
                'tgl_entri' => '2024-01-10',
                'nama_fase' => 'Fase 1',
            ],
            (object) [
                'id' => 2,
                'musim_tanam' => '2024',
                'kode_unik_sertifikasi' => 'SERT-2024-002',
                'no_induk_lapangan' => 'NIL-002',
                'kode_wilayah' => 'BLI-001',
                'nama_produsen' => 'CV. Makmur Jaya',
                'nama_kabupaten_produsen' => 'Blimbing',
                'nama_tanaman' => 'Jagung',
                'nama_varietas' => 'P-15',
                'blok' => 'B-03',
                'luas_aju' => '1.5',
                'luas_fase' => '1.2',
                'nama_satuan' => 'Ha',
                'kelas_benih_aju' => 'BTS',
                'current_kelas_benih' => 'BTS',
                'tgl_permohonan' => '2024-01-20',
                'tgl_tanam_betina_awal' => '2024-02-15',
                'tgl_entri' => '2024-01-18',
                'nama_fase' => 'Fase 2',
            ],
        ];

        return view('sertifikasi.pengajuan', compact('data', 'jenisData'));
    }

    /**
     * Show form to add new data.
     */
    public function tambah()
    {
        // TODO: Return view for add form
        return view('sertifikasi.form_pengajuan');
    }

    /**
     * Show detail of a record.
     */
    public function lihat($id)
    {
        // TODO: Fetch and return detail view
        return view('sertifikasi.form_pengajuan', compact('id'));
    }

    /**
     * Show fase pendahuluan form for a record.
     */
    public function fasePendahuluan($id)
    {
        $produsen_list = Produsen::orderBy('nama')->get();
        $pegawai_list = Pegawai::orderBy('nama')->get();
        return view('sertifikasi.form_pendahuluan', compact('id', 'produsen_list', 'pegawai_list'));
    }

    /**
     * Show fase vegetatif form for a record.
     */
    public function faseVegetatif($id)
    {
        $produsen_list = Produsen::orderBy('nama')->get();
        $pegawai_list = Pegawai::orderBy('nama')->get();
        return view('sertifikasi.form_vegetatif', compact('id', 'produsen_list', 'pegawai_list'));
    }

    /**
     * Show fase berbunga form for a record.
     */
    public function faseBerbunga($id)
    {
        $produsen_list = Produsen::orderBy('nama')->get();
        $pegawai_list = Pegawai::orderBy('nama')->get();
        return view('sertifikasi.form_berbunga', compact('id', 'produsen_list', 'pegawai_list'));
    }

    /**
     * Show fase berbunga ulangan form for a record.
     */
    public function faseBerbungaUlangan($id)
    {
        $produsen_list = Produsen::orderBy('nama')->get();
        $pegawai_list = Pegawai::orderBy('nama')->get();
        return view('sertifikasi.form_berbunga_ulangan', compact('id', 'produsen_list', 'pegawai_list'));
    }

    /**
     * Show fase masak form for a record.
     */
    public function faseMasak($id)
    {
        $produsen_list = Produsen::orderBy('nama')->get();
        $pegawai_list = Pegawai::orderBy('nama')->get();
        return view('sertifikasi.form_masak', compact('id', 'produsen_list', 'pegawai_list'));
    }

    /**
     * Show fase panen form for a record.
     */
    public function fasePanen($id)
    {
        $produsen_list = Produsen::orderBy('nama')->get();
        $pegawai_list = Pegawai::orderBy('nama')->get();
        return view('sertifikasi.form_panen', compact('id', 'produsen_list', 'pegawai_list'));
    }

    /**
     * Show edit form for a record.
     */
    public function edit($id)
    {
        // TODO: Fetch and return edit view with data
        return view('sertifikasi.form_pengajuan', compact('id'));
    }

    /**
     * Update pengajuan sertifikasi.
     */
    public function update(Request $request)
    {
        // TODO: Implement update logic
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Delete selected records.
     */
    public function hapus(Request $request)
    {
        $items = $request->input('items', '');
        // TODO: Implement delete logic
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);
    }

    /**
     * Print/export to PDF.
     */
    public function cetak()
    {
        // TODO: Generate PDF
        return redirect()->back()->with('info', 'Fitur cetak akan segera tersedia.');
    }

    /**
     * Export to Excel.
     */
    public function getLaporan()
    {
        // TODO: Generate Excel
        return redirect()->back()->with('info', 'Fitur export Excel akan segera tersedia.');
    }

    /**
     * Get produsen address via AJAX.
     */
    public function dapatkanAlamatProdusen(Request $request)
    {
        $idProdusen = $request->input('id_produsen', 0);
        $produsen = Produsen::find($idProdusen);
        $alamat = $produsen ? $produsen->alamat : '';
        return $alamat;
    }
}
