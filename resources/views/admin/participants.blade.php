@extends('layouts.adminapp')

@section('title', 'Manajemen Peserta')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="page-title">
                            <i class="fas fa-users text-warning"></i>
                            Manajemen Peserta
                        </h2>
                        <p class="page-subtitle">Kelola data peserta pelatihan kerja</p>
                    </div>
                    <div class="header-actions">
                        <form action="{{ route('admin.participant.export.xlsx') }}" method="GET" class="d-inline">
                            <input type="hidden" name="universal_search" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-export">
                                <i class="fas fa-file-excel"></i>
                                <span>Export Excel</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="management-card">
        <div class="card-header-custom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="card-title-group">
                        <h4 class="card-title">
                            <i class="fas fa-database"></i>
                            Data Peserta
                        </h4>
                        <span class="participant-count">Total: {{ $participants->total() }} peserta</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="search-controls">
                        <form action="{{ route('admin.participant.index') }}" method="GET" class="search-form">
                            <div class="search-input-group">
                                <input type="text" 
                                       name="search" 
                                       class="search-input" 
                                       placeholder="Cari nama, email, atau NIK..." 
                                       value="{{ request('search') }}">
                                <button type="submit" class="search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                                @if(request('search'))
                                    <a href="{{ route('admin.participant.index') }}" class="clear-btn">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body-custom">
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stat-card stat-primary">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $participants->total() }}</h3>
                            <p>Total Peserta</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-success">
                        <div class="stat-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $participants->where('profile.gender', 'Laki-laki')->count() }}</h3>
                            <p>Laki-laki</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-info">
                        <div class="stat-icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $participants->where('profile.gender', 'Perempuan')->count() }}</h3>
                            <p>Perempuan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-warning">
                        <div class="stat-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $participants->whereNotNull('profile.pendidikan')->count() }}</h3>
                            <p>Data Lengkap</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Table -->
            <div class="table-container">
                <div class="table-wrapper">
                    <table class="enhanced-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-user"></i> Nama</th>
                                <th><i class="fas fa-envelope"></i> Email</th>
                                <th><i class="fas fa-id-card"></i> NIK</th>
                                <th><i class="fas fa-calendar"></i> TTL</th>
                                <th><i class="fas fa-venus-mars"></i> Gender</th>
                                <th><i class="fas fa-map-marker-alt"></i> Alamat</th>
                                <th><i class="fas fa-graduation-cap"></i> Pendidikan</th>
                                <th><i class="fas fa-phone"></i> Telepon</th>
                                <th><i class="fas fa-cogs"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($participants as $participant)
                            <tr class="table-row">
                                <td class="user-info">
                                    <div class="user-avatar">
                                        <img src="{{ $participant->profile && $participant->profile->foto ? asset('storage/' . $participant->profile->foto) : asset('image/default_profile.jpg') }}" 
                                             alt="Avatar">
                                    </div>
                                    <div class="user-details">
                                        <strong>{{ $participant->profile->name ?? 'N/A' }}</strong>
                                        <small class="user-id">#{{ str_pad($participant->id, 4, '0', STR_PAD_LEFT) }}</small>
                                    </div>
                                </td>
                                <td class="email-cell">
                                    <span class="email-text">{{ $participant->email }}</span>
                                </td>
                                <td class="nik-cell">
                                    @if(isset($participant->profile->nik))
                                        <span class="nik-masked">
                                            {{ substr($participant->profile->nik, 0, 6) . str_repeat('●', max(0, strlen($participant->profile->nik) - 6)) }}
                                        </span>
                                    @else
                                        <span class="no-data">Tidak ada data</span>
                                    @endif
                                </td>
                                <td class="ttl-cell">
                                    @if($participant->profile->ttl)
                                        <span class="ttl-text">{{ $participant->profile->ttl }}</span>
                                    @else
                                        <span class="no-data">Tidak ada data</span>
                                    @endif
                                </td>
                                <td class="gender-cell">
                                    @if($participant->profile->gender)
                                        <span class="gender-badge gender-{{ strtolower($participant->profile->gender) }}">
                                            <i class="fas fa-{{ $participant->profile->gender === 'Laki-laki' ? 'mars' : 'venus' }}"></i>
                                            {{ $participant->profile->gender }}
                                        </span>
                                    @else
                                        <span class="no-data">Tidak ada data</span>
                                    @endif
                                </td>
                                <td class="address-cell">
                                    @if($participant->profile->desa)
                                        <span class="address-text" title="{{ $participant->profile->desa }}">
                                            {{ Str::limit($participant->profile->desa, 25) }}
                                        </span>
                                    @else
                                        <span class="no-data">Tidak ada data</span>
                                    @endif
                                </td>
                                <td class="education-cell">
                                    @if($participant->profile->pendidikan)
                                        <span class="education-badge">
                                            {{ $participant->profile->pendidikan }}
                                        </span>
                                    @else
                                        <span class="no-data">Tidak ada data</span>
                                    @endif
                                </td>
                                <td class="phone-cell">
                                    @if($participant->profile->nomor)
                                        <span class="phone-text">{{ $participant->profile->nomor }}</span>
                                    @else
                                        <span class="no-data">Tidak ada data</span>
                                    @endif
                                </td>
                                <td class="action-cell">
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.participant.show', $participant->id) }}" 
                                           class="action-btn btn-detail" 
                                           title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                            <span>Detail</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="empty-state">
                                    <div class="empty-content">
                                        <i class="fas fa-users-slash"></i>
                                        <h4>Tidak Ada Data Peserta</h4>
                                        <p>Belum ada peserta yang terdaftar atau sesuai dengan pencarian Anda.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Enhanced Pagination -->
            @if($participants->hasPages())
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    <span>Menampilkan {{ $participants->firstItem() }} - {{ $participants->lastItem() }} dari {{ $participants->total() }} data</span>
                </div>
                <div class="pagination-controls">
                    {{ $participants->appends(request()->query())->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Page Header Styles */
.page-header {
    background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
    padding: 2rem;
    border-radius: 16px;
    color: white;
    box-shadow: 0 8px 32px rgba(1, 62, 126, 0.15);
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: repeating-linear-gradient(
        45deg,
        transparent,
        transparent 2px,
        rgba(255, 255, 255, 0.05) 2px,
        rgba(255, 255, 255, 0.05) 4px
    );
}

.page-title {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.page-subtitle {
    margin: 0.5rem 0 0 0;
    opacity: 0.9;
    font-size: 1.1rem;
}

.header-actions {
    position: relative;
    z-index: 2;
}

.btn-export {
    background: linear-gradient(145deg, var(--success-green), #2d7a52);
    border: none;
    color: white;
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(56, 161, 105, 0.3);
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-export:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(56, 161, 105, 0.4);
    color: white;
}

/* Management Card */
.management-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: 1px solid rgba(1, 62, 126, 0.1);
}

.card-header-custom {
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    padding: 2rem;
    border-bottom: 3px solid var(--warning-orange);
}

.card-title-group {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.card-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--dark-steel);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.participant-count {
    background: var(--warning-orange);
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

/* Search Controls */
.search-controls {
    display: flex;
    justify-content: flex-end;
}

.search-form {
    width: 100%;
    max-width: 400px;
}

.search-input-group {
    position: relative;
    display: flex;
    align-items: center;
}

.search-input {
    width: 100%;
    padding: 12px 50px 12px 20px;
    border: 2px solid #e2e8f0;
    border-radius: 25px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: white;
}

.search-input:focus {
    outline: none;
    border-color: var(--warning-orange);
    box-shadow: 0 0 0 3px rgba(255, 140, 0, 0.1);
}

.search-btn {
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
    background: var(--warning-orange);
    border: none;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    transition: all 0.3s ease;
}

.search-btn:hover {
    background: rgba(255, 140, 0, 0.8);
    transform: translateY(-50%) scale(1.05);
}

.clear-btn {
    position: absolute;
    right: 45px;
    top: 50%;
    transform: translateY(-50%);
    background: #6c757d;
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    font-size: 0.8rem;
}

/* Statistics Cards */
.stat-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border-left: 5px solid;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.stat-primary { border-color: var(--primary-blue); }
.stat-success { border-color: var(--success-green); }
.stat-info { border-color: #17a2b8; }
.stat-warning { border-color: var(--warning-orange); }

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.stat-primary .stat-icon { background: var(--primary-blue); }
.stat-success .stat-icon { background: var(--success-green); }
.stat-info .stat-icon { background: #17a2b8; }
.stat-warning .stat-icon { background: var(--warning-orange); }

.stat-content h3 {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    color: var(--dark-steel);
}

.stat-content p {
    margin: 0;
    color: var(--light-steel);
    font-weight: 500;
}

/* Enhanced Table */
.table-container {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.table-wrapper {
    overflow-x: auto;
}

.enhanced-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.enhanced-table thead {
    background: linear-gradient(135deg, var(--dark-steel), var(--steel-gray));
    color: white;
}

.enhanced-table th {
    padding: 1.2rem 1rem;
    font-weight: 600;
    font-size: 0.9rem;
    text-align: left;
    border: none;
    white-space: nowrap;
}

.enhanced-table th i {
    margin-right: 0.5rem;
    opacity: 0.8;
}

.enhanced-table tbody tr {
    border-bottom: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.enhanced-table tbody tr:hover {
    background: linear-gradient(90deg, rgba(255, 140, 0, 0.02), rgba(255, 140, 0, 0.05));
    transform: scale(1.001);
}

.enhanced-table td {
    padding: 1rem;
    vertical-align: middle;
    border: none;
}

/* User Info Cell */
.user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.user-avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid var(--warning-orange);
    flex-shrink: 0;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-details strong {
    color: var(--dark-steel);
    font-weight: 600;
    display: block;
}

.user-id {
    color: var(--light-steel);
    font-size: 0.8rem;
}

/* Table Cell Styles */
.email-text {
    color: var(--primary-blue);
    font-weight: 500;
}

.nik-masked {
    font-family: 'Courier New', monospace;
    background: #f1f5f9;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 0.85rem;
}

.ttl-text {
    color: var(--dark-steel);
    font-size: 0.9rem;
}

.gender-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 4px 10px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.gender-laki-laki {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.gender-perempuan {
    background: rgba(236, 72, 153, 0.1);
    color: #ec4899;
}

.address-text {
    color: var(--dark-steel);
    font-size: 0.9rem;
}

.education-badge {
    background: var(--primary-blue);
    color: white;
    padding: 4px 10px;
    border-radius: 10px;
    font-size: 0.8rem;
    font-weight: 500;
}

.phone-text {
    font-family: 'Courier New', monospace;
    color: var(--success-green);
    font-weight: 500;
}

.no-data {
    color: var(--light-steel);
    font-style: italic;
    font-size: 0.85rem;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 8px 12px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
}

.btn-detail {
    background: linear-gradient(145deg, #17a2b8, #138496);
    color: white;
}

.btn-detail:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
    color: white;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-content {
    color: var(--light-steel);
}

.empty-content i {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-content h4 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: var(--dark-steel);
}

/* Enhanced Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: between;
    align-items: center;
    padding: 1.5rem;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
}

.pagination-info {
    color: var(--light-steel);
    font-size: 0.9rem;
}

.pagination-controls .pagination {
    margin: 0;
}

.pagination-controls .page-link {
    border: none;
    color: var(--dark-steel);
    padding: 8px 12px;
    margin: 0 2px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.pagination-controls .page-link:hover {
    background: var(--warning-orange);
    color: white;
    transform: translateY(-1px);
}

.pagination-controls .page-item.active .page-link {
    background: var(--primary-blue);
    color: white;
    box-shadow: 0 2px 8px rgba(1, 62, 126, 0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header {
        padding: 1.5rem;
    }
    
    .page-title {
        font-size: 1.8rem;
    }
    
    .card-header-custom {
        padding: 1.5rem;
    }
    
    .card-header-custom .row {
        flex-direction: column;
        gap: 1rem;
    }
    
    .search-controls {
        justify-content: stretch;
    }
    
    .enhanced-table {
        font-size: 0.85rem;
    }
    
    .enhanced-table th,
    .enhanced-table td {
        padding: 0.75rem 0.5rem;
    }
    
    .user-info {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .pagination-wrapper {
        flex-direction: column;
        gap: 1rem;
    }
}

@media (max-width: 576px) {
    .stat-card {
        padding: 1rem;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
    
    .stat-content h3 {
        font-size: 1.5rem;
    }
    
    .enhanced-table th {
        padding: 0.75rem 0.5rem;
        font-size: 0.8rem;
    }
    
    .enhanced-table td {
        padding: 0.5rem;
    }
}
</style>
@endsection