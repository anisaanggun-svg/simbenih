@extends("template.t_admin")

@section("title", "User Info")

@push("header")
<style>
    .user-info-wrapper {
        max-width: 800px;
        margin: 0 auto;
    }
    .user-info-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 1px 2px rgba(16,24,40,.04), 0 1px 3px rgba(16,24,40,.06);
        overflow: hidden;
    }
    .user-info-card .card-header-custom {
        padding: 20px 24px;
        border-bottom: 1px solid #e5e7eb;
        background: #fafbfc;
    }
    .user-info-card .card-header-custom h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: #1f2937;
    }
    .user-info-card .card-header-custom .subtitle {
        font-size: 13px;
        color: #6b7280;
        margin-top: 4px;
    }
    .user-info-card .card-body-custom {
        padding: 24px;
    }
    .user-profile-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e5e7eb;
    }
    .user-avatar-large {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0e7c4a 0%, #0a5c37 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-weight: 600;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(14, 124, 74, 0.18);
    }
    .user-profile-info {
        flex: 1;
        min-width: 0;
    }
    .user-profile-info .profile-name {
        font-size: 18px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 2px;
    }
    .user-profile-info .profile-email {
        font-size: 13px;
        color: #6b7280;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }
    .info-item {
        padding: 14px 16px;
        background: #fafbfc;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
    }
    .info-item .info-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #6b7280;
        font-weight: 500;
        margin-bottom: 4px;
    }
    .info-item .info-value {
        font-size: 14px;
        color: #1f2937;
        font-weight: 500;
        word-break: break-word;
    }
    .info-item .info-value.empty {
        color: #9ca3af;
        font-style: italic;
    }
    .info-item.full-width {
        grid-column: 1 / -1;
    }
    @media (max-width: 576px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
        .user-profile-header {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endpush

@section("content")
<div class="row">
    <div class="col-12">
        <div class="user-info-wrapper">
            <div class="user-info-card">
                <div class="card-header-custom">
                    <h3><i class="fas fa-info-circle mr-2" style="color: #0e7c4a;"></i>User Info</h3>
                    <div class="subtitle">Informasi user yang sedang login</div>
                </div>
                <div class="card-body-custom">
                    @if($user)
                        @php
                            $initial = strtoupper(substr($user->name ?? '?', 0, 1));
                            $username = $user->username ?? $user->name ?? '-';
                            $email = $user->email ?? null;
                            $role = $user->role ? User::roles()[$user->role] ?? $user->role : null;
                            $wewenang = $user->wewenang ? $user->wewenang->nama_komoditas : ($user->wewenang_data ?? null);
                            $pegawai = $user->pegawai ? $user->pegawai->nama_pegawai : null;
                            $wilayahKerja = $user->satgas ? $user->satgas->nama_satgas : ($user->kabupaten ? $user->kabupaten->nama_kabupaten : null);
                        @endphp
                        <div class="user-profile-header">
                            <div class="user-avatar-large">{{ $initial }}</div>
                            <div class="user-profile-info">
                                <div class="profile-name">{{ $username }}</div>
                                @if($email)
                                    <div class="profile-email">{{ $email }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Username</div>
                                <div class="info-value">{{ $username }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Role</div>
                                <div class="info-value {{ empty($role) ? 'empty' : '' }}">{{ $role ?: 'Tidak tersedia di sistem' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Wewenang</div>
                                <div class="info-value {{ empty($wewenang) ? 'empty' : '' }}">{{ $wewenang ?: 'Tidak tersedia di sistem' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Pegawai</div>
                                <div class="info-value {{ empty($pegawai) ? 'empty' : '' }}">{{ $pegawai ?: 'Tidak tersedia di sistem' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Wilayah Kerja</div>
                                <div class="info-value {{ empty($wilayahKerja) ? 'empty' : '' }}">{{ $wilayahKerja ?: 'Tidak tersedia di sistem' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Tahun</div>
                                <div class="info-value">{{ $tahun }}</div>
                            </div>
                        </div>
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
