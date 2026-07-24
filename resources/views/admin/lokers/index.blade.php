@extends('layouts.adminapp')

@section('content')
<style>
    :root {
        --primary-blue: #013e7e;
        --secondary-blue: #0056b3;
        --accent-blue: #007bff;
        --warning-orange: #ff8c00;
        --success-green: #38a169;
        --industrial-yellow: #ffc107;
        --carbon-black: #1a202c;
        --dark-steel: #2d3748;
        --steel-gray: #4a5568;
        --light-steel: #718096;
        --metallic-silver: #e2e8f0;
        --text-white: #ffffff;
        --glass-light: rgba(255, 255, 255, 0.95);
        --glass-darker: rgba(248, 250, 252, 0.8);
        --shadow-subtle: 0 2px 12px rgba(1, 62, 126, 0.08);
        --shadow-elevated: 0 8px 25px rgba(1, 62, 126, 0.12);
        --shadow-floating: 0 20px 40px rgba(1, 62, 126, 0.15);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --border-radius: 16px;
        --border-radius-lg: 24px;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .main-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 1.5rem;
        min-height: calc(100vh - 70px);
    }

    /* Enhanced Header */
    .page-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-steel) 100%);
        border-radius: var(--border-radius-lg);
        padding: 2.5rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-floating);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255, 140, 0, 0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .page-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .header-content {
        position: relative;
        z-index: 2;
    }

    .page-title {
        color: var(--text-white);
        font-weight: 700;
        font-size: 2.25rem;
        margin: 0 0 0.5rem 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.1rem;
        margin: 0 0 1.5rem 0;
        font-weight: 400;
    }

    .btn-primary-action {
        background: linear-gradient(135deg, var(--warning-orange) 0%, #ff7b00 100%);
        border: none;
        color: var(--text-white);
        padding: 0.875rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: var(--transition);
        box-shadow: 0 4px 15px rgba(255, 140, 0, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        overflow: hidden;
    }

    .btn-primary-action::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .btn-primary-action:hover::before {
        left: 100%;
    }

    .btn-primary-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 140, 0, 0.4);
        color: var(--text-white);
    }

    /* Alert Styles */
    .alert-success {
        background: var(--glass-light);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(56, 161, 105, 0.2);
        border-left: 4px solid var(--success-green);
        color: #1a5738;
        border-radius: var(--border-radius);
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        font-weight: 500;
        box-shadow: var(--shadow-subtle);
    }

    /* Statistics Cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--glass-light);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--border-radius);
        padding: 2rem;
        box-shadow: var(--shadow-elevated);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, var(--stat-color) 0%, rgba(255, 255, 255, 0.3) 100%);
        transition: var(--transition);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-floating);
    }

    .stat-card:hover::before {
        width: 8px;
    }

    .stat-card.total {
        --stat-color: var(--accent-blue);
    }

    .stat-card.published {
        --stat-color: var(--success-green);
    }

    .stat-card.draft {
        --stat-color: var(--steel-gray);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.5rem;
        background: linear-gradient(135deg, var(--stat-color), rgba(255, 255, 255, 0.1));
        color: var(--text-white);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .stat-title {
        font-size: 0.875rem;
        color: var(--steel-gray);
        font-weight: 600;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--stat-color);
        line-height: 1;
        margin: 0;
    }

    /* Filter Panel */
    .filter-panel {
        background: var(--glass-light);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--border-radius);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-elevated);
    }

    .filter-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        color: var(--primary-blue);
        font-weight: 700;
        font-size: 1.1rem;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        align-items: end;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark-steel);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .form-control, .form-select {
        border: 2px solid var(--metallic-silver);
        border-radius: 12px;
        padding: 0.875rem 1rem;
        font-weight: 500;
        transition: var(--transition);
        background: var(--text-white);
        font-size: 0.95rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--warning-orange);
        box-shadow: 0 0 0 0.2rem rgba(255, 140, 0, 0.1);
        outline: none;
        background: var(--text-white);
    }

    .button-group {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .btn-filter {
        background: linear-gradient(135deg, var(--dark-steel) 0%, var(--carbon-black) 100%);
        border: none;
        color: var(--text-white);
        padding: 0.875rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-filter:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(45, 55, 72, 0.3);
        color: var(--text-white);
    }

    .btn-reset {
        background: transparent;
        border: 2px solid var(--metallic-silver);
        color: var(--steel-gray);
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-reset:hover {
        background: var(--steel-gray);
        color: var(--text-white);
        border-color: var(--steel-gray);
    }

    .btn-export {
        background: linear-gradient(135deg, var(--success-green) 0%, #2f855a 100%);
        border: none;
        color: var(--text-white);
        padding: 0.875rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: var(--transition);
        box-shadow: 0 4px 15px rgba(56, 161, 105, 0.2);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-export:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(56, 161, 105, 0.3);
        color: var(--text-white);
    }

    /* Data Table */
    .table-container {
        background: var(--glass-light);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-elevated);
        overflow: hidden;
    }

    .table-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: var(--text-white);
        padding: 1.5rem 2rem;
        font-weight: 700;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table {
        margin: 0;
        background: transparent;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead th {
        background: linear-gradient(135deg, var(--dark-steel) 0%, var(--steel-gray) 100%);
        color: var(--text-white);
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        padding: 1.25rem 1.5rem;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .table tbody tr {
        transition: var(--transition);
        border: none;
        background: transparent;
    }

    .table tbody tr:hover {
        background: linear-gradient(90deg, 
            rgba(255, 140, 0, 0.05) 0%, 
            rgba(255, 140, 0, 0.02) 50%, 
            rgba(255, 140, 0, 0.05) 100%);
        transform: translateX(4px);
    }

    .table tbody td {
        padding: 1.5rem 1.5rem;
        border: none;
        border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        vertical-align: middle;
        font-weight: 500;
        color: var(--dark-steel);
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .id-cell {
        font-weight: 700;
        color: var(--primary-blue);
        font-size: 0.9rem;
    }

    .poster-container {
        position: relative;
        display: inline-block;
    }

    .poster-image {
        width: 60px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid var(--metallic-silver);
        transition: var(--transition);
        box-shadow: var(--shadow-subtle);
    }

    .poster-image:hover {
        transform: scale(1.1);
        border-color: var(--warning-orange);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .no-image {
        width: 60px;
        height: 80px;
        background: linear-gradient(135deg, var(--metallic-silver) 0%, #cbd5e0 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--steel-gray);
        font-size: 1.5rem;
        border: 2px dashed rgba(74, 85, 104, 0.3);
    }

    .title-cell {
        max-width: 300px;
    }

    .job-title {
        font-weight: 700;
        color: var(--dark-steel);
        font-size: 1rem;
        line-height: 1.4;
        margin: 0;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .status-badge.published {
        background: linear-gradient(135deg, var(--success-green) 0%, #2f855a 100%);
        color: var(--text-white);
        box-shadow: 0 2px 8px rgba(56, 161, 105, 0.3);
    }

    .status-badge.draft {
        background: linear-gradient(135deg, var(--steel-gray) 0%, var(--light-steel) 100%);
        color: var(--text-white);
        box-shadow: 0 2px 8px rgba(74, 85, 104, 0.3);
    }

    .date-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--steel-gray);
        font-size: 0.9rem;
    }

    .action-group {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .btn-action {
        padding: 0.75rem;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        font-size: 0.85rem;
        transition: var(--transition);
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        position: relative;
        overflow: hidden;
    }

    .btn-edit {
        background: linear-gradient(135deg, var(--industrial-yellow) 0%, #e6b800 100%);
        color: var(--carbon-black);
        box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4);
        color: var(--carbon-black);
    }

    .btn-delete {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: var(--text-white);
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
        color: var(--text-white);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--steel-gray);
    }

    .empty-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, var(--metallic-silver) 0%, #cbd5e0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: var(--light-steel);
    }

    .empty-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--dark-steel);
        margin-bottom: 0.5rem;
    }

    .empty-subtitle {
        font-size: 1rem;
        color: var(--light-steel);
        margin-bottom: 2rem;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .main-container {
            padding: 1rem;
        }
        
        .stats-container {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 2rem 1.5rem;
            text-align: center;
        }
        
        .page-title {
            font-size: 1.75rem;
            justify-content: center;
        }
        
        .filter-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .button-group {
            grid-column: 1 / -1;
            justify-content: center;
        }
        
        .table-container {
            margin: 0 -1rem;
            border-radius: 0;
        }
        
        .table thead {
            display: none;
        }
        
        .table tbody tr {
            display: block;
            border-radius: var(--border-radius);
            margin-bottom: 1rem;
            padding: 1.5rem;
            background: var(--text-white);
            box-shadow: var(--shadow-subtle);
        }
        
        .table tbody td {
            display: block;
            padding: 0.5rem 0;
            border: none;
        }
        
        .table tbody td::before {
            content: attr(data-label) ": ";
            font-weight: 700;
            color: var(--primary-blue);
            display: inline-block;
            width: 100px;
        }
    }

    @media (max-width: 480px) {
        .stats-container {
            grid-template-columns: 1fr;
        }
        
        .action-group {
            flex-direction: column;
            gap: 0.375rem;
        }
        
        .btn-action {
            width: 100%;
            height: auto;
            padding: 0.75rem;
        }
    }
</style>

<div class="main-container">
    <!-- Enhanced Page Header -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">
                <i class="fas fa-briefcase"></i>
                Manajemen Lowongan Pekerjaan
            </h1>
            <p class="page-subtitle">Kelola dan pantau semua lowongan pekerjaan dalam sistem</p>
            <a href="{{ route('admin.lokers.create') }}" class="btn-primary-action">
                <i class="fas fa-plus"></i>
                Tambah Lowongan Baru
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Enhanced Statistics Cards -->
    <div class="stats-container">
        <div class="stat-card total">
            <div class="stat-icon">
                <i class="fas fa-list-alt"></i>
            </div>
            <div class="stat-title">Total Lowongan</div>
            <div class="stat-value">{{ $stats['total'] ?? 0 }}</div>
        </div>
        <div class="stat-card published">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-title">Dipublikasikan</div>
            <div class="stat-value">{{ $stats['published'] ?? 0 }}</div>
        </div>
        <div class="stat-card draft">
            <div class="stat-icon">
                <i class="fas fa-edit"></i>
            </div>
            <div class="stat-title">Draft</div>
            <div class="stat-value">{{ $stats['draft'] ?? 0 }}</div>
        </div>
    </div>

    <!-- Enhanced Filter Panel -->
    <div class="filter-panel">
        <div class="filter-header">
            <i class="fas fa-filter"></i>
            Filter & Export Data
        </div>
        <form method="GET" action="{{ route('admin.lokers.index') }}">
            <div class="filter-grid">
                <div class="form-group">
                    <label for="period" class="form-label">Periode Waktu</label>
                    <select name="period" id="period" class="form-select" onchange="toggleCustomDate()">
                        <option value="">Semua Periode</option>
                        <option value="today" {{ request('period') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="week" {{ request('period') == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                        <option value="month" {{ request('period') == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                        <option value="year" {{ request('period') == 'year' ? 'selected' : '' }}>Tahun Ini</option>
                        <option value="custom" {{ request('period') == 'custom' ? 'selected' : '' }}>Rentang Custom</option>
                    </select>
                </div>
                <div class="form-group" id="start-date-col" style="{{ request('period') == 'custom' ? '' : 'display:none;' }}">
                    <label for="start_date" class="form-label">Dari Tanggal</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="form-group" id="end-date-col" style="{{ request('period') == 'custom' ? '' : 'display:none;' }}">
                    <label for="end_date" class="form-label">Sampai Tanggal</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="button-group">
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-search"></i>
                        Filter
                    </button>
                    <a href="{{ route('admin.lokers.index') }}" class="btn-reset">
                        <i class="fas fa-undo"></i>
                        Reset
                    </a>
                    <button type="button" class="btn-export" onclick="exportData()">
                        <i class="fas fa-file-excel"></i>
                        Export Excel
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Enhanced Data Table -->
    <div class="table-container">
        <div class="table-header">
            <i class="fas fa-table"></i>
            Daftar Lowongan Pekerjaan
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Poster</th>
                        <th>Judul Lowongan</th>
                        <th>Status</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lokers as $loker)
                    <tr>
                        <td data-label="ID">
                            <span class="id-cell">#{{ $loker->id }}</span>
                        </td>
                        <td data-label="Poster">
                            <div class="poster-container">
                                @if($loker->poster)
                                    <img src="{{ asset('storage/' . $loker->poster) }}" alt="Poster" class="poster-image">
                                @else
                                    <div class="no-image">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td data-label="Judul" class="title-cell">
                            <h3 class="job-title">{{ $loker->title }}</h3>
                        </td>
                        <td data-label="Status">
                            <span class="status-badge {{ $loker->is_published ? 'published' : 'draft' }}">
                                <i class="fas fa-{{ $loker->is_published ? 'check-circle' : 'edit' }}"></i>
                                {{ $loker->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td data-label="Tanggal">
                            <div class="date-info">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $loker->created_at->format('d M Y, H:i') }}
                            </div>
                        </td>
                        <td data-label="Aksi">
                            <div class="action-group">
                                <a href="{{ route('admin.lokers.edit', $loker) }}" class="btn-action btn-edit" title="Edit Lowongan">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.lokers.destroy', $loker) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lowongan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus Lowongan">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-inbox"></i>
                                </div>
                                <div class="empty-title">Belum Ada Lowongan Pekerjaan</div>
                                <div class="empty-subtitle">Mulai dengan menambahkan lowongan pekerjaan pertama Anda</div>
                                <a href="{{ route('admin.lokers.create') }}" class="btn-primary-action">
                                    <i class="fas fa-plus"></i>
                                    Tambah Lowongan Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Toggle custom date inputs
function toggleCustomDate() {
    const period = document.getElementById('period').value;
    const startDateCol = document.getElementById('start-date-col');
    const endDateCol = document.getElementById('end-date-col');
    
    if (period === 'custom') {
        startDateCol.style.display = 'block';
        endDateCol.style.display = 'block';
        
        // Add animation
        startDateCol.style.opacity = '0';
        endDateCol.style.opacity = '0';
        
        setTimeout(() => {
            startDateCol.style.opacity = '1';
            endDateCol.style.opacity = '1';
        }, 50);
    } else {
        startDateCol.style.display = 'none';
        endDateCol.style.display = 'none';
    }
}

// Export data function
function exportData() {
    const form = document.querySelector('form');
    const formData = new FormData(form);
    
    // Show loading state
    const exportBtn = document.querySelector('.btn-export');
    const originalContent = exportBtn.innerHTML;
    exportBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengexport...';
    exportBtn.disabled = true;
    
    // Build URL with current filter parameters
    let exportUrl = '{{ route("admin.lokers.export") }}?';
    const params = new URLSearchParams(formData).toString();
    
    // Simulate export process
    setTimeout(() => {
        window.location.href = exportUrl + params;
        
        // Reset button after delay
        setTimeout(() => {
            exportBtn.innerHTML = originalContent;
            exportBtn.disabled = false;
        }, 2000);
    }, 1000);
}

// Enhanced loading states for all buttons
document.addEventListener('DOMContentLoaded', function() {
    // Add loading states to filter button
    const filterBtn = document.querySelector('.btn-filter');
    if (filterBtn) {
        filterBtn.addEventListener('click', function() {
            const originalContent = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memfilter...';
            this.disabled = true;
            
            // Re-enable after form submission
            setTimeout(() => {
                this.innerHTML = originalContent;
                this.disabled = false;
            }, 2000);
        });
    }
    
    // Add smooth scrolling to top after actions
    const actionButtons = document.querySelectorAll('.btn-action');
    actionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Add ripple effect
            const ripple = document.createElement('span');
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(255, 255, 255, 0.6)';
            ripple.style.transform = 'scale(0)';
            ripple.style.animation = 'ripple 0.6s linear';
            ripple.style.left = '50%';
            ripple.style.top = '50%';
            ripple.style.width = '20px';
            ripple.style.height = '20px';
            ripple.style.marginLeft = '-10px';
            ripple.style.marginTop = '-10px';
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Add fade-in animation to table rows
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Add counter animation to statistics
    const statValues = document.querySelectorAll('.stat-value');
    statValues.forEach(stat => {
        const finalValue = parseInt(stat.textContent);
        let currentValue = 0;
        const increment = Math.ceil(finalValue / 20);
        
        const counter = setInterval(() => {
            currentValue += increment;
            if (currentValue >= finalValue) {
                currentValue = finalValue;
                clearInterval(counter);
            }
            stat.textContent = currentValue;
        }, 50);
    });
});

// Add CSS for ripple animation
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .btn-action {
        position: relative;
        overflow: hidden;
    }
    
    /* Enhance hover effects */
    .stat-card:hover .stat-icon {
        transform: scale(1.1);
    }
    
    .table tbody tr:hover .poster-image {
        transform: scale(1.05);
    }
    
    /* Loading skeleton for better UX */
    .loading-skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }
    
    @keyframes loading {
        0% {
            background-position: 200% 0;
        }
        100% {
            background-position: -200% 0;
        }
    }
    
    /* Smooth transitions for all interactive elements */
    * {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Enhanced focus states for accessibility */
    .form-control:focus,
    .form-select:focus,
    .btn-action:focus,
    .btn-primary-action:focus,
    .btn-filter:focus,
    .btn-reset:focus,
    .btn-export:focus {
        outline: 2px solid var(--warning-orange);
        outline-offset: 2px;
    }
    
    /* Print styles */
    @media print {
        .page-header,
        .filter-panel,
        .btn-action,
        .action-group {
            display: none !important;
        }
        
        .table-container {
            box-shadow: none;
            border: 1px solid #000;
        }
        
        .table thead th {
            background: #f0f0f0 !important;
            color: #000 !important;
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection