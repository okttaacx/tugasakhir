<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <title>@yield('title', 'Platform Pelatihan Kerja Disnaker')</title>
    @stack('styles')
    
    <style>
        :root {
            --primary-blue: #013e7e;
            --secondary-blue: #0056b3;
            --accent-blue: #007bff;
            --text-white: #ffffff;
            --text-light: rgba(255,255,255,0.9);
            --shadow: 0 4px 15px rgba(0,0,0,0.1);
            --shadow-lg: 0 8px 32px rgba(0,0,0,0.15);
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            --steel-gray: #4a5568;
            --dark-steel: #2d3748;
            --light-steel: #718096;
            --warning-orange: #ff8c00;
            --success-green: #38a169;
            --industrial-yellow: #ffc107;
            --carbon-black: #1a202c;
            --metallic-silver: #e2e8f0;
            --glass-white: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            background: linear-gradient(135deg, var(--metallic-silver) 0%, #f7fafc 100%);
            color: var(--dark-steel);
        }
        
        /* Enhanced Topbar */
        .topbar {
            background: linear-gradient(135deg, var(--carbon-black) 0%, #2d2d2d 100%);
            color: var(--text-white);
            padding: 10px 0;
            font-size: 13px;
            border-bottom: 2px solid var(--warning-orange);
            position: relative;
            overflow: hidden;
        }

        .topbar::before {
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
                    rgba(255, 140, 0, 0.05) 2px,
                    rgba(255, 140, 0, 0.05) 4px
                );
            pointer-events: none;
        }
        
        .topbar a {
            color: var(--text-light);
            text-decoration: none;
            transition: var(--transition);
            position: relative;
        }
        
        .topbar a:hover {
            color: var(--warning-orange);
            transform: translateY(-1px);
        }

        .topbar .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            margin-left: 8px;
            transition: var(--transition);
            backdrop-filter: blur(10px);
        }

        .topbar .social-links a:hover {
            background: var(--warning-orange);
            border-color: var(--warning-orange);
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 4px 12px rgba(255, 140, 0, 0.3);
        }
        
        /* Enhanced Main Navbar */
        .navbar-custom {
            background: 
                linear-gradient(135deg, 
                    rgba(1, 62, 126, 0.95) 0%, 
                    rgba(0, 86, 179, 0.9) 50%, 
                    rgba(0, 123, 255, 0.85) 100%
                );
            backdrop-filter: blur(20px);
            padding: 0;
            box-shadow: 
                var(--shadow-lg),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 1000;
            border-bottom: 3px solid var(--warning-orange);
        }

        .navbar-custom::before {
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
                    rgba(255, 255, 255, 0.02) 100px,
                    rgba(255, 255, 255, 0.02) 200px
                );
            pointer-events: none;
        }
        
        .navbar-brand {
            color: var(--text-white) !important;
            font-weight: 800;
            font-size: 1.8rem;
            padding: 20px 0px;
            margin-right: 40px;
            transition: var(--transition);
            position: relative;
        }
        
        .navbar-brand:hover {
            color: var(--text-white) !important;
            transform: translateY(-2px);
        }
        
        .navbar-brand img {
            max-height: 55px;
            width: auto;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
            transition: var(--transition);
        }

        .navbar-brand:hover img {
            transform: scale(1.05);
            filter: drop-shadow(0 6px 12px rgba(0, 0, 0, 0.4));
        }
        
        /* Enhanced Navigation */
        .nav-container {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .nav-menu {
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0;
            position: relative;
        }
        
        .nav-item {
            list-style: none;
            position: relative;
            margin: 0 2px;
        }
        
        .nav-link {
            color: var(--text-light) !important;
            text-decoration: none;
            padding: 20px 16px;
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: 14px;
            transition: var(--transition);
            position: relative;
            z-index: 10;
            border-radius: 12px;
            white-space: nowrap;
            backdrop-filter: blur(10px);
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--glass-white);
            border-radius: 12px;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
            z-index: -1;
        }
        
        .nav-link:hover::before {
            transform: scaleX(1);
        }
        
        .nav-link:hover {
            color: var(--primary-blue) !important;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        
        .nav-link i {
            margin-right: 8px;
            font-size: 14px;
            width: 18px;
            text-align: center;
            transition: var(--transition);
        }

        .nav-link:hover i {
            transform: scale(1.2) rotateY(15deg);
            color: var(--warning-orange);
        }
        
        /* Active Menu Styling */
        .nav-item.active .nav-link {
            color: var(--primary-blue) !important;
            font-weight: 700;
            background: var(--glass-white);
            box-shadow: 
                0 8px 25px rgba(0,0,0,0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            transform: translateY(-3px);
            border: 1px solid var(--glass-border);
        }

        .nav-item.active .nav-link::before {
            transform: scaleX(1);
        }
        
        .nav-item.active .nav-link:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.25);
        }

        .nav-item.active .nav-link i {
            color: var(--warning-orange);
            transform: scale(1.1);
        }
        
        /* Enhanced Profile Section */
        .profile-section {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: 40px;
        }
        
        .auth-buttons {
            display: flex;
            gap: 12px;
        }

        .auth-buttons .btn {
            padding: 12px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
            transition: var(--transition);
            border: 2px solid var(--glass-border);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .auth-buttons .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .auth-buttons .btn:hover::before {
            left: 100%;
        }
        
        .auth-buttons .btn-outline-light {
            color: var(--text-white);
            border-color: var(--glass-border);
        }

        .auth-buttons .btn-outline-light:hover {
            background: var(--text-white);
            color: var(--primary-blue);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255,255,255,0.3);
            border-color: var(--text-white);
        }
        
        .auth-buttons .btn-light {
            background: var(--glass-white);
            color: var(--primary-blue);
            border-color: var(--text-white);
        }

        .auth-buttons .btn-light:hover {
            background: var(--text-white);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255,255,255,0.4);
        }
        
        .profile-btn {
            background: var(--glass-white);
            border: 2px solid var(--glass-border);
            color: var(--primary-blue);
            padding: 10px 18px;
            border-radius: 25px;
            transition: var(--transition);
            backdrop-filter: blur(15px);
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .profile-btn:hover {
            background: var(--text-white);
            border-color: var(--warning-orange);
            color: var(--primary-blue);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255,140,0,0.3);
        }
        
        .profile-image {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 8px;
            border: 3px solid var(--warning-orange);
            box-shadow: 0 4px 12px rgba(255,140,0,0.3);
            transition: var(--transition);
        }

        .profile-btn:hover .profile-image {
            transform: scale(1.1) rotateZ(5deg);
            box-shadow: 0 6px 18px rgba(255,140,0,0.4);
        }
        
        /* Enhanced Mobile Toggle */
        .navbar-toggler {
            border: none;
            padding: 12px;
            background: var(--glass-white);
            border-radius: 12px;
            transition: var(--transition);
            position: relative;
            width: 45px;
            height: 40px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .navbar-toggler:hover {
            background: var(--text-white);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        
        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(255,140,0,0.3);
        }
        
        /* Enhanced Toggler Icon */
        .navbar-toggler-icon {
            display: block;
            width: 26px;
            height: 22px;
            position: relative;
            background: none;
            border: none;
        }
        
        .navbar-toggler-icon::before,
        .navbar-toggler-icon::after,
        .navbar-toggler-icon span {
            content: '';
            position: absolute;
            background: var(--primary-blue);
            border-radius: 3px;
            transition: var(--transition);
        }
        
        .navbar-toggler-icon::before {
            width: 22px;
            height: 3px;
            top: 3px;
            left: 2px;
            box-shadow: 
                0 6px 0 var(--primary-blue),
                0 12px 0 var(--primary-blue);
            transform-origin: left center;
        }
        
        .navbar-toggler-icon::after {
            width: 26px;
            height: 20px;
            top: 1px;
            left: 0;
            background: none;
            border: 2px solid var(--warning-orange);
            border-radius: 6px;
            transform-origin: center;
            opacity: 0.7;
        }
        
        .navbar-toggler-icon span {
            width: 20px;
            height: 3px;
            top: 10px;
            left: 3px;
            background: var(--primary-blue);
            transform-origin: center;
        }
        
        /* Animation for toggler when opened */
        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::before {
            transform: rotate(45deg) translate(3px, -3px);
            box-shadow: none;
        }
        
        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::after {
            transform: scale(0.9) rotate(45deg);
            border-color: var(--warning-orange);
            opacity: 1;
        }
        
        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon span {
            transform: rotate(-45deg);
            background: var(--warning-orange);
        }

        /* Enhanced Dropdown */
        .dropdown-menu {
            background: var(--glass-white);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            padding: 8px;
            margin-top: 8px;
        }

        .dropdown-item {
            border-radius: 10px;
            padding: 10px 16px;
            transition: var(--transition);
            color: var(--dark-steel);
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--text-white);
            transform: translateX(4px);
        }

        .dropdown-item i {
            width: 20px;
            transition: var(--transition);
        }

        .dropdown-item:hover i {
            color: var(--warning-orange);
            transform: scale(1.1);
        }

        .dropdown-divider {
            margin: 8px 0;
            border-color: var(--glass-border);
        }
        
        /* Mobile Responsive */
        @media (max-width: 991px) {
            .nav-menu {
                flex-direction: column;
                background: 
                    linear-gradient(135deg, 
                        rgba(1, 62, 126, 0.98) 0%, 
                        rgba(0, 86, 179, 0.95) 100%
                    );
                backdrop-filter: blur(20px);
                padding: 25px 0;
                border-top: 2px solid var(--warning-orange);
                margin-top: 15px;
                border-radius: 0 0 25px 25px;
                box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            }
            
            .nav-link {
                padding: 16px 30px;
                width: 100%;
                justify-content: flex-start;
                border-radius: 0;
            }
            
            .nav-link::before {
                border-radius: 0;
            }
            
            .nav-link:hover {
                background: var(--glass-white);
                margin: 0 20px;
                border-radius: 15px;
                width: calc(100% - 40px);
                box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            }
            
            .nav-item.active .nav-link {
                margin: 0 20px;
                border-radius: 15px;
                width: calc(100% - 40px);
                background: var(--glass-white);
            }
            
            .profile-section {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
                background: rgba(255,255,255,0.1);
                border-radius: 20px;
                margin: 15px 20px 0;
                backdrop-filter: blur(15px);
            }
            
            .auth-buttons {
                width: 100%;
            }
            
            .auth-buttons .btn {
                flex: 1;
                text-align: center;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.5rem;
                margin-right: 20px;
            }

            .navbar-brand img {
                max-height: 45px;
            }

            .nav-link {
                font-size: 13px;
                padding: 14px 25px;
            }

            .auth-buttons .btn {
                padding: 10px 16px;
                font-size: 13px;
            }
        }
        
        /* Enhanced Footer */
        .footer {
            background: 
                linear-gradient(135deg, 
                    var(--carbon-black) 0%, 
                    #2d2d2d 50%, 
                    var(--dark-steel) 100%
                );
            color: var(--text-light);
            position: relative;
            overflow: hidden;
        }
        
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, 
                var(--primary-blue) 0%, 
                var(--warning-orange) 50%, 
                var(--primary-blue) 100%);
        }

        .footer::after {
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
                    transparent 50px,
                    rgba(255, 140, 0, 0.03) 50px,
                    rgba(255, 140, 0, 0.03) 100px
                );
            pointer-events: none;
        }
        
        .footer h3, .footer h5 {
            color: var(--text-white);
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        
        .footer a {
            color: var(--text-light);
            text-decoration: none;
            transition: var(--transition);
        }
        
        .footer a:hover {
            color: var(--warning-orange);
            transform: translateX(4px);
        }
        
        .footer .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: 
                linear-gradient(135deg, 
                    rgba(255, 255, 255, 0.1), 
                    rgba(255, 255, 255, 0.05)
                );
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            margin-right: 12px;
            transition: var(--transition);
            color: var(--text-light);
        }
        
        .footer .social-links a:hover {
            background: linear-gradient(135deg, var(--warning-orange), var(--industrial-yellow));
            border-color: var(--warning-orange);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(255,140,0,0.3);
            color: var(--text-white);
        }

        .contact-info {
            position: relative;
        }

        .contact-info p {
            padding: 8px 0;
            padding-left: 40px;
            position: relative;
            transition: var(--transition);
        }

        .contact-info i {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            color: var(--warning-orange);
            font-size: 16px;
            transition: var(--transition);
        }

        .contact-info p:hover {
            color: var(--text-white);
            transform: translateX(4px);
        }

        .contact-info p:hover i {
            color: var(--industrial-yellow);
            transform: translateY(-50%) scale(1.2);
        }
        
        /* Enhanced Back to top */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--text-white);
            border: none;
            border-radius: 50%;
            width: 55px;
            height: 55px;
            display: none;
            z-index: 999;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(1,62,126,0.4);
            backdrop-filter: blur(10px);
        }
        
        .back-to-top:hover {
            background: linear-gradient(135deg, var(--warning-orange), var(--industrial-yellow));
            color: var(--text-white);
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 8px 25px rgba(255,140,0,0.4);
        }
        
        /* Content styling */
        .content {
            min-height: 70vh;
            position: relative;
        }

        /* Enhanced page transitions */
        .page-transition {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .page-transition.loaded {
            opacity: 1;
            transform: translateY(0);
        }

        /* ENHANCED LOADING OVERLAY WITH PROFESSIONAL ANIMATIONS */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                linear-gradient(135deg, 
                    var(--carbon-black) 0%, 
                    var(--primary-blue) 50%, 
                    var(--dark-steel) 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 1;
            visibility: visible;
            transition: opacity 0.8s ease, visibility 0.8s ease;
            overflow: hidden;
        }

        .loading-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 25% 25%, rgba(255, 140, 0, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(1, 62, 126, 0.1) 0%, transparent 50%);
            animation: floatingBg 6s ease-in-out infinite;
        }

        .loading-overlay.hide {
            opacity: 0;
            visibility: hidden;
        }

        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 10;
        }

        /* Professional Logo Animation */
        .loading-logo {
            width: 120px;
            height: 120px;
            margin-bottom: 30px;
            position: relative;
            animation: logoFloat 3s ease-in-out infinite;
        }

        /* .loading-logo::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            border: 3px solid var(--warning-orange);
            border-radius: 50%;
            opacity: 0.3;
            animation: logoPulse 2s ease-in-out infinite;
        } */

        .loading-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 8px 16px rgba(255, 140, 0, 0.3));
        }

        /* Enhanced Progress Circle */
        .loading-circle {
            width: 140px;
            height: 140px;
            position: relative;
            margin-bottom: 25px;
            animation: circleRotate 4s linear infinite;
        }

        .loading-circle svg {
            width: 100%;
            height: 100%;
            transform: rotate(-90deg);
        }

        .loading-circle .circle-bg {
            fill: none;
            stroke: rgba(255, 255, 255, 0.1);
            stroke-width: 6;
            stroke-linecap: round;
        }

        .loading-circle .circle-progress {
            fill: none;
            stroke: url(#progressGradient);
            stroke-width: 6;
            stroke-linecap: round;
            stroke-dasharray: 439.82;
            stroke-dashoffset: 439.82;
            transition: stroke-dashoffset 0.5s ease;
            filter: drop-shadow(0 0 8px rgba(255, 140, 0, 0.5));
        }

        /* Progress Text */
        .loading-percentage {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 28px;
            font-weight: 800;
            color: var(--text-white);
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            animation: percentageGlow 2s ease-in-out infinite;
        }

        /* Loading Text with Typewriter Effect */
        .loading-text {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-light);
            text-align: center;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
            animation: textFade 3s ease-in-out infinite;
        }

        .loading-subtext {
            font-size: 14px;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.7);
            text-align: center;
            max-width: 300px;
            line-height: 1.6;
            animation: subtextSlide 2s ease-in-out infinite;
        }

        /* Industrial Gear Animation */
        .loading-gears {
            position: absolute;
            top: 20%;
            left: 10%;
            opacity: 0.1;
            animation: gearsRotate 8s linear infinite;
        }

        .gear {
            width: 60px;
            height: 60px;
            border: 4px solid var(--warning-orange);
            border-radius: 50%;
            position: relative;
        }

        .gear::before {
            content: '';
            position: absolute;
            top: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 12px;
            height: 12px;
            background: var(--warning-orange);
            border-radius: 50%;
        }

        /* Progress Status Indicators */
        .loading-status {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
            animation: statusFade 2s ease-in-out infinite;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--text-light);
            animation: dotPulse 1.5s ease-in-out infinite;
        }

        .status-dot:nth-child(1) { animation-delay: 0s; }
        .status-dot:nth-child(2) { animation-delay: 0.3s; }
        .status-dot:nth-child(3) { animation-delay: 0.6s; }

        .status-dot.active {
            background: var(--warning-orange);
            transform: scale(1.2);
            box-shadow: 0 0 12px rgba(255, 140, 0, 0.6);
        }

        /* LOADING ANIMATIONS */
        @keyframes floatingBg {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(20px, -20px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-10px) scale(1.05); }
        }

        @keyframes logoPulse {
            0%, 100% { 
                transform: scale(1); 
                opacity: 0.3; 
            }
            50% { 
                transform: scale(1.1); 
                opacity: 0.7; 
            }
        }

        @keyframes circleRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes percentageGlow {
            0%, 100% { 
                color: var(--text-white);
                text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            }
            50% { 
                color: var(--warning-orange);
                text-shadow: 0 4px 16px rgba(255, 140, 0, 0.8);
            }
        }

        @keyframes textFade {
            0%, 100% { opacity: 0.8; transform: translateY(0); }
            50% { opacity: 1; transform: translateY(-2px); }
        }

        @keyframes subtextSlide {
            0%, 100% { opacity: 0.6; transform: translateX(0); }
            50% { opacity: 1; transform: translateX(2px); }
        }

        @keyframes gearsRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes statusFade {
            0%, 100% { opacity: 0.7; }
            50% { opacity: 1; }
        }

        @keyframes dotPulse {
            0%, 100% { 
                transform: scale(1); 
                opacity: 0.5; 
            }
            50% { 
                transform: scale(1.3); 
                opacity: 1; 
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--metallic-silver);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary-blue), var(--warning-orange));
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--warning-orange), var(--industrial-yellow));
        }

        /* Accessibility improvements */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Focus styles for accessibility */
        .nav-link:focus,
        .btn:focus,
        .profile-btn:focus {
            outline: 2px solid var(--warning-orange);
            outline-offset: 2px;
        }
    </style>
