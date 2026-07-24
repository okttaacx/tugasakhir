@extends('layouts.appuser')

@section('title', 'Dinas Tenaga Kerja Kota Batu - Pelatihan Tenaga Kerja')

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

    /* Header Styles (unchanged) */
    .bg-gradient-primary {
        background: 
            linear-gradient(135deg, 
                rgba(1, 62, 126, 0.95) 0%, 
                rgba(0, 86, 179, 0.9) 50%, 
                rgba(0, 123, 255, 0.85) 100%
            ),
            url('{{ asset("image/maxresdefault.jpg") }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        position: relative;
        border-radius: 0;
        box-shadow: 
            0 8px 32px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        overflow: hidden;
    }

    .bg-gradient-primary::before {
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

    .bg-gradient-primary::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(ellipse at center, transparent 0%, rgba(0, 0, 0, 0.1) 100%);
        z-index: 2;
    }

    .container.d-flex {
        position: relative;
        z-index: 3;
    }

    .logo-container img {
        filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.4));
        transition: var(--transition);
    }

    .logo-container img:hover {
        transform: translateY(-5px) scale(1.05);
        filter: drop-shadow(0 12px 24px rgba(0, 0, 0, 0.6));
    }

    .header-title {
        font-size: 3.1rem;
        color: var(--text-white);
        font-weight: 800;
        margin-bottom: 20px;
        text-shadow: 
            0 4px 8px rgba(0, 0, 0, 0.5),
            0 2px 4px rgba(0, 0, 0, 0.3);
        letter-spacing: -0.5px;
    }

    /* Other styles (unchanged) */
    .card, .counter-card, .feature-card {
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
    }

    .card::before, .counter-card::before, .feature-card::before {
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

    .card:hover, .counter-card:hover, .feature-card:hover {
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

    /* Counter, Feature, Button, Divider, Footer, Contact styles (unchanged) */
    .counter-card {
        background: 
            linear-gradient(145deg, 
                rgba(255, 255, 255, 0.95) 0%, 
                rgba(248, 250, 252, 0.9) 100%);
        padding: 2rem 1.5rem;
        text-align: center;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .counter-icon {
        font-size: 3.5rem;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        filter: drop-shadow(0 4px 8px rgba(1, 62, 126, 0.3));
        transition: var(--transition);
    }

    .counter-card:hover .counter-icon {
        transform: scale(1.15) rotateY(15deg);
        filter: drop-shadow(0 8px 16px rgba(1, 62, 126, 0.4));
    }

    .counter {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .feature-card {
        padding: 2.5rem 2rem;
        text-align: center;
        height: 100%;
        position: relative;
        background: 
            linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    }

    .feature-card .feature-icon {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        color: var(--warning-orange);
        transition: var(--transition);
        filter: drop-shadow(0 4px 8px rgba(255, 140, 0, 0.3));
    }

    .feature-card:hover .feature-icon {
        color: var(--primary-blue);
        transform: scale(1.2) rotateZ(-5deg);
        filter: drop-shadow(0 8px 16px rgba(1, 62, 126, 0.4));
    }

    .feature-card h4 {
        color: var(--dark-steel);
        font-weight: 700;
        margin-bottom: 1rem;
        transition: var(--transition);
    }

    .feature-card:hover h4 {
        color: var(--primary-blue);
        transform: translateY(-2px);
    }

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

    .btn-outline-info, .btn-outline-success {
        border-width: 2px;
        border-radius: 20px;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-outline-info {
        border-color: var(--accent-blue);
        color: var(--accent-blue);
    }

    .btn-outline-info:hover {
        background: var(--accent-blue);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
    }

    .btn-outline-success {
        border-color: var(--success-green);
        color: var(--success-green);
    }

    .btn-outline-success:hover {
        background: var(--success-green);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(56, 161, 105, 0.3);
    }

    .elegant-divider {
        margin: 4rem 0;
        position: relative;
        height: 4px;
    }

    .elegant-divider::before {
        content: '';
        position: absolute;
        top: 0;
        left: 10%;
        right: 10%;
        height: 4px;
        background: linear-gradient(90deg, 
            transparent 0%, 
            var(--primary-blue) 20%, 
            var(--warning-orange) 50%, 
            var(--primary-blue) 80%, 
            transparent 100%);
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(1, 62, 126, 0.3);
    }

    .elegant-divider::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 16px;
        height: 16px;
        background: linear-gradient(45deg, var(--primary-blue), var(--warning-orange));
        transform: translate(-50%, -50%) rotate(45deg);
        border-radius: 2px;
        box-shadow: 0 4px 12px rgba(1, 62, 126, 0.4);
    }

    /* Updated Carousel Styles (from alternative code, adapted to industrial theme) */
    .carousel-wrapper {
        margin-top: 10rem;
        margin-bottom: 3rem;
        position: relative;
    }

    .carousel-container {
        position: relative;
        height: 32rem;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        background: var(--carbon-black);
        border: 2px solid rgba(255, 255, 255, 0.1);
    }

    .carousel-container input[type="radio"] {
        display: none;
    }

    .carousel-track {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .carousel-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        visibility: hidden;
        transform: scale(1.05);
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
    }

    .carousel-slide.active {
        opacity: 1;
        visibility: visible;
        transform: scale(1);
    }

    .carousel-slide.active .slide-content {
        transform: translateY(0);
    }

    .slide-media {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .slide-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.8);
    }

    .slide-placeholder {
        width: 100%;
        height: 100%;
        position: relative;
        background: var(--dark-steel);
    }

    .placeholder-pattern {
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

    .slide-gradient-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            135deg,
            rgba(1, 62, 126, 0.8) 0%,
            rgba(0, 0, 0, 0.6) 50%,
            rgba(255, 140, 0, 0.3) 100%
        );
        z-index: 2;
    }

    .slide-content-wrapper {
        position: relative;
        z-index: 3;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .slide-content {
        text-align: center;
        max-width: 42rem;
        padding: 2rem;
        transform: translateY(20px);
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .slide-badge {
        display: inline-block;
        backdrop-filter: blur(10px);
        color: var(--text-white);
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .slide-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--text-white);
        margin-bottom: 1.5rem;
        line-height: 1.2;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .slide-description {
        color: var(--text-light);
        font-size: 1.125rem;
        line-height: 1.6;
        margin-bottom: 2rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .slide-meta {
        margin-bottom: 2rem;
    }

    .author-info {
        display: inline-flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        padding: 0.75rem 1.5rem;
        border-radius: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .author-name, .publish-date {
        color: var(--text-white);
        font-size: 0.875rem;
        font-weight: 500;
    }

    .meta-divider {
        color: rgba(255, 255, 255, 0.6);
        margin: 0 0.75rem;
    }

    .slide-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-white);
        padding: 1rem 2rem;
        border-radius: 3rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .slide-cta::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .slide-cta:hover::before {
        left: 100%;
    }

    .slide-cta:hover {
        transform: translateY(-2px);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .cta-arrow {
        width: 1.25rem;
        height: 1.25rem;
        transition: transform 0.3s ease;
    }

    .slide-cta:hover .cta-arrow {
        transform: translateX(4px);
    }

    .carousel-navigation {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1rem;
    }

    .nav-button {
        width: 3.5rem;
        height: 3.5rem;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        color: var(--text-white);
        cursor: pointer;
        pointer-events: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .nav-button svg {
        width: 1.5rem;
        height: 1.5rem;
    }

    .nav-button:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: scale(1.1);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    .nav-button:disabled {
        opacity: 0.3;
        cursor: not-allowed;
        pointer-events: none;
    }

    .carousel-progress {
        height: 0.25rem;
        background: rgba(0, 0, 0, 0.1);
        border-radius: 0 0 1rem 1rem;
        overflow: hidden;
        display: block;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, var(--primary-blue), var(--warning-orange));
        width: 0%;
        transition: width 0.1s ease;
    }

    .badge-news {
        background: rgba(1, 62, 126, 0.9);
    }

    .badge-training {
        background: rgba(56, 161, 105, 0.9);
    }

    .cta-news {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        box-shadow: 0 10px 25px rgba(1, 62, 126, 0.3);
    }

    .cta-training {
        background: linear-gradient(135deg, var(--success-green), var(--industrial-yellow));
        box-shadow: 0 10px 25px rgba(56, 161, 105, 0.3);
    }

    .cta-news:hover {
        box-shadow: 0 15px 35px rgba(1, 62, 126, 0.4);
    }

    .cta-training:hover {
        box-shadow: 0 15px 35px rgba(56, 161, 105, 0.4);
    }

    .training-location {
        color: var(--text-light);
        font-size: 0.875rem;
    }

    /* Footer, Contact, List Group, etc. (unchanged) */
    .footer-stats {
        background: 
            linear-gradient(135deg, 
                var(--primary-blue) 0%, 
                var(--dark-steel) 50%, 
                var(--carbon-black) 100%);
        position: relative;
        overflow: hidden;
    }

    .footer-stats::before {
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
                rgba(255, 140, 0, 0.05) 20px,
                rgba(255, 140, 0, 0.05) 40px
            );
    }

    .footer-stats .counter-card {
        background: 
            linear-gradient(145deg, 
                rgba(255, 255, 255, 0.1) 0%, 
                rgba(255, 255, 255, 0.05) 100%);
        backdrop-filter: blur(15px);
        border: 2px solid rgba(255, 255, 255, 0.15);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    }

    .contact-icon {
        color: var(--warning-orange);
        font-size: 1.5rem;
        margin-right: 1rem;
        transition: var(--transition);
    }

    .contact-icon:hover {
        color: var(--primary-blue);
        transform: scale(1.2) rotate(10deg);
    }

    .bg-light {
        background: 
            linear-gradient(135deg, 
                rgba(248, 250, 252, 0.95) 0%, 
                rgba(237, 242, 247, 0.9) 100%);
        position: relative;
    }

    .bg-light::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            repeating-linear-gradient(
                90deg,
                transparent,
                transparent 100px,
                rgba(1, 62, 126, 0.02) 100px,
                rgba(1, 62, 126, 0.02) 200px
            );
        pointer-events: none;
    }

    .list-group-item {
        background: 
            linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid rgba(1, 62, 126, 0.1);
        border-radius: 12px !important;
        margin-bottom: 1rem;
        padding: 1.5rem;
        position: relative;
        transition: var(--transition);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .list-group-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, var(--primary-blue), var(--warning-orange));
        border-radius: 12px 0 0 12px;
    }

    .list-group-item:hover {
        transform: translateX(8px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        background: 
            linear-gradient(145deg, #ffffff 0%, #f0f9ff 100%);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .header-title {
            font-size: 1.8rem;
        }
        
        .counter-card, .feature-card {
            padding: 1.5rem 1rem;
        }
        
        .counter-icon {
            font-size: 2.5rem;
        }
        
        .feature-card .feature-icon {
            font-size: 3rem;
        }
        
        .carousel-container {
            height: 24rem;
        }
        
        .card:hover, .counter-card:hover, .feature-card:hover {
            transform: translateY(-8px) scale(1.01);
        }
        
        .slide-title {
            font-size: 1.875rem;
        }
        
        .slide-description {
            font-size: 1rem;
        }
        
        .slide-content {
            padding: 1.5rem;
        }
        
        .nav-button {
            width: 3rem;
            height: 3rem;
        }
        
        .carousel-navigation {
            padding: 0 0.5rem;
        }
        
        .training-location {
            display: none;
        }
    }

    @media (max-width: 480px) {
        .carousel-container {
            height: 20rem;
        }
        
        .slide-title {
            font-size: 1.5rem;
        }
        
        .slide-description {
            font-size: 0.875rem;
        }
        
        .slide-cta {
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
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

    @keyframes gentleFloat {
        0%, 100% { 
            transform: translateY(0px) rotateX(0deg);
        }
        50% { 
            transform: translateY(-8px) rotateX(2deg);
        }
    }

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

    .hover-zoom img {
        transition: var(--transition);
        border-radius: 12px;
    }

    .hover-zoom:hover img {
        transform: scale(1.08) rotateZ(1deg);
        filter: brightness(1.1) contrast(1.05);
    }

    .industrial-accent {
        position: relative;
    }

    .industrial-accent::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 20px;
        height: 20px;
        background: var(--warning-orange);
        clip-path: polygon(0 0, 100% 0, 100% 100%);
    }
</style>
@endpush

@section('content')
    <!-- Header Start -->
    <div class="bg-gradient-primary py-5">
        <div class="container d-flex align-items-center justify-content-center py-5">
            <div class="logo-container mr-3">
                <img class="img-fluid" src="{{ asset('image/logo_batu.png') }}" alt="Logo Kota Batu" style="height: 200px;">
            </div>
            <div class="text-container" style="display: flex; flex-direction: column; justify-content: center; margin: auto;">
                <h1 class="header-title animate-fade-in">Sistem Informasi Jaringan Orang Kerja</h1>
                <h3 style="color: var(--text-light);">Dinas Tenaga Kerja Kota Batu</h3>
            </div>
            <div class="logo-container ml-3">
                <img class="img-fluid" src="{{ asset('image/LOGO_SIJOKER-removebg-preview-cutted.png') }}" alt="Logo Disnaker Hitam" style="height: 200px; margin-left: 30px;">
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Elegant Divider -->
    <div class="container">
        <div class="elegant-divider"></div>
    </div>

    <!-- About Start -->
    <div class="bg-about">
        <div class="container py-5 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8 mb-4 mb-lg-0 animate-fade-in">
                    <h2 class="font-weight-bold mb-4" style="color: var(--dark-steel);">Tentang Dinas Tenaga Kerja Kota Batu</h2>
                    <p class="text-muted">Dinas Tenaga Kerja Kota Batu berkomitmen untuk meningkatkan kualitas dan keterampilan tenaga kerja melalui program pelatihan berkualitas. Kami berupaya menciptakan tenaga kerja yang kompeten dan siap bersaing di pasar kerja.</p>
                </div>
            </div>
            <div class="row mt-5 justify-content-center counter-section">
                <div class="col-md-4 mb-4">
                    <div class="counter-card industrial-accent">
                        <i class="fas fa-graduation-cap counter-icon"></i>
                        <h4 class="counter" data-count="{{ $totalTrainings ?? 0 }}">0</h4>
                        <p class="text-muted">Program Pelatihan</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="counter-card industrial-accent">
                        <i class="fas fa-chalkboard-teacher counter-icon"></i>
                        <h4 class="counter" data-count="15">0</h4>
                        <p class="text-muted">Instruktur Ahli</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="counter-card industrial-accent">
                        <i class="fas fa-users counter-icon"></i>
                        <h4 class="counter" data-count="500">0</h4>
                        <p class="text-muted">Peserta Terlatih</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Enhanced Features Start -->
    <div class="bg-light py-5">
        <div class="container py-5">
            <h2 class="text-center font-weight-bold mb-5 animate-fade-in" style="color: var(--dark-steel);">Mengapa Memilih Program Kami</h2>
            <div class="row feature-section">
                <div class="col-lg-4 mb-4 animate-slide-up">
                    <div class="feature-card h-100 industrial-accent">
                        <i class="fas fa-hard-hat feature-icon"></i>
                        <h4 class="font-weight-bold mb-3">Instruktur Berpengalaman</h4>
                        <p class="text-muted">Pelatihan dipandu oleh instruktur ahli dengan pengalaman industri yang relevan.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4 animate-slide-up" style="animation-delay: 0.2s;">
                    <div class="feature-card h-100 industrial-accent">
                        <i class="fas fa-certificate feature-icon"></i>
                        <h4 class="font-weight-bold mb-3">Sertifikasi BNSP</h4>
                        <p class="text-muted">Dapatkan sertifikat resmi yang diakui industri setelah menyelesaikan pelatihan.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4 animate-slide-up" style="animation-delay: 0.4s;">
                    <div class="feature-card h-100 industrial-accent">
                        <i class="fas fa-tools feature-icon"></i>
                        <h4 class="font-weight-bold mb-3">Peluang Karir</h4>
                        <p class="text-muted">Akses ke jaringan mitra industri untuk meningkatkan peluang kerja Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Enhanced Features End -->

    <!-- Enhanced Slideshow Section (from alternative code) -->
    <div class="container mx-auto px-4 py-8">
        @if($slideshowItems && $slideshowItems->count() > 0)
        <div class="carousel-wrapper">
            <div class="carousel-container">
                @foreach($slideshowItems as $index => $item)
                <input type="radio" name="slideshow" id="slide{{ $index }}" {{ $index === 0 ? 'checked' : '' }}>
                @endforeach
                
                <div class="carousel-track">
                    @foreach($slideshowItems as $index => $item)
                    <div class="carousel-slide slide-{{ $index }}">
                        <div class="slide-media">
                            @if($item['image'])
                                <img src="{{ asset('storage/' . $item['image']) }}" 
                                     alt="{{ $item['title'] }}"
                                     class="slide-image">
                            @else
                                <div class="slide-placeholder">
                                    <div class="placeholder-pattern"></div>
                                </div>
                            @endif
                            
                            <!-- Type-specific icon overlay with links -->
                            <div style="position: absolute; top: 1rem; right: 1rem; z-index: 9;">
                                @if ($item['type'] === 'news')
                                    <a href="/berita" style="text-decoration: none;">
                                        <i class="fas fa-newspaper" style="color: var(--text-white); width: 3rem; height: 3rem; background: rgba(1, 62, 126, 0.8); border: 2px solid rgba(255, 255, 255, 0.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; box-shadow: 0 4px 12px rgba(1, 62, 126, 0.4);"></i>
                                    </a>
                                @else
                                    <a href="/trainings" style="text-decoration: none;">
                                        <i class="fas fa-graduation-cap" style="color: var(--text-white); width: 3rem; height: 3rem; background: rgba(56, 161, 105, 0.8); border: 2px solid rgba(255, 255, 255, 0.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; box-shadow: 0 4px 12px rgba(56, 161, 105, 0.4);"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        
                        <div class="slide-gradient-overlay"></div>
                        
                        <div class="slide-content-wrapper">
                            <div class="slide-content">
                                <div class="slide-badge {{ $item['type'] === 'news' ? 'badge-news' : 'badge-training' }}">
                                    {{ $item['badge'] }}
                                </div>
                                <h2 class="slide-title">{{ $item['title'] }}</h2>
                                <p class="slide-description">
                                    {{ Str::limit($item['description'], 150) }}
                                </p>
                                <div class="slide-meta">
                                    <div class="author-info">
                                        <span class="author-name">{{ $item['author'] }}</span>
                                        <span class="meta-divider">•</span>
                                        <time class="publish-date">
                                            @if($item['type'] === 'news')
                                                {{ \Carbon\Carbon::parse($item['date'])->format('d M Y') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($item['date'])->format('d M Y') }} (Mulai)
                                            @endif
                                        </time>
                                        @if($item['type'] === 'training')
                                            <span class="meta-divider">•</span>
                                            <span class="training-location">{{ $item['data']->location ?? 'TBA' }}</span>
                                        @endif
                                    </div>
                                </div>
                                <a style="color: var(--text-white);" href="{{ $item['url'] }}" class="slide-cta {{ $item['type'] === 'news' ? 'cta-news' : 'cta-training' }}">
                                    <span>
                                        @if($item['type'] === 'news')
                                            Baca Selengkapnya
                                        @else
                                            Daftar Sekarang
                                        @endif
                                    </span>
                                    <svg class="cta-arrow" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Enhanced Navigation -->
                @if($slideshowItems->count() > 1)
                <div class="carousel-navigation">
                    <button class="nav-button nav-prev" id="prevBtn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button class="nav-button nav-next" id="nextBtn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
                @endif
            </div>
            
            <!-- Progress Bar -->
            <div class="carousel-progress">
                <div class="progress-bar" id="progressBar"></div>
            </div>
        </div>
        @endif
    </div>
    <!-- Enhanced Slideshow End -->

    <!-- Programs Start -->
    <div class="container py-5" id="pelatihan-tersedia">
        <h2 class="text-center font-weight-bold mb-5 animate-fade-in" style="color: var(--dark-steel);">Program Pelatihan Tersedia</h2>
        <div class="row">
            @if($trainings->isEmpty())
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-hard-hat" style="font-size: 4rem; color: var(--light-steel); margin-bottom: 1rem;"></i>
                        <p class="text-muted">Tidak ada program pelatihan yang tersedia saat ini.</p>
                    </div>
                </div>
            @else
                @foreach ($trainings as $training)
                <div class="col-lg-4 mb-4 animate-slide-up" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                    <div class="card h-100 hover-zoom position-relative industrial-accent">
                        @if($training->primary_image)
                            <img src="{{ asset('storage/' . $training->primary_image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $training->title }}" 
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <div style="height: 200px; background: linear-gradient(135deg, var(--metallic-silver), var(--light-steel)); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-tools" style="font-size: 3rem; color: var(--primary-blue); opacity: 0.5;"></i>
                            </div>
                        @endif
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title font-weight-bold" style="color: var(--dark-steel);">{{ $training->title }}</h5>
                            <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($training->description, 100) }}</p>
                            <div class="card-text mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-map-marker-alt contact-icon" style="font-size: 1rem; margin-right: 0.5rem;"></i>
                                    <small class="text-muted">{{ $training->location }}</small>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-calendar-alt contact-icon" style="font-size: 1rem; margin-right: 0.5rem;"></i>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($training->start_date)->format('d M Y') }}</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-users contact-icon" style="font-size: 1rem; margin-right: 0.5rem;"></i>
                                    <small class="text-muted">{{ $training->capacity }} Peserta</small>
                                </div>
                            </div>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('courses.index') }}" class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-info-circle mr-1"></i>Detail
                                    </a>
                                    <a href="{{ route('pelatihan.preview', $training->id) }}" class="btn btn-outline-success btn-sm">
                                        <i class="fas fa-user-plus mr-1"></i>Daftar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- Programs End -->

    <!-- Important Information Start -->
    <div class="bg-light py-5">
        <div class="container py-5">
            <h2 class="text-center font-weight-bold mb-5 animate-fade-in" style="color: var(--dark-steel);">Hal-hal Penting untuk Diperhatikan</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-plus contact-icon"></i>
                                <span>Pastikan Anda telah mendaftar akun untuk mengakses pelatihan.</span>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-id-card contact-icon"></i>
                                <span>Lengkapi profil Anda agar mudah dalam proses pendaftaran.</span>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-alt contact-icon"></i>
                                <span>Siapkan dokumen-dokumen penting yang diperlukan untuk pendaftaran.</span>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-question-circle contact-icon"></i>
                                <span>Jika ada pertanyaan, jangan ragu untuk menghubungi kami.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Important Information End -->

    <!-- Footer Statistics Section -->
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-md-6 mb-3">
                    <div class="counter-card">
                        <i class="fas fa-eye counter-icon" style="color: var(--text-white);"></i>
                        <h4 class="counter" data-count="{{ $visitorsToday ?? 0 }}" style="color: var(--text-white);">0</h4>
                        <p>Kunjungan Hari Ini</p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="counter-card">
                        <i class="fas fa-calendar-check counter-icon" style="color: var(--text-white);"></i>
                        <h4 class="counter" data-count="{{ $visitorsYesterday ?? 0 }}" style="color: var(--text-white);">0</h4>
                        <p>Kunjungan Kemarin</p>
                    </div>
                </div>
            </div>
        </div>
    <!-- Footer Statistics Section End -->

    <!-- Contact Start -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0 animate-slide-up">
                <h2 class="font-weight-bold mb-4" style="color: var(--dark-steel);">Hubungi Kami</h2>
                <p class="text-muted mb-4">Jika Anda memiliki pertanyaan atau membutuhkan informasi lebih lanjut, jangan ragu untuk menghubungi kami:</p>
                
                <div class="contact-item mb-4 p-3" style="background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%); border-radius: 12px; border-left: 4px solid var(--warning-orange); box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-map-marker-alt contact-icon"></i>
                        <p class="text-muted mb-0">Jl. Panglima Sudirman No.507, Pesanggrahan, Kec. Batu, Kota Batu, Jawa Timur 65313</p>
                    </div>
                </div>
                
                <div class="contact-item mb-4 p-3" style="background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%); border-radius: 12px; border-left: 4px solid var(--primary-blue); box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-phone-alt contact-icon"></i>
                        <p class="text-muted mb-0">+62 851 7685 1727</p>
                    </div>
                </div>
                
                <div class="contact-item mb-4 p-3" style="background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%); border-radius: 12px; border-left: 4px solid var(--success-green); box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-envelope contact-icon"></i>
                        <p class="text-muted mb-0">disnakerkotabatu@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 animate-slide-up" style="animation-delay: 0.2s;">
                <div class="industrial-accent" style="background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%); padding: 1.5rem; border-radius: 16px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);">
                    <h4 style="color: var(--dark-steel); margin-bottom: 1rem; text-align: center;">
                        <i class="fas fa-map-marker-alt" style="color: var(--warning-orange); margin-right: 0.5rem;"></i>
                        Lokasi Kantor
                    </h4>
                    <div style="position: relative; overflow: hidden; border-radius: 12px; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);">
                        <iframe 
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB2NIWI3Tv9iDPrlnowr_0ZqZWoAQydKJU&q=7%C2%B051'58.5%22S%20112%C2%B030'46.4%22E&maptype=roadmap"
                            width="100%" 
                            height="300" 
                            style="border:0; border-radius: 12px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <div class="text-center mt-3">
                        <a href="https://maps.app.goo.gl/fMfxWbD3zzqGx1uR8?g_st=aw" target="_blank" class="btn btn-primary btn-sm">
                            <i class="fas fa-external-link-alt mr-2"></i>Buka di Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Enhanced Counter Animation
            $('.counter').each(function() {
                var $this = $(this);
                var countTo = parseInt($this.attr('data-count'));
                
                $({ countNum: 0 }).animate({
                    countNum: countTo
                }, {
                    duration: 2500,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(countTo);
                        $this.parent().css('animation', 'industrialPulse 2s ease-in-out');
                    }
                });
            });

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

            // Card hover effects
            $('.counter-card, .feature-card').hover(
                function() {
                    $(this).css('animation', 'gentleFloat 2s ease-in-out infinite');
                },
                function() {
                    $(this).css('animation', 'none');
                }
            );

            // Ripple effect
            $('.counter-card, .feature-card, .card').on('click', function(e) {
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

            // Contact icon hover effects
            $('.contact-icon').hover(
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

        // Updated Carousel Script (from alternative code)
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.carousel-slide');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const progressBar = document.getElementById('progressBar');
            
            let currentSlide = 0;
            const totalSlides = slides.length;
            let autoplayInterval;
            let progressInterval;
            const autoplayDuration = 5000;
            const progressUpdateInterval = 50;
            
            if (totalSlides <= 1) return;
            
            showSlide(0);
            
            prevBtn?.addEventListener('click', function() {
                stopAutoplay();
                currentSlide = currentSlide === 0 ? totalSlides - 1 : currentSlide - 1;
                showSlide(currentSlide);
                startAutoplay();
            });
            
            nextBtn?.addEventListener('click', function() {
                stopAutoplay();
                currentSlide = currentSlide === totalSlides - 1 ? 0 : currentSlide + 1;
                showSlide(currentSlide);
                startAutoplay();
            });
            
            function showSlide(index) {
                slides.forEach(slide => slide.classList.remove('active'));
                slides[index].classList.add('active');
                resetProgressBar();
                startProgressBar();
            }
            
            function startAutoplay() {
                stopAutoplay();
                autoplayInterval = setInterval(() => {
                    currentSlide = currentSlide === totalSlides - 1 ? 0 : currentSlide + 1;
                    showSlide(currentSlide);
                }, autoplayDuration);
            }
            
            function stopAutoplay() {
                if (autoplayInterval) {
                    clearInterval(autoplayInterval);
                    autoplayInterval = null;
                }
                if (progressInterval) {
                    clearInterval(progressInterval);
                    progressInterval = null;
                }
            }
            
            function startProgressBar() {
                let progress = 0;
                const increment = 100 / (autoplayDuration / progressUpdateInterval);
                
                if (progressInterval) {
                    clearInterval(progressInterval);
                }
                
                progressInterval = setInterval(() => {
                    progress += increment;
                    progressBar.style.width = Math.min(progress, 100) + '%';
                    if (progress >= 100) {
                        clearInterval(progressInterval);
                        progressInterval = null;
                    }
                }, progressUpdateInterval);
            }
            
            function resetProgressBar() {
                if (progressInterval) {
                    clearInterval(progressInterval);
                    progressInterval = null;
                }
                progressBar.style.width = '0%';
            }
            
            const carouselContainer = document.querySelector('.carousel-container');
            carouselContainer?.addEventListener('mouseenter', stopAutoplay);
            carouselContainer?.addEventListener('mouseleave', startAutoplay);
            
            let startX = 0;
            let endX = 0;
            
            carouselContainer?.addEventListener('touchstart', function(e) {
                startX = e.touches[0].clientX;
            });
            
            carouselContainer?.addEventListener('touchend', function(e) {
                endX = e.changedTouches[0].clientX;
                handleSwipe();
            });
            
            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = startX - endX;
                
                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        nextBtn.click();
                    } else {
                        prevBtn.click();
                    }
                }
            }
            
            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowLeft') {
                    prevBtn.click();
                } else if (e.key === 'ArrowRight') {
                    nextBtn.click();
                }
            });
            
            startAutoplay();
            
            document.addEventListener('visibilitychange', function() {
                if (document.hidden) {
                    stopAutoplay();
                } else {
                    startAutoplay();
                }
            });
            
            window.addEventListener('beforeunload', function() {
                stopAutoplay();
            });
        });

        console.log('Industrial Worker Home Page Loaded');
    </script>
@endsection