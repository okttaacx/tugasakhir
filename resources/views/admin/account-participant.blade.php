@extends('layouts.adminapp')

@section('content')
<div class="container-fluid px-4 py-5">
    <!-- Page Header with Industrial Design -->
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="page-title">
                    <i class="fas fa-users me-3"></i>
                    Manajemen Akun Peserta
                </h2>
                <p class="page-subtitle">Kelola akun pengguna dan role dalam sistem</p>
            </div>
            @if (Auth::user()->hasRole('super_admin'))
            <button type="button" class="btn-industrial btn-industrial-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fas fa-plus me-2"></i>
                <span>Tambah Akun</span>
            </button>
            @endif
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card stat-card-primary">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $users->total() }}</h3>
                    <p>Total Pengguna</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card stat-card-success">
                <div class="stat-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $users->filter(fn($user) => $user->hasRole('admin'))->count() }}</h3>
                    <p>Admin</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card stat-card-warning">
                <div class="stat-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $users->filter(fn($user) => $user->hasRole('super_admin'))->count() }}</h3>
                    <p>Super Admin</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card stat-card-info">
                <div class="stat-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $users->filter(fn($user) => $user->hasRole('user'))->count() }}</h3>
                    <p>User Biasa</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="industrial-card">
        <div class="industrial-card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="industrial-card-title">
                    <i class="fas fa-table me-2"></i>
                    Data Akun Peserta
                </h4>
                <div class="header-actions">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Cari pengguna..." id="userSearch">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="industrial-card-body">
            @if(session('success'))
                <div class="alert-industrial alert-industrial-success" role="alert">
                    <div class="alert-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="alert-content">
                        <strong>Berhasil!</strong>
                        <p>{{ session('success') }}</p>
                    </div>
                    <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <div class="table-industrial-wrapper">
                <table class="table-industrial" id="usersTable">
                    <thead>
                        <tr>
                            <th>
                                <div class="th-content">
                                    <span>ID</span>
                                    <i class="fas fa-sort"></i>
                                </div>
                            </th>
                            <th>
                                <div class="th-content">
                                    <span>Informasi Pengguna</span>
                                    <i class="fas fa-sort"></i>
                                </div>
                            </th>
                            <th>
                                <div class="th-content">
                                    <span>Role & Status</span>
                                    <i class="fas fa-sort"></i>
                                </div>
                            </th>
                            <th>
                                <div class="th-content">
                                    <span>Aksi</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr class="user-row" data-user-name="{{ strtolower($user->name) }}" data-user-email="{{ strtolower($user->email) }}">
                            <td>
                                <div class="user-id">
                                    <span class="id-badge">#{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        @if($user->profile && $user->profile->foto)
                                            <img src="{{ asset('storage/' . $user->profile->foto) }}" alt="{{ $user->name }}">
                                        @else
                                            <div class="avatar-placeholder">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="user-details">
                                        <h6 class="user-name">{{ $user->name }}</h6>
                                        <p class="user-email">{{ $user->email }}</p>
                                        <span class="user-joined">Bergabung: {{ $user->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @php
                                    $role = $user->roles->first();
                                @endphp
                                <div class="role-status">
                                    <span class="role-badge role-badge-{{ $role ? $role->name : 'default' }}">
                                        @if($role && $user->hasRole('super_admin'))
                                            <i class="fas fa-crown"></i>
                                            Super Admin
                                        @elseif($role && $user->hasRole('admin'))
                                            <i class="fas fa-user-shield"></i>
                                            Administrator
                                        @else
                                            <i class="fas fa-user"></i>
                                            User Biasa
                                        @endif
                                    </span>
                                    <div class="status-indicator">
                                        <span class="status-dot status-active"></span>
                                        <span class="status-text">Aktif</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    @if ($role && $role->name == 'super_admin')
                                        <span class="no-action">
                                            <i class="fas fa-lock"></i>
                                            Tidak dapat diubah
                                        </span>
                                    @else
                                        <form action="{{ route('admin.change_role', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn-action {{ $user->hasRole('user') ? 'btn-action-promote' : 'btn-action-demote' }}" 
                                                    title="{{ $user->hasRole('user') ? 'Jadikan Admin' : 'Jadikan User' }}"
                                                    onclick="return confirm('Apakah Anda yakin ingin mengubah role pengguna ini?')">
                                                @if($user->hasRole('user'))
                                                    <i class="fas fa-arrow-up"></i>
                                                    <span>Jadikan Admin</span>
                                                @else
                                                    <i class="fas fa-arrow-down"></i>
                                                    <span>Jadikan User</span>
                                                @endif
                                            </button>
                                        </form>
                                        <button class="btn-action btn-action-info" title="Detail Pengguna" 
                                                onclick="viewUserDetail({{ $user->id }})">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="no-data">
                                <div class="no-data-content">
                                    <i class="fas fa-users-slash"></i>
                                    <h5>Tidak ada data pengguna</h5>
                                    <p>Belum ada akun peserta yang terdaftar dalam sistem</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} data
                </div>
                <div class="pagination-controls">
                    {{ $users->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Enhanced Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content industrial-modal">
            <div class="industrial-modal-header">
                <div class="modal-header-content">
                    <div class="modal-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="modal-title-section">
                        <h5 class="modal-title" id="addUserModalLabel">Tambah Akun Peserta</h5>
                        <p class="modal-subtitle">Buat akun baru untuk peserta pelatihan</p>
                    </div>
                </div>
                <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="industrial-modal-body">
                <form action="{{ route('admin.account.store') }}" method="POST" id="addUserForm">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="fas fa-user me-2"></i>
                                Nama Lengkap
                            </label>
                            <input type="text" class="form-control-industrial" id="name" name="name" required
                                   placeholder="Masukkan nama lengkap">
                            <div class="form-feedback"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2"></i>
                                Alamat Email
                            </label>
                            <input type="email" class="form-control-industrial" id="email" name="email" required
                                   placeholder="contoh@email.com">
                            <div class="form-feedback"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-2"></i>
                                Password
                            </label>
                            <div class="password-input-group">
                                <input type="password" class="form-control-industrial" id="password" name="password" required
                                       placeholder="Minimal 8 karakter">
                                <button type="button" class="password-toggle" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="password-strength">
                                <div class="strength-bar">
                                    <div class="strength-fill"></div>
                                </div>
                                <span class="strength-text">Masukkan password</span>
                            </div>
                            <div class="form-feedback"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="role" class="form-label">
                                <i class="fas fa-user-tag me-2"></i>
                                Role Pengguna
                            </label>
                            <select class="form-select-industrial" id="role" name="role" required>
                                <option value="">Pilih role pengguna</option>
                                <option value="user">User Biasa</option>
                                <option value="admin">Administrator</option>
                                <option value="super_admin">Super Admin</option>
                            </select>
                            <div class="form-feedback"></div>
                        </div>
                    </div>
                    
                    <div class="modal-actions">
                        <button type="button" class="btn-industrial btn-industrial-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>
                            Batal
                        </button>
                        <button type="submit" class="btn-industrial btn-industrial-primary">
                            <i class="fas fa-save me-2"></i>
                            Simpan Akun
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Page Header Styles */
.page-header {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
    border-radius: 16px;
    padding: 2rem;
    color: var(--text-white);
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow);
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 200px;
    height: 200px;
    background: rgba(255, 140, 0, 0.1);
    border-radius: 50%;
    transform: translate(50%, -50%);
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
}

.page-subtitle {
    margin: 0.5rem 0 0 0;
    opacity: 0.9;
    font-size: 1.1rem;
}

/* Statistics Cards */
.stat-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: var(--shadow);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--warning-orange);
}

