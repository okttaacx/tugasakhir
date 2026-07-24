@extends('layouts.appuser')

@section('title', $loker->title)

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
        /* margin-top: 7rem; */
        overflow-x: hidden;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(
            135deg,
            rgba(1, 62, 126, 0.95) 0%,
            rgba(0, 86, 179, 0.9) 50%,
            rgba(0, 123, 255, 0.85) 100%
        );
        position: relative;
        padding: 4rem 0 6rem 0;
        margin-bottom: -3rem;
        border-radius: 0 0 50px 50px;
        overflow: hidden;
    }

    .hero-section::before {
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

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .hero-title {
        font-size: 3rem;
        color: var(--text-white);
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        letter-spacing: -0.5px;
    }

    .hero-subtitle {
        color: var(--text-light);
        font-size: 1.25rem;
        font-weight: 500;
    }

    /* Main Content Card */
    .main-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: none;
        border-radius: 20px;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.15),
            0 8px 24px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
        position: relative;
        overflow: hidden;
        transform: translateY(-3rem);
        transition: var(--transition);
    }

    .main-card::before {
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

    /* Image Container */
    .image-container {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        transition: var(--transition);
    }

    .image-container:hover {
        transform: scale(1.02);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
    }

    .job-image {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        transition: var(--transition);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(
            135deg,
            rgba(1, 62, 126, 0.1) 0%,
            rgba(255, 140, 0, 0.1) 100%
        );
        opacity: 0;
        transition: var(--transition);
    }

    .image-container:hover .image-overlay {
        opacity: 1;
    }

    /* Content Styling */
    .job-title {
        color: var(--dark-steel);
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        position: relative;
    }

    .job-meta {
        background: linear-gradient(135deg, var(--metallic-silver) 0%, rgba(248, 250, 252, 0.8) 100%);
        padding: 1.5rem;
        border-radius: 12px;
        border-left: 4px solid var(--warning-orange);
        margin-bottom: 2rem;
        position: relative;
    }

    .job-meta::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 20px;
        height: 20px;
        background: var(--warning-orange);
        clip-path: polygon(0 0, 100% 0, 100% 100%);
    }

    .meta-icon {
        color: var(--warning-orange);
        font-size: 1.25rem;
        margin-right: 0.75rem;
        filter: drop-shadow(0 2px 4px rgba(255, 140, 0, 0.3));
    }

    .description-section {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        padding: 2.5rem;
        border-radius: 16px;
        border: 1px solid rgba(1, 62, 126, 0.1);
        position: relative;
        margin-bottom: 2rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
    }

    .description-section::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-blue), var(--accent-blue));
        border-radius: 16px 16px 0 0;
    }

    .section-title {
        color: var(--dark-steel);
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, var(--warning-orange), var(--primary-blue));
        border-radius: 2px;
    }

    .description-content {
        color: var(--steel-gray);
        font-size: 1.125rem;
        line-height: 1.7;
        padding-left: 1rem;
        border-left: 3px solid var(--accent-blue);
        position: relative;
    }

    /* Action Buttons */
    .action-section {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        padding: 2rem;
        border-radius: 16px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .action-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 70% 80%, rgba(255, 140, 0, 0.1) 0%, transparent 50%);
        z-index: 1;
    }

    .action-content {
        position: relative;
        z-index: 2;
    }

    .btn-back {
        background: linear-gradient(135deg, var(--steel-gray), var(--dark-steel));
        border: none;
        border-radius: 25px;
        padding: 12px 28px;
        font-weight: 600;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
        box-shadow: 0 4px 16px rgba(74, 85, 104, 0.3);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-back:hover::before {
        left: 100%;
    }

    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(74, 85, 104, 0.4);
        color: white;
        text-decoration: none;
    }

    /* Floating Elements */
    .floating-badge {
        position: absolute;
        top: 2rem;
        right: 2rem;
        background: linear-gradient(135deg, var(--warning-orange), var(--industrial-yellow));
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 8px 25px rgba(255, 140, 0, 0.3);
        z-index: 10;
        animation: gentleFloat 3s ease-in-out infinite;
    }

    /* Animations */
    @keyframes gentleFloat {
        0%, 100% { 
            transform: translateY(0px) rotateZ(0deg);
        }
        50% { 
            transform: translateY(-8px) rotateZ(1deg);
        }
    }

    @keyframes fadeInUp {
        from { 
            opacity: 0; 
            transform: translateY(30px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }

    .animate-fade-in {
        animation: fadeInUp 1s ease-out;
    }

    .animate-delay-1 {
        animation-delay: 0.2s;
        animation-fill-mode: both;
    }

    .animate-delay-2 {
        animation-delay: 0.4s;
        animation-fill-mode: both;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .job-title {
            font-size: 2rem;
        }
        
        .main-card {
            transform: translateY(-2rem);
        }
        
        .hero-section {
            padding: 3rem 0 4rem 0;
            margin-bottom: -2rem;
        }
        
        .floating-badge {
            top: 1rem;
            right: 1rem;
            font-size: 0.75rem;
            padding: 0.5rem 1rem;
        }
        
        .description-section {
            padding: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 1.5rem;
        }
        
        .job-title {
            font-size: 1.75rem;
        }
        
        .description-content {
            font-size: 1rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="hero-content animate-fade-in">
            <h1 class="hero-title">Lowongan Kerja</h1>
            <p class="hero-subtitle">Temukan peluang karir terbaik bersama mitra industri kami</p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Floating Badge -->
            <div class="floating-badge">
                <i class="fas fa-briefcase mr-2"></i>
                Lowongan Aktif
            </div>
            
            <div class="main-card animate-fade-in animate-delay-1">
                <div class="card-body p-4 p-lg-5">
                    <div class="row">
                        @if($loker->poster)
                            <div class="col-lg-5 mb-4 mb-lg-0">
                                <div class="image-container">
                                    <img src="{{ asset('storage/' . $loker->poster) }}" 
                                         class="job-image" 
                                         alt="{{ $loker->title }}">
                                    <div class="image-overlay"></div>
                                </div>
                            </div>
                        @endif
                        
                        <div class="{{ $loker->poster ? 'col-lg-7' : 'col-12' }}">
                            <h1 class="job-title animate-fade-in animate-delay-2">{{ $loker->title }}</h1>
                            
                            <div class="job-meta animate-fade-in animate-delay-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-alt meta-icon"></i>
                                    <div>
                                        <small class="text-muted d-block">Dipublikasi</small>
                                        <strong class="text-dark">{{ $loker->created_at->diffForHumans() }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($loker->deskripsi)
                        <div class="description-section animate-fade-in animate-delay-2">
                            <h3 class="section-title">
                                <i class="fas fa-info-circle mr-2" style="color: var(--accent-blue);"></i>
                                Deskripsi Lowongan
                            </h3>
                            <div class="description-content">
                                {!! nl2br(e($loker->deskripsi)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Action Section -->
                    <div class="action-section animate-fade-in animate-delay-2">
                        <div class="action-content">
                            <h4 style="color: var(--text-white); margin-bottom: 1rem; font-weight: 700;">
                                Tertarik dengan lowongan ini?
                            </h4>
                            <p style="color: var(--text-light); margin-bottom: 2rem;">
                                Kembali ke halaman daftar untuk melihat lowongan lainnya
                            </p>
                            <a href="{{ route('lokers.index') }}" class="btn-back">
                                <i class="fas fa-arrow-left"></i>
                                Kembali ke Daftar Lowongan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional spacing -->
<div style="height: 4rem;"></div>

<script>
    $(document).ready(function() {
        // Scroll animations
        $(window).scroll(function() {
            $('.animate-fade-in').each(function() {
                var elementTop = $(this).offset().top;
                var elementBottom = elementTop + $(this).outerHeight();
                var viewportTop = $(window).scrollTop();
                var viewportBottom = viewportTop + $(window).height();
                
                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    $(this).addClass('animated');
                }
            });
        });
    });
</script>
@endsection