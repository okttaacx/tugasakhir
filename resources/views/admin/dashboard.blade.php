@extends('layouts.adminapp')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Enhanced Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--dark-steel) 100%); border-radius: 20px; overflow: hidden;">
                <div class="card-body p-4 position-relative">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="text-white mb-2 fw-bold">
                                <i class="fas fa-tachometer-alt me-3"></i>
                                Selamat Datang, {{ Auth::user()->name }}
                            </h2>
                            <p class="text-white-50 mb-3" id="real-time-clock"></p>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.profile') }}" class="btn btn-warning btn-sm px-4 fw-semibold">
                                    <i class="fas fa-user me-1"></i> View Profile
                                </a>
                                <button class="btn btn-outline-light btn-sm px-4 fw-semibold">
                                    <i class="fas fa-bell me-1"></i> Notifications
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="welcome-graphic">
                                <i class="fas fa-chart-line text-warning" style="font-size: 4rem; opacity: 0.3;"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Decorative Elements -->
                    <div class="position-absolute" style="top: -20px; right: -20px; width: 100px; height: 100px; background: rgba(255, 140, 0, 0.1); border-radius: 50%; transform: rotate(45deg);"></div>
                    <div class="position-absolute" style="bottom: -30px; left: -30px; width: 80px; height: 80px; background: rgba(255, 255, 255, 0.05); border-radius: 50%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #4fc3f7 0%, #29b6f6 100%); border-radius: 16px; overflow: hidden;">
                <div class="card-body text-white position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="card-title text-white-50 mb-1">Peserta Aktif</h6>
                            <h2 class="display-5 fw-bold mb-0">{{ $pencakerCount }}</h2>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-users fa-2x opacity-75"></i>
                        </div>
                    </div>
                    <div class="progress bg-white bg-opacity-25" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: 85%;"></div>
                    </div>
                    <small class="text-white-50 mt-2 d-block">+12% dari bulan lalu</small>
                    <!-- Decorative circle -->
                    <div class="position-absolute" style="top: -15px; right: -15px; width: 60px; height: 60px; background: rgba(255, 255, 255, 0.1); border-radius: 50%;"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #66bb6a 0%, #4caf50 100%); border-radius: 16px; overflow: hidden;">
                <div class="card-body text-white position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="card-title text-white-50 mb-1">Total Pelatihan</h6>
                            <h2 class="display-5 fw-bold mb-0">{{ $trainingCount }}</h2>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-graduation-cap fa-2x opacity-75"></i>
                        </div>
                    </div>
                    <div class="progress bg-white bg-opacity-25" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: 72%;"></div>
                    </div>
                    <small class="text-white-50 mt-2 d-block">+5% dari bulan lalu</small>
                    <div class="position-absolute" style="top: -15px; right: -15px; width: 60px; height: 60px; background: rgba(255, 255, 255, 0.1); border-radius: 50%;"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #ffa726 0%, #ff9800 100%); border-radius: 16px; overflow: hidden;">
                <div class="card-body text-white position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="card-title text-white-50 mb-1">Desa Terbanyak</h6>
                            @if($desaTertinggi)
                                <h5 class="fw-bold mb-1">{{ $desaTertinggi->desa ?: 'Unknown' }}</h5>
                                <p class="h6 mb-0">{{ $desaTertinggi->total_peserta }} Peserta</p>
                            @else
                                <h5 class="fw-bold mb-1">Tidak Ada Data</h5>
                            @endif
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-map-marker-alt fa-2x opacity-75"></i>
                        </div>
                    </div>
                    <div class="progress bg-white bg-opacity-25" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: 90%;"></div>
                    </div>
                    <small class="text-white-50 mt-2 d-block">Lokasi teratas</small>
                    <div class="position-absolute" style="top: -15px; right: -15px; width: 60px; height: 60px; background: rgba(255, 255, 255, 0.1); border-radius: 50%;"></div>
                </div>
            </div>
        </div>

        <!-- Ganti card Status Aktif dengan card Kunjungan Harian -->