.stat-card-primary::before { background: var(--primary-blue); }
.stat-card-success::before { background: var(--success-green); }
.stat-card-warning::before { background: var(--warning-orange); }
.stat-card-info::before { background: #17a2b8; }

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.stat-card {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: var(--text-white);
    background: linear-gradient(135deg, var(--warning-orange) 0%, rgba(255, 140, 0, 0.8) 100%);
}

.stat-card-primary .stat-icon { background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); }
.stat-card-success .stat-icon { background: linear-gradient(135deg, var(--success-green) 0%, #48bb78 100%); }
.stat-card-info .stat-icon { background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%); }

.stat-content h3 {
    font-size: 2rem;
    font-weight: 800;
    margin: 0;
    color: var(--dark-steel);
}

.stat-content p {
    margin: 0;
    color: var(--light-steel);
    font-weight: 500;
}

/* Industrial Card Styles */
.industrial-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 20px;
    box-shadow: var(--shadow);
    overflow: hidden;
    position: relative;
}

.industrial-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-blue), var(--warning-orange));
}

.industrial-card-header {
    background: linear-gradient(135deg, var(--steel-gray) 0%, var(--dark-steel) 100%);
    padding: 1.5rem 2rem;
    color: var(--text-white);
}

.industrial-card-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
}

