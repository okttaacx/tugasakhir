@extends('layouts.adminapp')

@section('title', 'Edit Pelatihan')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h1 class="page-title">
                            <i class="fas fa-edit text-warning me-3"></i>
                            Edit Pelatihan
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.trainings.index') }}">Pelatihan</a>
                                </li>
                                <li class="breadcrumb-item active">Edit: {{ $training->title }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="page-actions">
                        <a href="{{ route('admin.trainings.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Form Card -->
    <div class="row">
        <div class="col-12">
            <div class="card industrial-card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="card-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">Form Edit Pelatihan</h5>
                            <small class="text-muted">Perbarui informasi pelatihan</small>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('trainings.update', $training->id) }}" method="POST" enctype="multipart/form-data" id="trainingForm">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <i class="fas fa-info-circle"></i>
                                <h6>Informasi Dasar</h6>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="title" class="form-label required">
                                            <i class="fas fa-heading me-2"></i>Judul Pelatihan
                                        </label>
                                        <input type="text" 
                                               class="form-control industrial-input" 
                                               id="title" 
                                               name="title" 
                                               value="{{ $training->title }}" 
                                               required>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="capacity" class="form-label required">
                                            <i class="fas fa-users me-2"></i>Kapasitas
                                        </label>
                                        <input type="number" 
                                               class="form-control industrial-input" 
                                               id="capacity" 
                                               name="capacity" 
                                               value="{{ $training->capacity }}" 
                                               required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label">
                                    <i class="fas fa-align-left me-2"></i>Deskripsi
                                </label>
                                <textarea class="form-control industrial-textarea" 
                                          id="description" 
                                          name="description" 
                                          rows="4">{{ $training->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="location" class="form-label required">
                                    <i class="fas fa-map-marker-alt me-2"></i>Lokasi
                                </label>
                                <input type="text" 
                                       class="form-control industrial-input" 
                                       id="location" 
                                       name="location" 
                                       value="{{ $training->location }}" 
                                       required>
                            </div>
                        </div>

                        <!-- Schedule Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <i class="fas fa-calendar-alt"></i>
                                <h6>Jadwal Pelatihan</h6>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date" class="form-label required">
                                            <i class="fas fa-calendar-plus me-2"></i>Tanggal Mulai
                                        </label>
                                        <input type="date" 
                                               class="form-control industrial-input" 
                                               id="start_date" 
                                               name="start_date" 
                                               value="{{ \Carbon\Carbon::parse($training->start_date)->format('Y-m-d') }}" 
                                               required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_time" class="form-label required">
                                            <i class="fas fa-clock me-2"></i>Waktu Mulai
                                        </label>
                                        <input type="time" 
                                               class="form-control industrial-input" 
                                               id="start_time" 
                                               name="start_time" 
                                               value="{{ $training->start_time }}" 
                                               required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date" class="form-label">
                                            <i class="fas fa-calendar-minus me-2"></i>Tanggal Selesai
                                        </label>
                                        <input type="date" 
                                               class="form-control industrial-input" 
                                               id="end_date" 
                                               name="end_date" 
                                               value="{{ $training->end_date ? \Carbon\Carbon::parse($training->end_date)->format('Y-m-d') : '' }}">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_time" class="form-label">
                                            <i class="fas fa-clock me-2"></i>Waktu Selesai
                                        </label>
                                        <input type="time" 
                                               class="form-control industrial-input" 
                                               id="end_time" 
                                               name="end_time" 
                                               value="{{ $training->end_time }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Images Management Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <i class="fas fa-images"></i>
                                <h6>Manajemen Gambar</h6>
                            </div>

                            <!-- Existing Images -->
                            @if($training->images->count() > 0 || $training->image)
                                <div class="existing-images-section">
                                    <h6 class="section-subtitle">
                                        <i class="fas fa-folder-open me-2"></i>Gambar Saat Ini
                                    </h6>
                                    <div class="images-grid" id="existing-images">
                                        @foreach($training->images as $image)
                                            <div class="image-card" data-image-id="{{ $image->id }}">
                                                <div class="image-container">
                                                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                                                         class="image-preview" 
                                                         alt="Training Image">
                                                    <div class="image-overlay">
                                                        <div class="image-actions">
                                                            @if($image->is_primary)
                                                                <span class="badge badge-primary">
                                                                    <i class="fas fa-star me-1"></i>Utama
                                                                </span>
                                                            @else
                                                                <button type="button" 
                                                                        class="btn btn-sm btn-outline-warning set-primary" 
                                                                        data-image-id="{{ $image->id }}"
                                                                        title="Set sebagai gambar utama">
                                                                    <i class="fas fa-star"></i>
                                                                </button>
                                                            @endif
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-danger delete-image" 
                                                                    data-image-id="{{ $image->id }}"
                                                                    title="Hapus gambar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                        <!-- Legacy Image Support -->
                                        @if($training->image && $training->images->count() == 0)
                                            <div class="image-card legacy-image">
                                                <div class="image-container">
                                                    <img src="{{ asset('storage/' . $training->image) }}" 
                                                         class="image-preview" 
                                                         alt="Training Image">
                                                    <div class="image-overlay">
                                                        <span class="badge badge-secondary">
                                                            <i class="fas fa-archive me-1"></i>Gambar Lama
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- New Images Upload -->
                            <div class="upload-section">
                                <h6 class="section-subtitle">
                                    <i class="fas fa-upload me-2"></i>Tambah Gambar Baru
                                </h6>
                                <div class="upload-area">
                                    <input type="file" 
                                           class="form-control d-none" 
                                           id="images" 
                                           name="images[]" 
                                           accept="image/*" 
                                           multiple>
                                    <label for="images" class="upload-zone">
                                        <div class="upload-content">
                                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                            <h6>Klik untuk memilih gambar</h6>
                                            <p>atau drag & drop gambar di sini</p>
                                            <small class="text-muted">Maksimal 5MB per gambar • Format: JPG, PNG, GIF</small>
                                        </div>
                                    </label>
                                </div>
                                
                                <!-- New Images Preview -->
                                <div id="new-images-preview" class="images-grid mt-3"></div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-info">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Terakhir diperbarui: {{ $training->updated_at->format('d M Y, H:i') }}
                                    </small>
                                </div>
                                <div class="action-buttons">
                                    <button type="button" class="btn btn-secondary me-2" onclick="window.history.back()">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-submit">
                                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                                        <div class="btn-loading">
                                            <div class="spinner-border spinner-border-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Page Header Styles */
.page-header {
    background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
    padding: 2rem;
    border-radius: 16px;
    color: var(--text-white);
    box-shadow: var(--shadow);
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    right: -50px;
    width: 200px;
    height: 100%;
    background: rgba(255, 140, 0, 0.1);
    transform: skewX(-20deg);
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    color: var(--text-white);
}

.breadcrumb {
    background: none;
    padding: 0;
    margin: 0.5rem 0 0 0;
}

.breadcrumb-item a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
}

.breadcrumb-item.active {
    color: var(--warning-orange);
}

/* Industrial Card Styles */
.industrial-card {
    background: linear-gradient(145deg, #ffffff, #f8fafc);
    border: none;
    border-radius: 20px;
    box-shadow: 
        0 20px 60px rgba(0, 0, 0, 0.1),
        0 8px 25px rgba(1, 62, 126, 0.08);
    overflow: hidden;
    position: relative;
}

.industrial-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--warning-orange), var(--industrial-yellow));
}