<div class="col-xl-3 col-md-6">
    <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #ab47bc 0%, #9c27b0 100%); border-radius: 16px; overflow: hidden;">
        <div class="card-body text-white position-relative">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h6 class="card-title text-white-50 mb-1">Kunjungan Hari Ini</h6>
                    <h2 class="display-5 fw-bold mb-0">{{ number_format($visitorsToday) }}</h2>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-eye fa-2x opacity-75"></i>
                </div>
            </div>
            <div class="progress bg-white bg-opacity-25" style="height: 4px;">
                <div class="progress-bar bg-white" style="width: {{ $visitorsToday > 0 ? min(($visitorsToday / max($visitorsToday, 1)) * 100, 100) : 0 }}%;"></div>
            </div>
            <small class="text-white-50 mt-2 d-block">
                @if($visitChangePercent > 0)
                    +{{ number_format($visitChangePercent, 1) }}% dari kemarin
                @elseif($visitChangePercent < 0)
                    {{ number_format($visitChangePercent, 1) }}% dari kemarin
                @else
                    Sama dengan kemarin
                @endif
            </small>
            <div class="position-absolute" style="top: -15px; right: -15px; width: 60px; height: 60px; background: rgba(255, 255, 255, 0.1); border-radius: 50%;"></div>
        </div>
    </div>
