@extends('layouts.appuser')

@section('title', 'Dinas Tenaga Kerja Kota Batu - Daftar Komplain')

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

    * {
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, var(--metallic-silver) 0%, #f7fafc 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        overflow-x: hidden;
    }

    .container {
        position: relative;
        z-index: 1;
    }

    /* Page Header */
    .page-header {
        background: 
            linear-gradient(135deg, 
                rgba(1, 62, 126, 0.95) 0%, 
                rgba(0, 86, 179, 0.9) 50%, 
                rgba(0, 123, 255, 0.85) 100%
            );
        padding: 3rem 0;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        border-radius: 0 0 20px 20px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            repeating-linear-gradient(
                45deg,
                transparent,
                transparent 2px,
                rgba(255, 255, 255, 0.03) 2px,
                rgba(255, 255, 255, 0.03) 4px
            );
        z-index: 1;
    }

    .page-header .container {
        position: relative;
        z-index: 2;
    }

    .page-title {
        font-size: 2.5rem;
        color: var(--text-white);
        font-weight: 800;
        margin-bottom: 20px;
        text-shadow: 
            0 4px 8px rgba(0, 0, 0, 0.5),
            0 2px 4px rgba(0, 0, 0, 0.3);
        letter-spacing: -0.5px;
        text-align: center;
    }

    /* Enhanced Cards */
    .question-card {
        background: 
            linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: none;
        border-radius: 16px;
        box-shadow: 
            0 8px 32px rgba(0, 0, 0, 0.12),
            0 4px 16px rgba(0, 0, 0, 0.08),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
        position: relative;
        overflow: hidden;
        transition: var(--transition);
        transform: perspective(1000px) rotateX(0deg) rotateY(0deg);
        margin-bottom: 1.5rem;
        padding: 2rem;
    }

    .question-card::before {
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

    .question-card:hover {
        transform: 
            perspective(1000px) 
            rotateX(5deg) 
            rotateY(-2deg) 
            translateY(-12px) 
            scale(1.02);
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.15),
            0 8px 24px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
    }

    /* Header Controls */
    .header-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 3px solid transparent;
        background: linear-gradient(90deg, 
            var(--primary-blue) 0%, 
            var(--warning-orange) 50%, 
            var(--primary-blue) 100%) 
            bottom / 100% 3px no-repeat;
    }

    .section-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--dark-steel);
        margin: 0;
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Enhanced Buttons */
    .btn-primary {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        border: none;
        border-radius: 25px;
        padding: 12px 28px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
        box-shadow: 0 4px 16px rgba(1, 62, 126, 0.3);
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(1, 62, 126, 0.4);
        background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
    }

    .btn-outline-secondary {
        border: 2px solid var(--light-steel);
        color: var(--dark-steel);
        border-radius: 20px;
        font-weight: 600;
        transition: var(--transition);
        background: transparent;
    }

    .btn-outline-secondary:hover {
        background: var(--light-steel);
        color: var(--text-white);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(113, 128, 150, 0.3);
    }

    /* Search Form */
    .search-form {
        margin-bottom: 2rem;
    }

    .input-group {
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    }

    .form-control {
        border: none;
        padding: 15px 20px;
        font-size: 1rem;
        background: transparent;
        border-radius: 25px 0 0 25px;
    }

    .form-control:focus {
        box-shadow: none;
        background: transparent;
        border: none;
    }

    /* Complaint Card Content */
    .complaint-title {
        color: var(--dark-steel);
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 1rem;
        transition: var(--transition);
    }

    .question-card:hover .complaint-title {
        color: var(--primary-blue);
    }

    .complaint-description {
        color: var(--light-steel);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .complaint-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .profile-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--light-steel);
        font-size: 0.875rem;
    }

    .profile-image {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 2px solid var(--primary-blue);
        filter: drop-shadow(0 2px 4px rgba(1, 62, 126, 0.3));
        transition: var(--transition);
    }

    .question-card:hover .profile-image {
        transform: scale(1.1);
        border-color: var(--warning-orange);
    }

    .status-info {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 0.875rem;
    }

    .status-badge {
        background: linear-gradient(135deg, var(--success-green), var(--industrial-yellow));
        color: var(--text-white);
        padding: 4px 12px;
        border-radius: 15px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    /* Like Button */
    .like-btn {
        cursor: pointer;
        color: var(--light-steel);
        transition: var(--transition);
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .like-btn:hover {
        color: var(--warning-orange);
        transform: scale(1.1);
    }

    .like-btn.liked {
        color: #e0245e;
        animation: likeAnimation 0.6s ease;
    }

    @keyframes likeAnimation {
        0% { transform: scale(1); }
        50% { transform: scale(1.3); }
        100% { transform: scale(1); }
    }

    /* Rules Sidebar */
    .rules-box {
        background: 
            linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: none;
        border-radius: 16px;
        box-shadow: 
            0 8px 32px rgba(0, 0, 0, 0.12),
            0 4px 16px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
        padding: 2rem;
        position: sticky;
        top: 2rem;
    }

    .rules-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, 
            var(--warning-orange) 0%, 
            var(--primary-blue) 100%);
        border-radius: 16px 16px 0 0;
    }

    .rules-title {
        color: var(--primary-blue);
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .rules-title::before {
        content: '⚖️';
        font-size: 1.5rem;
    }

    .rules-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .rules-list li {
        color: var(--light-steel);
        margin-bottom: 1rem;
        padding-left: 1.5rem;
        position: relative;
        line-height: 1.5;
    }

    .rules-list li::before {
        content: '🔧';
        position: absolute;
        left: 0;
        top: 0;
        font-size: 1rem;
    }

    /* Alert Styles */
    .alert {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .alert-success {
        background: linear-gradient(135deg, rgba(56, 161, 105, 0.1), rgba(56, 161, 105, 0.05));
        border-left: 4px solid var(--success-green);
        color: var(--success-green);
    }

    .alert-danger {
        background: linear-gradient(135deg, rgba(245, 101, 101, 0.1), rgba(245, 101, 101, 0.05));
        border-left: 4px solid #f56565;
        color: #f56565;
    }

    .alert-warning {
        background: linear-gradient(135deg, rgba(255, 140, 0, 0.1), rgba(255, 140, 0, 0.05));
        border-left: 4px solid var(--warning-orange);
        color: var(--warning-orange);
        text-align: center;
        padding: 3rem 2rem;
    }

    .alert-warning i {
        font-size: 3rem;
        margin-bottom: 1rem;
        display: block;
    }

    /* Modal Styles */
    .modal {
        z-index: 1050;
    }

    .modal-backdrop {
        z-index: 1040;
        /* HAPUS EFEK REDUP */
        opacity: 0 !important;
        pointer-events: none;
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        color: var(--text-white);
        border: none;
        padding: 1.5rem 2rem;
    }

    .modal-title {
        font-weight: 700;
        font-size: 1.25rem;
    }

    .btn-close {
        filter: invert(1) brightness(100);
    }

    .modal-body {
        padding: 2rem;
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    }

    .modal-footer {
        background: #f8fafc;
        border: none;
        padding: 1.5rem 2rem;
    }

    .modal-content {
        border-radius: 16px;
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 1051;
    }

    .btn-secondary {
        background: linear-gradient(135deg, var(--light-steel), var(--steel-gray));
        border: none;
        border-radius: 20px;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-warning {
        background: linear-gradient(135deg, var(--warning-orange), var(--industrial-yellow));
        border: none;
        border-radius: 20px;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-warning:hover, .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--warning-orange);
        margin-bottom: 1rem;
        opacity: 0.7;
    }

    /* Pagination */
    .pagination {
        justify-content: center;
    }

    .page-link {
        border: none;
        color: var(--primary-blue);
        font-weight: 600;
        border-radius: 8px;
        margin: 0 2px;
        transition: var(--transition);
    }

    .page-link:hover {
        background: var(--primary-blue);
        color: var(--text-white);
        transform: translateY(-2px);
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        border: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem;
        }
        
        .header-controls {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }
        
        .section-title {
            text-align: center;
        }
        
        .complaint-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .question-card {
            padding: 1.5rem;
        }
        
        .question-card:hover {
            transform: translateY(-8px) scale(1.01);
        }
        
        .rules-box {
            position: static;
            margin-top: 2rem;
        }
    }

    /* Animation Keyframes */
    @keyframes industrialPulse {
        0%, 100% { 
            box-shadow: 0 0 20px rgba(255, 140, 0, 0.3);
        }
        50% { 
            box-shadow: 0 0 40px rgba(1, 62, 126, 0.4);
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in {
        animation: fadeIn 1s ease-out;
    }

    @keyframes rippleAnimation {
        0% { transform: scale(0); opacity: 1; }
        100% { transform: scale(4); opacity: 0; }
    }

    .char-counter {
        transition: all 0.3s ease;
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title animate-fade-in">🛠️ Daftar Komplain Tenaga Kerja</h1>
    </div>
</div>

<div class="container pt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="header-controls">
                <h2 class="section-title">Komplain & Saran</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#askQuestionModal">
                    <i class="fas fa-plus-circle me-2"></i>Buat Komplain
                </button>
            </div>

            <!-- Enhanced Search Form -->
            <div class="search-form">
                <form action="{{ route('complaints.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" 
                               placeholder="🔍 Cari komplain berdasarkan judul atau deskripsi..." 
                               value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            @if($complaints->isEmpty())
                <div class="alert alert-warning">
                    <i class="fas fa-hard-hat"></i>
                    <div>
                        <strong>Belum Ada Komplain</strong>
                        <p class="mb-0 mt-2">Belum ada komplain yang diajukan. Jadilah yang pertama untuk memberikan masukan!</p>
                    </div>
                </div>
            @else
                <div class="complaints-list">
                    @foreach($complaints as $complaint)
                    <div class="question-card animate-fade-in" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                        <h3 class="complaint-title">
                            <a href="{{ route('complaints.show', $complaint->id) }}" class="text-decoration-none">
                                <i class="fas fa-comment-dots me-2"></i>{{ $complaint->title }}
                            </a>
                        </h3>
                        <p class="complaint-description">{{ Str::limit($complaint->question, 150) }}</p>
                        
                        <div class="complaint-meta">
                            <div class="profile-info">
                                <img src="{{ $complaint->questioner->profile && $complaint->questioner->profile->foto ? asset('storage/' . $complaint->questioner->profile->foto) : asset('image/default_profile.jpg') }}" 
                                     alt="Profile" class="profile-image">
                                <span>{{ $complaint->questioner->name }}</span>
                                <span class="text-muted">•</span>
                                <span>{{ $complaint->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <div class="status-info">
                                <span class="status-badge">
                                    <i class="fas fa-{{ $complaint->status === 'open' ? 'clock' : 'check' }}"></i>
                                    {{ ucfirst($complaint->status) }}
                                </span>
                                <div class="like-section">
                                    @auth
                                    <span class="like-btn {{ auth()->user()->hasLiked($complaint) ? 'liked' : '' }}" 
                                          data-id="{{ $complaint->id }}">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span id="like-count-{{ $complaint->id }}">{{ $complaint->likes_count }}</span>
                                    </span>
                                    @endauth
                                    @guest
                                    <span class="like-btn" data-id="{{ $complaint->id }}">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span id="like-count-{{ $complaint->id }}">{{ $complaint->likes_count }}</span>
                                    </span>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $complaints->links() }}
                </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="rules-box">
                <h5 class="rules-title">Aturan Komplain</h5>
                <ul class="rules-list">
                    <li>Gunakan bahasa yang sopan dan professional</li>
                    <li>Sampaikan komplain dengan jelas dan terstruktur</li>
                    <li>Hindari spam dan duplikasi komplain</li>
                    <li>Patuhi etika berkomunikasi yang baik</li>
                    <li>Berikan detail yang cukup untuk penyelesaian</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tanpa Backdrop -->
<div class="modal fade" id="askQuestionModal" tabindex="-1" aria-labelledby="askQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="askQuestionModalLabel">
                    <i class="fas fa-comment-alt me-2"></i>Sampaikan Komplain Anda
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('complaints.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="questionTitle" class="form-label fw-bold">
                            <i class="fas fa-heading me-1"></i>Judul Komplain
                        </label>
                        <input type="text" name="title" class="form-control" id="questionTitle" 
                               placeholder="Masukkan judul komplain yang jelas..." required>
                    </div>
                    <div class="mb-3">
                        <label for="questionDetails" class="form-label fw-bold">
                            <i class="fas fa-align-left me-1"></i>Detail Komplain
                        </label>
                        <textarea name="question" class="form-control" id="questionDetails" rows="5" 
                                  placeholder="Jelaskan detail komplain Anda dengan lengkap..." required></textarea>
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            Berikan informasi yang detail agar kami dapat membantu dengan optimal.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-warning text-white">
                        <i class="fas fa-paper-plane me-1"></i>Kirim Komplain
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Enhanced animations
        $('.animate-fade-in').each(function(index) {
            $(this).css('animation-delay', (index * 0.1) + 's');
        });

        // Card hover effects dengan ripple
        $('.question-card').on('click', function(e) {
            if ($(e.target).closest('a, .like-btn').length) return;
            
            const $this = $(this);
            const offset = $this.offset();
            const x = e.pageX - offset.left;
            const y = e.pageY - offset.top;
            
            const $ripple = $('<span style="position: absolute; border-radius: 50%; background: rgba(255, 140, 0, 0.3); transform: scale(0); animation: rippleAnimation 0.8s linear; pointer-events: none;"></span>');
            $ripple.css({
                left: x,
                top: y,
                width: '40px',
                height: '40px',
                marginLeft: '-20px',
                marginTop: '-20px'
            });
            
            $this.append($ripple);
            
            setTimeout(() => {
                $ripple.remove();
            }, 800);
        });

        // Like button functionality
        $('.like-btn').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            @auth
                let complaintId = $(this).data('id');
                let $likeCount = $('#like-count-' + complaintId);
                let $likeBtn = $(this);
                let isLiked = $likeBtn.hasClass('liked');

                // Add loading state
                $likeBtn.addClass('loading');
                
                fetch(`/complaints/${complaintId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ like: !isLiked })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        $likeBtn.toggleClass('liked');
                        $likeCount.text(data.likes_count);
                        
                        // Add success animation
                        if (!isLiked) {
                            $likeBtn.addClass('animate__animated animate__heartBeat');
                            setTimeout(() => {
                                $likeBtn.removeClass('animate__animated animate__heartBeat');
                            }, 1000);
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan. Silakan coba lagi.', 'danger');
                })
                .finally(() => {
                    $likeBtn.removeClass('loading');
                });
            @else
                // Redirect guest to login page with message
                sessionStorage.setItem('loginMessage', 'Silakan login terlebih dahulu untuk memberikan like pada komplain.');
                window.location.href = "{{ route('login') }}";
            @endguest
        });

        // Search form enhancements
        $('input[name="search"]').on('focus', function() {
            $(this).parent().addClass('focused');
        }).on('blur', function() {
            $(this).parent().removeClass('focused');
        });

        // Modal handling - biarkan Bootstrap bekerja normal
        $('#askQuestionModal').on('shown.bs.modal', function() {
            $('#questionTitle').focus();
        });

        // Form validation saat submit
        $('#askQuestionModal form').on('submit', function(e) {
            const title = $('#questionTitle').val().trim();
            const details = $('#questionDetails').val().trim();
            
            if (title.length < 5) {
                e.preventDefault();
                showAlert('Judul komplain minimal 5 karakter.', 'warning');
                $('#questionTitle').focus();
                return;
            }
            
            if (details.length < 20) {
                e.preventDefault();
                showAlert('Detail komplain minimal 20 karakter untuk memberikan informasi yang cukup.', 'warning');
                $('#questionDetails').focus();
                return;
            }
            
            // Show loading state
            $(this).find('button[type="submit"]').html('<i class="fas fa-spinner fa-spin me-1"></i>Mengirim...').prop('disabled', true);
        });

        // Character counter untuk textarea
        $('#questionDetails').on('input', function() {
            const current = $(this).val().length;
            const min = 20;
            let $counter = $(this).siblings('.char-counter');
            
            if (!$counter.length) {
                $(this).after('<div class="char-counter text-muted small mt-1"></div>');
                $counter = $(this).siblings('.char-counter');
            }
            
            const color = current < min ? 'text-danger' : 'text-success';
            const icon = current < min ? 'exclamation-triangle' : 'check-circle';
            $counter.html(`<i class="fas fa-${icon}"></i> ${current} karakter (minimal ${min})`)
                    .removeClass('text-danger text-success text-muted')
                    .addClass(color);
        });

        // Enhanced alert function
        function showAlert(message, type = 'info') {
            const icons = {
                success: 'check-circle',
                danger: 'exclamation-triangle', 
                warning: 'exclamation-circle',
                info: 'info-circle'
            };
            
            const $alert = $(`
                <div class="alert alert-${type} alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px; max-width: 400px;">
                    <i class="fas fa-${icons[type]} me-2"></i>${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
            
            $('body').append($alert);
            
            setTimeout(() => {
                $alert.alert('close');
            }, 5000);
        }

        // Auto-hide alerts dari session
        $('.alert').each(function() {
            const $alert = $(this);
            setTimeout(() => {
                $alert.fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 5000);
        });

        // Smooth scroll to complaint when coming from notification
        if (window.location.hash) {
            const target = $(window.location.hash);
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 1000);
                target.addClass('highlight-complaint');
                setTimeout(() => target.removeClass('highlight-complaint'), 3000);
            }
        }

        // Add loading state for like buttons
        $('.loading').css({
            'opacity': '0.6',
            'pointer-events': 'none'
        });

        // Prevent modal backdrop issues
        $('#askQuestionModal').on('show.bs.modal', function() {
            $('body').addClass('modal-open');
        });

        $('#askQuestionModal').on('hidden.bs.modal', function() {
            $('body').removeClass('modal-open');
            // Reset form
            $(this).find('form')[0].reset();
            $(this).find('.char-counter').remove();
            $(this).find('button[type="submit"]').html('<i class="fas fa-paper-plane me-1"></i>Kirim Komplain').prop('disabled', false);
        });

        console.log('Industrial Complaints Page Loaded Successfully - No Backdrop Effect');
    });
</script>

<style>
/* Additional CSS untuk menghilangkan efek redup dan memastikan modal berfungsi */
.focused {
    transform: scale(1.02);
    box-shadow: 0 8px 25px rgba(1, 62, 126, 0.2) !important;
}

.highlight-complaint {
    animation: highlightPulse 2s ease-in-out;
    border: 2px solid var(--warning-orange) !important;
}

@keyframes highlightPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.02); }
}

