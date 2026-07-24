@extends('layouts.adminapp')

@section('title', $news->title)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/news-detail.css') }}">
@endpush

@section('content')
<style>
    /* Enhanced News Detail Styles - Industrial Theme */
    :root {
        --primary-blue: #013e7e;
        --secondary-blue: #0056b3;
        --accent-blue: #007bff;
        --text-white: #ffffff;
        --text-light: rgba(255,255,255,0.9);
        --steel-gray: #4a5568;
        --dark-steel: #2d3748;
        --light-steel: #718096;
        --warning-orange: #ff8c00;
        --success-green: #38a169;
        --industrial-yellow: #ffc107;
        --carbon-black: #1a202c;
        --metallic-silver: #e2e8f0;
        --gradient-bg: linear-gradient(135deg, var(--metallic-silver) 0%, #f7fafc 100%);
        --shadow-light: 0 4px 20px rgba(0, 0, 0, 0.08);
        --shadow-medium: 0 8px 32px rgba(1, 62, 126, 0.12);
        --shadow-heavy: 0 20px 60px rgba(0, 0, 0, 0.15);
        --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
        background: var(--gradient-bg);
        color: var(--dark-steel);
        line-height: 1.6;
    }

    .industrial-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
        position: relative;
    }

    .industrial-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: repeating-linear-gradient(
            45deg,
            transparent,
            transparent 100px,
            rgba(1, 62, 126, 0.01) 100px,
            rgba(1, 62, 126, 0.01) 102px
        );
        pointer-events: none;
        z-index: -1;
    }

    /* Industrial Navigation */
    .nav-section {
        margin-bottom: 2rem;
        position: relative;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 12px 24px;
        background: linear-gradient(145deg, 
            var(--primary-blue) 0%, 
            var(--secondary-blue) 100%);
        color: var(--text-white);
        text-decoration: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        border: 2px solid rgba(255, 255, 255, 0.1);
        box-shadow: var(--shadow-light);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .back-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, 
            transparent, 
            rgba(255, 140, 0, 0.2), 
            transparent);
        transition: left 0.6s ease;
    }

    .back-link:hover::before {
        left: 100%;
    }

    .back-link:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
        border-color: var(--warning-orange);
        color: var(--text-white);
    }

    .back-icon {
        width: 18px;
        height: 18px;
        transition: var(--transition);
    }

    .back-link:hover .back-icon {
        transform: translateX(-4px);
    }

    /* Industrial Article Card */
    .article-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 20px;
        border: 2px solid rgba(1, 62, 126, 0.1);
        box-shadow: var(--shadow-medium);
        padding: 3rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .article-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, 
            var(--primary-blue) 0%, 
            var(--warning-orange) 50%, 
            var(--secondary-blue) 100%);
    }

    .article-card::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, 
            rgba(255, 140, 0, 0.05) 0%, 
            transparent 70%);
        border-radius: 50%;
        transform: translate(30%, -30%);
    }

    /* Industrial Status Badge */
    .status-section {
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .status {
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-light);
    }

    .status::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: repeating-linear-gradient(
            45deg,
            transparent,
            transparent 2px,
            rgba(255, 255, 255, 0.1) 2px,
            rgba(255, 255, 255, 0.1) 4px
        );
    }

    .status-published {
        background: linear-gradient(145deg, 
            var(--success-green) 0%, 
            #48bb78 100%);
        color: var(--text-white);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .status-draft {
        background: linear-gradient(145deg, 
            var(--warning-orange) 0%, 
            #ffa726 100%);
        color: var(--text-white);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    /* Industrial Typography */
    .article-title {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, 
            var(--primary-blue) 0%, 
            var(--dark-steel) 100%);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 2rem;
        line-height: 1.2;
        letter-spacing: -0.02em;
        position: relative;
    }

    @media (max-width: 768px) {
        .article-title {
            font-size: 2rem;
        }
    }

    /* Industrial Meta Information */
    .meta-container {
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 2rem;
        align-items: center;
        margin-bottom: 3rem;
        padding: 2rem;
        background: linear-gradient(145deg, 
            rgba(1, 62, 126, 0.02) 0%, 
            rgba(255, 140, 0, 0.02) 100%);
        border-radius: 16px;
        border: 1px solid rgba(1, 62, 126, 0.1);
        position: relative;
        overflow: hidden;
    }

    .meta-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--warning-orange);
    }

    .author-container {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .author-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(145deg, 
            var(--primary-blue) 0%, 
            var(--secondary-blue) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: var(--text-white);
        font-size: 1.2rem;
        border: 3px solid var(--warning-orange);
        box-shadow: var(--shadow-light);
        position: relative;
        overflow: hidden;
    }

    .author-avatar::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: repeating-conic-gradient(
            from 0deg,
            transparent 0deg,
            rgba(255, 140, 0, 0.1) 90deg,
            transparent 180deg
        );
        animation: rotate 10s linear infinite;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .author-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .author-name {
        font-weight: 700;
        color: var(--dark-steel);
        font-size: 1rem;
        margin: 0;
    }

    .author-role {
        font-size: 0.8rem;
        color: var(--light-steel);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .date-container {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 12px 20px;
        background: linear-gradient(145deg, 
            rgba(255, 140, 0, 0.1) 0%, 
            rgba(255, 140, 0, 0.05) 100%);
        border-radius: 12px;
        border: 1px solid rgba(255, 140, 0, 0.2);
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--steel-gray);
    }

    .date-icon {
        width: 18px;
        height: 18px;
        color: var(--warning-orange);
    }

    /* Industrial Thumbnail */
    .thumbnail-container {
        margin-bottom: 3rem;
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-medium);
    }

    .thumbnail-img {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        border-radius: 16px;
        transition: var(--transition);
    }

    .thumbnail-container:hover .thumbnail-img {
        transform: scale(1.02);
    }

    .thumbnail-container::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(
            45deg,
            rgba(1, 62, 126, 0.1) 0%,
            transparent 50%,
            rgba(255, 140, 0, 0.1) 100%
        );
        pointer-events: none;
    }

    /* Industrial Content */
    .content-text {
        color: var(--dark-steel);
        line-height: 1.8;
        font-size: 1.1rem;
        font-weight: 400;
        white-space: pre-wrap;
        position: relative;
        padding: 2rem;
        background: linear-gradient(145deg, 
            rgba(255, 255, 255, 0.8) 0%, 
            rgba(248, 250, 252, 0.8) 100%);
        border-radius: 12px;
        border: 1px solid rgba(1, 62, 126, 0.05);
        margin-bottom: 3rem;
    }

    .content-text::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, 
            var(--primary-blue) 0%, 
            var(--warning-orange) 100%);
        border-radius: 2px;
    }

    /* Industrial Actions */
    .actions-container {
        display: flex;
        gap: 1rem;
        padding: 2rem;
        background: linear-gradient(145deg, 
            rgba(1, 62, 126, 0.02) 0%, 
            rgba(255, 140, 0, 0.02) 100%);
        border-radius: 16px;
        border: 1px solid rgba(1, 62, 126, 0.1);
        position: relative;
    }

    .actions-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, 
            var(--primary-blue) 0%, 
            var(--warning-orange) 50%, 
            var(--secondary-blue) 100%);
        border-radius: 1px;
    }

    /* Industrial Buttons */
    .btn {
        padding: 14px 28px;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        border: 2px solid transparent;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-light);
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, 
            transparent, 
            rgba(255, 255, 255, 0.2), 
            transparent);
        transition: left 0.6s ease;
    }

    .btn:hover::before {
        left: 100%;
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-heavy);
    }

    .btn-primary {
        background: linear-gradient(145deg, 
            var(--primary-blue) 0%, 
            var(--secondary-blue) 100%);
        border-color: rgba(255, 255, 255, 0.2);
        color: var(--text-white);
    }

    .btn-primary:hover {
        background: linear-gradient(145deg, 
            var(--secondary-blue) 0%, 
            var(--primary-blue) 100%);
        border-color: var(--warning-orange);
        color: var(--text-white);
    }

    .btn-danger {
        background: linear-gradient(145deg, 
            #dc3545 0%, 
            #c82333 100%);
        border-color: rgba(255, 255, 255, 0.2);
        color: var(--text-white);
    }

    .btn-danger:hover {
        background: linear-gradient(145deg, 
            #c82333 0%, 
            #a71e2a 100%);
        border-color: var(--warning-orange);
        color: var(--text-white);
    }

    .btn-icon {
        width: 18px;
        height: 18px;
        transition: var(--transition);
    }

    .btn:hover .btn-icon {
        transform: scale(1.1);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .industrial-container {
            padding: 1rem;
        }

        .article-card {
            padding: 2rem 1.5rem;
            border-radius: 16px;
        }

        .meta-container {
            grid-template-columns: 1fr;
            gap: 1.5rem;
            padding: 1.5rem;
        }

        .actions-container {
            flex-direction: column;
            padding: 1.5rem;
        }

        .btn {
            justify-content: center;
            width: 100%;
        }

        .content-text {
            padding: 1.5rem;
            font-size: 1rem;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .article-title {
            font-size: 1.5rem;
        }

        .article-card {
            padding: 1.5rem 1rem;
        }

        .thumbnail-img {
            max-height: 300px;
        }
    }

    /* Loading Animation */
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .article-card {
        animation: slideUp 0.6s ease-out;
    }

    .back-link {
        animation: slideUp 0.4s ease-out;
    }

    /* Hover Effects */
    .article-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 40px rgba(1, 62, 126, 0.15);
    }
</style>

<div class="industrial-container">
    <!-- Industrial Navigation -->
    <div class="nav-section">
        <a href="{{ route('news.index') }}" class="back-link">
            <svg class="back-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar Berita
        </a>
    </div>

    <!-- Industrial Article -->
    <div class="article-card">
        <!-- Industrial Status -->
        <div class="status-section">
            <span class="status status-{{ $news->status }}">
                {{ $news->status === 'published' ? 'Dipublikasi' : 'Draft' }}
            </span>
        </div>

        <!-- Industrial Title -->
        <h1 class="article-title">
            {{ $news->title }}
        </h1>

        <!-- Industrial Meta -->
        <div class="meta-container">
            <div class="author-container">
                <div class="author-avatar">
                    {{ substr($news->author->name ?? 'A', 0, 1) }}
                </div>
                <div class="author-info">
                    <p class="author-name">{{ $news->author->name ?? 'Admin' }}</p>
                    <p class="author-role">Penulis</p>
                </div>
            </div>
            
            <div></div> <!-- Spacer for grid -->
            
            <div class="date-container">
                <svg class="date-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>{{ $news->published_at ? $news->published_at->format('d F Y, H:i') : $news->created_at->format('d F Y, H:i') }}</span>
            </div>
        </div>

        <!-- Industrial Thumbnail -->
        @if($news->thumbnail)
        <div class="thumbnail-container">
            <img src="{{ Storage::url($news->thumbnail) }}" 
                 alt="{{ $news->title }}" 
                 class="thumbnail-img">
        </div>
        @endif

        <!-- Industrial Content -->
        <div class="content-text">{{ $news->content }}</div>

        <!-- Industrial Actions -->
        @auth
        @if(auth()->user()->hasAnyRole(['admin', 'super_admin']) || auth()->id() === $news->author_id)
        <div class="actions-container">
            <a href="{{ route('news.edit', $news) }}" class="btn btn-primary">
                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Berita
            </a>
            
            <form method="POST" action="{{ route('news.destroy', $news) }}" 
                  onsubmit="return confirm('Yakin ingin menghapus berita ini?')" class="inline-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus Berita
                </button>
            </form>
        </div>
        @endif
        @endauth
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enhanced loading animation
        const elements = document.querySelectorAll('.article-card, .back-link');
        elements.forEach((el, index) => {
            el.style.animationDelay = `${index * 0.1}s`;
        });

        // Smooth scroll to top when back button is clicked
        document.querySelector('.back-link').addEventListener('click', function(e) {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>
@endpush

@endsection