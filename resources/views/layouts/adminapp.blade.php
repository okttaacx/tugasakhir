<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Admin Panel') ~ Platform Pelatihan Kerja</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="icon" href="{{ asset('assets/admin.ico') }}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{ asset('assets/admin.ico') }}" type="image/x-icon"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            --sidebar-width: 280px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--metallic-silver) 0%, #f7fafc 100%);
            margin: 0;
            padding: 0;
        }

        /* Loading Screen Styles */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, 
                var(--primary-blue) 0%, 
                var(--secondary-blue) 50%, 
                var(--dark-steel) 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .loading-screen.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loading-logo {
            font-size: 3rem;
            font-weight: 800;
            color: var(--text-white);
            margin-bottom: 2rem;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            letter-spacing: 2px;
            position: relative;
        }

        .loading-logo::after {
            content: 'ADMIN';
            position: absolute;
            top: -12px;
            right: -20px;
            background: var(--warning-orange);
            color: var(--text-white);
            font-size: 0.7rem;
            padding: 4px 8px;
            border-radius: 8px;
            font-weight: 600;
        }

        .progress-container {
            width: 300px;
            height: 8px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 1rem;
            position: relative;
            backdrop-filter: blur(10px);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, 
                var(--warning-orange) 0%, 
                var(--industrial-yellow) 50%, 
                var(--warning-orange) 100%);
            border-radius: 20px;
            width: 0%;
            transition: width 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .progress-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255, 255, 255, 0.4), 
                transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .progress-text {
            color: var(--text-white);
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .progress-percentage {
            color: var(--warning-orange);
            font-size: 2rem;
            font-weight: 800;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .loading-dots {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .loading-dot {
            width: 8px;
            height: 8px;
            background: var(--warning-orange);
            border-radius: 50%;
            animation: bounce 1.4s infinite ease-in-out;
        }

        .loading-dot:nth-child(1) { animation-delay: -0.32s; }
        .loading-dot:nth-child(2) { animation-delay: -0.16s; }

        @keyframes bounce {
            0%, 80%, 100% {
                transform: scale(0);
            }
            40% {
                transform: scale(1);
            }
        }

        .loading-status {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            margin-top: 1rem;
            text-align: center;
            min-height: 20px;
        }

        /* Enhanced Navbar */
        .navbar {
            background: linear-gradient(135deg, 
                var(--primary-blue) 0%, 
                var(--secondary-blue) 50%, 
                var(--dark-steel) 100%);
            backdrop-filter: blur(20px);
            border-bottom: 3px solid var(--warning-orange);
            box-shadow: 
                0 8px 32px rgba(1, 62, 126, 0.15),
                0 4px 16px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050;
            height: 70px;
            padding: 0;
        }

        .navbar::before {
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

        .toggle-btn {
            background: linear-gradient(145deg, 
                rgba(255, 255, 255, 0.1) 0%, 
                rgba(255, 255, 255, 0.05) 100%);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: var(--text-white);
            padding: 12px 16px;
            cursor: pointer;
            transition: var(--transition);
            margin-left: 1rem;
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .toggle-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .toggle-btn:hover::before {
            left: 100%;
        }

        .toggle-btn:hover {
            background: linear-gradient(145deg, 
                rgba(255, 140, 0, 0.2) 0%, 
                rgba(255, 140, 0, 0.1) 100%);
            transform: scale(1.05);
            border-color: var(--warning-orange);
        }

        .navbar-brand {
            color: var(--text-white) !important;
            font-weight: 800;
            font-size: 1.8rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: 1px;
            text-decoration: none;
            position: relative;
        }

        .navbar-brand::after {
            content: 'ADMIN';
            position: absolute;
            top: 1.5px;
            right: -1px;
            background: var(--warning-orange);
            color: var(--text-white);
            font-size: 0.6rem;
            padding: 2px 6px;
            border-radius: 8px;
            font-weight: 600;
            z-index: 1;
        }

        .profile-icon {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-right: 1.5rem;
        }

        .profile-icon img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 3px solid var(--warning-orange);
            object-fit: cover;
            transition: var(--transition);
            cursor: pointer;
        }

        .profile-icon img:hover {
            transform: scale(1.1);
            border-color: var(--text-white);
            box-shadow: 0 4px 16px rgba(255, 140, 0, 0.4);
        }

        .profile-icon .dropdown-toggle {
            color: var(--text-white);
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .profile-icon .dropdown-toggle:hover {
            color: var(--warning-orange);
        }

        .dropdown-menu {
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            padding: 0.5rem 0;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            padding: 0.75rem 1.5rem;
            color: var(--dark-steel);
            transition: var(--transition);
            border-radius: 0;
        }

        .dropdown-item:hover {
            background: linear-gradient(90deg, var(--warning-orange), rgba(255, 140, 0, 0.8));
            color: var(--text-white);
            transform: translateX(4px);
        }

        .dropdown-divider {
            border-color: rgba(1, 62, 126, 0.1);
            margin: 0.5rem 0;
        }

        /* Enhanced Sidebar */
        .sidebar {
            position: fixed;
            top: 70px;
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - 70px);
            background: linear-gradient(180deg, 
                var(--carbon-black) 0%, 
                var(--dark-steel) 50%, 
                var(--steel-gray) 100%);
            padding: 2rem 0;
            transition: var(--transition);
            z-index: 1040;
            overflow-y: auto;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(
                180deg,
                transparent,
                transparent 50px,
                rgba(255, 140, 0, 0.03) 50px,
                rgba(255, 140, 0, 0.03) 52px
            );
            pointer-events: none;
        }

        .sidebar.collapsed {
            margin-left: calc(-1 * var(--sidebar-width));
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: var(--text-light);
            padding: 1rem 2rem;
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            border-left: 4px solid transparent;
            margin: 0.25rem 0;
        }

        .sidebar a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, var(--warning-orange), rgba(255, 140, 0, 0.3));
            transition: var(--transition);
            z-index: -1;
        }

        .sidebar a:hover::before {
            width: 100%;
        }

        .sidebar a:hover {
            color: var(--text-white);
            border-left-color: var(--warning-orange);
            transform: translateX(8px);
        }

        .sidebar a i {
            width: 24px;
            margin-right: 1rem;
            font-size: 1.2rem;
            text-align: center;
        }

        .sidebar a span {
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        /* Enhanced Dropdown in Sidebar */
        .sidebar .dropdown {
            position: relative;
        }

        .sidebar .dropdown-toggle {
            justify-content: space-between;
            cursor: pointer;
        }

        .sidebar .dropdown-icon {
            transition: var(--transition);
        }

        .sidebar .dropdown.show .dropdown-icon {
            transform: rotate(180deg);
        }

        .sidebar .dropdown-menu {
            position: static;
            display: none;
            background: rgba(0, 0, 0, 0.2);
            border: none;
            border-radius: 0;
            box-shadow: none;
            margin: 0;
            padding: 0;
        }

        .sidebar .dropdown.show .dropdown-menu {
            display: block;
        }

        .sidebar .dropdown-item {
            color: rgba(255, 255, 255, 0.7);
            padding: 0.75rem 3rem;
            border-radius: 0;
        }

        .sidebar .dropdown-item:hover {
            background: rgba(255, 140, 0, 0.2);
            color: var(--text-white);
        }

        /* Content Area */
        .content {
            margin-left: var(--sidebar-width);
            margin-top: 70px;
            padding: 2rem;
            min-height: calc(100vh - 70px);
            transition: var(--transition);
            position: relative;
        }

        .content.expanded {
            margin-left: 0;
        }

        .content::before {
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

        /* Responsive Design */
        @media (max-width: 768px) {
            :root {
                --sidebar-width: 100%;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
            }

            .navbar-brand {
                font-size: 1.4rem;
            }

            .profile-icon {
                margin-right: 1rem;
            }

            .toggle-btn {
                margin-left: 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .navbar-brand {
                display: none;
            }

            .profile-icon span {
                display: none;
            }

            .loading-logo {
                font-size: 2rem;
            }

            .progress-container {
                width: 250px;
            }
        }

        /* Animation Keyframes */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .sidebar a {
            animation: slideIn 0.6s ease-out;
        }

        .sidebar a:nth-child(1) { animation-delay: 0.1s; }
        .sidebar a:nth-child(2) { animation-delay: 0.2s; }
        .sidebar a:nth-child(3) { animation-delay: 0.3s; }
        .sidebar a:nth-child(4) { animation-delay: 0.4s; }
        .sidebar a:nth-child(5) { animation-delay: 0.5s; }

        /* Loading Animation for Content */
        .content {
            animation: fadeIn 0.8s ease-out;
        }

        /* Custom Scrollbar for Sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--warning-orange);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 140, 0, 0.8);
        }
    </style>
</head>

<body>
    <!-- Loading Screen -->
    <div class="loading-screen" id="loadingScreen">
        <div class="loading-logo"><img src="{{ asset('image\LOGO_SIJOKER-removebg-preview.png') }}" style="width: 19rem;"/></div>
        <div class="progress-text">Memuat Panel Admin...</div>
        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>
        <div class="progress-percentage" id="progressPercentage">0%</div>
        <div class="loading-dots">
            <div class="loading-dot"></div>
            <div class="loading-dot"></div>
            <div class="loading-dot"></div>
        </div>
        <div class="loading-status" id="loadingStatus">Menginisialisasi sistem...</div>
    </div>

    <!-- Enhanced Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="d-flex align-items-center w-100">
            <span class="toggle-btn" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </span>
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('image\LOGO_SIJOKER-removebg-preview.png') }}" style="width: 9rem;"/></a>
            
            <div class="profile-icon dropdown ms-auto">
                <img src="{{ Auth::user()->profile && Auth::user()->profile->foto ? asset('storage/' . Auth::user()->profile->foto) : asset('image/default_profile.jpg') }}" 
                     alt="Profile Image" 
                     class="dropdown-toggle" 
                     data-bs-toggle="dropdown">
                <span class="dropdown-toggle" data-bs-toggle="dropdown">
                    {{ Auth::user()->profile->name }}
                </span>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                            <i class="fas fa-user me-2"></i> Profil
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cog me-2"></i> Pengaturan
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Enhanced Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="{{ route('admin.dashboard') }}">
            <i class="fas fa-home"></i> 
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.participant.index') }}">
            <i class="fas fa-users"></i> 
            <span>Peserta</span>
        </a>
        <a href="{{ route('admin.documents.index') }}">
            <i class="fas fa-file-text"></i> 
            <span>Dokumen</span>
        </a>
        <a href="{{ route('admin.trainings.index') }}">
            <i class="fas fa-chalkboard-teacher"></i> 
            <span>Pelatihan</span>
        </a>
        <a href="{{ route('admin.account_participants') }}">
            <i class="fas fa-user-cog"></i> 
            <span>Akun</span>
        </a>
        <a href="{{ route('admin.pelaporan') }}">
            <i class="fas fa-bullhorn"></i> 
            <span>Pelaporan</span>
        </a>
        
        <!-- Enhanced Dropdown Pengaduan -->
        <!-- Single Button Pengaduan -->
<div class="single-menu">
    <a href="{{ route('admin.pengaduan.index') }}" class="complaint-menu">
        <div style="display: flex; align-items: center;">
            <i class="fas fa-comments"></i> 
            <span>Pengaduan</span>
        </div>
    </a>
</div>

        <a href="{{ url('/admin/visit-stats') }}">
            <i class="fas fa-chart-line"></i> 
            <span>Kunjungan Harian</span>
        </a>
        <a href="{{ route('admin.news.index') }}">
            <i class="fas fa-newspaper"></i>
            <span>Berita</span>
        </a>
        <a href="{{ route('admin.survey.index') }}">
            <i class="fas fa-poll"></i>
            <span>Survey</span>
        </a>
        <a href="{{ route('admin.lokers.index') }}">
            <i class="fas fa-briefcase"></i>
            <span>Lowongan Kerja</span>
        </a>
    </div>

    <!-- Content Area -->
    <div class="content" id="content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    
    <script>
        // Loading Screen Management
        document.addEventListener('DOMContentLoaded', function() {
            const loadingScreen = document.getElementById('loadingScreen');
            const progressBar = document.getElementById('progressBar');
            const progressPercentage = document.getElementById('progressPercentage');
            const loadingStatus = document.getElementById('loadingStatus');
            
            const loadingSteps = [
                { progress: 10, status: 'Menginisialisasi sistem...' },
                { progress: 25, status: 'Memuat konfigurasi...' },
                { progress: 40, status: 'Menghubungkan ke database...' },
                { progress: 55, status: 'Memuat data pengguna...' },
                { progress: 70, status: 'Memuat komponen UI...' },
                { progress: 85, status: 'Menerapkan pengaturan...' },
                { progress: 100, status: 'Selesai! Membuka panel admin...' }
            ];
            
            let currentStep = 0;
            
            function updateProgress() {
                if (currentStep < loadingSteps.length) {
                    const step = loadingSteps[currentStep];
                    progressBar.style.width = step.progress + '%';
                    progressPercentage.textContent = step.progress + '%';
                    loadingStatus.textContent = step.status;
                    currentStep++;
                    
                    // Variable timing for more realistic loading
                    const delay = currentStep === loadingSteps.length ? 500 : Math.random() * 400 + 200;
                    setTimeout(updateProgress, delay);
                } else {
                    // Hide loading screen after completion
                    setTimeout(() => {
                        loadingScreen.classList.add('hidden');
                        setTimeout(() => {
                            loadingScreen.style.display = 'none';
                        }, 500);
                    }, 300);
                }
            }
            
            // Start loading animation
            setTimeout(updateProgress, 300);
        });

        // Enhanced Toggle Sidebar Function
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
                content.classList.toggle('expanded');
            }
        }

        // Enhanced Dropdown Toggle
        function toggleDropdown(element) {
            const dropdown = element.closest('.dropdown');
            dropdown.classList.toggle('show');
            
            // Close other dropdowns
            document.querySelectorAll('.sidebar .dropdown').forEach(function(drop) {
                if (drop !== dropdown) {
                    drop.classList.remove('show');
                }
            });
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.sidebar .dropdown')) {
                document.querySelectorAll('.sidebar .dropdown').forEach(function(dropdown) {
                    dropdown.classList.remove('show');
                });
            }
        });

        // Responsive sidebar handling
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
                if (sidebar.classList.contains('collapsed')) {
                    content.classList.add('expanded');
                } else {
                    content.classList.remove('expanded');
                }
            } else {
                sidebar.classList.remove('collapsed');
                content.classList.remove('expanded');
            }
        });

        // Auto-close mobile sidebar when clicking on a link
        document.querySelectorAll('.sidebar a:not(.dropdown-toggle)').forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    document.getElementById('sidebar').classList.remove('show');
                }
            });
        });

        // Add active state management
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const sidebarLinks = document.querySelectorAll('.sidebar a[href]');
            
            sidebarLinks.forEach(function(link) {
                const href = link.getAttribute('href');
                if (currentPath.includes(href) && href !== '#') {
                    link.style.borderLeftColor = 'var(--warning-orange)';
                    link.style.backgroundColor = 'rgba(255, 140, 0, 0.1)';
                    link.style.color = 'var(--text-white)';
                }
            });
        });

        console.log('Industrial Admin Layout with Loading Screen Loaded');
    </script>

    @stack('scripts')
</body>
</html>