.header-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.search-box {
    position: relative;
    display: flex;
    align-items: center;
}

.search-box i {
    position: absolute;
    left: 12px;
    color: var(--light-steel);
    z-index: 1;
}

.search-box input {
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    padding: 10px 12px 10px 40px;
    color: var(--text-white);
    width: 250px;
    transition: var(--transition);
}

.search-box input::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.search-box input:focus {
    outline: none;
    border-color: var(--warning-orange);
    background: rgba(255, 255, 255, 0.15);
}

.industrial-card-body {
    padding: 2rem;
}

/* Enhanced Button Styles */
.btn-industrial {
    display: inline-flex;
    align-items: center;
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    font-size: 0.95rem;
}

.btn-industrial::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.btn-industrial:hover::before {
    left: 100%;
}

.btn-industrial-primary {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
    color: var(--text-white);
}

.btn-industrial-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(1, 62, 126, 0.3);
    color: var(--text-white);
}

.btn-industrial-secondary {
    background: linear-gradient(135deg, var(--light-steel) 0%, var(--steel-gray) 100%);
    color: var(--text-white);
}

.btn-industrial-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(74, 85, 104, 0.3);
    color: var(--text-white);
}

/* Enhanced Table Styles */
.table-industrial-wrapper {
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.table-industrial {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.table-industrial thead {
    background: linear-gradient(135deg, var(--dark-steel) 0%, var(--steel-gray) 100%);
}

.table-industrial th {
    padding: 1.2rem 1.5rem;
    color: var(--text-white);
    font-weight: 600;
    text-align: left;
    border: none;
    position: relative;
}

.th-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
}

.th-content i {
    opacity: 0.6;
    transition: var(--transition);
}

.th-content:hover i {
    opacity: 1;
    color: var(--warning-orange);
}

.table-industrial td {
    padding: 1.5rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    vertical-align: middle;
}

.table-industrial tbody tr {
    transition: var(--transition);
}

.table-industrial tbody tr:hover {
    background: rgba(1, 62, 126, 0.02);
}

/* User Info Styles */
.user-id .id-badge {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
    color: var(--text-white);
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.85rem;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    overflow: hidden;
    position: relative;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--light-steel) 0%, var(--steel-gray) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-white);
    font-size: 1.2rem;
}

.user-details .user-name {
    font-weight: 600;
    margin: 0 0 4px 0;
    color: var(--dark-steel);
    font-size: 1rem;
}

.user-details .user-email {
    margin: 0 0 4px 0;
    color: var(--light-steel);
    font-size: 0.9rem;
}

.user-details .user-joined {
    font-size: 0.8rem;
    color: var(--light-steel);
    opacity: 0.8;
}

/* Role Badge Styles */
.role-status {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.role-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 8px 16px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: capitalize;
}

.role-badge-super_admin {
    background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
    color: var(--text-white);
}

