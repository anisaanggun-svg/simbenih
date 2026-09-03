@extends("template.t_admin")
@push("header")
<style>
    /* ===== Dashboard Modern Redesign (AdminLTE 3) ===== */
    :root {
        --dash-primary: #0e7c4a;        /* hijau perbenihan */
        --dash-primary-soft: #e6f5ec;
        --dash-secondary: #2563eb;
        --dash-accent: #f59e0b;
        --dash-text: #1f2937;
        --dash-muted: #6b7280;
        --dash-border: #e5e7eb;
        --dash-card-shadow: 0 1px 2px rgba(16,24,40,.04), 0 1px 3px rgba(16,24,40,.06);
        --dash-card-shadow-hover: 0 4px 12px rgba(16,24,40,.06), 0 2px 6px rgba(16,24,40,.04);
    }

    .dashboard-wrapper {
        font-family: 'Poppins', 'Source Sans Pro', sans-serif;
        color: var(--dash-text);
        margin-top: 1rem;
    }

    /* Welcome / hero */
    .dash-hero {
        background: linear-gradient(135deg, #ffffff 0%, #f7faf9 100%);
        border: 1px solid var(--dash-border);
        border-radius: 14px;
        padding: 24px 28px;
        box-shadow: var(--dash-card-shadow);
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
    }
    .dash-hero .hero-left {
        display: flex;
        align-items: center;
        gap: 20px;
        flex: 1;
        min-width: 280px;
    }
    .dash-hero h1 {
        font-size: 22px;
        font-weight: 600;
        margin: 0 0 4px 0;
        letter-spacing: -.01em;
    }
    .dash-hero p {
        margin: 0;
        color: var(--dash-muted);
        font-size: 14px;
    }
    .dash-hero .hero-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: var(--dash-primary-soft);
        color: var(--dash-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(14, 124, 74, 0.10);
    }
    .dash-hero .hero-text {
        flex: 1;
        min-width: 0;
    }
    .dash-hero .hero-text h1 {
        margin-bottom: 6px;
    }
    .dash-hero .hero-subtitle {
        display: block;
        margin-top: 10px;
        font-size: 15px;
        letter-spacing: .06em;
        text-transform: uppercase;
        font-weight: 700;
        color: var(--dash-primary);
        background: var(--dash-primary-soft);
        padding: 8px 14px;
        border-radius: 8px;
        line-height: 1.4;
        border-left: 4px solid var(--dash-primary);
    }

    /* Stat card modern */
    .stat-card {
        background: #ffffff;
        border: 1px solid var(--dash-border);
        border-radius: 14px;
        padding: 20px;
        box-shadow: var(--dash-card-shadow);
        transition: box-shadow .2s ease, transform .2s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .stat-card:hover {
        box-shadow: var(--dash-card-shadow-hover);
        transform: translateY(-1px);
    }
    .stat-card .stat-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
    }
    .stat-card .stat-label {
        font-size: 13px;
        color: var(--dash-muted);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: .04em;
    }
    .stat-card .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .stat-card .stat-value {
        font-size: 28px;
        font-weight: 600;
        line-height: 1.1;
        color: var(--dash-text);
        margin-bottom: 4px;
    }
    .stat-card .stat-desc {
        font-size: 13px;
        color: var(--dash-muted);
    }
    /* Accent colors (subtle, accent only) */
    .stat-card.theme-primary  .stat-icon { background: var(--dash-primary-soft); color: var(--dash-primary); }
    .stat-card.theme-secondary .stat-icon { background: #e0ecff; color: var(--dash-secondary); }
    .stat-card.theme-accent   .stat-icon { background: #fef3c7; color: var(--dash-accent); }
    .stat-card.theme-info     .stat-icon { background: #e0f2fe; color: #0284c7; }
    .stat-card.theme-success  .stat-icon { background: #dcfce7; color: #16a34a; }
    .stat-card.theme-warning  .stat-icon { background: #fff7ed; color: #ea580c; }
    .stat-card.theme-danger   .stat-icon { background: #fee2e2; color: #dc2626; }
    .stat-card.theme-purple   .stat-icon { background: #ede9fe; color: #7c3aed; }
    .stat-card.theme-dark     .stat-icon { background: #f1f5f9; color: #334155; }

    /* Generic dashboard card */
    .dash-card {
        background: #ffffff;
        border: 1px solid var(--dash-border);
        border-radius: 14px;
        box-shadow: var(--dash-card-shadow);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .dash-card .dash-card-head {
        padding: 16px 20px;
        border-bottom: 1px solid var(--dash-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }
    .dash-card .dash-card-head h3 {
        font-size: 15px;
        font-weight: 600;
        margin: 0;
        color: var(--dash-text);
    }
    .dash-card .dash-card-head .subtitle {
        font-size: 12px;
        color: var(--dash-muted);
    }
    .dash-card .dash-card-body {
        padding: 20px;
        flex: 1;
    }

    /* Quick access */
    .quick-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }
    .quick-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px;
        border: 1px solid var(--dash-border);
        border-radius: 10px;
        background: #fafbfc;
        color: var(--dash-text);
        text-decoration: none;
        transition: background .15s ease, border-color .15s ease, transform .15s ease;
    }
    .quick-item:hover {
        background: var(--dash-primary-soft);
        border-color: #cfe8da;
        color: var(--dash-text);
        text-decoration: none;
        transform: translateY(-1px);
    }
    .quick-item .quick-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: #ffffff;
        border: 1px solid var(--dash-border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--dash-primary);
        flex-shrink: 0;
    }
    .quick-item .quick-title {
        font-weight: 600;
        font-size: 13.5px;
        line-height: 1.2;
    }
    .quick-item .quick-sub {
        font-size: 11.5px;
        color: var(--dash-muted);
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 28px 16px;
        color: var(--dash-muted);
    }
    .empty-state .empty-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: #f3f4f6;
        color: #9ca3af;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 10px;
    }
    .empty-state .empty-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--dash-text);
        margin-bottom: 4px;
    }
    .empty-state .empty-sub {
        font-size: 12.5px;
    }

    /* Feature list (Informasi Umum Sistem) */
    .feature-list { list-style: none; padding: 0; margin: 0; }
    .feature-list li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 11px 0;
        border-bottom: 1px dashed #eef0f3;
        font-size: 13.5px;
        line-height: 1.5;
        color: var(--dash-text);
    }
    .feature-list li:last-child { border-bottom: 0; }
    .feature-list .fli-bullet {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        background: var(--dash-primary-soft);
        color: var(--dash-primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        flex-shrink: 0;
        margin-top: 1px;
    }
    .feature-list .fli-text strong {
        display: block;
        font-size: 13.5px;
        font-weight: 600;
        color: var(--dash-text);
        margin-bottom: 2px;
    }
    .feature-list .fli-text span {
        font-size: 12.5px;
        color: var(--dash-muted);
    }

    /* User profile card */
    .user-card-body { display: flex; gap: 16px; align-items: center; flex-wrap: wrap; }
    .user-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--dash-primary) 0%, #0a5c37 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        font-weight: 600;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(14, 124, 74, 0.18);
    }
    .user-info { flex: 1; min-width: 0; }
    .user-info .user-name {
        font-size: 16px;
        font-weight: 600;
        color: var(--dash-text);
        margin-bottom: 2px;
        line-height: 1.2;
    }
    .user-info .user-email {
        font-size: 12.5px;
        color: var(--dash-muted);
    }
    .user-detail-list {
        list-style: none;
        padding: 0;
        margin: 14px 0 0 0;
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px 16px;
    }
    .user-detail-list li {
        display: flex;
        flex-direction: column;
        padding: 10px 12px;
        background: #fafbfc;
        border: 1px solid var(--dash-border);
        border-radius: 8px;
    }
    .user-detail-list .udl-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .04em;
        color: var(--dash-muted);
        font-weight: 500;
        margin-bottom: 2px;
    }
    .user-detail-list .udl-value {
        font-size: 13px;
        color: var(--dash-text);
        font-weight: 500;
        word-break: break-word;
    }
    .user-detail-list .udl-value.empty {
        color: #9ca3af;
        font-style: italic;
        font-weight: 400;
    }

    @media (max-width: 575.98px) {
        .user-detail-list { grid-template-columns: 1fr; }
    }

    /* Master distribution list */
    .master-list { list-style: none; padding: 0; margin: 0; }
    .master-list li {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px dashed #eef0f3;
        font-size: 13.5px;
    }
    .master-list li:last-child { border-bottom: 0; }
    .master-list .ml-name { color: var(--dash-text); font-weight: 500; }
    .master-list .ml-count {
        background: var(--dash-primary-soft);
        color: var(--dash-primary);
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        padding: 2px 10px;
        min-width: 32px;
        text-align: center;
    }

    /* Chart container */
    .chart-wrap {
        position: relative;
        height: 320px;
    }
    .chart-wrap.tall {
        height: 360px;
    }

    /* Responsive */
    @media (max-width: 575.98px) {
        .dash-hero { padding: 18px; gap: 16px; }
        .dash-hero .hero-left { gap: 14px; min-width: 0; }
        .dash-hero .hero-icon { width: 52px; height: 52px; font-size: 22px; }
        .dash-hero h1 { font-size: 18px; }
        .quick-grid { grid-template-columns: 1fr; }
        .stat-card .stat-value { font-size: 24px; }
        .chart-wrap, .chart-wrap.tall { height: 260px; }
    }
</style>
@endpush

@section("content")
<div class="dashboard-wrapper">

    {{-- ===== Welcome / Hero ===== --}}
    <div class="dash-hero">
        <div class="hero-left">
            <div class="hero-icon"><i class="fas fa-seedling"></i></div>
            <div class="hero-text">
                <h1>Sistem Informasi Perbenihan</h1>
                <div class="hero-subtitle"><strong>UPT PENGAWASAN DAN SERTIFIKASI BENIH TANAMAN PANGAN DAN HORTIKULTURA</strong></div>
            </div>
        </div>
        <div class="text-right">
            <small class="text-muted d-block">Tahun Aktif</small>
            <strong style="font-size:18px;">{{ $tahun }}</strong>
        </div>
    </div>

    {{-- ===== Statistic Cards ===== --}}
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
            <div class="stat-card theme-primary">
                <div class="stat-head">
                    <span class="stat-label">Total Data Master</span>
                    <div class="stat-icon"><i class="fas fa-database"></i></div>
                </div>
                <div class="stat-value">{{ number_format($stats['total_master']) }}</div>
                <div class="stat-desc">Akumulasi seluruh modul master</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
            <div class="stat-card theme-secondary">
                <div class="stat-head">
                    <span class="stat-label">Pengguna Terdaftar</span>
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                </div>
                <div class="stat-value">{{ number_format($stats['pengguna']) }}</div>
                <div class="stat-desc">User aktif sistem perbenihan</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
            <div class="stat-card theme-accent">
                <div class="stat-head">
                    <span class="stat-label">Master Varietas</span>
                    <div class="stat-icon"><i class="fas fa-leaf"></i></div>
                </div>
                <div class="stat-value">{{ number_format($stats['varietas']) }}</div>
                <div class="stat-desc">Varietas tanaman terdaftar</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
            <div class="stat-card theme-danger">
                <div class="stat-head">
                    <span class="stat-label">Master Penyakit</span>
                    <div class="stat-icon"><i class="fas fa-bug"></i></div>
                </div>
                <div class="stat-value">{{ number_format($stats['penyakit']) }}</div>
                <div class="stat-desc">Penyakit & hama tercatat</div>
            </div>
        </div>
    </div>

    {{-- ===== Secondary Stat Strip ===== --}}
    <div class="row">
        <div class="col-lg-3 col-md-6 col-6 mb-3">
            <div class="stat-card theme-info">
                <div class="stat-head">
                    <span class="stat-label">Golongan</span>
                    <div class="stat-icon"><i class="fas fa-tags"></i></div>
                </div>
                <div class="stat-value">{{ number_format($stats['komoditas']) }}</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-3">
            <div class="stat-card theme-success">
                <div class="stat-head">
                    <span class="stat-label">Kumpulan</span>
                    <div class="stat-icon"><i class="fas fa-layer-group"></i></div>
                </div>
                <div class="stat-value">{{ number_format($stats['kumpulan']) }}</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-3">
            <div class="stat-card theme-warning">
                <div class="stat-head">
                    <span class="stat-label">Jenis Tanaman</span>
                    <div class="stat-icon"><i class="fas fa-spa"></i></div>
                </div>
                <div class="stat-value">{{ number_format($stats['jenis_tanaman']) }}</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-3">
            <div class="stat-card theme-purple">
                <div class="stat-head">
                    <span class="stat-label">Kelas Benih</span>
                    <div class="stat-icon"><i class="fas fa-seedling"></i></div>
                </div>
                <div class="stat-value">{{ number_format($stats['kelas_benih']) }}</div>
            </div>
        </div>
    </div>

    {{-- ===== Charts ===== --}}
    <div class="row">
        <div class="col-lg-8 mb-3">
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h3><i class="fas fa-chart-line mr-1 text-success"></i> Grafik Perkembangan Data Master</h3>
                        <div class="subtitle">12 bulan terakhir &middot; Tahun {{ $tahun }}</div>
                    </div>
                    <span class="badge badge-light border" style="font-weight:500;">Line Chart</span>
                </div>
                <div class="dash-card-body">
                    @if($hasTrendData)
                        <div class="chart-wrap tall">
                            <canvas id="trendChart"></canvas>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fas fa-chart-line"></i></div>
                            <div class="empty-title">Belum ada data untuk ditampilkan</div>
                            <div class="empty-sub">Tambahkan data master untuk melihat tren.</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h3><i class="fas fa-chart-pie mr-1 text-success"></i> Chart Data Master</h3>
                        <div class="subtitle">Berdasarkan modul data master</div>
                    </div>
                </div>
                <div class="dash-card-body">
                    @if($hasChartData)
                        <div class="chart-wrap">
                            <canvas id="distChart"></canvas>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fas fa-chart-pie"></i></div>
                            <div class="empty-title">Belum ada data</div>
                            <div class="empty-sub">Data master belum tersedia.</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Quick Access + Master List ===== --}}
    <div class="row">
        <div class="col-lg-7 mb-3">
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h3><i class="fas fa-bolt mr-1 text-warning"></i> Pintasan Menu</h3>
                        <div class="subtitle">Langsung menuju modul yang ingin dibuka</div>
                    </div>
                </div>
                <div class="dash-card-body">
                    <div class="quick-grid">
                        <a href="{{ route('master.penyakit.index') }}" class="quick-item">
                            <div class="quick-icon"><i class="fas fa-bug"></i></div>
                            <div>
                                <div class="quick-title">Master Penyakit</div>
                                <div class="quick-sub">Manajemen data penyakit</div>
                            </div>
                        </a>
                        <a href="{{ route('master.varietas.index') }}" class="quick-item">
                            <div class="quick-icon"><i class="fas fa-leaf"></i></div>
                            <div>
                                <div class="quick-title">Master Varietas</div>
                                <div class="quick-sub">Daftar varietas tanaman</div>
                            </div>
                        </a>
                        <a href="{{ route('master.jenis-tanaman.index') }}" class="quick-item">
                            <div class="quick-icon"><i class="fas fa-spa"></i></div>
                            <div>
                                <div class="quick-title">Master Jenis Tanaman</div>
                                <div class="quick-sub">Kategori jenis tanaman</div>
                            </div>
                        </a>
                        <a href="{{ route('master.komoditas.index') }}" class="quick-item">
                            <div class="quick-icon"><i class="fas fa-tags"></i></div>
                            <div>
                                <div class="quick-title">Master Golongan</div>
                                <div class="quick-sub">Komoditas & golongan</div>
                            </div>
                        </a>
                        <a href="{{ route('master.kumpulan.index') }}" class="quick-item">
                            <div class="quick-icon"><i class="fas fa-layer-group"></i></div>
                            <div>
                                <div class="quick-title">Master Kumpulan</div>
                                <div class="quick-sub">Kumpulan data master</div>
                            </div>
                        </a>
                        <a href="{{ route('master.kelas-benih.index') }}" class="quick-item">
                            <div class="quick-icon"><i class="fas fa-seedling"></i></div>
                            <div>
                                <div class="quick-title">Master Kelas Benih</div>
                                <div class="quick-sub">Kelas benih terdaftar</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 mb-3">
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h3><i class="fas fa-list-ul mr-1 text-info"></i> Rincian Data Master</h3>
                        <div class="subtitle">Jumlah record per modul</div>
                    </div>
                </div>
                <div class="dash-card-body">
                    <ul class="master-list">
                        <li>
                            <span class="ml-name">Master Golongan</span>
                            <span class="ml-count">{{ number_format($stats['komoditas']) }}</span>
                        </li>
                        <li>
                            <span class="ml-name">Master Kumpulan</span>
                            <span class="ml-count">{{ number_format($stats['kumpulan']) }}</span>
                        </li>
                        <li>
                            <span class="ml-name">Master Jenis Tanaman</span>
                            <span class="ml-count">{{ number_format($stats['jenis_tanaman']) }}</span>
                        </li>
                        <li>
                            <span class="ml-name">Master Varietas</span>
                            <span class="ml-count">{{ number_format($stats['varietas']) }}</span>
                        </li>
                        <li>
                            <span class="ml-name">Master Gol. Kelas Benih</span>
                            <span class="ml-count">{{ number_format($stats['gol_kelas_benih']) }}</span>
                        </li>
                        <li>
                            <span class="ml-name">Master Kelas Benih</span>
                            <span class="ml-count">{{ number_format($stats['kelas_benih']) }}</span>
                        </li>
                        <li>
                            <span class="ml-name">Master Penyakit</span>
                            <span class="ml-count">{{ number_format($stats['penyakit']) }}</span>
                        </li>
                        <li>
                            <span class="ml-name">Pengguna</span>
                            <span class="ml-count">{{ number_format($stats['pengguna']) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Informasi Umum Sistem & Informasi Pengguna ===== --}}
    <div class="row">
        <div class="col-lg-7 mb-3">
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h3><i class="fas fa-info-circle mr-1 text-primary"></i> Informasi Umum Sistem Aplikasi</h3>
                        <div class="subtitle">Fungsi utama Sistem Informasi Perbenihan</div>
                    </div>
                </div>
                <div class="dash-card-body">
                    <ul class="feature-list">
                        <li>
                            <span class="fli-bullet"><i class="fas fa-file-signature"></i></span>
                            <div class="fli-text">
                                <strong>Pencatatan &amp; Proses Permohonan Sertifikasi</strong>
                                <span>Sistem membantu mencatat dan memproses data permohonan sertifikasi benih.</span>
                            </div>
                        </li>
                        <li>
                            <span class="fli-bullet"><i class="fas fa-leaf"></i></span>
                            <div class="fli-text">
                                <strong>Pengujian Lapangan</strong>
                                <span>Sistem membantu pengelolaan data pengujian lapangan, mulai dari fase pendahuluan, vegetatif, berbunga, masak, hingga pengawasan panen.</span>
                            </div>
                        </li>
                        <li>
                            <span class="fli-bullet"><i class="fas fa-flask"></i></span>
                            <div class="fli-text">
                                <strong>Pengelolaan Hasil Laboratorium</strong>
                                <span>Sistem membantu pengelolaan data hasil laboratorium, termasuk uji kadar air, daya tumbuh, kemurnian fisik, dan uji kemurnian genetik.</span>
                            </div>
                        </li>
                        <li>
                            <span class="fli-bullet"><i class="fas fa-print"></i></span>
                            <div class="fli-text">
                                <strong>Pencetakan Sertifikasi Benih</strong>
                                <span>Sistem dapat mencetak sertifikasi benih sesuai format sistem aplikasi.</span>
                            </div>
                        </li>
                        <li>
                            <span class="fli-bullet"><i class="fas fa-chart-bar"></i></span>
                            <div class="fli-text">
                                <strong>Pencetakan Laporan</strong>
                                <span>Sistem dapat mencetak laporan berdasarkan data sertifikasi benih.</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-5 mb-3">
            <div class="dash-card">
                <div class="dash-card-head">
                    <div>
                        <h3><i class="fas fa-user-circle mr-1 text-info"></i> Informasi Pengguna</h3>
                        <div class="subtitle">Data pengguna yang sedang login</div>
                    </div>
                </div>
                <div class="dash-card-body">
                    @if($currentUser)
                        @php
                            $initial = strtoupper(substr($currentUser['name'] ?? '?', 0, 1));
                            $username = $currentUser['name'] ?? '-';
                            $email = $currentUser['email'] ?? null;
                            // Field role/NIP/pegawai/satgas belum ada di tabel users (REAL DATA),
                            // sehingga ditampilkan sebagai "Tidak tersedia" ketika null.
                            $role = $currentUser['role'] ?? null;
                            $nip = $currentUser['nip'] ?? null;
                            $pegawai = $currentUser['pegawai'] ?? null;
                            $satgas = $currentUser['satgas'] ?? null;
                        @endphp
                        <div class="user-card-body">
                            <div class="user-avatar">{{ $initial }}</div>
                            <div class="user-info">
                                <div class="user-name">{{ $username }}</div>
                                @if($email)
                                    <div class="user-email">{{ $email }}</div>
                                @endif
                            </div>
                        </div>
                        <ul class="user-detail-list">
                            <li>
                                <span class="udl-label">Username</span>
                                <span class="udl-value">{{ $username }}</span>
                            </li>
                            <li>
                                <span class="udl-label">Role</span>
                                <span class="udl-value {{ empty($role) ? 'empty' : '' }}">{{ $role ?: 'Tidak tersedia di sistem' }}</span>
                            </li>
                            <li>
                                <span class="udl-label">NIP</span>
                                <span class="udl-value {{ empty($nip) ? 'empty' : '' }}">{{ $nip ?: 'Tidak tersedia di sistem' }}</span>
                            </li>
                            <li>
                                <span class="udl-label">Pegawai</span>
                                <span class="udl-value {{ empty($pegawai) ? 'empty' : '' }}">{{ $pegawai ?: 'Tidak tersedia di sistem' }}</span>
                            </li>
                            <li>
                                <span class="udl-label">Satgas</span>
                                <span class="udl-value {{ empty($satgas) ? 'empty' : '' }}">{{ $satgas ?: 'Tidak tersedia di sistem' }}</span>
                            </li>
                            <li>
                                <span class="udl-label">ID Pengguna</span>
                                <span class="udl-value">{{ $currentUser['id'] ?? '-' }}</span>
                            </li>
                        </ul>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fas fa-user-lock"></i></div>
                            <div class="empty-title">Tidak ada sesi pengguna</div>
                            <div class="empty-sub">Silakan login untuk melihat informasi pengguna.</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push("footer")
{{-- Chart.js sudah di-load global oleh t_admin.blade.php --}}
<script>
(function () {
    // Palet warna konsisten dengan identitas perbenihan
    var palette = ['#0e7c4a', '#2563eb', '#f59e0b', '#7c3aed', '#0284c7', '#16a34a', '#dc2626'];

    // ===== Line Chart: Tren 12 bulan =====
    var trendCanvas = document.getElementById('trendChart');
    if (trendCanvas) {
        var ctx = trendCanvas.getContext('2d');

        // Gradient fill hijau perbenihan
        var gradient = ctx.createLinearGradient(0, 0, 0, 320);
        gradient.addColorStop(0, 'rgba(14, 124, 74, 0.28)');
        gradient.addColorStop(1, 'rgba(14, 124, 74, 0.02)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($trend['months']),
                datasets: [{
                    label: 'Total Data Master',
                    data: @json($trend['values']),
                    borderColor: '#0e7c4a',
                    backgroundColor: gradient,
                    borderWidth: 2.5,
                    pointBackgroundColor: '#0e7c4a',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.35,
                    fill: true
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.95)',
                        titleColor: '#ffffff',
                        bodyColor: '#e5e7eb',
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function (ctx) {
                                return ' Total: ' + ctx.parsed.y.toLocaleString('id-ID') + ' record';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#6b7280', font: { size: 11 } }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f3f4f6' },
                        ticks: {
                            color: '#6b7280',
                            font: { size: 11 },
                            precision: 0
                        }
                    }
                }
            }
        });
    }

    // ===== Donut Chart: Distribusi Master =====
    var distCanvas = document.getElementById('distChart');
    if (distCanvas) {
        new Chart(distCanvas.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    data: @json($chartValues),
                    backgroundColor: palette,
                    borderColor: '#ffffff',
                    borderWidth: 2,
                    hoverOffset: 6
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                cutout: '62%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#374151',
                            font: { size: 11.5 },
                            padding: 10,
                            boxWidth: 12,
                            boxHeight: 12
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.95)',
                        titleColor: '#ffffff',
                        bodyColor: '#e5e7eb',
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: function (ctx) {
                                var total = ctx.dataset.data.reduce(function (a, b) { return a + b; }, 0);
                                var pct = total > 0 ? ((ctx.parsed / total) * 100).toFixed(1) : 0;
                                return ' ' + ctx.label + ': ' + ctx.parsed.toLocaleString('id-ID') + ' (' + pct + '%)';
                            }
                        }
                    }
                }
            }
        });
    }
})();
</script>
@endpush