@extends('layouts.adminapp')

@section('title', 'Manajemen Pelatihan')

@section('content')
<style>
    :root {
        --primary-blue: #013e7e;
        --secondary-blue: #0056b3;
        --accent-blue: #007bff;
        --text-white: #ffffff;
        --text-light: rgba(255,255,255,0.9);
        --shadow: 0 4px 15px rgba(0,0,0,0.1);
        --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        --steel-gray: #4a5568;
        --dark-steel: #2d3748;
        --light-steel: #718096;
        --warning-orange: #ff8c00;
        --success-green: #38a169;
        --industrial-yellow: #ffc107;
        --carbon-black: #1a202c;
        --metallic-silver: #e2e8f0;
        --error-red: #e53e3e;
        --glass-bg: rgba(255, 255, 255, 0.95);
    }

    /* Glass morphism effects */
    .glass-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 
            0 8px 32px rgba(31, 38, 135, 0.37),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        transition: var(--transition);
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-steel) 100%);
        padding: 2.5rem 0;
        margin: -2rem -2rem 2rem -2rem;
        border-bottom: 4px solid var(--warning-orange);
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
        background: 
            radial-gradient(circle at 20% 50%, rgba(255, 140, 0, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(56, 161, 105, 0.1) 0%, transparent 50%),
            repeating-linear-gradient(
                45deg,
                transparent,
                transparent 2px,
                rgba(255, 255, 255, 0.02) 2px,
                rgba(255, 255, 255, 0.02) 4px
            );
        animation: pattern-shift 20s ease-in-out infinite;
    }

    @keyframes pattern-shift {
        0%, 100% { transform: translateX(0) translateY(0); }
        25% { transform: translateX(-10px) translateY(-5px); }
        50% { transform: translateX(10px) translateY(-10px); }
        75% { transform: translateX(-5px) translateY(5px); }
    }

    .page-header h1 {
        color: var(--text-white);
        font-weight: 800;
        font-size: clamp(2rem, 5vw, 3rem);
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        margin: 0;
        letter-spacing: 1px;
        position: relative;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: linear-gradient(145deg, var(--glass-bg) 0%, rgba(248, 250, 252, 0.9) 100%);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        overflow: hidden;
        transition: var(--transition);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-blue), var(--warning-orange));
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.15);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary-blue);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--steel-gray);
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-floating {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(145deg, var(--warning-orange) 0%, #e07600 100%);
        color: var(--text-white);
        border: none;
        box-shadow: 0 8px 25px rgba(255, 140, 0, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        transition: var(--transition);
        z-index: 1000;
    }

    .btn-floating:hover {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 12px 35px rgba(255, 140, 0, 0.6);
        color: var(--text-white);
    }

    .search-container {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        position: relative;
    }

    .search-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--primary-blue), var(--warning-orange), var(--success-green));
        border-radius: 20px 20px 0 0;
    }

    .search-input-group {
        position: relative;
        overflow: hidden;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .search-input {
        border: none;
        padding: 1rem 4rem 1rem 1.5rem;
        font-size: 1.1rem;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        transition: var(--transition);
        width: 100%;
        border-radius: 16px;
    }

    .search-input:focus {
        outline: none;
        background: rgba(255, 255, 255, 1);
        box-shadow: 0 0 0 3px rgba(1, 62, 126, 0.1);
    }

    .search-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary-blue);
        font-size: 1.2rem;
        cursor: pointer;
        transition: var(--transition);
    }

    .search-icon:hover {
        color: var(--warning-orange);
        transform: translateY(-50%) scale(1.1);
    }

    .filter-tabs {
        display: flex;
        gap: 0.5rem;
        margin-top: 1.5rem;
        flex-wrap: wrap;
    }

    .filter-tab {
        padding: 0.5rem 1.2rem;
        border: 2px solid rgba(1, 62, 126, 0.2);
        background: rgba(255, 255, 255, 0.7);
        color: var(--primary-blue);
        border-radius: 25px;
        cursor: pointer;
        transition: var(--transition);
        font-weight: 500;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-tab:hover, .filter-tab.active {
        background: var(--primary-blue);
        color: var(--text-white);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(1, 62, 126, 0.3);
    }

    .training-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        overflow: hidden;
        transition: var(--transition);
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .training-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-blue), var(--warning-orange));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .training-card:hover::before {
        opacity: 1;
    }

    .training-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .card-image-container {
        position: relative;
        overflow: hidden;
        height: 240px;
    }

    .card-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .card-image-container:hover .card-image {
        transform: scale(1.08);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(
            135deg, 
            rgba(1, 62, 126, 0.8) 0%, 
            rgba(255, 140, 0, 0.6) 100%
        );
        opacity: 0;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-image-container:hover .image-overlay {
        opacity: 1;
    }

    .overlay-content {
        color: var(--text-white);
        text-align: center;
        transform: translateY(20px);
        transition: var(--transition);
    }

    .card-image-container:hover .overlay-content {
        transform: translateY(0);
    }

    .status-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.8rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .badge-upcoming { background: rgba(52, 152, 219, 0.9); color: white; }
    .badge-ongoing { background: rgba(46, 213, 115, 0.9); color: white; }
    .badge-completed { background: rgba(108, 117, 125, 0.9); color: white; }

    .image-count {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(0, 0, 0, 0.8);
        color: var(--text-white);
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }

    .card-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        color: var(--primary-blue);
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 1rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-description {
        color: var(--steel-gray);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex-grow: 1;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.8rem;
        margin-bottom: 1.5rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        font-size: 0.85rem;
        color: var(--steel-gray);
    }

    .info-item i {
        width: 16px;
        margin-right: 0.5rem;
        color: var(--primary-blue);
        font-size: 0.9rem;
    }

    .progress-section {
        margin-bottom: 1.5rem;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        color: var(--steel-gray);
        margin-bottom: 0.5rem;
    }

    .progress-bar-custom {
        height: 6px;
        background: rgba(1, 62, 126, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--success-green), var(--warning-orange));
        border-radius: 10px;
        transition: width 1s ease-in-out;
    }

    .action-buttons {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 0.5rem;
        margin-top: auto;
    }

    .btn-action {
        padding: 0.7rem 1rem;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.3rem;
        position: relative;
        overflow: hidden;
    }

    .btn-action::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-action:hover::before {
        left: 100%;
    }

    .btn-edit {
        background: linear-gradient(145deg, var(--warning-orange), #e07600);
        color: var(--text-white);
    }

    .btn-participants {
        background: linear-gradient(145deg, var(--success-green), #2f855a);
        color: var(--text-white);
    }

    .btn-delete {
        background: linear-gradient(145deg, var(--error-red), #c53030);
        color: var(--text-white);
    }

    .btn-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        color: var(--text-white);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin: 2rem 0;
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--light-steel);
        margin-bottom: 1.5rem;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .empty-title {
        color: var(--dark-steel);
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .empty-subtitle {
        color: var(--steel-gray);
        margin-bottom: 2rem;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
    }

    .pagination {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        padding: 1rem;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .page-link {
        border: none;
        background: transparent;
        color: var(--primary-blue);
        font-weight: 600;
        padding: 0.7rem 1.2rem;
        margin: 0 0.2rem;
        border-radius: 12px;
        transition: var(--transition);
    }

    .page-link:hover, .page-item.active .page-link {
        background: linear-gradient(145deg, var(--primary-blue), var(--secondary-blue));
        color: var(--text-white);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(1, 62, 126, 0.3);
    }

    .modal-backdrop {
        backdrop-filter: blur(5px);
    }

    .modal-content-enhanced {
        background: var(--glass-bg);
        backdrop-filter: blur(30px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
    }

    .modal-header-enhanced {
        background: linear-gradient(135deg, var(--error-red), #c53030);
        color: var(--text-white);
        border: none;
        padding: 2rem;
        position: relative;
    }

    .modal-header-enhanced::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 30% 40%, rgba(255,255,255,0.1) 0%, transparent 60%);
    }

    .modal-body-enhanced {
        padding: 2.5rem;
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
    }

    .modal-footer-enhanced {
        padding: 1.5rem 2.5rem 2.5rem;
        background: var(--glass-bg);
        border: none;
    }

    .warning-icon {
        font-size: 4rem;
        color: var(--error-red);
        margin-bottom: 1.5rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    .quick-stats {
        position: fixed;
        bottom: 100px;
        right: 30px;
        width: 280px;
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        transform: translateX(320px);
        transition: var(--transition);
        z-index: 999;
    }

    .quick-stats.show {
        transform: translateX(0);
    }

    .quick-stats-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        font-weight: 600;
        color: var(--primary-blue);
    }

    .quick-stats-close {
        background: none;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        color: var(--steel-gray);
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }
        
        .action-buttons {
            grid-template-columns: 1fr;
            gap: 0.5rem;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
            gap: 0.5rem;
        }

        .filter-tabs {
            justify-content: center;
        }

        .btn-floating {
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
        }

        .quick-stats {
            display: none;
        }
    }

    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.6s ease forwards;
    }

    .fade-in:nth-child(1) { animation-delay: 0.1s; }
    .fade-in:nth-child(2) { animation-delay: 0.2s; }
    .fade-in:nth-child(3) { animation-delay: 0.3s; }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
</style>

<div class="container-fluid">
    <!-- Enhanced Page Header -->
    <div class="page-header">
        <div class="container-fluid px-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-graduation-cap me-3"></i>Manajemen Pelatihan</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 mt-2">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-light text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pelatihan</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-4 text-end">
                    <div class="d-flex align-items-center justify-content-end gap-3">
                        <button class="btn btn-outline-light" onclick="toggleQuickStats()">
                            <i class="fas fa-chart-bar me-2"></i>Statistik
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="stats-grid fade-in">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="stat-number">{{ $trainings->total() }}</div>
                    <div class="stat-label">Total Pelatihan</div>
                </div>
                <i class="fas fa-chalkboard-teacher fa-2x" style="color: var(--primary-blue); opacity: 0.3;"></i>
            </div>
        </div>
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    @php
                        $activeTrainings = $trainings->where('start_date', '>=', now())->count();
                    @endphp
                    <div class="stat-number">{{ $activeTrainings }}</div>
                    <div class="stat-label">Akan Datang</div>
                </div>
                <i class="fas fa-calendar-plus fa-2x" style="color: var(--success-green); opacity: 0.3;"></i>
            </div>
        </div>
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    @php
                        $totalCapacity = $trainings->sum('capacity');
                    @endphp
                    <div class="stat-number">{{ number_format($totalCapacity) }}</div>
                    <div class="stat-label">Total Kapasitas</div>
                </div>
                <i class="fas fa-users fa-2x" style="color: var(--warning-orange); opacity: 0.3;"></i>
            </div>
        </div>
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="stat-number">{{ $trainings->where('images')->count() }}</div>
                    <div class="stat-label">Dengan Media</div>
                </div>
                <i class="fas fa-images fa-2x" style="color: var(--accent-blue); opacity: 0.3;"></i>
            </div>
        </div>
    </div>

    <!-- Enhanced Search Container -->
    <div class="search-container fade-in">
        <form method="GET" action="{{ route('admin.trainings.index') }}" id="searchForm">
            <div class="search-input-group">
                <input type="text" 
                       name="search" 
                       class="search-input" 
                       placeholder="Cari pelatihan berdasarkan judul, lokasi, atau deskripsi..." 
                       value="{{ $search }}"
                       autocomplete="off">
                <i class="fas fa-search search-icon" onclick="performSearch()"></i>
            </div>
            
            <div class="filter-tabs">
                <button type="button" 
                        class="filter-tab {{ !request()->get('status') ? 'active' : '' }}" 
                        onclick="filterTrainings('all')"
                        data-filter="all">
                    <i class="fas fa-list"></i> Semua
                </button>
                <button type="button" 
                        class="filter-tab {{ request()->get('status') == 'upcoming' ? 'active' : '' }}" 
                        onclick="filterTrainings('upcoming')"
                        data-filter="upcoming">
                    <i class="fas fa-clock"></i> Akan Datang
                </button>
                <button type="button" 
                        class="filter-tab {{ request()->get('status') == 'ongoing' ? 'active' : '' }}" 
                        onclick="filterTrainings('ongoing')"
                        data-filter="ongoing">
                    <i class="fas fa-play-circle"></i> Berlangsung
                </button>
                <button type="button" 
                        class="filter-tab {{ request()->get('status') == 'completed' ? 'active' : '' }}" 
                        onclick="filterTrainings('completed')"
                        data-filter="completed">
                    <i class="fas fa-check-circle"></i> Selesai
                </button>
                @if($search)
                    <a href="{{ route('admin.trainings.index') }}" class="filter-tab" style="background: var(--error-red); color: white;">
                        <i class="fas fa-times"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center fade-in" style="background: linear-gradient(145deg, var(--success-green), #2f855a); color: white; border: none; border-radius: 16px;">
            <i class="fas fa-check-circle me-3 fa-lg"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <!-- Enhanced Training Cards -->
    <div class="row" id="trainingCards">
        @forelse($trainings as $index => $training)
            @php
                $now = \Carbon\Carbon::now();
                $startDate = \Carbon\Carbon::parse($training->start_date);
                $endDate = $training->end_date ? \Carbon\Carbon::parse($training->end_date) : $startDate;
                
                if($now->lt($startDate)) {
                    $status = 'upcoming';
                } elseif($now->between($startDate, $endDate)) {
                    $status = 'ongoing';
                } else {
                    $status = 'completed';
                }
                
                $primaryImagePath = null;
                if ($training->images && $training->images->count() > 0) {
                    $primaryImageObj = $training->images->where('is_primary', true)->first();
                    if ($primaryImageObj) {
                        $primaryImagePath = $primaryImageObj->image_path;
                    } else {
                        $primaryImagePath = $training->images->first()->image_path;
                    }
                }
                if (!$primaryImagePath && isset($training->image)) {
                    $primaryImagePath = $training->image;
                }
            @endphp
            
            <div class="col-xl-4 col-lg-6 mb-4 fade-in">
                <div class="training-card" 
                     data-status="{{ $status }}"
                     data-title="{{ strtolower($training->title) }}"
                     data-location="{{ strtolower($training->location) }}"
                     data-description="{{ strtolower($training->description) }}">
                    
                    <div class="card-image-container">
                        <img src="{{ $primaryImagePath ? asset('storage/' . $primaryImagePath) : asset('images/training-default.jpg') }}" 
                             class="card-image" 
                             alt="{{ $training->title }}"
                             loading="lazy">
                        
                        <div class="image-overlay">
                            <div class="overlay-content">
                                <i class="fas fa-eye fa-2x mb-2"></i>
                                <p class="mb-0">Lihat Detail</p>
                            </div>
                        </div>
                        
                        @if($training->images && $training->images->count() > 1)
                            <div class="image-count">
                                <i class="fas fa-images me-1"></i>{{ $training->images->count() }}
                            </div>
                        @endif
                        
                        <div class="status-badge 
                            @if($status == 'upcoming') badge-upcoming
                            @elseif($status == 'ongoing') badge-ongoing
                            @else badge-completed
                            @endif">
                            @if($status == 'upcoming')
                                <i class="fas fa-clock me-1"></i>Akan Datang
                            @elseif($status == 'ongoing')
                                <i class="fas fa-play me-1"></i>Berlangsung
                            @else
                                <i class="fas fa-check me-1"></i>Selesai
                            @endif
                        </div>
                    </div>

                    <div class="card-content">
                        <h5 class="card-title">{{ $training->title }}</h5>
                        <p class="card-description">{{ Str::limit($training->description, 150) }}</p>
                        
                        <div class="info-grid">
                            <div class="info-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ \Carbon\Carbon::parse($training->start_date)->format('d M Y') }}</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-clock"></i>
                                <span>{{ $training->start_time }}</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ Str::limit($training->location, 20) }}</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-users"></i>
                                <span>{{ $training->capacity }} peserta</span>
                            </div>
                        </div>

                        @php
                            // Simulate participant count for progress bar
                            $participantCount = rand(0, $training->capacity);
                            $progressPercentage = $training->capacity > 0 ? ($participantCount / $training->capacity) * 100 : 0;
                        @endphp
                        
                        <div class="progress-section">
                            <div class="progress-label">
                                <span>Pendaftar</span>
                                <span>{{ $participantCount }}/{{ $training->capacity }}</span>
                            </div>
                            <div class="progress-bar-custom">
                                <div class="progress-fill" style="width: {{ $progressPercentage }}%"></div>
                            </div>
                        </div>

                        <div class="action-buttons">
                            <a href="{{ route('trainings.edit', $training->id) }}" 
                               class="btn-action btn-edit"
                               data-bs-toggle="tooltip" 
                               title="Edit pelatihan">
                                <i class="fas fa-edit"></i>
                                <span>Edit</span>
                            </a>
                            <a href="{{ route('trainings.participants', $training->id) }}" 
                               class="btn-action btn-participants"
                               data-bs-toggle="tooltip" 
                               title="Lihat peserta">
                                <i class="fas fa-users"></i>
                                <span>Peserta</span>
                            </a>
                            <button type="button" 
                                    class="btn-action btn-delete" 
                                    onclick="confirmDelete({{ $training->id }}, '{{ addslashes($training->title) }}')"
                                    data-bs-toggle="tooltip" 
                                    title="Hapus pelatihan">
                                <i class="fas fa-trash-alt"></i>
                                <span>Hapus</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h5 class="empty-title">
                        @if($search)
                            Tidak ada hasil ditemukan
                        @else
                            Belum ada pelatihan
                        @endif
                    </h5>
                    <p class="empty-subtitle">
                        @if($search)
                            Tidak ada pelatihan yang cocok dengan pencarian "<strong>{{ $search }}</strong>". Coba gunakan kata kunci yang berbeda.
                        @else
                            Mulai mengelola pelatihan dengan menambahkan pelatihan pertama Anda.
                        @endif
                    </p>
                    @if($search)
                        <a href="{{ route('admin.trainings.index') }}" class="btn btn-outline-primary me-3">
                            <i class="fas fa-list me-2"></i>Lihat Semua Pelatihan
                        </a>
                    @endif
                    <a href="{{ route('trainings.create') }}" class="btn" style="background: linear-gradient(145deg, var(--primary-blue), var(--secondary-blue)); color: white; border-radius: 12px; padding: 12px 24px;">
                        <i class="fas fa-plus me-2"></i>Tambah Pelatihan Baru
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Enhanced Pagination -->
    @if($trainings->hasPages())
        <div class="pagination-wrapper fade-in">
            <div class="pagination">
                {{ $trainings->appends(['search' => $search])->links() }}
            </div>
        </div>
    @endif
</div>

<!-- Floating Action Button -->
<a href="{{ route('trainings.create') }}" class="btn-floating" data-bs-toggle="tooltip" title="Tambah Pelatihan Baru">
    <i class="fas fa-plus"></i>
</a>

<!-- Quick Stats Panel -->
<div class="quick-stats" id="quickStats">
    <div class="quick-stats-header">
        <span><i class="fas fa-chart-line me-2"></i>Statistik Cepat</span>
        <button class="quick-stats-close" onclick="toggleQuickStats()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="mb-2">
        <small class="text-muted">Pelatihan Aktif</small>
        <div class="d-flex justify-content-between">
            <span>Akan Datang</span>
            <strong>{{ $trainings->where('start_date', '>=', now())->count() }}</strong>
        </div>
    </div>
    <div class="mb-2">
        <small class="text-muted">Kapasitas Total</small>
        <div class="d-flex justify-content-between">
            <span>Tersedia</span>
            <strong>{{ number_format($trainings->sum('capacity')) }}</strong>
        </div>
    </div>
    <div class="mb-2">
        <small class="text-muted">Media</small>
        <div class="d-flex justify-content-between">
            <span>Dengan Gambar</span>
            <strong>{{ $trainings->filter(function($t) { return $t->images && $t->images->count() > 0; })->count() }}</strong>
        </div>
    </div>
</div>

<!-- Enhanced Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-enhanced">
            <div class="modal-header modal-header-enhanced">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Konfirmasi Hapus Pelatihan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body modal-body-enhanced text-center">
                <div class="warning-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <h6 class="mb-3" id="deleteTitle">Hapus Pelatihan?</h6>
                <p class="text-muted mb-4">
                    Tindakan ini akan <strong>menghapus permanen</strong> semua data terkait:
                </p>
                <div class="row text-start">
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-danger me-2"></i>
                            <small>Informasi pelatihan</small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-images text-danger me-2"></i>
                            <small>Media & gambar</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-users text-danger me-2"></i>
                            <small>Data pendaftar</small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-history text-danger me-2"></i>
                            <small>Riwayat pelatihan</small>
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger d-flex align-items-center mt-3" style="border-radius: 12px;">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <small><strong>Peringatan:</strong> Data yang dihapus tidak dapat dikembalikan!</small>
                </div>
            </div>
            <div class="modal-footer modal-footer-enhanced">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 12px; padding: 10px 20px;">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="background: linear-gradient(145deg, var(--error-red), #c53030); border: none; border-radius: 12px; padding: 10px 20px;">
                        <i class="fas fa-trash-alt me-1"></i>Ya, Hapus Pelatihan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Global variables
let currentFilter = 'all';

// Enhanced delete confirmation
function confirmDelete(trainingId, trainingTitle) {
    const form = document.getElementById('deleteForm');
    const titleElement = document.getElementById('deleteTitle');
    
    form.action = `/admin/trainings/${trainingId}`;
    titleElement.textContent = `Hapus "${trainingTitle}"?`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Toggle quick stats panel
function toggleQuickStats() {
    const panel = document.getElementById('quickStats');
    panel.classList.toggle('show');
}

// Filter trainings function
function filterTrainings(filterType) {
    currentFilter = filterType;
    
    // Update active tab
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    const activeTab = document.querySelector(`[data-filter="${filterType}"]`);
    if (activeTab) {
        activeTab.classList.add('active');
    }
    
    // Filter cards
    const trainingCards = document.querySelectorAll('.training-card');
    let visibleCount = 0;
    
    trainingCards.forEach(card => {
        const cardStatus = card.getAttribute('data-status');
        const shouldShow = filterType === 'all' || cardStatus === filterType;
        
        const cardContainer = card.closest('.col-xl-4, .col-lg-6');
        if (shouldShow) {
            cardContainer.style.display = 'block';
            setTimeout(() => {
                cardContainer.style.opacity = '1';
                cardContainer.style.transform = 'translateY(0)';
            }, 50);
            visibleCount++;
        } else {
            cardContainer.style.opacity = '0';
            cardContainer.style.transform = 'translateY(20px)';
            setTimeout(() => {
                cardContainer.style.display = 'none';
            }, 300);
        }
    });
    
    // Update empty state
    updateEmptyState(visibleCount, filterType);
}

// Update empty state
function updateEmptyState(visibleCount, filterType = 'all') {
    const existingEmpty = document.querySelector('.empty-state-dynamic');
    
    if (visibleCount === 0 && currentFilter !== 'all') {
        if (!existingEmpty) {
            const trainingCardsContainer = document.getElementById('trainingCards');
            const emptyDiv = document.createElement('div');
            emptyDiv.className = 'col-12 empty-state-dynamic';
            
            let filterText = '';
            switch(filterType) {
                case 'upcoming': filterText = 'akan datang'; break;
                case 'ongoing': filterText = 'berlangsung'; break;
                case 'completed': filterText = 'selesai'; break;
                default: filterText = 'yang dipilih';
            }
            
            emptyDiv.innerHTML = `
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-filter"></i>
                    </div>
                    <h5 class="empty-title">Tidak ada pelatihan ${filterText}</h5>
                    <p class="empty-subtitle">Belum ada pelatihan dengan status ${filterText} saat ini.</p>
                    <button class="btn btn-outline-primary" onclick="filterTrainings('all')" style="border-radius: 12px;">
                        <i class="fas fa-list me-2"></i>Tampilkan Semua Pelatihan
                    </button>
                </div>
            `;
            trainingCardsContainer.appendChild(emptyDiv);
        }
    } else if (existingEmpty) {
        existingEmpty.remove();
    }
}

// Perform search function
function performSearch() {
    const searchValue = document.querySelector('.search-input').value.toLowerCase();
    const trainingCards = document.querySelectorAll('.training-card');
    
    let visibleCount = 0;
    
    trainingCards.forEach(card => {
        const cardStatus = card.getAttribute('data-status');
        const title = card.getAttribute('data-title') || '';
        const location = card.getAttribute('data-location') || '';
        const description = card.getAttribute('data-description') || '';
        
        // Check filter criteria
        let matchesFilter = (currentFilter === 'all') || (cardStatus === currentFilter);
        
        // Check search criteria
        let matchesSearch = !searchValue || 
                           title.includes(searchValue) || 
                           location.includes(searchValue) || 
                           description.includes(searchValue);
        
        const cardContainer = card.closest('.col-xl-4, .col-lg-6');
        
        // Show/hide item
        if (matchesFilter && matchesSearch) {
            cardContainer.style.display = 'block';
            cardContainer.style.opacity = '1';
            cardContainer.style.transform = 'translateY(0)';
            visibleCount++;
        } else {
            cardContainer.style.display = 'none';
        }
    });
    
    // Update empty state for search
    updateSearchEmptyState(visibleCount, searchValue);
}

// Update search empty state
function updateSearchEmptyState(visibleCount, searchValue) {
    const existingEmpty = document.querySelector('.empty-state-dynamic');
    
    if (visibleCount === 0 && searchValue) {
        if (!existingEmpty) {
            const trainingCardsContainer = document.getElementById('trainingCards');
            const emptyDiv = document.createElement('div');
            emptyDiv.className = 'col-12 empty-state-dynamic';
            emptyDiv.innerHTML = `
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h5 class="empty-title">Tidak ada hasil ditemukan</h5>
                    <p class="empty-subtitle">Tidak ada pelatihan yang cocok dengan pencarian "<strong>${searchValue}</strong>".</p>
                    <button class="btn btn-outline-primary me-2" onclick="document.querySelector('.search-input').value=''; performSearch();" style="border-radius: 12px;">
                        <i class="fas fa-times me-2"></i>Hapus Pencarian
                    </button>
                    <button class="btn btn-outline-primary" onclick="filterTrainings('all')" style="border-radius: 12px;">
                        <i class="fas fa-list me-2"></i>Tampilkan Semua
                    </button>
                </div>
            `;
            trainingCardsContainer.appendChild(emptyDiv);
        }
    } else if (existingEmpty && !searchValue) {
        existingEmpty.remove();
    }
}

// Enhanced search functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Set initial filter based on URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const statusParam = urlParams.get('status');
    if (statusParam && ['upcoming', 'ongoing', 'completed'].includes(statusParam)) {
        currentFilter = statusParam;
        filterTrainings(statusParam);
    }

    // Search functionality
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        searchInput.addEventListener('input', function() {
            // Real-time search as user types
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                performSearch();
            }, 300);
        });

        // Auto-focus search input
        searchInput.focus();
    }

    // Search icon click
    const searchIcon = document.querySelector('.search-icon');
    if (searchIcon) {
        searchIcon.addEventListener('click', performSearch);
    }

    // Add smooth transitions to cards
    document.querySelectorAll('.training-card').forEach(card => {
        const container = card.closest('.col-xl-4, .col-lg-6');
        container.style.transition = 'all 0.3s ease';
    });

    // Animate progress bars
    const progressBars = document.querySelectorAll('.progress-fill');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0';
        setTimeout(() => {
            bar.style.width = width;
        }, 500);
    });

    // Card hover effects
    const trainingCards = document.querySelectorAll('.training-card');
    trainingCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-12px) rotateX(5deg)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) rotateX(0)';
        });
    });

    // Lazy loading effect for cards
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const cardObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Apply observer to cards
    document.querySelectorAll('.fade-in').forEach(card => {
        cardObserver.observe(card);
    });

    // Auto-hide quick stats after 10 seconds
    setTimeout(() => {
        const quickStats = document.getElementById('quickStats');
        if (quickStats.classList.contains('show')) {
            quickStats.classList.remove('show');
        }
    }, 10000);

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + K for quick search focus
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            searchInput.focus();
            searchInput.select();
        }
        
        // ESC to clear search
        if (e.key === 'Escape' && document.activeElement === searchInput) {
            searchInput.value = '';
            performSearch();
            searchInput.blur();
        }
    });
});

