@extends('layouts.appuser')

@section('title', $training->title)

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
    }

    /* Main Container */
    .training-detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }
    
    /* Back Button */
    .industrial-back-button {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        color: var(--text-white);
        text-decoration: none;
        margin-bottom: 2rem;
        padding: 1rem 2rem;
        border-radius: 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
        box-shadow: 0 4px 16px rgba(1, 62, 126, 0.3);
        border: 2px solid rgba(255, 255, 255, 0.1);
    }

    .industrial-back-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .industrial-back-button:hover::before {
        left: 100%;
    }

    .industrial-back-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 32px rgba(1, 62, 126, 0.4);
        text-decoration: none;
        color: var(--text-white);
    }
    
    /* Main Card */
    .training-detail-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: none;
        border-radius: 20px;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.15),
            0 8px 24px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
        overflow: hidden;
        position: relative;
    }

    .training-detail-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, 
            var(--primary-blue) 0%, 
            var(--accent-blue) 50%, 
            var(--warning-orange) 100%);
        border-radius: 20px 20px 0 0;
        z-index: 1;
    }
    
    /* Image Gallery */
    .industrial-image-gallery {
        position: relative;
        height: 500px;
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-steel) 50%, var(--carbon-black) 100%);
        overflow: hidden;
    }

    .industrial-image-gallery::after {
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

    .main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.9) contrast(1.1);
        transition: var(--transition);
    }

    .main-image:hover {
        transform: scale(1.05);
        filter: brightness(1) contrast(1.2);
    }

    .no-image-placeholder {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-white);
        flex-direction: column;
        position: relative;
        z-index: 2;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }

    .no-image-placeholder h1 {
        font-size: 3rem;
        font-weight: 800;
        margin: 0;
        text-align: center;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.7);
    }

    .no-image-placeholder svg {
        filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.4));
    }
    
    /* Image Navigation */
    .industrial-image-nav {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 0.75rem;
        padding: 1rem;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(15px);
        border-radius: 25px;
        border: 2px solid rgba(255, 255, 255, 0.1);
        z-index: 3;
    }

    .industrial-nav-dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
        cursor: pointer;
        transition: var(--transition);
        border: 2px solid transparent;
    }

    .industrial-nav-dot.active {
        background: var(--warning-orange);
        transform: scale(1.3);
        border-color: rgba(255, 255, 255, 0.5);
        box-shadow: 0 4px 12px rgba(255, 140, 0, 0.4);
    }

    .industrial-nav-dot:hover {
        background: rgba(255, 255, 255, 0.7);
        transform: scale(1.2);
    }
    
    /* Image Arrows */
    .industrial-image-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(10px);
        color: var(--text-white);
        border: 2px solid rgba(255, 255, 255, 0.2);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        opacity: 0;
        z-index: 3;
    }

    .industrial-image-gallery:hover .industrial-image-arrow {
        opacity: 1;
    }

    .industrial-image-arrow:hover {
        background: rgba(0, 0, 0, 0.8);
        border-color: var(--warning-orange);
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 8px 25px rgba(255, 140, 0, 0.3);
    }

    .industrial-image-arrow.prev {
        left: 2rem;
    }

    .industrial-image-arrow.next {
        right: 2rem;
    }
    
    /* Content Section */
    .industrial-content-section {
        padding: 3rem;
        position: relative;
    }

    .industrial-content-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 5%;
        right: 5%;
        height: 2px;
        background: linear-gradient(90deg, 
            transparent 0%, 
            var(--primary-blue) 20%, 
            var(--warning-orange) 50%, 
            var(--primary-blue) 80%, 
            transparent 100%);
        opacity: 0.5;
    }
    
    .industrial-training-title {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary-blue), var(--dark-steel));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 2rem;
        line-height: 1.2;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    /* Info Grid */
    .industrial-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }
    
    .industrial-info-card {
        background: linear-gradient(145deg, #f8fafc 0%, #ffffff 100%);
        padding: 2rem;
        border-radius: 20px;
        border: 2px solid rgba(1, 62, 126, 0.1);
        box-shadow: 
            0 8px 32px rgba(0, 0, 0, 0.08),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
        position: relative;
        overflow: hidden;
        transition: var(--transition);
    }

    .industrial-info-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 6px;
        background: linear-gradient(180deg, var(--primary-blue), var(--warning-orange));
        border-radius: 20px 0 0 20px;
    }

    .industrial-info-card:hover {
        transform: translateY(-8px) rotateX(5deg);
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.12),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
        border-color: rgba(1, 62, 126, 0.2);
    }
    
    .industrial-info-item {
        display: flex;
        align-items: flex-start;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        padding: 1rem;
        border-radius: 12px;
        transition: var(--transition);
    }

    .industrial-info-item:hover {
        background: rgba(1, 62, 126, 0.03);
        transform: translateX(8px);
    }

    .industrial-info-item:last-child {
        margin-bottom: 0;
    }

    .industrial-info-icon {
        width: 32px;
        height: 32px;
        color: var(--warning-orange);
        margin-top: 4px;
        flex-shrink: 0;
        filter: drop-shadow(0 2px 4px rgba(255, 140, 0, 0.3));
        transition: var(--transition);
    }

    .industrial-info-item:hover .industrial-info-icon {
        color: var(--primary-blue);
        transform: scale(1.2) rotateZ(-5deg);
    }

    .industrial-info-content h4 {
        font-size: 0.875rem;
        color: var(--light-steel);
        margin: 0 0 0.5rem 0;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.1em;
    }

    .industrial-info-content p {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--dark-steel);
        margin: 0;
        transition: var(--transition);
    }

    .industrial-info-item:hover .industrial-info-content p {
        color: var(--primary-blue);
    }
    
    /* Status Colors */
    .status-success {
        color: var(--success-green) !important;
        text-shadow: 0 2px 4px rgba(56, 161, 105, 0.3);
    }

    .status-warning {
        color: var(--warning-orange) !important;
        text-shadow: 0 2px 4px rgba(255, 140, 0, 0.3);
    }

    .status-danger {
        color: #dc2626 !important;
        text-shadow: 0 2px 4px rgba(220, 38, 38, 0.3);
    }
    
    /* Description Section */
    .industrial-description-section {
        margin-bottom: 3rem;
        padding: 2rem;
        background: linear-gradient(145deg, rgba(248, 250, 252, 0.5) 0%, rgba(255, 255, 255, 0.3) 100%);
        border-radius: 20px;
        border: 1px solid rgba(1, 62, 126, 0.1);
        position: relative;
    }

    .industrial-description-section::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-blue), var(--warning-orange));
        border-radius: 20px 20px 0 0;
    }

    .industrial-section-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark-steel);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .industrial-section-title svg {
        color: var(--warning-orange);
        filter: drop-shadow(0 2px 4px rgba(255, 140, 0, 0.3));
    }

    .industrial-description-content {
        color: var(--steel-gray);
        line-height: 1.8;
        font-size: 1.1rem;
        text-align: justify;
    }
    
    /* Action Section */
    .industrial-action-section {
        background: linear-gradient(145deg, 
            rgba(1, 62, 126, 0.05) 0%, 
            rgba(248, 250, 252, 0.8) 50%,
            rgba(255, 255, 255, 0.9) 100%);
        padding: 3rem;
        border-radius: 20px;
        margin-top: 3rem;
        border: 2px solid rgba(1, 62, 126, 0.1);
        position: relative;
        overflow: hidden;
    }

    .industrial-action-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 100%;
        background: 
            repeating-linear-gradient(
                -45deg,
                transparent,
                transparent 20px,
                rgba(255, 140, 0, 0.02) 20px,
                rgba(255, 140, 0, 0.02) 40px
            );
        pointer-events: none;
    }
    
    .industrial-action-buttons {
        display: flex;
        gap: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .industrial-btn {
        flex: 1;
        padding: 1.25rem 2.5rem;
        border-radius: 25px;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
    }

    .industrial-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .industrial-btn:hover::before {
        left: 100%;
    }

    .industrial-btn:hover {
        text-decoration: none;
        transform: translateY(-4px);
    }

    .industrial-btn-primary {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: var(--text-white);
        box-shadow: 0 8px 32px rgba(1, 62, 126, 0.3);
        border: 2px solid rgba(255, 255, 255, 0.1);
    }

    .industrial-btn-primary:hover {
        background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--accent-blue) 100%);
        box-shadow: 0 12px 48px rgba(1, 62, 126, 0.4);
        color: var(--text-white);
    }

    .industrial-btn-secondary {
        background: linear-gradient(135deg, var(--steel-gray) 0%, var(--light-steel) 100%);
        color: var(--text-white);
        box-shadow: 0 8px 32px rgba(74, 85, 104, 0.3);
        border: 2px solid rgba(255, 255, 255, 0.1);
    }

    .industrial-btn-secondary:hover {
        background: linear-gradient(135deg, var(--dark-steel) 0%, var(--steel-gray) 100%);
        box-shadow: 0 12px 48px rgba(45, 55, 72, 0.4);
        color: var(--text-white);
    }

    .industrial-btn-success {
        background: linear-gradient(135deg, var(--success-green) 0%, #48bb78 100%);
        color: var(--text-white);
        border: 2px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(56, 161, 105, 0.3);
    }

    .industrial-btn-success:hover {
        background: linear-gradient(135deg, #48bb78 0%, var(--success-green) 100%);
        color: var(--text-white);
    }

    .industrial-btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: var(--text-white);
        box-shadow: 0 8px 32px rgba(239, 68, 68, 0.3);
        border: 2px solid rgba(255, 255, 255, 0.1);
    }

    .industrial-btn-disabled {
        background: linear-gradient(145deg, #f3f4f6 0%, #e5e7eb 100%);
        color: var(--light-steel);
        cursor: not-allowed;
        border: 2px solid #d1d5db;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .industrial-btn-disabled:hover {
        transform: none;
        background: linear-gradient(145deg, #f3f4f6 0%, #e5e7eb 100%);
    }

    .industrial-withdrawal-notice {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        width: 100%;
        align-items: center;
        text-align: center;
        padding: 2rem;
        background: linear-gradient(145deg, rgba(56, 161, 105, 0.1) 0%, rgba(255, 255, 255, 0.8) 100%);
        border-radius: 16px;
        border: 2px solid rgba(56, 161, 105, 0.2);
    }

    .industrial-withdrawal-notice h5 {
        color: var(--steel-gray);
        font-weight: 600;
        margin: 0;
        font-size: 1.1rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .training-detail-container {
            padding: 1rem;
        }

        .industrial-content-section {
            padding: 2rem;
        }

        .industrial-training-title {
            font-size: 2rem;
        }

        .industrial-info-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .industrial-action-buttons {
            flex-direction: column;
        }

        .industrial-image-gallery {
            height: 300px;
        }

        .no-image-placeholder h1 {
            font-size: 2rem;
        }

        .industrial-image-arrow {
            width: 50px;
            height: 50px;
        }

        .industrial-image-arrow.prev {
            left: 1rem;
        }

        .industrial-image-arrow.next {
            right: 1rem;
        }

        .industrial-action-section {
            padding: 2rem;
        }

        .industrial-btn {
            padding: 1rem 2rem;
            font-size: 1rem;
        }
    }

    /* Animations */
    @keyframes industrialFadeIn {
        from { 
            opacity: 0; 
            transform: translateY(30px) rotateX(10deg); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0) rotateX(0); 
        }
    }

    @keyframes industrialSlideUp {
        from { 
            opacity: 0; 
            transform: translateY(50px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }

    .animate-industrial-fade {
        animation: industrialFadeIn 0.8s ease-out;
    }

    .animate-industrial-slide {
        animation: industrialSlideUp 0.6s ease-out;
    }
</style>
@endpush

@section('content')
<div class="training-detail-container">
    <!-- Enhanced Back Button -->
    <a href="{{ route('trainings.user.index') }}" class="industrial-back-button">
        <svg style="width: 24px; height: 24px; margin-right: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali ke Daftar Pelatihan
    </a>

    <div class="training-detail-card animate-industrial-fade">
        <!-- Enhanced Image Gallery -->
        <div class="industrial-image-gallery" id="imageGallery">
            @if($training->images->count() > 0)
                @foreach($training->images as $index => $image)
                    <img src="{{ Storage::url($image->image_path) }}" 
                         alt="{{ $training->title }}" 
                         class="main-image {{ $index === 0 ? 'active' : '' }}" 
                         style="display: {{ $index === 0 ? 'block' : 'none' }}">
                @endforeach
                
                @if($training->images->count() > 1)
                    <!-- Enhanced Navigation Arrows -->
                    <button class="industrial-image-arrow prev" onclick="changeImage(-1)">
                        <svg style="width: 28px; height: 28px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button class="industrial-image-arrow next" onclick="changeImage(1)">
                        <svg style="width: 28px; height: 28px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    
                    <!-- Enhanced Navigation Dots -->
                    <div class="industrial-image-nav">
                        @foreach($training->images as $index => $image)
                            <div class="industrial-nav-dot {{ $index === 0 ? 'active' : '' }}" onclick="showImage({{ $index }})"></div>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="no-image-placeholder">
                    <svg style="width: 80px; height: 80px; margin-bottom: 1.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <h1>{{ $training->title }}</h1>
                </div>
            @endif
        </div>

        <div class="industrial-content-section">
            <!-- Enhanced Training Header -->
            @if($training->images->count() > 0)
                <div class="training-header animate-industrial-slide">
                    <h1 class="industrial-training-title">{{ $training->title }}</h1>
                </div>
            @endif

            <!-- Enhanced Training Information Grid -->
            <div class="industrial-info-grid animate-industrial-slide" style="animation-delay: 0.2s;">
                <div class="industrial-info-card">
                    <div class="industrial-info-item">
                        <svg class="industrial-info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div class="industrial-info-content">
                            <h4>Tanggal Mulai</h4>
                            <p>{{ \Carbon\Carbon::parse($training->start_date)->format('d F Y') }}</p>
                        </div>
                    </div>
                    
                    @if($training->end_date && $training->end_date !== $training->start_date)
                        <div class="industrial-info-item">
                            <svg class="industrial-info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <div class="industrial-info-content">
                                <h4>Tanggal Selesai</h4>
                                <p>{{ \Carbon\Carbon::parse($training->end_date)->format('d F Y') }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="industrial-info-item">
                        <svg class="industrial-info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="industrial-info-content">
                            <h4>Waktu</h4>
                            <p>
                                {{ $training->start_time }}
                                @if($training->end_time) - {{ $training->end_time }} @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="industrial-info-card">
                    <div class="industrial-info-item">
                        <svg class="industrial-info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div class="industrial-info-content">
                            <h4>Lokasi</h4>
                            <p>{{ $training->location }}</p>
                        </div>
                    </div>

                    <div class="industrial-info-item">
                        <svg class="industrial-info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <div class="industrial-info-content">
                            <h4>Kapasitas</h4>
                            <p>{{ $training->capacity }} peserta</p>
                        </div>
                    </div>

                    @auth
                        @php
                            $registrationCount = \App\Models\Registration::where('training_id', $training->id)->count();
                            $remainingSlots = $training->capacity - $registrationCount;
                        @endphp
                        <div class="industrial-info-item">
                            <svg class="industrial-info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="industrial-info-content">
                                <h4>Sisa Tempat</h4>
                                <p class="{{ $remainingSlots > 5 ? 'status-success' : ($remainingSlots > 0 ? 'status-warning' : 'status-danger') }}">
                                    {{ $remainingSlots }} tempat
                                </p>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Enhanced Description Section -->
            @if($training->description)
                <div class="industrial-description-section animate-industrial-slide" style="animation-delay: 0.4s;">
                    <h3 class="industrial-section-title">
                        <svg style="width: 32px; height: 32px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Deskripsi Pelatihan
                    </h3>
                    <div class="industrial-description-content">
                        {!! nl2br(e($training->description)) !!}
                    </div>
                </div>
            @endif

            <!-- Enhanced Action Section -->
            <div class="industrial-action-section animate-industrial-slide" style="animation-delay: 0.6s;">
                <div class="industrial-action-buttons">
                    @auth
                        @if($isRegistered)
                        <div class="industrial-withdrawal-notice">
                            <div class="industrial-btn industrial-btn-success">
                                <svg style="width: 24px; height: 24px; margin-right: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Anda sudah terdaftar dalam pelatihan ini
                            </div>
                            <h5>Jika ingin mengajukan pengunduran diri silahkan hubungi admin dinas tenaga kerja</h5>
                        </div>
                        @else
                            @php
                                $registrationCount = \App\Models\Registration::where('training_id', $training->id)->count();
                                $isFull = $registrationCount >= $training->capacity;
                                $userRegistrationCount = \App\Models\Registration::where('user_id', auth()->id())->count();
                                $maxRegistrationReached = $userRegistrationCount >= 2;
                            @endphp
                            
                            @if($isFull)
                                <div class="industrial-btn industrial-btn-danger">
                                    <svg style="width: 24px; height: 24px; margin-right: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Pelatihan sudah penuh
                                </div>
                            @elseif($maxRegistrationReached)
                                <div class="industrial-btn industrial-btn-disabled">
                                    <svg style="width: 24px; height: 24px; margin-right: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636"></path>
                                    </svg>
                                    Anda sudah mencapai batas maksimal pendaftaran (2 pelatihan)
                                </div>
                            @else
                                <a href="{{ route('pelatihan.preview', $training->id) }}" class="industrial-btn industrial-btn-primary">
                                    <svg style="width: 24px; height: 24px; margin-right: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Daftar Pelatihan Sekarang
                                </a>
                            @endif
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="industrial-btn industrial-btn-secondary">
                            <svg style="width: 24px; height: 24px; margin-right: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Login untuk Mendaftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentImageIndex = 0;
    const images = document.querySelectorAll('.main-image');
    const dots = document.querySelectorAll('.industrial-nav-dot');
    let autoSlideInterval;
    
    // Initialize image gallery
    if (images.length > 1) {
        startAutoSlide();
        
        // Pause auto-slide on hover
        const gallery = document.getElementById('imageGallery');
        gallery.addEventListener('mouseenter', stopAutoSlide);
        gallery.addEventListener('mouseleave', startAutoSlide);
    }
    
    function showImage(index) {
        // Hide all images with fade effect
        images.forEach((img, i) => {
            img.style.opacity = '0';
            img.style.transform = 'scale(1.05)';
            setTimeout(() => {
                img.style.display = 'none';
            }, 300);
        });
        
        // Remove active class from all dots
        dots.forEach(dot => dot.classList.remove('active'));
        
        // Show selected image with fade effect
        if (images[index]) {
            setTimeout(() => {
                images[index].style.display = 'block';
                setTimeout(() => {
                    images[index].style.opacity = '1';
                    images[index].style.transform = 'scale(1)';
                }, 50);
            }, 300);
            
            if (dots[index]) {
                dots[index].classList.add('active');
            }
            currentImageIndex = index;
        }
    }
    
    function changeImage(direction) {
        const totalImages = images.length;
        if (totalImages <= 1) return;
        
        currentImageIndex += direction;
        
        if (currentImageIndex >= totalImages) {
            currentImageIndex = 0;
        } else if (currentImageIndex < 0) {
            currentImageIndex = totalImages - 1;
        }
        
        showImage(currentImageIndex);
        resetAutoSlide();
    }
    
    function startAutoSlide() {
        if (images.length > 1) {
            autoSlideInterval = setInterval(() => {
                changeImage(1);
            }, 4000);
        }
    }
    
    function stopAutoSlide() {
        if (autoSlideInterval) {
            clearInterval(autoSlideInterval);
            autoSlideInterval = null;
        }
    }
    
    function resetAutoSlide() {
        stopAutoSlide();
        startAutoSlide();
    }
    
    // Make functions globally accessible
    window.showImage = showImage;
    window.changeImage = changeImage;
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            changeImage(-1);
        } else if (e.key === 'ArrowRight') {
            changeImage(1);
        }
    });

    // Enhanced scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0) rotateX(0)';
            }
        });
    }, observerOptions);

    // Observe animated elements
    document.querySelectorAll('.animate-industrial-slide').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px) rotateX(10deg)';
        el.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        observer.observe(el);
    });

    // Enhanced hover effects for info cards
    document.querySelectorAll('.industrial-info-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-12px) rotateX(8deg) rotateY(-2deg)';
            this.style.boxShadow = '0 25px 80px rgba(0, 0, 0, 0.15)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) rotateX(0) rotateY(0)';
            this.style.boxShadow = '0 8px 32px rgba(0, 0, 0, 0.08)';
        });
    });

    // Button ripple effects
    document.querySelectorAll('.industrial-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const ripple = document.createElement('span');
            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.6);
                transform: scale(0);
                animation: ripple 0.6s linear;
                left: ${x}px;
                top: ${y}px;
                width: 40px;
                height: 40px;
                margin-left: -20px;
                margin-top: -20px;
                pointer-events: none;
            `;
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Add ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        @keyframes industrialPulse {
            0%, 100% { 
                box-shadow: 0 0 20px rgba(255, 140, 0, 0.3);
            }
            50% { 
                box-shadow: 0 0 40px rgba(1, 62, 126, 0.4);
            }
        }
        
        .industrial-info-card:hover {
            animation: industrialPulse 2s ease-in-out infinite;
        }
    `;
    document.head.appendChild(style);

    console.log('Enhanced Industrial Training Detail Page Loaded');
});
</script>

@endsection