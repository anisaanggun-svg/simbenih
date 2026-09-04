<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produsen;
use App\Models\Pegawai;
use App\Models\UjiLaboratorium;
use App\Models\LogLaboratorium;
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
        $lhu = null;

        return view('lab.uji_laboratorium.form', compact('produsen_list', 'pegawai_list', 'pegawai_ttd_list', 'mode', 'lhu'));
    }

    /**
     * Show detail/view of an LHU record.
     */
    public function show($id, $a = null, $b = null, $mode = 'lihat')
    {
        $lhu = UjiLaboratorium::findOrFail($id);

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
        return $this->show($id, null, null, 'edit');
    }

    /**
     * Store new LHU data.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_induk_lapangan' => 'nullable|string|max:100',
            'no_berkas' => 'nullable|string|max:100',
            'nama_produsen' => 'nullable|string|max:150',
            'alamat_produsen' => 'nullable|string|max:65535',
            'no_asal' => 'nullable|string|max:100',
            'no_lab' => 'nullable|string|max:100',
            'jenis_tanaman' => 'nullable|string|max:100',
            'varietas' => 'nullable|string|max:100',
            'kelas_benih' => 'nullable|string|max:50',
            'warna_label' => 'nullable|string|max:50',
            'no_lot' => 'nullable|string|max:50',
            'tgl_panen_awal' => 'nullable|date',
            'tgl_panen_akhir' => 'nullable|date',
            'luas_lulus' => 'nullable|string|max:100',
            'tonase' => 'nullable|string|max:100',
            'tgl_selesai_pengujian' => 'nullable|date',
            'kadar_air' => 'nullable|numeric|min:0|max:100',
            'benih_murni' => 'nullable|numeric|min:0|max:100',
            'kotoran_benih' => 'nullable|numeric|min:0|max:100',
            'btl_gulma' => 'nullable|numeric|min:0|max:100',
            'daya_berkecambah' => 'nullable|integer|min:0|max:100',
            'biji_keras' => 'nullable|integer|min:0|max:100',
            'benih_warna_lain' => 'nullable|string|max:50',
            'no_induk_lhu' => 'nullable|string|max:100',
            'tgl_lhu' => 'nullable|date',
            'petugas_lhu' => 'nullable|integer|exists:pegawai,id',
            'tgl_kadaluarsa' => 'nullable|date',
            'kesimpulan' => 'nullable|in:0,1',
            'keterangan' => 'nullable|string|max:65535',
            'id_pegawai_ttd' => 'nullable|integer|exists:pegawai,id',
        ]);

        // Convert produsen ID to name if needed
        if ($request->filled('nama_produsen') && is_numeric($request->nama_produsen)) {
            $produsen = Produsen::find($request->nama_produsen);
            if ($produsen) {
                $validated['nama_produsen'] = $produsen->nama_produsen ?? $produsen->nama;
                $validated['alamat_produsen'] = $produsen->alamat ?? $validated['alamat_produsen'];
            }
        }

        $lhu = UjiLaboratorium::create($validated);

        return redirect()->route('lab.uji_laboratorium.index')->with('success', 'Data LHU berhasil disimpan.');
    }

    /**
     * Update LHU data.
     */
    public function update(Request $request, $id)
    {
        $lhu = UjiLaboratorium::findOrFail($id);

        $validated = $request->validate([
            'no_induk_lapangan' => 'nullable|string|max:100',
            'no_berkas' => 'nullable|string|max:100',
            'nama_produsen' => 'nullable|string|max:150',
            'alamat_produsen' => 'nullable|string|max:65535',
            'no_asal' => 'nullable|string|max:100',
            'no_lab' => 'nullable|string|max:100',
            'jenis_tanaman' => 'nullable|string|max:100',
            'varietas' => 'nullable|string|max:100',
            'kelas_benih' => 'nullable|string|max:50',
            'warna_label' => 'nullable|string|max:50',
            'no_lot' => 'nullable|string|max:50',
            'tgl_panen_awal' => 'nullable|date',
            'tgl_panen_akhir' => 'nullable|date',
            'luas_lulus' => 'nullable|string|max:100',
            'tonase' => 'nullable|string|max:100',
            'tgl_selesai_pengujian' => 'nullable|date',
            'kadar_air' => 'nullable|numeric|min:0|max:100',
            'benih_murni' => 'nullable|numeric|min:0|max:100',
            'kotoran_benih' => 'nullable|numeric|min:0|max:100',
            'btl_gulma' => 'nullable|numeric|min:0|max:100',
            'daya_berkecambah' => 'nullable|integer|min:0|max:100',
            'biji_keras' => 'nullable|integer|min:0|max:100',
            'benih_warna_lain' => 'nullable|string|max:50',
            'no_induk_lhu' => 'nullable|string|max:100',
            'tgl_lhu' => 'nullable|date',
            'petugas_lhu' => 'nullable|integer|exists:pegawai,id',
            'tgl_kadaluarsa' => 'nullable|date',
            'kesimpulan' => 'nullable|in:0,1',
            'keterangan' => 'nullable|string|max:65535',
            'id_pegawai_ttd' => 'nullable|integer|exists:pegawai,id',
        ]);

        // Convert produsen ID to name if needed
        if ($request->filled('nama_produsen') && is_numeric($request->nama_produsen)) {
            $produsen = Produsen::find($request->nama_produsen);
            if ($produsen) {
                $validated['nama_produsen'] = $produsen->nama_produsen ?? $produsen->nama;
                $validated['alamat_produsen'] = $produsen->alamat ?? $validated['alamat_produsen'];
            }
        }

        $lhu->update($validated);

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

    /**
     * Display the Laboratorium Log page.
     */
    public function logIndex(Request $request)
    {
        $query = LogLaboratorium::query();

        // Filter by date range if provided
        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('logdate', [$request->tgl_awal . ' 00:00:00', $request->tgl_akhir . ' 23:59:59']);
        }

        // Filter by search keyword
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('log', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $data = $query->orderBy('logdate', 'desc')->paginate(20);
        $data->appends($request->all());

        return view('lab.log.index', compact('data'));
    }

    /**
     * Return JSON data for DataTables AJAX.
     */
    public function logGrid(Request $request)
    {
        $draw = $request->input('draw', 1);
        $start = $request->input('start', 0);
        $length = $request->input('length', 20);
        $search = $request->input('search.value', '');
        $sortColumn = $request->input('order.0.column', 0);
        $sortDir = $request->input('order.0.dir', 'desc');

        // Map column index to database column
        $columns = ['id', 'nama', 'log', 'logdate', 'username'];
        $sortColumnName = $columns[$sortColumn] ?? 'logdate';

        $query = LogLaboratorium::query();

        // Apply search filter
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('log', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }

        // Apply date range filter
        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('logdate', [$request->tgl_awal . ' 00:00:00', $request->tgl_akhir . ' 23:59:59']);
        }

        // Get total counts
        $totalRecords = LogLaboratorium::count();
        $filteredRecords = $query->count();

        // Apply sorting and pagination
        $data = $query->orderBy($sortColumnName, $sortDir)
            ->offset($start)
            ->limit($length)
            ->get();

        // Format data for DataTables
        $formattedData = [];
        foreach ($data as $index => $row) {
            $formattedData[] = [
                'no' => $start + $index + 1,
                'nama' => $row->nama,
                'log' => $row->log,
                'logdate' => $row->logdate ? \Carbon\Carbon::parse($row->logdate)->format('d-m-Y / H:i:s') : '-',
                'username' => $row->username,
            ];
        }

        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $formattedData,
        ]);
    }

    /**
     * Show the download Excel form.
     */
    public function logDownloadExcel()
    {
        return view('lab.log.download_excel');
    }

    /**
     * Export log data to Excel.
     */
    public function logExportExcel(Request $request)
    {
        $request->validate([
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
        ], [
            'tgl_awal.required' => 'Tanggal awal wajib diisi.',
            'tgl_akhir.required' => 'Tanggal akhir wajib diisi.',
        ]);

        $data = LogLaboratorium::whereBetween('logdate', [$request->tgl_awal . ' 00:00:00', $request->tgl_akhir . ' 23:59:59'])
            ->orderBy('logdate', 'desc')
            ->get();

        // Generate CSV content
        $filename = 'laboratorium-log-' . $request->tgl_awal . '-' . $request->tgl_akhir . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            // Header row
            fputcsv($file, ['No', 'Nama Pengguna', 'Aksi', 'Tanggal', 'Username']);

            foreach ($data as $index => $row) {
                fputcsv($file, [
                    $index + 1,
                    $row->nama,
                    $row->log,
                    $row->logdate ? \Carbon\Carbon::parse($row->logdate)->format('d-m-Y / H:i:s') : '-',
                    $row->username,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Delete selected log entries.
     */
    public function logDestroy(Request $request)
    {
        $ids = $request->input('items', []);
        if (!empty($ids)) {
            LogLaboratorium::whereIn('id', $ids)->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Log berhasil dihapus.'
        ]);
    }
}
