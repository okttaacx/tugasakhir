@extends('layouts.appuser')

@section('title', 'Daftar Pelatihan')

@section('content')
<style>
    :root {
        --primary-blue: #013e7e;
        --secondary-blue: #0056b3;
        --accent-blue: #007bff;
        --text-white: #ffffff;
        --text-light: rgba(255,255,255,0.8);
        --shadow: 0 4px 15px rgba(0,0,0,0.1);
        --shadow-hover: 0 10px 30px rgba(0,0,0,0.12);
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

    .training-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 3rem 1.5rem;
        background: linear-gradient(135deg, var(--metallic-silver) 0%, #f7fafc 100%);
    }

    .training-page-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .training-page-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--dark-steel);
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
        animation: fadeIn 1s ease-out;
    }

    .training-page-subtitle {
        color: var(--light-steel);
        font-size: 1.125rem;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* --- SEARCH SECTION --- */
    .training-search-section {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 16px;
        box-shadow: var(--shadow);
        margin: 0 auto 3rem;
        max-width: 720px;
        padding: 1.5rem;
        border: 1px solid rgba(1, 62, 126, 0.1);
        position: relative;
        animation: slideUp 1s ease-out;
    }

    .training-search-section::before,
    .training-card::before,
    .training-empty-state::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-blue) 0%, var(--accent-blue) 50%, var(--warning-orange) 100%);
        border-radius: 16px 16px 0 0;
        z-index: 2;
    }

    .training-search-form {
        display: flex;
        flex-direction: row; 
        gap: 1rem;
        width: 100%;
        margin: 0 auto;
        align-items: stretch;
    }

    .training-search-input {
        flex: 1; 
        width: 100%;
        padding: 1rem 1.25rem; 
        border: 2px solid var(--metallic-silver);
        border-radius: 12px;
        font-size: 1rem;
        transition: var(--transition);
        font-family: inherit;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .training-search-input:focus {
        outline: none;
        border-color: var(--accent-blue);
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }

    .training-btn {
        padding: 0.875rem 1.5rem;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        transition: var(--transition);
        text-align: center;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.95rem;
        position: relative;
        overflow: hidden;
        font-family: inherit;
        white-space: nowrap;
    }

    .training-btn-primary {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        color: var(--text-white);
        box-shadow: 0 4px 16px rgba(1, 62, 126, 0.3);
    }

    .training-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(1, 62, 126, 0.4);
        background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
        color: var(--text-white);
    }

    .training-btn-secondary {
        border: 2px solid var(--accent-blue);
        color: var(--accent-blue);
        background: transparent;
    }

    .training-btn-secondary:hover {
        background: var(--accent-blue);
        color: var(--text-white);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
    }

    .training-btn-success {
        background: linear-gradient(135deg, var(--success-green), var(--industrial-yellow));
        color: var(--text-white);
        box-shadow: 0 4px 16px rgba(56, 161, 105, 0.3);
    }

    .training-btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(56, 161, 105, 0.4);
        color: var(--text-white);
    }

    .training-btn-disabled {
        background: var(--metallic-silver);
        color: var(--light-steel);
        cursor: not-allowed;
        border: 1px solid var(--metallic-silver);
    }

    /* --- CARDS SECTION --- */
    .trainings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
        justify-content: center;
    }

    .training-card {
        display: flex;
        flex-direction: column;
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 16px;
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
        transition: var(--transition);
        transform: perspective(1000px) rotateX(0deg) rotateY(0deg);
        border: 1px solid rgba(1, 62, 126, 0.1);
        width: 100%;
        max-width: 380px;
        margin: 0 auto;
        opacity: 0;
        transform: translateY(30px);
    }

    .training-card.animated {
        animation: slideUp 0.8s ease-out forwards;
    }

    .training-card:hover {
        transform: perspective(1000px) rotateX(5deg) rotateY(-2deg) translateY(-12px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15), 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .training-image-container {
        position: relative;
        width: 100%;
        height: 220px;
        overflow: hidden;
        flex-shrink: 0;
        background-color: var(--metallic-silver);
    }

    .training-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: var(--transition);
        filter: brightness(0.9);
    }

    .training-card:hover .training-image {
        transform: scale(1.08) rotateZ(1deg);
        filter: brightness(1.1) contrast(1.05);
    }

    .training-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-white);
    }

    .training-capacity-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(255, 255, 255, 0.95);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--dark-steel);
        backdrop-filter: blur(4px);
        border: 1px solid rgba(1, 62, 126, 0.2);
        transition: var(--transition);
        z-index: 3;
    }

    .training-card:hover .training-capacity-badge {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        color: var(--text-white);
        box-shadow: 0 4px 12px rgba(1, 62, 126, 0.4);
    }

    .training-content {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .training-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--dark-steel);
        line-height: 1.4;
        transition: var(--transition);
        min-height: 3.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .training-card:hover .training-title {
        color: var(--primary-blue);
    }

    .training-meta {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .training-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--light-steel);
        font-size: 0.9rem;
    }

    .training-meta-icon {
        width: 18px;
        height: 18px;
        min-width: 18px;
        color: var(--warning-orange);
        transition: var(--transition);
    }

    .training-meta-item:hover .training-meta-icon {
        color: var(--primary-blue);
        transform: scale(1.2) rotate(10deg);
    }

    .training-description {
        color: var(--light-steel);
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
        flex: 1;
    }

    .training-card-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: auto;
    }

    .training-flex-1 {
        flex: 1;
    }

    .icon-sm { width: 16px; height: 16px; margin-right: 0.5rem; }
    .icon-md { width: 20px; height: 20px; margin-right: 0.5rem; }
    .icon-lg { width: 48px; height: 48px; }

    .training-empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 16px;
        box-shadow: var(--shadow);
        border: 1px solid rgba(1, 62, 126, 0.1);
        position: relative;
        animation: fadeIn 1s ease-out;
    }

    .training-empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 1rem;
        color: var(--light-steel);
        filter: drop-shadow(0 4px 8px rgba(1, 62, 126, 0.3));
        transition: var(--transition);
    }

    .training-empty-state:hover .training-empty-icon {
        transform: scale(1.2) rotate(-5deg);
        color: var(--primary-blue);
    }

    .training-empty-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--dark-steel);
        margin-bottom: 0.5rem;
    }

    .training-pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    .pagination {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 4px;
        list-style: none;
        padding: 0;
    }

    .pagination .page-item .page-link {
        border-radius: 12px;
        padding: 0.5rem 1rem;
        color: var(--dark-steel);
        border: 1px solid var(--metallic-silver);
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        transition: var(--transition);
        text-decoration: none;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        color: var(--text-white);
        border-color: var(--primary-blue);
        box-shadow: 0 4px 16px rgba(1, 62, 126, 0.3);
    }

    .pagination .page-item .page-link:hover:not(.active) {
        background: linear-gradient(135deg, var(--metallic-silver), #f8fafc);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .training-search-form { flex-direction: column; }
        .training-search-input, .training-btn { width: 100%; }
        .trainings-grid { grid-template-columns: 1fr; }
        .training-card { max-width: 440px; }
        .training-card-actions { flex-direction: column; }
        .training-page-title { font-size: 1.8rem; }
        .training-image-container { height: 180px; }
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(50px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes rippleAnimation {
        to { transform: scale(4); opacity: 0; }
    }
</style>

<div class="training-container">
    <div class="training-page-header">
        <h1 class="training-page-title">Daftar Pelatihan</h1>
        <p class="training-page-subtitle">Temukan pelatihan yang tepat untuk mengembangkan kemampuan dan karir Anda</p>
    </div>

    <!-- Search Section -->
    <div class="training-search-section">
        <form method="GET" action="{{ route('trainings.user.index') }}" class="training-search-form">
            <input type="text"
                   name="search"
                   value="{{ $search ?? '' }}"
                   placeholder="Cari pelatihan berdasarkan judul..."
                   class="training-search-input">
                   
            <button type="submit" class="training-btn training-btn-primary">
                <svg class="icon-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Cari
            </button>
            
            @if(request('search'))
                <a href="{{ route('trainings.user.index') }}" class="training-btn training-btn-secondary">
                    <svg class="icon-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Training Cards -->
    @if($trainings->count() > 0)
        <div class="trainings-grid">
            @foreach($trainings as $training)
                <div class="training-card">
                    <div class="training-image-container">
                        @php
                            $primaryImage = $training->images->where('is_primary', true)->first();
                            $firstImage = $training->images->first();
                            $imageToShow = $primaryImage ?? $firstImage;
                        @endphp

                        @if($imageToShow)
                            <img src="{{ Storage::url($imageToShow->image_path) }}"
                                 alt="{{ $training->title }}"
                                 class="training-image"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                 
                            <div class="training-placeholder" style="display: none;">
                                <svg class="icon-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        @else
                            <div class="training-placeholder">
                                <svg class="icon-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        @endif

                        <div class="training-capacity-badge">
                            {{ $training->capacity }} peserta
                        </div>
                    </div>

                    <div class="training-content">
                        <h3 class="training-title" title="{{ $training->title }}">{{ $training->title }}</h3>

                        <div class="training-meta">
                            <div class="training-meta-item">
                                <svg class="training-meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ \Carbon\Carbon::parse($training->start_date)->format('d M Y') }}
                                @if($training->end_date && $training->end_date !== $training->start_date)
                                    - {{ \Carbon\Carbon::parse($training->end_date)->format('d M Y') }}
                                @endif
                            </div>

                            <div class="training-meta-item">
                                <svg class="training-meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $training->start_time }}
                                @if($training->end_time)
                                    - {{ $training->end_time }}
                                @endif
                            </div>

                            <div class="training-meta-item">
                                <svg class="training-meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                {{ $training->location }}
                            </div>
                        </div>

                        @if($training->description)
                            <p class="training-description">{{ Str::limit(strip_tags($training->description), 100) }}</p>
                        @endif

                        <div class="training-card-actions">
                            <a href="{{ route('trainings.show', $training->id) }}" class="training-btn training-btn-secondary training-flex-1">
                                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Detail
                            </a>

                            @auth
                                @php
                                    $isRegistered = \App\Models\Registration::where('user_id', auth()->id())
                                        ->where('training_id', $training->id)
                                        ->exists();
                                @endphp

                                @if($isRegistered)
                                    <span class="training-btn training-btn-disabled training-flex-1">
                                        <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Terdaftar
                                    </span>
                                @else
                                    <a href="{{ route('pelatihan.preview', $training->id) }}" class="training-btn training-btn-success training-flex-1">
                                        <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Daftar
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="training-btn training-btn-secondary training-flex-1">
                                    <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    Login
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="training-pagination-wrapper">
            {{ $trainings->appends(['search' => request('search')])->links() }}
        </div>
    @else
        <div class="training-empty-state">
            <svg class="training-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="training-empty-title">Tidak ada pelatihan ditemukan</h3>
            <p class="training-empty-subtitle">
                @if(request('search'))
                    Tidak ada pelatihan yang sesuai dengan pencarian "{{ request('search') }}".
                @else
                    Belum ada pelatihan yang tersedia saat ini.
                @endif
            </p>
        </div>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buttonsAndCards = document.querySelectorAll('.training-card, .training-btn');
        
        buttonsAndCards.forEach(element => {
            element.addEventListener('click', function(e) {
                if(e.target.closest('a') && !this.classList.contains('training-btn')) return;

                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(255, 140, 0, 0.3)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'rippleAnimation 0.8s linear';
                ripple.style.pointerEvents = 'none';
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;
                ripple.style.width = '40px';
                ripple.style.height = '40px';
                ripple.style.marginLeft = '-20px';
                ripple.style.marginTop = '-20px';
                
                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 800);
            });
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.training-card, .training-search-section, .training-empty-state').forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endsection