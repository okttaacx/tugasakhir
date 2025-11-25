@extends('layouts.adminapp')

@section('title', 'Pelaporan')

@section('content')
<style>
    :root {
        --primary-blue: #013e7e;
        --secondary-blue: #0056b3;
        --warning-orange: #ff8c00;
        --success-green: #38a169;
        --steel-gray: #4a5568;
        --dark-steel: #2d3748;
        --carbon-black: #1a202c;
        --metallic-silver: #e2e8f0;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--dark-steel) 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 15px 35px rgba(1, 62, 126, 0.15);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
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
            rgba(255, 255, 255, 0.05) 2px,
            rgba(255, 255, 255, 0.05) 4px
        );
        pointer-events: none;
    }

    .page-header h2 {
        color: white;
        font-weight: 700;
        font-size: 2.2rem;
        margin: 0;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-header .subtitle {
        color: rgba(255, 255, 255, 0.8);
        margin-top: 0.5rem;
        font-weight: 400;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        border-left: 5px solid var(--warning-orange);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255, 140, 0, 0.1) 0%, transparent 70%);
        transition: all 0.3s ease;
        opacity: 0;
    }

    .stat-card:hover::before {
        opacity: 1;
        transform: scale(1.2);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .stat-icon {
        font-size: 2.5rem;
        color: var(--warning-orange);
        margin-bottom: 1rem;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark-steel);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--steel-gray);
        font-weight: 500;
    }

    .main-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 1px solid rgba(1, 62, 126, 0.1);
    }

    .card-header-custom {
        background: linear-gradient(135deg, var(--carbon-black) 0%, var(--dark-steel) 100%);
        padding: 2rem;
        position: relative;
    }

    .card-header-custom::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--warning-orange), var(--success-green), var(--warning-orange));
    }

    .card-title {
        color: white;
        font-weight: 600;
        font-size: 1.5rem;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .btn-export {
        background: linear-gradient(145deg, var(--success-green), #2f855a);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-export:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(56, 161, 105, 0.3);
        color: white;
    }

    .btn-filter {
        background: linear-gradient(145deg, var(--warning-orange), #e67e22);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 140, 0, 0.3);
    }

    .table-container {
        padding: 2rem;
        overflow-x: auto;
    }

    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .table {
        margin: 0;
        font-size: 0.9rem;
    }

    .table thead {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
    }

    .table thead th {
        color: white;
        font-weight: 600;
        padding: 1rem 0.8rem;
        border: none;
        white-space: nowrap;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background: linear-gradient(90deg, rgba(255, 140, 0, 0.05) 0%, rgba(255, 140, 0, 0.02) 100%);
        transform: scale(1.001);
    }

    .table td {
        padding: 1rem 0.8rem;
        vertical-align: middle;
        border-color: rgba(1, 62, 126, 0.1);
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .table td:hover {
        white-space: normal;
        word-wrap: break-word;
    }

    .id-badge {
        background: linear-gradient(145deg, var(--warning-orange), #e67e22);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-block;
        min-width: 50px;
        text-align: center;
    }

    .status-badge {
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.8rem;
        text-align: center;
    }

    .status-active {
        background: linear-gradient(145deg, var(--success-green), #2f855a);
        color: white;
    }

    .status-inactive {
        background: linear-gradient(145deg, #e53e3e, #c53030);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--steel-gray);
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .search-filter-bar {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        display: flex;
        gap: 1rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-input {
        flex: 1;
        min-width: 250px;
        border: 2px solid rgba(1, 62, 126, 0.1);
        border-radius: 12px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: var(--warning-orange);
        box-shadow: 0 0 0 3px rgba(255, 140, 0, 0.1);
        outline: none;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    .detail-btn {
        background: linear-gradient(145deg, var(--primary-blue), var(--secondary-blue));
        border: none;
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .detail-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(1, 62, 126, 0.3);
        color: white;
    }

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(5px);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .modal-content {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 20px;
        max-width: 90vw;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 25px 80px rgba(0, 0, 0, 0.3);
        position: relative;
        animation: slideIn 0.3s ease;
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: white;
        padding: 1.5rem 2rem;
        border-radius: 20px 20px 0 0;
        position: relative;
        overflow: hidden;
    }

    .modal-header::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--warning-orange), var(--success-green), var(--warning-orange));
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .modal-close {
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        font-size: 1.5rem;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }

    .modal-body {
        padding: 2rem;
    }

    .detail-section {
        background: rgba(1, 62, 126, 0.02);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border-left: 4px solid var(--warning-orange);
    }

    .detail-section h5 {
        color: var(--dark-steel);
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(1, 62, 126, 0.1);
    }

    .detail-label {
        font-weight: 600;
        color: var(--steel-gray);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-value {
        color: var(--dark-steel);
        font-weight: 500;
        text-align: right;
        max-width: 200px;
        word-wrap: break-word;
    }

    .highlight-value {
        background: linear-gradient(145deg, var(--warning-orange), #e67e22);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @media (max-width: 768px) {
        .modal-content {
            max-width: 95vw;
            margin: 0.5rem;
        }
        
        .detail-grid {
            grid-template-columns: 1fr;
        }
        
        .detail-item {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .detail-value {
            text-align: left;
            max-width: none;
        }
    }
</style>

<div class="container-fluid px-4 py-3">
    <!-- Enhanced Page Header -->
    <div class="page-header">
        <h2>
            <i class="fas fa-bullhorn"></i>
            Pelaporan Ketenagakerjaan
        </h2>
        <p class="subtitle">Kelola dan pantau laporan ketenagakerjaan perusahaan</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-number">{{ $pelaporans->count() }}</div>
            <div class="stat-label">Total Laporan</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-building"></i>
            </div>
            <div class="stat-number">{{ $pelaporans->unique('namaPerusahaan')->count() }}</div>
            <div class="stat-label">Perusahaan</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-number">{{ $pelaporans->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
            <div class="stat-label">Laporan Bulan Ini</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-number">{{ $pelaporans->sum('JumlahTenagaKerja') }}</div>
            <div class="stat-label">Total Tenaga Kerja</div>
        </div>
    </div>

    <!-- Search and Filter Bar -->
    <div class="search-filter-bar">
        <input type="text" class="search-input" placeholder="Cari berdasarkan nama perusahaan, pengelola, atau jenis usaha..." id="searchInput">
        <button class="btn btn-filter" onclick="applyFilters()">
            <i class="fas fa-filter"></i> Filter
        </button>
        <button class="btn btn-filter" onclick="resetFilters()" style="background: linear-gradient(145deg, var(--steel-gray), #2d3748);">
            <i class="fas fa-undo"></i> Reset
        </button>
    </div>

    <!-- Main Data Table -->
    <div class="main-card">
        <div class="card-header-custom">
            <div class="card-title">
                <span>
                    <i class="fas fa-table me-2"></i>
                    Data Pelaporan
                </span>
                <div class="action-buttons">
                    <a href="{{ route('pelaporan.export.excel') }}" class="btn-export">
                        <i class="fas fa-file-excel"></i>
                        Export Excel
                    </a>
                    <button class="btn btn-filter" onclick="refreshData()">
                        <i class="fas fa-sync-alt"></i>
                        Refresh
                    </button>
                </div>
            </div>
        </div>
        
        <div class="table-container">
            @if($pelaporans->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover" id="pelaporanTable">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-1"></i>ID</th>
                            <th><i class="fas fa-eye me-1"></i>Aksi</th>
                            <th><i class="fas fa-user me-1"></i>Pengelola</th>
                            <th><i class="fas fa-building me-1"></i>Perusahaan</th>
                            <th><i class="fas fa-map-marker-alt me-1"></i>Alamat</th>
                            <th><i class="fas fa-phone me-1"></i>No Telp</th>
                            <th><i class="fas fa-mail-bulk me-1"></i>Kode Pos</th>
                            <th><i class="fas fa-industry me-1"></i>Jenis Usaha</th>
                            <th><i class="fas fa-crown me-1"></i>Pemilik</th>
                            <th><i class="fas fa-home me-1"></i>Alamat Pemilik</th>
                            <th><i class="fas fa-calendar-plus me-1"></i>Pendirian</th>
                            <th><i class="fas fa-exchange-alt me-1"></i>Perpindahan</th>
                            <th><i class="fas fa-check-circle me-1"></i>Status</th>
                            <th><i class="fas fa-flag me-1"></i>Indonesia</th>
                            <th><i class="fas fa-globe me-1"></i>Luar Indonesia</th>
                            <th><i class="fas fa-ownership me-1"></i>Kepemilikan</th>
                            <th><i class="fas fa-coins me-1"></i>Permodalan</th>
                            <th><i class="fas fa-money-bill me-1"></i>Modal</th>
                            <th><i class="fas fa-flag-usa me-1"></i>Asal Negara</th>
                            <th><i class="fas fa-clock me-1"></i>Waktu Kerja</th>
                            <th><i class="fas fa-users me-1"></i>Jumlah TK</th>
                            <th><i class="fas fa-arrow-up me-1"></i>Upah Tertinggi</th>
                            <th><i class="fas fa-arrow-down me-1"></i>Upah Terendah</th>
                            <th><i class="fas fa-hard-hat me-1"></i>Keselamatan</th>
                            <th><i class="fas fa-heart me-1"></i>Kesejahteraan</th>
                            <th><i class="fas fa-medkit me-1"></i>Jaminan Kesehatan</th>
                            <th><i class="fas fa-shield-alt me-1"></i>JKK</th>
                            <th><i class="fas fa-piggy-bank me-1"></i>JHT</th>
                            <th><i class="fas fa-cross me-1"></i>JKM</th>
                            <th><i class="fas fa-retirement me-1"></i>JP</th>
                            <th><i class="fas fa-network-wired me-1"></i>Perangkat Hub</th>
                            <th><i class="fas fa-user-tie me-1"></i>Perangkat Hub TK</th>
                            <th><i class="fas fa-user-plus me-1"></i>Penerimaan</th>
                            <th><i class="fas fa-user-minus me-1"></i>Berhenti</th>
                            <th><i class="fas fa-graduation-cap me-1"></i>Pelatihan</th>
                            <th><i class="fas fa-handshake me-1"></i>Pemagangan</th>
                            <th><i class="fas fa-barcode me-1"></i>No Pelaporan</th>
                            <th><i class="fas fa-calendar me-1"></i>Tgl Lapor</th>
                            <th><i class="fas fa-redo me-1"></i>Lapor Kembali</th>
                            <th><i class="fas fa-plus-circle me-1"></i>Dibuat</th>
                            <th><i class="fas fa-edit me-1"></i>Diperbarui</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pelaporans as $index => $laporan)
                        <tr>
                            <td><span class="id-badge">{{ $laporan->id }}</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary detail-btn" onclick="showDetail({{ $laporan->id }}, this)" data-laporan="{{ json_encode($laporan) }}">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </td>
                            <td title="{{ $laporan->NamaPengelola }}">{{ Str::limit($laporan->NamaPengelola, 20) }}</td>
                            <td title="{{ $laporan->namaPerusahaan }}">{{ Str::limit($laporan->namaPerusahaan, 20) }}</td>
                            <td title="{{ $laporan->alamatPerusahaan }}">{{ Str::limit($laporan->alamatPerusahaan, 30) }}</td>
                            <td>{{ $laporan->noTelp }}</td>
                            <td>{{ $laporan->kodePos }}</td>
                            <td title="{{ $laporan->jenisUsaha }}">{{ Str::limit($laporan->jenisUsaha, 20) }}</td>
                            <td title="{{ $laporan->NamaPemilikPerusahaan }}">{{ Str::limit($laporan->NamaPemilikPerusahaan, 20) }}</td>
                            <td title="{{ $laporan->AlamatPemilikPerusahaan }}">{{ Str::limit($laporan->AlamatPemilikPerusahaan, 30) }}</td>
                            <td>{{ $laporan->PendirianPerusahaan }}</td>
                            <td>{{ $laporan->PerpindahanPerusahaan }}</td>
                            <td>
                                @if($laporan->statusPerusahaan == 'Aktif')
                                    <span class="status-badge status-active">{{ $laporan->statusPerusahaan }}</span>
                                @else
                                    <span class="status-badge status-inactive">{{ $laporan->statusPerusahaan }}</span>
                                @endif
                            </td>
                            <td>{{ $laporan->Indonesia }}</td>
                            <td>{{ $laporan->LuarIndonesia }}</td>
                            <td title="@if(is_array($laporan->statusKepemilikan)){{ implode(', ', $laporan->statusKepemilikan) }}@else{{ $laporan->statusKepemilikan }}@endif">
                                @if(is_array($laporan->statusKepemilikan))
                                    {{ Str::limit(implode(', ', $laporan->statusKepemilikan), 20) }}
                                @else
                                    {{ Str::limit($laporan->statusKepemilikan, 20) }}
                                @endif
                            </td>
                            <td title="@if(is_array($laporan->statusPermodalan)){{ implode(', ', $laporan->statusPermodalan) }}@else{{ $laporan->statusPermodalan }}@endif">
                                @if(is_array($laporan->statusPermodalan))
                                    {{ Str::limit(implode(', ', $laporan->statusPermodalan), 20) }}
                                @else
                                    {{ Str::limit($laporan->statusPermodalan, 20) }}
                                @endif
                            </td>
                            <td>{{ is_numeric($laporan->Pemodalan) ? number_format($laporan->Pemodalan) : $laporan->Pemodalan }}</td>
                            <td>{{ $laporan->AsalNegara }}</td>
                            <td title="@if(is_array($laporan->waktuKerjaPria)){{ implode(', ', $laporan->waktuKerjaPria) }}@else{{ $laporan->waktuKerjaPria }}@endif">
                                @if(is_array($laporan->waktuKerjaPria))
                                    {{ Str::limit(implode(', ', $laporan->waktuKerjaPria), 15) }}
                                @else
                                    {{ Str::limit($laporan->waktuKerjaPria, 15) }}
                                @endif
                            </td>
                            <td><strong>{{ is_numeric($laporan->JumlahTenagaKerja) ? number_format($laporan->JumlahTenagaKerja) : $laporan->JumlahTenagaKerja }}</strong></td>
                            <td>{{ is_numeric($laporan->PengupahanTertinggi) ? number_format($laporan->PengupahanTertinggi) : $laporan->PengupahanTertinggi }}</td>
                            <td>{{ is_numeric($laporan->PengupahanTerendah) ? number_format($laporan->PengupahanTerendah) : $laporan->PengupahanTerendah }}</td>
                            <td title="@if(is_array($laporan->FasillitasKeselamatan)){{ implode(', ', $laporan->FasillitasKeselamatan) }}@else{{ $laporan->FasillitasKeselamatan }}@endif">
                                @if(is_array($laporan->FasillitasKeselamatan))
                                    {{ Str::limit(implode(', ', $laporan->FasillitasKeselamatan), 20) }}
                                @else
                                    {{ Str::limit($laporan->FasillitasKeselamatan, 20) }}
                                @endif
                            </td>
                            <td title="@if(is_array($laporan->FasilitasKesejahteraan)){{ implode(', ', $laporan->FasilitasKesejahteraan) }}@else{{ $laporan->FasilitasKesejahteraan }}@endif">
                                @if(is_array($laporan->FasilitasKesejahteraan))
                                    {{ Str::limit(implode(', ', $laporan->FasilitasKesejahteraan), 20) }}
                                @else
                                    {{ Str::limit($laporan->FasilitasKesejahteraan, 20) }}
                                @endif
                            </td>
                            <td>{{ $laporan->ProgramJaminanKesehatan }}</td>
                            <td>{{ $laporan->ProgramJKK }}</td>
                            <td>{{ $laporan->ProgramJHT }}</td>
                            <td>{{ $laporan->ProgramJKM }}</td>
                            <td>{{ $laporan->ProgramJP }}</td>
                            <td>{{ $laporan->PerangkatHub }}</td>
                            <td>{{ $laporan->PerangkatHubMemilikiTenagaKerja }}</td>
                            <td>{{ is_numeric($laporan->JumlahPenerimaan) ? number_format($laporan->JumlahPenerimaan) : $laporan->JumlahPenerimaan }}</td>
                            <td>{{ is_numeric($laporan->JumlahBerhenti) ? number_format($laporan->JumlahBerhenti) : $laporan->JumlahBerhenti }}</td>
                            <td>{{ $laporan->ProgramPelatihan }}</td>
                            <td>{{ $laporan->ProgramPemagangan }}</td>
                            <td><code>{{ $laporan->NomorPelaporan }}</code></td>
                            <td>{{ date('d/m/Y', strtotime($laporan->TanggalLapor)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($laporan->KewajibanLaporKembali)) }}</td>
                            <td><small>{{ $laporan->created_at->format('d/m/Y H:i') }}</small></td>
                            <td><small>{{ $laporan->updated_at->format('d/m/Y H:i') }}</small></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h4>Belum Ada Data Pelaporan</h4>
                <p>Data pelaporan ketenagakerjaan akan muncul di sini setelah perusahaan mengirimkan laporan.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Overlay untuk Detail Laporan -->
<div class="modal-overlay" id="detailModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="fas fa-file-alt"></i>
                Detail Laporan Ketenagakerjaan
            </h3>
            <button class="modal-close" onclick="closeDetail()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body" id="modalBody">
            <!-- Content akan diisi oleh JavaScript -->
        </div>
    </div>
</div>

<script>
function showDetail(id, button) {
    const laporan = JSON.parse(button.getAttribute('data-laporan'));
    const modal = document.getElementById('detailModal');
    const modalBody = document.getElementById('modalBody');
    
    // Format array values
    function formatArrayValue(value) {
        if (Array.isArray(value)) {
            return value.join(', ');
        }
        return value || '-';
    }
    
    // Format number values
    function formatNumber(value) {
        if (value && !isNaN(value)) {
            return parseInt(value).toLocaleString('id-ID');
        }
        return value || '-';
    }
    
    // Format date
    function formatDate(dateString) {
        if (dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
        }
        return '-';
    }
    
    modalBody.innerHTML = `
        <!-- Informasi Perusahaan -->
        <div class="detail-section">
            <h5><i class="fas fa-building"></i> Informasi Perusahaan</h5>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-id-badge"></i> ID Laporan</span>
                    <span class="detail-value highlight-value">${laporan.id}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-user"></i> Nama Pengelola</span>
                    <span class="detail-value">${laporan.NamaPengelola || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-building"></i> Nama Perusahaan</span>
                    <span class="detail-value">${laporan.namaPerusahaan || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-map-marker-alt"></i> Alamat Perusahaan</span>
                    <span class="detail-value">${laporan.alamatPerusahaan || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-phone"></i> No Telepon</span>
                    <span class="detail-value">${laporan.noTelp || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-mail-bulk"></i> Kode Pos</span>
                    <span class="detail-value">${laporan.kodePos || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-industry"></i> Jenis Usaha</span>
                    <span class="detail-value">${laporan.jenisUsaha || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-check-circle"></i> Status Perusahaan</span>
                    <span class="detail-value ${laporan.statusPerusahaan === 'Aktif' ? 'highlight-value' : ''}">${laporan.statusPerusahaan || '-'}</span>
                </div>
            </div>
        </div>

        <!-- Informasi Pemilik -->
        <div class="detail-section">
            <h5><i class="fas fa-crown"></i> Informasi Pemilik</h5>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-user-tie"></i> Nama Pemilik</span>
                    <span class="detail-value">${laporan.NamaPemilikPerusahaan || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-home"></i> Alamat Pemilik</span>
                    <span class="detail-value">${laporan.AlamatPemilikPerusahaan || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-calendar-plus"></i> Pendirian Perusahaan</span>
                    <span class="detail-value">${formatDate(laporan.PendirianPerusahaan)}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-exchange-alt"></i> Perpindahan Perusahaan</span>
                    <span class="detail-value">${formatDate(laporan.PerpindahanPerusahaan)}</span>
                </div>
            </div>
        </div>

        <!-- Informasi Kepemilikan dan Modal -->
        <div class="detail-section">
            <h5><i class="fas fa-coins"></i> Kepemilikan & Permodalan</h5>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-flag"></i> Indonesia</span>
                    <span class="detail-value">${laporan.Indonesia || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-globe"></i> Luar Indonesia</span>
                    <span class="detail-value">${laporan.LuarIndonesia || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-handshake"></i> Status Kepemilikan</span>
                    <span class="detail-value">${formatArrayValue(laporan.statusKepemilikan)}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-money-check"></i> Status Permodalan</span>
                    <span class="detail-value">${formatArrayValue(laporan.statusPermodalan)}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-money-bill-wave"></i> Pemodalan</span>
                    <span class="detail-value highlight-value">Rp ${formatNumber(laporan.Pemodalan)}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-flag-usa"></i> Asal Negara</span>
                    <span class="detail-value">${laporan.AsalNegara || '-'}</span>
                </div>
            </div>
        </div>

        <!-- Informasi Tenaga Kerja -->
        <div class="detail-section">
            <h5><i class="fas fa-users"></i> Tenaga Kerja</h5>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-clock"></i> Waktu Kerja</span>
                    <span class="detail-value">${formatArrayValue(laporan.waktuKerjaPria)}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-users"></i> Jumlah Tenaga Kerja</span>
                    <span class="detail-value highlight-value">${formatNumber(laporan.JumlahTenagaKerja)} orang</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-arrow-up"></i> Pengupahan Tertinggi</span>
                    <span class="detail-value">Rp ${formatNumber(laporan.PengupahanTertinggi)}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-arrow-down"></i> Pengupahan Terendah</span>
                    <span class="detail-value">Rp ${formatNumber(laporan.PengupahanTerendah)}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-user-plus"></i> Jumlah Penerimaan</span>
                    <span class="detail-value">${formatNumber(laporan.JumlahPenerimaan)} orang</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-user-minus"></i> Jumlah Berhenti</span>
                    <span class="detail-value">${formatNumber(laporan.JumlahBerhenti)} orang</span>
                </div>
            </div>
        </div>

        <!-- Fasilitas dan Jaminan -->
        <div class="detail-section">
            <h5><i class="fas fa-shield-alt"></i> Fasilitas & Jaminan</h5>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-hard-hat"></i> Fasilitas Keselamatan</span>
                    <span class="detail-value">${formatArrayValue(laporan.FasillitasKeselamatan)}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-heart"></i> Fasilitas Kesejahteraan</span>
                    <span class="detail-value">${formatArrayValue(laporan.FasilitasKesejahteraan)}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-medkit"></i> Program Jaminan Kesehatan</span>
                    <span class="detail-value">${laporan.ProgramJaminanKesehatan || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-shield-alt"></i> Program JKK</span>
                    <span class="detail-value">${laporan.ProgramJKK || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-piggy-bank"></i> Program JHT</span>
                    <span class="detail-value">${laporan.ProgramJHT || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-cross"></i> Program JKM</span>
                    <span class="detail-value">${laporan.ProgramJKM || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-retirement"></i> Program JP</span>
                    <span class="detail-value">${laporan.ProgramJP || '-'}</span>
                </div>
            </div>
        </div>

        <!-- Pelatihan dan Perangkat Hub -->
        <div class="detail-section">
            <h5><i class="fas fa-graduation-cap"></i> Pelatihan & Perangkat Hubungan</h5>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-network-wired"></i> Perangkat Hub</span>
                    <span class="detail-value">${laporan.PerangkatHub || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-user-tie"></i> Perangkat Hub Tenaga Kerja</span>
                    <span class="detail-value">${laporan.PerangkatHubMemilikiTenagaKerja || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-graduation-cap"></i> Program Pelatihan</span>
                    <span class="detail-value">${laporan.ProgramPelatihan || '-'}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-handshake"></i> Program Pemagangan</span>
                    <span class="detail-value">${laporan.ProgramPemagangan || '-'}</span>
                </div>
            </div>
        </div>

        <!-- Informasi Pelaporan -->
        <div class="detail-section">
            <h5><i class="fas fa-file-signature"></i> Informasi Pelaporan</h5>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-barcode"></i> Nomor Pelaporan</span>
                    <span class="detail-value"><code>${laporan.NomorPelaporan || '-'}</code></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-calendar"></i> Tanggal Lapor</span>
                    <span class="detail-value">${formatDate(laporan.TanggalLapor)}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-redo"></i> Kewajiban Lapor Kembali</span>
                    <span class="detail-value">${formatDate(laporan.KewajibanLaporKembali)}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-plus-circle"></i> Tanggal Dibuat</span>
                    <span class="detail-value">${formatDate(laporan.created_at)}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-edit"></i> Terakhir Diperbarui</span>
                    <span class="detail-value">${formatDate(laporan.updated_at)}</span>
                </div>
            </div>
        </div>
    `;
    
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeDetail() {
    const modal = document.getElementById('detailModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDetail();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDetail();
    }
});

function refreshData() {
    location.reload();
}

function applyFilters() {
    const searchInput = document.getElementById('searchInput');
    const searchTerm = searchInput.value.toLowerCase();
    const table = document.getElementById('pelaporanTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const cells = row.getElementsByTagName('td');
        let found = false;

        // Search in nama pengelola, nama perusahaan, dan jenis usaha (kolom 1, 2, 6)
        for (let j of [1, 2, 6]) {
            if (cells[j] && cells[j].textContent.toLowerCase().includes(searchTerm)) {
                found = true;
                break;
            }
        }

        row.style.display = found ? '' : 'none';
    }
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    const table = document.getElementById('pelaporanTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    for (let i = 0; i < rows.length; i++) {
        rows[i].style.display = '';
    }
}

// Real-time search
document.getElementById('searchInput').addEventListener('input', applyFilters);

// Add loading animation for export button
document.querySelector('.btn-export').addEventListener('click', function() {
    const btn = this;
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengunduh...';
    btn.style.pointerEvents = 'none';
    
    setTimeout(() => {
        btn.innerHTML = originalText;
        btn.style.pointerEvents = 'auto';
    }, 3000);
});
</script>
@endsection