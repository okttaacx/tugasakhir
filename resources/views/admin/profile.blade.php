@extends('layouts.adminapp')

@section('title', 'Profil Admin')

@section('content')
<div class="container-fluid px-4 py-5">
    <!-- Industrial Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3 shadow-lg" 
                         style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary-blue), var(--warning-orange)) !important;">
                        <i class="fas fa-user-shield fa-2x text-white"></i>
                    </div>
                    <div>
                        <h2 class="mb-1" style="color: var(--primary-blue); font-weight: 800;">Panel Profil Administrator</h2>
                        <p class="mb-0 text-muted">Kelola informasi dan keamanan akun Anda</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <span class="badge px-3 py-2" style="background: linear-gradient(135deg, var(--success-green), rgba(56, 161, 105, 0.8)); font-size: 0.9rem;">
                        <i class="fas fa-shield-alt me-2"></i>Administrator
                    </span>
                    <span class="badge px-3 py-2" style="background: linear-gradient(135deg, var(--warning-orange), rgba(255, 140, 0, 0.8)); font-size: 0.9rem;">
                        <i class="fas fa-clock me-2"></i>Online
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="row g-4">
                <!-- Main Profile Card -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-lg" 
                         style="background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%); border-radius: 20px; overflow: hidden;">
                        <!-- Card Header -->
                        <div class="card-header py-4" 
                             style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--dark-steel) 100%); border: none;">
                            <div class="d-flex align-items-center">
                                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-user-edit" style="color: var(--warning-orange); font-size: 1.3rem;"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 text-white font-weight-bold">Informasi Profil</h5>
                                    <p class="mb-0 text-light small">Perbarui data pribadi dan kredensial</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            @if (session('success'))
                                <div class="alert border-0 shadow-sm mb-4" 
                                     style="background: linear-gradient(135deg, rgba(56, 161, 105, 0.1), rgba(56, 161, 105, 0.05)); border-left: 4px solid var(--success-green) !important; border-radius: 12px;">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-check text-white"></i>
                                        </div>
                                        <div>
                                            <strong style="color: var(--success-green);">Berhasil!</strong>
                                            <p class="mb-0 mt-1">{{ session('success') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert border-0 shadow-sm mb-4" 
                                     style="background: linear-gradient(135deg, rgba(220, 53, 69, 0.1), rgba(220, 53, 69, 0.05)); border-left: 4px solid #dc3545 !important; border-radius: 12px;">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center me-3 mt-1" 
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                        <div>
                                            <strong class="text-danger">Terjadi Kesalahan:</strong>
                                            <ul class="mb-0 mt-2">
                                                @foreach ($errors->all() as $error)
                                                    <li class="text-danger">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.updateProfile') }}">
                                @csrf
                                @method('PUT')

                                <!-- Basic Information Section -->
                                <div class="mb-4">
                                    <h6 class="mb-3 d-flex align-items-center" style="color: var(--primary-blue); font-weight: 700;">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" 
                                             style="width: 30px; height: 30px; background: linear-gradient(135deg, var(--warning-orange), rgba(255, 140, 0, 0.8)) !important;">
                                            <i class="fas fa-info-circle text-white" style="font-size: 0.8rem;"></i>
                                        </div>
                                        Informasi Dasar
                                    </h6>
                                    
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label fw-semibold">
                                                <i class="fas fa-user me-2" style="color: var(--warning-orange);"></i>Nama Lengkap
                                            </label>
                                            <input id="name" type="text" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   name="name" value="{{ old('name', $admin->name) }}" 
                                                   required
                                                   style="border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 16px; transition: all 0.3s ease;"
                                                   onocus="this.style.borderColor='var(--warning-orange)'"
                                                   onblur="this.style.borderColor='#e2e8f0'">
                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="email" class="form-label fw-semibold">
                                                <i class="fas fa-envelope me-2" style="color: var(--warning-orange);"></i>Email
                                            </label>
                                            <input id="email" type="email" 
                                                   class="form-control @error('email') is-invalid @enderror" 
                                                   name="email" value="{{ old('email', $admin->email) }}" 
                                                   required
                                                   style="border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 16px; transition: all 0.3s ease;"
                                                   onfocus="this.style.borderColor='var(--warning-orange)'"
                                                   onblur="this.style.borderColor='#e2e8f0'">
                                            @error('email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Security Section -->
                                <div class="border-top pt-4">
                                    <h6 class="mb-3 d-flex align-items-center" style="color: var(--primary-blue); font-weight: 700;">
                                        <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center me-2" 
                                             style="width: 30px; height: 30px;">
                                            <i class="fas fa-lock text-white" style="font-size: 0.8rem;"></i>
                                        </div>
                                        Keamanan Akun <span class="badge bg-warning ms-2">Opsional</span>
                                    </h6>

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="current_password" class="form-label fw-semibold">
                                                <i class="fas fa-key me-2" style="color: var(--steel-gray);"></i>Password Saat Ini
                                            </label>
                                            <input id="current_password" type="password" 
                                                   class="form-control @error('current_password') is-invalid @enderror" 
                                                   name="current_password"
                                                   style="border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 16px; transition: all 0.3s ease;"
                                                   onfocus="this.style.borderColor='var(--warning-orange)'"
                                                   onblur="this.style.borderColor='#e2e8f0'">
                                            @error('current_password')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="new_password" class="form-label fw-semibold">
                                                <i class="fas fa-shield-alt me-2" style="color: var(--steel-gray);"></i>Password Baru
                                            </label>
                                            <input id="new_password" type="password" 
                                                   class="form-control @error('new_password') is-invalid @enderror" 
                                                   name="new_password"
                                                   style="border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 16px; transition: all 0.3s ease;"
                                                   onfocus="this.style.borderColor='var(--warning-orange)'"
                                                   onblur="this.style.borderColor='#e2e8f0'">
                                            @error('new_password')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="new_password_confirmation" class="form-label fw-semibold">
                                                <i class="fas fa-check-double me-2" style="color: var(--steel-gray);"></i>Konfirmasi Password Baru
                                            </label>
                                            <input id="new_password_confirmation" type="password" 
                                                   class="form-control" 
                                                   name="new_password_confirmation"
                                                   style="border-radius: 12px; border: 2px solid #e2e8f0; padding: 12px 16px; transition: all 0.3s ease;"
                                                   onfocus="this.style.borderColor='var(--warning-orange)'"
                                                   onblur="this.style.borderColor='#e2e8f0'">
                                        </div>
                                    </div>

                                    <div class="alert border-0 mt-3" 
                                         style="background: linear-gradient(135deg, rgba(255, 193, 7, 0.1), rgba(255, 193, 7, 0.05)); border-left: 4px solid var(--industrial-yellow) !important; border-radius: 12px;">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-info-circle me-2" style="color: var(--industrial-yellow);"></i>
                                            <small class="mb-0">Kosongkan field password jika tidak ingin mengubah password</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-3 mt-4 pt-3 border-top">
                                    <button type="submit" 
                                            class="btn px-4 py-3 shadow-sm" 
                                            style="background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue)); color: white; border: none; border-radius: 12px; font-weight: 600; transition: all 0.3s ease;"
                                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(1, 62, 126, 0.3)'"
                                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'">
                                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                                    </button>
                                    <a href="{{ route('admin.dashboard') }}" 
                                       class="btn px-4 py-3 shadow-sm" 
                                       style="background: linear-gradient(135deg, var(--steel-gray), var(--light-steel)); color: white; border: none; border-radius: 12px; font-weight: 600; text-decoration: none; transition: all 0.3s ease;"
                                       onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(74, 85, 104, 0.3)'"
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Profile Info Sidebar -->
                <div class="col-lg-4">
                    <div class="row g-4">
                        <!-- Admin Info Card -->
                        <div class="col-12">
                            <div class="card border-0 shadow-lg" 
                                 style="background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%); border-radius: 20px; overflow: hidden;">
                                <div class="card-header text-center py-4" 
                                     style="background: linear-gradient(135deg, var(--carbon-black) 0%, var(--dark-steel) 100%); border: none;">
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ Auth::user()->profile && Auth::user()->profile->foto ? asset('storage/' . Auth::user()->profile->foto) : asset('image/default_profile.jpg') }}" 
                                             alt="Profile" 
                                             class="rounded-circle shadow-lg" 
                                             style="width: 80px; height: 80px; object-fit: cover; border: 4px solid var(--warning-orange);">
                                        <span class="position-absolute bottom-0 end-0 bg-success rounded-circle" 
                                              style="width: 24px; height: 24px; border: 3px solid white;">
                                            <i class="fas fa-crown text-white" style="font-size: 0.7rem; margin-left: 2px; margin-top: 2px;"></i>
                                        </span>
                                    </div>
                                    <h5 class="text-white mt-3 mb-1 font-weight-bold">{{ $admin->name }}</h5>
                                    <p class="text-light mb-0">Super Administrator</p>
                                </div>
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 40px; height: 40px; background: linear-gradient(135deg, var(--warning-orange), rgba(255, 140, 0, 0.8)) !important;">
                                            <i class="fas fa-envelope text-white"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted">Email</small>
                                            <p class="mb-0 fw-semibold">{{ $admin->email }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-calendar text-white"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted">Bergabung</small>
                                            <p class="mb-0 fw-semibold">{{ $admin->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-shield-alt text-white"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted">Akses Level</small>
                                            <p class="mb-0 fw-semibold">Full Access</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="col-12">
                            <div class="card border-0 shadow-lg" 
                                 style="background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%); border-radius: 20px; overflow: hidden;">
                                <div class="card-header py-3" 
                                     style="background: linear-gradient(135deg, var(--steel-gray), var(--light-steel)); border: none;">
                                    <h6 class="text-white mb-0 font-weight-bold">
                                        <i class="fas fa-bolt me-2"></i>Aksi Cepat
                                    </h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin.dashboard') }}" 
                                           class="btn btn-outline-primary btn-sm" 
                                           style="border-radius: 10px; border: 2px solid var(--primary-blue); color: var(--primary-blue); transition: all 0.3s ease;"
                                           onmouseover="this.style.background='var(--primary-blue)'; this.style.color='white'"
                                           onmouseout="this.style.background='transparent'; this.style.color='var(--primary-blue)'">
                                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                        </a>
                                        <a href="{{ route('admin.participant.index') }}" 
                                           class="btn btn-outline-success btn-sm" 
                                           style="border-radius: 10px; border: 2px solid var(--success-green); color: var(--success-green); transition: all 0.3s ease;"
                                           onmouseover="this.style.background='var(--success-green)'; this.style.color='white'"
                                           onmouseout="this.style.background='transparent'; this.style.color='var(--success-green)'">
                                            <i class="fas fa-users me-2"></i>Kelola Peserta
                                        </a>
                                        <a href="{{ route('admin.trainings.index') }}" 
                                           class="btn btn-outline-warning btn-sm" 
                                           style="border-radius: 10px; border: 2px solid var(--warning-orange); color: var(--warning-orange); transition: all 0.3s ease;"
                                           onmouseover="this.style.background='var(--warning-orange)'; this.style.color='white'"
                                           onmouseout="this.style.background='transparent'; this.style.color='var(--warning-orange)'">
                                            <i class="fas fa-chalkboard-teacher me-2"></i>Pelatihan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Enhanced auto dismiss alerts
    setTimeout(function() {
        $('.alert').fadeOut(600);
    }, 5000);

    // Add hover effects to form inputs
    document.querySelectorAll('input.form-control').forEach(function(input) {
        input.addEventListener('focus', function() {
            this.style.borderColor = 'var(--warning-orange)';
            this.style.boxShadow = '0 0 0 0.2rem rgba(255, 140, 0, 0.25)';
            this.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.style.borderColor = '#e2e8f0';
            this.style.boxShadow = 'none';
            this.style.transform = 'scale(1)';
        });
    });

    // Add loading state to submit button
    document.querySelector('form').addEventListener('submit', function() {
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
        
        // Re-enable after 3 seconds to prevent permanent disable on error
        setTimeout(function() {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 3000);
    });

    // Password strength indicator
    document.getElementById('new_password').addEventListener('input', function() {
        const password = this.value;
        const strengthIndicator = document.getElementById('password-strength');
        
        if (password.length > 0) {
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            const colors = ['#dc3545', '#fd7e14', '#ffc107', '#20c997', '#28a745'];
            const texts = ['Sangat Lemah', 'Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'];
            
            if (!strengthIndicator) {
                const indicator = document.createElement('div');
                indicator.id = 'password-strength';
                indicator.className = 'mt-2 small';
                this.parentNode.appendChild(indicator);
            }
            
            document.getElementById('password-strength').innerHTML = 
                `<i class="fas fa-shield-alt me-1"></i>Kekuatan Password: 
                <span style="color: ${colors[strength-1] || colors[0]}">${texts[strength-1] || texts[0]}</span>`;
        } else {
            const strengthIndicator = document.getElementById('password-strength');
            if (strengthIndicator) strengthIndicator.remove();
        }
    });
</script>
@endpush
@endsection