// Add loading states to buttons
document.querySelectorAll('.btn-action').forEach(button => {
    if (button.tagName === 'A') return;
    
    button.addEventListener('click', function() {
        const icon = this.querySelector('i');
        const originalIcon = icon.className;
        icon.className = 'fas fa-spinner fa-spin';
        
        setTimeout(() => {
            icon.className = originalIcon;
        }, 1000);
    });
});

// Enhanced modal animations
document.getElementById('deleteModal').addEventListener('show.bs.modal', function () {
    this.querySelector('.modal-content').style.transform = 'scale(0.8)';
    this.querySelector('.modal-content').style.opacity = '0';
    
    setTimeout(() => {
        this.querySelector('.modal-content').style.transition = 'all 0.3s ease';
        this.querySelector('.modal-content').style.transform = 'scale(1)';
        this.querySelector('.modal-content').style.opacity = '1';
    }, 50);
});

// Add ripple effect to buttons
document.querySelectorAll('.btn-action, .filter-tab').forEach(button => {
    button.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.style.position = 'absolute';
        ripple.style.borderRadius = '50%';
        ripple.style.background = 'rgba(255, 255, 255, 0.3)';
        ripple.style.transform = 'scale(0)';
        ripple.style.animation = 'ripple 0.6s linear';
        ripple.style.pointerEvents = 'none';
        
        this.style.position = 'relative';
        this.style.overflow = 'hidden';
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});

console.log('Enhanced Training Management with Working Filters loaded successfully!');
</script>

@endsection