.role-badge-admin {
    background: linear-gradient(135deg, var(--success-green) 0%, #48bb78 100%);
    color: var(--text-white);
}

.role-badge-user {
    background: linear-gradient(135deg, #64748b 0%, #94a3b8 100%);
    color: var(--text-white);
}

.role-badge-default {
    background: linear-gradient(135deg, var(--light-steel) 0%, var(--steel-gray) 100%);
    color: var(--text-white);
}

.status-indicator {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    position: relative;
}

.status-active {
    background: var(--success-green);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(56, 161, 105, 0.7); }
    70% { box-shadow: 0 0 0 6px rgba(56, 161, 105, 0); }
    100% { box-shadow: 0 0 0 0 rgba(56, 161, 105, 0); }
}

.status-text {
    font-size: 0.8rem;
    color: var(--success-green);
    font-weight: 500;
}

/* Action Button Styles */
.action-buttons {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
}

.btn-action-promote {
    background: linear-gradient(135deg, var(--success-green) 0%, #48bb78 100%);
    color: var(--text-white);
}

.btn-action-demote {
    background: linear-gradient(135deg, var(--warning-orange) 0%, #fd8b22 100%);
    color: var(--text-white);
}

.btn-action-info {
    background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
    color: var(--text-white);
    padding: 8px 12px;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.no-action {
    color: var(--light-steel);
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 8px 12px;
    background: rgba(113, 128, 150, 0.1);
    border-radius: 8px;
}

/* Enhanced Alert Styles */
.alert-industrial {
    background: #ffffff;
    border: none;
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 1rem;
    position: relative;
    overflow: hidden;
}

.alert-industrial::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
}

.alert-industrial-success::before {
    background: var(--success-green);
}

.alert-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: var(--text-white);
}

.alert-industrial-success .alert-icon {
    background: linear-gradient(135deg, var(--success-green) 0%, #48bb78 100%);
}

.alert-content {
    flex: 1;
}

.alert-content strong {
    color: var(--dark-steel);
    font-weight: 600;
    font-size: 1rem;
}

.alert-content p {
    margin: 0.25rem 0 0 0;
    color: var(--light-steel);
    font-size: 0.9rem;
}

.alert-close {
    background: none;
    border: none;
    color: var(--light-steel);
    font-size: 1.2rem;
    cursor: pointer;
    transition: var(--transition);
    padding: 4px;
    border-radius: 4px;
}

.alert-close:hover {
    color: var(--dark-steel);
    background: rgba(0, 0, 0, 0.05);
}

/* No Data Styles */
.no-data {
    text-align: center;
    padding: 4rem 2rem;
}

.no-data-content i {
    font-size: 4rem;
    color: var(--light-steel);
    opacity: 0.5;
    margin-bottom: 1rem;
}

.no-data-content h5 {
    color: var(--dark-steel);
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.no-data-content p {
    color: var(--light-steel);
    margin: 0;
}

/* Pagination Styles */
.pagination-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.pagination-info {
    color: var(--light-steel);
    font-size: 0.9rem;
}

/* Enhanced Modal Styles */
.industrial-modal {
    border: none;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    overflow: hidden;
}

.industrial-modal-header {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
    padding: 2rem;
    color: var(--text-white);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    position: relative;
}

.industrial-modal-header::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 150px;
    height: 150px;
    background: rgba(255, 140, 0, 0.1);
    border-radius: 50%;
    transform: translate(40%, -40%);
}

.modal-header-content {
    display: flex;
    align-items: center;
    gap: 1rem;
    z-index: 1;
    position: relative;
}

.modal-icon {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    backdrop-filter: blur(10px);
}

.modal-title-section .modal-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
}

.modal-subtitle {
    margin: 0.25rem 0 0 0;
    opacity: 0.9;
    font-size: 0.95rem;
}

.modal-close {
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-white);
    cursor: pointer;
    transition: var(--transition);
    backdrop-filter: blur(10px);
    z-index: 1;
    position: relative;
}

.modal-close:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.05);
}

.industrial-modal-body {
    padding: 2rem;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
}

