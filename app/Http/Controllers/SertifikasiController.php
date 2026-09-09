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
    public function tambah(Request $request)
    {
        $tipeForm = $request->get('tipe', '1');
        // TODO: Return view for add form
        return view('sertifikasi.form_pengajuan', compact('tipeForm'));
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

    /* ==================== PASCA LAPANGAN ==================== */

    /**
     * Display the Pasca Lapangan index page.
     */
    public function pascaLapangan(Request $request)
    {
        $musim = $request->get('musim_tanam', '');
        $data = [
            (object) [
                'id' => 1,
                'musim_tanam' => '2024',
                'kode_unik_sertifikasi' => 'SERT-2024-PL-001',
                'no_asal' => 'SERT-2024-001',
                'nama_produsen_aju' => 'PT. Sumber Benih',
                'no_induk_lapangan' => 'NIL-001',
                'produsen_lhu' => 'PT. Sumber Benih LHU',
                'no_kelompok_benih' => 'LOT-2024-001',
                'no_kelompok_benih_pcb' => 'PCB-2024-001',
                'berat_kemasan' => '50',
                'no_konsep' => 'KONSEP-001',
            ],
            (object) [
                'id' => 2,
                'musim_tanam' => '2025',
                'kode_unik_sertifikasi' => 'SERT-2025-PL-002',
                'no_asal' => 'SERT-2025-002',
                'nama_produsen_aju' => 'CV. Makmur Jaya',
                'no_induk_lapangan' => 'NIL-002',
                'produsen_lhu' => 'CV. Makmur Jaya LHU',
                'no_kelompok_benih' => 'LOT-2025-002',
                'no_kelompok_benih_pcb' => 'PCB-2025-002',
                'berat_kemasan' => '25',
                'no_konsep' => 'KONSEP-002',
            ],
        ];

        if ($musim) {
            $data = array_filter($data, function($item) use ($musim) {
                return $item->musim_tanam == $musim;
            });
        }

        return view('sertifikasi.pasca_lapangan', compact('data'));
    }

    /**
     * Show form to add new pasca lapangan data.
     */
    public function pascaTambah()
    {
        return view('sertifikasi.form_pengolahan');
    }

    /**
     * Show detail of a pasca lapangan record.
     */
    public function pascaLihat($id)
    {
        // TODO: Fetch from database
        $pasca = (object) [
            'id' => $id,
            'kode_unik_sertifikasi' => 'SERT-2024-PL-' . str_pad($id, 3, '0', STR_PAD_LEFT),
            'no_asal' => 'SERT-2024-' . str_pad($id, 3, '0', STR_PAD_LEFT),
            'nama_produsen_aju' => 'PT. Sumber Benih',
            'no_induk_lapangan' => 'NIL-' . str_pad($id, 3, '0', STR_PAD_LEFT),
            'produsen_lhu' => 'PT. Sumber Benih LHU',
            'no_kelompok_benih' => 'LOT-2024-' . str_pad($id, 3, '0', STR_PAD_LEFT),
            'no_kelompok_benih_pcb' => 'PCB-2024-' . str_pad($id, 3, '0', STR_PAD_LEFT),
            'berat_kemasan' => '50',
            'no_konsep' => 'KONSEP-' . str_pad($id, 3, '0', STR_PAD_LEFT),
        ];
        return view('sertifikasi.form_pengolahan', compact('id', 'pasca'));
    }

    /**
     * Show fase pengolahan form for a record.
     */
    public function pascaPengolahan($id)
    {
        $produsen_list = Produsen::orderBy('nama')->get();
        $pegawai_list = Pegawai::orderBy('nama')->get();
        // TODO: Fetch pasca data from database
        $pasca = (object) [
            'id' => $id,
            'kode_unik_sertifikasi' => 'SERT-2024-PL-' . str_pad($id, 3, '0', STR_PAD_LEFT),
            'no_induk_lapangan' => 'NIL-' . str_pad($id, 3, '0', STR_PAD_LEFT),
            'nama_produsen_aju' => 'PT. Sumber Benih',
            'alamat_produsen' => 'Jl. Benih No. 1, Malang',
            'nama_tanaman' => 'Padi',
            'nama_varietas' => 'IR-64',
            'cvl_berbunga_jantan' => '85',
            'cvl_berbunga_betina' => '88',
            'bunga_jantan_tertinggal' => '5',
            'cvl_masak_betina' => '90',
            'induk_jantan_tertinggal' => '3',
            'tgl_pemeriksaan' => date('Y-m-d'),
            'tgl_laporan' => date('Y-m-d'),
            'id_pegawai' => 1,
            'lokasi_pcb' => 1,
            'jenis_tanaman_akhir' => 'Padi',
            'varietas_akhir' => 'IR-64',
            'id_produsen_lhu' => 1,
            'kelas_benih_akhir' => 'BS',
            'produksi_benih' => '1000',
            'berat_kemasan' => '50',
            'no_kelompok_benih' => 'LOT-2024-' . str_pad($id, 3, '0', STR_PAD_LEFT),
            'no_kelompok_benih_pcb' => 'PCB-2024-' . str_pad($id, 3, '0', STR_PAD_LEFT),
            'no_lhu' => 'LHU-2024-' . str_pad($id, 3, '0', STR_PAD_LEFT),
            'tgl_lhu' => date('Y-m-d'),
            'ka' => '12.5',
            'kemurnian' => '98.5',
            'dk' => '95',
            'benih_murni' => '20',
            'kotoran_benih' => '1.5',
            'biji_gulma' => '2',
            'kesimpulan_lhu' => 'Memenuhi Syarat',
            'no_konsep' => 'KONSEP-' . str_pad($id, 3, '0', STR_PAD_LEFT),
            'tgl_konsep' => date('Y-m-d'),
            'jumlah_kemasan' => '20',
            'total_berat' => '1000',
            'tgl_kadaluarsa' => date('Y-m-d', strtotime('+1 year')),
            'keterangan' => '',
        ];
        return view('sertifikasi.form_pengolahan', compact('id', 'pasca', 'produsen_list', 'pegawai_list'));
    }

    /**
     * Update pasca lapangan data.
     */
    public function pascaUpdate(Request $request)
    {
        // TODO: Implement update logic
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Delete selected pasca lapangan records.
     */
    public function pascaHapus(Request $request)
    {
        $id = $request->input('id', '');
        // TODO: Implement delete logic
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);
    }

    /**
     * Export pasca lapangan to Excel.
     */
    public function pascaExportExcel()
    {
        // TODO: Generate Excel
        return redirect()->back()->with('info', 'Fitur export Excel akan segera tersedia.');
    }

    /**
     * Print/export pasca lapangan to PDF.
     */
    public function pascaCetak($jenis, $id)
    {
        // TODO: Generate PDF
        return redirect()->back()->with('info', 'Fitur cetak akan segera tersedia.');
    }

    /* ==================== KONSEP LABEL ==================== */

    /**
     * Display the Konsep Label index page.
     */
    public function konsepLabel(Request $request)
    {
        // TODO: Replace with actual data from database
        $data = [
            (object) [
                'id' => 17151,
                'no' => 1,
                'lihat' => url('') . '/admin/sertifikasi/label/ubah/17151/1/19178/lihat',
                'edit' => url('') . '/admin/sertifikasi/label/ubah/17151/1/19178/kosong',
                'print' => 'https://daftar.bpsbjatim.com/simbenihkonseplabel/c44cc3a1dafb37ba0bec93b81ee3796a/541',
                'no_asal' => 'SP.0257.14.426',
                'nama_produsen' => 'UD. SUMBER REJEKI',
                'no_induk_lapangan' => 'PdnSE.P.3514090.0279.0027.0257.14.426',
                'no_konsep' => '121',
                'no_kelompok_benih' => '14/02',
                'stok_benih' => '5600 Kilogram',
                'berat_bersih' => '5600 Kilogram',
                'berat_kemasan' => '10 Kilogram',
                'label_awal' => '34087526',
                'label_akhir' => '34088085',
            ],
            (object) [
                'id' => 17150,
                'no' => 2,
                'lihat' => url('') . '/admin/sertifikasi/label/ubah/17150/1/19265/lihat',
                'edit' => url('') . '/admin/sertifikasi/label/ubah/17150/1/19265/kosong',
                'print' => 'https://daftar.bpsbjatim.com/simbenihkonseplabel/7ad45ac2157d72801438b07dffcbbb20/541',
                'no_asal' => 'S.0775.15.526',
                'nama_produsen' => 'UD. MURNI TANI',
                'no_induk_lapangan' => 'PdnRC.R.3511140.0405.0093.0775.15.526',
                'no_konsep' => '0089',
                'no_kelompok_benih' => '12/33',
                'stok_benih' => '1730 Kilogram',
                'berat_bersih' => '1730 Kilogram',
                'berat_kemasan' => '10 Kilogram',
                'label_awal' => '350119859',
                'label_akhir' => '350120031',
            ],
            (object) [
                'id' => 17149,
                'no' => 3,
                'lihat' => url('') . '/admin/sertifikasi/label/ubah/17149/1/19270/lihat',
                'edit' => url('') . '/admin/sertifikasi/label/ubah/17149/1/19270/kosong',
                'print' => 'https://daftar.bpsbjatim.com/simbenihkonseplabel/c04819b0706f1f3fe9352ea81623d826/541',
                'no_asal' => 'S.0780.15.526',
                'nama_produsen' => 'UD. MURNI TANI',
                'no_induk_lapangan' => 'PdnQI.P.3511170.0405.0340.0780.15.526',
                'no_konsep' => '0692',
                'no_kelompok_benih' => '46/38',
                'stok_benih' => '1300 Kilogram',
                'berat_bersih' => '1300 Kilogram',
                'berat_kemasan' => '10 Kilogram',
                'label_awal' => '35486037',
                'label_akhir' => '35486166',
            ],
        ];

        return view('sertifikasi.konsep_label', compact('data'));
    }

    /**
     * Show permohonan (recommendation) list for Konsep Label.
     */
    public function permohonanKonsepLabel(Request $request)
    {
        // TODO: Replace with actual data from database
        $data = [
            (object) [
                'no' => 1,
                'input' => url('') . '/admin/sertifikasi/label/input/25',
                'no_dokumen' => '49/17',
                'no_lot' => 'S.0163.15.524',
                'no_asal' => 'BP',
                'nama_kelas_benih' => 'BP',
                'berat_kelompok_benih' => '5500',
            ],
            (object) [
                'no' => 2,
                'input' => url('') . '/admin/sertifikasi/label/input/17',
                'no_dokumen' => '50/18',
                'no_lot' => 'S.0164.15.524',
                'no_asal' => 'BP',
                'nama_kelas_benih' => 'BP',
                'berat_kelompok_benih' => '5400',
            ],
            (object) [
                'no' => 3,
                'input' => url('') . '/admin/sertifikasi/label/input/6',
                'no_dokumen' => '36/34.MDN/24',
                'no_lot' => 'S.0179.12.224',
                'no_asal' => 'BP',
                'nama_kelas_benih' => 'BP',
                'berat_kelompok_benih' => '10500',
            ],
        ];

        return view('sertifikasi.permohonan_konsep_label', compact('data'));
    }

    /**
     * Show form to input/create new Konsep Label.
     */
    public function konsepLabelInput($id)
    {
        $produsen_list = Produsen::orderBy('nama')->get();
        $pegawai_list = Pegawai::orderBy('nama')->get();

        // TODO: Fetch rekomendasi data from database based on $id
        $rekomendasi = (object) [
            'id' => $id,
            'no_induk' => 'PdnSE.P.3514090.0279.0027.0257.14.426',
            'no_asal' => 'S.0163.15.524',
            'kelas_benih' => 'BP',
            'kadaluarsa' => date('Y-m-d', strtotime('+1 year')),
            'produsen' => 1463,
            'stok_benih' => 5500,
            'berat_bersih' => 0,
            'berat_kemasan' => 0,
            'jumlah_label' => 0,
            'label_awal' => '',
            'label_akhir' => '',
        ];

        $mode = 'create';
        return view('sertifikasi.form_konsep_label', compact('id', 'rekomendasi', 'produsen_list', 'pegawai_list', 'mode'));
    }

    /**
     * Store new Konsep Label.
     */
    public function konsepLabelInsert(Request $request, $id)
    {
        // TODO: Implement insert logic
        $request->validate([
            'NO_KONSEP' => 'required',
            'TGL_KONSEP_LABEL' => 'required|date',
            'pengawas' => 'required',
            'produsen' => 'required',
            'halogram' => 'required',
            'BERAT_BERSIH' => 'required|numeric|min:0',
            'berat_kemasan' => 'required|numeric|min:0',
            'label_awal' => 'required|numeric',
        ]);

        // Simulate validation error for demonstration
        if ($request->has('simulate_error')) {
            return redirect()->back()->with('error', 'Kegagalan Menyimpan Data, Kesalahan Pengisian Form!');
        }

        return redirect()->route('sertifikasi.konsep_label.index')
            ->with('success', 'Data Konsep Label berhasil disimpan.');
    }

    /**
     * Show view/edit form for Konsep Label.
     * Mode: 'lihat' = view only, 'kosong' = edit
     */
    public function konsepLabelUbah($id, $a, $b, $mode)
    {
        $produsen_list = Produsen::orderBy('nama')->get();
        $pegawai_list = Pegawai::orderBy('nama')->get();

        // TODO: Fetch data from database based on $id
        $konsep = (object) [
            'id' => $id,
            'no_induk' => 'PdnSE.P.3514090.0279.0027.0257.14.426',
            'no_asal' => 'SP.0257.14.426',
            'kelas_benih' => 'BP',
            'no_konsep' => '121',
            'tgl_konsep_label' => '2026-08-19',
            'kadaluarsa' => '2027-02-18',
            'pengawas' => 423,
            'produsen' => 1404,
            'halogram' => 1,
            'stok_benih' => 5600,
            'berat_bersih' => 5600,
            'berat_kemasan' => 10,
            'jumlah_label' => 560,
            'label_awal' => '34087526',
            'label_akhir' => '34088085',
            'ket_konsep' => '',
            'id_rekomendasi' => 18069,
            'id_kaji_ulang' => 18677,
        ];

        return view('sertifikasi.form_konsep_label', compact('id', 'a', 'b', 'mode', 'konsep', 'produsen_list', 'pegawai_list'));
    }

    /**
     * Update Konsep Label.
     */
    public function konsepLabelUpdate(Request $request, $id, $a)
    {
        // TODO: Implement update logic
        $request->validate([
            'NO_KONSEP' => 'required',
            'TGL_KONSEP_LABEL' => 'required|date',
            'pengawas' => 'required',
            'produsen' => 'required',
            'halogram' => 'required',
            'BERAT_BERSIH' => 'required|numeric|min:0',
            'berat_kemasan' => 'required|numeric|min:0',
            'label_awal' => 'required|numeric',
        ]);

        return redirect()->route('sertifikasi.konsep_label.index')
            ->with('success', 'Data Konsep Label berhasil diperbarui.');
    }

    /**
     * Delete selected Konsep Label records (AJAX).
     */
    public function konsepLabelDelete(Request $request)
    {
        $items = $request->input('items', '');
        // TODO: Implement delete logic
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);
    }

    /**
     * Get JSON data for Konsep Label grid (for DataTables).
     */
    public function gridKonsepLabel(Request $request)
    {
        // TODO: Replace with actual data from database
        $data = [
            (object) [
                'id' => 17151,
                'no' => 1,
                'lihat' => '<a href="' . url('') . '/admin/sertifikasi/label/ubah/17151/1/19178/lihat"><img border="0" src="' . asset('assets/img/book.png') . '"></a>',
                'edit' => '<a href="' . url('') . '/admin/sertifikasi/label/ubah/17151/1/19178/kosong"><img border="0" src="' . asset('assets/img/edit.png') . '"></a>',
                'print' => '<a href="https://daftar.bpsbjatim.com/simbenihkonseplabel/c44cc3a1dafb37ba0bec93b81ee3796a/541" target="_blank"><img border="0" src="' . asset('assets/img/print.png') . '"></a>',
                'no_asal' => 'SP.0257.14.426',
                'nama_produsen' => 'UD. SUMBER REJEKI',
                'no_induk_lapangan' => 'PdnSE.P.3514090.0279.0027.0257.14.426',
                'no_konsep' => '121',
                'no_kelompok_benih' => '14/02',
                'stok_benih' => '5600 Kilogram',
                'berat_bersih' => '5600 Kilogram',
                'berat_kemasan' => '10 Kilogram',
                'label_awal' => '34087526',
                'label_akhir' => '34088085',
            ],
            (object) [
                'id' => 17150,
                'no' => 2,
                'lihat' => '<a href="' . url('') . '/admin/sertifikasi/label/ubah/17150/1/19265/lihat"><img border="0" src="' . asset('assets/img/book.png') . '"></a>',
                'edit' => '<a href="' . url('') . '/admin/sertifikasi/label/ubah/17150/1/19265/kosong"><img border="0" src="' . asset('assets/img/edit.png') . '"></a>',
                'print' => '<a href="https://daftar.bpsbjatim.com/simbenihkonseplabel/7ad45ac2157d72801438b07dffcbbb20/541" target="_blank"><img border="0" src="' . asset('assets/img/print.png') . '"></a>',
                'no_asal' => 'S.0775.15.526',
                'nama_produsen' => 'UD. MURNI TANI',
                'no_induk_lapangan' => 'PdnRC.R.3511140.0405.0093.0775.15.526',
                'no_konsep' => '0089',
                'no_kelompok_benih' => '12/33',
                'stok_benih' => '1730 Kilogram',
                'berat_bersih' => '1730 Kilogram',
                'berat_kemasan' => '10 Kilogram',
                'label_awal' => '350119859',
                'label_akhir' => '350120031',
            ],
            (object) [
                'id' => 17149,
                'no' => 3,
                'lihat' => '<a href="' . url('') . '/admin/sertifikasi/label/ubah/17149/1/19270/lihat"><img border="0" src="' . asset('assets/img/book.png') . '"></a>',
                'edit' => '<a href="' . url('') . '/admin/sertifikasi/label/ubah/17149/1/19270/kosong"><img border="0" src="' . asset('assets/img/edit.png') . '"></a>',
                'print' => '<a href="https://daftar.bpsbjatim.com/simbenihkonseplabel/c04819b0706f1f3fe9352ea81623d826/541" target="_blank"><img border="0" src="' . asset('assets/img/print.png') . '"></a>',
                'no_asal' => 'S.0780.15.526',
                'nama_produsen' => 'UD. MURNI TANI',
                'no_induk_lapangan' => 'PdnQI.P.3511170.0405.0340.0780.15.526',
                'no_konsep' => '0692',
                'no_kelompok_benih' => '46/38',
                'stok_benih' => '1300 Kilogram',
                'berat_bersih' => '1300 Kilogram',
                'berat_kemasan' => '10 Kilogram',
                'label_awal' => '35486037',
                'label_akhir' => '35486166',
            ],
        ];

        $draw = $request->get('draw', 1);
        $start = $request->get('start', 0);
        $length = $request->get('length', 10);
        $search = $request->get('search', ['value' => '']);

        $total = count($data);

        // Simple search filter
        if (!empty($search['value'])) {
            $data = array_filter($data, function($item) use ($search) {
                $term = strtolower($search['value']);
                return strpos(strtolower($item->no_asal), $term) !== false ||
                       strpos(strtolower($item->nama_produsen), $term) !== false ||
                       strpos(strtolower($item->no_konsep), $term) !== false ||
                       strpos(strtolower($item->no_kelompok_benih), $term) !== false ||
                       strpos(strtolower($item->label_awal), $term) !== false ||
                       strpos(strtolower($item->label_akhir), $term) !== false;
            });
        }

        $filtered = count($data);
        $data = array_slice($data, $start, $length);

        $rows = [];
        foreach ($data as $item) {
            $rows[] = [
                'id' => $item->id,
                'cell' => [
                    $item->no,
                    $item->lihat,
                    $item->edit,
                    $item->print,
                    $item->no_asal,
                    $item->nama_produsen,
                    $item->no_induk_lapangan,
                    $item->no_konsep,
                    $item->no_kelompok_benih,
                    $item->stok_benih,
                    $item->berat_bersih,
                    $item->berat_kemasan,
                    $item->label_awal,
                    $item->label_akhir,
                ]
            ];
        }

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'page' => ceil($start / $length) + 1,
            'total' => ceil($filtered / $length),
            'rows' => $rows,
        ]);
    }

    /**
     * Get JSON data for Permohonan Konsep Label grid (for DataTables).
     */
    public function gridPermohonanKonsepLabel(Request $request)
    {
        // TODO: Replace with actual data from database
        $data = [
            (object) [
                'no' => 1,
                'input' => '<a href="' . url('') . '/admin/sertifikasi/label/input/25"><img border="0" src="' . asset('assets/img/paper-bag--pencil.png') . '"></a>',
                'no_dokumen' => '49/17',
                'no_lot' => 'S.0163.15.524',
                'no_asal' => 'BP',
                'nama_kelas_benih' => 'BP',
                'berat_kelompok_benih' => '5500',
            ],
            (object) [
                'no' => 2,
                'input' => '<a href="' . url('') . '/admin/sertifikasi/label/input/17"><img border="0" src="' . asset('assets/img/paper-bag--pencil.png') . '"></a>',
                'no_dokumen' => '50/18',
                'no_lot' => 'S.0164.15.524',
                'no_asal' => 'BP',
                'nama_kelas_benih' => 'BP',
                'berat_kelompok_benih' => '5400',
            ],
            (object) [
                'no' => 3,
                'input' => '<a href="' . url('') . '/admin/sertifikasi/label/input/6"><img border="0" src="' . asset('assets/img/paper-bag--pencil.png') . '"></a>',
                'no_dokumen' => '36/34.MDN/24',
                'no_lot' => 'S.0179.12.224',
                'no_asal' => 'BP',
                'nama_kelas_benih' => 'BP',
                'berat_kelompok_benih' => '10500',
            ],
        ];

        $draw = $request->get('draw', 1);
        $start = $request->get('start', 0);
        $length = $request->get('length', 10);
        $search = $request->get('search', ['value' => '']);

        $total = count($data);

        if (!empty($search['value'])) {
            $data = array_filter($data, function($item) use ($search) {
                $term = strtolower($search['value']);
                return strpos(strtolower($item->no_dokumen), $term) !== false ||
                       strpos(strtolower($item->no_lot), $term) !== false ||
                       strpos(strtolower($item->no_asal), $term) !== false ||
                       strpos(strtolower($item->nama_kelas_benih), $term) !== false;
            });
        }

        $filtered = count($data);
        $data = array_slice($data, $start, $length);

        $rows = [];
        foreach ($data as $item) {
            $rows[] = [
                'id' => $item->no,
                'cell' => [
                    $item->no,
                    $item->input,
                    $item->no_dokumen,
                    $item->no_lot,
                    $item->no_asal,
                    $item->nama_kelas_benih,
                    $item->berat_kelompok_benih,
                ]
            ];
        }

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'page' => ceil($start / $length) + 1,
            'total' => ceil($filtered / $length),
            'rows' => $rows,
        ]);
    }

    /* ==================== KONSEP LABEL STANDART ==================== */

    /**
     * Display the Konsep Label Standart index page.
     */
    public function konsepLabelStandart(Request $request)
    {
        // TODO: Replace with actual data from database
        $data = [
            (object) [
                'id' => 16987,
                'no' => 1,
                'lihat' => url('') . '/admin/sertifikasi/label_standart/ubah/16987/1/19315/lihat',
                'edit' => url('') . '/admin/sertifikasi/label_standart/ubah/16987/1/19315/kosong',
                'print' => 'https://daftar.bpsbjatim.com/simbenihkonseplabelstandart/9487c0d93b1eb327013934c5b0d17ae4/541',
                'no_asal' => 'SP.0612.13.326',
                'nama_produsen' => 'PT. SOEBANDI RAJA AGRICULTURE',
                'no_induk_lapangan' => 'JghPO.R.3505150.0220.0057.0612.13.326',
                'no_konsep' => '207',
                'no_kelompok_benih' => '30/03/BLT',
                'stok_benih' => '2300 Kilogram',
                'berat_bersih' => '2300 Kilogram',
                'berat_kemasan' => '5 Kilogram',
                'label_awal' => '330352137',
                'label_akhir' => '330352596',
            ],
            (object) [
                'id' => 16986,
                'no' => 2,
                'lihat' => url('') . '/admin/sertifikasi/label_standart/ubah/16986/1/19312/lihat',
                'edit' => url('') . '/admin/sertifikasi/label_standart/ubah/16986/1/19312/kosong',
                'print' => 'https://daftar.bpsbjatim.com/simbenihkonseplabelstandart/2851389c12fee533abfa505b4c7551d1/541',
                'no_asal' => 'SP.0611.13.326',
                'nama_produsen' => 'PT. SOEBANDI RAJA AGRICULTURE',
                'no_induk_lapangan' => 'JghPO.R.3505190.0220.0056.0611.13.326',
                'no_konsep' => '206',
                'no_kelompok_benih' => '28/02/BLT',
                'stok_benih' => '1860 Kilogram',
                'berat_bersih' => '1860 Kilogram',
                'berat_kemasan' => '5 Kilogram',
                'label_awal' => '330351765',
                'label_akhir' => '330352136',
            ],
            (object) [
                'id' => 16985,
                'no' => 3,
                'lihat' => url('') . '/admin/sertifikasi/label_standart/ubah/16985/1/19314/lihat',
                'edit' => url('') . '/admin/sertifikasi/label_standart/ubah/16985/1/19314/kosong',
                'print' => 'https://daftar.bpsbjatim.com/simbenihkonseplabelstandart/b3ca85cd30bca7607c9520accaa4ffcf/541',
                'no_asal' => 'SP.0610.13.326',
                'nama_produsen' => 'PT. SOEBANDI RAJA AGRICULTURE',
                'no_induk_lapangan' => 'JghPO.R.3503070.0220.0024.0610.13.326',
                'no_konsep' => '205',
                'no_kelompok_benih' => '29/02/TGK',
                'stok_benih' => '4020 Kilogram',
                'berat_bersih' => '4020 Kilogram',
                'berat_kemasan' => '5 Kilogram',
                'label_awal' => '330350961',
                'label_akhir' => '330351764',
            ],
        ];

        return view('sertifikasi.konsep_label_standart', compact('data'));
    }

    /**
     * Show permohonan (recommendation) list for Konsep Label Standart.
     */
    public function permohonanKonsepLabelStandart(Request $request)
    {
        // TODO: Replace with actual data from database
        $data = [
            (object) [
                'no' => 1,
                'input' => url('') . '/admin/sertifikasi/label_standart/input/2837',
                'no_dokumen' => 'PdnKD.P.3509120.0355.0155.0000.00.000',
                'no_lot' => '99/25',
                'no_asal' => 'S.0000.00.000',
                'no_lab' => 'S.1666.5.24',
                'nama_kelas_benih' => 'BP',
                'berat_kelompok_benih' => '2500',
            ],
            (object) [
                'no' => 2,
                'input' => url('') . '/admin/sertifikasi/label_standart/input/2894',
                'no_dokumen' => 'PdnQI.P.3511040.0410.0010.0000.00.001',
                'no_lot' => '05/53',
                'no_asal' => 'S.0000.00.001',
                'no_lab' => 'S.1658.5.24',
                'nama_kelas_benih' => 'BP',
                'berat_kelompok_benih' => '6000',
            ],
            (object) [
                'no' => 3,
                'input' => url('') . '/admin/sertifikasi/label_standart/input/18443',
                'no_dokumen' => 'PdnQI.P.3509160.0355.0334.0000.25.523',
                'no_lot' => '78/25',
                'no_asal' => 'S.0000.25.523',
                'no_lab' => 'S.0000.5.26',
                'nama_kelas_benih' => 'BP',
                'berat_kelompok_benih' => '4650',
            ],
        ];

        return view('sertifikasi.permohonan_konsep_label_standart', compact('data'));
    }

    /**
     * Show form to input/create new Konsep Label Standart.
     */
    public function konsepLabelStandartInput($id)
    {
        $produsen_list = Produsen::orderBy('nama')->get();
        $pegawai_list = Pegawai::orderBy('nama')->get();

        // TODO: Fetch rekomendasi data from database based on $id
        $rekomendasi = (object) [
            'id' => $id,
            'no_induk' => 'PdnKD.P.3509120.0355.0155.0000.00.000',
            'no_asal' => 'S.0000.00.000',
            'no_lab' => 'S.1666.5.24',
            'kelas_benih' => 'BP',
            'kadaluarsa' => date('Y-m-d', strtotime('+1 year')),
            'produsen' => 1538,
            'stok_benih' => 2500,
            'berat_bersih' => 0,
            'berat_kemasan' => 0,
            'jumlah_label' => 0,
            'label_awal' => '',
            'label_akhir' => '',
        ];

        $mode = 'create';
        return view('sertifikasi.form_konsep_label_standart', compact('id', 'rekomendasi', 'produsen_list', 'pegawai_list', 'mode'));
    }

    /**
     * Store new Konsep Label Standart.
     */
    public function konsepLabelStandartInsert(Request $request, $id)
    {
        // TODO: Implement insert logic
        $request->validate([
            'NO_KONSEP' => 'required',
            'TGL_KONSEP_LABEL' => 'required|date',
            'pengawas' => 'required',
            'produsen' => 'required',
            'warna_label' => 'required',
            'halogram' => 'required',
            'BERAT_BERSIH' => 'required|numeric|min:0',
            'berat_kemasan' => 'required|numeric|min:0',
            'label_awal' => 'required|numeric',
            'KADAR_AIR_KOLAB' => 'required',
            'BENIH_MURNI_KOLAB' => 'required',
            'GULMA_KOLAB' => 'required',
            'KOTORAN_BENIH_KOLAB' => 'required',
            'DAYA_TUMBUH_KOLAB' => 'required',
        ]);

        // Simulate validation error for demonstration
        if ($request->has('simulate_error')) {
            return redirect()->back()->with('error', 'Kegagalan Menyimpan Data, Kesalahan Pengisian Form!');
        }

        return redirect()->route('sertifikasi.konsep_label_standart.index')
            ->with('success', 'Data Konsep Label Standart berhasil disimpan.');
    }

    /**
     * Show view/edit form for Konsep Label Standart.
     * Mode: 'lihat' = view only, 'kosong' = edit
     */
    public function konsepLabelStandartUbah($id, $a, $b, $mode)
    {
        $produsen_list = Produsen::orderBy('nama')->get();
        $pegawai_list = Pegawai::orderBy('nama')->get();

        // TODO: Fetch data from database based on $id
        $konsep = (object) [
            'id' => $id,
            'no_induk' => 'JghPO.R.3505150.0220.0057.0612.13.326',
            'no_asal' => 'SP.0612.13.326',
            'no_lab' => 'SP.0158.3.26',
            'kelas_benih' => 'BR',
            'no_konsep' => '207',
            'tgl_konsep_label' => '2026-08-18',
            'kadaluarsa' => '2027-05-20',
            'pengawas' => 353,
            'produsen' => 1457,
            'warna_label' => 'Biru',
            'halogram' => 1,
            'stok_benih' => 2300,
            'berat_bersih' => 2300,
            'berat_kemasan' => 5,
            'jumlah_label' => 460,
            'label_awal' => '330352137',
            'label_akhir' => '330352596',
            'ket_konsep' => '',
            'kadar_air' => '12,0',
            'benih_murni' => '98,0',
            'gulma' => '0,2',
            'kotoran_benih' => '2,0',
            'daya_tumbuh' => '85',
            'id_rekomendasi' => 2837,
            'id_kaji_ulang' => 18787,
            'print_hash' => '9487c0d93b1eb327013934c5b0d17ae4',
        ];

        return view('sertifikasi.form_konsep_label_standart', compact('id', 'a', 'b', 'mode', 'konsep', 'produsen_list', 'pegawai_list'));
    }

    /**
     * Update Konsep Label Standart.
     */
    public function konsepLabelStandartUpdate(Request $request, $id, $a)
    {
        // TODO: Implement update logic
        $request->validate([
            'NO_KONSEP' => 'required',
            'TGL_KONSEP_LABEL' => 'required|date',
            'pengawas' => 'required',
            'produsen' => 'required',
            'warna_label' => 'required',
            'halogram' => 'required',
            'BERAT_BERSIH' => 'required|numeric|min:0',
            'berat_kemasan' => 'required|numeric|min:0',
            'label_awal' => 'required|numeric',
            'KADAR_AIR_KOLAB' => 'required',
            'BENIH_MURNI_KOLAB' => 'required',
            'GULMA_KOLAB' => 'required',
            'KOTORAN_BENIH_KOLAB' => 'required',
            'DAYA_TUMBUH_KOLAB' => 'required',
        ]);

        return redirect()->route('sertifikasi.konsep_label_standart.index')
            ->with('success', 'Data Konsep Label Standart berhasil diperbarui.');
    }

    /**
     * Delete selected Konsep Label Standart records (AJAX).
     */
    public function konsepLabelStandartDelete(Request $request)
    {
        $items = $request->input('items', '');
        // TODO: Implement delete logic
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);
    }

    /**
     * Get JSON data for Konsep Label Standart grid (for DataTables).
     */
    public function gridKonsepLabelStandart(Request $request)
    {
        // TODO: Replace with actual data from database
        $data = [
            (object) [
                'id' => 16987,
                'no' => 1,
                'lihat' => '<a href="' . url('') . '/admin/sertifikasi/label_standart/ubah/16987/1/19315/lihat"><img border="0" src="' . asset('assets/img/book.png') . '"></a>',
                'edit' => '<a href="' . url('') . '/admin/sertifikasi/label_standart/ubah/16987/1/19315/kosong"><img border="0" src="' . asset('assets/img/edit.png') . '"></a>',
                'print' => '<a href="https://daftar.bpsbjatim.com/simbenihkonseplabelstandart/9487c0d93b1eb327013934c5b0d17ae4/541" target="_blank"><img border="0" src="' . asset('assets/img/print.png') . '"></a>',
                'no_asal' => 'SP.0612.13.326',
                'nama_produsen' => 'PT. SOEBANDI RAJA AGRICULTURE',
                'no_induk_lapangan' => 'JghPO.R.3505150.0220.0057.0612.13.326',
                'no_konsep' => '207',
                'no_kelompok_benih' => '30/03/BLT',
                'stok_benih' => '2300 Kilogram',
                'berat_bersih' => '2300 Kilogram',
                'berat_kemasan' => '5 Kilogram',
                'label_awal' => '330352137',
                'label_akhir' => '330352596',
            ],
            (object) [
                'id' => 16986,
                'no' => 2,
                'lihat' => '<a href="' . url('') . '/admin/sertifikasi/label_standart/ubah/16986/1/19312/lihat"><img border="0" src="' . asset('assets/img/book.png') . '"></a>',
                'edit' => '<a href="' . url('') . '/admin/sertifikasi/label_standart/ubah/16986/1/19312/kosong"><img border="0" src="' . asset('assets/img/edit.png') . '"></a>',
                'print' => '<a href="https://daftar.bpsbjatim.com/simbenihkonseplabelstandart/2851389c12fee533abfa505b4c7551d1/541" target="_blank"><img border="0" src="' . asset('assets/img/print.png') . '"></a>',
                'no_asal' => 'SP.0611.13.326',
                'nama_produsen' => 'PT. SOEBANDI RAJA AGRICULTURE',
                'no_induk_lapangan' => 'JghPO.R.3505190.0220.0056.0611.13.326',
                'no_konsep' => '206',
                'no_kelompok_benih' => '28/02/BLT',
                'stok_benih' => '1860 Kilogram',
                'berat_bersih' => '1860 Kilogram',
                'berat_kemasan' => '5 Kilogram',
                'label_awal' => '330351765',
                'label_akhir' => '330352136',
            ],
            (object) [
                'id' => 16985,
                'no' => 3,
                'lihat' => '<a href="' . url('') . '/admin/sertifikasi/label_standart/ubah/16985/1/19314/lihat"><img border="0" src="' . asset('assets/img/book.png') . '"></a>',
                'edit' => '<a href="' . url('') . '/admin/sertifikasi/label_standart/ubah/16985/1/19314/kosong"><img border="0" src="' . asset('assets/img/edit.png') . '"></a>',
                'print' => '<a href="https://daftar.bpsbjatim.com/simbenihkonseplabelstandart/b3ca85cd30bca7607c9520accaa4ffcf/541" target="_blank"><img border="0" src="' . asset('assets/img/print.png') . '"></a>',
                'no_asal' => 'SP.0610.13.326',
                'nama_produsen' => 'PT. SOEBANDI RAJA AGRICULTURE',
                'no_induk_lapangan' => 'JghPO.R.3503070.0220.0024.0610.13.326',
                'no_konsep' => '205',
                'no_kelompok_benih' => '29/02/TGK',
                'stok_benih' => '4020 Kilogram',
                'berat_bersih' => '4020 Kilogram',
                'berat_kemasan' => '5 Kilogram',
                'label_awal' => '330350961',
                'label_akhir' => '330351764',
            ],
        ];

        $draw = $request->get('draw', 1);
        $start = $request->get('start', 0);
        $length = $request->get('length', 10);
        $search = $request->get('search', ['value' => '']);

        $total = count($data);

        // Simple search filter
        if (!empty($search['value'])) {
            $data = array_filter($data, function($item) use ($search) {
                $term = strtolower($search['value']);
                return strpos(strtolower($item->no_asal), $term) !== false ||
                       strpos(strtolower($item->nama_produsen), $term) !== false ||
                       strpos(strtolower($item->no_konsep), $term) !== false ||
                       strpos(strtolower($item->no_kelompok_benih), $term) !== false ||
                       strpos(strtolower($item->label_awal), $term) !== false ||
                       strpos(strtolower($item->label_akhir), $term) !== false;
            });
        }

        $filtered = count($data);
        $data = array_slice($data, $start, $length);

        $rows = [];
        foreach ($data as $item) {
            $rows[] = [
                'id' => $item->id,
                'cell' => [
                    $item->no,
                    $item->lihat,
                    $item->edit,
                    $item->print,
                    $item->no_asal,
                    $item->nama_produsen,
                    $item->no_induk_lapangan,
                    $item->no_konsep,
                    $item->no_kelompok_benih,
                    $item->stok_benih,
                    $item->berat_bersih,
                    $item->berat_kemasan,
                    $item->label_awal,
                    $item->label_akhir,
                ]
            ];
        }

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'page' => ceil($start / $length) + 1,
            'total' => ceil($filtered / $length),
            'rows' => $rows,
        ]);
    }

    /**
     * Get JSON data for Permohonan Konsep Label Standart grid (for DataTables).
     */
    public function gridPermohonanKonsepLabelStandart(Request $request)
    {
        // TODO: Replace with actual data from database
        $data = [
            (object) [
                'no' => 1,
                'input' => '<a href="' . url('') . '/admin/sertifikasi/label_standart/input/2837"><img border="0" src="' . asset('assets/img/paper-bag--pencil.png') . '"></a>',
                'no_dokumen' => 'PdnKD.P.3509120.0355.0155.0000.00.000',
                'no_lot' => '99/25',
                'no_asal' => 'S.0000.00.000',
                'no_lab' => 'S.1666.5.24',
                'nama_kelas_benih' => 'BP',
                'berat_kelompok_benih' => '2500',
            ],
            (object) [
                'no' => 2,
                'input' => '<a href="' . url('') . '/admin/sertifikasi/label_standart/input/2894"><img border="0" src="' . asset('assets/img/paper-bag--pencil.png') . '"></a>',
                'no_dokumen' => 'PdnQI.P.3511040.0410.0010.0000.00.001',
                'no_lot' => '05/53',
                'no_asal' => 'S.0000.00.001',
                'no_lab' => 'S.1658.5.24',
                'nama_kelas_benih' => 'BP',
                'berat_kelompok_benih' => '6000',
            ],
            (object) [
                'no' => 3,
                'input' => '<a href="' . url('') . '/admin/sertifikasi/label_standart/input/18443"><img border="0" src="' . asset('assets/img/paper-bag--pencil.png') . '"></a>',
                'no_dokumen' => 'PdnQI.P.3509160.0355.0334.0000.25.523',
                'no_lot' => '78/25',
                'no_asal' => 'S.0000.25.523',
                'no_lab' => 'S.0000.5.26',
                'nama_kelas_benih' => 'BP',
                'berat_kelompok_benih' => '4650',
            ],
        ];

        $draw = $request->get('draw', 1);
        $start = $request->get('start', 0);
        $length = $request->get('length', 10);
        $search = $request->get('search', ['value' => '']);

        $total = count($data);

        if (!empty($search['value'])) {
            $data = array_filter($data, function($item) use ($search) {
                $term = strtolower($search['value']);
                return strpos(strtolower($item->no_dokumen), $term) !== false ||
                       strpos(strtolower($item->no_lot), $term) !== false ||
                       strpos(strtolower($item->no_asal), $term) !== false ||
                       strpos(strtolower($item->no_lab), $term) !== false ||
                       strpos(strtolower($item->nama_kelas_benih), $term) !== false;
            });
        }

        $filtered = count($data);
        $data = array_slice($data, $start, $length);

        $rows = [];
        foreach ($data as $item) {
            $rows[] = [
                'id' => $item->no,
                'cell' => [
                    $item->no,
                    $item->input,
                    $item->no_dokumen,
                    $item->no_lot,
                    $item->no_asal,
                    $item->no_lab,
                    $item->nama_kelas_benih,
                    $item->berat_kelompok_benih,
                ]
            ];
        }

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'page' => ceil($start / $length) + 1,
            'total' => ceil($filtered / $length),
            'rows' => $rows,
        ]);
    }
}