.loading {
    opacity: 0.6;
    pointer-events: none;
}

.question-card {
    scroll-margin-top: 100px;
}

/* Modal Fixes */
.modal {
    background: rgba(0, 0, 0, 0.3) !important;
}

.modal.show {
    background: rgba(0, 0, 0, 0.3) !important;
}

.modal-backdrop.show {
    opacity: 0 !important;
}

body.modal-open {
    overflow: hidden;
}

/* Pastikan modal content terlihat dengan jelas */
.modal-content {
    position: relative;
    z-index: 1051 !important;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5) !important;
}

/* Mobile responsive untuk modal */
@media (max-width: 768px) {
    .modal-dialog {
        margin: 1rem;
        width: calc(100vw - 2rem);
        max-width: none;
    }
    
    .modal-body {
        padding: 1.5rem;
    }
    
    .modal-header, .modal-footer {
        padding: 1rem 1.5rem;
    }
}

/* Form enhancements */
.form-control:focus {
    border-color: var(--primary-blue) !important;
    box-shadow: 0 0 0 0.2rem rgba(1, 62, 126, 0.25) !important;
}

.char-counter {
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.char-counter.text-danger {
    color: #dc3545 !important;
}

.char-counter.text-success {
    color: var(--success-green) !important;
}

/* Button states */
.btn:disabled {
    opacity: 0.65;
    cursor: not-allowed;
}

.btn-primary:disabled {
    background: linear-gradient(135deg, #6c757d, #5a6268) !important;
}

/* Alert positioning */
.alert[style*="position: fixed"] {
    animation: slideInRight 0.3s ease-out;
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}
</style>
@endpush