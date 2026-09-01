<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komoditas;
use App\Models\Golongan;
use App\Models\JenisTanaman;

class MasterController extends Controller
{
    /**
     * Display the Master Golongan (Komoditas) index page.
     */
    public function komoditasIndex(Request $request)
    {
        $query = Komoditas::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_komoditas', 'like', "%{$search}%")
                    ->orWhere('nama_komoditas', 'like', "%{$search}%");
            });
        }

        $data = $query->orderBy('kode_komoditas')->paginate(10);
        $data->appends($request->all());

        return view('master.komoditas.index', compact('data'));
    }

    /**
     * Return JSON data for DataTables AJAX.
     */
    public function komoditasGrid(Request $request)
    {
        $draw = $request->input('draw', 1);
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $search = $request->input('search.value', '');
        $sortColumn = $request->input('order.0.column', 0);
        $sortDir = $request->input('order.0.dir', 'asc');

        // Map column index to database column
        $columns = ['id', 'kode_komoditas', 'nama_komoditas', 'status_komoditas'];
        $sortColumnName = $columns[$sortColumn] ?? 'kode_komoditas';

        $query = Komoditas::query();

        // Apply search filter
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_komoditas', 'like', "%{$search}%")
                    ->orWhere('nama_komoditas', 'like', "%{$search}%");
            });
        }

        // Get total counts
        $totalRecords = Komoditas::count();
        $filteredRecords = $query->count();

        // Apply sorting and pagination
        $data = $query->orderBy($sortColumnName, $sortDir)
            ->offset($start)
            ->limit($length)
            ->get();

        // Format data for DataTables
        $formattedData = [];
        foreach ($data as $row) {
            $formattedData[] = [
                'id' => $row->id,
                'kode_komoditas' => $row->kode_komoditas,
                'nama_komoditas' => $row->nama_komoditas,
                'status_komoditas' => $row->status_komoditas,
                'status_label' => $row->status_label,
                'status_badge' => $row->status_badge,
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
     * Show form to create new Komoditas.
     */
    public function komoditasCreate()
    {
        return view('master.komoditas.create');
    }

    /**
     * Store new Komoditas data.
     */
    public function komoditasStore(Request $request)
    {
        // Debug: Log the request data
        \Log::info('komoditasStore called', $request->all());

        $request->validate([
            'kode_komoditas' => 'required|string|max:5|unique:komoditas,kode_komoditas',
            'nama_komoditas' => 'required|string|max:255',
            'status_komoditas' => 'required|in:0,1',
        ], [
            'kode_komoditas.required' => 'Kode Golongan wajib diisi.',
            'kode_komoditas.max' => 'Kode Golongan maksimal 5 karakter.',
            'kode_komoditas.unique' => 'Kode Golongan sudah terdaftar.',
            'nama_komoditas.required' => 'Nama Golongan wajib diisi.',
            'status_komoditas.required' => 'Status wajib dipilih.',
        ]);

        Komoditas::create([
            'kode_komoditas' => $request->kode_komoditas,
            'nama_komoditas' => $request->nama_komoditas,
            'status_komoditas' => $request->status_komoditas,
        ]);

        return redirect()->route('master.komoditas.index')
            ->with('success', 'Data Golongan berhasil ditambahkan.');
    }

    /**
     * Show edit form for Komoditas.
     */
    public function komoditasEdit($id)
    {
        $komoditas = Komoditas::findOrFail($id);
        return view('master.komoditas.edit', compact('komoditas'));
    }

    /**
     * Update Komoditas data.
     */
    public function komoditasUpdate(Request $request, $id)
    {
        $komoditas = Komoditas::findOrFail($id);

        $request->validate([
            'kode_komoditas' => 'required|string|max:5|unique:komoditas,kode_komoditas,' . $id,
            'nama_komoditas' => 'required|string|max:255',
            'status_komoditas' => 'required|in:0,1',
        ], [
            'kode_komoditas.required' => 'Kode Golongan wajib diisi.',
            'kode_komoditas.max' => 'Kode Golongan maksimal 5 karakter.',
            'kode_komoditas.unique' => 'Kode Golongan sudah terdaftar.',
            'nama_komoditas.required' => 'Nama Golongan wajib diisi.',
            'status_komoditas.required' => 'Status wajib dipilih.',
        ]);

        $komoditas->update([
            'kode_komoditas' => $request->kode_komoditas,
            'nama_komoditas' => $request->nama_komoditas,
            'status_komoditas' => $request->status_komoditas,
        ]);

        return redirect()->route('master.komoditas.index')
            ->with('success', 'Data Golongan berhasil diperbarui.');
    }

    /**
     * Delete selected Komoditas entries.
     */
    public function komoditasDestroy(Request $request)
    {
        $ids = $request->input('items', []);
        if (!empty($ids)) {
            Komoditas::whereIn('id', $ids)->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Golongan berhasil dihapus.'
        ]);
    }

    /**
     * Delete single Komoditas.
     */
    public function komoditasDelete($id)
    {
        $komoditas = Komoditas::findOrFail($id);
        $komoditas->delete();

        return redirect()->route('master.komoditas.index')
            ->with('success', 'Data Golongan berhasil dihapus.');
    }

    /* =====================================================================
     *  MASTER KUMPULAN (GOLONGAN)
     *
     *  Fitur ini mengikuti sistem sumber atur_gangan pada sistem lama.
     *  - Daftar data dengan pencarian, sorting, pagination (DataTables server-side).
     *  - Tambah data Kumpulan.
     *  - Edit data Kumpulan.
     *  - Hapus satu / banyak (bulk delete) data Kumpulan.
     *  - Relasi ke Master Golongan (Komoditas) sebagai parent.
     * ===================================================================== */

    /**
     * Halaman index Master Kumpulan.
     */
    public function kumpulanIndex(Request $request)
    {
        $query = Golongan::query()->with('komoditas');

        // Filter pencarian sederhana (opsional, juga difilter oleh DataTables server-side)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_golongan', 'like', "%{$search}%")
                    ->orWhere('nama_golongan', 'like', "%{$search}%")
                    ->orWhere('jenis_golongan', 'like', "%{$search}%");
            });
        }

        $data = $query->orderBy('kode_golongan')->paginate(10);
        $data->appends($request->all());

        return view('master.kumpulan.index', compact('data'));
    }

    /**
     * Endpoint JSON untuk DataTables server-side (AJAX grid).
     */
    public function kumpulanGrid(Request $request)
    {
        $draw = $request->input('draw', 1);
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $search = $request->input('search.value', '');
        $sortColumnIndex = $request->input('order.0.column', 0);
        $sortDir = $request->input('order.0.dir', 'asc');

        // Pemetaan index kolom ke field DB / accessor
        $columns = [
            'id',
            'kode_golongan',
            'nama_golongan',
            'komoditas_id',
            'jenis_golongan',
            'status_golongan',
        ];
        $sortColumnName = $columns[$sortColumnIndex] ?? 'kode_golongan';

        $query = Golongan::query()->with('komoditas');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_golongan', 'like', "%{$search}%")
                    ->orWhere('nama_golongan', 'like', "%{$search}%")
                    ->orWhere('jenis_golongan', 'like', "%{$search}%")
                    ->orWhereHas('komoditas', function ($qq) use ($search) {
                        $qq->where('nama_komoditas', 'like', "%{$search}%");
                    });
            });
        }

        $totalRecords = Golongan::count();
        $filteredRecords = $query->count();

        $data = $query->orderBy($sortColumnName, $sortDir)
            ->offset($start)
            ->limit($length)
            ->get();

        $formattedData = [];
        foreach ($data as $row) {
            $formattedData[] = [
                'id' => $row->id,
                'kode_golongan' => $row->kode_golongan,
                'nama_golongan' => $row->nama_golongan,
                'komoditas_id' => $row->komoditas_id,
                'nama_komoditas' => $row->komoditas ? $row->komoditas->nama_komoditas : '-',
                'jenis_golongan' => $row->jenis_golongan,
                'jenis_label' => $row->jenis_label,
                'jenis_badge' => $row->jenis_badge,
                'status_golongan' => $row->status_golongan,
                'status_label' => $row->status_label,
                'status_badge' => $row->status_badge,
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
     * Form tambah Master Kumpulan.
     */
    public function kumpulanCreate()
    {
        $komoditasList = Komoditas::orderBy('kode_komoditas')->get();
        return view('master.kumpulan.create', compact('komoditasList'));
    }

    /**
     * Simpan data Kumpulan baru.
     */
    public function kumpulanStore(Request $request)
    {
        $request->validate([
            'kode_golongan' => 'required|string|max:5|unique:golongan,kode_golongan',
            'nama_golongan' => 'required|string|max:255',
            'komoditas_id' => 'nullable|exists:komoditas,id',
            'jenis_golongan' => 'required|in:B,S,P,L',
            'status_golongan' => 'required|in:0,1',
        ], [
            'kode_golongan.required' => 'Kode Kumpulan wajib diisi.',
            'kode_golongan.max' => 'Kode Kumpulan maksimal 5 karakter.',
            'kode_golongan.unique' => 'Kode Kumpulan sudah terdaftar.',
            'nama_golongan.required' => 'Nama Kumpulan wajib diisi.',
            'jenis_golongan.required' => 'Jenis Golongan wajib dipilih.',
            'jenis_golongan.in' => 'Jenis Golongan tidak valid.',
            'status_golongan.required' => 'Status wajib dipilih.',
        ]);

        Golongan::create([
            'kode_golongan' => $request->kode_golongan,
            'nama_golongan' => $request->nama_golongan,
            'komoditas_id' => $request->komoditas_id ?: null,
            'jenis_golongan' => $request->jenis_golongan,
            'status_golongan' => $request->status_golongan,
        ]);

        return redirect()->route('master.kumpulan.index')
            ->with('success', 'Data Kumpulan berhasil ditambahkan.');
    }

    /**
     * Form edit Master Kumpulan.
     */
    public function kumpulanEdit($id)
    {
        $kumpulan = Golongan::findOrFail($id);
        $komoditasList = Komoditas::orderBy('kode_komoditas')->get();
        return view('master.kumpulan.edit', compact('kumpulan', 'komoditasList'));
    }

    /**
     * Update data Kumpulan.
     */
    public function kumpulanUpdate(Request $request, $id)
    {
        $kumpulan = Golongan::findOrFail($id);

        $request->validate([
            'kode_golongan' => 'required|string|max:5|unique:golongan,kode_golongan,' . $id,
            'nama_golongan' => 'required|string|max:255',
            'komoditas_id' => 'nullable|exists:komoditas,id',
            'jenis_golongan' => 'required|in:B,S,P,L',
            'status_golongan' => 'required|in:0,1',
        ], [
            'kode_golongan.required' => 'Kode Kumpulan wajib diisi.',
            'kode_golongan.max' => 'Kode Kumpulan maksimal 5 karakter.',
            'kode_golongan.unique' => 'Kode Kumpulan sudah terdaftar.',
            'nama_golongan.required' => 'Nama Kumpulan wajib diisi.',
            'jenis_golongan.required' => 'Jenis Golongan wajib dipilih.',
            'jenis_golongan.in' => 'Jenis Golongan tidak valid.',
            'status_golongan.required' => 'Status wajib dipilih.',
        ]);

        $kumpulan->update([
            'kode_golongan' => $request->kode_golongan,
            'nama_golongan' => $request->nama_golongan,
            'komoditas_id' => $request->komoditas_id ?: null,
            'jenis_golongan' => $request->jenis_golongan,
            'status_golongan' => $request->status_golongan,
        ]);

        return redirect()->route('master.kumpulan.index')
            ->with('success', 'Data Kumpulan berhasil diperbarui.');
    }

    /**
     * Hapus banyak data Kunan (bulk delete dari checkbox).
     */
    public function kumpulanDestroy(Request $request)
    {
        $ids = $request->input('items', []);

        if (empty($ids) || !is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data yang dipilih untuk dihapus.',
            ], 422);
        }

        // Pastikan semua ID adalah numeric untuk mencegah injection
        $ids = array_filter($ids, fn ($v) => is_numeric($v));

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'ID data tidak valid.',
            ], 422);
        }

        $deleted = Golongan::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => $deleted . ' data Kumpulan berhasil dihapus.',
            'deleted' => $deleted,
        ]);
    }

    /**
     * Hapus satu data Kumpulan.
     */
    public function kumpulanDelete($id)
    {
        $kumpulan = Golongan::findOrFail($id);
        $kumpulan->delete();

        return redirect()->route('master.kumpulan.index')
            ->with('success', 'Data Kumpulan berhasil dihapus.');
    }

    /* =====================================================================
     *  MASTER JENIS TANAMAN
     *
     *  Fitur ini mengikuti sistem sumber atur_jenis_tanaman pada sistem lama.
     *  - Daftar data dengan pencarian, sorting, pagination (DataTables server-side).
     *  - Tambah data Jenis Tanaman.
     *  - Edit data Jenis Tanaman.
     *  - Hapus satu / banyak (bulk delete) data Jenis Tanaman.
     *  - Relasi ke Master Golongan (Komoditas) sebagai parent.
     * ===================================================================== */

    /**
     * Halaman index Master Jenis Tanaman.
     */
    public function jenisTanamanIndex(Request $request)
    {
        $query = JenisTanaman::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_tanaman', 'like', "%{$search}%")
                    ->orWhere('nama_tanaman', 'like', "%{$search}%")
                    ->orWhere('klasifikasi', 'like', "%{$search}%")
                    ->orWhere('nama_perbanyakan', 'like', "%{$search}%");
            });
        }

        $data = $query->orderBy('kode_tanaman')->paginate(10);
        $data->appends($request->all());

        return view('master.jenis-tanaman.index', compact('data'));
    }

    /**
     * Endpoint JSON untuk DataTables server-side (AJAX grid).
     */
    public function jenisTanamanGrid(Request $request)
    {
        $draw = $request->input('draw', 1);
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $search = $request->input('search.value', '');
        $sortColumnIndex = $request->input('order.0.column', 0);
        $sortDir = $request->input('order.0.dir', 'asc');

        // Pemetaan index kolom ke field DB / accessor
        $columns = [
            'id',
            'kode_tanaman',
            'nama_tanaman',
            'klasifikasi',
            'nama_perbanyakan',
            'satuan_penangkaran',
            'satuan_produk',
            'nama_satuan',
            'populasi_pemeriksaan',
            'populasi_pemeriksaan_jantan',
            'populasi_pemeriksaan_betina',
            'status',
        ];
        $sortColumnName = $columns[$sortColumnIndex] ?? 'kode_tanaman';

        $query = JenisTanaman::query();

        // Apply search filter
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_tanaman', 'like', "%{$search}%")
                    ->orWhere('nama_tanaman', 'like', "%{$search}%")
                    ->orWhere('klasifikasi', 'like', "%{$search}%")
                    ->orWhere('nama_perbanyakan', 'like', "%{$search}%")
                    ->orWhere('satuan_penangkaran', 'like', "%{$search}%")
                    ->orWhere('satuan_produk', 'like', "%{$search}%")
                    ->orWhere('nama_satuan', 'like', "%{$search}%");
            });
        }

        // Get total counts
        $totalRecords = JenisTanaman::count();
        $filteredRecords = $query->count();

        // Apply sorting and pagination
        $data = $query->orderBy($sortColumnName, $sortDir)
            ->offset($start)
            ->limit($length)
            ->get();

        // Format data for DataTables
        $formattedData = [];
        foreach ($data as $row) {
            $formattedData[] = [
                'id' => $row->id,
                'kode_tanaman' => $row->kode_tanaman,
                'nama_tanaman' => $row->nama_tanaman,
                'klasifikasi' => $row->klasifikasi,
                'klasifikasi_label' => $row->klasifikasi_label,
                'klasifikasi_badge' => $row->klasifikasi_badge,
                'nama_perbanyakan' => $row->nama_perbanyakan,
                'satuan_penangkaran' => $row->satuan_penangkaran,
                'satuan_produk' => $row->satuan_produk,
                'nama_satuan' => $row->nama_satuan,
                'populasi_pemeriksaan' => $row->populasi_pemeriksaan,
                'populasi_pemeriksaan_jantan' => $row->populasi_pemeriksaan_jantan,
                'populasi_pemeriksaan_betina' => $row->populasi_pemeriksaan_betina,
                'pendahuluan' => $row->pendahuluan,
                'vegetatif' => $row->vegetatif,
                'vegetatif1' => $row->vegetatif1,
                'vegetatif2' => $row->vegetatif2,
                'vegetatif3' => $row->vegetatif3,
                'vegetatif_ulangan' => $row->vegetatif_ulangan,
                'berbunga1' => $row->berbunga1,
                'berbunga2' => $row->berbunga2,
                'berbunga3' => $row->berbunga3,
                'berbunga_ulangan' => $row->berbunga_ulangan,
                'masak' => $row->masak,
                'masak_ulangan' => $row->masak_ulangan,
                'panen' => $row->panen,
                'pengolahan' => $row->pengolahan,
                'siap_siar' => $row->siap_siar,
                'pengambilan_contoh' => $row->pengambilan_contoh,
                'pengiriman_contoh' => $row->pengiriman_contoh,
                'kaji_ulang' => $row->kaji_ulang,
                'uji_kadar_air' => $row->uji_kadar_air,
                'uji_kemurnian' => $row->uji_kemurnian,
                'uji_cvl' => $row->uji_cvl,
                'uji_warna_lain' => $row->uji_warna_lain,
                'penilaian' => $row->penilaian,
                'seri_label' => $row->seri_label,
                'status' => $row->status,
                'status_label' => $row->status_label,
                'status_badge' => $row->status_badge,
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
     * Form tambah Master Jenis Tanaman.
     */
    public function jenisTanamanCreate()
    {
        return view('master.jenis-tanaman.create');
    }

    /**
     * Simpan data Jenis Tanaman baru.
     */
    public function jenisTanamanStore(Request $request)
    {
        $request->validate([
            'kode_tanaman' => 'required|string|max:10|unique:jenis_tanaman,kode_tanaman',
            'nama_tanaman' => 'required|string|max:255',
            'klasifikasi' => 'nullable|in:Hibrida,Non Hibrida',
            'nama_perbanyakan' => 'nullable|string|max:255',
            'satuan_penangkaran' => 'nullable|string|max:50',
            'satuan_produk' => 'nullable|string|max:50',
            'nama_satuan' => 'nullable|string|max:50',
            'populasi_pemeriksaan' => 'nullable|integer|min:0',
            'populasi_pemeriksaan_jantan' => 'nullable|integer|min:0',
            'populasi_pemeriksaan_betina' => 'nullable|integer|min:0',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ], [
            'kode_tanaman.required' => 'Kode Tanaman wajib diisi.',
            'kode_tanaman.max' => 'Kode Tanaman maksimal 10 karakter.',
            'kode_tanaman.unique' => 'Kode Tanaman sudah terdaftar.',
            'nama_tanaman.required' => 'Nama Tanaman wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        JenisTanaman::create($request->all());

        return redirect()->route('master.jenis-tanaman.index')
            ->with('success', 'Data Jenis Tanaman berhasil ditambahkan.');
    }

    /**
     * Form edit Master Jenis Tanaman.
     */
    public function jenisTanamanEdit($id)
    {
        $jenisTanaman = JenisTanaman::findOrFail($id);
        return view('master.jenis-tanaman.edit', compact('jenisTanaman'));
    }

    /**
     * Update data Jenis Tanaman.
     */
    public function jenisTanamanUpdate(Request $request, $id)
    {
        $jenisTanaman = JenisTanaman::findOrFail($id);

        $request->validate([
            'kode_tanaman' => 'required|string|max:10|unique:jenis_tanaman,kode_tanaman,' . $id,
            'nama_tanaman' => 'required|string|max:255',
            'klasifikasi' => 'nullable|in:Hibrida,Non Hibrida',
            'nama_perbanyakan' => 'nullable|string|max:255',
            'satuan_penangkaran' => 'nullable|string|max:50',
            'satuan_produk' => 'nullable|string|max:50',
            'nama_satuan' => 'nullable|string|max:50',
            'populasi_pemeriksaan' => 'nullable|integer|min:0',
            'populasi_pemeriksaan_jantan' => 'nullable|integer|min:0',
            'populasi_pemeriksaan_betina' => 'nullable|integer|min:0',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ], [
            'kode_tanaman.required' => 'Kode Tanaman wajib diisi.',
            'kode_tanaman.max' => 'Kode Tanaman maksimal 10 karakter.',
            'kode_tanaman.unique' => 'Kode Tanaman sudah terdaftar.',
            'nama_tanaman.required' => 'Nama Tanaman wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        $jenisTanaman->update($request->all());

        return redirect()->route('master.jenis-tanaman.index')
            ->with('success', 'Data Jenis Tanaman berhasil diperbarui.');
    }

    /**
     * Hapus banyak data Jenis Tanaman (bulk delete dari checkbox).
     */
    public function jenisTanamanDestroy(Request $request)
    {
        $ids = $request->input('items', []);

        if (empty($ids) || !is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data yang dipilih untuk dihapus.',
            ], 422);
        }

        // Pastikan semua ID adalah numeric untuk mencegah injection
        $ids = array_filter($ids, fn ($v) => is_numeric($v));

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'ID data tidak valid.',
            ], 422);
        }

        $deleted = JenisTanaman::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => $deleted . ' data Jenis Tanaman berhasil dihapus.',
            'deleted' => $deleted,
        ]);
    }

    /**
     * Hapus satu data Jenis Tanaman.
     */
    public function jenisTanamanDelete($id)
    {
        $jenisTanaman = JenisTanaman::findOrFail($id);
        $jenisTanaman->delete();

        return redirect()->route('master.jenis-tanaman.index')
            ->with('success', 'Data Jenis Tanaman berhasil dihapus.');
    }
}
