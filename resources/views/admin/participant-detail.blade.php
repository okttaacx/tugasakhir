@extends('layouts.adminapp')

@section('title', 'Detail Peserta')

@section('content')
<div class="container-fluid py-5">
    <!-- Header Section -->
    <header class="mb-5">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.participant.index') }}">Peserta</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $participant->name }}</li>
                    </ol>
                    <h1 class="page-title">Detail Peserta</h1>
                </div>
                <div class="action-buttons">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <a href="{{ route('admin.participant.confirmDelete', $participant->user_id) }}" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </a>
                </div>
            </div>
        </header>

    <!-- Profile Card -->
    <div class="card profile-card mb-5">
        <div class="profile-banner"></div>
        <div class="profile-content p-4">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="profile-image-wrapper">
                        <img src="{{ $participant->profile && $participant->profile->foto ? asset('storage/' . $participant->profile->foto) : asset('image/default_profile.jpg') }}" 
                             alt="{{ $participant->name }}'s Profile" 
                             class="profile-image" style="width: 9rem;">
                        <span class="profile-status"></span>
                    </div>
                </div>
                <div class="col">
                    <h2 class="profile-name mb-1">{{ $participant->name }}</h2>
                    <p class="profile-email mb-2">{{ $participant->email }}</p>
                    <div class="profile-stats d-flex gap-4">
                        <div class="stat-item">
                            <i class="fas fa-calendar-alt me-2"></i>
                            <span>Bergabung {{ $participant->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-graduation-cap me-2"></i>
                            <span>{{ $registrations->count() }} Pelatihan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="card">
        <div class="card-header p-0">
            <ul class="nav nav-tabs" id="participantTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" role="tab">
                        <i class="fas fa-user me-2"></i>Informasi Pribadi
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" role="tab">
                        <i class="fas fa-file-alt me-2"></i>Dokumen
                        @if($documents && ($documents->ktp || $documents->kk || $documents->ijazah || $documents->ak1))
                            <span class="badge bg-success ms-2">{{ collect(['ktp', 'kk', 'ijazah', 'ak1'])->filter(fn($doc) => $documents->$doc)->count() }}</span>
                        @endif
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="trainings-tab" data-bs-toggle="tab" data-bs-target="#trainings" role="tab">
                        <i class="fas fa-chalkboard-teacher me-2"></i>Pelatihan
                        @if($registrations->count() > 0)
                            <span class="badge bg-primary ms-2">{{ $registrations->count() }}</span>
                        @endif
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tabs Content -->
        <div class="card-body tab-content" id="participantTabsContent">
            <!-- Personal Information -->
            <div class="tab-pane fade show active" id="personal" role="tabpanel">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="info-card">
                            <h4 class="info-card-title"><i class="fas fa-id-card me-2"></i>Data Pribadi</h4>
                            <div class="info-group">
                                <div class="info-item">
                                    <span class="info-label">NIK</span>
                                    <span class="info-value">{{ $participant->nik ?? 'Belum diisi' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Tanggal Lahir</span>
                                    <span class="info-value">{{ $participant->ttl ?? 'Belum diisi' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Gender</span>
                                    <span class="info-value">{{ $participant->gender ?? 'Belum diisi' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Pendidikan</span>
                                    <span class="info-value">{{ $participant->pendidikan ?? 'Belum diisi' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-card">
                            <h4 class="info-card-title"><i class="fas fa-map-marker-alt me-2"></i>Informasi Kontak</h4>
                            <div class="info-group">
                                <div class="info-item">
                                    <span class="info-label">Alamat</span>
                                    <span class="info-value">{{ collect([$participant->jalan, $participant->desa, $participant->kecamatan])->filter()->implode(', ') ?: 'Belum diisi' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">No. Telepon</span>
                                    <span class="info-value">{{ $participant->nomor ?? 'Belum diisi' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Email</span>
                                    <span class="info-value">{{ $participant->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents -->
            <div class="tab-pane fade" id="documents" role="tabpanel">
                <div class="row g-4 mb-4">
                    @foreach(['ktp' => 'KTP', 'kk' => 'Kartu Keluarga', 'ijazah' => 'Ijazah Terakhir', 'ak1' => 'AK1'] as $docType => $docName)
                        <div class="col-md-6 col-xl-3">
                            <div class="document-card">
                                <div class="document-header">
                                    <i class="fas fa-file-alt"></i>
                                    <h5>{{ $docName }}</h5>
                                </div>
                                <div class="document-body">
                                    @if($documents && $documents->$docType)
                                        <span class="document-status text-success">
                                            <i class="fas fa-check-circle me-1"></i>Tersedia
                                        </span>
                                        <button class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#{{ $docType }}Modal">
                                            <i class="fas fa-eye me-1"></i>Lihat
                                        </button>
                                    @else
                                        <span class="document-status text-muted">
                                            <i class="fas fa-times-circle me-1"></i>Belum Ada
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($documents && $documents->$docType)
                            <div class="modal fade" id="{{ $docType }}Modal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $docName }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="{{ route('admin.participant.view.document', ['category' => $docType, 'userId' => $participant->user_id]) }}" 
                                                    class="w-100" style="height: 500px; border: none;"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('admin.participant.document.confirm', ['id' => $documents->id, 'type' => $docType]) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-check me-2"></i>Verifikasi
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.participant.document.reject', ['id' => $documents->id, 'type' => $docType]) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-times me-2"></i>Tolak
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Revision Form -->
                <div class="card revision-card">
                    <div class="card-header bg-warning-subtle">
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Kirim Pesan Revisi</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.participant.sendRevision', $participant->user_id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="revisiMessage" class="form-label">Pesan Revisi</label>
                                <textarea class="form-control" id="revisiMessage" name="revisi_message" rows="4" 
                                          placeholder="Tulis pesan revisi untuk peserta..." required>{{ $revisi->revisi_message ?? '' }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Revisi
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Trainings -->
            <div class="tab-pane fade" id="trainings" role="tabpanel">
                @if($registrations->isEmpty())
                    <div class="empty-state text-center py-5">
                        <i class="fas fa-chalkboard-teacher fa-3x text-muted mb-3"></i>
                        <h4>Belum Ada Pelatihan</h4>
                        <p>Peserta ini belum terdaftar di pelatihan apapun.</p>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($registrations as $registration)
                            <div class="col-md-6 col-lg-4">
                                <div class="training-card">
                                    <div class="training-header">
                                        <span class="training-number">{{ $loop->iteration }}</span>
                                        <span class="badge bg-primary">Terdaftar</span>
                                    </div>
                                    <div class="training-body">
                                        <h5 class="training-title">{{ $registration->training->title }}</h5>
                                        <div class="training-meta">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            <span>{{ $registration->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    :root {
        --primary: #1e40af;
        --secondary: #3b82f6;
        --success: #22c55e;
        --danger: #ef4444;
        --warning: #f59e0b;
        --text-primary: #111827;
        --text-secondary: #6b7280;
        --border: #e5e7eb;
        --background: #f9fafb;
        --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --card-hover-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .breadcrumb-nav .breadcrumb {
        background: transparent;
        padding: 0;
    }

    .breadcrumb-nav .breadcrumb-item a {
        color: var(--primary);
        text-decoration: none;
    }

    .breadcrumb-nav .breadcrumb-item.active {
        color: var(--text-secondary);
    }

    .action-buttons .btn {
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .action-buttons .btn:hover {
        transform: translateY(-1px);
    }

    /* Profile Card */
    .profile-card {
        border: none;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        overflow: hidden;
    }

    .profile-banner {
        height: 150px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        position: relative;
    }

    .profile-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        opacity: 0.1;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"><path d="M0 0h80v80H0z" fill="none"/><path d="M0 80L80 0" stroke="white" stroke-width="2"/></svg>');
    }

    .profile-content {
        margin-top: -60px;
    }

    .profile-image-wrapper {
        position: relative;
        display: inline-block;
    }

    .profile-image {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 4px solid white;
        object-fit: cover;
        box-shadow: var(--card-shadow);
    }

    .profile-status {
        position: absolute;
        bottom: 8px;
        right: 8px;
        width: 20px;
        height: 20px;
        background: var(--success);
        border: 3px solid white;
        border-radius: 50%;
    }

    .profile-name {
        font-size: 1.75rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .profile-email {
        font-size: 1rem;
        color: var(--text-secondary);
    }

    .profile-stats {
        color: var(--text-secondary);
        font-size: 0.95rem;
    }

    .stat-item i {
        color: var(--primary);
    }

    /* Tabs */
    .nav-tabs {
        border: none;
        background: var(--background);
        border-radius: 8px 8px 0 0;
    }

    .nav-tabs .nav-link {
        border: none;
        padding: 1rem 1.5rem;
        color: var(--text-secondary);
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link:hover {
        color: var(--primary);
    }

    .nav-tabs .nav-link.active {
        color: var(--primary);
        border-bottom: 3px solid var(--primary);
        background: white;
    }

    .nav-tabs .badge {
        font-size: 0.75rem;
        padding: 0.3rem 0.6rem;
    }

    /* Info Cards */
    .info-card {
        border: none;
        border-radius: 8px;
        background: white;
        box-shadow: var(--card-shadow);
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .info-card:hover {
        box-shadow: var(--card-hover-shadow);
        transform: translateY(-2px);
    }

    .info-card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 1rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border);
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 500;
        color: var(--text-secondary);
        min-width: 120px;
    }

    .info-value {
        color: var(--text-primary);
        text-align: right;
        word-break: break-word;
    }

    /* Document Cards */
    .document-card {
        border: none;
        border-radius: 8px;
        background: white;
        box-shadow: var(--card-shadow);
        padding: 1.25rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .document-card:hover {
        box-shadow: var(--card-hover-shadow);
        transform: translateY(-2px);
    }

    .document-header {
        margin-bottom: 1rem;
    }

    .document-header i {
        font-size: 2rem;
        color: var(--primary);
    }

    .document-header h5 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0.5rem 0 0;
    }

    .document-status {
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Revision Card */
    .revision-card {
        border: none;
        box-shadow: var(--card-shadow);
    }

    .revision-card .card-header {
        border-radius: 8px 8px 0 0;
    }

    /* Training Cards */
    .training-card {
        border: none;
        border-radius: 8px;
        background: white;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
    }

    .training-card:hover {
        box-shadow: var(--card-hover-shadow);
        transform: translateY(-2px);
    }

    .training-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
    }

    .training-number {
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }

    .training-body {
        padding: 1.25rem;
    }

    .training-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
    }

    .training-meta {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    .training-meta i {
        color: var(--primary);
    }

    /* Empty State */
    .empty-state h4 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .empty-state p {
        color: var(--text-secondary);
    }

    /* Modal */
    .modal-content {
        border-radius: 8px;
        border: none;
    }

    .modal-header {
        background: var(--primary);
        color: white;
        border-radius: 8px 8px 0 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.5rem;
        }

        .profile-image {
            width: 80px;
            height: 80px;
        }

        .profile-name {
            font-size: 1.5rem;
        }

        .profile-stats {
            flex-direction: column;
            gap: 0.5rem;
        }

        .nav-tabs .nav-link {
            padding: 0.75rem;
            font-size: 0.9rem;
        }

        .action-buttons {
            flex-wrap: wrap;
            gap: 0.5rem;
        }
    }

    @media (max-width: 576px) {
        .info-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.25rem;
        }

        .info-value {
            text-align: left;
        }
    }

    /* Animations */
    .card, .info-card, .document-card, .training-card {
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@endsection