.card-header {
    background: linear-gradient(135deg, var(--carbon-black), var(--dark-steel));
    color: var(--text-white);
    padding: 1.5rem 2rem;
    border: none;
}

.card-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--warning-orange), rgba(255, 140, 0, 0.8));
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1.5rem;
    color: var(--text-white);
}

.card-title {
    font-size: 1.4rem;
    font-weight: 600;
    color: var(--text-white);
}

/* Form Section Styles */
.form-section {
    margin-bottom: 3rem;
    position: relative;
}

.section-header {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--metallic-silver);
}

.section-header i {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--steel-gray), var(--light-steel));
    color: var(--text-white);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1.2rem;
}

.section-header h6 {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--dark-steel);
    margin: 0;
    letter-spacing: 0.5px;
}

.section-subtitle {
    font-size: 1rem;
    font-weight: 600;
    color: var(--steel-gray);
    margin-bottom: 1rem;
}

/* Form Input Styles */
.form-label {
    font-weight: 600;
    color: var(--dark-steel);
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
}

.form-label.required::after {
    content: '*';
    color: #dc3545;
    margin-left: 0.25rem;
}

.industrial-input,
.industrial-textarea {
    background: linear-gradient(145deg, #ffffff, #f8fafc);
    border: 2px solid var(--metallic-silver);
    border-radius: 12px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: var(--transition);
    position: relative;
}

.industrial-input:focus,
.industrial-textarea:focus {
    border-color: var(--warning-orange);
    box-shadow: 0 0 0 3px rgba(255, 140, 0, 0.1);
    background: #ffffff;
    outline: none;
}

.form-group {
    margin-bottom: 1.5rem;
}

/* Images Management Styles */
.images-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-top: 1rem;
}

