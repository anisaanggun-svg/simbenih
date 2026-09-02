<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komoditas;
use App\Models\Golongan;
use App\Models\GrupKelasBenih;
use App\Models\JenisTanaman;
use App\Models\Varietas;
use App\Models\KelasBenih;

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

    /* =====================================================================
     *  MASTER VARIETAS
     *
     *  Fitur ini mengikuti sistem sumber atur_varietas pada sistem lama.
     *  - Daftar data dengan pencarian, sorting, pagination (DataTables server-side).
     *  - Tambah data Varietas.
     *  - Edit data Varietas.
     *  - Hapus satu / banyak (bulk delete) data Varietas.
     *  - Relasi ke Master Jenis Tanaman sebagai parent.
     * ===================================================================== */

    /**
     * Halaman index Master Varietas.
     */
    public function varietasIndex(Request $request)
    {
        $query = Varietas::query()->with('jenisTanaman');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_varietas', 'like', "%{$search}%")
                    ->orWhere('nama_varietas', 'like', "%{$search}%")
                    ->orWhereHas('jenisTanaman', function ($qq) use ($search) {
                        $qq->where('nama_tanaman', 'like', "%{$search}%");
                    });
            });
        }

        $data = $query->orderBy('kode_varietas')->paginate(10);
        $data->appends($request->all());

        return view('master.varietas.index', compact('data'));
    }

    /**
     * Endpoint JSON untuk DataTables server-side (AJAX grid).
     */
    public function varietasGrid(Request $request)
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
            'kode_varietas',
            'nama_varietas',
            'jenis_tanaman_id',
            'nama_tanaman',
            'status_varietas',
        ];
        $sortColumnName = $columns[$sortColumnIndex] ?? 'kode_varietas';

        $query = Varietas::query()->with('jenisTanaman');

        // Apply search filter
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_varietas', 'like', "%{$search}%")
                    ->orWhere('nama_varietas', 'like', "%{$search}%")
                    ->orWhereHas('jenisTanaman', function ($qq) use ($search) {
                        $qq->where('nama_tanaman', 'like', "%{$search}%");
                    });
            });
        }

        // Get total counts
        $totalRecords = Varietas::count();
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
                'kode_varietas' => $row->kode_varietas,
                'nama_varietas' => $row->nama_varietas,
                'jenis_tanaman_id' => $row->jenis_tanaman_id,
                'nama_tanaman' => $row->jenisTanaman ? $row->jenisTanaman->nama_tanaman : '-',
                'status_varietas' => $row->status_varietas,
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
     * Form tambah Master Varietas.
     */
    public function varietasCreate()
    {
        $jenisTanamanList = JenisTanaman::orderBy('kode_tanaman')->get();
        return view('master.varietas.create', compact('jenisTanamanList'));
    }

    /**
     * Simpan data Varietas baru.
     */
    public function varietasStore(Request $request)
    {
        $request->validate([
            'kode_varietas' => 'required|string|max:20|unique:varietas,kode_varietas',
            'nama_varietas' => 'required|string|max:255',
            'jenis_tanaman_id' => 'nullable|exists:jenis_tanaman,id',
            'status_varietas' => 'required|in:Aktif,Tidak Aktif',
        ], [
            'kode_varietas.required' => 'Kode Varietas wajib diisi.',
            'kode_varietas.max' => 'Kode Varietas maksimal 20 karakter.',
            'kode_varietas.unique' => 'Kode Varietas sudah terdaftar.',
            'nama_varietas.required' => 'Nama Varietas wajib diisi.',
            'status_varietas.required' => 'Status wajib dipilih.',
        ]);

        Varietas::create([
            'kode_varietas' => $request->kode_varietas,
            'nama_varietas' => $request->nama_varietas,
            'jenis_tanaman_id' => $request->jenis_tanaman_id ?: null,
            'status_varietas' => $request->status_varietas,
        ]);

        return redirect()->route('master.varietas.index')
            ->with('success', 'Data Varietas berhasil ditambahkan.');
    }

    /**
     * Form edit Master Varietas.
     */
    public function varietasEdit($id)
    {
        $varietas = Varietas::findOrFail($id);
        $jenisTanamanList = JenisTanaman::orderBy('kode_tanaman')->get();
        return view('master.varietas.edit', compact('varietas', 'jenisTanamanList'));
    }

    /**
     * Update data Varietas.
     */
    public function varietasUpdate(Request $request, $id)
    {
        $varietas = Varietas::findOrFail($id);

        $request->validate([
            'kode_varietas' => 'required|string|max:20|unique:varietas,kode_varietas,' . $id,
            'nama_varietas' => 'required|string|max:255',
            'jenis_tanaman_id' => 'nullable|exists:jenis_tanaman,id',
            'status_varietas' => 'required|in:Aktif,Tidak Aktif',
        ], [
            'kode_varietas.required' => 'Kode Varietas wajib diisi.',
            'kode_varietas.max' => 'Kode Varietas maksimal 20 karakter.',
            'kode_varietas.unique' => 'Kode Varietas sudah terdaftar.',
            'nama_varietas.required' => 'Nama Varietas wajib diisi.',
            'status_varietas.required' => 'Status wajib dipilih.',
        ]);

        $varietas->update([
            'kode_varietas' => $request->kode_varietas,
            'nama_varietas' => $request->nama_varietas,
            'jenis_tanaman_id' => $request->jenis_tanaman_id ?: null,
            'status_varietas' => $request->status_varietas,
        ]);

        return redirect()->route('master.varietas.index')
            ->with('success', 'Data Varietas berhasil diperbarui.');
    }

    /**
     * Hapus banyak data Varietas (bulk delete dari checkbox).
     */
    public function varietasDestroy(Request $request)
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

        $deleted = Varietas::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => $deleted . ' data Varietas berhasil dihapus.',
            'deleted' => $deleted,
        ]);
    }

    /**
     * Hapus satu data Varietas.
     */
    public function varietasDelete($id)
    {
        $varietas = Varietas::findOrFail($id);
        $varietas->delete();

        return redirect()->route('master.varietas.index')
            ->with('success', 'Data Varietas berhasil dihapus.');
    }

    /* =====================================================================
     *  MASTER GOL KELAS BENIH
     *
     *  Fitur ini mengikuti sistem sumber atur_grup_kelas_benih pada sistem lama.
     *  - Daftar data dengan pencarian, sorting, pagination (DataTables server-side).
     *  - Tambah data Gol Kelas Benih.
     *  - Edit data Gol Kelas Benih.
     *  - Hapus satu / banyak (bulk delete) data Gol Kelas Benih.
     * ===================================================================== */

    /**
     * Halaman index Master Gol Kelas Benih.
     */
    public function golKelasBenihIndex(Request $request)
    {
        $query = GrupKelasBenih::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_grup_kelas_benih', 'like', "%{$search}%")
                    ->orWhere('nama_grup_kelas_benih', 'like', "%{$search}%")
                    ->orWhere('digit', 'like', "%{$search}%")
                    ->orWhere('warna_label', 'like', "%{$search}%");
            });
        }

        $data = $query->orderBy('kode_grup_kelas_benih')->paginate(10);
        $data->appends($request->all());

        return view('master.gol-kelas-benih.index', compact('data'));
    }

    /**
     * Endpoint JSON untuk DataTables server-side (AJAX grid).
     */
    public function golKelasBenihGrid(Request $request)
    {
        $draw = $request->input('draw', 1);
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $search = $request->input('search.value', '');
        $sortColumnIndex = $request->input('order.0.column', 0);
        $sortDir = $request->input('order.0.dir', 'asc');

        // Pemetaan index kolom ke field DB
        $columns = [
            'id',
            'kode_grup_kelas_benih',
            'nama_grup_kelas_benih',
            'digit',
            'warna_label',
            'status_grup',
        ];
        $sortColumnName = $columns[$sortColumnIndex] ?? 'kode_grup_kelas_benih';

        $query = GrupKelasBenih::query();

        // Apply search filter
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_grup_kelas_benih', 'like', "%{$search}%")
                    ->orWhere('nama_grup_kelas_benih', 'like', "%{$search}%")
                    ->orWhere('digit', 'like', "%{$search}%")
                    ->orWhere('warna_label', 'like', "%{$search}%");
            });
        }

        // Get total counts
        $totalRecords = GrupKelasBenih::count();
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
                'kode_grup_kelas_benih' => $row->kode_grup_kelas_benih,
                'nama_grup_kelas_benih' => $row->nama_grup_kelas_benih,
                'digit' => $row->digit,
                'warna_label' => $row->warna_label,
                'status_grup' => $row->status_grup,
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
     * Form tambah Master Gol Kelas Benih.
     */
    public function golKelasBenihCreate()
    {
        return view('master.gol-kelas-benih.create');
    }

    /**
     * Simpan data Gol Kelas Benih baru.
     */
    public function golKelasBenihStore(Request $request)
    {
        $request->validate([
            'kode_grup_kelas_benih' => 'required|string|max:10|unique:grup_kelas_benih,kode_grup_kelas_benih',
            'nama_grup_kelas_benih' => 'required|string|max:255',
            'digit' => 'required|string|max:10',
            'warna_label' => 'required|string|max:50',
            'status_grup' => 'required|in:0,1',
        ], [
            'kode_grup_kelas_benih.required' => 'Kode Grup Kelas Benih wajib diisi.',
            'kode_grup_kelas_benih.max' => 'Kode Grup Kelas Benih maksimal 10 karakter.',
            'kode_grup_kelas_benih.unique' => 'Kode Grup Kelas Benih sudah terdaftar.',
            'nama_grup_kelas_benih.required' => 'Nama Grup Kelas Benih wajib diisi.',
            'digit.required' => 'Digit Label wajib diisi.',
            'warna_label.required' => 'Warna Label wajib diisi.',
            'status_grup.required' => 'Status wajib dipilih.',
        ]);

        GrupKelasBenih::create([
            'kode_grup_kelas_benih' => $request->kode_grup_kelas_benih,
            'nama_grup_kelas_benih' => $request->nama_grup_kelas_benih,
            'digit' => $request->digit,
            'warna_label' => $request->warna_label,
            'status_grup' => $request->status_grup,
        ]);

        return redirect()->route('master.gol-kelas-benih.index')
            ->with('success', 'Data Gol Kelas Benih berhasil ditambahkan.');
    }

    /**
     * Form edit Master Gol Kelas Benih.
     */
    public function golKelasBenihEdit($id)
    {
        $golKelasBenih = GrupKelasBenih::findOrFail($id);
        return view('master.gol-kelas-benih.edit', compact('golKelasBenih'));
    }

    /**
     * Update data Gol Kelas Benih.
     */
    public function golKelasBenihUpdate(Request $request, $id)
    {
        $golKelasBenih = GrupKelasBenih::findOrFail($id);

        $request->validate([
            'kode_grup_kelas_benih' => 'required|string|max:10|unique:grup_kelas_benih,kode_grup_kelas_benih,' . $id,
            'nama_grup_kelas_benih' => 'required|string|max:255',
            'digit' => 'required|string|max:10',
            'warna_label' => 'required|string|max:50',
            'status_grup' => 'required|in:0,1',
        ], [
            'kode_grup_kelas_benih.required' => 'Kode Grup Kelas Benih wajib diisi.',
            'kode_grup_kelas_benih.max' => 'Kode Grup Kelas Benih maksimal 10 karakter.',
            'kode_grup_kelas_benih.unique' => 'Kode Grup Kelas Benih sudah terdaftar.',
            'nama_grup_kelas_benih.required' => 'Nama Grup Kelas Benih wajib diisi.',
            'digit.required' => 'Digit Label wajib diisi.',
            'warna_label.required' => 'Warna Label wajib diisi.',
            'status_grup.required' => 'Status wajib dipilih.',
        ]);

        $golKelasBenih->update([
            'kode_grup_kelas_benih' => $request->kode_grup_kelas_benih,
            'nama_grup_kelas_benih' => $request->nama_grup_kelas_benih,
            'digit' => $request->digit,
            'warna_label' => $request->warna_label,
            'status_grup' => $request->status_grup,
        ]);

        return redirect()->route('master.gol-kelas-benih.index')
            ->with('success', 'Data Gol Kelas Benih berhasil diperbarui.');
    }

    /**
     * Hapus banyak data Gol Kelas Benih (bulk delete dari checkbox).
     */
    public function golKelasBenihDestroy(Request $request)
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

        $deleted = GrupKelasBenih::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => $deleted . ' data Gol Kelas Benih berhasil dihapus.',
            'deleted' => $deleted,
        ]);
    }

    /**
     * Hapus satu data Gol Kelas Benih.
     */
    public function golKelasBenihDelete($id)
    {
        $golKelasBenih = GrupKelasBenih::findOrFail($id);
        $golKelasBenih->delete();

        return redirect()->route('master.gol-kelas-benih.index')
            ->with('success', 'Data Gol Kelas Benih berhasil dihapus.');
    }

    /* =====================================================================
     *  MASTER KELAS BENIH
     *
     *  Fitur ini mengikuti sistem sumber atur_kelas_benih pada sistem lama.
     *  - Daftar data dengan pencarian, sorting, pagination (DataTables server-side).
     *  - Tambah data Kelas Benih.
     *  - Edit data Kelas Benih.
     *  - Hapus satu / banyak (bulk delete) data Kelas Benih.
     *  - Relasi ke Master Grup Kelas Benih (Gol Kelas Benih) sebagai parent.
     * ===================================================================== */

    /**
     * Halaman index Master Kelas Benih.
     */
    public function kelasBenihIndex(Request $request)
    {
        $query = KelasBenih::query()->with('grupKelasBenih');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_kb', 'like', "%{$search}%")
                    ->orWhere('nama_kb', 'like', "%{$search}%")
                    ->orWhereHas('grupKelasBenih', function ($qq) use ($search) {
                        $qq->where('nama_grup_kelas_benih', 'like', "%{$search}%");
                    });
            });
        }

        $data = $query->orderBy('kode_kb')->paginate(10);
        $data->appends($request->all());

        return view('master.kelas-benih.index', compact('data'));
    }

    /**
     * Endpoint JSON untuk DataTables server-side (AJAX grid).
     */
    public function kelasBenihGrid(Request $request)
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
            'kode_kb',
            'nama_kb',
            'nama_grup_kelas_benih',
            'status_kelas_benih',
        ];
        $sortColumnName = $columns[$sortColumnIndex] ?? 'kode_kb';

        $query = KelasBenih::query()->with('grupKelasBenih');

        // Apply search filter
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_kb', 'like', "%{$search}%")
                    ->orWhere('nama_kb', 'like', "%{$search}%")
                    ->orWhereHas('grupKelasBenih', function ($qq) use ($search) {
                        $qq->where('nama_grup_kelas_benih', 'like', "%{$search}%");
                    });
            });
        }

        // Get total counts
        $totalRecords = KelasBenih::count();
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
                'kode_kb' => $row->kode_kb,
                'nama_kb' => $row->nama_kb,
                'nama_grup_kelas_benih' => $row->nama_grup_kelas_benih,
                'status_kelas_benih' => $row->status_kelas_benih,
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
     * Form tambah Master Kelas Benih.
     */
    public function kelasBenihCreate()
    {
        $grupKelasBenihList = GrupKelasBenih::orderBy('kode_grup_kelas_benih')->get();
        return view('master.kelas-benih.create', compact('grupKelasBenihList'));
    }

    /**
     * Simpan data Kelas Benih baru.
     */
    public function kelasBenihStore(Request $request)
    {
        $request->validate([
            'kode_kb' => 'required|string|max:5|unique:kelas_benih,kode_kb',
            'nama_kb' => 'required|string|max:255',
            'grup_kelas_benih_id' => 'nullable|exists:grup_kelas_benih,id',
            'status_kelas_benih' => 'required|in:0,1',
        ], [
            'kode_kb.required' => 'Kode Kelas Benih wajib diisi.',
            'kode_kb.max' => 'Kode Kelas Benih maksimal 5 karakter.',
            'kode_kb.unique' => 'Kode Kelas Benih sudah terdaftar.',
            'nama_kb.required' => 'Nama Kelas Benih wajib diisi.',
            'status_kelas_benih.required' => 'Status wajib dipilih.',
        ]);

        KelasBenih::create([
            'kode_kb' => $request->kode_kb,
            'nama_kb' => $request->nama_kb,
            'grup_kelas_benih_id' => $request->grup_kelas_benih_id ?: null,
            'status_kelas_benih' => $request->status_kelas_benih,
        ]);

        return redirect()->route('master.kelas-benih.index')
            ->with('success', 'Data Kelas Benih berhasil ditambahkan.');
    }

    /**
     * Form edit Master Kelas Benih.
     */
    public function kelasBenihEdit($id)
    {
        $kelasBenih = KelasBenih::findOrFail($id);
        $grupKelasBenihList = GrupKelasBenih::orderBy('kode_grup_kelas_benih')->get();
        return view('master.kelas-benih.edit', compact('kelasBenih', 'grupKelasBenihList'));
    }

    /**
     * Update data Kelas Benih.
     */
    public function kelasBenihUpdate(Request $request, $id)
    {
        $kelasBenih = KelasBenih::findOrFail($id);

        $request->validate([
            'kode_kb' => 'required|string|max:5|unique:kelas_benih,kode_kb,' . $id,
            'nama_kb' => 'required|string|max:255',
            'grup_kelas_benih_id' => 'nullable|exists:grup_kelas_benih,id',
            'status_kelas_benih' => 'required|in:0,1',
        ], [
            'kode_kb.required' => 'Kode Kelas Benih wajib diisi.',
            'kode_kb.max' => 'Kode Kelas Benih maksimal 5 karakter.',
            'kode_kb.unique' => 'Kode Kelas Benih sudah terdaftar.',
            'nama_kb.required' => 'Nama Kelas Benih wajib diisi.',
            'status_kelas_benih.required' => 'Status wajib dipilih.',
        ]);

        $kelasBenih->update([
            'kode_kb' => $request->kode_kb,
            'nama_kb' => $request->nama_kb,
            'grup_kelas_benih_id' => $request->grup_kelas_benih_id ?: null,
            'status_kelas_benih' => $request->status_kelas_benih,
        ]);

        return redirect()->route('master.kelas-benih.index')
            ->with('success', 'Data Kelas Benih berhasil diperbarui.');
    }

    /**
     * Hapus banyak data Kelas Benih (bulk delete dari checkbox).
     */
    public function kelasBenihDestroy(Request $request)
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

        $deleted = KelasBenih::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => $deleted . ' data Kelas Benih berhasil dihapus.',
            'deleted' => $deleted,
        ]);
    }

    /**
     * Hapus satu data Kelas Benih.
     */
    public function kelasBenihDelete($id)
    {
        $kelasBenih = KelasBenih::findOrFail($id);
        $kelasBenih->delete();

        return redirect()->route('master.kelas-benih.index')
            ->with('success', 'Data Kelas Benih berhasil dihapus.');
    }
}
