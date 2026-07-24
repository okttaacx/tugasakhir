@extends('layouts.adminapp')

@section('title', 'Kelola Pengaduan')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-steel-gray fw-bold">
                        <i class="fas fa-comments me-3 text-warning"></i>
                        Kelola Pengaduan
                    </h1>
                    <p class="text-muted mb-0 mt-1">Manajemen pengaduan dan keluhan dari peserta</p>
                </div>
                <div class="d-flex gap-2">
                    <div class="badge bg-gradient-primary fs-6 px-3 py-2">
                        <i class="fas fa-chart-bar me-1"></i>
                        Total: {{ $pengaduan->count() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100 filter-card" 
                 style="background: linear-gradient(135deg, #ff8c00 0%, #ffa500 100%); cursor: pointer;"
                 onclick="filterStatus('all')">
                <div class="card-body text-white">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-list-ul fa-2x opacity-75"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fs-4 fw-bold">{{ $pengaduan->count() }}</div>
                            <div class="small opacity-90">Semua Pengaduan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100 filter-card" 
                 style="background: linear-gradient(135deg, #ffc107 0%, #ffda58 100%); cursor: pointer;"
                 onclick="filterStatus('pending')">
                <div class="card-body text-dark">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-hourglass-half fa-2x opacity-75"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fs-4 fw-bold">{{ $pengaduan->where('status', 'pending')->count() }}</div>
                            <div class="small opacity-90">Belum Dijawab</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100 filter-card" 
                 style="background: linear-gradient(135deg, #28a745 0%, #34ce57 100%); cursor: pointer;"
                 onclick="filterStatus('dibalas')">
                <div class="card-body text-white">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle fa-2x opacity-75"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fs-4 fw-bold">{{ $pengaduan->where('status', 'dibalas')->count() }}</div>
                            <div class="small opacity-90">Sudah Dijawab</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle text-success me-3 fs-5"></i>
                <div class="flex-grow-1">
                    <strong>Berhasil!</strong> {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Main Content Card -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <!-- Card Header -->
                <div class="card-header border-0" 
                     style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--dark-steel) 100%); padding: 1.5rem;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-white mb-1 fw-bold">
                                <i class="fas fa-database me-2"></i>
                                Daftar Pengaduan
                            </h5>
                            <p class="text-white-50 mb-0 small">Kelola dan tanggapi pengaduan peserta</p>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="input-group" style="width: 300px;">
                                <span class="input-group-text bg-white border-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" id="searchInput" class="form-control border-0" 
                                       placeholder="Cari nama, institusi, atau telepon...">
                            </div>
                            <select id="statusFilter" class="form-select bg-white border-0" style="width: 150px;">
                                <option value="all">Semua Status</option>
                                <option value="pending">Menunggu</option>
                                <option value="dibalas">Dibalas</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="pengaduanTable">
                            <thead style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                <tr>
                                    <th class="py-3 px-4 fw-bold text-steel-gray">
                                        <i class="fas fa-hashtag me-1"></i>
                                        No
                                    </th>
                                    <th class="py-3 px-4 fw-bold text-steel-gray">
                                        <i class="fas fa-calendar me-1"></i>
                                        Tanggal
                                    </th>
                                    <th class="py-3 px-4 fw-bold text-steel-gray">
                                        <i class="fas fa-user me-1"></i>
                                        Nama Lengkap
                                    </th>
                                    <th class="py-3 px-4 fw-bold text-steel-gray">
                                        <i class="fas fa-building me-1"></i>
                                        Institusi
                                    </th>
                                    <th class="py-3 px-4 fw-bold text-steel-gray">
                                        <i class="fas fa-phone me-1"></i>
                                        No. Telp
                                    </th>
                                    <th class="py-3 px-4 fw-bold text-steel-gray">
                                        <i class="fas fa-flag me-1"></i>
                                        Status
                                    </th>
                                    <th class="py-3 px-4 fw-bold text-steel-gray text-center">
                                        <i class="fas fa-cogs me-1"></i>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengaduan as $index => $item)
                                    <tr class="pengaduan-row align-middle" 
                                        data-status="{{ $item->status }}"
                                        data-search="{{ strtolower($item->nama_lengkap . ' ' . $item->institusi . ' ' . $item->no_telp) }}">
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                                                     style="width: 35px; height: 35px;">
                                                    <span class="fw-bold text-muted small">{{ $index + 1 }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="d-flex flex-column">
                                                <span class="fw-medium">{{ $item->created_at->format('d/m/Y') }}</span>
                                                <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3"
                                                     style="width: 40px; height: 40px;">
                                                    <i class="fas fa-user text-primary"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-medium text-dark">{{ $item->nama_lengkap }}</div>
                                                    <small class="text-muted">{{ $item->email ?? 'Email tidak tersedia' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="badge bg-light text-dark border px-3 py-2">
                                                <i class="fas fa-building me-1"></i>
                                                {{ $item->institusi }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-phone text-success me-2"></i>
                                                <span class="fw-medium">{{ $item->no_telp }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($item->status == 'pending')
                                                <span class="badge px-3 py-2 fw-medium" 
                                                      style="background: linear-gradient(135deg, #ffc107 0%, #ffda58 100%); color: #333;">
                                                    <i class="fas fa-hourglass-half me-1"></i>
                                                    Menunggu
                                                </span>
                                            @elseif($item->status == 'dibalas')
                                                <span class="badge px-3 py-2 fw-medium" 
                                                      style="background: linear-gradient(135deg, #28a745 0%, #34ce57 100%);">
                                                    <i class="fas fa-check-circle me-1"></i>
                                                    Dibalas
                                                </span>
                                            @else
                                                <span class="badge bg-secondary px-3 py-2 fw-medium">
                                                    <i class="fas fa-question-circle me-1"></i>
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.pengaduan.show', $item->id) }}" 
                                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1"
                                                   data-bs-toggle="tooltip" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                    <span class="d-none d-md-inline">Detail</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr id="emptyState">
                                        <td colspan="7" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3"
                                                     style="width: 80px; height: 80px;">
                                                    <i class="fas fa-inbox fa-2x text-muted"></i>
                                                </div>
                                                <h5 class="text-muted mb-2">Belum Ada Pengaduan</h5>
                                                <p class="text-muted mb-0">Pengaduan dari peserta akan muncul di sini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Card Footer -->
                @if($pengaduan->count() > 0)
                <div class="card-footer bg-light border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            <i class="fas fa-info-circle me-1"></i>
                            Menampilkan {{ $pengaduan->count() }} pengaduan
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary btn-sm" onclick="exportData()">
                                <i class="fas fa-download me-1"></i>
                                Export
                            </button>
                            <button class="btn btn-outline-primary btn-sm" onclick="refreshData()">
                                <i class="fas fa-refresh me-1"></i>
                                Refresh
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .filter-card {
        transition: all 0.3s ease;
        border-radius: 16px !important;
        overflow: hidden;
    }

    .filter-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    }

    .pengaduan-row {
        transition: all 0.2s ease;
        border-left: 4px solid transparent;
    }

    .pengaduan-row:hover {
        background: linear-gradient(90deg, rgba(255, 140, 0, 0.05) 0%, rgba(255, 255, 255, 0.05) 100%);
        border-left-color: var(--warning-orange);
        transform: translateX(2px);
    }

    .table th {
        border-bottom: 2px solid var(--warning-orange) !important;
        position: relative;
    }

    .table th::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary-blue);
        transition: width 0.3s ease;
    }

    .table th:hover::after {
        width: 100%;
    }

    .btn-outline-primary {
        border-color: var(--primary-blue);
        color: var(--primary-blue);
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        border-color: var(--primary-blue);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(1, 62, 126, 0.3);
    }

    .input-group-text {
        border: 1px solid #e3e6f0;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--warning-orange);
        box-shadow: 0 0 0 0.2rem rgba(255, 140, 0, 0.25);
    }

    #emptyState {
        display: none;
    }

    .table tbody tr.d-none ~ #emptyState {
        display: table-row;
    }
