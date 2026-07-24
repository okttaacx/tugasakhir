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
<<<<<<< HEAD
        --shadow: 0 4px 15px rgba(0,0,0,0.08);
        --shadow-hover: 0 10px 30px rgba(0,0,0,0.12);
        --transition: all 0.25s ease;
=======
        --shadow: 0 4px 15px rgba(0,0,0,0.1);
        --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
        --steel-gray: #4a5568;
        --dark-steel: #2d3748;
        --light-steel: #718096;
        --warning-orange: #ff8c00;
        --success-green: #38a169;
        --industrial-yellow: #ffc107;
        --carbon-black: #1a202c;
        --metallic-silver: #e2e8f0;
<<<<<<< HEAD
        --border-soft: rgba(1, 62, 126, 0.1);
        --radius-lg: 16px;
        --radius-md: 12px;
        --radius-pill: 25px;
    }

    * {
        box-sizing: border-box;
    }

    .training-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 3rem 1.5rem;
=======
    }

    .training-container {
        margin: 0 auto;
        padding: 3rem 1rem;
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
        background: linear-gradient(135deg, var(--metallic-silver) 0%, #f7fafc 100%);
    }

    .training-page-header {
        text-align: center;
<<<<<<< HEAD
        margin-bottom: 2.5rem;
=======
        margin-bottom: 3rem;
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-page-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--dark-steel);
<<<<<<< HEAD
        margin-bottom: 0.75rem;
=======
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
        animation: fadeIn 1s ease-out;
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-page-subtitle {
        color: var(--light-steel);
        font-size: 1.125rem;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

<<<<<<< HEAD
    /* Search Section — now spans the same width as the trainings grid below */
    .training-search-section {
        background: #ffffff;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        margin: 0 auto 3rem;
        width: 100%;
        padding: 1.5rem 1.75rem;
        border: 1px solid var(--border-soft);
        position: relative;
=======
    .training-search-section {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 16px;
        box-shadow: var(--shadow);
        margin-bottom: 3rem;
        margin-left: 9%;
        margin-right: 9%;
        padding: 1.5rem;
        border: 1px solid rgba(1, 62, 126, 0.1);
        position: relative;
        animation: slideUp 1s ease-out;
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-search-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-blue) 0%, var(--accent-blue) 50%, var(--warning-orange) 100%);
<<<<<<< HEAD
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
=======
        border-radius: 16px 16px 0 0;
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-search-form {
        display: flex;
<<<<<<< HEAD
        flex-wrap: wrap;
        gap: 1rem;
        width: 100%;
    }

    .training-search-input {
        flex: 1 1 320px;
        padding: 0.875rem 1.1rem;
        border: 2px solid var(--metallic-silver);
        border-radius: var(--radius-md);
        font-size: 1rem;
        transition: var(--transition);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
=======
        gap: 1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    .training-search-input {
        flex: 1;
        padding: 0.875rem 1rem;
        border: 2px solid var(--metallic-silver);
        border-radius: 12px;
        font-size: 1rem;
        transition: var(--transition);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        box-shadow: 0 19px 21px rgba(0, 0, 0, 0.05);
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-search-input:focus {
        outline: none;
        border-color: var(--accent-blue);
<<<<<<< HEAD
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.12);
=======
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-btn {
        padding: 0.875rem 1.5rem;
<<<<<<< HEAD
        border-radius: var(--radius-pill);
=======
        border-radius: 25px;
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
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
<<<<<<< HEAD
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        white-space: nowrap;
=======
        position: relative;
        overflow: hidden;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-btn-primary {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        color: var(--text-white);
<<<<<<< HEAD
        box-shadow: 0 4px 12px rgba(1, 62, 126, 0.25);
    }

    .training-btn-primary:hover {
        background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
        box-shadow: 0 6px 18px rgba(1, 62, 126, 0.3);
=======
        box-shadow: 0 4px 16px rgba(1, 62, 126, 0.3);
    }

    .training-btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .training-btn-primary:hover::before {
        left: 100%;
    }

    .training-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(1, 62, 126, 0.4);
        background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
        color: var(--text-white);
        text-decoration: none;
    }

    .training-btn-secondary {
        border: 2px solid var(--accent-blue);
        color: var(--accent-blue);
        background: transparent;
    }

    .training-btn-secondary:hover {
        background: var(--accent-blue);
        color: var(--text-white);
<<<<<<< HEAD
=======
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
        text-decoration: none;
    }

    .training-btn-success {
<<<<<<< HEAD
        background: linear-gradient(135deg, var(--success-green), #2f855a);
        color: var(--text-white);
        box-shadow: 0 4px 12px rgba(56, 161, 105, 0.25);
    }

    .training-btn-success:hover {
        box-shadow: 0 6px 18px rgba(56, 161, 105, 0.3);
=======
        background: linear-gradient(135deg, var(--success-green), var(--industrial-yellow));
        color: var(--text-white);
        box-shadow: 0 4px 16px rgba(56, 161, 105, 0.3);
    }

    .training-btn-success::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .training-btn-success:hover::before {
        left: 100%;
    }

    .training-btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(56, 161, 105, 0.4);
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
        color: var(--text-white);
        text-decoration: none;
    }

    .training-btn-disabled {
        background: var(--metallic-silver);
        color: var(--light-steel);
        cursor: not-allowed;
        border: 1px solid var(--metallic-silver);
    }

<<<<<<< HEAD
    /* Trainings Grid */
    .trainings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
=======
    .trainings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .training-card {
<<<<<<< HEAD
        display: flex;
        flex-direction: column;
        background: #ffffff;
        border-radius: var(--radius-lg);
=======
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 16px;
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
        transition: var(--transition);
<<<<<<< HEAD
        border: 1px solid var(--border-soft);
        width: 100%;
=======
        transform: perspective(1000px) rotateX(0deg) rotateY(0deg);
        border: 1px solid rgba(1, 62, 126, 0.1);
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-blue) 0%, var(--accent-blue) 50%, var(--warning-orange) 100%);
<<<<<<< HEAD
        z-index: 2;
    }

    .training-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-hover);
=======
        border-radius: 16px 16px 0 0;
    }

    .training-card:hover {
        transform: perspective(1000px) rotateX(5deg) rotateY(-2deg) translateY(-12px) scale(1.02);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15), 0 8px 24px rgba(0, 0, 0, 0.1);
        animation: gentleFloat 2s ease-in-out infinite;
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-image-container {
        position: relative;
        width: 100%;
        height: 220px;
        overflow: hidden;
<<<<<<< HEAD
        flex-shrink: 0;
=======
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
<<<<<<< HEAD
        display: block;
        transition: var(--transition);
    }

    .training-card:hover .training-image {
        transform: scale(1.04);
=======
        transition: var(--transition);
        filter: brightness(0.9);
    }

    .training-card:hover .training-image {
        transform: scale(1.08) rotateZ(1deg);
        filter: brightness(1.1) contrast(1.05);
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-white);
<<<<<<< HEAD
=======
        font-size: 1.1rem;
        font-weight: 600;
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
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
<<<<<<< HEAD
        border: 1px solid var(--border-soft);
        z-index: 3;
