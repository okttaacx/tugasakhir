@extends('layouts.appuser')

@section('content')
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
        --error-red: #e53e3e;
    }

    body {
        background: linear-gradient(135deg, var(--metallic-silver) 0%, #f7fafc 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--dark-steel);
    }

    .content {
    position: relative;
    z-index: 1;
}

.form-container {
    position: relative;
    z-index: 2;
}

/* Pastikan konten tidak tersembunyi oleh navbar */
.content {
    padding-top: 0;
    margin-top: 0;
}

/* Override any conflicting display properties */
.page-transition {
    display: block !important;
    visibility: visible !important;
}

.form-container,
.page-header {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

/* Fix for potential overflow issues */
body {
    overflow-x: auto;
    overflow-y: auto;
}

.container {
    overflow: visible;
}

/* Ensure form sections are visible */
.form-section {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

/* Debug helper - tambahkan class ini sementara untuk debugging */
.debug-visible {
    border: 2px solid red !important;
    background: rgba(255, 0, 0, 0.1) !important;
    min-height: 50px !important;
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

    /* Header Styles */
    .page-header {
        background: 
            linear-gradient(135deg, 
                rgba(1, 62, 126, 0.95) 0%, 
                rgba(0, 86, 179, 0.9) 50%, 
                rgba(0, 123, 255, 0.85) 100%
            ),
            url('{{ asset("image/maxresdefault.jpg") }}');
        background-size: cover;
        background-position: center;
        padding: 80px 0;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .page-header::before {
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
                rgba(255, 255, 255, 0.03) 2px,
                rgba(255, 255, 255, 0.03) 4px
            );
        z-index: 1;
    }

    .page-header::after {
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

    .page-header .container {
        position: relative;
        z-index: 3;
    }

    .page-title {
        font-size: 3rem;
        color: var(--text-white);
        font-weight: 800;
        text-shadow: 
            0 4px 8px rgba(0, 0, 0, 0.5),
            0 2px 4px rgba(0, 0, 0, 0.3);
        letter-spacing: -1px;
        margin-bottom: 20px;
    }

    .page-subtitle {
        color: var(--text-light);
        font-size: 1.2rem;
        line-height: 1.6;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* Form Container */
    .form-container {
        background: 
            linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 20px;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.15),
            0 8px 24px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
        position: relative;
        overflow: hidden;
        margin: -60px auto 50px;
        max-width: 1200px;
        border: 1px solid rgba(255, 255, 255, 0.2);
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
            var(--accent-blue) 50%, 
            var(--warning-orange) 100%);
    }

    /* Section Headers */
    .section-header {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        color: var(--text-white);
        padding: 20px 30px;
        margin: 0 -30px 30px;
        position: relative;
        overflow: hidden;
    }

    .section-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 60px;
        height: 100%;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1));
        transform: skewX(-20deg);
    }

    .section-header h2 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .section-header h2 i {
        font-size: 1.5rem;
        color: var(--warning-orange);
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group label {
        font-weight: 600;
        color: var(--dark-steel);
        margin-bottom: 8px;
        display: block;
        position: relative;
        font-size: 0.95rem;
    }

    .form-group label::before {
        content: '';
        position: absolute;
        left: -15px;
        top: 50%;
        width: 4px;
        height: 4px;
        background: var(--warning-orange);
        border-radius: 50%;
        transform: translateY(-50%);
    }

    /* Input Styles */
    .form-control {
        border: 2px solid var(--metallic-silver);
        border-radius: 12px;
        padding: 12px 18px;
        font-size: 0.95rem;
        transition: var(--transition);
        background: 
            linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        box-shadow: 
            inset 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .form-control:focus {
        border-color: var(--accent-blue);
        box-shadow: 
            0 0 0 3px rgba(0, 123, 255, 0.15),
            inset 0 2px 4px rgba(0, 0, 0, 0.05);
        background: #ffffff;
        transform: translateY(-2px);
    }

    .form-control::placeholder {
        color: var(--light-steel);
        opacity: 0.7;
    }

    /* Radio and Checkbox Styles */
    .radio-group, .checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 10px;
    }

    .radio-item, .checkbox-item {
        display: flex;
        align-items: center;
        background: 
            linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        padding: 12px 18px;
        border-radius: 12px;
        border: 2px solid var(--metallic-silver);
        transition: var(--transition);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .radio-item::before, .checkbox-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--accent-blue), var(--primary-blue));
        opacity: 0;
        transition: var(--transition);
        z-index: -1;
    }

    .radio-item:hover, .checkbox-item:hover {
        border-color: var(--accent-blue);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 123, 255, 0.15);
    }

    .radio-item input[type="radio"]:checked + span,
    .checkbox-item input[type="checkbox"]:checked + span {
        color: var(--text-white);
        font-weight: 600;
    }

    .radio-item:has(input:checked)::before,
    .checkbox-item:has(input:checked)::before {
        opacity: 1;
    }

    .radio-item:has(input:checked),
    .checkbox-item:has(input:checked) {
        border-color: var(--primary-blue);
        box-shadow: 0 8px 24px rgba(1, 62, 126, 0.25);
    }

    input[type="radio"], input[type="checkbox"] {
        width: 20px;
        height: 20px;
        margin-right: 12px;
        accent-color: var(--primary-blue);
    }

    /* Gender Inputs */
    .gender-inputs {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 20px;
        margin-top: 15px;
    }

    @media (max-width: 768px) {
        .gender-inputs {
            grid-template-columns: 1fr;
        }
    }

    /* Conditional Fields */
    .conditional-field {
        display: none;
        margin-left: 20px;
        margin-top: 15px;
        padding: 20px;
        background: rgba(0, 123, 255, 0.05);
        border-radius: 12px;
        border-left: 4px solid var(--accent-blue);
    }

    /* Dynamic Fields */
    .pengurus-item {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
        align-items: end;
    }

    .pengurus-item .form-control {
        flex: 1;
    }

    /* Buttons */
    .btn {
        border-radius: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        border: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        color: var(--text-white);
        padding: 15px 40px;
        font-size: 1.1rem;
        box-shadow: 0 8px 25px rgba(1, 62, 126, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(1, 62, 126, 0.4);
    }

    .btn-secondary {
        background: linear-gradient(135deg, var(--steel-gray), var(--dark-steel));
        color: var(--text-white);
        padding: 8px 16px;
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, var(--dark-steel), var(--carbon-black));
        transform: translateY(-2px);
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--error-red), #c53030);
        color: var(--text-white);
        padding: 8px 16px;
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, #c53030, #9c2828);
        transform: translateY(-2px);
    }

    .btn-success {
        background: linear-gradient(135deg, var(--success-green), #2f855a);
        color: var(--text-white);
        padding: 12px 30px;
    }

    /* Alert */
    .alert {
        border: none;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .alert-danger {
        background: linear-gradient(135deg, rgba(229, 62, 62, 0.1), rgba(197, 48, 48, 0.05));
        color: var(--error-red);
        border-left: 4px solid var(--error-red);
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    .alert li {
        margin-bottom: 5px;
        font-weight: 500;
    }

    /* Notification Card */
    #notificationCard {
        display: none;
        position: fixed;
        top: 20%;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1050;
        width: 90%;
        max-width: 500px;
    }

    #notificationCard .card {
        background: 
            linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: none;
        border-radius: 16px;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.25),
            0 8px 24px rgba(0, 0, 0, 0.15);
        padding: 30px;
        text-align: center;
    }

    #notificationCard .card-text {
        font-size: 1.1rem;
        color: var(--dark-steel);
        margin-bottom: 20px;
    }

    /* Industrial Accents */
    .industrial-accent {
        position: relative;
    }

    .industrial-accent::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 20px;
        height: 20px;
        background: var(--warning-orange);
        clip-path: polygon(0 0, 100% 0, 100% 100%);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }
        
        .form-container {
            margin: -30px 15px 30px;
            padding: 20px;
        }
        
        .section-header {
            margin: 0 -20px 20px;
            padding: 15px 20px;
        }
        
        .radio-group, .checkbox-group {
            flex-direction: column;
            gap: 10px;
        }
        
        .radio-item, .checkbox-item {
            justify-content: flex-start;
        }
    }

    /* Animation */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slide-in {
        animation: slideInUp 0.6s ease-out;
    }

    .form-section {
        animation: slideInUp 0.6s ease-out;
        animation-fill-mode: both;
    }

    .form-section:nth-child(2) { animation-delay: 0.1s; }
    .form-section:nth-child(3) { animation-delay: 0.2s; }
    .form-section:nth-child(4) { animation-delay: 0.3s; }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container text-center">
        <h1 class="page-title">
            <i class="fas fa-file-alt mr-3" style="color: var(--warning-orange);"></i>
            BENTUK LAPORAN
        </h1>
        <p class="page-subtitle">
            Undang Undang Nomor 13 tahun 2003 tentang Ketenagakerjaan dan Undang Undang Nomor 6 Tahun 2023
        </p>
    </div>
