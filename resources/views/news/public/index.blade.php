@extends('layouts.appuser')

@section('title', 'Berita Terbaru')

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

    /* Stunning Header Design */
    .page-header {
        background: 
            linear-gradient(145deg, 
                var(--primary-blue) 0%, 
                var(--secondary-blue) 30%, 
                var(--accent-blue) 70%,
                var(--primary-blue) 100%),
            radial-gradient(ellipse at top left, rgba(255, 140, 0, 0.3) 0%, transparent 60%),
            radial-gradient(ellipse at bottom right, rgba(0, 123, 255, 0.2) 0%, transparent 60%);
        position: relative;
        padding: 4rem 0 3rem;
        /* margin-top: 80px; */
        overflow: hidden;
        clip-path: polygon(0 0, 100% 0, 100% 85%, 50% 100%, 0 85%);
        min-height: 350px;
        display: flex;
        align-items: center;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            conic-gradient(from 45deg at 25% 25%, transparent 0deg, rgba(255, 140, 0, 0.1) 90deg, transparent 180deg),
            conic-gradient(from 225deg at 75% 75%, transparent 0deg, rgba(255, 255, 255, 0.05) 90deg, transparent 180deg);
        animation: rotate-slow 20s linear infinite;
        z-index: 1;
    }

    .page-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            repeating-conic-gradient(
                from 0deg at 50% 50%,
                transparent 0deg,
                rgba(255, 255, 255, 0.02) 15deg,
                transparent 30deg
            );
        z-index: 2;
    }

    @keyframes rotate-slow {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .header-content {
        position: relative;
        z-index: 3;
        text-align: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .header-visual-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
    }

    .geometric-shape {
        position: absolute;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(2px);
    }

    .shape-1 {
        top: 10%;
        left: 10%;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        animation: float-up-down 6s ease-in-out infinite;
    }

    .shape-2 {
        top: 20%;
        right: 15%;
        width: 60px;
        height: 60px;
        transform: rotate(45deg);
        animation: float-left-right 8s ease-in-out infinite;
    }

    .shape-3 {
        bottom: 15%;
        left: 20%;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 140, 0, 0.1);
        animation: pulse-scale 4s ease-in-out infinite;
    }

    .shape-4 {
        bottom: 25%;
        right: 10%;
        width: 100px;
        height: 20px;
        border-radius: 10px;
        animation: float-up-down 5s ease-in-out infinite reverse;
    }

    @keyframes float-up-down {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(5deg); }
    }

    @keyframes float-left-right {
        0%, 100% { transform: translateX(0px) rotate(45deg); }
        50% { transform: translateX(10px) rotate(50deg); }
    }

    @keyframes pulse-scale {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.3); opacity: 0.8; }
    }

    .header-icon-container {
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
    }

    .header-main-icon {
        font-size: 3rem;
        color: var(--warning-orange);
        animation: icon-glow 3s ease-in-out infinite;
        filter: drop-shadow(0 0 15px rgba(255, 140, 0, 0.6));
        position: relative;
        z-index: 2;
    }

    .icon-rings {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 120px;
        height: 120px;
    }

    .ring {
        position: absolute;
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: ring-pulse 4s ease-in-out infinite;
    }

    .ring-1 { width: 60px; height: 60px; top: 30px; left: 30px; animation-delay: 0s; }
    .ring-2 { width: 80px; height: 80px; top: 20px; left: 20px; animation-delay: 1s; }
    .ring-3 { width: 100px; height: 100px; top: 10px; left: 10px; animation-delay: 2s; }

    @keyframes ring-pulse {
        0%, 100% { transform: scale(1); opacity: 0.3; }
        50% { transform: scale(1.2); opacity: 0.1; }
    }

    @keyframes icon-glow {
        0%, 100% { 
            filter: drop-shadow(0 0 15px rgba(255, 140, 0, 0.6));
            transform: scale(1);
        }
        50% { 
            filter: drop-shadow(0 0 25px rgba(255, 140, 0, 0.9));
            transform: scale(1.05);
        }
    }

    .page-title {
        font-size: 2.8rem;
        color: var(--text-white);
        font-weight: 900;
        margin-bottom: 1rem;
        text-shadow: 
            0 4px 8px rgba(0, 0, 0, 0.4),
            0 2px 4px rgba(0, 0, 0, 0.3);
        letter-spacing: -0.5px;
        line-height: 1.1;
        position: relative;
        display: inline-block;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, 
            transparent 0%, 
            var(--warning-orange) 30%, 
            var(--text-white) 50%, 
            var(--warning-orange) 70%, 
            transparent 100%);
        border-radius: 2px;
        animation: underline-glow 2s ease-in-out infinite alternate;
    }

    @keyframes underline-glow {
        0% { box-shadow: 0 0 5px rgba(255, 140, 0, 0.3); }
        100% { box-shadow: 0 0 15px rgba(255, 140, 0, 0.8); }
    }

    .page-subtitle {
        color: var(--text-light);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto 1.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        line-height: 1.5;
    }

    .header-stats {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-top: 1.5rem;
        flex-wrap: wrap;
    }

    .stat-item {
        background: 
            linear-gradient(145deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.05));
        backdrop-filter: blur(15px);
        padding: 1rem 1.5rem;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        text-align: center;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        min-width: 120px;
    }

    .stat-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, 
            transparent, 
            rgba(255, 255, 255, 0.1), 
            transparent);
        transition: left 0.5s ease;
    }

    .stat-item:hover::before {
        left: 100%;
    }

    .stat-item:hover {
        background: 
            linear-gradient(145deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        border-color: rgba(255, 140, 0, 0.3);
    }

    .stat-number {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--warning-orange);
        display: block;
        margin-bottom: 0.25rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .stat-label {
        color: var(--text-light);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    /* Elegant Divider */
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

    /* Carousel styles (unchanged) */
    .carousel-wrapper {
        margin-top: 0;
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
            rgba(0,0,0,0.7) 0%,
            rgba(0,0,0,0.4) 50%,
            rgba(0,0,0,0.7) 100%
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
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: white;
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
        color: white;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .slide-description {
        color: rgba(255, 255, 255, 0.9);
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
        color: white;
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
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        color: white;
        padding: 1rem 2rem;
        border-radius: 3rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(1, 62, 126, 0.3);
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
        box-shadow: 0 15px 35px rgba(1, 62, 126, 0.4);
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

    /* Navigation styles (unchanged) */
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
        color: white;
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

    .carousel-indicators {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 1rem;
        z-index: 10;
    }

    .indicator {
        cursor: pointer;
        padding: 0.5rem;
        background: none;
        border: none;
    }

    .indicator-line {
        display: block;
        width: 2.5rem;
        height: 0.25rem;
        background: rgba(255, 255, 255, 0.4);
        border-radius: 0.125rem;
        transition: all 0.3s ease;
    }

    .indicator:hover .indicator-line {
        background: rgba(255, 255, 255, 0.7);
    }

    .indicator.active .indicator-line {
        background: white;
        width: 3rem;
    }

    .carousel-progress {
        height: 0.25rem;
        background: rgba(0, 0, 0, 0.1);
        border-radius: 0 0 1rem 1rem;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, var(--primary-blue), var(--secondary-blue));
        width: 0%;
        transition: width 0.1s ease;
    }

    /* Enhanced News Section with Horizontal Cards */
    .news-section {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 20px;
        padding: 3rem;
        margin: 3rem 0;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.1),
            0 8px 24px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }

    .news-section::before {
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

    .news-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--dark-steel);
        margin-bottom: 2rem;
        text-align: center;
        position: relative;
    }

    .news-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-blue), var(--warning-orange));
        border-radius: 2px;
    }

    /* Horizontal News Cards */
    .news-cards-container {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .news-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: none;
        border-radius: 20px;
        box-shadow: 
            0 15px 35px rgba(0, 0, 0, 0.08),
            0 5px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: var(--transition);
        position: relative;
        display: flex;
        min-height: 200px;
    }

    .news-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-blue), var(--warning-orange));
        z-index: 2;
    }

    .news-card:hover {
        transform: translateY(-8px) scale(1.01);
        box-shadow: 
            0 25px 50px rgba(0, 0, 0, 0.15),
            0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .news-card-link {
        display: flex;
        text-decoration: none;
        color: inherit;
        width: 100%;
    }

    .news-thumbnail {
        width: 300px;
        min-width: 300px;
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
        transform: scale(1.08);
        filter: brightness(1.1) contrast(1.05);
    }

    .news-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--light-steel), var(--metallic-silver));
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .placeholder-icon {
        width: 3rem;
        height: 3rem;
        color: var(--primary-blue);
        opacity: 0.5;
    }

    .news-content {
        padding: 2rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .news-card-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--dark-steel);
        margin-bottom: 1rem;
        transition: var(--transition);
        line-height: 1.3;
    }

    .news-card:hover .news-card-title {
        color: var(--primary-blue);
    }

    .news-excerpt {
        color: var(--light-steel);
        margin-bottom: 1.5rem;
        line-height: 1.6;
        flex: 1;
        font-size: 1rem;
    }

    .news-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.9rem;
        color: var(--light-steel);
        padding-top: 1rem;
        border-top: 2px solid rgba(1, 62, 126, 0.1);
    }

    .news-author-date {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .meta-separator {
        color: var(--warning-orange);
        margin: 0 0.5rem;
    }

    .read-more {
        color: var(--primary-blue);
        font-weight: 600;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
    }

    .read-more::after {
        content: '→';
        transition: var(--transition);
    }

    .news-card:hover .read-more {
        color: var(--warning-orange);
    }

    .news-card:hover .read-more::after {
        transform: translateX(4px);
    }

    /* No news state */
    .no-news {
        text-align: center;
        padding: 4rem 2rem;
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 20px;
        border: 2px dashed var(--light-steel);
    }

    .no-news-icon {
        width: 5rem;
        height: 5rem;
        color: var(--light-steel);
        margin: 0 auto 2rem;
    }

    .no-news-text {
        color: var(--light-steel);
        font-size: 1.3rem;
        font-weight: 500;
    }

    /* Pagination */
    .pagination-container {
        margin-top: 3rem;
        display: flex;
        justify-content: center;
    }

    .pagination {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 15px;
        padding: 1rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .page-link {
        color: var(--primary-blue);
        border: none;
        padding: 0.75rem 1rem;
        margin: 0 0.25rem;
        border-radius: 10px;
        transition: var(--transition);
        font-weight: 600;
    }

    .page-link:hover {
        background: var(--primary-blue);
        color: white;
        transform: translateY(-2px);
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        color: white;
        box-shadow: 0 4px 15px rgba(1, 62, 126, 0.3);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header {
            padding: 3rem 0 2rem;
            min-height: 280px;
        }
        
        .page-title {
            font-size: 2.2rem;
        }
        
        .page-subtitle {
            font-size: 1rem;
        }
        
        .header-main-icon {
            font-size: 2.5rem;
        }
        
        .header-stats {
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }
        
        .stat-item {
            padding: 0.8rem 1.2rem;
            min-width: 100px;
        }
        
        .stat-number {
            font-size: 1.4rem;
        }
        
        .news-card {
            flex-direction: column;
            min-height: auto;
        }
        
        .news-thumbnail {
            width: 100%;
            height: 200px;
        }
        
        .carousel-container {
            height: 24rem;
        }
        
        .slide-title {
            font-size: 1.875rem;
        }
    }

    @media (max-width: 480px) {
        .page-header {
            padding: 2.5rem 0 1.5rem;
            min-height: 250px;
        }
        
        .page-title {
            font-size: 1.8rem;
        }
        
        .page-subtitle {
            font-size: 0.9rem;
        }
        
        .header-content {
            padding: 0 1rem;
        }
        
        .news-section {
            padding: 2rem 1rem;
        }
        
        .news-title {
            font-size: 1.75rem;
        }
        
        .news-content {
            padding: 1.5rem;
        }
    }

    /* Animation Keyframes */
    @keyframes fadeIn {
        from { 
            opacity: 0; 
            transform: translateY(30px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
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

    .animate-fade-in {
        animation: fadeIn 1s ease-out;
    }

    .animate-slide-up {
        animation: slideUp 1s ease-out;
    }

    /* Industrial Accent */
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
<!-- Revolutionary Header Design -->
<div class="page-header">
    <div class="container">
        <div class="header-content">
            <div class="header-visual-elements">
                <div class="geometric-shape shape-1"></div>
                <div class="geometric-shape shape-2"></div>
                <div class="geometric-shape shape-3"></div>
                <div class="geometric-shape shape-4"></div>
            </div>
            
            <div class="header-icon-container">
                <i class="fas fa-newspaper header-main-icon"></i>
                <div class="icon-rings">
                    <div class="ring ring-1"></div>
                    <div class="ring ring-2"></div>
                    <div class="ring ring-3"></div>
                </div>
            </div>
            
            <h1 class="page-title animate-fade-in">
                Berita Terbaru
            </h1>
            <p class="page-subtitle animate-fade-in">
                Informasi terkini seputar program pelatihan, kegiatan, dan perkembangan Dinas Tenaga Kerja Kota Batu
            </p>
            
            <div class="header-stats animate-fade-in">
                <div class="stat-item">
                    <span class="stat-number">{{ $totalNews ?? '50+' }}</span>
                    <span class="stat-label">Total Berita</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $monthlyNews ?? '15+' }}</span>
                    <span class="stat-label">Bulan Ini</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $weeklyNews ?? '5+' }}</span>
                    <span class="stat-label">Minggu Ini</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Elegant Divider -->
<div class="container">
    <div class="elegant-divider"></div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Enhanced Slideshow Section (unchanged functionality) -->
    @if($slideshowNews->count() > 0)
    <div class="carousel-wrapper">
        <div class="carousel-container">
            @foreach($slideshowNews as $index => $news)
            <input type="radio" name="slideshow" id="slide{{ $index }}" {{ $index === 0 ? 'checked' : '' }}>
            @endforeach
            
            <div class="carousel-track">
                @foreach($slideshowNews as $index => $news)
                <div class="carousel-slide slide-{{ $index }}">
                    <div class="slide-media">
                        @if($news->thumbnail)
                            <img src="{{ asset('storage/' . $news->thumbnail) }}" 
                                 alt="{{ $news->title }}"
                                 class="slide-image">
                        @else
                            <div class="slide-placeholder">
                                <div class="placeholder-pattern"></div>
                            </div>
                        @endif
                        <div class="slide-gradient-overlay"></div>
                    </div>
                    
                    <div class="slide-content-wrapper">
                        <div class="slide-content">
                            <div class="slide-badge">Berita Utama</div>
                            <h2 class="slide-title">{{ $news->title }}</h2>
                            <p class="slide-description">
                                {{ Str::limit(strip_tags($news->content), 150) }}
                            </p>
                            <div class="slide-meta">
                                <div class="author-info">
                                    <span class="author-name">{{ $news->author->name ?? 'Admin' }}</span>
                                    <span class="meta-divider">•</span>
                                    <time class="publish-date">{{ $news->published_at->format('d M Y') }}</time>
                                </div>
                            </div>
                            <a style="color: white;" href="{{ route('news.public.show', $news->id) }}" class="slide-cta">
                                <span>Baca Selengkapnya</span>
                                <svg class="cta-arrow" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Enhanced Navigation with JavaScript -->
            @if($slideshowNews->count() > 1)
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
            
            <!-- Enhanced Indicators -->
            <div class="carousel-indicators">
                @foreach($slideshowNews as $index => $news)
                <button class="indicator" data-slide="{{ $index }}">
                    <span class="indicator-line"></span>
                </button>
                @endforeach
            </div>
            @endif
        </div>
        
        <!-- Progress Bar -->
        <div class="carousel-progress">
            <div class="progress-bar" id="progressBar"></div>
        </div>
    </div>
    @endif

    <!-- Enhanced News Cards Section with Horizontal Layout -->
    <div class="news-section animate-fade-in industrial-accent">
        <h3 class="news-title">
            <i class="fas fa-list-alt" style="color: var(--warning-orange); margin-right: 1rem;"></i>
            Berita Lainnya
        </h3>
        
        <div class="news-cards-container">
            @forelse($cardNews as $index => $news)
            <article class="news-card animate-slide-up" style="animation-delay: {{ $index * 0.1 }}s;">
                <a href="{{ route('news.public.show', $news->id) }}" class="news-card-link">
                    <div class="news-thumbnail">
                        @if($news->thumbnail)
                            <img src="{{ asset('storage/' . $news->thumbnail) }}" 
                                 alt="{{ $news->title }}" 
                                 class="news-image">
                        @else
                            <div class="news-placeholder">
                                <i class="fas fa-newspaper placeholder-icon"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="news-content">
                        <div>
                            <h4 class="news-card-title">{{ $news->title }}</h4>
                            <p class="news-excerpt">{{ Str::limit(strip_tags($news->content), 200) }}</p>
                        </div>
                        <div class="news-meta">
                            <div class="news-author-date">
                                <i class="fas fa-user" style="color: var(--primary-blue);"></i>
                                <span>{{ $news->author->name ?? 'Admin' }}</span>
                                <span class="meta-separator">•</span>
                                <i class="fas fa-calendar" style="color: var(--warning-orange);"></i>
                                <span>{{ $news->published_at->format('d M Y') }}</span>
                            </div>
                            <span class="read-more">Baca selengkapnya</span>
                        </div>
                    </div>
                </a>
            </article>
            @empty
            <div class="no-news animate-fade-in">
                <i class="fas fa-newspaper no-news-icon"></i>
                <p class="no-news-text">Belum ada berita tersedia</p>
                <p style="color: var(--light-steel); margin-top: 1rem;">
                    Pantau terus halaman ini untuk mendapatkan informasi terbaru dari Dinas Tenaga Kerja Kota Batu.
                </p>
            </div>
            @endforelse
        </div>
        
        @if($cardNews->hasPages())
        <div class="pagination-container animate-fade-in">
            {{ $cardNews->links() }}
        </div>
        @endif
    </div>

    <!-- Additional Information Section -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div style="background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%); border-radius: 20px; padding: 2.5rem; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1); position: relative; overflow: hidden;" class="animate-slide-up industrial-accent">
                    <div class="text-center">
                        <i class="fas fa-info-circle" style="font-size: 3rem; color: var(--primary-blue); margin-bottom: 1.5rem;"></i>
                        <h4 style="color: var(--dark-steel); margin-bottom: 1rem; font-weight: 700;">Ikuti Perkembangan Terbaru</h4>
                        <p style="color: var(--light-steel); margin-bottom: 2rem; font-size: 1.1rem; line-height: 1.6;">
                            Dapatkan informasi terkini tentang program pelatihan, kegiatan, dan pengumuman penting dari Dinas Tenaga Kerja Kota Batu.
                        </p>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div style="background: rgba(1, 62, 126, 0.1); padding: 1.5rem; border-radius: 15px; border-left: 4px solid var(--primary-blue);">
                                    <i class="fas fa-graduation-cap" style="color: var(--primary-blue); font-size: 2rem; margin-bottom: 1rem;"></i>
                                    <h6 style="color: var(--dark-steel); font-weight: 600; margin-bottom: 0.5rem;">Program Pelatihan</h6>
                                    <p style="color: var(--light-steel); font-size: 0.9rem; margin: 0;">Informasi pendaftaran dan jadwal pelatihan terbaru</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div style="background: rgba(255, 140, 0, 0.1); padding: 1.5rem; border-radius: 15px; border-left: 4px solid var(--warning-orange);">
                                    <i class="fas fa-bullhorn" style="color: var(--warning-orange); font-size: 2rem; margin-bottom: 1rem;"></i>
                                    <h6 style="color: var(--dark-steel); font-weight: 600; margin-bottom: 0.5rem;">Pengumuman</h6>
                                    <p style="color: var(--light-steel); font-size: 0.9rem; margin: 0;">Berita penting dan pengumuman resmi</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('home') }}" class="btn" style="background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue)); color: white; padding: 12px 28px; border-radius: 25px; font-weight: 600; text-decoration: none; transition: var(--transition); box-shadow: 0 4px 16px rgba(1, 62, 126, 0.3);">
                                <i class="fas fa-home" style="margin-right: 0.5rem;"></i>
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.indicator');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const progressBar = document.getElementById('progressBar');
    
    let currentSlide = 0;
    const totalSlides = slides.length;
    let autoplayInterval;
    let progressInterval;
    const autoplayDuration = 5000; // 5 seconds per slide
    
    if (totalSlides <= 1) return;
    
    // Initialize first slide
    showSlide(0);
    
    // Previous button
    prevBtn?.addEventListener('click', function() {
        stopAutoplay();
        currentSlide = currentSlide === 0 ? totalSlides - 1 : currentSlide - 1;
        showSlide(currentSlide);
        startAutoplay();
    });
    
    // Next button
    nextBtn?.addEventListener('click', function() {
        stopAutoplay();
        currentSlide = currentSlide === totalSlides - 1 ? 0 : currentSlide + 1;
        showSlide(currentSlide);
        startAutoplay();
    });
    
    // Indicator buttons
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function() {
            stopAutoplay();
            currentSlide = index;
            showSlide(currentSlide);
            startAutoplay();
        });
    });
    
    // Show specific slide
    function showSlide(index) {
        // Remove active class from all slides and indicators
        slides.forEach(slide => slide.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));
        
        // Add active class to current slide and indicator
        slides[index]?.classList.add('active');
        indicators[index]?.classList.add('active');
        
        // Reset progress bar
        resetProgressBar();
    }
    
    // Auto-advance slides
    function startAutoplay() {
        autoplayInterval = setInterval(() => {
            currentSlide = currentSlide === totalSlides - 1 ? 0 : currentSlide + 1;
            showSlide(currentSlide);
        }, autoplayDuration);
        
        startProgressBar();
    }
    
    // Stop autoplay
    function stopAutoplay() {
        if (autoplayInterval) {
            clearInterval(autoplayInterval);
        }
        if (progressInterval) {
            clearInterval(progressInterval);
        }
    }
    
    // Progress bar animation
    function startProgressBar() {
        let progress = 0;
        const increment = 100 / (autoplayDuration / 100);
        
        progressInterval = setInterval(() => {
            progress += increment;
            progressBar.style.width = progress + '%';
            
            if (progress >= 100) {
                clearInterval(progressInterval);
            }
        }, 100);
    }
    
    // Reset progress bar
    function resetProgressBar() {
        progressBar.style.width = '0%';
    }
    
    // Pause autoplay on hover
    const carouselContainer = document.querySelector('.carousel-container');
    carouselContainer?.addEventListener('mouseenter', stopAutoplay);
    carouselContainer?.addEventListener('mouseleave', startAutoplay);
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            prevBtn?.click();
        } else if (e.key === 'ArrowRight') {
            nextBtn?.click();
        }
    });
    
    // Touch/swipe support
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
                // Swipe left - next slide
                nextBtn?.click();
            } else {
                // Swipe right - previous slide
                prevBtn?.click();
            }
        }
    }
    
    // Start autoplay
    startAutoplay();
    
    // Pause autoplay when page becomes hidden
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            stopAutoplay();
        } else {
            startAutoplay();
        }
    });

    // Enhanced animations on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe all animated elements
    document.querySelectorAll('.animate-fade-in, .animate-slide-up').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        observer.observe(el);
    });

    // Enhanced card hover effects for horizontal cards
    document.querySelectorAll('.news-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.01)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    console.log('Enhanced News Page with Horizontal Cards Loaded Successfully');
});
</script>

@endsection