=======
        backdrop-filter: blur(4px);
        border: 1px solid rgba(1, 62, 126, 0.2);
        transition: var(--transition);
    }

    .training-card:hover .training-capacity-badge {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        color: var(--text-white);
        box-shadow: 0 4px 12px rgba(1, 62, 126, 0.4);
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-content {
        padding: 1.5rem;
<<<<<<< HEAD
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .training-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--dark-steel);
        line-height: 1.35;
        min-height: 2.7em;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
=======
    }

    .training-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--dark-steel);
        line-height: 1.3;
        transition: var(--transition);
    }

    .training-card:hover .training-title {
        color: var(--primary-blue);
        transform: translateY(-2px);
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
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
        width: 16px;
        height: 16px;
<<<<<<< HEAD
        min-width: 16px;
        color: var(--warning-orange);
=======
        color: var(--warning-orange);
        transition: var(--transition);
    }

    .training-meta-item:hover .training-meta-icon {
        color: var(--primary-blue);
        transform: scale(1.2) rotate(10deg);
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-description {
        color: var(--light-steel);
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
<<<<<<< HEAD
        flex: 1;
=======
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-card-actions {
        display: flex;
        gap: 0.75rem;
<<<<<<< HEAD
        margin-top: auto;
=======
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-flex-1 {
        flex: 1;
    }

    .training-empty-state {
        text-align: center;
        padding: 4rem 2rem;
<<<<<<< HEAD
        background: #ffffff;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        border: 1px solid var(--border-soft);
        position: relative;
=======
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 16px;
        box-shadow: var(--shadow);
        border: 1px solid rgba(1, 62, 126, 0.1);
        position: relative;
        animation: fadeIn 1s ease-out;
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-empty-state::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-blue) 0%, var(--accent-blue) 50%, var(--warning-orange) 100%);
<<<<<<< HEAD
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
=======
        border-radius: 16px 16px 0 0;
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 1rem;
        color: var(--light-steel);
<<<<<<< HEAD
=======
        filter: drop-shadow(0 4px 8px rgba(1, 62, 126, 0.3));
        transition: var(--transition);
    }

    .training-empty-state:hover .training-empty-icon {
        transform: scale(1.2) rotate(-5deg);
        color: var(--primary-blue);
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    }

    .training-empty-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--dark-steel);
        margin-bottom: 0.5rem;
    }

    .training-empty-subtitle {
        color: var(--light-steel);
    }

    .training-pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