</head>

<body>
    <!-- Enhanced Loading Overlay with Professional Animations -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-container">
            <!-- Logo Animation -->
            <div class="loading-logo">
                <img src="{{ asset('image\LOGO_SIJOKER-removebg-preview-cutted.png') }}" alt="SIJOKER Loading"/>
            </div>

            <!-- Progress Circle -->
            <div class="loading-circle">
                <svg viewBox="0 0 140 140">
                    <defs>
                        <linearGradient id="progressGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" style="stop-color:var(--warning-orange);stop-opacity:1" />
                            <stop offset="50%" style="stop-color:var(--industrial-yellow);stop-opacity:1" />
                            <stop offset="100%" style="stop-color:var(--warning-orange);stop-opacity:1" />
                        </linearGradient>
                    </defs>
                    <circle class="circle-bg" cx="70" cy="70" r="65"/>
                    <circle class="circle-progress" cx="70" cy="70" r="65"/>
                </svg>
                
            </div>
            <div class="loading-percentage" id="loadingPercentage">0%</div>

            <!-- Loading Text -->
            <div class="loading-text" id="loadingText">Memuat Platform SIJOKER...</div>
            <div class="loading-subtext">Sistem Informasi Tenaga Kerja - Dinas Tenaga Kerja Kota Batu</div>

            <!-- Status Indicators -->
            <div class="loading-status">
                <div class="status-dot" id="dot1"></div>
                <div class="status-dot" id="dot2"></div>
                <div class="status-dot" id="dot3"></div>
            </div>
        </div>

        <!-- Industrial Gears -->
        <div class="loading-gears">
            <div class="gear"></div>
        </div>
    </div>

    <!-- Enhanced Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="d-flex align-items-center">
                        <small><i class="fa fa-envelope me-2"></i>disnakerkotabatu@gmail.com</small>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="social-links d-flex justify-content-lg-end justify-content-center">
                        <a href="https://www.tiktok.com/@disnaker_kotabatu" target="_blank" title="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="https://www.instagram.com/disnaker_kotabatu/" target="_blank" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/6285176851727" target="_blank" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Main Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}" title="SIJOKER - Beranda">
                <img src="{{ asset('image/LOGO_SIJOKER-removebg-preview.png') }}" alt="SIJOKER Logo"/>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><span></span></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="nav-container mx-auto">
                    <ul class="nav-menu navbar-nav" id="navMenu">
                        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/') }}" title="Beranda">
                                <i class="fas fa-home"></i>Beranda
                            </a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('trainings.user.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('trainings.user.index') }}" title="Program Pelatihan">
                                <i class="fas fa-graduation-cap"></i>Pelatihan
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('complaints') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('complaints.index') }}" title="Pengaduan Masyarakat">
                                <i class="fas fa-exclamation-triangle"></i>Pengaduan
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('pelaporan') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pelaporan.index') }}" title="Pelaporan">
                                <i class="fas fa-file-alt"></i>Pelaporan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://siapkerja.kemnaker.go.id/app/home" target="_blank" title="SiapKerja - Portal Eksternal">
                                <i class="fas fa-external-link-alt"></i>SiapKerja
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('survey/form') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/survey/form') }}" title="Survei Kepuasan">
                                <i class="fas fa-poll"></i>Survei
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('berita') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/berita') }}" title="Berita Terkini">
                                <i class="fas fa-newspaper"></i>Berita
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('lokers') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/lokers') }}" title="Informasi Lowongan Kerja">
                                <i class="fas fa-briefcase"></i>Info Loker
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="profile-section">
                    @guest
                        <div class="auth-buttons">
                            <a href="{{ route('register') }}" class="btn btn-outline-light">
                                <i class="fas fa-user-plus me-1"></i>Daftar
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-light">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </div>
                    @else
                        <div class="dropdown">
                            <button class="profile-btn dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ Auth::user()->profile && Auth::user()->profile->foto ? asset('storage/' . Auth::user()->profile->foto) : asset('image/default_profile.jpg') }}" alt="Profile" class="profile-image">
                                <span>{{ Auth::user()->profile->name ?? Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down ms-2"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        <i class="fas fa-user me-2"></i>Profil Saya
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-cog me-2"></i>Dashboard
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="content page-transition">
        @yield('content')
    </div>

    <!-- Enhanced Footer -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="footer-brand mb-4">
                        <img src="{{ asset('image/LOGO_SIJOKER-removebg-preview.png') }}" alt="SIJOKER Logo" style="width: 60%; margin-bottom: 1.5rem; filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));"/>
                        <p class="mb-4">Dinas Tenaga Kerja Kota Batu berkomitmen untuk meningkatkan kualitas dan keterampilan tenaga kerja melalui program pelatihan berkualitas. Kami berupaya menciptakan tenaga kerja yang kompeten dan siap bersaing di pasar kerja.</p>
                    </div>
                    <div class="social-links">
                        <a href="https://facebook.com/disnakerkotabatu" target="_blank" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/disnakerkotabatu" target="_blank" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.tiktok.com/@disnaker_kotabatu" target="_blank" title="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="https://www.instagram.com/disnaker_kotabatu/" target="_blank" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://youtube.com/disnakerkotabatu" target="_blank" title="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="mb-3">
                        <i class="fas fa-phone-alt me-2" style="color: var(--warning-orange);"></i>
                        Hubungi Kami
                    </h5>
                    <div class="contact-info">
                        <p>
                            <i class="fas fa-map-marker-alt"></i>
                            Jl. Panglima Sudirman No.507, Pesanggrahan, Kec. Batu, Kota Batu, Jawa Timur 65313
                        </p>
                        <p>
                            <i class="fas fa-phone"></i>
                            +62 851 7685 1727
                        </p>
                        <p>
                            <i class="fas fa-envelope"></i>
                            disnakerkotabatu@gmail.com
                        </p>
                        <p>
                            <i class="fas fa-clock"></i>
                            Senin - Jumat: 08:00 - 16:00 WIB
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="mb-3">
                        <i class="fas fa-link me-2" style="color: var(--warning-orange);"></i>
                        Tautan Cepat
                    </h5>
                    <div class="d-flex flex-column">
                        <a href="{{ route('trainings.user.index') }}" class="mb-2">
                            <i class="fas fa-angle-right me-2"></i>Program Pelatihan
                        </a>
                        <a href="{{ route('complaints.index') }}" class="mb-2">
                            <i class="fas fa-angle-right me-2"></i>Pengaduan
                        </a>
                        <a href="{{ route('pelaporan.index') }}" class="mb-2">
                            <i class="fas fa-angle-right me-2"></i>Pelaporan
                        </a>
                        <a href="{{ url('/survey/form') }}" class="mb-2">
                            <i class="fas fa-angle-right me-2"></i>Survei Kepuasan
                        </a>
                        <a href="{{ url('/berita') }}" class="mb-2">
                            <i class="fas fa-angle-right me-2"></i>Berita Terkini
                        </a>
                        <a href="{{ url('/lokers') }}">
                            <i class="fas fa-angle-right me-2"></i>Info Lowongan Kerja
                        </a>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: var(--glass-border); opacity: 0.3;">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">
                        <i class="fas fa-copyright me-1"></i>
                        2024 Dinas Tenaga Kerja Kota Batu. Hak Cipta Dilindungi.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">
                        <i class="fas fa-code me-1"></i>
                        Dikembangkan oleh <span style="color: var(--warning-orange); font-weight: 600;">MGITUMM21</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Enhanced Back to Top -->
    <button class="back-to-top" id="backToTop" title="Kembali ke Atas">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced loading overlay with professional animations
            const loadingOverlay = document.getElementById('loadingOverlay');
            const loadingPercentage = document.getElementById('loadingPercentage');
            const loadingText = document.getElementById('loadingText');
            const circleProgress = document.querySelector('.circle-progress');
            const statusDots = [
                document.getElementById('dot1'),
                document.getElementById('dot2'),
                document.getElementById('dot3')
            ];

            let progress = 0;
            let currentDot = 0;
            
            const loadingSteps = [
                'Memuat Platform SIJOKER...',
                'Menginisialisasi Sistem...',
                'Memuat Komponen UI...',
                'Menghubungkan ke Database...',
                'Memverifikasi Kredensial...',
                'Menyiapkan Dashboard...',
                'Finalisasi Loading...',
                'Selamat Datang!'
            ];

            let currentStep = 0;

            const updateProgress = () => {
                // Simulate realistic loading progress
                const increment = Math.random() * 8 + 2; // Random between 2-10
                progress = Math.min(progress + increment, 100);
                
                // Update percentage display
                loadingPercentage.textContent = `${Math.round(progress)}%`;
                
                // Update circle progress
                const offset = 439.82 - (progress / 100) * 439.82;
                circleProgress.style.strokeDashoffset = offset;
                
                // Update loading text based on progress
                const stepIndex = Math.floor((progress / 100) * loadingSteps.length);
                if (stepIndex !== currentStep && stepIndex < loadingSteps.length) {
                    currentStep = stepIndex;
                    loadingText.textContent = loadingSteps[stepIndex];
                    
                    // Add text animation
                    loadingText.style.transform = 'translateY(-10px)';
                    loadingText.style.opacity = '0.5';
                    setTimeout(() => {
                        loadingText.style.transform = 'translateY(0)';
                        loadingText.style.opacity = '1';
                    }, 200);
                }
                
                // Update status dots
                const dotIndex = Math.floor((progress / 100) * 3);
                if (dotIndex !== currentDot && dotIndex < 3) {
                    if (statusDots[currentDot]) {
                        statusDots[currentDot].classList.remove('active');
                    }
                    currentDot = dotIndex;
                    if (statusDots[currentDot]) {
                        statusDots[currentDot].classList.add('active');
                    }
                }
                
                // Complete loading
                if (progress >= 100) {
                    setTimeout(() => {
                        // Final animation before hiding
                        loadingOverlay.style.transform = 'scale(1.05)';
                        loadingOverlay.style.opacity = '0.8';
                        
                        setTimeout(() => {
                            loadingOverlay.classList.add('hide');
                            document.querySelector('.page-transition').classList.add('loaded');
                            
                            // Add welcome pulse effect
                            document.body.style.animation = 'none';
                            document.body.offsetHeight; // Trigger reflow
                            document.body.style.animation = 'welcomePulse 0.8s ease-out';
                        }, 300);
                    }, 800);
                    clearInterval(progressInterval);
                }
            };

            const progressInterval = setInterval(updateProgress, 150);

            // Enhanced navigation functionality
            const navItems = document.querySelectorAll('.nav-item');
            const activeItem = document.querySelector('.nav-item.active');
            
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
            
            // Handle navigation clicks with enhanced feedback
            navItems.forEach(item => {
                const link = item.querySelector('.nav-link');
                
                link.addEventListener('click', function(e) {
                    // Add ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: radial-gradient(circle, rgba(255,140,0,0.3) 0%, transparent 70%);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: rippleEffect 0.6s ease-out;
                        pointer-events: none;
                        z-index: 1;
                    `;
                    
                    this.style.position = 'relative';
                    this.appendChild(ripple);
                    
                    setTimeout(() => ripple.remove(), 600);
                });
            });
            
            // Enhanced back to top functionality
            const backToTop = document.getElementById('backToTop');
            let scrollTimeout;
            
            window.addEventListener('scroll', function() {
                clearTimeout(scrollTimeout);
                
                if (window.pageYOffset > 300) {
                    backToTop.style.display = 'block';
                    backToTop.style.opacity = '1';
                } else {
                    backToTop.style.opacity = '0';
                    scrollTimeout = setTimeout(() => {
                        backToTop.style.display = 'none';
                    }, 300);
                }
                
                // Add scroll progress indicator
                const scrollPercent = (window.pageYOffset / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
                backToTop.style.background = `conic-gradient(var(--warning-orange) ${scrollPercent}%, var(--primary-blue) ${scrollPercent}%)`;
            });
            
            backToTop.addEventListener('click', function() {
                // Add click animation
                this.style.transform = 'translateY(-5px) scale(0.9)';
                
                setTimeout(() => {
                    this.style.transform = 'translateY(-5px) scale(1.1)';
                }, 150);
                
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
            
            // Enhanced navbar collapse behavior
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            
            navbarToggler.addEventListener('click', function() {
                // Add haptic feedback simulation
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 100);
            });
            
            // Close mobile menu when clicking on links
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992) {
                        const navbarCollapse = document.querySelector('.navbar-collapse');
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                            hide: true
                        });
                    }
                });
            });
            
            // Enhanced dropdown behavior
            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(4px)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
            
            // Keyboard navigation enhancement
            document.addEventListener('keydown', function(e) {
                // Press 'H' to go home
                if (e.key.toLowerCase() === 'h' && !e.ctrlKey && !e.altKey) {
                    const activeElement = document.activeElement;
                    if (activeElement.tagName !== 'INPUT' && activeElement.tagName !== 'TEXTAREA') {
                        window.location.href = '/';
                    }
                }
                
                // Press 'T' to go to top
                if (e.key.toLowerCase() === 't' && !e.ctrlKey && !e.altKey) {
                    const activeElement = document.activeElement;
                    if (activeElement.tagName !== 'INPUT' && activeElement.tagName !== 'TEXTAREA') {
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                }
            });
            
            // Performance optimization: Lazy load images
            const images = document.querySelectorAll('img[data-src]');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            images.forEach(img => imageObserver.observe(img));
            
            // Add entrance animations for footer elements
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const animateOnScroll = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);
            
            document.querySelectorAll('.footer .col-lg-4').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'all 0.6s ease';
                animateOnScroll.observe(el);
            });

            // Add loading completion sound simulation
            setTimeout(() => {
                if (progress >= 100) {
                    // Simulate completion notification
                    console.log('🚀 SIJOKER Platform loaded successfully!');
                }
            }, 3000);
        });

        // Add CSS animation for ripple effect and welcome pulse
        const style = document.createElement('style');
        style.textContent = `
            @keyframes rippleEffect {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
            
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

            @keyframes welcomePulse {
                0% {
                    filter: brightness(1);
                }
                50% {
                    filter: brightness(1.05);
                }
                100% {
                    filter: brightness(1);
                }
            }
            
            .animate-fade-in-up {
                animation: fadeInUp 0.6s ease-out;
            }

            /* Enhanced Preloader Styles */
            .loading-overlay .loading-container {
                animation: containerFloat 4s ease-in-out infinite;
            }

            @keyframes containerFloat {
                0%, 100% {
                    transform: translateY(0px);
                }
                50% {
                    transform: translateY(-8px);
                }
            }

            /* Enhanced Mobile Loading */
            @media (max-width: 768px) {
                .loading-overlay .loading-circle {
                    width: 100px;
                    height: 100px;
                }
                
                .loading-overlay .loading-logo {
                    width: 80px;
                    height: 80px;
                }
                
                .loading-overlay .loading-text {
                    font-size: 16px;
                }
                
                .loading-overlay .loading-subtext {
                    font-size: 12px;
                    max-width: 250px;
                }
                
                .loading-overlay .loading-percentage {
                    font-size: 22px;
                }
            }

            /* Loading States */
            .loading-state-init { color: var(--warning-orange); }
            .loading-state-progress { color: var(--industrial-yellow); }
            .loading-state-complete { color: var(--success-green); }

            /* Professional Loading Spinner Alternative */
            .loading-spinner {
                width: 40px;
                height: 40px;
                margin: 20px auto;
                border: 4px solid rgba(255, 140, 0, 0.2);
                border-top: 4px solid var(--warning-orange);
                border-radius: 50%;
                animation: spinnerRotate 1s linear infinite;
                display: none;
            }

            @keyframes spinnerRotate {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            /* Loading Progress Bar */
            .loading-progress-bar {
                width: 200px;
                height: 4px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 2px;
                margin: 15px auto;
                overflow: hidden;
                position: relative;
            }

            .loading-progress-fill {
                height: 100%;
                background: linear-gradient(90deg, var(--warning-orange), var(--industrial-yellow));
                border-radius: 2px;
                transition: width 0.3s ease;
                width: 0%;
                position: relative;
            }

            .loading-progress-fill::after {
                content: '';
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
                animation: progressShimmer 2s ease-in-out infinite;
            }

            @keyframes progressShimmer {
                0% { transform: translateX(-100%); }
                100% { transform: translateX(100%); }
            }

            /* Enhanced Error States */
            .loading-error {
                color: #ff6b6b;
                font-size: 14px;
                margin-top: 10px;
                display: none;
            }

            /* Connection Status Indicators */
            .connection-status {
                display: flex;
                align-items: center;
                gap: 8px;
                margin-top: 10px;
                font-size: 12px;
                color: var(--text-light);
            }

            .connection-dot {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: var(--success-green);
                animation: connectionPulse 2s ease-in-out infinite;
            }

            @keyframes connectionPulse {
                0%, 100% { opacity: 0.5; }
                50% { opacity: 1; }
            }

            /* Loading Tips */
            .loading-tips {
                position: absolute;
                bottom: 50px;
                left: 50%;
                transform: translateX(-50%);
                font-size: 12px;
                color: rgba(255, 255, 255, 0.6);
                text-align: center;
                max-width: 300px;
                animation: tipsSlide 8s ease-in-out infinite;
            }

            @keyframes tipsSlide {
                0%, 100% { opacity: 0.6; }
                50% { opacity: 1; }
            }

            /* Performance optimizations */
            .loading-overlay * {
                will-change: transform, opacity;
            }

            /* Reduced motion accessibility */
            @media (prefers-reduced-motion: reduce) {
                .loading-overlay *,
                .loading-overlay *::before,
                .loading-overlay *::after {
                    animation-duration: 0.01ms !important;
                    animation-iteration-count: 1 !important;
                    transition-duration: 0.01ms !important;
                }
            }
        `;
        document.head.appendChild(style);

        // Enhanced Performance Monitoring
        window.addEventListener('load', function() {
            // Performance metrics
            const perfData = performance.getEntriesByType('navigation')[0];
            if (perfData) {
                console.log('📊 Performance Metrics:');
                console.log(`DOM Content Loaded: ${Math.round(perfData.domContentLoadedEventEnd - perfData.domContentLoadedEventStart)}ms`);
                console.log(`Page Load Complete: ${Math.round(perfData.loadEventEnd - perfData.loadEventStart)}ms`);
                console.log(`Total Load Time: ${Math.round(perfData.loadEventEnd - perfData.fetchStart)}ms`);
            }
        });

        // Connection Quality Detection
        if (navigator.connection) {
            const connection = navigator.connection;
            console.log(`📡 Network: ${connection.effectiveType} (${connection.downlink}Mbps)`);
            
            // Adjust loading animation based on connection speed
            if (connection.effectiveType === 'slow-2g' || connection.effectiveType === '2g') {
                document.querySelector('.loading-circle').style.animationDuration = '6s';
            }
        }
        
        console.log('🎯 Enhanced SIJOKER Layout Loaded - Professional Industrial Theme with Advanced Loading Animation');
    </script>
    
    @stack('scripts')
</body>
</html>