</div>

<!-- Form Container -->
<div class="container">
    <div class="form-container p-4">
        
        @if ($errors->any())
            <div class="alert alert-danger industrial-accent">
                <h5><i class="fas fa-exclamation-triangle mr-2"></i>Terdapat Kesalahan:</h5>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="laporanForm" action="{{ route('pelaporan.store') }}" method="post">
            @csrf
            
            <!-- Section A: Company Information -->
            <div class="form-section">
                <div class="section-header">
                    <h2><i class="fas fa-building"></i>A. KEADAAN PERUSAHAAN</h2>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NamaPengelola">Nama Pengelola</label>
                            <input type="text" class="form-control" id="NamaPengelola" name="NamaPengelola" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="namaPerusahaan">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="namaPerusahaan" name="namaPerusahaan" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamatPerusahaan">Alamat Perusahaan</label>
                    <input type="text" class="form-control" id="alamatPerusahaan" name="alamatPerusahaan" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="noTelp">No Telp/Fax</label>
                            <input type="text" class="form-control" id="noTelp" name="noTelp" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kodePos">Kode Pos</label>
                            <input type="text" class="form-control" id="kodePos" name="kodePos" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenisUsaha">Jenis Usaha</label>
                            <input type="text" class="form-control" id="jenisUsaha" name="jenisUsaha" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="AsalNegara">Asal Negara</label>
                            <input type="text" class="form-control" id="AsalNegara" name="AsalNegara" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="NamaPemilikPerusahaan">Nama Pemilik Perusahaan</label>
                    <input type="text" class="form-control" id="NamaPemilikPerusahaan" name="NamaPemilikPerusahaan" required>
                </div>

                <div class="form-group">
                    <label for="AlamatPemilikPerusahaan">Alamat Pemilik Perusahaan</label>
                    <input type="text" class="form-control" id="AlamatPemilikPerusahaan" name="AlamatPemilikPerusahaan" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="PendirianPerusahaan">Pendirian Perusahaan</label>
                            <input type="date" class="form-control" id="PendirianPerusahaan" name="PendirianPerusahaan" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="PerpindahanPerusahaan">Perpindahan Perusahaan</label>
                            <input type="date" class="form-control" id="PerpindahanPerusahaan" name="PerpindahanPerusahaan" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status Perusahaan</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="statusPerusahaan" value="Pusat" required>
                            <span>Pusat</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="statusPerusahaan" value="Cabang">
                            <span>Cabang</span>
                        </label>
                    </div>
                </div>

                <h6 class="mt-4 mb-3" style="color: var(--primary-blue); font-weight: 700;">
                    <i class="fas fa-sitemap mr-2"></i>Jumlah Cabang
                </h6>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Indonesia">Indonesia</label>
                            <input type="number" class="form-control" id="Indonesia" name="Indonesia" placeholder="Cabang di Indonesia jika ada" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="LuarIndonesia">Luar Indonesia</label>
                            <input type="number" class="form-control" id="LuarIndonesia" name="LuarIndonesia" placeholder="Cabang di luar Indonesia jika ada" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status Kepemilikan</label>
                    <div class="checkbox-group">
                        <label class="checkbox-item"><input type="checkbox" name="statusKepemilikan[]" value="Swasta"><span>Swasta</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="statusKepemilikan[]" value="Persero"><span>Persero</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="statusKepemilikan[]" value="Perum"><span>Perum</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="statusKepemilikan[]" value="Perseorangan"><span>Perseorangan</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="statusKepemilikan[]" value="Patungan"><span>Patungan</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="statusKepemilikan[]" value="Perusahaan Daerah"><span>Perusahaan Daerah</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="statusKepemilikan[]" value="Yayasan"><span>Yayasan</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="statusKepemilikan[]" value="Koperasi"><span>Koperasi</span></label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status Permodalan</label>
                    <div class="checkbox-group">
                        <label class="checkbox-item"><input type="checkbox" name="statusPermodalan[]" value="PMDN"><span>PMDN</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="statusPermodalan[]" value="Swasta Nasional"><span>Swasta Nasional</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="statusPermodalan[]" value="PMA"><span>PMA</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="statusPermodalan[]" value="Joint Venture"><span>Joint Venture</span></label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Pemodalan</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="Pemodalan" value="Kurang Dari 1 Miliar" required>
                            <span>Kurang Dari 1 Miliar</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="Pemodalan" value="1 Miliar Smpai 5 Miliar">
                            <span>1 Miliar Sampai 5 Miliar</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="Pemodalan" value="Lebih dari 5 Miliar">
                            <span>Lebih dari 5 Miliar</span>
                        </label>
                    </div>
                </div>

                <!-- Pengurus Perusahaan -->
                <div class="form-group">
                    <label>Pengurus Perusahaan</label>
                    <div id="pengurusContainer">
                        <div class="pengurus-item">
                            <input type="text" class="form-control" name="pengurusPerusahaan[]" placeholder="Nama Pengurus">
                            <button type="button" class="btn btn-danger" onclick="removePengurus(this)">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary mt-2" onclick="addPengurus()">
                        <i class="fas fa-plus mr-2"></i>Tambah Pengurus
                    </button>
                </div>
            </div>

            <!-- Section B: Employment Information -->
            <div class="form-section">
                <div class="section-header">
                    <h2><i class="fas fa-users"></i>B. KEADAAN KETENAGAKERJAAN</h2>
                </div>

                <div class="form-group">
                    <label>Waktu Kerja</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="waktuKerjaPria" value="7 jam/hari dan 40 jam/minggu untuk waktu kerja 6 hari/minggu" required>
                            <span>7 jam/hari dan 40 jam/minggu untuk waktu kerja 6 hari/minggu</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="waktuKerjaPria" value="8 jam/hari dan 40 jam/minggu untuk waktu kerja 5 hari/minggu">
                            <span>8 jam/hari dan 40 jam/minggu untuk waktu kerja 5 hari/minggu</span>
                        </label>
                    </div>
                </div>

                <!-- Jumlah Tenaga Kerja -->
                <div class="form-group">
                    <label><i class="fas fa-user-friends mr-2" style="color: var(--warning-orange);"></i>Jumlah Tenaga Kerja</label>
                    <div class="gender-inputs">
                        <div class="form-group">
                            <label for="JumlahTenagaKerjaLaki">Laki-laki</label>
                            <input type="number" class="form-control" id="JumlahTenagaKerjaLaki" name="JumlahTenagaKerjaLaki" min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="JumlahTenagaKerjaPerempuan">Perempuan</label>
                            <input type="number" class="form-control" id="JumlahTenagaKerjaPerempuan" name="JumlahTenagaKerjaPerempuan" min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="JumlahTenagaKerja">Total</label>
                            <input type="number" class="form-control" id="JumlahTenagaKerja" name="JumlahTenagaKerja" readonly style="background: linear-gradient(135deg, var(--warning-orange), var(--industrial-yellow)); color: white; font-weight: bold;">
                        </div>
                    </div>
                </div>

                <!-- Tenaga Kerja Disabilitas -->
                <div class="form-group">
                    <label><i class="fas fa-wheelchair mr-2" style="color: var(--success-green);"></i>Jumlah Tenaga Kerja Disabilitas</label>
                    <div class="gender-inputs">
                        <div class="form-group">
                            <label for="TenagaKerjaDisabilitasLaki">Laki-laki</label>
                            <input type="number" class="form-control" id="TenagaKerjaDisabilitasLaki" name="TenagaKerjaDisabilitasLaki" min="0" value="0" required>
                        </div>
                        <div class="form-group">
                            <label for="TenagaKerjaDisabilitasPerempuan">Perempuan</label>
                            <input type="number" class="form-control" id="TenagaKerjaDisabilitasPerempuan" name="TenagaKerjaDisabilitasPerempuan" min="0" value="0" required>
                        </div>
                        <div></div>
                    </div>
                </div>

                <!-- Pekerja Anak -->
                <div class="form-group">
                    <label><i class="fas fa-child mr-2" style="color: var(--error-red);"></i>Pekerja Anak</label>
                    <div class="gender-inputs">
                        <div class="form-group">
                            <label for="PekerjaAnakLaki">Laki-laki</label>
                            <input type="number" class="form-control" id="PekerjaAnakLaki" name="PekerjaAnakLaki" min="0" value="0" required>
                        </div>
                        <div class="form-group">
                            <label for="PekerjaAnakPerempuan">Perempuan</label>
                            <input type="number" class="form-control" id="PekerjaAnakPerempuan" name="PekerjaAnakPerempuan" min="0" value="0" required>
                        </div>
                        <div></div>
                    </div>
                </div>

                <!-- Tenaga Kerja Asing -->
                <div class="form-group">
                    <label><i class="fas fa-globe mr-2" style="color: var(--accent-blue);"></i>Tenaga Kerja Asing</label>
                    <div class="gender-inputs">
                        <div class="form-group">
                            <label for="TenagaKerjaAsingLaki">Laki-laki</label>
                            <input type="number" class="form-control" id="TenagaKerjaAsingLaki" name="TenagaKerjaAsingLaki" min="0" value="0" required>
                        </div>
                        <div class="form-group">
                            <label for="TenagaKerjaAsingPerempuan">Perempuan</label>
                            <input type="number" class="form-control" id="TenagaKerjaAsingPerempuan" name="TenagaKerjaAsingPerempuan" min="0" value="0" required>
                        </div>
                        <div></div>
                    </div>
                </div>

                <!-- Status Tenaga Kerja PKWT -->
                <div class="form-group">
                    <label><i class="fas fa-file-contract mr-2" style="color: var(--warning-orange);"></i>Jumlah Pekerja Status PKWT</label>
                    <div class="gender-inputs">
                        <div class="form-group">
                            <label for="PKWTLaki">Laki-laki</label>
                            <input type="number" class="form-control" id="PKWTLaki" name="PKWTLaki" min="0" value="0" required>
                        </div>
                        <div class="form-group">
                            <label for="PKWTPerempuan">Perempuan</label>
                            <input type="number" class="form-control" id="PKWTPerempuan" name="PKWTPerempuan" min="0" value="0" required>
                        </div>
                        <div></div>
                    </div>
                </div>

                <!-- Status Tenaga Kerja PKWTT -->
                <div class="form-group">
                    <label><i class="fas fa-file-signature mr-2" style="color: var(--primary-blue);"></i>Jumlah Pekerja Status PKWTT</label>
                    <div class="gender-inputs">
                        <div class="form-group">
                            <label for="PKWTTLaki">Laki-laki</label>
                            <input type="number" class="form-control" id="PKWTTLaki" name="PKWTTLaki" min="0" value="0" required>
                        </div>
                        <div class="form-group">
                            <label for="PKWTTPerempuan">Perempuan</label>
                            <input type="number" class="form-control" id="PKWTTPerempuan" name="PKWTTPerempuan" min="0" value="0" required>
                        </div>
                        <div></div>
                    </div>
                </div>

                <!-- Pengupahan -->
                <h6 class="mt-4 mb-3" style="color: var(--primary-blue); font-weight: 700;">
                    <i class="fas fa-money-bill-wave mr-2"></i>Pengupahan
                </h6>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="PengupahanTertinggi">Tingkat Tertinggi</label>
                            <input type="text" class="form-control" id="PengupahanTertinggi" name="PengupahanTertinggi" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="PengupahanTerendah">Tingkat Terendah</label>
                            <input type="text" class="form-control" id="PengupahanTerendah" name="PengupahanTerendah" required>
                        </div>
                    </div>
                </div>

                <!-- Fasilitas Perusahaan -->
                <h6 class="mt-4 mb-3" style="color: var(--primary-blue); font-weight: 700;">
                    <i class="fas fa-building mr-2"></i>Fasilitas Perusahaan
                </h6>
                
                <div class="form-group">
                    <label><i class="fas fa-hard-hat mr-2" style="color: var(--error-red);"></i>Fasilitas Keselamatan & Kesehatan</label>
                    <div class="checkbox-group">
                        <label class="checkbox-item"><input type="checkbox" name="FasillitasKeselamatan[]" value="Perlindungan Diri"><span>Perlindungan Diri</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="FasillitasKeselamatan[]" value="Pelayanan Kesehatan"><span>Pelayanan Kesehatan</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="FasillitasKeselamatan[]" value="Ruang P3K"><span>Ruang P3K</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="FasillitasKeselamatan[]" value="Alat Pelindung Diri"><span>Alat Pelindung Diri</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="FasillitasKeselamatan[]" value="Penyelenggaraan Makanan"><span>Penyelenggaraan Makanan</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="FasillitasKeselamatan[]" value="Kotak P3K"><span>Kotak P3K</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="FasillitasKeselamatan[]" value="Penanganan Limbah"><span>Penanganan Limbah</span></label>
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-heart mr-2" style="color: var(--success-green);"></i>Fasilitas Kesejahteraan</label>
                    <div class="checkbox-group">
                        <label class="checkbox-item"><input type="checkbox" name="FasilitasKesejahteraan[]" value="Keluarga Berencana"><span>Keluarga Berencana</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="FasilitasKesejahteraan[]" value="Tempat Penitipan Anak"><span>Tempat Penitipan Anak</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="FasilitasKesejahteraan[]" value="Perumahan Pekerja"><span>Perumahan Pekerja</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="FasilitasKesejahteraan[]" value="Fasilitas Ibadah"><span>Fasilitas Ibadah</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="FasilitasKesejahteraan[]" value="Kantin/Catering"><span>Kantin/Catering</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="FasilitasKesejahteraan[]" value="Fasilitas Rekreasi"><span>Fasilitas Rekreasi</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="FasilitasKesejahteraan[]" value="Koperasi"><span>Koperasi</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="FasilitasKesejahteraan[]" value="Ruang Merokok"><span>Ruang Merokok</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="FasilitasKesejahteraan[]" value="Armada Antar Jemput"><span>Armada Antar Jemput</span></label>
                        <label class="checkbox-item"><input type="checkbox" name="FasilitasKesejahteraan[]" value="Fasilitas Kesenian"><span>Fasilitas Kesenian</span></label>
                    </div>
                </div>

                <!-- BPJS Sections -->
                <h6 class="mt-4 mb-3" style="color: var(--primary-blue); font-weight: 700;">
                    <i class="fas fa-shield-alt mr-2"></i>Jaminan Sosial
                </h6>

                <!-- BPJS Kesehatan -->
                <div class="form-group">
                    <label><i class="fas fa-medkit mr-2" style="color: var(--success-green);"></i>BPJS Kesehatan</label>
                    <div class="gender-inputs">
                        <div class="form-group">
                            <label for="BPJSKesehatanLaki">Laki-laki</label>
                            <input type="number" class="form-control" id="BPJSKesehatanLaki" name="BPJSKesehatanLaki" min="0" value="0" required>
                        </div>
                        <div class="form-group">
                            <label for="BPJSKesehatanPerempuan">Perempuan</label>
                            <input type="number" class="form-control" id="BPJSKesehatanPerempuan" name="BPJSKesehatanPerempuan" min="0" value="0" required>
                        </div>
                        <div></div>
                    </div>
                </div>

                <!-- Program Jaminan Kesehatan (Hidden) -->
                <div class="form-group" style="display: none;">
                    <label>Program Jaminan Kesehatan</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="ProgramJaminanKesehatan" value="Ya" required>
                            <span>Ya</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="ProgramJaminanKesehatan" value="Tidak">
                            <span>Tidak</span>
                        </label>
                    </div>
                </div>

                <!-- BPJS Ketenagakerjaan -->
                <div class="form-group">
                    <label><i class="fas fa-briefcase mr-2" style="color: var(--primary-blue);"></i>BPJS Ketenagakerjaan</label>
                    <div class="gender-inputs">
                        <div class="form-group">
                            <label for="BPJSKetenagakerjaanLaki">Laki-laki</label>
                            <input type="number" class="form-control" id="BPJSKetenagakerjaanLaki" name="BPJSKetenagakerjaanLaki" min="0" value="0" required>
                        </div>
                        <div class="form-group">
                            <label for="BPJSKetenagakerjaanPerempuan">Perempuan</label>
                            <input type="number" class="form-control" id="BPJSKetenagakerjaanPerempuan" name="BPJSKetenagakerjaanPerempuan" min="0" value="0" required>
                        </div>
                        <div></div>
                    </div>
                </div>

                <!-- JKK -->
                <div class="form-group">
                    <label><i class="fas fa-first-aid mr-2" style="color: var(--error-red);"></i>Jaminan Kecelakaan Kerja (JKK)</label>
                    <div class="gender-inputs">
                        <div class="form-group">
                            <label for="JKKLaki">Laki-laki</label>
                            <input type="number" class="form-control" id="JKKLaki" name="JKKLaki" min="0" value="0" required>
                        </div>
                        <div class="form-group">
                            <label for="JKKPerempuan">Perempuan</label>
                            <input type="number" class="form-control" id="JKKPerempuan" name="JKKPerempuan" min="0" value="0" required>
                        </div>
                        <div></div>
                    </div>
                </div>

                <!-- Program JKK (Hidden) -->
                <div class="form-group" style="display: none;">
                    <label>Program Jaminan Kecelakaan Kerja (JKK)</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="ProgramJKK" value="Ya" required>
                            <span>Ya</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="ProgramJKK" value="Tidak">
                            <span>Tidak</span>
                        </label>
                    </div>
                </div>

                <!-- JHT -->
                <div class="form-group">
                    <label><i class="fas fa-calendar mr-2" style="color: var(--warning-orange);"></i>Jaminan Hari Tua (JHT)</label>
                    <div class="gender-inputs">
                        <div class="form-group">
                            <label for="JHTLaki">Laki-laki</label>
                            <input type="number" class="form-control" id="JHTLaki" name="JHTLaki" min="0" value="0" required>
                        </div>
                        <div class="form-group">
                            <label for="JHTPerempuan">Perempuan</label>
                            <input type="number" class="form-control" id="JHTPerempuan" name="JHTPerempuan" min="0" value="0" required>
                        </div>
                        <div></div>
                    </div>
                </div>

                <!-- Program JHT (Hidden) -->
                <div class="form-group" style="display: none;">
                    <label>Program Jaminan Hari Tua (JHT)</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="ProgramJHT" value="Ya" required>
                            <span>Ya</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="ProgramJHT" value="Tidak">
                            <span>Tidak</span>
                        </label>
                    </div>
                </div>

                <!-- JKM -->
                <div class="form-group">
                    <label><i class="fas fa-cross mr-2" style="color: var(--dark-steel);"></i>Jaminan Kematian (JKM)</label>
                    <div class="gender-inputs">
                        <div class="form-group">
                            <label for="JKMLaki">Laki-laki</label>
                            <input type="number" class="form-control" id="JKMLaki" name="JKMLaki" min="0" value="0" required>
                        </div>
                        <div class="form-group">
                            <label for="JKMPerempuan">Perempuan</label>
                            <input type="number" class="form-control" id="JKMPerempuan" name="JKMPerempuan" min="0" value="0" required>
                        </div>
                        <div></div>
                    </div>
                </div>

                <!-- Program JKM (Hidden) -->
                <div class="form-group" style="display: none;">
                    <label>Program Jaminan Kematian (JKM)</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="ProgramJKM" value="Ya" required>
                            <span>Ya</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="ProgramJKM" value="Tidak">
                            <span>Tidak</span>
                        </label>
                    </div>
                </div>

                <!-- JP -->
                <div class="form-group">
                    <label><i class="fas fa-user-clock mr-2" style="color: var(--steel-gray);"></i>Jaminan Pensiun (JP)</label>
                    <div class="gender-inputs">
                        <div class="form-group">
                            <label for="JPLaki">Laki-laki</label>
                            <input type="number" class="form-control" id="JPLaki" name="JPLaki" min="0" value="0" required>
                        </div>
                        <div class="form-group">
                            <label for="JPPerempuan">Perempuan</label>
                            <input type="number" class="form-control" id="JPPerempuan" name="JPPerempuan" min="0" value="0" required>
                        </div>
                        <div></div>
                    </div>
                </div>

                <!-- Program JP (Hidden) -->
                <div class="form-group" style="display: none;">
                    <label>Program Jaminan Pensiun (JP)</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="ProgramJP" value="Ya" required>
                            <span>Ya</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="ProgramJP" value="Tidak">
                            <span>Tidak</span>
                        </label>
                    </div>
                </div>

                <!-- Perangkat Hubungan Industrial -->
                <h6 class="mt-4 mb-3" style="color: var(--primary-blue); font-weight: 700;">
                    <i class="fas fa-handshake mr-2"></i>Perangkat Hubungan Industrial
                </h6>
                
                <div class="form-group">
                    <label>Perangkat Hubungan Industrial</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="PerangkatHub" value="Ya" required>
                            <span>Ya</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="PerangkatHub" value="Tidak">
                            <span>Tidak</span>
                        </label>
                    </div>
                </div>
                
                <!-- PP -->
                <div class="form-group">
                    <label>Peraturan Perusahaan (PP)</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="PP" value="Ada" onchange="togglePPFields()" required>
                            <span>Ada</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="PP" value="Tidak" onchange="togglePPFields()">
                            <span>Tidak</span>
                        </label>
                    </div>
                    <div id="ppFields" class="conditional-field">
                        <label>Sudah didaftar ke Disnaker?</label>
                        <div class="radio-group">
                            <label class="radio-item">
                                <input type="radio" name="PPDaftarDisnaker" value="Sudah">
                                <span>Sudah</span>
                            </label>
                            <label class="radio-item">
                                <input type="radio" name="PPDaftarDisnaker" value="Belum">
                                <span>Belum</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- PKB -->
                <div class="form-group">
                    <label>Perjanjian Kerja Bersama (PKB)</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="PKB" value="Ada" onchange="togglePKBFields()" required>
                            <span>Ada</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="PKB" value="Tidak" onchange="togglePKBFields()">
                            <span>Tidak</span>
                        </label>
                    </div>
                    <div id="pkbFields" class="conditional-field">
                        <label>Sudah didaftar ke Disnaker?</label>
                        <div class="radio-group">
                            <label class="radio-item">
                                <input type="radio" name="PKBDaftarDisnaker" value="Sudah">
                                <span>Sudah</span>
                            </label>
                            <label class="radio-item">
                                <input type="radio" name="PKBDaftarDisnaker" value="Belum">
                                <span>Belum</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- LKS Bipartit -->
                <div class="form-group">
                    <label>LKS Bipartit</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="LKSBipartit" value="Ada" onchange="toggleLKSFields()" required>
                            <span>Ada</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="LKSBipartit" value="Tidak" onchange="toggleLKSFields()">
                            <span>Tidak</span>
                        </label>
                    </div>
                    <div id="lksFields" class="conditional-field">
                        <label>Sudah didaftar ke Disnaker?</label>
                        <div class="radio-group">
                            <label class="radio-item">
                                <input type="radio" name="LKSBipartitDaftarDisnaker" value="Sudah">
                                <span>Sudah</span>
                            </label>
                            <label class="radio-item">
                                <input type="radio" name="LKSBipartitDaftarDisnaker" value="Belum">
                                <span>Belum</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Serikat Pekerja -->
                <div class="form-group">
                    <label>Serikat Pekerja/Buruh</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="SerikatPekerja" value="Ada" onchange="toggleSerikatFields()" required>
                            <span>Ada</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="SerikatPekerja" value="Tidak" onchange="toggleSerikatFields()">
                            <span>Tidak</span>
                        </label>
                    </div>
                    <div id="serikatFields" class="conditional-field">
                        <label>Sudah didaftar ke Disnaker?</label>
                        <div class="radio-group">
                            <label class="radio-item">
                                <input type="radio" name="SerikatPekerjaDaftarDisnaker" value="Sudah">
                                <span>Sudah</span>
                            </label>
                            <label class="radio-item">
                                <input type="radio" name="SerikatPekerjaDaftarDisnaker" value="Belum">
                                <span>Belum</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Koperasi Pekerja -->
                <div class="form-group">
                    <label>Koperasi Pekerja</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="KoperasiPekerja" value="Ada" onchange="toggleKoperasiFields()" required>
                            <span>Ada</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="KoperasiPekerja" value="Tidak" onchange="toggleKoperasiFields()">
                            <span>Tidak</span>
                        </label>
                    </div>
                    <div id="koperasiFields" class="conditional-field">
                        <div class="form-group">
                            <label for="KoperasiTanggalBerdiri">Tanggal Berdiri</label>
                            <input type="date" class="form-control" id="KoperasiTanggalBerdiri" name="KoperasiTanggalBerdiri">
                        </div>
                        <div class="gender-inputs">
                            <div class="form-group">
                                <label for="KoperasiAnggotaLaki">Anggota Laki-laki</label>
                                <input type="number" class="form-control" id="KoperasiAnggotaLaki" name="KoperasiAnggotaLaki" min="0" value="0">
                            </div>
                            <div class="form-group">
                                <label for="KoperasiAnggotaPerempuan">Anggota Perempuan</label>
                                <input type="number" class="form-control" id="KoperasiAnggotaPerempuan" name="KoperasiAnggotaPerempuan" min="0" value="0">
                            </div>
                            <div></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Sudah memiliki perencanaan tenaga kerja?</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="PerangkatHubMemilikiTenagaKerja" value="ya" required>
                            <span>Ya</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="PerangkatHubMemilikiTenagaKerja" value="tidak">
                            <span>Tidak</span>
                        </label>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="JumlahPenerimaan">Jumlah penerimaan Pekerja selama 12 bulan terakhir</label>
                            <input type="number" class="form-control" id="JumlahPenerimaan" name="JumlahPenerimaan" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="JumlahBerhenti">Jumlah Pekerja yang berhenti selama 12 bulan terakhir</label>
                            <input type="number" class="form-control" id="JumlahBerhenti" name="JumlahBerhenti" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Program Pelatihan bagi pekerja</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="ProgramPelatihan" value="ya" required>
                            <span>Ya</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="ProgramPelatihan" value="tidak">
                            <span>Tidak</span>
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Program Pemagangan</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="ProgramPemagangan" value="ya" required>
                            <span>Ya</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="ProgramPemagangan" value="tidak">
                            <span>Tidak</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Section C: Pakta Integritas -->
            <div class="form-section">
                <div class="section-header">
                    <h2><i class="fas fa-balance-scale"></i>C. PAKTA INTEGRITAS</h2>
                </div>
                
                <div style="background: linear-gradient(135deg, rgba(1, 62, 126, 0.05), rgba(0, 123, 255, 0.02)); padding: 25px; border-radius: 12px; border-left: 5px solid var(--primary-blue); margin-bottom: 20px;">
                    <p class="mb-3" style="line-height: 1.6; color: var(--dark-steel);">
                        <strong>Bahwa informasi WLKP online yang kami sampaikan adalah benar, transparan, dan profesional untuk memberikan hasil kerja yang terbaik sesuai ketentuan peraturan perundangan-undangan</strong>
                    </p>
                    <p style="line-height: 1.6; color: var(--dark-steel);">
                        <strong>Apabila informasi yang kami sampaikan ada hal - hal yang melanggar yang dinyatakan dalam pakta integritas ini kami bersedia menerima sanksi administrasi, dan digugat secara perdata dan/ atau dilaporkan secara pidana.</strong>
                    </p>
                </div>
            </div>

            <!-- Section D: Tanggal Lapor -->
            <div class="form-section">
                <div class="section-header">
                    <h2><i class="fas fa-calendar-check"></i>D. TANGGAL LAPOR DAN KEWAJIBAN MELAPOR KEMBALI</h2>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="NomorPelaporan">Nomor Pelaporan</label>
                            <input type="number" class="form-control" id="NomorPelaporan" name="NomorPelaporan" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="TanggalLapor">Tanggal Lapor</label>
                            <input type="number" class="form-control" id="TanggalLapor" name="TanggalLapor" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="KewajibanLaporKembali">Kewajiban Lapor Kembali</label>
                            <input type="number" class="form-control" id="KewajibanLaporKembali" name="KewajibanLaporKembali" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary industrial-accent">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Notification Card -->
