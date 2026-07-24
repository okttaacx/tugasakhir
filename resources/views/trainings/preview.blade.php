@extends('layouts.appuser')

@section('title', 'Preview Profil & Dokumen')

@section('content')
    <div class="container py-5">
        <h2 class="text-center font-weight-bold mb-4">Review Data Sebelum Daftar Pelatihan</h2>

        <!-- Menampilkan pesan sukses/error -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Snackbar untuk data tidak lengkap -->
        @if(!$isProfileComplete || !$isDocumentComplete || !$isDocumentConfirmed)
            <div id="snackbar" class="alert alert-warning alert-dismissible" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Data Belum Lengkap!</strong> 
                @if(!$isProfileComplete)
                    Profil belum lengkap.
                @endif
                @if(!$isDocumentComplete)
                    Dokumen belum lengkap.
                @endif
                @if($isDocumentComplete && !$isDocumentConfirmed)
                    Dokumen belum dikonfirmasi admin.
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="progress-bar-container">
                    <div id="progress-bar" class="progress-bar-fill"></div>
                </div>
            </div>
        @endif

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs mb-4" id="previewTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                    <i class="fas fa-user me-2"></i>Data Profil
                    @if(!$isProfileComplete)
                        <i class="fas fa-exclamation-circle text-danger ms-1"></i>
                    @else
                        <i class="fas fa-check-circle text-success ms-1"></i>
                    @endif
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button" role="tab" aria-controls="documents" aria-selected="false">
                    <i class="fas fa-file-alt me-2"></i>Dokumen
                    @if(!$isDocumentComplete)
                        <i class="fas fa-exclamation-circle text-danger ms-1"></i>
                    @elseif(!$isDocumentConfirmed)
                        <i class="fas fa-clock text-warning ms-1"></i>
                    @else
                        <i class="fas fa-check-circle text-success ms-1"></i>
                    @endif
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="previewTabsContent">
            <!-- PROFIL TAB -->
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-user me-2"></i>Data Profil
                            @if($isProfileComplete)
                                <span class="badge bg-success ms-2">Lengkap</span>
                            @else
                                <span class="badge bg-danger ms-2">Tidak Lengkap</span>
                            @endif
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control {{ empty($profile->name) ? 'border-danger' : '' }}" 
                                       value="{{ $profile->name ?? 'Belum diisi' }}" readonly>
                                @if(empty($profile->name))
                                    <small class="text-danger">Data belum diisi</small>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIK</label>
                                <input type="text" class="form-control {{ empty($profile->nik) ? 'border-danger' : '' }}" 
                                       value="{{ $profile->nik ?? 'Belum diisi' }}" readonly>
                                @if(empty($profile->nik))
                                    <small class="text-danger">Data belum diisi</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="text" class="form-control {{ empty($profile->ttl) ? 'border-danger' : '' }}" 
                                       value="{{ $profile->ttl ?? 'Belum diisi' }}" readonly>
                                @if(empty($profile->ttl))
                                    <small class="text-danger">Data belum diisi</small>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <input type="text" class="form-control {{ empty($profile->gender) ? 'border-danger' : '' }}" 
                                       value="{{ $profile->gender ?? 'Belum diisi' }}" readonly>
                                @if(empty($profile->gender))
                                    <small class="text-danger">Data belum diisi</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Jalan, RT/RW</label>
                                <input type="text" class="form-control {{ empty($profile->jalan) ? 'border-danger' : '' }}" 
                                       value="{{ $profile->jalan ?? 'Belum diisi' }}" readonly>
                                @if(empty($profile->jalan))
                                    <small class="text-danger">Data belum diisi</small>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Desa/Kelurahan</label>
                                <input type="text" class="form-control {{ empty($profile->desa) ? 'border-danger' : '' }}" 
                                       value="{{ $profile->desa ?? 'Belum diisi' }}" readonly>
                                @if(empty($profile->desa))
                                    <small class="text-danger">Data belum diisi</small>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kecamatan</label>
                                <input type="text" class="form-control {{ empty($profile->kecamatan) ? 'border-danger' : '' }}" 
                                       value="{{ $profile->kecamatan ?? 'Belum diisi' }}" readonly>
                                @if(empty($profile->kecamatan))
                                    <small class="text-danger">Data belum diisi</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pendidikan Terakhir</label>
                                <input type="text" class="form-control {{ empty($profile->pendidikan) ? 'border-danger' : '' }}" 
                                       value="{{ $profile->pendidikan ?? 'Belum diisi' }}" readonly>
                                @if(empty($profile->pendidikan))
                                    <small class="text-danger">Data belum diisi</small>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No Telpon</label>
                                <input type="text" class="form-control {{ empty($profile->nomor) ? 'border-danger' : '' }}" 
                                       value="{{ $profile->nomor ?? 'Belum diisi' }}" readonly>
                                @if(empty($profile->nomor))
                                    <small class="text-danger">Data belum diisi</small>
                                @endif
                            </div>
                        </div>

                        <div class="text-end mt-3">
                            <a href="{{ route('profile.index') }}" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>Edit Profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DOKUMEN TAB -->
            <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-file-alt me-2"></i>Status Dokumen
                            @if($isDocumentComplete && $isDocumentConfirmed)
                                <span class="badge bg-success ms-2">Terverifikasi</span>
                            @elseif($isDocumentComplete)
                                <span class="badge bg-warning ms-2">Menunggu Verifikasi</span>
                            @else
                                <span class="badge bg-danger ms-2">Tidak Lengkap</span>
                            @endif
                        </h5>
                    </div>
                    <div class="card-body">
                        @php
                            $documents = [
                                'ktp' => ['label' => 'KTP', 'file' => $document->ktp ?? null, 'status' => $document->ktp_status ?? 'pending'],
                                'kk' => ['label' => 'Kartu Keluarga', 'file' => $document->kk ?? null, 'status' => $document->kk_status ?? 'pending'],
                                'ijazah' => ['label' => 'Ijazah', 'file' => $document->ijazah ?? null, 'status' => $document->ijazah_status ?? 'pending'],
                                'ak1' => ['label' => 'AK1', 'file' => $document->ak1 ?? null, 'status' => $document->ak1_status ?? 'pending']
                            ];
                        @endphp

                        <div class="row">
                            @foreach($documents as $key => $doc)
                                <div class="col-md-6 mb-3">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="card-title mb-0">{{ $doc['label'] }}</h6>
                                                @if($doc['file'])
                                                    <a href="{{ route('documents.show.user', [basename($doc['file']), $key]) }}" 
                                                       target="_blank" 
                                                       class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                @endif
                                            </div>
                                            
                                            @if($doc['file'])
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="text-muted small">{{ basename($doc['file']) }}</span>
                                                    @if($doc['status'] == 'confirmed')
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-check me-1"></i>Terverifikasi
                                                        </span>
                                                    @elseif($doc['status'] == 'rejected')
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-times me-1"></i>Ditolak
                                                        </span>
                                                    @else
                                                        <span class="badge bg-warning">
                                                            <i class="fas fa-clock me-1"></i>Menunggu
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="text-center py-3">
                                                    <i class="fas fa-file-upload fa-2x text-muted mb-2"></i>
                                                    <p class="text-muted small">Dokumen belum diupload</p>
                                                    <span class="badge bg-danger">Belum diisi</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Revisi Message -->
                        @if(auth()->user()->revisi && !empty(auth()->user()->revisi->revisi_message))
                            <div class="alert alert-warning mt-3">
                                <h6 class="alert-heading">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Pesan Revisi dari Admin
                                </h6>
                                <p class="mb-0">{{ auth()->user()->revisi->revisi_message }}</p>
                            </div>
                        @endif

                        <div class="text-end mt-3">
                            <a href="{{ route('profile.documents') }}" class="btn btn-warning">
                                <i class="fas fa-upload me-2"></i>Edit Dokumen
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Pelatihan -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-graduation-cap me-2"></i>Pelatihan yang Dipilih
                </h5>
            </div>
            <div class="card-body">
                <h4 class="font-weight-bold">{{ $training->title }}</h4>
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Lokasi:</strong> {{ $training->location }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($training->start_date)->format('d M Y') }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Waktu:</strong> {{ $training->start_time }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Konfirmasi -->
        <div class="text-center mt-4">
            @if($isProfileComplete && $isDocumentComplete && $isDocumentConfirmed)
                <form action="{{ route('course.register') }}" method="POST">
                    @csrf
                    <input type="hidden" name="training_id" value="{{ $training->id }}">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-check-circle me-2"></i>Konfirmasi Daftar
                    </button>
                </form>
            @else
                <button type="button" class="btn btn-secondary btn-lg" disabled>
                    <i class="fas fa-lock me-2"></i>Konfirmasi Daftar (Data Belum Lengkap)
                </button>
                <div class="mt-2">
                    <small class="text-danger">
                        <i class="fas fa-info-circle me-1"></i>
                        Lengkapi profil dan dokumen untuk mendaftar pelatihan
                    </small>
                </div>
            @endif
        </div>
    </div>

    @push('styles')
    <style>
        .border-danger {
            border-color: #dc3545 !important;
        }
        
        #snackbar {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            max-width: 400px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
            border-radius: 8px;
            overflow: hidden;
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #snackbar.show {
            transform: translateX(0);
            opacity: 1;
        }

        #snackbar.hide {
            transform: translateX(100%);
            opacity: 0;
        }

        .progress-bar-container {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #ff6b35, #ff8f00);
            width: 100%;
            transition: width 5s linear;
        }

        .progress-bar-fill.animate {
            width: 0%;
        }

        .nav-tabs .nav-link {
            color: #495057;
            border: 1px solid transparent;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }

        .nav-tabs .nav-link:hover {
            border-color: #e9ecef #e9ecef #dee2e6;
        }

        .nav-tabs .nav-link.active {
            color: #495057;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
        }

        .card {
            border: 1px solid rgba(0,0,0,0.125);
            border-radius: 0.25rem;
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            border-bottom: 1px solid rgba(0,0,0,0.125);
        }

        @media (max-width: 768px) {
            #snackbar {
                top: 10px;
                left: 10px;
                right: 10px;
                min-width: auto;
                max-width: none;
                transform: translateY(-100%);
            }
            
            #snackbar.show {
                transform: translateY(0);
            }
            
            #snackbar.hide {
                transform: translateY(-100%);
            }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const snackbar = document.getElementById('snackbar');
            const progressBar = document.getElementById('progress-bar');
            
            if (snackbar) {
                // Show snackbar with animation
                setTimeout(() => {
                    snackbar.classList.add('show');
                    if (progressBar) {
                        progressBar.classList.add('animate');
                    }
                }, 10);

                // Auto hide after 5 seconds
                const hideTimer = setTimeout(() => {
                    hideSnackbar();
                }, 10000);

                // Handle close button click
                const closeBtn = snackbar.querySelector('.btn-close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', () => {
                        clearTimeout(hideTimer);
                        hideSnackbar();
                    });
                }

                function hideSnackbar() {
                    snackbar.classList.remove('show');
                    snackbar.classList.add('hide');
                    
                    // Remove element after animation completes
                    setTimeout(() => {
                        if (snackbar && snackbar.parentNode) {
                            snackbar.parentNode.removeChild(snackbar);
                        }
                    }, 400);
                }
            }
        });
    </script>
    @endpush
@endsection