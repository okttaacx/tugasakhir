@extends('layouts.adminapp')

@section('title', 'Manajemen Peserta Pelatihan')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-2 text-gray-800 font-weight-bold">
                        <i class="fas fa-users text-warning me-2"></i>
                        Manajemen Peserta Pelatihan
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.trainings.index') }}">Pelatihan</a></li>
                            <li class="breadcrumb-item active">{{ $training->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.trainings.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Training Info Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body bg-gradient-primary text-white" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="card-title mb-2">{{ $training->title }}</h4>
                            <p class="card-text mb-0 opacity-75">
                                <i class="fas fa-calendar-alt me-2"></i>
                                {{ \Carbon\Carbon::parse($training->start_date)->format('d M Y') }} - 
                                {{ \Carbon\Carbon::parse($training->end_date)->format('d M Y') }}
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="d-inline-block">
                                <span class="badge bg-warning fs-6 px-3 py-2">
                                    <i class="fas fa-user-graduate me-1"></i>
                                    {{ $participants->count() }} Peserta
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter and Actions Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-filter text-primary me-2"></i>
                                Filter & Pencarian
                            </h5>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <form action="{{ route('admin.participant.export', $training->id) }}" method="GET" class="d-inline">
                                <input type="hidden" name="universal_search" value="{{ request('universal_search') }}">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-file-csv me-2"></i>Export CSV
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="filterForm" action="{{ route('trainings.participants', $training->id) }}" method="GET">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input type="text" 
                                           name="universal_search" 
                                           id="universal_search" 
                                           class="form-control border-start-0" 
                                           placeholder="Cari berdasarkan nama atau email peserta..."
                                           value="{{ request('universal_search') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-search me-2"></i>Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Summary -->
    @if(request('universal_search'))
    <div class="row mb-3">
        <div class="col-12">
            <div class="alert alert-info border-0 shadow-sm">
                <i class="fas fa-info-circle me-2"></i>
                Menampilkan <strong>{{ $participants->total() }}</strong> hasil untuk pencarian 
                "<strong>{{ request('universal_search') }}</strong>"
                <a href="{{ route('trainings.participants', $training->id) }}" class="btn btn-sm btn-outline-info ms-2">
                    <i class="fas fa-times me-1"></i>Reset
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Participants Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-table text-primary me-2"></i>
                        Daftar Peserta
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="px-4 py-3">
                                        <i class="fas fa-user me-2"></i>Nama
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <i class="fas fa-envelope me-2"></i>Email
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <i class="fas fa-id-card me-2"></i>NIK
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <i class="fas fa-birthday-cake me-2"></i>TTL
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <i class="fas fa-calendar-alt me-2"></i>Umur
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <i class="fas fa-venus-mars me-2"></i>Gender
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <i class="fas fa-map-marker-alt me-2"></i>Alamat
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <i class="fas fa-graduation-cap me-2"></i>Pendidikan
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <i class="fas fa-phone me-2"></i>Telepon
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center">
                                        <i class="fas fa-cogs me-2"></i>Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($participants as $participant)
                                <tr class="border-bottom">
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-sm rounded-circle bg-primary text-white d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 font-weight-bold">
                                                    {{ $participant->profile->name ?? 'N/A' }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-muted">{{ $participant->email }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <code class="bg-light px-2 py-1 rounded">
                                            {{ substr($participant->profile->nik ?? 'N/A', 0, 5) . str_repeat('*', max(0, strlen($participant->profile->nik ?? '') - 5)) }}
                                        </code>
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $participant->profile->ttl ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($participant->profile->ttl)
                                            @php
                                                $birthday = new DateTime($participant->profile->ttl);
                                                $today = new DateTime();
                                                $age = $today->diff($birthday)->y;
                                            @endphp
                                            <span class="badge bg-info">{{ $age }} tahun</span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($participant->profile->gender)
                                            <span class="badge {{ $participant->profile->gender == 'L' ? 'bg-primary' : 'bg-pink' }}">
                                                <i class="fas {{ $participant->profile->gender == 'L' ? 'fa-mars' : 'fa-venus' }} me-1"></i>
                                                {{ $participant->profile->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                            </span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="small">
                                            @if($participant->profile->jalan || $participant->profile->desa || $participant->profile->kecamatan)
                                                <div>{{ $participant->profile->jalan ?? '' }}</div>
                                                <div class="text-muted">{{ $participant->profile->desa ?? '' }}, {{ $participant->profile->kecamatan ?? '' }}</div>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($participant->profile->pendidikan)
                                            <span class="badge bg-success">{{ $participant->profile->pendidikan }}</span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($participant->profile->nomor)
                                            <a href="tel:{{ $participant->profile->nomor }}" class="text-decoration-none">
                                                <i class="fas fa-phone-alt me-1"></i>{{ $participant->profile->nomor }}
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ route('admin.participant.show', $participant->id) }}" 
                                           class="btn btn-outline-info btn-sm"
                                           data-bs-toggle="tooltip" 
                                           title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Tidak ada peserta ditemukan</h5>
                                            <p class="text-muted mb-0">
                                                @if(request('universal_search'))
                                                    Coba gunakan kata kunci yang berbeda atau 
                                                    <a href="{{ route('trainings.participants', $training->id) }}">reset pencarian</a>
                                                @else
                                                    Belum ada peserta yang terdaftar untuk pelatihan ini.
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Remove pagination section entirely since we don't know the collection type -->
            </div>
        </div>
    </div>
</div>

<style>
.avatar-sm {
    width: 2.5rem;
    height: 2.5rem;
}

.bg-pink {
    background-color: #e83e8c !important;
}

.empty-state {
    padding: 2rem;
}

.table th {
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

.input-group-text {
    background-color: #f8f9fa;
    border-color: #ced4da;
}

.breadcrumb-item a {
    color: var(--primary-blue);
    text-decoration: none;
}

.breadcrumb-item a:hover {
    color: var(--warning-orange);
}

@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .px-4 {
        padding-left: 0.75rem !important;
        padding-right: 0.75rem !important;
    }
}
</style>
@endsection