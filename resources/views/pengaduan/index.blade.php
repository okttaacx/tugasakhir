@extends('layouts.appuser')

@section('title', 'Pengaduan Saya - Dinas Tenaga Kerja Kota Batu')

@push('styles')
<style>
    :root {
        --primary-blue: #013e7e;
        --secondary-blue: #0056b3;
        --accent-blue: #007bff;
        --text-white: #ffffff;
        --text-light: rgba(255,255,255,0.8);
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
    }

    body {
        background: linear-gradient(135deg, var(--metallic-silver) 0%, #f7fafc 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .header-section {
        background: linear-gradient(135deg, 
            rgba(1, 62, 126, 0.95) 0%, 
            rgba(0, 86, 179, 0.9) 50%, 
            rgba(0, 123, 255, 0.85) 100%
        );
        color: var(--text-white);
        padding: 4rem 0 2rem;
        position: relative;
        overflow: hidden;
    }

    .header-section::before {
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
            rgba(255, 255, 255, 0.03) 2px,
            rgba(255, 255, 255, 0.03) 4px
        );
    }

    .header-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .header-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }

    .header-subtitle {
        font-size: 1.2rem;
        color: var(--text-light);
        margin-bottom: 2rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--warning-orange), #ff9500);
        border: none;
        border-radius: 25px;
        padding: 12px 28px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
        box-shadow: 0 4px 16px rgba(255, 140, 0, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(255, 140, 0, 0.4);
    }

    .complaint-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: none;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        position: relative;
        overflow: hidden;
        transition: var(--transition);
        margin-bottom: 2rem;
    }

    .complaint-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, 
            var(--primary-blue) 0%, 
            var(--accent-blue) 50%, 
            var(--warning-orange) 100%);
        border-radius: 16px 16px 0 0;
    }

    .complaint-card:hover {
        transform: translateY(-8px) scale(1.01);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .table-container {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        overflow: hidden;
        position: relative;
    }

    .table-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, 
            var(--primary-blue) 0%, 
            var(--accent-blue) 50%, 
            var(--warning-orange) 100%);
    }

    .table thead th {
        background: linear-gradient(135deg, var(--dark-steel), var(--steel-gray));
        color: var(--text-white);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem;
        border: none;
    }

    .table tbody td {
        padding: 1rem;
        border: none;
        border-bottom: 1px solid rgba(1, 62, 126, 0.1);
    }

    .table tbody tr:hover {
        background: linear-gradient(145deg, #f8fafc 0%, #e2e8f0 100%);
        transform: scale(1.01);
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background: linear-gradient(135deg, var(--industrial-yellow), #ffd700);
        color: var(--carbon-black);
    }

    .status-replied {
        background: linear-gradient(135deg, var(--success-green), #48bb78);
        color: var(--text-white);
    }

    .btn-detail {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        color: var(--text-white);
        border: none;
        border-radius: 20px;
        padding: 0.5rem 1rem;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(1, 62, 126, 0.3);
        color: var(--text-white);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--light-steel);
        margin-bottom: 1rem;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
    }

    .alert-success {
        background: linear-gradient(135deg, rgba(56, 161, 105, 0.1), rgba(72, 187, 120, 0.05));
        border: 2px solid var(--success-green);
        border-radius: 12px;
        color: var(--dark-steel);
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
        position: relative;
    }

    .alert-success::before {
        content: '\f00c';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--success-green);
    }

    .alert-success .alert-content {
        margin-left: 2rem;
    }
</style>
@endpush

@section('content')
<!-- Header Section -->
<div class="header-section">
    <div class="container">
        <div class="header-content">
            <div class="d-flex align-items-center justify-content-center mb-4">
                <i class="fas fa-exclamation-triangle mr-3" style="font-size: 3rem; color: var(--warning-orange);"></i>
                <h1 class="header-title mb-0">Pengaduan Ketenagakerjaan</h1>
            </div>
            <p class="header-subtitle">Kelola dan pantau pengaduan Anda terkait masalah ketenagakerjaan</p>
            <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i>Buat Pengaduan Baru
            </a>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container py-5">
    @if(session('success'))
    <div class="alert-success">
        <div class="alert-content">
            <strong>Berhasil!</strong> {{ session('success') }}
        </div>
    </div>
    @endif

    @if($pengaduan->count() > 0)
    <div class="table-container">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th><i class="fas fa-calendar-alt mr-2"></i>Tanggal</th>
                        <th><i class="fas fa-building mr-2"></i>Institusi</th>
                        <th><i class="fas fa-clipboard-list mr-2"></i>Masalah</th>
                        <th><i class="fas fa-info-circle mr-2"></i>Status</th>
                        <th><i class="fas fa-cogs mr-2"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengaduan as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clock mr-2" style="color: var(--primary-blue);"></i>
                                <div>
                                    <div class="font-weight-bold">{{ $item->created_at->format('d/m/Y') }}</div>
                                    <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="font-weight-bold" style="color: var(--dark-steel);">{{ $item->institusi }}</div>
                            <small class="text-muted">{{ $item->nama_lengkap }}</small>
                        </td>
                        <td>
                            <div class="text-truncate" style="max-width: 200px;" title="{{ $item->masalah_pengaduan }}">
                                {{ Str::limit($item->masalah_pengaduan, 80) }}
                            </div>
                        </td>
                        <td>
                            @if($item->status === 'pending')
                            <span class="status-badge status-pending">
                                <i class="fas fa-hourglass-half mr-1"></i>Menunggu
                            </span>
                            @else
                            <span class="status-badge status-replied">
                                <i class="fas fa-check-circle mr-1"></i>Dibalas
                            </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('pengaduan.show', $item->id) }}" class="btn btn-detail btn-sm">
                                <i class="fas fa-eye mr-1"></i>Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="empty-state">
        <i class="fas fa-inbox empty-icon"></i>
        <h3 style="color: var(--dark-steel); margin-bottom: 1rem;">Belum Ada Pengaduan</h3>
        <p class="text-muted mb-4">Anda belum memiliki pengaduan ketenagakerjaan. Buat pengaduan pertama Anda untuk melaporkan masalah yang Anda hadapi.</p>
        <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>Buat Pengaduan Pertama
        </a>
    </div>
    @endif
</div>

<script>
$(document).ready(function() {
    // Animate cards on scroll
    $('.complaint-card, .table-container').each(function(index) {
        $(this).css({
            'opacity': '0',
            'transform': 'translateY(30px)'
        }).delay(index * 100).animate({
            'opacity': '1'
        }, 600).css('transform', 'translateY(0)');
    });

    // Enhanced hover effects
    $('.table tbody tr').hover(
        function() {
            $(this).find('.btn-detail').css('transform', 'scale(1.05)');
        },
        function() {
            $(this).find('.btn-detail').css('transform', 'scale(1)');
        }
    );
});
</script>
@endsection