.image-card {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    background: var(--metallic-silver);
    transition: var(--transition);
}

.image-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

.image-container {
    position: relative;
    width: 100%;
    height: 150px;
    overflow: hidden;
}

.image-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, 
        transparent 0%, 
        transparent 50%, 
        rgba(0, 0, 0, 0.8) 100%);
    display: flex;
    align-items: flex-end;
    padding: 1rem;
    opacity: 0;
    transition: var(--transition);
}

.image-card:hover .image-overlay {
    opacity: 1;
}

.image-actions {
    display: flex;
    gap: 0.5rem;
    width: 100%;
    justify-content: space-between;
    align-items: center;
}

.badge-primary {
    background: var(--warning-orange);
    color: var(--text-white);
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-secondary {
    background: var(--steel-gray);
    color: var(--text-white);
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

/* Upload Area Styles */
.upload-area {
    margin-bottom: 1.5rem;
}

.upload-zone {
    display: block;
    width: 100%;
    min-height: 200px;
    border: 3px dashed var(--light-steel);
    border-radius: 16px;
    background: linear-gradient(145deg, #f8fafc, #ffffff);
    cursor: pointer;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.upload-zone:hover {
    border-color: var(--warning-orange);
    background: linear-gradient(145deg, #fff7ed, #ffffff);
    transform: scale(1.01);
}

.upload-zone::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(255, 140, 0, 0.1), 
        transparent);
    transition: left 0.5s ease;
}

.upload-zone:hover::before {
    left: 100%;
}

.upload-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    text-align: center;
    position: relative;
    z-index: 1;
}

.upload-icon {
    font-size: 3rem;
    color: var(--warning-orange);
    margin-bottom: 1rem;
}

.upload-content h6 {
    color: var(--dark-steel);
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.upload-content p {
    color: var(--light-steel);
    margin-bottom: 0.5rem;
}

/* Form Actions */
.form-actions {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 2px solid var(--metallic-silver);
    background: linear-gradient(145deg, #f8fafc, #ffffff);
    margin: 2rem -2rem -2rem -2rem;
    padding: 2rem;
    border-radius: 0 0 20px 20px;
}

.btn-submit {
    background: linear-gradient(135deg, var(--warning-orange), rgba(255, 140, 0, 0.8));
    border: none;
    color: var(--text-white);
    font-weight: 600;
    padding: 0.75rem 2rem;
    border-radius: 12px;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.btn-submit:hover {
    background: linear-gradient(135deg, rgba(255, 140, 0, 0.9), var(--warning-orange));
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 140, 0, 0.3);
}

.btn-submit:active {
    transform: translateY(0);
}

.btn-loading {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: none;
}

.btn-submit.loading .btn-loading {
    display: block;
}

.btn-submit.loading i,
.btn-submit.loading .btn-text {
    opacity: 0;
}

.btn-secondary {
    background: linear-gradient(135deg, var(--steel-gray), var(--light-steel));
    border: none;
    color: var(--text-white);
    font-weight: 600;
    padding: 0.75rem 2rem;
    border-radius: 12px;
    transition: var(--transition);
}

.btn-secondary:hover {
    background: linear-gradient(135deg, var(--dark-steel), var(--steel-gray));
    transform: translateY(-2px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header {
        padding: 1.5rem;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .images-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
    }
    
    .form-actions {
        margin: 1rem -1rem -1rem -1rem;
        padding: 1rem;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 0.5rem;
        width: 100%;
    }
    
    .action-buttons .btn {
        width: 100%;
    }
}

/* Animation Classes */
.fade-in {
    animation: fadeIn 0.6s ease-out;
}

.slide-up {
    animation: slideUp 0.6s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { 
        opacity: 0; 
        transform: translateY(20px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

/* Success Animation */
.success-feedback {
    background: linear-gradient(135deg, var(--success-green), rgba(56, 161, 105, 0.8));
    color: var(--text-white);
    padding: 1rem 1.5rem;
    border-radius: 12px;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    animation: slideDown 0.5s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add fade-in animation to form sections
    document.querySelectorAll('.form-section').forEach((section, index) => {
        section.style.animationDelay = `${index * 0.1}s`;
        section.classList.add('fade-in');
    });

    // Enhanced file upload preview
    const fileInput = document.getElementById('images');
    const previewContainer = document.getElementById('new-images-preview');
    
    fileInput.addEventListener('change', function(e) {
        previewContainer.innerHTML = '';
        const files = Array.from(e.target.files);
        
        files.forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                
                reader.onload = function(event) {
                    const imageCard = document.createElement('div');
                    imageCard.className = 'image-card fade-in';
                    imageCard.style.animationDelay = `${index * 0.1}s`;
                    
                    imageCard.innerHTML = `
                        <div class="image-container">
                            <img src="${event.target.result}" 
                                 class="image-preview" 
                                 alt="New Image ${index + 1}">
                            <div class="image-overlay">
                                <div class="image-actions">
                                    <span class="badge badge-success">
                                        <i class="fas fa-plus me-1"></i>Baru ${index + 1}
                                    </span>
                                    <small class="text-white">
                                        ${(file.size / 1024 / 1024).toFixed(2)} MB
                                    </small>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    previewContainer.appendChild(imageCard);
                };
                
                reader.readAsDataURL(file);
            }
        });
    });

    // Enhanced drag and drop functionality
    const uploadZone = document.querySelector('.upload-zone');
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadZone.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, unhighlight, false);
    });
    
    function highlight(e) {
        uploadZone.style.borderColor = 'var(--warning-orange)';
        uploadZone.style.background = 'linear-gradient(145deg, #fff7ed, #ffffff)';
        uploadZone.style.transform = 'scale(1.02)';
    }
    
    function unhighlight(e) {
        uploadZone.style.borderColor = 'var(--light-steel)';
        uploadZone.style.background = 'linear-gradient(145deg, #f8fafc, #ffffff)';
        uploadZone.style.transform = 'scale(1)';
    }
    
    uploadZone.addEventListener('drop', handleDrop, false);
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        fileInput.dispatchEvent(new Event('change'));
    }

    // Delete image functionality
    document.querySelectorAll('.delete-image').forEach(button => {
        button.addEventListener('click', function() {
            const imageId = this.getAttribute('data-image-id');
            const imageCard = document.querySelector(`[data-image-id="${imageId}"]`);
            
            // Enhanced confirmation dialog
            if (confirm('Apakah Anda yakin ingin menghapus gambar ini? Tindakan ini tidak dapat dibatalkan.')) {
                // Add loading state to button
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                this.disabled = true;
                
                fetch(`/admin/trainings/images/${imageId}/delete`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Animate removal
                        imageCard.style.animation = 'fadeOut 0.5s ease-out forwards';
                        setTimeout(() => {
                            imageCard.remove();
                            showNotification('Gambar berhasil dihapus', 'success');
                        }, 500);
                    } else {
                        showNotification('Gagal menghapus gambar', 'error');
                        // Reset button
                        this.innerHTML = '<i class="fas fa-trash"></i>';
                        this.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Terjadi kesalahan saat menghapus gambar', 'error');
                    // Reset button
                    this.innerHTML = '<i class="fas fa-trash"></i>';
                    this.disabled = false;
                });
            }
        });
    });

    // Set primary image functionality
    document.querySelectorAll('.set-primary').forEach(button => {
        button.addEventListener('click', function() {
            const imageId = this.getAttribute('data-image-id');
            
            // Add loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            this.disabled = true;
            
            fetch(`/admin/trainings/images/${imageId}/set-primary`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Gambar utama berhasil diubah', 'success');
                    // Reload page with smooth transition
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    showNotification('Gagal mengubah gambar utama', 'error');
                    // Reset button
                    this.innerHTML = '<i class="fas fa-star"></i>';
                    this.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan', 'error');
                // Reset button
                this.innerHTML = '<i class="fas fa-star"></i>';
                this.disabled = false;
            });
        });
    });

    // Form submission with loading state
    const form = document.getElementById('trainingForm');
    const submitBtn = document.querySelector('.btn-submit');
    
    form.addEventListener('submit', function(e) {
        // Add loading state to submit button
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
        
        // Add loading text
        const btnText = submitBtn.innerHTML;
        setTimeout(() => {
            if (submitBtn.classList.contains('loading')) {
                submitBtn.innerHTML = `
                    ${btnText}
                    <div class="btn-loading">
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                `;
            }
        }, 100);
    });

    // Form validation enhancement
    const requiredFields = form.querySelectorAll('[required]');
    
    requiredFields.forEach(field => {
        field.addEventListener('blur', function() {
            validateField(this);
        });
        
        field.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                validateField(this);
            }
        });
    });
    
    function validateField(field) {
        const value = field.value.trim();
        const fieldGroup = field.closest('.form-group');
        let feedbackElement = fieldGroup.querySelector('.invalid-feedback');
        
        if (!feedbackElement) {
            feedbackElement = document.createElement('div');
            feedbackElement.className = 'invalid-feedback';
            fieldGroup.appendChild(feedbackElement);
        }
        
        if (value === '') {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
            feedbackElement.textContent = 'Field ini wajib diisi';
        } else {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
            feedbackElement.textContent = '';
        }
    }

    // Auto-save functionality (optional)
    let autoSaveTimeout;
    
    form.addEventListener('input', function() {
        clearTimeout(autoSaveTimeout);
        autoSaveTimeout = setTimeout(() => {
            saveFormData();
        }, 3000); // Save after 3 seconds of inactivity
    });
    
    function saveFormData() {
        const formData = new FormData(form);
        localStorage.setItem('training_form_draft', JSON.stringify(Object.fromEntries(formData)));
        showNotification('Draft tersimpan otomatis', 'info', 2000);
    }
    
    // Load draft data on page load
    const draftData = localStorage.getItem('training_form_draft');
    if (draftData && confirm('Ditemukan draft yang tersimpan. Apakah Anda ingin memuat draft tersebut?')) {
        const data = JSON.parse(draftData);
        Object.keys(data).forEach(key => {
            const field = form.querySelector(`[name="${key}"]`);
            if (field && field.type !== 'file') {
                field.value = data[key];
            }
        });
    }

    // Clear draft after successful submission
    form.addEventListener('submit', function() {
        setTimeout(() => {
            localStorage.removeItem('training_form_draft');
        }, 1000);
    });
});

// Notification system
function showNotification(message, type = 'info', duration = 5000) {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    
    const icon = {
        success: 'fas fa-check-circle',
        error: 'fas fa-exclamation-circle',
        warning: 'fas fa-exclamation-triangle',
        info: 'fas fa-info-circle'
    }[type] || 'fas fa-info-circle';
    
    notification.innerHTML = `
        <div class="notification-content">
            <i class="${icon}"></i>
            <span>${message}</span>
            <button type="button" class="notification-close" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove
    setTimeout(() => {
        if (notification.parentNode) {
            notification.style.animation = 'slideOut 0.3s ease-out forwards';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }
    }, duration);
}

// Add notification styles
const notificationStyles = document.createElement('style');
notificationStyles.textContent = `
    .notification {
        position: fixed;
        top: 90px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        animation: slideIn 0.3s ease-out;
        backdrop-filter: blur(10px);
    }
    
    .notification-success {
        background: linear-gradient(135deg, var(--success-green), rgba(56, 161, 105, 0.9));
        color: white;
    }
    
    .notification-error {
        background: linear-gradient(135deg, #dc3545, rgba(220, 53, 69, 0.9));
        color: white;
    }
    
    .notification-warning {
        background: linear-gradient(135deg, var(--warning-orange), rgba(255, 140, 0, 0.9));
        color: white;
    }
    
    .notification-info {
        background: linear-gradient(135deg, var(--primary-blue), rgba(1, 62, 126, 0.9));
        color: white;
    }
    
    .notification-content {
        display: flex;
        align-items: center;
        padding: 1rem 1.5rem;
        gap: 0.75rem;
    }
    
    .notification-content i:first-child {
        font-size: 1.25rem;
    }
    
    .notification-close {
        background: none;
        border: none;
        color: inherit;
        margin-left: auto;
        padding: 0.25rem;
        border-radius: 4px;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .notification-close:hover {
        background: rgba(255, 255, 255, 0.2);
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideOut {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(100%);
        }
    }
    
    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: scale(1);
        }
        to {
            opacity: 0;
            transform: scale(0.8);
        }
    }
    
    /* Form validation styles */
    .form-control.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }
    
    .form-control.is-valid {
        border-color: var(--success-green);
        box-shadow: 0 0 0 3px rgba(56, 161, 105, 0.1);
    }
    
    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        font-weight: 500;
    }
    
    .badge-success {
        background: var(--success-green);
        color: var(--text-white);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    /* Mobile responsiveness for notifications */
    @media (max-width: 480px) {
        .notification {
            left: 10px;
            right: 10px;
            min-width: auto;
        }
    }
`;

document.head.appendChild(notificationStyles);
</script>

@endsection