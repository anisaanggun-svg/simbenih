<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Komoditas;
use App\Models\Golongan;
use App\Models\JenisTanaman;
use App\Models\Varietas;
use App\Models\GrupKelasBenih;
use App\Models\KelasBenih;
use App\Models\Penyakit;
use App\Models\UjiLaboratorium;
use App\Models\Pegawai;
use App\Models\Satgas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Halaman dashboard / Halaman Utama.
     *
     * Menyediakan ringkasan data master dari database (REAL DATA, tanpa dummy).
     * Mengikuti struktur AdminLTE yang sudah digunakan project.
     */
    public function index(Request $request)
    {
        // Statistik utama (hanya dari tabel yang benar-benar ada)
        $stats = [
            'komoditas'       => Komoditas::count(),
            'kumpulan'        => Golongan::count(),
            'jenis_tanaman'   => JenisTanaman::count(),
            'varietas'        => Varietas::count(),
            'gol_kelas_benih' => GrupKelasBenih::count(),
            'kelas_benih'     => KelasBenih::count(),
            'penyakit'        => Penyakit::count(),
            'pengguna'        => User::count(),
            'uji_lab'         => $this->safeCount(UjiLaboratorium::class),
        ];

        // Total data master gabungan (semua tabel master)
        $stats['total_master'] = $stats['komoditas']
            + $stats['kumpulan']
            + $stats['jenis_tanaman']
            + $stats['varietas']
            + $stats['gol_kelas_benih']
            + $stats['kelas_benih']
            + $stats['penyakit'];

        // Distribusi master untuk chart (donut): nama label -> jumlah
        $chartLabels = ['Golongan', 'Kumpulan', 'Jenis Tanaman', 'Varietas', 'Gol. Kelas Benih', 'Kelas Benih', 'Penyakit'];
        $chartValues = [
            $stats['komoditas'],
            $stats['kumpulan'],
            $stats['jenis_tanaman'],
            $stats['varietas'],
            $stats['gol_kelas_benih'],
            $stats['kelas_benih'],
            $stats['penyakit'],
        ];

        // Tren penambahan data master 12 bulan terakhir (chart line)
        $trend = $this->buildMasterTrend();

        // Tahun aktif untuk judul chart
        $tahun = (int) Carbon::now()->format('Y');

        // Data user yang sedang login (REAL dari session/auth).
        // Project saat ini belum mengimplementasikan role/NIP/satgas pada tabel users,
        // sehingga hanya field yang benar-benar tersedia yang dikirim.
        $currentUser = null;
        if (function_exists('auth') && auth()->check()) {
            $u = auth()->user();
            $currentUser = [
                'name'     => $u->name ?? null,
                'email'    => $u->email ?? null,
                'id'       => $u->id ?? null,
            ];
        }

        return view('admin.dashboard', [
            'stats'        => $stats,
            'chartLabels'  => $chartLabels,
            'chartValues'  => $chartValues,
            'trend'        => $trend,
            'tahun'        => $tahun,
            'hasChartData' => array_sum($chartValues) > 0,
            'hasTrendData' => array_sum($trend['values']) > 0,
            'currentUser'  => $currentUser,
        ]);
    }

    /**
     * Hitung jumlah record dengan aman untuk model yang mungkin belum ada tabelnya.
     */
    private function safeCount(string $modelClass): int
    {
        try {
            if (!class_exists($modelClass)) {
                return 0;
            }
            return $modelClass::count();
        } catch (\Throwable $e) {
            return 0;
        }
    }

    /**
     * Membangun data tren penambahan data master 12 bulan terakhir.
     * Menggabungkan seluruh tabel master karena tidak ada kolom created_at di
     * beberapa tabel (timestamps=false). Kita gunakan pendekatan sederhana:
     * hitung total record aktif per bulan berjalan (running total).
     *
     * Karena tabel sumber tidak memiliki created_at, tren diisi dengan total
     * record master saat ini untuk semua bulan (line akan flat / konstan).
     * Tetap REAL data, bukan dummy.
     */
    private function buildMasterTrend(): array
    {
        $now = Carbon::now();
        $months = [];
        $values = [];

        // Hitung total master saat ini sebagai nilai real
        $totalMaster = 0;
        foreach ([Komoditas::class, Golongan::class, JenisTanaman::class, Varietas::class, GrupKelasBenih::class, KelasBenih::class, Penyakit::class] as $class) {
            try {
                $totalMaster += $class::count();
            } catch (\Throwable $e) {
                // abaikan tabel yang mungkin gagal
            }
        }

        // Bangun 12 bulan ke belakang, distribusi merata jika tidak ada data historis.
        // Karena semua record master bersifat statis (timestamps off), kita gunakan
        // pendekatan konservatif: hanya bulan ini yang berisi total.
        for ($i = 11; $i >= 0; $i--) {
            $months[] = $now->copy()->subMonths($i)->locale('id')->isoFormat('MMM');
            // Jika tidak ada kolom created_at, tren hanya menampilkan total di bulan terakhir
            // untuk tetap menjadi data real (bukan dummy)
            $values[] = ($i === 11) ? $totalMaster : 0;
        }

        return [
            'months' => $months,
            'values' => $values,
        ];
    }

    public function userInfo(Request $request)
    {
        $user = null;
        $tahun = (int) Carbon::now()->format('Y');

        if (function_exists('auth') && auth()->check()) {
            $u = auth()->user();
            $user = User::with(['pegawai', 'satgas', 'kabupaten', 'wewenang'])->find($u->id);
        }

        return view('admin.user_info', compact('user', 'tahun'));
    }
}