<div id="notificationCard">
    <div class="card industrial-accent">
        <div class="card-body">
            <div class="text-center mb-3">
                <i class="fas fa-info-circle" style="font-size: 3rem; color: var(--primary-blue);"></i>
            </div>
            <p class="card-text">Harap ke DISNAKER untuk peninjauan lebih lanjut.</p>
            <button id="okButton" class="btn btn-success">
                <i class="fas fa-check mr-2"></i>OK
            </button>
        </div>
    </div>
</div>

<script>
    // Auto calculate total tenaga kerja
    function calculateTotal() {
        const laki = parseInt(document.getElementById('JumlahTenagaKerjaLaki').value) || 0;
        const perempuan = parseInt(document.getElementById('JumlahTenagaKerjaPerempuan').value) || 0;
        document.getElementById('JumlahTenagaKerja').value = laki + perempuan;
    }

    document.getElementById('JumlahTenagaKerjaLaki').addEventListener('input', calculateTotal);
    document.getElementById('JumlahTenagaKerjaPerempuan').addEventListener('input', calculateTotal);

    // Enhanced Pengurus functions
    function addPengurus() {
        const container = document.getElementById('pengurusContainer');
        const div = document.createElement('div');
        div.className = 'pengurus-item animate-slide-in';
        div.innerHTML = `
            <input type="text" class="form-control" name="pengurusPerusahaan[]" placeholder="Nama Pengurus">
            <button type="button" class="btn btn-danger" onclick="removePengurus(this)">
                <i class="fas fa-trash"></i> Hapus
            </button>
        `;
        container.appendChild(div);
    }

    function removePengurus(button) {
        const container = document.getElementById('pengurusContainer');
        if (container.children.length > 1) {
            button.parentElement.style.opacity = '0';
            button.parentElement.style.transform = 'translateX(-100px)';
            setTimeout(() => {
                button.parentElement.remove();
            }, 300);
        }
    }

    // Enhanced Toggle functions with animations
    function togglePPFields() {
        const ppAda = document.querySelector('input[name="PP"]:checked')?.value === 'Ada';
        const field = document.getElementById('ppFields');
        if (ppAda) {
            field.style.display = 'block';
            setTimeout(() => {
                field.style.opacity = '1';
                field.style.transform = 'translateY(0)';
            }, 10);
        } else {
            field.style.opacity = '0';
            field.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                field.style.display = 'none';
            }, 300);
            document.querySelectorAll('input[name="PPDaftarDisnaker"]').forEach(input => input.checked = false);
        }
    }

    function togglePKBFields() {
        const pkbAda = document.querySelector('input[name="PKB"]:checked')?.value === 'Ada';
        const field = document.getElementById('pkbFields');
        if (pkbAda) {
            field.style.display = 'block';
            setTimeout(() => {
                field.style.opacity = '1';
                field.style.transform = 'translateY(0)';
            }, 10);
        } else {
            field.style.opacity = '0';
            field.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                field.style.display = 'none';
            }, 300);
            document.querySelectorAll('input[name="PKBDaftarDisnaker"]').forEach(input => input.checked = false);
        }
    }

    function toggleLKSFields() {
        const lksAda = document.querySelector('input[name="LKSBipartit"]:checked')?.value === 'Ada';
        const field = document.getElementById('lksFields');
        if (lksAda) {
            field.style.display = 'block';
            setTimeout(() => {
                field.style.opacity = '1';
                field.style.transform = 'translateY(0)';
            }, 10);
        } else {
            field.style.opacity = '0';
            field.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                field.style.display = 'none';
            }, 300);
            document.querySelectorAll('input[name="LKSBipartitDaftarDisnaker"]').forEach(input => input.checked = false);
        }
    }

    function toggleSerikatFields() {
        const serikatAda = document.querySelector('input[name="SerikatPekerja"]:checked')?.value === 'Ada';
        const field = document.getElementById('serikatFields');
        if (serikatAda) {
            field.style.display = 'block';
            setTimeout(() => {
                field.style.opacity = '1';
                field.style.transform = 'translateY(0)';
            }, 10);
        } else {
            field.style.opacity = '0';
            field.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                field.style.display = 'none';
            }, 300);
            document.querySelectorAll('input[name="SerikatPekerjaDaftarDisnaker"]').forEach(input => input.checked = false);
        }
    }

    function toggleKoperasiFields() {
        const koperasiAda = document.querySelector('input[name="KoperasiPekerja"]:checked')?.value === 'Ada';
        const field = document.getElementById('koperasiFields');
        if (koperasiAda) {
            field.style.display = 'block';
            setTimeout(() => {
                field.style.opacity = '1';
                field.style.transform = 'translateY(0)';
            }, 10);
        } else {
            field.style.opacity = '0';
            field.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                field.style.display = 'none';
            }, 300);
            document.getElementById('KoperasiTanggalBerdiri').value = '';
            document.getElementById('KoperasiAnggotaLaki').value = '0';
            document.getElementById('KoperasiAnggotaPerempuan').value = '0';
        }
    }

    // Enhanced Rupiah formatting
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix === undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
    }

    document.getElementById('PengupahanTertinggi').addEventListener('keyup', function(e) {
        this.value = formatRupiah(this.value, 'Rp ');
    });
    document.getElementById('PengupahanTerendah').addEventListener('keyup', function(e) {
        this.value = formatRupiah(this.value, 'Rp ');
    });

    // Enhanced form submission
    document.getElementById('laporanForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Add loading effect to submit button
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
        submitBtn.disabled = true;
        
        // Show notification after delay
        setTimeout(() => {
            document.getElementById('notificationCard').style.display = 'block';
            document.getElementById('notificationCard').style.opacity = '0';
            document.getElementById('notificationCard').style.transform = 'translateX(-50%) translateY(-20px)';
            
            setTimeout(() => {
                document.getElementById('notificationCard').style.opacity = '1';
                document.getElementById('notificationCard').style.transform = 'translateX(-50%) translateY(0)';
            }, 10);
            
            // Reset button
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 1000);
    });

    document.getElementById('okButton').addEventListener('click', function() {
        const card = document.getElementById('notificationCard');
        card.style.opacity = '0';
        card.style.transform = 'translateX(-50%) translateY(-20px)';
        
        setTimeout(() => {
            card.style.display = 'none';
            document.getElementById('laporanForm').submit();
        }, 300);
    });

    // Auto radio button updates (keeping original functionality)
    function updateRadioButton(lakiInputId, perempuanInputId, radioName) {
        const lakiValue = parseInt(document.getElementById(lakiInputId).value) || 0;
        const perempuanValue = parseInt(document.getElementById(perempuanInputId).value) || 0;
        const yaRadio = document.querySelector(`input[name="${radioName}"][value="Ya"]`);
        const tidakRadio = document.querySelector(`input[name="${radioName}"][value="Tidak"]`);

        if (lakiValue > 0 || perempuanValue > 0) {
            yaRadio.checked = true;
            tidakRadio.checked = false;
        } else {
            yaRadio.checked = false;
            tidakRadio.checked = true;
        }
    }

    // Field mappings for auto radio updates
    const fields = [
        { lakiId: 'BPJSKesehatanLaki', perempuanId: 'BPJSKesehatanPerempuan', radioName: 'ProgramJaminanKesehatan' },
        { lakiId: 'JKKLaki', perempuanId: 'JKKPerempuan', radioName: 'ProgramJKK' },
        { lakiId: 'JHTLaki', perempuanId: 'JHTPerempuan', radioName: 'ProgramJHT' },
        { lakiId: 'JKMLaki', perempuanId: 'JKMPerempuan', radioName: 'ProgramJKM' },
        { lakiId: 'JPLaki', perempuanId: 'JPPerempuan', radioName: 'ProgramJP' }
    ];

    // Add event listeners for auto radio updates
    fields.forEach(field => {
        const lakiInput = document.getElementById(field.lakiId);
        const perempuanInput = document.getElementById(field.perempuanId);

        lakiInput.addEventListener('input', () => updateRadioButton(field.lakiId, field.perempuanId, field.radioName));
        perempuanInput.addEventListener('input', () => updateRadioButton(field.lakiId, field.perempuanId, field.radioName));

        // Initialize on page load
        updateRadioButton(field.lakiId, field.perempuanId, field.radioName);
    });

    // Smooth scrolling for form sections
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize conditional field styles
        document.querySelectorAll('.conditional-field').forEach(field => {
            field.style.opacity = '0';
            field.style.transform = 'translateY(-20px)';
            field.style.transition = 'all 0.3s ease';
        });

        // Add ripple effect to interactive elements
        document.querySelectorAll('.radio-item, .checkbox-item, .btn').forEach(item => {
            item.addEventListener('click', function(e) {
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
                    background: rgba(255, 140, 0, 0.3);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple 0.6s ease-out;
                    pointer-events: none;
                `;
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Form validation feedback
        document.querySelectorAll('input, select, textarea').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.checkValidity()) {
                    this.style.borderColor = 'var(--success-green)';
                } else {
                    this.style.borderColor = 'var(--error-red)';
                }
            });

            input.addEventListener('focus', function() {
                this.style.borderColor = 'var(--accent-blue)';
            });
        });
    });

    // Add CSS animation for ripple effect
    const pelaporanStyle = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
</script>
@endsection