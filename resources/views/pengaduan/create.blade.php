@extends('layouts.appuser')

@section('title', 'Buat Pengaduan Baru - Dinas Tenaga Kerja Kota Batu')

@push('styles')
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
        --error-red: #e53e3e;
        --soft-blue: #ebf4ff;
        --glass-white: rgba(255, 255, 255, 0.95);
    }

    body {
        /* background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%); */
        min-height: 100vh;
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    .header-section {
        background: linear-gradient(135deg, 
            rgba(1, 62, 126, 0.9) 0%, 
            rgba(0, 86, 179, 0.8) 50%,
            rgba(103, 126, 234, 0.7) 100%
        );
        backdrop-filter: blur(20px);
        color: var(--text-white);
        padding: 4rem 0 3rem;
        position: relative;
        overflow: hidden;
    }

    .header-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 140, 0, 0.15) 0%, transparent 50%);
    }

    .header-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .header-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--warning-orange), #ff9500);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: 0 20px 40px rgba(255, 140, 0, 0.3);
        animation: float 3s ease-in-out infinite;
    }

    .header-icon i {
        font-size: 2rem;
        color: var(--text-white);
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .header-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        background: linear-gradient(135deg, #fff 0%, rgba(255, 255, 255, 0.8) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .header-subtitle {
        font-size: 1.3rem;
        color: var(--text-light);
        margin-bottom: 0;
        opacity: 0.9;
    }

    .form-container {
        background: var(--glass-white);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 24px;
        box-shadow: 
            0 32px 64px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(255, 255, 255, 0.1) inset;
        position: relative;
        overflow: hidden;
        margin: -3rem auto 4rem;
        max-width: 900px;
        animation: slideUp 0.8s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(60px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, 
            var(--primary-blue) 0%, 
            var(--accent-blue) 33%, 
            var(--warning-orange) 66%,
            #ff9500 100%);
        border-radius: 24px 24px 0 0;
    }

    .form-header {
        background: linear-gradient(135deg, 
            rgba(45, 55, 72, 0.95) 0%, 
            rgba(74, 85, 104, 0.9) 100%);
        backdrop-filter: blur(10px);
        color: var(--text-white);
        padding: 2rem;
        margin: 0;
        position: relative;
        overflow: hidden;
    }

    .form-header::before {
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
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    .form-header h2 {
        margin: 0;
        font-size: 1.75rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        position: relative;
        z-index: 2;
    }

    .form-header i {
        margin-right: 1rem;
        color: var(--warning-orange);
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
    }

    .form-body {
        padding: 3rem;
        background: linear-gradient(135deg, 
            rgba(255, 255, 255, 0.9) 0%, 
            rgba(248, 250, 252, 0.8) 100%);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }

    .form-group.full-width {
        grid-column: span 2;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark-steel);
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-label i {
        margin-right: 0.75rem;
        color: var(--primary-blue);
        width: 20px;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }

    .input-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 16px;
    }

    .form-control {
        border: 2px solid rgba(1, 62, 126, 0.1);
        border-radius: 16px;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        transition: var(--transition);
        background: linear-gradient(145deg, 
            rgba(255, 255, 255, 0.9) 0%, 
            rgba(248, 250, 252, 0.7) 100%);
        backdrop-filter: blur(10px);
        width: 100%;
        position: relative;
        z-index: 2;
    }

    .form-control::placeholder {
        color: var(--light-steel);
        opacity: 0.7;
    }

    .form-control:focus {
        border-color: var(--accent-blue);
        box-shadow: 
            0 0 0 4px rgba(0, 123, 255, 0.15),
            0 8px 32px rgba(0, 123, 255, 0.1);
        background: rgba(255, 255, 255, 0.95);
        outline: none;
        transform: translateY(-2px);
    }

    .form-control:hover:not(:focus) {
        border-color: var(--primary-blue);
        transform: translateY(-1px);
        box-shadow: 0 4px 20px rgba(1, 62, 126, 0.1);
    }

    .form-control.is-invalid {
        border-color: var(--error-red);
        box-shadow: 0 0 0 4px rgba(229, 62, 62, 0.15);
        animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    .invalid-feedback {
        color: var(--error-red);
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        font-weight: 500;
        background: rgba(229, 62, 62, 0.1);
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        border-left: 3px solid var(--error-red);
    }

    .invalid-feedback i {
        margin-right: 0.5rem;
        font-size: 0.875rem;
    }

    .btn-group {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        margin-top: 3rem;
        flex-wrap: wrap;
    }

    .btn-primary {
        background: linear-gradient(135deg, 
            var(--warning-orange) 0%, 
            #ff9500 50%,
            #ffb84d 100%);
        border: none;
        border-radius: 30px;
        padding: 1rem 3rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
        box-shadow: 
            0 8px 32px rgba(255, 140, 0, 0.4),
            0 0 0 1px rgba(255, 255, 255, 0.2) inset;
        color: var(--text-white);
        min-width: 200px;
        font-size: 1rem;
    }

    .btn-primary::before {
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
        transition: left 0.5s;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-4px) scale(1.05);
        box-shadow: 
            0 16px 48px rgba(255, 140, 0, 0.5),
            0 0 0 1px rgba(255, 255, 255, 0.3) inset;
        color: var(--text-white);
    }

    .btn-primary:active {
        transform: translateY(-2px) scale(1.02);
    }

    .btn-secondary {
        background: linear-gradient(135deg, 
            rgba(113, 128, 150, 0.9) 0%, 
            rgba(74, 85, 104, 0.8) 100%);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 30px;
        padding: 1rem 3rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: var(--transition);
        box-shadow: 0 8px 32px rgba(113, 128, 150, 0.3);
        color: var(--text-white);
        min-width: 200px;
        text-decoration: none;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-secondary:hover {
        transform: translateY(-4px) scale(1.05);
        box-shadow: 0 16px 48px rgba(113, 128, 150, 0.4);
        color: var(--text-white);
        text-decoration: none;
        border-color: rgba(255, 255, 255, 0.4);
    }

    .required-indicator {
        color: var(--error-red);
        margin-left: 4px;
        font-size: 1.1em;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.6; }
    }

    .btn-loading {
        position: relative;
        color: transparent !important;
        pointer-events: none;
    }

    .btn-loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 24px;
        height: 24px;
        border: 3px solid transparent;
        border-top: 3px solid currentColor;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        color: var(--text-white);
    }

    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }

    .progress-bar {
        position: fixed;
        top: 0;
        left: 0;
        height: 4px;
        background: linear-gradient(90deg, 
            var(--primary-blue), 
            var(--accent-blue), 
            var(--warning-orange));
        z-index: 9999;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    @media (max-width: 768px) {
        .header-title {
            font-size: 2.5rem;
        }
        
        .form-container {
            margin: -2rem 1rem 3rem;
        }
        
        .form-body {
            padding: 2rem;
        }
        
        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
        
        .form-group.full-width {
            grid-column: span 1;
        }
        
        .btn-group {
            flex-direction: column;
            gap: 1rem;
        }
        
        .btn-primary,
        .btn-secondary {
            width: 100%;
            min-width: auto;
        }
    }

    /* Floating particles animation */
    .particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        pointer-events: none;
    }

    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        animation: float-particles 6s infinite linear;
    }

    @keyframes float-particles {
        0% {
            transform: translateY(100vh) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            transform: translateY(-100px) rotate(360deg);
            opacity: 0;
        }
    }
