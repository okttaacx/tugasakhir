@extends('layouts.appuser')

@section('title', 'Lowongan Pekerjaan - Dinas Tenaga Kerja Kota Batu')

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

    /* Header Section */
    .jobs-header {
        background: linear-gradient(135deg, 
            var(--primary-blue) 0%, 
            var(--secondary-blue) 30%,
            var(--dark-steel) 70%,
            var(--carbon-black) 100%);
        padding: 4rem 0;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    }

    .jobs-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            repeating-linear-gradient(
                -45deg,
                transparent,
                transparent 30px,
                rgba(255, 140, 0, 0.1) 30px,
                rgba(255, 140, 0, 0.1) 60px
            );
        z-index: 1;
    }

    .jobs-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, 
            var(--warning-orange) 0%, 
            var(--industrial-yellow) 25%,
            var(--primary-blue) 50%,
            var(--industrial-yellow) 75%,
            var(--warning-orange) 100%);
        box-shadow: 0 -2px 10px rgba(255, 140, 0, 0.4);
    }

    .jobs-header .container {
        position: relative;
        z-index: 2;
    }

    .jobs-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 2rem;
    }

    .jobs-title-section {
        flex: 1;
        min-width: 300px;
    }

    .jobs-title {
        font-size: 2.8rem;
        color: var(--text-white);
        font-weight: 900;
        margin-bottom: 1rem;
        position: relative;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .jobs-title .title-icon {
        color: var(--warning-orange);
        margin-right: 1rem;
        font-size: 2.5rem;
        filter: drop-shadow(0 4px 8px rgba(255, 140, 0, 0.4));
    }

    .jobs-subtitle {
        color: var(--text-light);
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
        line-height: 1.5;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .jobs-stats {
        display: flex;
        gap: 2rem;
        margin-top: 1rem;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--warning-orange);
        display: block;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .stat-label {
        font-size: 0.9rem;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .jobs-visual {
        flex: 0 0 auto;
        position: relative;
    }

    .visual-circle {
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 140, 0, 0.3);
        position: relative;
        overflow: hidden;
    }

    .visual-circle::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, 
            transparent 30%, 
            rgba(255, 140, 0, 0.1) 50%, 
            transparent 70%);
        animation: rotate 8s linear infinite;
    }

    .visual-icon {
        font-size: 4rem;
        color: var(--warning-orange);
        z-index: 2;
        position: relative;
        filter: drop-shadow(0 4px 12px rgba(255, 140, 0, 0.5));
    }

    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        pointer-events: none;
        overflow: hidden;
    }

    .floating-icon {
        position: absolute;
        color: rgba(255, 140, 0, 0.2);
        animation: float 6s ease-in-out infinite;
    }

    .floating-icon:nth-child(1) {
        top: 20%;
        left: 10%;
        font-size: 2rem;
        animation-delay: 0s;
    }

    .floating-icon:nth-child(2) {
        top: 60%;
        right: 15%;
        font-size: 1.5rem;
        animation-delay: 2s;
    }

    .floating-icon:nth-child(3) {
        bottom: 30%;
        left: 20%;
        font-size: 1.8rem;
        animation-delay: 4s;
    }

    .floating-icon:nth-child(4) {
        top: 40%;
        right: 30%;
        font-size: 1.3rem;
        animation-delay: 1s;
    }

    /* Job Cards */
    .job-card {
        background: 
            linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: none;
        border-radius: 20px;
        box-shadow: 
            0 8px 32px rgba(0, 0, 0, 0.12),
            0 4px 16px rgba(0, 0, 0, 0.08),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
        position: relative;
        overflow: hidden;
        transition: var(--transition);
        transform: perspective(1000px) rotateX(0deg) rotateY(0deg);
        height: 100%;
    }

    .job-card::before {
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
        border-radius: 20px 20px 0 0;
    }

    .job-card:hover {
        transform: 
            perspective(1000px) 
            rotateX(3deg) 
            rotateY(-1deg) 
            translateY(-12px) 
            scale(1.02);
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.15),
            0 8px 24px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
    }

    .job-poster {
        position: relative;
        overflow: hidden;
        border-radius: 16px 16px 0 0;
    }

    .job-poster img {
        height: 220px;
        object-fit: cover;
        transition: var(--transition);
        width: 100%;
    }

    .job-card:hover .job-poster img {
        transform: scale(1.08);
        filter: brightness(1.1) contrast(1.05);
    }

    .job-placeholder {
        height: 220px;
        background: linear-gradient(135deg, var(--metallic-silver), var(--light-steel));
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        border-radius: 16px 16px 0 0;
    }

    .job-placeholder::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 0%, transparent 50%);
        background-size: 100px 100px;
    }

    .job-placeholder i {
        font-size: 3.5rem;
        color: var(--primary-blue);
        opacity: 0.5;
        z-index: 2;
        position: relative;
    }

    .job-body {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .job-title {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--dark-steel);
        margin-bottom: 1rem;
        line-height: 1.3;
        transition: var(--transition);
    }

    .job-card:hover .job-title {
        color: var(--primary-blue);
        transform: translateY(-2px);
    }

    .job-description {
        color: var(--steel-gray);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        flex-grow: 1;
    }

    .job-meta {
        margin-bottom: 1.5rem;
    }

    .job-meta-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
        color: var(--steel-gray);
        font-size: 0.9rem;
    }

    .job-meta-item:last-child {
        margin-bottom: 0;
    }

    .job-meta-icon {
        color: var(--warning-orange);
        font-size: 1rem;
        margin-right: 0.75rem;
        width: 16px;
        text-align: center;
        transition: var(--transition);
    }

    .job-card:hover .job-meta-icon {
        color: var(--primary-blue);
        transform: scale(1.15);
    }

    .job-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: auto;
    }

    .btn-job-detail {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        border: none;
        border-radius: 25px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
        box-shadow: 0 4px 16px rgba(1, 62, 126, 0.3);
        color: var(--text-white);
        text-decoration: none;
        font-size: 0.85rem;
    }

    .btn-job-detail::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-job-detail:hover::before {
        left: 100%;
    }

    .btn-job-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(1, 62, 126, 0.4);
        background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
        color: var(--text-white);
        text-decoration: none;
    }

    /* Empty State */
    .empty-jobs {
        text-align: center;
        padding: 4rem 2rem;
        background: 
            linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 20px;
        box-shadow: 
            0 8px 32px rgba(0, 0, 0, 0.12),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
        position: relative;
        overflow: hidden;
    }

    .empty-jobs::before {
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
        border-radius: 20px 20px 0 0;
    }

    .empty-icon {
        font-size: 5rem;
        color: var(--light-steel);
        margin-bottom: 1.5rem;
        filter: drop-shadow(0 4px 8px rgba(113, 128, 150, 0.3));
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark-steel);
        margin-bottom: 1rem;
    }

    .empty-description {
        color: var(--steel-gray);
        font-size: 1.1rem;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .btn-alternative {
        background: linear-gradient(135deg, var(--warning-orange), var(--industrial-yellow));
        border: none;
        border-radius: 25px;
        padding: 1rem 2rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
        box-shadow: 0 4px 16px rgba(255, 140, 0, 0.3);
        color: var(--text-white);
        text-decoration: none;
    }

    .btn-alternative::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-alternative:hover::before {
        left: 100%;
    }

    .btn-alternative:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(255, 140, 0, 0.4);
        color: var(--text-white);
        text-decoration: none;
    }

    /* Status Badge (if needed later) */
    .job-status {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        z-index: 5;
    }

    .status-open {
        color: var(--success-green);
        background: rgba(56, 161, 105, 0.1);
        border-color: var(--success-green);
    }

    .status-closed {
        color: var(--steel-gray);
        background: rgba(113, 128, 150, 0.1);
        border-color: var(--steel-gray);
    }

    /* Animations */
    .animate-fade-in {
        animation: fadeIn 1s ease-out;
    }

    .animate-slide-up {
        animation: slideUp 1s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
        from { 
            opacity: 0; 
            transform: translateY(50px) rotateX(10deg); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0) rotateX(0deg); 
        }
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes float {
        0%, 100% { 
            transform: translateY(0px) translateX(0px) rotate(0deg);
            opacity: 0.2;
        }
        25% {
            transform: translateY(-20px) translateX(10px) rotate(5deg);
            opacity: 0.4;
        }
        50% { 
            transform: translateY(-10px) translateX(-10px) rotate(-5deg);
            opacity: 0.3;
        }
        75% {
            transform: translateY(-30px) translateX(5px) rotate(3deg);
            opacity: 0.5;
        }
    }

    @keyframes rippleAnimation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .jobs-title {
            font-size: 2rem;
        }
        
        .jobs-subtitle {
            font-size: 1rem;
        }
        
        .job-body {
            padding: 1.5rem;
        }
        
        .job-title {
            font-size: 1.2rem;
        }
        
        .job-poster img,
        .job-placeholder {
            height: 180px;
        }
        
        .job-card:hover {
            transform: translateY(-8px) scale(1.01);
        }
    }

    @media (max-width: 480px) {
        .jobs-header {
            padding: 3rem 0;
        }
        
        .jobs-title {
            font-size: 1.8rem;
        }
        
        .job-body {
            padding: 1.25rem;
        }
        
        .job-poster img,
        .job-placeholder {
            height: 160px;
        }
        
        .btn-job-detail {
            padding: 0.6rem 1.2rem;
            font-size: 0.8rem;
        }
    }