/* Enhanced Form Styles */
.form-grid {
    display: grid;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.form-group {
    position: relative;
}

.form-label {
    display: flex;
    align-items: center;
    font-weight: 600;
    color: var(--dark-steel);
    margin-bottom: 0.75rem;
    font-size: 0.95rem;
}

.form-control-industrial {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    background: #ffffff;
    color: var(--dark-steel);
    font-size: 0.95rem;
    transition: var(--transition);
}

.form-control-industrial:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 3px rgba(1, 62, 126, 0.1);
    transform: translateY(-1px);
}

.form-control-industrial::placeholder {
    color: var(--light-steel);
}

.form-select-industrial {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    background: #ffffff;
    color: var(--dark-steel);
    font-size: 0.95rem;
    transition: var(--transition);
    cursor: pointer;
}

.form-select-industrial:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 3px rgba(1, 62, 126, 0.1);
}

/* Password Input Group */
.password-input-group {
    position: relative;
    display: flex;
    align-items: center;
}

.password-input-group .form-control-industrial {
    padding-right: 50px;
}

.password-toggle {
    position: absolute;
    right: 12px;
    background: none;
    border: none;
    color: var(--light-steel);
    cursor: pointer;
    padding: 8px;
    transition: var(--transition);
    border-radius: 6px;
}

.password-toggle:hover {
    color: var(--primary-blue);
    background: rgba(1, 62, 126, 0.05);
}

/* Password Strength Indicator */
.password-strength {
    margin-top: 0.5rem;
}

.strength-bar {
    width: 100%;
    height: 4px;
    background: #e2e8f0;
    border-radius: 2px;
    overflow: hidden;
    margin-bottom: 0.25rem;
}

.strength-fill {
    height: 100%;
    width: 0%;
    transition: var(--transition);
    border-radius: 2px;
}

.strength-text {
    font-size: 0.8rem;
    color: var(--light-steel);
}

/* Form Feedback */
.form-feedback {
    margin-top: 0.5rem;
    font-size: 0.85rem;
    display: none;
}

.form-feedback.valid {
    color: var(--success-green);
    display: block;
}

.form-feedback.invalid {
    color: #dc3545;
    display: block;
}

/* Modal Actions */
.modal-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .page-header {
        padding: 1.5rem;
        text-align: center;
    }
    
    .page-title {
        font-size: 1.5rem;
        justify-content: center;
    }
    
    .btn-industrial {
        width: 100%;
        justify-content: center;
        margin-top: 1rem;
    }
    
    .header-actions {
        flex-direction: column;
        gap: 1rem;
        width: 100%;
    }
    
    .search-box input {
        width: 100%;
    }
    
    .action-buttons {
        flex-direction: column;
        width: 100%;
    }
    
    .btn-action {
        width: 100%;
        justify-content: center;
    }
    
    .modal-actions {
        flex-direction: column-reverse;
    }
    
    .modal-actions .btn-industrial {
        width: 100%;
    }
    
    .pagination-wrapper {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .user-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }
    
    .role-status {
        align-items: flex-start;
    }
}

@media (max-width: 480px) {
    .industrial-card-body {
        padding: 1rem;
    }
    
    .table-industrial th,
    .table-industrial td {
        padding: 1rem 0.75rem;
    }
    
    .page-header {
        padding: 1rem;
    }
    
    .industrial-modal-header,
    .industrial-modal-body {
        padding: 1.5rem;
    }
}

/* Loading States */
.loading {
    opacity: 0.6;
    pointer-events: none;
    position: relative;
}

.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 24px;
    height: 24px;
    margin: -12px 0 0 -12px;
    border: 3px solid var(--light-steel);
    border-top-color: var(--primary-blue);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Custom Scrollbar */
.table-industrial-wrapper::-webkit-scrollbar {
    height: 8px;
}

.table-industrial-wrapper::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.table-industrial-wrapper::-webkit-scrollbar-thumb {
    background: var(--light-steel);
    border-radius: 4px;
}

