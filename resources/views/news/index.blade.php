@extends('layouts.adminapp')

@section('title', 'Manajemen Berita')

@section('content')
<style>
    :root {
        --primary-blue: #013e7e;
        --secondary-blue: #0056b3;
        --accent-blue: #007bff;
        --text-white: #ffffff;
        --text-light: rgba(255,255,255,0.9);
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
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, var(--metallic-silver) 0%, #f7fafc 100%);
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Enhanced Header */
    .header {
        background: linear-gradient(135deg, 
            var(--primary-blue) 0%, 
            var(--secondary-blue) 50%, 
            var(--dark-steel) 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 
            0 20px 60px rgba(1, 62, 126, 0.15),
            0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .header::before {
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
            rgba(255, 255, 255, 0.02) 2px,
            rgba(255, 255, 255, 0.02) 4px
        );
        pointer-events: none;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        z-index: 2;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--text-white);
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        letter-spacing: 1px;
    }

    .page-subtitle {
        color: var(--text-light);
        font-size: 1.1rem;
        margin-top: 0.5rem;
        font-weight: 400;
    }

    /* Enhanced Primary Button */
    .btn-primary {
        background: linear-gradient(145deg, 
            var(--warning-orange) 0%, 
            rgba(255, 140, 0, 0.9) 100%);
        color: var(--text-white);
        padding: 1rem 2rem;
        border-radius: 16px;
        text-decoration: none;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 600;
        border: none;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(255, 140, 0, 0.3);
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
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 15px 40px rgba(255, 140, 0, 0.4);
        color: var(--text-white);
    }

    .btn-small {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(255, 140, 0, 0.2);
    }

    /* Enhanced Alert */
    .alert-success {
        background: linear-gradient(135deg, var(--success-green), rgba(56, 161, 105, 0.9));
        border: none;
        color: var(--text-white);
        padding: 1rem 1.5rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: 0 8px 25px rgba(56, 161, 105, 0.2);
        position: relative;
        overflow: hidden;
    }

    .alert-success::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: repeating-linear-gradient(
            45deg,
            transparent,
            transparent 10px,
            rgba(255, 255, 255, 0.05) 10px,
            rgba(255, 255, 255, 0.05) 12px
        );
        pointer-events: none;
    }

    /* Enhanced Grid */
    .news-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    @media (min-width: 768px) {
        .news-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1200px) {
        .news-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (min-width: 1600px) {
        .news-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    /* Enhanced News Cards */
    .news-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 20px;
        overflow: hidden;
        transition: var(--transition);
        position: relative;
        border: 1px solid rgba(1, 62, 126, 0.08);
        box-shadow: 
            0 10px 30px rgba(0, 0, 0, 0.08),
            0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .news-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, 
            var(--primary-blue) 0%, 
            var(--warning-orange) 50%, 
            var(--success-green) 100%);
        opacity: 0;
        transition: var(--transition);
    }

    .news-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 
            0 25px 60px rgba(0, 0, 0, 0.15),
            0 15px 40px rgba(1, 62, 126, 0.1);
    }

    .news-card:hover::before {
        opacity: 1;
    }

    .image-container {
        width: 100%;
        height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        position: relative;
        overflow: hidden;
    }

    .news-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .news-card:hover .news-image {
        transform: scale(1.05);
    }

    .no-image {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, 
            var(--metallic-silver) 0%, 
            var(--light-steel) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: var(--dark-steel);
    }

    .no-image i {
        font-size: 3rem;
        margin-bottom: 0.5rem;
        opacity: 0.5;
    }

    .no-image-text {
        color: var(--steel-gray);
        font-weight: 500;
    }

    .card-content {
        padding: 1.5rem;
    }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    /* Enhanced Status Badges */
    .status-badge {
        padding: 0.5rem 1rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
    }

    .status-published {
        background: linear-gradient(135deg, var(--success-green), rgba(56, 161, 105, 0.9));
        color: var(--text-white);
        box-shadow: 0 4px 15px rgba(56, 161, 105, 0.3);
    }

    .status-draft {
        background: linear-gradient(135deg, var(--industrial-yellow), rgba(255, 193, 7, 0.9));
        color: var(--carbon-black);
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
    }

    .date-text {
        font-size: 0.8rem;
        color: var(--light-steel);
        font-weight: 500;
        background: rgba(1, 62, 126, 0.05);
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
    }

    .news-title {
        font-weight: 700;
        font-size: 1.2rem;
        margin: 0 0 1rem 0;
        color: var(--dark-steel);
        line-height: 1.4;
    }

    .news-excerpt {
        color: var(--steel-gray);
        font-size: 0.9rem;
        margin: 0 0 1.5rem 0;
        line-height: 1.6;
    }

    .card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 1rem;
        border-top: 1px solid rgba(1, 62, 126, 0.08);
    }

    .author-text {
        font-size: 0.8rem;
        color: var(--light-steel);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .author-text i {
        color: var(--warning-orange);
    }

    /* Enhanced Empty State */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 20px;
        border: 2px dashed rgba(1, 62, 126, 0.2);
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--light-steel);
        margin-bottom: 1rem;
    }

    .empty-text {
        color: var(--steel-gray);
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .empty-subtext {
        color: var(--light-steel);
        font-size: 1rem;
        margin-bottom: 2rem;
    }

    .empty-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--primary-blue);
        text-decoration: none;
        font-weight: 600;
        padding: 1rem 2rem;
        border: 2px solid var(--primary-blue);
        border-radius: 16px;
        transition: var(--transition);
    }

    .empty-link:hover {
        background: var(--primary-blue);
        color: var(--text-white);
        transform: translateY(-2px);
    }

    /* Enhanced Pagination */
    .pagination-container {
        margin-top: 3rem;
        display: flex;
        justify-content: center;
    }

    /* Utility Classes */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Animation */
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .news-card {
        animation: slideUp 0.6s ease-out;
    }

    .news-card:nth-child(1) { animation-delay: 0.1s; }
    .news-card:nth-child(2) { animation-delay: 0.2s; }
    .news-card:nth-child(3) { animation-delay: 0.3s; }
    .news-card:nth-child(4) { animation-delay: 0.4s; }
    .news-card:nth-child(5) { animation-delay: 0.5s; }
    .news-card:nth-child(6) { animation-delay: 0.6s; }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        padding: 1.5rem;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: var(--transition);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--text-white);
    }

    .stat-icon.published {
        background: linear-gradient(135deg, var(--success-green), rgba(56, 161, 105, 0.8));
    }

    .stat-icon.draft {
        background: linear-gradient(135deg, var(--industrial-yellow), rgba(255, 193, 7, 0.8));
    }

    .stat-icon.total {
        background: linear-gradient(135deg, var(--primary-blue), rgba(1, 62, 126, 0.8));
    }

    .stat-info h3 {
        margin: 0;
        font-size: 2rem;
        font-weight: 800;
        color: var(--dark-steel);
    }

    .stat-info p {
        margin: 0;
        color: var(--light-steel);
        font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        .header-content {
            flex-direction: column;
            gap: 1.5rem;
            text-align: center;
        }

        .page-title {
            font-size: 2rem;
        }

        .news-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container">
    <!-- Enhanced Header -->
    <div class="header">
        <div class="header-content">
            <div>
                <h1 class="page-title">Manajemen Berita</h1>
                <p class="page-subtitle">Kelola semua artikel dan berita platform pelatihan</p>
            </div>
            <a href="{{ route('news.create') }}" class="btn-primary">
                <i class="fas fa-plus"></i>
                Tambah Berita
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Stats Overview -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon total">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $news->total() ?? 0 }}</h3>
                <p>Total Berita</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon published">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $news->where('status', 'published')->count() ?? 0 }}</h3>
                <p>Terpublikasi</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon draft">
                <i class="fas fa-edit"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $news->where('status', 'draft')->count() ?? 0 }}</h3>
                <p>Draft</p>
            </div>
        </div>
    </div>

    <!-- News Grid -->
    <div class="news-grid">
        @forelse($news as $article)
            <div class="news-card">
                @if($article->thumbnail)
                    <div class="image-container">
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" 
                             alt="{{ $article->title }}" 
                             class="news-image">
                    </div>
                @else
                    <div class="no-image">
                        <i class="fas fa-image"></i>
                        <span class="no-image-text">No Image</span>
                    </div>
                @endif
                
                <div class="card-content">
                    <div class="card-header">
                        <span class="status-badge {{ $article->status === 'published' ? 'status-published' : 'status-draft' }}">
                            {{ $article->status === 'published' ? 'Published' : 'Draft' }}
                        </span>
                        <span class="date-text">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ $article->created_at->format('d M Y') }}
                        </span>
                    </div>
                    
                    <h3 class="news-title line-clamp-2">
                        {{ $article->title }}
                    </h3>
                    
                    <p class="news-excerpt line-clamp-3">
                        {{ $article->excerpt }}
                    </p>
                    
                    <div class="card-footer">
                        <span class="author-text">
                            <i class="fas fa-user"></i>
                            {{ $article->author->name }}
                        </span>
                        
                        <a href="{{ route('news.show', $article) }}" 
                           class="btn-primary btn-small">
                            <i class="fas fa-eye"></i>
                            Lihat
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <p class="empty-text">Belum ada berita</p>
                <p class="empty-subtext">Mulai buat konten untuk platform pelatihan kerja Anda</p>
                <a href="{{ route('news.create') }}" class="empty-link">
                    <i class="fas fa-plus"></i>
                    Buat Berita Pertama
                </a>
            </div>
        @endforelse
    </div>

    @if($news->hasPages())
        <div class="pagination-container">
            {{ $news->links() }}
        </div>
    @endif
</div>

<script>
    // Add loading animation
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.news-card');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });

        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            observer.observe(card);
        });
    });

    console.log('Enhanced News Management Loaded');
</script>
@endsection