</style>
@endpush

@section('content')
    <!-- Jobs Header -->
    <div class="jobs-header">
        <div class="container">
            <div class="jobs-header-content">
                <div class="jobs-title-section">
            <h1 class="jobs-title animate-fade-in">
                <i class="fas fa-briefcase title-icon"></i>
                Lowongan Pekerjaan
            </h1>
            <p class="jobs-subtitle animate-fade-in">
                Temukan kesempatan karir terbaik bersama Dinas Tenaga Kerja Kota Batu.<br>
                Wujudkan impian karir Anda dengan berbagai peluang kerja berkualitas.
            </p>
            
            <div class="jobs-stats animate-slide-up">
                <div class="stat-item">
                    <span class="stat-number">{{ $lokers->count() ?? 0 }}</span>
                    <span class="stat-label">Lowongan Aktif</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">50+</span>
                    <span class="stat-label">Perusahaan Mitra</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">1000+</span>
                    <span class="stat-label">Kandidat Sukses</span>
                </div>
            </div>
        </div>
        
        <div class="jobs-visual animate-slide-up" style="animation-delay: 0.3s;">
            <div class="visual-circle">
                <i class="fas fa-users visual-icon"></i>
            </div>
        </div>
    </div>
    
    <div class="floating-elements">
        <i class="fas fa-briefcase floating-icon"></i>
        <i class="fas fa-handshake floating-icon"></i>
        <i class="fas fa-chart-line floating-icon"></i>
        <i class="fas fa-building floating-icon"></i>
        </div>
    </div>

    <!-- Jobs Content -->
    <div class="container py-5">
        <div class="row">
            @forelse($lokers as $index => $loker)
            <div class="col-lg-4 col-md-6 mb-4 animate-slide-up" style="animation-delay: {{ $index * 0.1 }}s;">
                <div class="job-card">
                    @if($loker->poster)
                        <div class="job-poster">
                            <img src="{{ asset('storage/' . $loker->poster) }}" 
                                 alt="{{ $loker->title }}"
                                 class="w-100">
                        </div>
                    @else
                        <div class="job-placeholder">
                            <i class="fas fa-briefcase"></i>
                        </div>
                    @endif

                    <div class="job-body">
                        <h3 class="job-title">{{ $loker->title }}</h3>
                        
                        @if($loker->deskripsi)
                            <p class="job-description">{{ Str::limit($loker->deskripsi, 120) }}</p>
                        @endif
                        
                        <div class="job-meta">
                            @if($loker->location)
                                <div class="job-meta-item">
                                    <i class="fas fa-map-marker-alt job-meta-icon"></i>
                                    <span>{{ $loker->location }}</span>
                                </div>
                            @endif
                            
                            @if($loker->deadline)
                                <div class="job-meta-item">
                                    <i class="fas fa-calendar-alt job-meta-icon"></i>
                                    <span>Batas: {{ \Carbon\Carbon::parse($loker->deadline)->format('d M Y') }}</span>
                                </div>
                            @endif
                            
                            <div class="job-meta-item">
                                <i class="fas fa-building job-meta-icon"></i>
                                <span>Dinas Tenaga Kerja Kota Batu</span>
                            </div>
                        </div>
                        
                        <div class="job-actions">
                            <a href="{{ route('lokers.show', $loker) }}" class="btn-job-detail">
                                <i class="fas fa-info-circle mr-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-jobs animate-fade-in">
                    <i class="fas fa-briefcase empty-icon"></i>
                    <h3 class="empty-title">Belum Ada Lowongan Tersedia</h3>
                    <p class="empty-description">
                        Saat ini belum ada lowongan pekerjaan yang tersedia. Tetap pantau halaman ini untuk update terbaru atau tingkatkan skill Anda dengan mengikuti program pelatihan kami.
                    </p>
                    <a href="{{ route('courses.index') }}" class="btn-alternative">
                        <i class="fas fa-rocket mr-2"></i>Jelajahi Program Pelatihan
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Ripple effect for job cards
    $('.job-card').on('click', function(e) {
        const $this = $(this);
        const offset = $this.offset();
        const x = e.pageX - offset.left;
        const y = e.pageY - offset.top;
        
        const $ripple = $('<span style="position: absolute; border-radius: 50%; background: rgba(255, 140, 0, 0.3); transform: scale(0); animation: rippleAnimation 0.8s linear; pointer-events: none; z-index: 10;"></span>');
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

    // Hover animation for job cards
    $('.job-card').hover(
        function() {
            $(this).css('animation', 'gentleFloat 2s ease-in-out infinite');
        },
        function() {
            $(this).css('animation', 'none');
        }
    );

    // Scroll animations
    $(window).scroll(function() {
        $('.animate-fade-in, .animate-slide-up').each(function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();
            
            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('animated');
            }
        });
    });

    // Enhanced meta icon hover effects
    $('.job-meta-icon').hover(
        function() {
            $(this).css({
                'transform': 'scale(1.3) rotate(15deg)',
                'color': 'var(--primary-blue)'
            });
        },
        function() {
            $(this).css({
                'transform': 'scale(1) rotate(0deg)',
                'color': 'var(--warning-orange)'
            });
        }
    );
});

console.log('Enhanced Job Listings Page Loaded');
</script>
@endpush