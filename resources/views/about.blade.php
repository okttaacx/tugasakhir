@extends('layouts.appuser')

@section('title', 'Dinas Tenaga Kerja Kota Batu - Pelatihan Tenaga Kerja')

@push('styles')
    <!-- Custom CSS -->
    <style>
        .bg-gradient-primary {
            background-color: #FFFFFF; /* Mengubah latar belakang menjadi putih */
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }
        .hover-zoom img {
            transition: transform 0.4s ease;
            border-radius: 12px;
        }
        .hover-zoom:hover img {
            transform: scale(1.05);
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-slide-up {
            animation: slideUp 0.8s ease-out;
        }
        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .btn-primary {
            background-color: #2575FC;
            border: none;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            border-radius: 50px;
        }
        .btn-primary:hover {
            background-color: #6A11CB;
            box-shadow: 0 8px 15px rgba(106, 17, 203, 0.3);
        }

        /* Enhanced Counter - Statistics */
        .counter-section .col-md-4 {
            margin-bottom: 30px;
        }

        .counter-card {
            background: white;
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            cursor: pointer;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Efek hover yang subtle - tidak ubah warna */
        .counter-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        /* Shimmer effect tanpa ubah warna dasar */
        .counter-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s;
        }

        .counter-card:hover::before {
            left: 100%;
        }

        /* Counter number effects */
        .counter {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2575FC;
            transition: all 0.4s ease;
        }

        .counter-card:hover .counter {
            transform: scale(1.05);
        }

        /* Enhanced Feature Cards - sama seperti counter cards */
        .feature-section .col-lg-4 {
            margin-bottom: 30px;
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 40px 25px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            cursor: pointer;
            border: 1px solid rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        /* Efek hover yang sama dengan counter */
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        /* Shimmer effect */
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s;
        }

        .feature-card:hover::before {
            left: 100%;
        }

        /* Feature icon effects */
        .feature-card .feature-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
            color: #1a73e8;
            transition: all 0.4s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1);
            color: #2575FC;
        }

        /* Feature title effects */
        .feature-card h4 {
            transition: all 0.4s ease;
        }

        .feature-card:hover h4 {
            transform: scale(1.05);
            color: #2575FC;
        }

        /* Feature text effects */
        .feature-card p {
            transition: all 0.4s ease;
        }

        .feature-card:hover p {
            color: #333;
        }

        /* Enhanced Visi Misi Cards */
        .visi-misi-card {
            background: white;
            border-radius: 15px;
            padding: 40px 25px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            cursor: pointer;
            border: 1px solid rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .visi-misi-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .visi-misi-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s;
        }

        .visi-misi-card:hover::before {
            left: 100%;
        }

        .visi-misi-card .fas {
            transition: all 0.4s ease;
        }

        .visi-misi-card:hover .fas {
            transform: scale(1.1);
            color: #2575FC;
        }

        .visi-misi-card h3 {
            transition: all 0.4s ease;
        }

        .visi-misi-card:hover h3 {
            color: #2575FC;
        }

        /* Ripple effect */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(37, 117, 252, 0.3);
            transform: scale(0);
            animation: rippleAnimation 0.6s linear;
            pointer-events: none;
        }

        @keyframes rippleAnimation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Feature ripple effect */
        .feature-ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(26, 115, 232, 0.3);
            transform: scale(0);
            animation: featureRippleAnimation 0.6s linear;
            pointer-events: none;
        }

        @keyframes featureRippleAnimation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Visi Misi ripple effect */
        .vm-ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(26, 115, 232, 0.3);
            transform: scale(0);
            animation: vmRippleAnimation 0.6s linear;
            pointer-events: none;
        }

        @keyframes vmRippleAnimation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Floating effects yang subtle */
        @keyframes gentleFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        @keyframes gentlePulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }

        .counter-card.gentle-float { 
            animation: gentleFloat 4s ease-in-out infinite; 
        }

        .counter-card.gentle-pulse { 
            animation: gentlePulse 3s infinite; 
        }

        .feature-card.feature-float { 
            animation: gentleFloat 4s ease-in-out infinite; 
        }

        .feature-card.feature-pulse { 
            animation: gentlePulse 3s infinite; 
        }

        .visi-misi-card.vm-float { 
            animation: gentleFloat 5s ease-in-out infinite; 
        }

        .visi-misi-card.vm-pulse { 
            animation: gentlePulse 4s infinite; 
        }

        /* Responsive */
        @media (max-width: 768px) {
            .counter-card {
                padding: 25px 15px;
            }
            
            .feature-card {
                padding: 30px 20px;
            }
            
            .visi-misi-card {
                padding: 30px 20px;
            }
            
            .feature-card .feature-icon {
                font-size: 3rem;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Header Start -->
    <div class="bg-gradient-primary py-5" style="background: linear-gradient(135deg, #1a73e8, #4285f4);">
        <div class="container text-center py-5">
            <h1 class="text-white font-weight-bold mb-3 animate__animated animate__fadeInDown">Pelatihan Tenaga Kerja</h1>
            <h1 class="text-white mb-3 animate__animated animate__fadeInUp">Tentang Dinas Tenaga Kerja Kota Batu</h1>
            <p class="text-white-50 animate__animated animate__fadeInUp">Meningkatkan keterampilan dan daya saing tenaga kerja lokal melalui pelatihan berkualitas</p>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('image/logo.png') }}" alt="Logo Disnaker" style="border-radius: 50%; width: 60%; height: auto;">
            </div>
            <div class="col-lg-6">
                <h2 class="font-weight-bold mb-4" style="font-family: 'Poppins', sans-serif;">Tentang Kami</h2>
                <p class="text-muted">
                    Dinas Tenaga Kerja Kota Batu berkomitmen untuk meningkatkan kualitas dan keterampilan tenaga kerja melalui program pelatihan gratis yang inovatif. Kami membantu menciptakan tenaga kerja yang siap bersaing di tingkat nasional dan internasional, menjembatani kesenjangan antara pendidikan dan dunia kerja.
                </p>
                <p class="text-muted">
                    Melalui kolaborasi dengan berbagai mitra industri, kami memastikan program pelatihan kami selalu sesuai dengan kebutuhan pasar kerja yang dinamis.
                </p>
                <div class="row mt-4 counter-section">
                    <div class="col-md-4 mb-3">
                        <div class="counter-card">
                            <h4 class="font-weight-bold text-primary display-4 counter" data-count="10">0</h4>
                            <p class="text-muted">Program Pelatihan</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="counter-card">
                            <h4 class="font-weight-bold text-primary display-4 counter" data-count="15">0</h4>
                            <p class="text-muted">Instruktur Ahli</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="counter-card">
                            <h4 class="font-weight-bold text-primary display-4 counter" data-count="500">0</h4>
                            <p class="text-muted">Peserta Terlatih</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Visi dan Misi Start -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="visi-misi-card">
                    <i class="fas fa-bullseye text-primary fa-3x mb-3"></i>
                    <h3 class="font-weight-bold" style="font-family: 'Poppins', sans-serif;">Visi</h3>
                    <p class="text-muted">
                        Menjadi lembaga pelatihan kerja terbaik yang berkontribusi dalam menciptakan tenaga kerja berkualitas, produktif, dan siap bersaing di tingkat nasional dan global.
                    </p>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="visi-misi-card">
                    <i class="fas fa-lightbulb text-primary fa-3x mb-3"></i>
                    <h3 class="font-weight-bold" style="font-family: 'Poppins', sans-serif;">Misi</h3>
                    <ul class="text-muted text-left pl-4">
                        <li>Menyediakan pelatihan berkualitas yang sesuai dengan kebutuhan industri.</li>
                        <li>Meningkatkan keterampilan dan kompetensi tenaga kerja melalui pendidikan vokasional.</li>
                        <li>Membuka akses pelatihan kepada masyarakat tanpa diskriminasi.</li>
                        <li>Mendorong kemitraan dengan berbagai sektor untuk menciptakan lapangan pekerjaan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Visi dan Misi End -->

    <!-- Features Start -->
    <div class="bg-light py-5">
        <div class="container py-5">
            <h2 class="text-center font-weight-bold mb-5" style="font-family: 'Poppins', sans-serif;">Mengapa Memilih Program Kami</h2>
            <div class="row feature-section">
                <div class="col-lg-4 mb-4">
                    <div class="feature-card">
                        <i class="fas fa-graduation-cap fa-3x text-primary mb-3 feature-icon"></i>
                        <h4 class="font-weight-bold mb-3">Instruktur Berpengalaman</h4>
                        <p class="text-muted">Pelatihan dipandu oleh instruktur ahli dengan pengalaman industri yang relevan.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-card">
                        <i class="fas fa-certificate fa-3x text-primary mb-3 feature-icon"></i>
                        <h4 class="font-weight-bold mb-3">Sertifikasi Resmi</h4>
                        <p class="text-muted">Dapatkan sertifikat resmi yang diakui industri setelah menyelesaikan pelatihan.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-card">
                        <i class="fas fa-briefcase fa-3x text-primary mb-3 feature-icon"></i>
                        <h4 class="font-weight-bold mb-3">Peluang Karir</h4>
                        <p class="text-muted">Akses ke jaringan mitra industri untuk meningkatkan peluang kerja Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->

    <!-- jQuery CDN (Pastikan jQuery dimuat terlebih dahulu) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        $(document).ready(function() {
            // Fixed Counter Animation
            $('.counter').each(function() {
                var $this = $(this);
                var countTo = parseInt($this.attr('data-count'));
                
                $({ countNum: 0 }).animate({
                    countNum: countTo
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(countTo);
                    }
                });
            });

            // Ripple Effect untuk counter cards
            $('.counter-card').on('click', function(e) {
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

            // Random gentle effects untuk counter cards setiap 6 detik
            setInterval(() => {
                $('.counter-card').removeClass('gentle-float gentle-pulse');
                const randomCard = $('.counter-card').eq(Math.floor(Math.random() * $('.counter-card').length));
                const effects = ['gentle-float', 'gentle-pulse'];
                randomCard.addClass(effects[Math.floor(Math.random() * effects.length)]);
            }, 6000);

            // Ripple Effect untuk feature cards
            $('.feature-card').on('click', function(e) {
                const $this = $(this);
                const offset = $this.offset();
                const x = e.pageX - offset.left;
                const y = e.pageY - offset.top;
                
                const $ripple = $('<span class="feature-ripple"></span>');
                $ripple.css({
                    left: x,
                    top: y
                });
                
                $this.append($ripple);
                
                setTimeout(() => {
                    $ripple.remove();
                }, 600);
            });

            // Random gentle effects untuk feature cards setiap 7 detik
            setInterval(() => {
                $('.feature-card').removeClass('feature-float feature-pulse');
                const randomCard = $('.feature-card').eq(Math.floor(Math.random() * 3));
                const effects = ['feature-float', 'feature-pulse'];
                randomCard.addClass(effects[Math.floor(Math.random() * effects.length)]);
            }, 7000);

            // Ripple Effect untuk visi misi cards
            $('.visi-misi-card').on('click', function(e) {
                const $this = $(this);
                const offset = $this.offset();
                const x = e.pageX - offset.left;
                const y = e.pageY - offset.top;
                
                const $ripple = $('<span class="vm-ripple"></span>');
                $ripple.css({
                    left: x,
                    top: y
                });
                
                $this.append($ripple);
                
                setTimeout(() => {
                    $ripple.remove();
                }, 600);
            });

            // Random gentle effects untuk visi misi cards setiap 8 detik
            setInterval(() => {
                $('.visi-misi-card').removeClass('vm-float vm-pulse');
                const randomCard = $('.visi-misi-card').eq(Math.floor(Math.random() * 2));
                const effects = ['vm-float', 'vm-pulse'];
                randomCard.addClass(effects[Math.floor(Math.random() * effects.length)]);
            }, 8000);
        });
    </script>

    <!-- Alternatif Script Vanilla JavaScript (jika jQuery tidak tersedia) -->
    <script>
        // Backup script tanpa jQuery jika diperlukan
        if (typeof jQuery === 'undefined') {
            document.addEventListener('DOMContentLoaded', function() {
                // Counter Animation dengan Vanilla JS
                const counters = document.querySelectorAll('.counter');
                counters.forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-count'));
                    let count = 0;
                    const increment = target / 100;
                    
                    const updateCounter = () => {
                        if (count < target) {
                            count += increment;
                            counter.textContent = Math.floor(count);
                            setTimeout(updateCounter, 20);
                        } else {
                            counter.textContent = target;
                        }
                    };
                    updateCounter();
                });
            });
        }
    </script>
@endsection