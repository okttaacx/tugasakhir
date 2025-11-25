@extends('layouts.appuser')

@section('title', $news->title)

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
        line-height: 1.6;
        color: var(--dark-steel);
    }

    /* Header with industrial design */
    .news-header {
        background: 
            linear-gradient(135deg, 
                rgba(1, 62, 126, 0.95) 0%, 
                rgba(0, 86, 179, 0.9) 50%, 
                rgba(0, 123, 255, 0.85) 100%
            );
        position: relative;
        overflow: hidden;
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .news-header::before {
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

    .news-header .container {
        position: relative;
        z-index: 2;
    }

    /* Enhanced back button */
    .back-button {
        display: inline-flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 50px;
        padding: 0.75rem 1.5rem;
        color: var(--text-white);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.875rem;
    }

    .back-button:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        color: var(--text-white);
        text-decoration: none;
        border-color: rgba(255, 255, 255, 0.4);
    }

    .back-button svg {
        width: 20px;
        height: 20px;
        margin-right: 0.5rem;
        transition: transform 0.3s ease;
    }

    .back-button:hover svg {
        transform: translateX(-3px);
    }

    /* Enhanced breadcrumb */
    .industrial-breadcrumb {
        background: 
            linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 15px;
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border-left: 4px solid var(--warning-orange);
        position: relative;
    }

    .industrial-breadcrumb::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 15px;
        height: 15px;
        background: var(--primary-blue);
        clip-path: polygon(0 0, 100% 0, 100% 100%);
        border-radius: 0 15px 0 0;
    }

    .breadcrumb-list {
        display: flex;
        align-items: center;
        list-style: none;
        padding: 0;
        margin: 0;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .breadcrumb-list a {
        color: var(--steel-gray);
        text-decoration: none;
        transition: var(--transition);
        padding: 0.25rem 0.5rem;
        border-radius: 8px;
    }

    .breadcrumb-list a:hover {
        color: var(--primary-blue);
        background: rgba(1, 62, 126, 0.1);
        transform: translateY(-1px);
    }

    .breadcrumb-separator {
        color: var(--light-steel);
        margin: 0 0.5rem;
        font-weight: bold;
    }

    .breadcrumb-current {
        color: var(--primary-blue);
        font-weight: 600;
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Article container */
    .article-container {
        background: 
            linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 20px;
        box-shadow: 
            0 10px 40px rgba(0, 0, 0, 0.1),
            0 4px 16px rgba(0, 0, 0, 0.06);
        padding: 3rem;
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .article-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, 
            var(--primary-blue) 0%, 
            var(--accent-blue) 30%, 
            var(--warning-orange) 70%, 
            var(--success-green) 100%);
        border-radius: 20px 20px 0 0;
    }

    /* Article header */
    .article-header {
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 2px solid rgba(1, 62, 126, 0.1);
        position: relative;
    }

    .article-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--carbon-black);
        margin-bottom: 1.5rem;
        line-height: 1.2;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .article-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        color: var(--steel-gray);
        font-size: 0.9rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        background: rgba(1, 62, 126, 0.05);
        padding: 0.5rem 1rem;
        border-radius: 25px;
        border: 1px solid rgba(1, 62, 126, 0.1);
        transition: var(--transition);
    }

    .meta-item:hover {
        background: rgba(1, 62, 126, 0.1);
        transform: translateY(-2px);
    }

    .meta-icon {
        color: var(--warning-orange);
        margin-right: 0.5rem;
        font-size: 1rem;
    }

    .author-name {
        font-weight: 600;
        color: var(--primary-blue);
    }

    /* Featured image */
    .featured-image-container {
        margin-bottom: 2.5rem;
        text-align: center;
        position: relative;
    }

    .featured-image {
        width: 100%;
        max-width: 800px;
        height: auto;
        border-radius: 15px;
        box-shadow: 
            0 15px 35px rgba(0, 0, 0, 0.1),
            0 5px 15px rgba(0, 0, 0, 0.08);
        transition: var(--transition);
        border: 3px solid rgba(255, 255, 255, 0.8);
    }

    .featured-image:hover {
        transform: scale(1.02);
        box-shadow: 
            0 20px 50px rgba(0, 0, 0, 0.15),
            0 8px 25px rgba(0, 0, 0, 0.1);
    }

    /* Content styling */
    .article-content {
        font-size: 1.125rem;
        line-height: 1.8;
        color: var(--dark-steel);
        margin-bottom: 3rem;
    }

    .article-content p {
        margin-bottom: 1.5rem;
        text-align: justify;
    }

    .article-content p:first-of-type::first-letter {
        float: left;
        font-size: 4rem;
        line-height: 3rem;
        padding-right: 0.5rem;
        padding-top: 0.25rem;
        font-weight: 800;
        color: var(--primary-blue);
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Action section */
    .article-actions {
        background: 
            linear-gradient(135deg, 
                rgba(1, 62, 126, 0.05) 0%, 
                rgba(255, 140, 0, 0.05) 100%);
        padding: 2rem;
        border-radius: 15px;
        border: 2px solid rgba(1, 62, 126, 0.1);
        text-align: center;
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .article-actions::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, 
            var(--primary-blue) 0%, 
            var(--warning-orange) 50%, 
            var(--primary-blue) 100%);
        border-radius: 15px 15px 0 0;
    }

    .enhanced-back-button {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        color: var(--text-white);
        padding: 1rem 2rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: var(--transition);
        box-shadow: 
            0 8px 25px rgba(1, 62, 126, 0.3);
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .enhanced-back-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .enhanced-back-button:hover::before {
        left: 100%;
    }

    .enhanced-back-button:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 
            0 12px 35px rgba(1, 62, 126, 0.4);
        color: var(--text-white);
        text-decoration: none;
        background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
    }

    .enhanced-back-button svg {
        width: 24px;
        height: 24px;
        margin-right: 0.75rem;
        transition: transform 0.3s ease;
    }

    .enhanced-back-button:hover svg {
        transform: translateX(-5px) scale(1.1);
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .news-header {
            padding: 1.5rem 0;
        }
        
        .article-container {
            padding: 2rem 1.5rem;
        }
        
        .article-title {
            font-size: 2rem;
        }
        
        .article-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .article-content {
            font-size: 1rem;
        }
        
        .article-content p:first-of-type::first-letter {
            font-size: 3rem;
            line-height: 2.5rem;
        }
        
        .enhanced-back-button {
            padding: 0.875rem 1.5rem;
            font-size: 0.875rem;
        }
        
        .featured-image-container {
            margin-bottom: 2rem;
        }
    }

    @media (max-width: 480px) {
        .article-title {
            font-size: 1.75rem;
        }
        
        .article-container {
            padding: 1.5rem 1rem;
        }
        
        .back-button {
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
        }
        
        .breadcrumb-current {
            max-width: 200px;
        }
    }

    /* Animation classes */
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .fade-in-delay-1 {
        animation-delay: 0.2s;
    }

    .fade-in-delay-2 {
        animation-delay: 0.4s;
    }

    .fade-in-delay-3 {
        animation-delay: 0.6s;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--metallic-silver);
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, var(--primary-blue), var(--warning-orange));
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, var(--secondary-blue), var(--industrial-yellow));
    }
