@extends('layouts.adminapp')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="container-fluid" style="margin: 3rem 1.5rem;">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-header-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="page-title-section">
                        <h2 class="page-title">
                            <i class="fas fa-comment-dots me-3"></i>
                            Detail Pengaduan #{{ $pengaduan->id }}
                        </h2>
                        <p class="page-subtitle">Kelola dan berikan tanggapan terhadap pengaduan</p>
                    </div>
                    <div class="page-actions">
                        <a href="{{ route('admin.pengaduan.index') }}" class="btn-industrial">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-industrial success mb-4" role="alert">
            <div class="alert-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="alert-content">
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <div class="row">
        <!-- Detail Pengaduan -->
        <div class="col-lg-8">
            <!-- Status & Timeline Card -->
            <div class="status-timeline-card mb-4">
                <div class="card-header-industrial">
                    <h5 class="card-title">
                        <i class="fas fa-chart-line me-2"></i>Status & Timeline
                    </h5>
                </div>
                <div class="card-body">
                    <div class="status-display">
                        <div class="status-badge-container">
                            @if($pengaduan->status == 'pending')
                                <span class="status-badge warning">
                                    <i class="fas fa-clock me-2"></i>Menunggu Tanggapan
                                </span>
                            @elseif($pengaduan->status == 'dibalas')
                                <span class="status-badge success">
                                    <i class="fas fa-check-circle me-2"></i>Sudah Dibalas
                                </span>
                            @else
                                <span class="status-badge secondary">
                                    <i class="fas fa-info-circle me-2"></i>{{ ucfirst($pengaduan->status) }}
                                </span>
                            @endif
                        </div>
                        <div class="timeline-info">
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Diterima: {{ $pengaduan->created_at->format('d F Y, H:i') }}
                            </small>
                            @if($pengaduan->tanggal_balasan)
                                <small class="text-muted ms-3">
                                    <i class="fas fa-reply me-1"></i>
                                    Dibalas: {{ $pengaduan->tanggal_balasan->format('d F Y, H:i') }}
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Pengaduan -->
            <div class="detail-card mb-4">
                <div class="card-header-industrial">
                    <h5 class="card-title">
                        <i class="fas fa-info-circle me-2"></i>Informasi Pengaduan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <label class="info-label">
                                <i class="fas fa-user me-2"></i>Nama Lengkap
                            </label>
                            <div class="info-value">{{ $pengaduan->nama_lengkap }}</div>
                        </div>
                        
                        <div class="info-item">
                            <label class="info-label">
                                <i class="fas fa-building me-2"></i>Institusi
                            </label>
                            <div class="info-value">{{ $pengaduan->institusi }}</div>
                        </div>
                        
                        <div class="info-item">
                            <label class="info-label">
                                <i class="fas fa-map-marker-alt me-2"></i>Alamat Institusi
                            </label>
                            <div class="info-value">{{ $pengaduan->alamat_institusi }}</div>
                        </div>
                        
                        <div class="info-item">
                            <label class="info-label">
                                <i class="fas fa-phone me-2"></i>No. Telepon
                            </label>
                            <div class="info-value">{{ $pengaduan->no_telp }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Isi Pengaduan -->
            <div class="detail-card mb-4">
                <div class="card-header-industrial">
                    <h5 class="card-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>Isi Pengaduan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="pengaduan-content">
                        <div class="content-box">
                            {{ $pengaduan->masalah_pengaduan }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Balasan Admin -->
            @if($pengaduan->balasan_admin)
                <div class="detail-card">
                    <div class="card-header-industrial success">
                        <h5 class="card-title">
                            <i class="fas fa-reply me-2"></i>Balasan Admin
                        </h5>
                        <small class="header-timestamp">
                            <i class="fas fa-clock me-1"></i>
                            {{ $pengaduan->tanggal_balasan->format('d F Y, H:i') }}
                        </small>
                    </div>
                    <div class="card-body">
                        <div class="balasan-content">
                            <div class="content-box success">
                                {{ $pengaduan->balasan_admin }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Form Balasan -->
            <div class="detail-card mb-4">
                <div class="card-header-industrial primary">
                    <h5 class="card-title">
                        <i class="fas fa-paper-plane me-2"></i>
                        @if($pengaduan->balasan_admin)
                            Perbarui Balasan
                        @else
                            Berikan Balasan
                        @endif
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pengaduan.reply', $pengaduan->id) }}" method="POST" class="reply-form">
                        @csrf
                        <div class="form-group-industrial mb-4">
                            <label for="balasan_admin" class="form-label">
                                <i class="fas fa-comment-medical me-2"></i>Balasan
                            </label>
                            <textarea 
                                class="form-control-industrial @error('balasan_admin') is-invalid @enderror" 
                                id="balasan_admin" 
                                name="balasan_admin" 
                                rows="8" 
                                placeholder="Tulis balasan yang profesional dan membantu untuk pengaduan ini..."
                                required>{{ old('balasan_admin', $pengaduan->balasan_admin) }}</textarea>
                            
                            @error('balasan_admin')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn-industrial-primary w-100">
                            <i class="fas fa-paper-plane me-2"></i>
                            @if($pengaduan->balasan_admin)
                                Perbarui Balasan
                            @else
                                Kirim Balasan
                            @endif
                        </button>
                    </form>
                </div>
            </div>

            <!-- Info User -->
            <div class="detail-card">
                <div class="card-header-industrial">
                    <h6 class="card-title">
                        <i class="fas fa-user-circle me-2"></i>Informasi Pengguna
                    </h6>
                </div>
                <div class="card-body">
                    <div class="user-info">
                        <div class="user-avatar">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div class="user-details">
                            <div class="user-info-item">
                                <label>
                                    <i class="fas fa-user me-2"></i>Nama
                                </label>
                                <span>{{ $pengaduan->user->name ?? 'N/A' }}</span>
                            </div>
                            <div class="user-info-item">
                                <label>
                                    <i class="fas fa-envelope me-2"></i>Email
                                </label>
                                <span>{{ $pengaduan->user->email ?? 'N/A' }}</span>
                            </div>
                            <div class="user-info-item">
                                <label>
                                    <i class="fas fa-calendar-plus me-2"></i>Bergabung
                                </label>
                                <span>{{ $pengaduan->user->created_at->format('d F Y') ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Enhanced Page Header */
    .page-header-card {
        background: linear-gradient(135deg, 
            var(--primary-blue) 0%, 
            var(--secondary-blue) 50%, 
            var(--dark-steel) 100%);
        padding: 2rem;
        border-radius: 16px;
        color: var(--text-white);
        box-shadow: 0 8px 32px rgba(1, 62, 126, 0.15);
        border: 1px solid rgba(255, 140, 0, 0.2);
        position: relative;
        overflow: hidden;
    }

    .page-header-card::before {
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
        pointer-events: none;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .page-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 0;
    }

    .btn-industrial {
        background: linear-gradient(145deg, 
            rgba(255, 140, 0, 0.9) 0%, 
            rgba(255, 140, 0, 0.7) 100%);
        border: 2px solid var(--warning-orange);
        color: var(--text-white);
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        display: inline-flex;
        align-items: center;
    }

    .btn-industrial:hover {
        background: linear-gradient(145deg, 
            var(--warning-orange) 0%, 
            rgba(255, 140, 0, 0.8) 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 140, 0, 0.3);
        color: var(--text-white);
    }

    /* Enhanced Alert */
    .alert-industrial {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: none;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        position: relative;
        overflow: hidden;
    }

    .alert-industrial.success {
        border-left: 4px solid var(--success-green);
    }

    .alert-industrial.success::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--success-green);
    }

    .alert-icon {
        background: var(--success-green);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .alert-content {
        flex: 1;
    }

    .alert-close {
        background: none;
        border: none;
        color: #6c757d;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .alert-close:hover {
        background: rgba(108, 117, 125, 0.1);
        color: #495057;
    }

    /* Enhanced Cards */
    .detail-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(1, 62, 126, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .detail-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
    }

    .card-header-industrial {
        background: linear-gradient(135deg, 
            var(--steel-gray) 0%, 
            var(--dark-steel) 100%);
        color: var(--text-white);
        padding: 1.25rem 1.5rem;
        border-bottom: 2px solid var(--warning-orange);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header-industrial.success {
        background: linear-gradient(135deg, 
            var(--success-green) 0%, 
            #2f855a 100%);
    }

    .card-header-industrial.primary {
        background: linear-gradient(135deg, 
            var(--primary-blue) 0%, 
            var(--secondary-blue) 100%);
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .header-timestamp {
        opacity: 0.9;
        font-size: 0.875rem;
    }

    /* Status Display */
    .status-timeline-card .card-body {
        padding: 1.5rem;
    }

    .status-display {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .status-badge {
        padding: 0.75rem 1.25rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .status-badge.warning {
        background: linear-gradient(135deg, var(--industrial-yellow) 0%, #f59e0b 100%);
        color: #92400e;
    }

    .status-badge.success {
        background: linear-gradient(135deg, var(--success-green) 0%, #10b981 100%);
        color: white;
    }

    .status-badge.secondary {
        background: linear-gradient(135deg, var(--light-steel) 0%, var(--steel-gray) 100%);
        color: white;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        padding: 1.5rem;
    }

    .info-item {
        padding: 1rem;
        background: linear-gradient(145deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 12px;
        border-left: 4px solid var(--warning-orange);
        transition: all 0.3s ease;
    }

    .info-item:hover {
        transform: translateX(4px);
        box-shadow: 0 4px 15px rgba(255, 140, 0, 0.2);
    }

    .info-label {
        font-weight: 600;
        color: var(--dark-steel);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        color: var(--carbon-black);
        font-size: 1rem;
        font-weight: 500;
        word-break: break-word;
    }

    /* Content Boxes */
    .content-box {
        background: linear-gradient(145deg, #f8fafc 0%, #e2e8f0 100%);
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem;
        line-height: 1.7;
        color: var(--carbon-black);
        font-size: 1rem;
        margin: 1.5rem;
        position: relative;
        overflow: hidden;
    }

    .content-box.success {
        background: linear-gradient(145deg, #f0fff4 0%, #dcfce7 100%);
        border-color: var(--success-green);
        border-left: 4px solid var(--success-green);
    }

    .content-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--warning-orange);
        opacity: 0.3;
    }

    .content-box.success::before {
        background: var(--success-green);
    }

    /* Form Enhancements */
    .form-group-industrial {
        position: relative;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark-steel);
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control-industrial {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        line-height: 1.6;
        color: var(--carbon-black);
        transition: all 0.3s ease;
        resize: vertical;
    }

    .form-control-industrial:focus {
        outline: none;
        border-color: var(--warning-orange);
        box-shadow: 0 0 0 0.2rem rgba(255, 140, 0, 0.25);
        background: #ffffff;
    }

    .form-control-industrial.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .invalid-feedback {
        background: linear-gradient(145deg, #fef2f2 0%, #fecaca 100%);
        color: #dc2626;
        font-size: 0.875rem;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
    }

    .btn-industrial-primary {
        background: linear-gradient(135deg, 
            var(--primary-blue) 0%, 
            var(--secondary-blue) 100%);
        border: 2px solid var(--primary-blue);
        color: var(--text-white);
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-industrial-primary:hover {
        background: linear-gradient(135deg, 
            var(--secondary-blue) 0%, 
            var(--primary-blue) 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(1, 62, 126, 0.3);
    }

    /* User Info */
    .user-info {
        padding: 1.5rem;
    }

    .user-avatar {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .user-avatar i {
        font-size: 3rem;
        color: var(--steel-gray);
    }

    .user-info-item {
        display: flex;
        justify-content: space-between;
        align-items: start;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e2e8f0;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .user-info-item:last-child {
        border-bottom: none;
    }

    .user-info-item label {
        font-weight: 600;
        color: var(--dark-steel);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        min-width: 100px;
    }

    .user-info-item span {
        color: var(--carbon-black);
        font-weight: 500;
        word-break: break-word;
        text-align: right;
        flex: 1;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .status-display {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .page-header-card {
            padding: 1.5rem;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .page-header-card .d-flex {
            flex-direction: column;
            gap: 1rem;
        }
        
        .page-actions {
            width: 100%;
        }
        
        .btn-industrial {
            width: 100%;
            justify-content: center;
        }
        
        .user-info-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .user-info-item span {
            text-align: left;
        }
    }
</style>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush