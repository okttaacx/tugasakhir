<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Dinas Tenaga Kerja Kota Batu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            background: 
                linear-gradient(135deg, 
                    rgba(1, 62, 126, 0.9) 0%, 
                    rgba(0, 86, 179, 0.8) 25%, 
                    rgba(0, 123, 255, 0.7) 50%,
                    rgba(255, 140, 0, 0.8) 75%,
                    rgba(45, 55, 72, 0.9) 100%
                ),
                repeating-linear-gradient(
                    45deg,
                    transparent,
                    transparent 2px,
                    rgba(255, 255, 255, 0.02) 2px,
                    rgba(255, 255, 255, 0.02) 4px
                );
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 20%, rgba(255, 140, 0, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(1, 62, 126, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 60%, rgba(0, 123, 255, 0.05) 0%, transparent 50%);
            animation: backgroundPulse 8s ease-in-out infinite alternate;
            pointer-events: none;
            z-index: -1;
        }

        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 100px,
                    rgba(255, 255, 255, 0.01) 100px,
                    rgba(255, 255, 255, 0.01) 200px
                ),
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    transparent 150px,
                    rgba(1, 62, 126, 0.02) 150px,
                    rgba(1, 62, 126, 0.02) 300px
                );
            pointer-events: none;
            z-index: -1;
        }

        @keyframes backgroundPulse {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 1; }
        }

        @keyframes industrialFloat {
            0%, 100% { transform: translateY(0px) rotateX(0deg); }
            50% { transform: translateY(-10px) rotateX(2deg); }
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            padding: 2rem 0;
        }

        .register-wrapper {
            max-width: 1000px;
            width: 95%;
            position: relative;
        }

        .card {
            border: none;
            border-radius: 24px;
            overflow: hidden;
            background: 
                linear-gradient(145deg, 
                    rgba(255, 255, 255, 0.95) 0%, 
                    rgba(248, 250, 252, 0.9) 100%);
            box-shadow: 
                0 25px 80px rgba(0, 0, 0, 0.15),
                0 12px 40px rgba(1, 62, 126, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            position: relative;
            animation: industrialFloat 6s ease-in-out infinite;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, 
                var(--primary-blue) 0%, 
                var(--accent-blue) 25%, 
                var(--warning-orange) 50%, 
                var(--success-green) 75%,
                var(--primary-blue) 100%);
            border-radius: 24px 24px 0 0;
            animation: shimmer 3s linear infinite;
            background-size: 200% 100%;
        }

        .left-panel {
            background: 
                linear-gradient(135deg, 
                    rgba(1, 62, 126, 0.95) 0%, 
                    rgba(0, 86, 179, 0.9) 30%, 
                    rgba(0, 123, 255, 0.85) 70%,
                    rgba(255, 140, 0, 0.9) 100%
                );
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 2rem;
            position: relative;
            min-height: 600px;
            height: 100%;
        }

        .left-panel::before {
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
                    transparent 3px,
                    rgba(255, 255, 255, 0.05) 3px,
                    rgba(255, 255, 255, 0.05) 6px
                );
            z-index: 1;
        }

        .left-panel::after {
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

        .left-content {
            position: relative;
            z-index: 3;
            text-align: center;
        }

        .logo-section {
            margin-bottom: 3rem;
        }

        .logo-container {
            display: inline-flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .logo-container img {
            height: 120px;
            filter: drop-shadow(0 8px 20px rgba(0, 0, 0, 0.3));
            transition: var(--transition);
        }

        .logo-container img:hover {
            transform: scale(1.1) rotateY(10deg);
            filter: drop-shadow(0 12px 30px rgba(0, 0, 0, 0.4));
        }

        .welcome-title {
            font-size: 2.5rem;
            color: var(--text-white);
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 
                0 4px 8px rgba(0, 0, 0, 0.5),
                0 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: -0.5px;
        }

        .welcome-subtitle {
            color: var(--text-light);
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .features-list {
            text-align: left;
            max-width: 300px;
            margin: 0 auto;
        }

        .feature-item {
            display: flex;
            align-items: center;
            color: var(--text-light);
            margin-bottom: 1rem;
            font-size: 0.95rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .feature-icon {
            color: var(--warning-orange);
            margin-right: 1rem;
            font-size: 1.2rem;
            filter: drop-shadow(0 2px 4px rgba(255, 140, 0, 0.5));
        }

        .right-panel {
            padding: 2.5rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 600px;
            position: relative;
        }

        .right-panel::before {
            content: '';
            position: absolute;
            top: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, var(--warning-orange), var(--primary-blue));
            clip-path: polygon(0 0, 100% 0, 100% 100%);
            opacity: 0.1;
        }

        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .register-title {
            color: var(--dark-steel);
            font-weight: 800;
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .register-subtitle {
            color: var(--light-steel);
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-steel);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            border: 2px solid rgba(1, 62, 126, 0.1);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: var(--transition);
            background: 
                linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            box-shadow: 
                inset 0 2px 4px rgba(0, 0, 0, 0.05),
                0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            border-color: var(--warning-orange);
            box-shadow: 
                0 0 0 0.2rem rgba(255, 140, 0, 0.2),
                inset 0 2px 4px rgba(0, 0, 0, 0.05),
                0 4px 12px rgba(255, 140, 0, 0.1);
            outline: none;
            background: #ffffff;
        }

        .input-group-text {
            background: 
                linear-gradient(145deg, #f8fafc 0%, #e2e8f0 100%);
            border: 2px solid rgba(1, 62, 126, 0.1);
            border-left: none;
            border-radius: 0 12px 12px 0;
            cursor: pointer;
            transition: var(--transition);
            color: var(--light-steel);
        }

        .input-group-text:hover {
            background: 
                linear-gradient(145deg, #e2e8f0 0%, #cbd5e0 100%);
            color: var(--primary-blue);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
            transition: var(--transition);
            box-shadow: 
                0 6px 20px rgba(1, 62, 126, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 10px 30px rgba(1, 62, 126, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        .divider {
            border: none;
            height: 2px;
            background: linear-gradient(90deg, 
                transparent 0%, 
                var(--primary-blue) 20%, 
                var(--warning-orange) 50%, 
                var(--primary-blue) 80%, 
                transparent 100%);
            margin: 1.5rem 0;
            border-radius: 1px;
            position: relative;
        }

        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 12px;
            height: 12px;
            background: linear-gradient(45deg, var(--primary-blue), var(--warning-orange));
            transform: translate(-50%, -50%) rotate(45deg);
            border-radius: 2px;
        }

        .text-links {
            text-align: center;
        }

        .text-primary {
            color: var(--warning-orange) !important;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            position: relative;
        }

        .text-primary::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--primary-blue);
            transition: var(--transition);
            transform: translateX(-50%);
        }

        .text-primary:hover {
            color: var(--primary-blue) !important;
            transform: translateY(-1px);
        }

        .text-primary:hover::after {
            width: 100%;
        }

        .text-danger {
            color: #dc2626 !important;
            font-size: 0.85rem;
            font-weight: 500;
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
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 140, 0, 0.1);
            border-radius: 50%;
            pointer-events: none;
            animation: float 20s infinite linear;
        }

        .particle:nth-child(1) { width: 4px; height: 4px; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 6px; height: 6px; left: 20%; animation-delay: 2s; }
        .particle:nth-child(3) { width: 3px; height: 3px; left: 30%; animation-delay: 4s; }
        .particle:nth-child(4) { width: 5px; height: 5px; left: 40%; animation-delay: 6s; }
        .particle:nth-child(5) { width: 4px; height: 4px; left: 50%; animation-delay: 8s; }
        .particle:nth-child(6) { width: 6px; height: 6px; left: 60%; animation-delay: 10s; }
        .particle:nth-child(7) { width: 3px; height: 3px; left: 70%; animation-delay: 12s; }
        .particle:nth-child(8) { width: 5px; height: 5px; left: 80%; animation-delay: 14s; }
        .particle:nth-child(9) { width: 4px; height: 4px; left: 90%; animation-delay: 16s; }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            .card {
                border-radius: 20px;
            }
            
            .left-panel, .right-panel {
                padding: 2rem 1.5rem;
                min-height: auto;
            }
            
            .logo-container {
                gap: 1rem;
                flex-direction: column;
            }
            
            .logo-container img {
                height: 80px;
            }
            
            .welcome-title {
                font-size: 1.8rem;
            }
            
            .register-title {
                font-size: 1.8rem;
            }
            
            .features-list {
                max-width: 100%;
            }
        }

        @media (max-width: 992px) {
            .left-panel {
                display: none;
            }
        }

        /* Ripple effect */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
            width: 20px;
            height: 20px;
            margin-left: -10px;
            margin-top: -10px;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Additional hover effects */
        .form-control:hover {
            border-color: rgba(255, 140, 0, 0.3);
            box-shadow: 0 2px 8px rgba(255, 140, 0, 0.1);
        }

        .text-primary:hover {
            text-shadow: 0 2px 4px rgba(1, 62, 126, 0.2);
        }

        /* Loading spinner for form submission */
        .fa-spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Floating particles -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="container">
        <div class="register-wrapper">
            <div class="card">
                <div class="row g-0">
                    <!-- Left Panel - Industrial Welcome Section -->
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="left-panel">
                            <div class="left-content">
                                <div class="logo-section">
                                    <div class="logo-container">
                                        <img src="{{ asset('image/logo_batu.png') }}" alt="Logo Kota Batu">
                                        <img src="{{ asset('image/logo.png') }}" alt="Logo Disnaker" style="border-radius: 50%;">
                                    </div>
                                    <h1 class="welcome-title">Bergabung Sekarang</h1>
                                    <p class="welcome-subtitle">
                                        Daftarkan diri Anda untuk mengakses<br>
                                        Program Pelatihan Tenaga Kerja Terbaik
                                    </p>
                                </div>
                                
                                <div class="features-list">
                                    <div class="feature-item">
                                        <i class="fas fa-user-plus feature-icon"></i>
                                        <span>Pendaftaran Mudah & Cepat</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-graduation-cap feature-icon"></i>
                                        <span>Akses ke Semua Program</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-chart-line feature-icon"></i>
                                        <span>Monitor Progres Belajar</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-certificate feature-icon"></i>
                                        <span>Sertifikat Terakreditasi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Panel - Registration Form -->
                    <div class="col-lg-6">
                        <div class="right-panel">
                            <div class="register-header">
                                <h2 class="register-title">Buat Akun Baru</h2>
                                <p class="register-subtitle">Silakan isi formulir di bawah ini untuk mendaftar</p>
                            </div>
                            
                            <form id="registerForm" method="POST" action="{{ route('register') }}">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user me-2"></i>Nama Lengkap
                                    </label>
                                    <input type="text" 
                                           name="name" 
                                           class="form-control" 
                                           id="name" 
                                           required 
                                           placeholder="Masukkan nama lengkap Anda">
                                </div>
                                
                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-2"></i>Alamat Email
                                    </label>
                                    <input type="email" 
                                           name="email" 
                                           class="form-control" 
                                           id="email" 
                                           required 
                                           placeholder="Masukkan alamat email Anda">
                                </div>
                                
                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-2"></i>Kata Sandi
                                    </label>
                                    <div class="input-group">
                                        <input type="password" 
                                               name="password" 
                                               class="form-control" 
                                               id="password" 
                                               required 
                                               placeholder="Buat kata sandi Anda" 
                                               onkeyup="validatePassword()">
                                        <span class="input-group-text" onclick="togglePassword('password', 'togglePasswordIcon')">
                                            <i id="togglePasswordIcon" class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                    <div id="passwordWarning" class="text-danger mt-2" style="display: none;">
                                        Kata sandi harus lebih dari 8 karakter.
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">
                                        <i class="fas fa-lock me-2"></i>Konfirmasi Kata Sandi
                                    </label>
                                    <div class="input-group">
                                        <input type="password" 
                                               name="password_confirmation" 
                                               class="form-control" 
                                               id="password_confirmation" 
                                               required 
                                               placeholder="Konfirmasi kata sandi Anda" 
                                               onkeyup="validatePasswordMatch()">
                                        <span class="input-group-text" onclick="togglePassword('password_confirmation', 'toggleConfirmIcon')">
                                            <i id="toggleConfirmIcon" class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                    <div id="passwordMismatchWarning" class="text-danger mt-2" style="display: none;">
                                        Konfirmasi kata sandi tidak sesuai.
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary w-100 mb-3">
                                    <i class="fas fa-user-plus me-2"></i>Daftar
                                </button>
                            </form>
                            
                            <div class="divider"></div>
                            
                            <div class="text-links">
                                <p class="mb-3">Sudah punya akun? 
                                    <a href="{{ route('login') }}" class="text-primary">
                                        <i class="fas fa-sign-in-alt me-1"></i>Masuk
                                    </a>
                                </p>
                                <p class="mb-0">
                                    <a href="{{ url('/') }}" class="text-primary">
                                        <i class="fas fa-home me-1"></i>Kembali ke Beranda
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Password toggle functionality
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        function validatePassword() {
            const password = document.getElementById("password").value;
            const warning = document.getElementById("passwordWarning");
        
            if (password.length < 8) {
                warning.style.display = "block";
            } else {
                warning.style.display = "none";
            }
        }
    
        function validatePasswordMatch() {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("password_confirmation").value;
            const warning = document.getElementById("passwordMismatchWarning");
        
            if (confirmPassword && password !== confirmPassword) {
                warning.style.display = "block";
            } else {
                warning.style.display = "none";
            }
        }

        // Enhanced form validation and submission
        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                const name = $('#name').val();
                const email = $('#email').val();
                const password = $('#password').val();
                const passwordConfirmation = $('#password_confirmation').val();
                const passwordWarning = document.getElementById('passwordWarning');
                const passwordMismatchWarning = document.getElementById('passwordMismatchWarning');
                
                let valid = true;

                // Basic client-side validation
                if (!name || !email || !password || !passwordConfirmation) {
                    alert('Mohon lengkapi semua field yang diperlukan.');
                    return false;
                }

                if (!isValidEmail(email)) {
                    alert('Format email tidak valid.');
                    return false;
                }

                if (password.length < 8) {
                    passwordWarning.style.display = 'block';
                    valid = false;
                } else {
                    passwordWarning.style.display = 'none';
                }

                if (password !== passwordConfirmation) {
                    passwordMismatchWarning.style.display = 'block';
                    valid = false;
                } else {
                    passwordMismatchWarning.style.display = 'none';
                }

                if (!valid) {
                    e.preventDefault();
                    return false;
                }
                
                // Show loading state
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Memproses...');
                submitBtn.prop('disabled', true);
                
                // Reset after 5 seconds if no redirect happens
                setTimeout(function() {
                    submitBtn.html(originalText);
                    submitBtn.prop('disabled', false);
                }, 5000);
            });

            // Input focus effects
            $('.form-control').on('focus', function() {
                $(this).parent().find('.form-label').addClass('text-primary');
            });

            $('.form-control').on('blur', function() {
                $(this).parent().find('.form-label').removeClass('text-primary');
            });

            // Real-time validation feedback
            $('#email').on('input', function() {
                const email = $(this).val();
                if (email && !isValidEmail(email)) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            $('#name').on('input', function() {
                const name = $(this).val();
                if (name && name.length < 2) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // Button hover effects
            $('.btn-primary').hover(
                function() {
                    $(this).find('i').addClass('fa-pulse');
                },
                function() {
                    $(this).find('i').removeClass('fa-pulse');
                }
            );

            // Logo hover animation
            $('.logo-container img').hover(
                function() {
                    $(this).css('animation', 'industrialFloat 2s ease-in-out infinite');
                },
                function() {
                    $(this).css('animation', 'industrialFloat 6s ease-in-out infinite');
                }
            );
        });

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Alt + H to go home
            if (e.altKey && e.key === 'h') {
                window.location.href = '/';
            }
            // Alt + L to go to login
            if (e.altKey && e.key === 'l') {
                window.location.href = '/login';
            }
            // Enter to submit form when focused on inputs
            if (e.key === 'Enter' && (e.target.id === 'name' || e.target.id === 'email' || e.target.id === 'password' || e.target.id === 'password_confirmation')) {
                e.preventDefault();
                $('#registerForm').submit();
            }
        });

        // Add ripple effect to buttons
        $('.btn-primary').on('click', function(e) {
            const $this = $(this);
            const offset = $this.offset();
            const x = e.pageX - offset.left;
            const y = e.pageY - offset.top;
            
            const $ripple = $('<span class="ripple"></span>');
            $ripple.css({
                left: x,
                top: y
            });
            
            $this.append($ripple);
            
            setTimeout(() => {
                $ripple.remove();
            }, 600);
        });

        // Form field animation on load
        $(window).on('load', function() {
            $('.form-control').each(function(index) {
                $(this).css({
                    'opacity': '0',
                    'transform': 'translateY(20px)'
                }).delay(index * 100).animate({
                    'opacity': '1'
                }, {
                    duration: 500,
                    step: function(now) {
                        $(this).css('transform', 'translateY(' + (20 * (1 - now)) + 'px)');
                    }
                });
            });
        });

        // Form submission handling from original code
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            const passwordWarning = document.getElementById('passwordWarning');
            const passwordMismatchWarning = document.getElementById('passwordMismatchWarning');
            
            let valid = true;

            if (password.length < 8) {
                passwordWarning.style.display = 'block';
                valid = false;
            } else {
                passwordWarning.style.display = 'none';
            }

            if (password !== passwordConfirmation) {
                passwordMismatchWarning.style.display = 'block';
                valid = false;
            } else {
                passwordMismatchWarning.style.display = 'none';
            }

            if (!valid) {
                event.preventDefault(); // Prevent form submission
            }
        });

        console.log('Industrial Registration Page Loaded');
    </script>
</body>
</html>