<<<<<<< HEAD
    /* Pagination */
    .pagination {
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination .page-item .page-link {
        border-radius: var(--radius-md);
        margin: 0 4px;
        color: var(--dark-steel);
        border: 1px solid var(--metallic-silver);
        background: #ffffff;
=======
    /* Pagination Styling */
    .pagination .page-item .page-link {
        border-radius: 12px;
        margin: 0 4px;
        color: var(--dark-steel);
        border: 1px solid var(--metallic-silver);
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
        transition: var(--transition);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        color: var(--text-white);
        border-color: var(--primary-blue);
<<<<<<< HEAD
    }

    .pagination .page-item .page-link:hover {
        background: var(--accent-blue);
        color: var(--text-white);
    }

    /* Responsive */
=======
        box-shadow: 0 4px 16px rgba(1, 62, 126, 0.3);
    }

    .pagination .page-item .page-link:hover {
        background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
        color: var(--text-white);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
    }

    /* Responsive Design */
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
    @media (max-width: 768px) {
        .training-search-form {
            flex-direction: column;
        }
<<<<<<< HEAD
        .training-search-input {
            flex: 1 1 auto;
        }
=======
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
        .trainings-grid {
            grid-template-columns: 1fr;
        }
        .training-card-actions {
            flex-direction: column;
        }
        .training-page-title {
            font-size: 1.8rem;
        }
        .training-image-container {
            height: 180px;
        }
    }

    @media (max-width: 480px) {
<<<<<<< HEAD
        .training-container {
            padding: 2rem 1rem;
        }
        .training-search-section {
            padding: 1.25rem;
        }
=======
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
        .training-image-container {
            height: 150px;
        }
        .training-page-title {
            font-size: 1.5rem;
        }
        .training-page-subtitle {
            font-size: 1rem;
        }
    }
<<<<<<< HEAD
=======

    /* Animations */
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
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
</style>

<div class="training-container">
    <div class="training-page-header">
        <h1 class="training-page-title">Daftar Pelatihan</h1>
        <p class="training-page-subtitle">Temukan pelatihan yang tepat untuk mengembangkan kemampuan dan karir Anda</p>
    </div>

<<<<<<< HEAD
    <!-- Search Section (lebar sama dengan grid card di bawahnya) -->
    <div class="training-search-section">
        <form method="GET" action="{{ route('trainings.user.index') }}" class="training-search-form">
            <input type="text"
                   name="search"
                   value="{{ $search }}"
                   placeholder="Cari pelatihan berdasarkan judul..."
                   class="training-search-input">
            <button type="submit" class="training-btn training-btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px; margin-right: 0.5rem;">
=======
    <!-- Search Section -->
    <div class="training-search-section">
        <form method="GET" action="{{ route('trainings.user.index') }}" class="training-search-form">
            <input type="text" 
                   name="search" 
                   value="{{ $search }}" 
                   placeholder="Cari pelatihan berdasarkan judul..." 
                   class="training-search-input">
            <button type="submit" class="training-btn training-btn-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px; margin-right: 0.5rem;">
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Cari
            </button>
            @if($search)
                <a href="{{ route('trainings.user.index') }}" class="training-btn training-btn-secondary">
<<<<<<< HEAD
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px; margin-right: 0.5rem;">
=======
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px; margin-right: 0.5rem;">
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
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
<<<<<<< HEAD
                            $imageToShow = $primaryImage ?? $firstImage;
                        @endphp

                        @if($imageToShow)
                            <img src="{{ Storage::url($imageToShow->image_path) }}"
                                 alt="{{ $training->title }}"
                                 class="training-image"
                                 onerror="this.onerror=null;this.replaceWith(Object.assign(document.createElement('div'), {className:'training-placeholder', innerHTML:'<svg style=&quot;width:48px;height:48px;&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; viewBox=&quot;0 0 24 24&quot;><path stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; stroke-width=&quot;2&quot; d=&quot;M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10&quot;></path></svg>'}));">
                        @else
                            <div class="training-placeholder">
                                <svg style="width: 48px; height: 48px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
=======
                        @endphp
                        
                        @if($primaryImage)
                            <img src="{{ Storage::url($primaryImage->image_path) }}" 
                                 alt="{{ $training->title }}" 
                                 class="training-image">
                        @elseif($firstImage)
                            <img src="{{ Storage::url($firstImage->image_path) }}" 
                                 alt="{{ $training->title }}" 
                                 class="training-image">
                        @else
                            <div class="training-placeholder">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 48px; height: 48px;">
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        @endif
<<<<<<< HEAD

=======
                        
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
                        <div class="training-capacity-badge">
                            {{ $training->capacity }} peserta
                        </div>
                    </div>
<<<<<<< HEAD

                    <div class="training-content">
                        <h3 class="training-title">{{ $training->title }}</h3>

=======
                    
                    <div class="training-content">
                        <h3 class="training-title">{{ $training->title }}</h3>
                        
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
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
<<<<<<< HEAD

=======
                            
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
                            <div class="training-meta-item">
                                <svg class="training-meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $training->start_time }}
                                @if($training->end_time)
                                    - {{ $training->end_time }}
                                @endif
                            </div>
<<<<<<< HEAD

=======
                            
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
                            <div class="training-meta-item">
                                <svg class="training-meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                {{ $training->location }}
                            </div>
                        </div>

                        @if($training->description)
                            <p class="training-description">{{ Str::limit($training->description, 120) }}</p>
                        @endif

                        <div class="training-card-actions">
                            <a href="{{ route('trainings.show', $training->id) }}" class="training-btn training-btn-secondary training-flex-1">
<<<<<<< HEAD
                                <svg style="width: 16px; height: 16px; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
=======
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px; margin-right: 0.5rem;">
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Detail
                            </a>
<<<<<<< HEAD

=======
                            
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
                            @auth
                                @php
                                    $isRegistered = \App\Models\Registration::where('user_id', auth()->id())
                                        ->where('training_id', $training->id)
                                        ->exists();
                                @endphp
<<<<<<< HEAD

                                @if($isRegistered)
                                    <span class="training-btn training-btn-disabled training-flex-1">
                                        <svg style="width: 16px; height: 16px; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
=======
                                
                                @if($isRegistered)
                                    <span class="training-btn training-btn-disabled training-flex-1">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px; margin-right: 0.5rem;">
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Terdaftar
                                    </span>
                                @else
                                    <a href="{{ route('pelatihan.preview', $training->id) }}" class="training-btn training-btn-success training-flex-1">
<<<<<<< HEAD
                                        <svg style="width: 16px; height: 16px; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
=======
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px; margin-right: 0.5rem;">
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Daftar
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="training-btn training-btn-secondary training-flex-1">
<<<<<<< HEAD
                                    <svg style="width: 16px; height: 16px; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
=======
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px; margin-right: 0.5rem;">
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
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
            {{ $trainings->appends(['search' => $search])->links() }}
        </div>
    @else
        <div class="training-empty-state">
            <svg class="training-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="training-empty-title">Tidak ada pelatihan ditemukan</h3>
            <p class="training-empty-subtitle">
                @if($search)
                    Tidak ada pelatihan yang sesuai dengan pencarian "{{ $search }}".
                @else
                    Belum ada pelatihan yang tersedia saat ini.
                @endif
            </p>
        </div>
    @endif
</div>
<<<<<<< HEAD
=======

<script>
    $(document).ready(function() {
        // Card hover effects
        $('.training-card').hover(
            function() {
                $(this).css('animation', 'gentleFloat 2s ease-in-out infinite');
            },
            function() {
                $(this).css('animation', 'none');
            }
        );

        // Ripple effect on click
        $('.training-card, .training-btn').on('click', function(e) {
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

        // Scroll animations
        $(window).scroll(function() {
            $('.training-card, .training-search-section, .training-empty-state').each(function() {
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

    @keyframes rippleAnimation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
</script>
>>>>>>> 93361ecf6e63cd1a5456dadbfc1afbb8a38f3dda
@endsection