</style>
@endpush

@section('content')
<div class="news-detail-page">
    <!-- Enhanced Header -->
    <header class="news-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <a href="{{ route('news.public.index') }}" class="back-button fade-in">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Berita
                    </a>
                </div>
                <div class="col-md-6 text-md-right">
                    <div class="d-flex align-items-center justify-content-md-end mt-3 mt-md-0 fade-in fade-in-delay-1">
                        <i class="fas fa-newspaper" style="color: var(--text-white); font-size: 1.5rem; margin-right: 0.75rem;"></i>
                        <span style="color: var(--text-light); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Berita Terkini</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <!-- Enhanced Breadcrumb -->
        <nav class="industrial-breadcrumb fade-in fade-in-delay-2">
            <ol class="breadcrumb-list">
                <li><a href="{{ route('news.public.index') }}">Berita</a></li>
                <li class="breadcrumb-separator">•</li>
                <li class="breadcrumb-current">{{ Str::limit($news->title, 60) }}</li>
            </ol>
        </nav>

        <!-- Article Container -->
        <article class="article-container fade-in fade-in-delay-3">
            <!-- Article Header -->
            <header class="article-header">
                <h1 class="article-title">{{ $news->title }}</h1>
                
                <div class="article-meta">
                    <div class="meta-item">
                        <i class="fas fa-user-edit meta-icon"></i>
                        <span class="author-name">{{ $news->author->name ?? 'Admin' }}</span>
                    </div>
                    
                    <div class="meta-item">
                        <i class="fas fa-calendar-alt meta-icon"></i>
                        <time datetime="{{ $news->published_at->toISOString() }}">
                            {{ $news->published_at->format('d F Y') }}
                        </time>
                    </div>
                    
                    <div class="meta-item">
                        <i class="fas fa-clock meta-icon"></i>
                        <span>{{ $news->published_at->format('H:i') }} WIB</span>
                    </div>
                    
                    <div class="meta-item">
                        <i class="fas fa-eye meta-icon"></i>
                        <span>{{ number_format(rand(150, 1500)) }} views</span>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            @if($news->thumbnail)
            <div class="featured-image-container">
                <img src="{{ asset('storage/' . $news->thumbnail) }}" 
                     alt="{{ $news->title }}"
                     class="featured-image">
            </div>
            @endif

            <!-- Article Content -->
            <div class="article-content">
                {!! nl2br(e($news->content)) !!}
            </div>
        </article>

        <!-- Action Section -->
        <div class="article-actions fade-in">
            <div class="row align-items-center">
                <div class="col-md-8 mb-3 mb-md-0">
                    <h5 style="color: var(--dark-steel); margin-bottom: 0.5rem; font-weight: 700;">
                        <i class="fas fa-info-circle" style="color: var(--warning-orange); margin-right: 0.5rem;"></i>
                        Ingin membaca berita lainnya?
                    </h5>
                    <p style="color: var(--steel-gray); margin: 0; font-size: 0.95rem;">
                        Temukan informasi terkini seputar ketenagakerjaan di Kota Batu
                    </p>
                </div>
                <div class="col-md-4 text-md-right">
                    <a href="{{ route('news.public.index') }}" class="enhanced-back-button">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Lihat Semua Berita
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);

    // Observe all elements with fade-in class
    document.querySelectorAll('.fade-in').forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });

    // Enhanced hover effects for meta items
    document.querySelectorAll('.meta-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.05)';
            this.style.boxShadow = '0 8px 20px rgba(1, 62, 126, 0.15)';
        });

        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = 'none';
        });
    });

    // Remove parallax scrolling - header stays fixed
    // Smooth scrolling removed as requested
});
</script>
@endsection