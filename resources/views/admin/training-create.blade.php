@extends('layouts.adminapp')

@section('title', 'Tambah Pelatihan')

@section('content')
<style>
    .form-container {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--primary-blue), var(--warning-orange), var(--success-green));
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: white;
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .page-header::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -20px;
        width: 100px;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transform: rotate(15deg);
    }

    .page-header h1 {
        font-weight: 800;
        font-size: 2.2rem;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .page-header p {
        margin: 0;
        opacity: 0.9;
        font-size: 1.1rem;
    }

    .form-section {
        background: #ffffff;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
        position: relative;
    }

    .form-section:hover {
        border-color: var(--warning-orange);
        box-shadow: 0 8px 25px rgba(255, 140, 0, 0.1);
    }

    .section-title {
        color: var(--primary-blue);
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title i {
        color: var(--warning-orange);
        font-size: 1.1rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-label {
        color: var(--dark-steel);
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        display: block;
        position: relative;
    }

    .form-label.required::after {
        content: '*';
        color: #e53e3e;
        margin-left: 4px;
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #ffffff;
        color: var(--dark-steel);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--warning-orange);
        box-shadow: 0 0 0 3px rgba(255, 140, 0, 0.1);
        transform: translateY(-1px);
    }

    .form-control::placeholder {
        color: #a0aec0;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .file-upload-area {
        border: 3px dashed #cbd5e0;
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
        position: relative;
        cursor: pointer;
    }

    .file-upload-area:hover {
        border-color: var(--warning-orange);
        background: linear-gradient(135deg, #fff5e6 0%, #fed7aa 100%);
    }

    .file-upload-area.dragover {
        border-color: var(--success-green);
        background: linear-gradient(135deg, #f0fff4 0%, #c6f6d5 100%);
        transform: scale(1.02);
    }

    .upload-icon {
        font-size: 3rem;
        color: var(--warning-orange);
        margin-bottom: 1rem;
    }

    .upload-text {
        color: var(--dark-steel);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .upload-hint {
        color: var(--light-steel);
        font-size: 0.9rem;
    }

    .image-preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .preview-card {
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
    }

    .preview-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .preview-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-bottom: 2px solid #e2e8f0;
    }

    .preview-info {
        padding: 0.75rem;
        text-align: center;
    }

    .thumbnail-badge {
        position: absolute;
        top: 8px;
        left: 8px;
        background: var(--warning-orange);
        color: white;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        min-width: 180px;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(1, 62, 126, 0.3);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .input-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--light-steel);
        font-size: 1.1rem;
        pointer-events: none;
    }

    .form-group.has-icon {
        position: relative;
    }

    .form-group.has-icon .form-control {
        padding-right: 2.5rem;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .page-header h1 {
            font-size: 1.8rem;
        }
        
        .form-container {
            padding: 1rem;
        }
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1><i class="fas fa-plus-circle me-3"></i>Tambah Pelatihan Baru</h1>
        <p>Buat program pelatihan baru untuk meningkatkan keterampilan peserta</p>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <form action="{{ route('trainings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Basic Information Section -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-info-circle"></i>
                    Informasi Dasar
                </div>
                
                <div class="form-group">
                    <label for="title" class="form-label required">Judul Pelatihan</label>
                    <input type="text" 
                           class="form-control" 
                           id="title" 
                           name="title" 
                           value="{{ old('title') }}" 
                           placeholder="Masukkan judul pelatihan yang menarik"
                           required>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" 
                              id="description" 
                              name="description" 
                              placeholder="Jelaskan detail pelatihan, tujuan, dan manfaat yang akan didapat peserta">{{ old('description') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group has-icon">
                        <label for="capacity" class="form-label required">Kapasitas Peserta</label>
                        <input type="number" 
                               class="form-control" 
                               id="capacity" 
                               name="capacity" 
                               value="{{ old('capacity') }}" 
                               placeholder="Jumlah maksimal peserta"
                               min="1"
                               required>
                        <i class="fas fa-users input-icon"></i>
                    </div>

                    <div class="form-group has-icon">
                        <label for="location" class="form-label required">Lokasi</label>
                        <input type="text" 
                               class="form-control" 
                               id="location" 
                               name="location" 
                               value="{{ old('location') }}" 
                               placeholder="Alamat atau tempat pelaksanaan"
                               required>
                        <i class="fas fa-map-marker-alt input-icon"></i>
                    </div>
                </div>
            </div>

            <!-- Schedule Section -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-calendar-alt"></i>
                    Jadwal Pelatihan
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="start_date" class="form-label required">Tanggal Mulai</label>
                        <input type="date" 
                               class="form-control" 
                               id="start_date" 
                               name="start_date" 
                               value="{{ old('start_date') }}" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="start_time" class="form-label required">Waktu Mulai</label>
                        <input type="time" 
                               class="form-control" 
                               id="start_time" 
                               name="start_time" 
                               value="{{ old('start_time') }}" 
                               required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" 
                               class="form-control" 
                               id="end_date" 
                               name="end_date" 
                               value="{{ old('end_date') }}">
                    </div>

                    <div class="form-group">
                        <label for="end_time" class="form-label">Waktu Selesai</label>
                        <input type="time" 
                               class="form-control" 
                               id="end_time" 
                               name="end_time" 
                               value="{{ old('end_time') }}">
                    </div>
                </div>
            </div>

            <!-- Media Section -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-images"></i>
                    Media Pelatihan
                </div>

                <div class="form-group">
                    <label class="form-label">Upload Gambar</label>
                    <div class="file-upload-area" onclick="document.getElementById('images').click()">
                        <div class="upload-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <div class="upload-text">Klik untuk memilih gambar</div>
                        <div class="upload-hint">atau drag & drop file di sini</div>
                        <div class="upload-hint">Maksimal 5MB per gambar • Format: JPG, PNG, GIF</div>
                    </div>
                    <input type="file" 
                           class="d-none" 
                           id="images" 
                           name="images[]" 
                           accept="image/*" 
                           multiple>
                </div>

                <div id="image-preview" class="image-preview-grid"></div>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save me-2"></i>Simpan Pelatihan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('images');
    const uploadArea = document.querySelector('.file-upload-area');
    const previewContainer = document.getElementById('image-preview');

    // File input change handler
    fileInput.addEventListener('change', function(e) {
        handleFiles(e.target.files);
    });

    // Drag and drop handlers
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        fileInput.files = files;
        handleFiles(files);
    });

    function handleFiles(files) {
        previewContainer.innerHTML = '';
        
        Array.from(files).forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                
                reader.onload = function(event) {
                    const previewCard = document.createElement('div');
                    previewCard.className = 'preview-card';
                    
                    previewCard.innerHTML = `
                        <img src="${event.target.result}" class="preview-image" alt="Preview">
                        ${index === 0 ? '<div class="thumbnail-badge">Thumbnail Utama</div>' : ''}
                        <div class="preview-info">
                            <small class="text-muted">
                                ${index === 0 ? 'Gambar Utama' : `Gambar ${index + 1}`}
                            </small>
                        </div>
                    `;
                    
                    previewContainer.appendChild(previewCard);
                };
                
                reader.readAsDataURL(file);
            }
        });
    }

    // Form validation enhancement
    const form = document.querySelector('form');
    const requiredFields = document.querySelectorAll('[required]');

    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.style.borderColor = '#e53e3e';
                field.style.boxShadow = '0 0 0 3px rgba(229, 62, 62, 0.1)';
                isValid = false;
            } else {
                field.style.borderColor = '#e2e8f0';
                field.style.boxShadow = 'none';
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang wajib diisi');
        }
    });

    // Real-time validation
    requiredFields.forEach(field => {
        field.addEventListener('input', function() {
            if (this.value.trim()) {
                this.style.borderColor = '#38a169';
                this.style.boxShadow = '0 0 0 3px rgba(56, 161, 105, 0.1)';
            }
        });
    });

    // Auto-resize textarea
    const textarea = document.getElementById('description');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });
});
</script>
@endsection