</style>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const rows = document.querySelectorAll('.pengaduan-row');
    const emptyState = document.getElementById('emptyState');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        let visibleCount = 0;

        rows.forEach(row => {
            const searchData = row.getAttribute('data-search');
            const rowStatus = row.getAttribute('data-status');
            
            const matchesSearch = searchData.includes(searchTerm);
            const matchesStatus = statusValue === 'all' || rowStatus === statusValue;
            
            if (matchesSearch && matchesStatus) {
                row.style.display = '';
                row.classList.remove('d-none');
                visibleCount++;
            } else {
                row.style.display = 'none';
                row.classList.add('d-none');
            }
        });

        // Show/hide empty state
        if (emptyState) {
            emptyState.style.display = visibleCount === 0 ? 'table-row' : 'none';
        }
    }

    searchInput.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);

    // Filter by status cards
    window.filterStatus = function(status) {
        statusFilter.value = status;
        filterTable();
        
        // Visual feedback for selected filter
        document.querySelectorAll('.filter-card').forEach(card => {
            card.style.transform = '';
        });
        event.currentTarget.style.transform = 'translateY(-5px) scale(1.02)';
        setTimeout(() => {
            event.currentTarget.style.transform = '';
        }, 200);
    };

    // Export functionality
    window.exportData = function() {
        // Implement export logic here
        alert('Fitur export akan segera tersedia!');
    };

    // Refresh functionality
    window.refreshData = function() {
        location.reload();
    };

    // Add loading animation to buttons
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (!this.disabled) {
                const icon = this.querySelector('i');
                if (icon && !icon.classList.contains('fa-spin')) {
                    const originalClass = icon.className;
                    icon.className = 'fas fa-spinner fa-spin';
                    setTimeout(() => {
                        icon.className = originalClass;
                    }, 1000);
                }
            }
        });
    });
});
</script>
@endpush