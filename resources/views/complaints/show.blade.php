@extends('layouts.appuser')

@section('title', 'Dinas Tenaga Kerja Kota Batu - Detail Complaint')

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
        }

        /* Creative Header Styles */
        .creative-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--accent-blue) 100%);
            position: relative;
            overflow: hidden;
            min-height: 350px;
            display: flex;
            align-items: center;
        }

        .header-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.1;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatAnimation 20s infinite ease-in-out;
        }

        .shape-1 {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 120px;
            height: 120px;
            top: 60%;
            left: 80%;
            animation-delay: -5s;
        }

        .shape-3 {
            width: 60px;
            height: 60px;
            top: 80%;
            left: 20%;
            animation-delay: -10s;
        }

        .shape-4 {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 70%;
            animation-delay: -15s;
        }

        @keyframes floatAnimation {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.1;
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 0.2;
            }
        }

        .creative-breadcrumb {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            position: relative;
            z-index: 2;
        }

        .creative-breadcrumb a,
        .creative-breadcrumb .current {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: var(--transition);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .creative-breadcrumb a {
            color: rgba(255, 255, 255, 0.8);
        }

        .creative-breadcrumb a:hover {
            background: rgba(255, 255, 255, 0.2);
            color: var(--text-white);
            transform: translateY(-2px);
        }

        .creative-breadcrumb .current {
            background: rgba(255, 140, 0, 0.2);
            color: var(--text-white);
            font-weight: 600;
        }

        .creative-breadcrumb .divider {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.75rem;
        }

        .creative-title {
            font-size: 3.5rem;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1rem;
            position: relative;
            z-index: 2;
        }

        .title-accent {
            display: block;
            color: var(--warning-orange);
            font-size: 2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .title-main {
            display: block;
            color: var(--text-white);
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            background: linear-gradient(45deg, #fff, #f0f9ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .creative-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 400;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .header-icon-container {
            position: relative;
            display: inline-block;
            z-index: 2;
        }

        .icon-circle {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 140, 0, 0.3));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--text-white);
            position: relative;
            backdrop-filter: blur(15px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            animation: iconFloat 3s ease-in-out infinite;
        }

        .icon-pulse {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 120px;
            height: 120px;
            border: 2px solid rgba(255, 140, 0, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            animation: pulseRing 2s ease-out infinite;
        }

        @keyframes iconFloat {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-10px) rotate(5deg);
            }
        }

        @keyframes pulseRing {
            0% {
                transform: translate(-50%, -50%) scale(0.8);
                opacity: 1;
            }
            100% {
                transform: translate(-50%, -50%) scale(1.5);
                opacity: 0;
            }
        }

        /* Industrial Card Styles */
        .industrial-card {
            background: 
                linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border: none;
            border-radius: 20px;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.15),
                0 8px 24px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            position: relative;
            overflow: hidden;
            transition: var(--transition);
            transform: perspective(1000px) rotateX(0deg) rotateY(0deg);
        }

        .industrial-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, 
                var(--primary-blue) 0%, 
                var(--warning-orange) 50%, 
                var(--success-green) 100%);
            border-radius: 20px 20px 0 0;
        }

        .industrial-card:hover {
            transform: 
                perspective(1000px) 
                rotateX(2deg) 
                rotateY(-1deg) 
                translateY(-8px) 
                scale(1.01);
            box-shadow: 
                0 25px 70px rgba(0, 0, 0, 0.2),
                0 12px 30px rgba(0, 0, 0, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .card-header-industrial {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--text-white);
            border: none;
            border-radius: 20px 20px 0 0;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .card-header-industrial::before {
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
                    transparent 20px,
                    rgba(255, 255, 255, 0.05) 20px,
                    rgba(255, 255, 255, 0.05) 40px
                );
        }

        .card-header-industrial h3 {
            position: relative;
            z-index: 1;
            font-weight: 800;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            margin: 0;
        }

        .card-body-industrial {
            padding: 2.5rem;
            position: relative;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.875rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .status-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .status-badge:hover::before {
            left: 100%;
        }

        .status-answered {
            background: linear-gradient(135deg, var(--success-green), #48bb78);
            color: var(--text-white);
        }

        .status-pending {
            background: linear-gradient(135deg, var(--warning-orange), #ffa726);
            color: var(--text-white);
        }

        /* Question and Answer Sections */
        .question-section, .answer-section {
            background: 
                linear-gradient(145deg, 
                    rgba(255, 255, 255, 0.8) 0%, 
                    rgba(248, 250, 252, 0.9) 100%);
            border-radius: 16px;
            padding: 2rem;
            margin: 1.5rem 0;
            border-left: 6px solid var(--primary-blue);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            position: relative;
            backdrop-filter: blur(10px);
        }

        .answer-section {
            border-left-color: var(--success-green);
        }

        .answer-section.no-answer {
            border-left-color: var(--warning-orange);
            background: 
                linear-gradient(145deg, 
                    rgba(255, 140, 0, 0.05) 0%, 
                    rgba(255, 193, 7, 0.03) 100%);
        }

        .section-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
        }

        .question-icon {
            color: var(--primary-blue);
        }

        .answer-icon {
            color: var(--success-green);
        }

        .no-answer-icon {
            color: var(--warning-orange);
        }

        /* Like System */
        .like-section {
            background: 
                linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 16px;
            padding: 1.5rem 2rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            border: 2px solid rgba(1, 62, 126, 0.1);
            position: relative;
            overflow: hidden;
        }

        .like-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-blue), var(--warning-orange));
        }

        .like-btn {
            cursor: pointer;
            color: var(--steel-gray);
            transition: var(--transition);
            font-size: 1.5rem;
            padding: 0.5rem;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 3rem;
            height: 3rem;
            position: relative;
            overflow: hidden;
        }

        .like-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(224, 36, 94, 0.1);
            border-radius: 50%;
            transition: all 0.3s ease;
            transform: translate(-50%, -50%);
        }

        .like-btn:hover::before {
            width: 100%;
            height: 100%;
        }

        .like-btn:hover {
            color: #e0245e;
            transform: scale(1.1) rotate(5deg);
        }

        .like-btn.liked {
            color: #e0245e;
            animation: likeAnimation 0.6s ease;
        }

        .like-btn.liked::before {
            width: 100%;
            height: 100%;
            background: rgba(224, 36, 94, 0.2);
        }

        @keyframes likeAnimation {
            0% { transform: scale(1); }
            50% { transform: scale(1.3) rotate(15deg); }
            100% { transform: scale(1); }
        }

        .like-count {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark-steel);
            margin-left: 1rem;
        }

        /* Buttons */
        .btn-industrial {
            background: linear-gradient(135deg, var(--warning-orange), #ff9800);
            border: none;
            border-radius: 25px;
            padding: 0.75rem 2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-white);
            position: relative;
            overflow: hidden;
            transition: var(--transition);
            box-shadow: 0 6px 20px rgba(255, 140, 0, 0.3);
        }

        .btn-industrial::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-industrial:hover::before {
            left: 100%;
        }

        .btn-industrial:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 140, 0, 0.4);
            background: linear-gradient(135deg, #ff9800, var(--industrial-yellow));
        }

        .btn-secondary-industrial {
            background: linear-gradient(135deg, var(--steel-gray), var(--light-steel));
            color: var(--text-white);
        }

        .btn-secondary-industrial:hover {
            background: linear-gradient(135deg, var(--light-steel), var(--steel-gray));
            box-shadow: 0 10px 30px rgba(74, 85, 104, 0.3);
        }

        .btn-primary-industrial {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            box-shadow: 0 6px 20px rgba(1, 62, 126, 0.3);
        }

        .btn-primary-industrial:hover {
            background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
            box-shadow: 0 10px 30px rgba(1, 62, 126, 0.4);
        }

        /* Meta Information */
        .meta-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            background: rgba(1, 62, 126, 0.05);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            border: 1px solid rgba(1, 62, 126, 0.1);
            font-size: 0.875rem;
        }

        .meta-icon {
            color: var(--primary-blue);
            margin-right: 0.5rem;
            font-size: 1rem;
        }

        /* Modal Enhancements */
        .modal-content {
            background: 
                linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border: none;
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--text-white);
            border: none;
            padding: 2rem;
            position: relative;
        }

        .modal-header::before {
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
                    transparent 10px,
                    rgba(255, 255, 255, 0.05) 10px,
                    rgba(255, 255, 255, 0.05) 20px
                );
        }

        .modal-title {
            position: relative;
            z-index: 1;
            font-weight: 800;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .btn-close {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            opacity: 1;
            position: relative;
            z-index: 1;
        }

        .modal-body {
            padding: 2rem;
        }

        .form-control {
            border: 2px solid rgba(1, 62, 126, 0.1);
            border-radius: 12px;
            padding: 1rem;
            transition: var(--transition);
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 20px rgba(1, 62, 126, 0.2);
            background: rgba(255, 255, 255, 1);
        }

        .form-label {
            font-weight: 700;
            color: var(--dark-steel);
            margin-bottom: 0.75rem;
        }

        /* Breadcrumb */
        .breadcrumb-industrial {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            padding: 1rem 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .breadcrumb-industrial a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb-industrial a:hover {
            color: var(--text-white);
            transform: translateX(2px);
        }

        .breadcrumb-industrial .active {
            color: var(--text-white);
            font-weight: 600;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-title {
                font-size: 1.8rem;
            }
            
            .card-header-industrial,
            .card-body-industrial {
                padding: 1.5rem;
            }
            
            .question-section,
            .answer-section {
                padding: 1.5rem;
            }
            
            .industrial-card:hover {
                transform: translateY(-4px) scale(1.01);
            }
            
            .meta-info {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        /* Animation Keyframes */
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

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        .animate-delay-1 { animation-delay: 0.1s; }
        .animate-delay-2 { animation-delay: 0.2s; }
        .animate-delay-3 { animation-delay: 0.3s; }
    </style>
@endpush

@section('content')
<!-- Creative Header Start -->
<div class="creative-header">
    <div class="header-background">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
    </div>
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav class="creative-breadcrumb mb-4">
                    <a href="{{ route('home') }}"><i class="fas fa-home"></i> Beranda</a>
                    <span class="divider"><i class="fas fa-chevron-right"></i></span>
                    <a href="{{ route('complaints.index') }}"><i class="fas fa-comments"></i> Keluhan & Saran</a>
                    <span class="divider"><i class="fas fa-chevron-right"></i></span>
                    <span class="current"><i class="fas fa-eye"></i> Detail</span>
                </nav>
                
                <h1 class="creative-title">
                    <span class="title-accent">Detail</span>
                    <span class="title-main">Keluhan & Saran</span>
                </h1>
                <p class="creative-subtitle">
                    <i class="fas fa-shield-alt me-2"></i>
                    Transparansi dan Responsivitas dalam Pelayanan Publik
                </p>
            </div>
            <div class="col-lg-4 text-center">
                <div class="header-icon-container">
                    <div class="icon-circle">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="icon-pulse"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Creative Header End -->

<div class="container mt-5 py-5">
    <div class="industrial-card animate-fade-in-up">
        <div class="card-header-industrial">
            <div class="d-flex justify-content-between align-items-start flex-wrap">
                <h3 class="mb-0 flex-grow-1">{{ $complaint->title }}</h3>
                <div class="status-badge {{ $complaint->status == 'answered' ? 'status-answered' : 'status-pending' }} mt-2 mt-md-0">
                    <i class="fas fa-{{ $complaint->status == 'answered' ? 'check-circle' : 'clock' }} me-2"></i>
                    {{ $complaint->status == 'answered' ? 'Dijawab' : 'Menunggu' }}
                </div>
            </div>
        </div>
        
        <div class="card-body-industrial">
            <!-- Meta Information -->
            <div class="meta-info animate-fade-in-up animate-delay-1">
                <div class="meta-item">
                    <i class="fas fa-user meta-icon"></i>
                    <strong>{{ optional($complaint->questioner)->name ?? 'Pengguna Anonim' }}</strong>
                </div>
                <div class="meta-item">
                    <i class="fas fa-calendar-alt meta-icon"></i>
                    {{ $complaint->created_at->format('d M Y, H:i') }} WIB
                </div>
                @if($complaint->category)
                <div class="meta-item">
                    <i class="fas fa-tag meta-icon"></i>
                    {{ $complaint->category }}
                </div>
                @endif
            </div>

            <!-- Question Section -->
            <div class="question-section animate-fade-in-up animate-delay-2">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-question-circle section-icon question-icon"></i>
                    <h5 class="fw-bold mb-0 ms-3" style="color: var(--dark-steel);">Pertanyaan</h5>
                </div>
                <p class="mb-0" style="line-height: 1.7; color: var(--dark-steel);">{{ $complaint->question }}</p>
            </div>
            
            <!-- Answer Section -->
            <div class="answer-section {{ $complaint->answer ? '' : 'no-answer' }} animate-fade-in-up animate-delay-3">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-{{ $complaint->answer ? 'reply' : 'hourglass-half' }} section-icon {{ $complaint->answer ? 'answer-icon' : 'no-answer-icon' }}"></i>
                    <h5 class="fw-bold mb-0 ms-3" style="color: var(--dark-steel);">
                        {{ $complaint->answer ? 'Jawaban' : 'Belum Ada Jawaban' }}
                    </h5>
                </div>
                
                @if($complaint->answer)
                    <p class="mb-3" style="line-height: 1.7; color: var(--dark-steel);">{{ $complaint->answer }}</p>
                    <div class="meta-item d-inline-flex">
                        <i class="fas fa-user-tie meta-icon"></i>
                        <span>
                            <strong>{{ ucfirst(optional($complaint->responsible)->name ?? 'Admin') }}</strong>
                            @if($complaint->responsible && $complaint->responsible->roles->first())
                                ({{ ucfirst($complaint->responsible->roles->first()->name) }})
                            @endif
                        </span>
                    </div>
                @else
                    <p class="mb-0" style="color: var(--warning-orange); font-style: italic;">
                        <i class="fas fa-info-circle me-2"></i>
                        Keluhan Anda sedang diproses. Tim kami akan memberikan jawaban secepatnya.
                    </p>
                @endif
            </div>

            <!-- Actions Section -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mt-4">
                <!-- Like Section -->
                <div class="like-section flex-grow-1">
                    <div class="d-flex align-items-center">
                        @auth
                        <i class="fas fa-thumbs-up like-btn {{ auth()->user()->hasLiked($complaint) ? 'liked' : '' }}" 
                           data-id="{{ $complaint->id }}"
                           title="{{ auth()->user()->hasLiked($complaint) ? 'Batalkan like' : 'Suka pertanyaan ini' }}"></i>
                        @endauth
                        @guest
                        <i class="fas fa-thumbs-up like-btn" 
                           data-id="{{ $complaint->id }}"
                           title="Login untuk menyukai"></i>
                        @endguest
                        <span class="like-count" id="like-count-{{ $complaint->id }}">{{ $complaint->likes_count }}</span>
                        <span class="ms-2 text-muted">orang menyukai ini</span>
                    </div>
                </div>

                <!-- Admin Answer Button -->
                @auth
                @if((auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin')) && $complaint->status == 'not answered')
                    <button class="btn btn-industrial" data-bs-toggle="modal" data-bs-target="#answerModal">
                        <i class="fas fa-reply me-2"></i>Berikan Jawaban
                    </button>
                @endif
                @endauth
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Modal Answer -->
<div class="modal fade" id="answerModal" tabindex="-1" aria-labelledby="answerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="answerModalLabel">
                    <i class="fas fa-reply me-2"></i>Berikan Jawaban untuk Keluhan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.complaints.answer', $complaint->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Complaint Summary -->
                    <div class="question-section mb-4">
                        <h6 class="fw-bold mb-2" style="color: var(--dark-steel);">Pertanyaan:</h6>
                        <p class="mb-0" style="color: var(--steel-gray);">{{ Str::limit($complaint->question, 200) }}</p>
                    </div>
                    
                    <!-- Answer Input -->
                    <div class="mb-3">
                        <label for="answer" class="form-label">
                            <i class="fas fa-pen me-2"></i>Jawaban Anda
                        </label>
                        <textarea name="answer" 
                                  id="answer" 
                                  class="form-control" 
                                  rows="6" 
                                  required 
                                  placeholder="Tulis jawaban yang komprehensif dan membantu untuk keluhan ini...">{{ old('answer') }}</textarea>
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            Pastikan jawaban Anda jelas dan membantu menyelesaikan masalah yang diajukan.
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-secondary-industrial" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary-industrial">
                        <i class="fas fa-paper-plane me-2"></i>Kirim Jawaban
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
    document.addEventListener('DOMContentLoaded', function() {
        // Enhanced like system
        document.querySelectorAll('.like-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                
                @auth
                    const complaintId = this.dataset.id;
                    const likeCount = document.getElementById(`like-count-${complaintId}`);
                    const isLiked = this.classList.contains('liked');
                    
                    // Add loading state
                    this.style.pointerEvents = 'none';
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                    fetch(`/complaints/${complaintId}/like`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ like: !isLiked })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Restore button state
                            this.innerHTML = '<i class="fas fa-thumbs-up"></i>';
                            this.style.pointerEvents = 'auto';
                            
                            // Toggle like state with animation
                            this.classList.toggle('liked');
                            likeCount.textContent = data.likes_count;
                            
                            // Update title
                            this.title = this.classList.contains('liked') ? 'Batalkan like' : 'Suka pertanyaan ini';
                            
                            // Show feedback
                            showNotification(
                                this.classList.contains('liked') ? 
                                'Terima kasih! Anda menyukai keluhan ini.' : 
                                'Like berhasil dibatalkan.',
                                'success'
                            );
                        } else {
                            throw new Error('Failed to update like status');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Restore button state
                        this.innerHTML = '<i class="fas fa-thumbs-up"></i>';
                        this.style.pointerEvents = 'auto';
                        
                        showNotification('Terjadi kesalahan. Silakan coba lagi.', 'error');
                    });
                @else
                    // Redirect guest to login page with return URL
                    window.location.href = "{{ route('login') }}?redirect=" + encodeURIComponent(window.location.pathname);
                @endauth
            });
        });

        // Form validation for answer modal
        const answerForm = document.querySelector('#answerModal form');
        const answerTextarea = document.querySelector('#answer');
        
        if (answerForm) {
            answerForm.addEventListener('submit', function(e) {
                const answer = answerTextarea.value.trim();
                
                if (answer.length < 10) {
                    e.preventDefault();
                    showNotification('Jawaban minimal harus 10 karakter.', 'warning');
                    answerTextarea.focus();
                    return false;
                }
                
                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
                submitBtn.disabled = true;
                
                // If validation passes, form will submit normally
                // Loading state will be cleared by page reload
            });
            
            // Character counter
            answerTextarea.addEventListener('input', function() {
                const length = this.value.length;
                const minLength = 10;
                
                // Remove existing counter
                const existingCounter = this.parentNode.querySelector('.char-counter');
                if (existingCounter) existingCounter.remove();
                
                // Add character counter
                const counter = document.createElement('div');
                counter.className = 'char-counter mt-2';
                counter.innerHTML = `
                    <small class="${length < minLength ? 'text-warning' : 'text-success'}">
                        <i class="fas fa-${length < minLength ? 'exclamation-triangle' : 'check-circle'} me-1"></i>
                        ${length} karakter ${length < minLength ? `(minimal ${minLength})` : '✓'}
                    </small>
                `;
                this.parentNode.appendChild(counter);
            });
        }

        // Auto-resize textarea
        if (answerTextarea) {
            answerTextarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.max(150, this.scrollHeight) + 'px';
            });
        }

        // Smooth scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.question-section, .answer-section, .like-section').forEach(el => {
            observer.observe(el);
        });

        // Enhanced modal animations
        const modal = document.getElementById('answerModal');
        if (modal) {
            modal.addEventListener('show.bs.modal', function () {
                this.querySelector('.modal-dialog').style.transform = 'scale(0.8) translateY(-50px)';
                this.querySelector('.modal-dialog').style.opacity = '0';
                
                setTimeout(() => {
                    this.querySelector('.modal-dialog').style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                    this.querySelector('.modal-dialog').style.transform = 'scale(1) translateY(0)';
                    this.querySelector('.modal-dialog').style.opacity = '1';
                }, 10);
            });
            
            modal.addEventListener('hidden.bs.modal', function () {
                // Reset form
                const form = this.querySelector('form');
                if (form) form.reset();
                
                // Remove character counter
                const counter = this.querySelector('.char-counter');
                if (counter) counter.remove();
                
                // Reset submit button
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Kirim Jawaban';
                    submitBtn.disabled = false;
                }
            });
        }

        // Copy link functionality
        function copyComplaintLink() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                showNotification('Link keluhan berhasil disalin!', 'success');
            }).catch(() => {
                showNotification('Gagal menyalin link.', 'error');
            });
        }

        // Add copy link button dynamically
        const actionsSection = document.querySelector('.d-flex.justify-content-between.align-items-center');
        if (actionsSection) {
            const copyBtn = document.createElement('button');
            copyBtn.className = 'btn btn-outline-secondary btn-sm ms-2';
            copyBtn.innerHTML = '<i class="fas fa-share-alt me-1"></i>Bagikan';
            copyBtn.onclick = copyComplaintLink;
            copyBtn.style.borderRadius = '20px';
            copyBtn.style.borderColor = 'var(--steel-gray)';
            copyBtn.style.color = 'var(--steel-gray)';
            
            actionsSection.appendChild(copyBtn);
        }
    });

    // Notification system
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.notification-toast');
        existingNotifications.forEach(notification => notification.remove());

        const notification = document.createElement('div');
        notification.className = `notification-toast alert alert-${type === 'error' ? 'danger' : type} alert-dismissible`;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            border: none;
            animation: slideInRight 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        `;
        
        const iconClass = {
            'success': 'fa-check-circle',
            'warning': 'fa-exclamation-triangle', 
            'error': 'fa-times-circle',
            'info': 'fa-info-circle'
        }[type] || 'fa-info-circle';
        
        notification.innerHTML = `
            <i class="fas ${iconClass} me-2"></i>
            ${message}
            <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.style.animation = 'slideOutRight 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                setTimeout(() => notification.remove(), 400);
            }
        }, 5000);
    }

    // Add notification animations to CSS
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100px);
            }
        }
        
        .char-counter {
            transition: all 0.3s ease;
        }
        
        .btn-outline-secondary:hover {
            background: var(--steel-gray) !important;
            border-color: var(--steel-gray) !important;
            color: white !important;
            transform: translateY(-1px);
        }
    `;
    document.head.appendChild(style);

    console.log('Enhanced Complaint Detail Page Loaded');
</script>
@endpush