</div>

    <!-- Enhanced Data Tables Row -->
    <div class="row g-4">
        <!-- Peserta Per Desa dan Kecamatan -->
        <div class="col-xl-8">
            <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="card-header border-0 p-4" style="background: linear-gradient(135deg, var(--steel-gray) 0%, var(--dark-steel) 100%);">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="text-white mb-1 fw-bold">
                                <i class="fas fa-chart-bar me-2 text-warning"></i>
                                Distribusi Peserta
                            </h5>
                            <p class="text-white-50 mb-0 small">Data peserta per wilayah</p>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-light btn-sm active" onclick="showTable('desa')">
                                <i class="fas fa-home me-1"></i> Desa
                            </button>
                            <button type="button" class="btn btn-outline-light btn-sm" onclick="showTable('kecamatan')">
                                <i class="fas fa-building me-1"></i> Kecamatan
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <!-- Desa Table -->
                    <div id="desa-table" class="table-container">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                    <tr>
                                        <th class="px-4 py-3 fw-semibold text-dark">
                                            <i class="fas fa-home me-2 text-primary"></i>Desa
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-dark text-center">
                                            <i class="fas fa-users me-2 text-success"></i>Jumlah Peserta
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-dark text-center">Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($desaData as $index => $desa)
                                        <tr class="border-0" style="border-bottom: 1px solid rgba(0,0,0,0.05) !important;">
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                                                        <span class="text-white fw-bold small">{{ $index + 1 }}</span>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-semibold">{{ $desa->desa ?: 'Unknown' }}</h6>
                                                        <small class="text-muted">Wilayah Desa</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold">
                                                    {{ $desa->total }} orang
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-primary" 
                                                         style="width: {{ $desaData->max('total') > 0 ? ($desa->total / $desaData->max('total')) * 100 : 0 }}%;">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Kecamatan Table -->
                    <div id="kecamatan-table" class="table-container" style="display: none;">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                    <tr>
                                        <th class="px-4 py-3 fw-semibold text-dark">
                                            <i class="fas fa-building me-2 text-success"></i>Kecamatan
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-dark text-center">
                                            <i class="fas fa-users me-2 text-success"></i>Jumlah Peserta
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-dark text-center">Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kecamatanData as $index => $kecamatan)
                                        <tr class="border-0" style="border-bottom: 1px solid rgba(0,0,0,0.05) !important;">
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                                                        <span class="text-white fw-bold small">{{ $index + 1 }}</span>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-semibold">{{ $kecamatan->kecamatan ?: 'Unknown' }}</h6>
                                                        <small class="text-muted">Wilayah Kecamatan</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold">
                                                    {{ $kecamatan->total }} orang
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-success" 
                                                         style="width: {{ $kecamatanData->max('total') > 0 ? ($kecamatan->total / $kecamatanData->max('total')) * 100 : 0 }}%;">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Training Participants -->
        <div class="col-xl-4">
            <div class="card border-0 shadow-lg h-100" style="border-radius: 20px; overflow: hidden;">
                <div class="card-header border-0 p-4" style="background: linear-gradient(135deg, var(--warning-orange) 0%, #e65100 100%);">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="text-white mb-1 fw-bold">
                                <i class="fas fa-graduation-cap me-2"></i>
                                Peserta Pelatihan
                            </h5>
                            <p class="text-white-50 mb-0 small">Data per program</p>
                        </div>
                        <i class="fas fa-chart-pie fa-lg text-white opacity-75"></i>
                    </div>
                </div>
                <div class="card-body p-0" style="max-height: 400px; overflow-y: auto;">
                    @forelse($trainingParticipants as $index => $training)
                        <div class="d-flex align-items-center p-4 border-bottom border-light">
                            <div class="bg-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <span class="text-white fw-bold small">{{ $index + 1 }}</span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-semibold">{{ $training->title }}</h6>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-info-subtle text-info px-2 py-1 rounded-pill small fw-semibold">
                                        {{ $training->total_peserta }} peserta
                                    </span>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="progress vertical-progress" style="width: 6px; height: 40px; background: #e9ecef;">
                                    <div class="progress-bar bg-info" 
                                         style="height: {{ $trainingParticipants->max('total_peserta') > 0 ? ($training->total_peserta / $trainingParticipants->max('total_peserta')) * 100 : 0 }}%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-5">
                            <i class="fas fa-exclamation-triangle fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada peserta yang terdaftar.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom progress bar for vertical display */
    .vertical-progress {
        transform: rotate(180deg);
        border-radius: 3px !important;
    }
    
    .vertical-progress .progress-bar {
        border-radius: 0 0 3px 3px !important;
    }

    /* Enhanced table styling */
    .table-container {
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background: rgba(var(--bs-primary-rgb), 0.05) !important;
        transform: translateX(2px);
    }

    /* Button group enhancements */
    .btn-group .btn {
        transition: all 0.3s ease;
    }

    .btn-group .btn:hover {
        transform: translateY(-1px);
    }

    /* Card enhancements */
    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    /* Badge enhancements */
    .badge {
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    /* Statistics card animations */
    .stat-icon {
        transition: all 0.3s ease;
    }

    .card:hover .stat-icon {
        transform: scale(1.1) rotate(5deg);
    }
</style>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // Enhanced clock function
    function updateClock() {
        const now = new Date();
        const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric', 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit',
            timeZone: 'Asia/Jakarta'
        };
        const timeString = now.toLocaleDateString('id-ID', options);
        $('#real-time-clock').text(timeString);
    }

    // Enhanced table switching
    function showTable(type) {
        // Update button states
        $('.btn-group .btn').removeClass('active');
        $(`button[onclick="showTable('${type}')"]`).addClass('active');
        
        // Hide all tables with fade effect
        $('.table-container').fadeOut(200, function() {
            // Show selected table
            $(`#${type}-table`).fadeIn(300);
        });
    }

    // Initialize on document ready
    $(document).ready(function() {
        updateClock();
        setInterval(updateClock, 1000);
        
        // Add smooth scrolling for any anchor links
        $('a[href^="#"]').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if (target.length) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 100
                }, 800);
            }
        });

        // Add loading effect for statistics cards
        $('.card').each(function(index) {
            $(this).css({
                'opacity': '0',
                'transform': 'translateY(20px)'
            });
            $(this).delay(index * 100).animate({
                'opacity': '1',
            }, 600).css('transform', 'translateY(0)');
        });
    });

    console.log('Enhanced Dashboard Loaded Successfully');
</script>
@endpush