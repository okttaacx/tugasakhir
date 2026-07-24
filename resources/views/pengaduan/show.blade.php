@extends('layouts.appuser')

@section('title', 'Detail Pengaduan - Dinas Tenaga Kerja Kota Batu')

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
            rgba(1, 62, 126, 0.9) 0%, 
            rgba(0, 86, 179, 0.85) 50%, 
            rgba(0, 123, 255, 0.8) 100%
        );
        color: var(--text-white);
        padding: 2rem 0;
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
    }

    .back-button {
        background: linear-gradient(135deg, var(--warning-orange), #ff9500);
        color: var(--text-white);
        border: none;
        border-radius: 20px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: var(--transition);
        box-shadow: 0 4px 16px rgba(255, 140, 0, 0.3);
        margin-bottom: 1rem;
    }

    .back-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(255, 140, 0, 0.4);
        color: var(--text-white);
        text-decoration: none;
    }

    .header-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }

    .detail-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: none;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
        transition: var(--transition);
    }

    .detail-card::before {
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

    .card-section {
        padding: 2rem;
        border-bottom: 1px solid rgba(1, 62, 126, 0.1);
    }

    .card-section:last-child {
        border-bottom: none;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--dark-steel);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
    }

    .section-title i {
        margin-right: 0.75rem;
        color: var(--primary-blue);
        font-size: 1.5rem;
    }

    .info-item {
        display: flex;
        margin-bottom: 1rem;
        align-items: flex-start;
    }

    .info-label {
        font-weight: 600;
        color: var(--steel-gray);
        min-width: 120px;
        margin-right: 1rem;
    }

    .info-value {
        color: var(--dark-steel);
        flex: 1;
    }

    .status-badge {
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .status-pending {
        background: linear-gradient(135deg, var(--industrial-yellow), #ffd700);
        color: var(--carbon-black);
    }

    .status-replied {
        background: linear-gradient(135deg, var(--success-green), #48bb78);
        color: var(--text-white);
    }

    .content-box {
        background: linear-gradient(145deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 12px;
        padding: 1.5rem;
        border-left: 4px solid var(--primary-blue);
        margin-top: 1rem;
    }

    .reply-box {
        background: linear-gradient(145deg, rgba(0, 123, 255, 0.05) 0%, rgba(0, 86, 179, 0.03) 100%);
        border-radius: 12px;
        padding: 1.5rem;
        border-left: 4px solid var(--accent-blue);
        margin-top: 1rem;
    }

    .timestamp {
        color: var(--light-steel);
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
    }

    .timestamp i {
        margin-right: 0.5rem;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    @media (max-width: 768px) {
        .grid-2 {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .header-title {
            font-size: 2rem;
        }
        
        .card-section {
            padding: 1.5rem;
        }
    }

    /* Animation */
    .detail-card {
        opacity: 1;
        transform: translateY(0);
        animation: none;
    }
    
    .detail-card:hover {
        transform: translateY(-4px) scale(1.005);
    }
    
    .fade-in {
        animation: fadeIn 0.6s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@section('content')
<!-- Header Section -->
<div class="header-section">
    <div class="container">
        <div class="header-content">
            <a href="{{ route('pengaduan.index') }}" class="back-button">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
            </a>
            <div class="d-flex align-items-center">
                <i class="fas fa-file-alt mr-3" style="font-size: 2.5rem; color: var(--warning-orange);"></i>
                <h1 class="header-title mb-0">Detail Pengaduan</h1>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container py-5">
    <!-- Status & Basic Info Card -->
    <div class="detail-card">
        <div class="card-section">
            <h2 class="section-title">
                <i class="fas fa-info-circle"></i>
                Status & Informasi Dasar
            </h2>
            <div class="grid-2">
                <div>
                    <div class="info-item">
                        <span class="info-label">Status:</span>
                        <div class="info-value">
                            @if($pengaduan->status === 'pending')
                            <span class="status-badge status-pending">
                                <i class="fas fa-hourglass-half mr-2"></i>Menunggu Balasan
                            </span>
                            @else
                            <span class="status-badge status-replied">
                                <i class="fas fa-check-circle mr-2"></i>Sudah Dibalas
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal:</span>
                        <span class="info-value">
                            <i class="fas fa-calendar-alt mr-2" style="color: var(--primary-blue);"></i>
                            {{ $pengaduan->created_at->format('d/m/Y H:i') }}
                        </span>
                    </div>
                </div>
                <div>
                    <div class="info-item">
                        <span class="info-label">ID Pengaduan:</span>
                        <span class="info-value">
                            <code style="background: var(--metallic-silver); padding: 0.25rem 0.5rem; border-radius: 4px;">
                                #{{ str_pad($pengaduan->id, 6, '0', STR_PAD_LEFT) }}
                            </code>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Personal Information Card -->
    <div class="detail-card">
        <div class="card-section">
            <h2 class="section-title">
                <i class="fas fa-user"></i>
                Informasi Pengadu
            </h2>
            <div class="grid-2">
                <div>
                    <div class="info-item">
                        <span class="info-label">Nama Lengkap:</span>
                        <span class="info-value">{{ $pengaduan->nama_lengkap }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">No. Telepon:</span>
                        <span class="info-value">
                            <i class="fas fa-phone mr-2" style="color: var(--success-green);"></i>
                            {{ $pengaduan->no_telp }}
                        </span>
                    </div>
                </div>
                <div>
                    <div class="info-item">
                        <span class="info-label">Institusi:</span>
                        <span class="info-value">
                            <i class="fas fa-building mr-2" style="color: var(--primary-blue);"></i>
                            {{ $pengaduan->institusi }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Address Card -->
    <div class="detail-card">
        <div class="card-section">
            <h2 class="section-title">
                <i class="fas fa-map-marker-alt"></i>
                Alamat Institusi
            </h2>
            <div class="content-box">
                <p class="mb-0">{{ $pengaduan->alamat_institusi }}</p>
            </div>
        </div>
    </div>

    <!-- Complaint Details Card -->
    <div class="detail-card">
        <div class="card-section">
            <h2 class="section-title">
                <i class="fas fa-exclamation-triangle"></i>
                Detail Masalah Pengaduan
            </h2>
            <div class="content-box">
                <p class="mb-0 text-justify" style="line-height: 1.6; white-space: pre-line;">{{ $pengaduan->masalah_pengaduan }}</p>
            </div>
        </div>
    </div>

    <!-- Admin Reply Card -->
    @if($pengaduan->balasan_admin)
    <div class="detail-card">
        <div class="card-section">
            <h2 class="section-title">
                <i class="fas fa-reply"></i>
                Balasan Admin
            </h2>
            <div class="reply-box">
                <p class="mb-0 text-justify" style="line-height: 1.6; white-space: pre-line;">{{ $pengaduan->balasan_admin }}</p>
                <div class="timestamp">
                    <i class="fas fa-clock"></i>
                    Dibalas pada: {{ $pengaduan->tanggal_balasan->format('d/m/Y H:i') }}
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="detail-card">
        <div class="card-section text-center">
            <i class="fas fa-hourglass-half" style="font-size: 3rem; color: var(--light-steel); margin-bottom: 1rem;"></i>
            <h3 style="color: var(--dark-steel); margin-bottom: 0.5rem;">Menunggu Balasan Admin</h3>
            <p class="text-muted">Pengaduan Anda sedang dalam proses review. Kami akan segera memberikan balasan.</p>
        </div>
    </div>
    @endif
</div>

<script>
$(document).ready(function() {
    // Add smooth hover effects
    $('.detail-card').hover(
        function() {
            $(this).css('transform', 'translateY(-4px) scale(1.005)');
        },
        function() {
            $(this).css('transform', 'translateY(0) scale(1)');
        }
    );

    // Add click effect to back button
    $('.back-button').on('click', function(e) {
        $(this).css('transform', 'scale(0.95)');
        setTimeout(() => {
            $(this).css('transform', '');
        }, 150);
    });
});
</script>
@endsection