.table-industrial-wrapper::-webkit-scrollbar-thumb:hover {
    background: var(--steel-gray);
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password Toggle
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    
    if (togglePassword && passwordField) {
        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
        
        // Password Strength Indicator
        passwordField.addEventListener('input', function() {
            const password = this.value;
            const strengthFill = document.querySelector('.strength-fill');
            const strengthText = document.querySelector('.strength-text');
            
            let strength = 0;
            let text = 'Sangat Lemah';
            let color = '#dc3545';
            
            if (password.length >= 8) strength += 25;
            if (password.match(/[a-z]/)) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;
            
            if (strength >= 75) {
                text = 'Sangat Kuat';
                color = 'var(--success-green)';
            } else if (strength >= 50) {
                text = 'Kuat';
                color = 'var(--warning-orange)';
            } else if (strength >= 25) {
                text = 'Sedang';
                color = '#ffc107';
            }
            
            strengthFill.style.width = strength + '%';
            strengthFill.style.backgroundColor = color;
            strengthText.textContent = text;
            strengthText.style.color = color;
        });
    }
    
    // Search Functionality
    const searchInput = document.getElementById('userSearch');
    const userRows = document.querySelectorAll('.user-row');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            userRows.forEach(row => {
                const userName = row.getAttribute('data-user-name');
                const userEmail = row.getAttribute('data-user-email');
                
                if (userName.includes(searchTerm) || userEmail.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    // Form Validation
    const form = document.getElementById('addUserForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const role = document.getElementById('role').value;
            
            let isValid = true;
            
            // Clear previous feedback
            document.querySelectorAll('.form-feedback').forEach(el => {
                el.style.display = 'none';
                el.className = 'form-feedback';
            });
            
            // Validate name
            if (name.length < 2) {
                showValidationError('name', 'Nama harus minimal 2 karakter');
                isValid = false;
            }
            
            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showValidationError('email', 'Format email tidak valid');
                isValid = false;
            }
            
            // Validate password
            if (password.length < 8) {
                showValidationError('password', 'Password harus minimal 8 karakter');
                isValid = false;
            }
            
            // Validate role
            if (!role) {
                showValidationError('role', 'Pilih role pengguna');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            } else {
                // Show loading state
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
            }
        });
    }
    
    function showValidationError(fieldName, message) {
        const field = document.getElementById(fieldName);
        const feedback = field.parentNode.querySelector('.form-feedback');
        
        field.style.borderColor = '#dc3545';
        feedback.textContent = message;
        feedback.className = 'form-feedback invalid';
    }
    
    // Sort Table Functionality
    document.querySelectorAll('.th-content').forEach(header => {
        header.addEventListener('click', function() {
            const table = document.getElementById('usersTable');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr:not(.no-data)'));
            
            const columnIndex = Array.from(this.parentNode.parentNode.children).indexOf(this.parentNode);
            const isAscending = this.classList.contains('asc');
            
            // Remove sort classes from all headers
            document.querySelectorAll('.th-content').forEach(h => {
                h.classList.remove('asc', 'desc');
            });
            
            // Add sort class to current header
            this.classList.add(isAscending ? 'desc' : 'asc');
            
            rows.sort((a, b) => {
                const aText = a.children[columnIndex].textContent.trim().toLowerCase();
                const bText = b.children[columnIndex].textContent.trim().toLowerCase();
                
                if (isAscending) {
                    return bText.localeCompare(aText);
                } else {
                    return aText.localeCompare(bText);
                }
            });
            
            // Reorder rows in table
            rows.forEach(row => tbody.appendChild(row));
        });
    });
});

// View User Detail Function
function viewUserDetail(userId) {
    // Implementation for viewing user details
    console.log('View user detail for ID:', userId);
    // You can implement modal or redirect to detail page here
}

// Auto-hide alerts after 5 seconds
document.querySelectorAll('.alert-industrial').forEach(alert => {
    setTimeout(() => {
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-20px)';
        setTimeout(() => alert.remove(), 300);
    }, 5000);
});

// Enhanced loading states for AJAX requests
function showLoading(element) {
    element.classList.add('loading');
}

function hideLoading(element) {
    element.classList.remove('loading');
}

// Print functionality (optional)
function printTable() {
    window.print();
}

console.log('Enhanced Account Management Page Loaded');
</script>
@endpush