</style>
@endpush

@section('content')
<div class="progress-bar" id="progressBar"></div>

<!-- Header Section -->
<div class="header-section">
    <div class="particles" id="particles"></div>
    <div class="container">
        <div class="header-content">
            <div class="header-icon">
                <i class="fas fa-edit"></i>
            </div>
            <h1 class="header-title">Buat Pengaduan Baru</h1>
            <p class="header-subtitle">Sampaikan aspirasi dan keluhan ketenagakerjaan Anda dengan mudah</p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container py-4">
    <div class="form-container">
        <div class="form-header">
            <h2>
                <i class="fas fa-clipboard-list"></i>
                Formulir Pengaduan Ketenagakerjaan
            </h2>
        </div>
        
        <div class="form-body">
            <form action="{{ route('pengaduan.store') }}" method="POST" id="pengaduanForm">
                @csrf
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="nama_lengkap" class="form-label">
                            <i class="fas fa-user"></i>
                            Nama Lengkap <span class="required-indicator">*</span>
                        </label>
                        <div class="input-wrapper">
                            <input type="text" 
                                   id="nama_lengkap" 
                                   name="nama_lengkap" 
                                   value="{{ old('nama_lengkap') }}" 
                                   class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                   required
                                   placeholder="Masukkan nama lengkap Anda">
                        </div>
                        @error('nama_lengkap')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_telp" class="form-label">
                            <i class="fas fa-phone"></i>
                            No. Telepon <span class="required-indicator">*</span>
                        </label>
                        <div class="input-wrapper">
                            <input type="text" 
                                   id="no_telp" 
                                   name="no_telp" 
                                   value="{{ old('no_telp') }}" 
                                   class="form-control @error('no_telp') is-invalid @enderror" 
                                   required
                                   placeholder="Contoh: 081234567890">
                        </div>
                        @error('no_telp')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="institusi" class="form-label">
                        <i class="fas fa-building"></i>
                        Institusi / Perusahaan <span class="required-indicator">*</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="text" 
                               id="institusi" 
                               name="institusi" 
                               value="{{ old('institusi') }}" 
                               class="form-control @error('institusi') is-invalid @enderror" 
                               required
                               placeholder="Nama perusahaan, organisasi, atau institusi tempat Anda bekerja">
                    </div>
                    @error('institusi')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group full-width">
                    <label for="alamat_institusi" class="form-label">
                        <i class="fas fa-map-marker-alt"></i>
                        Alamat Institusi <span class="required-indicator">*</span>
                    </label>
                    <div class="input-wrapper">
                        <textarea id="alamat_institusi" 
                                  name="alamat_institusi" 
                                  rows="3" 
                                  class="form-control @error('alamat_institusi') is-invalid @enderror" 
                                  required
                                  placeholder="Alamat lengkap institusi/perusahaan (Jalan, Kecamatan, Kota)">{{ old('alamat_institusi') }}</textarea>
                    </div>
                    @error('alamat_institusi')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group full-width">
                    <label for="masalah_pengaduan" class="form-label">
                        <i class="fas fa-exclamation-triangle"></i>
                        Detail Pengaduan <span class="required-indicator">*</span>
                    </label>
                    <div class="input-wrapper">
                        <textarea id="masalah_pengaduan" 
                                  name="masalah_pengaduan" 
                                  rows="6" 
                                  class="form-control @error('masalah_pengaduan') is-invalid @enderror" 
                                  required
                                  placeholder="Jelaskan secara detail masalah ketenagakerjaan yang Anda hadapi:&#10;• Kronologi kejadian&#10;• Pihak-pihak yang terlibat&#10;• Dampak yang dialami&#10;• Bukti atau dokumen pendukung yang ada">{{ old('masalah_pengaduan') }}</textarea>
                    </div>
                    @error('masalah_pengaduan')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Pengaduan
                    </button>
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Create floating particles
    function createParticles() {
        const particlesContainer = document.getElementById('particles');
        for (let i = 0; i < 50; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 6 + 's';
            particle.style.animationDuration = (Math.random() * 3 + 3) + 's';
            particlesContainer.appendChild(particle);
        }
    }
    createParticles();

    // Progress bar animation
    function updateProgressBar() {
        const form = document.getElementById('pengaduanForm');
        const inputs = form.querySelectorAll('input[required], textarea[required]');
        let filled = 0;
        
        inputs.forEach(input => {
            if (input.value.trim() !== '') filled++;
        });
        
        const progress = (filled / inputs.length) * 100;
        document.getElementById('progressBar').style.transform = `scaleX(${progress / 100})`;
    }

    // Enhanced form validation with real-time feedback
    $('.form-control').on('input blur', function() {
        updateProgressBar();
        
        const $this = $(this);
        if ($this.val().trim() === '' && $this.prop('required')) {
            $this.addClass('is-invalid');
        } else {
            $this.removeClass('is-invalid');
        }
        
        // Special validation for phone
        if ($this.attr('id') === 'no_telp') {
            const phone = $this.val().replace(/\D/g, '');
            if (phone.length < 10 || phone.length > 15) {
                $this.addClass('is-invalid');
            }
        }
    });

    // Form submission with enhanced loading
    $('#pengaduanForm').on('submit', function(e) {
        const submitBtn = $('#submitBtn');
        submitBtn.addClass('btn-loading');
        submitBtn.prop('disabled', true);
        
        // Show full progress
        $('#progressBar').css('transform', 'scaleX(1)');
        
        // Validate before submit
        let hasErrors = false;
        $('.form-control[required]').each(function() {
            if ($(this).val().trim() === '') {
                $(this).addClass('is-invalid');
                hasErrors = true;
            }
        });
        
        if (hasErrors) {
            e.preventDefault();
            submitBtn.removeClass('btn-loading');
            submitBtn.prop('disabled', false);
            
            // Scroll to first error
            $('.is-invalid').first().focus();
            return;
        }
    });

    // Auto-resize textareas with smooth animation
    $('textarea').on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    }).trigger('input');

    // Phone number formatting
    $('#no_telp').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length > 15) value = value.substr(0, 15);
        $(this).val(value);
    });

    // Enhanced hover effects for form controls
    $('.form-control').hover(
        function() {
            $(this).closest('.input-wrapper').css('transform', 'translateY(-2px)');
        },
        function() {
            if (!$(this).is(':focus')) {
                $(this).closest('.input-wrapper').css('transform', 'translateY(0)');
            }
        }
    );

    // Initial progress update
    updateProgressBar();
    
    // Smooth scroll for form focus
    $('.form-control').on('focus', function() {
        $('html, body').animate({
            scrollTop: $(this).offset().top - 100
        }, 300);
    });
});
</script>
@endsection