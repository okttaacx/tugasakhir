@extends('layouts.adminapp')

@section('title', 'Buat Berita Baru')

@section('content')
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
    }

    body { 
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, var(--metallic-silver) 0%, #f7fafc 100%);
        margin: 0;
        padding: 0;
    }

    .page-container {
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
        position: relative;
    }

    .page-container::before {
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

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, 
            var(--primary-blue) 0%, 
            var(--secondary-blue) 50%, 
            var(--dark-steel) 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 
            0 20px 60px rgba(1, 62, 126, 0.15),
            0 8px 32px rgba(0, 0, 0, 0.1);
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
            rgba(255, 255, 255, 0.02) 2px,
            rgba(255, 255, 255, 0.02) 4px
        );
        pointer-events: none;
    }

    .header-content {
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
        z-index: 1;
    }

    .back-btn {
        background: linear-gradient(145deg, 
            rgba(255, 255, 255, 0.1) 0%, 
            rgba(255, 255, 255, 0.05) 100%);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        color: var(--text-white);
        padding: 12px 16px;
        text-decoration: none;
        transition: var(--transition);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
    }

    .back-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .back-btn:hover::before {
        left: 100%;
    }

    .back-btn:hover {
        background: linear-gradient(145deg, 
            rgba(255, 140, 0, 0.2) 0%, 
            rgba(255, 140, 0, 0.1) 100%);
        transform: translateY(-2px);
        border-color: var(--warning-orange);
        color: var(--text-white);
        text-decoration: none;
        box-shadow: 0 8px 25px rgba(255, 140, 0, 0.3);
    }

    .page-title {
        color: var(--text-white);
        font-size: 2.5rem;
        font-weight: 800;
        margin: 0;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-title i {
        color: var(--warning-orange);
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
    }

    /* Form Container */
    .form-container {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 24px;
        padding: 3rem;
        box-shadow: 
            0 25px 80px rgba(0, 0, 0, 0.08),
            0 10px 40px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(1, 62, 126, 0.05);
        position: relative;
        overflow: hidden;
    }

    .form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, 
            var(--warning-orange) 0%, 
            var(--industrial-yellow) 50%, 
            var(--warning-orange) 100%);
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark-steel);
        margin-bottom: 0.75rem;
        position: relative;
    }

    .form-label i {
        color: var(--warning-orange);
        font-size: 1.1rem;
    }

    .form-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, 
            var(--warning-orange) 0%, 
            transparent 100%);
        margin-left: 1rem;
        opacity: 0.3;
    }

    /* Input Styles */
    .form-control {
        width: 100%;
        padding: 1rem 1.25rem;
        border: 2px solid var(--metallic-silver);
        border-radius: 15px;
        font-size: 1rem;
        font-family: 'Poppins', sans-serif;
        transition: var(--transition);
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        position: relative;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.02);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--warning-orange);
        box-shadow: 
            0 0 0 4px rgba(255, 140, 0, 0.15),
            inset 0 2px 4px rgba(0, 0, 0, 0.02);
        transform: translateY(-1px);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.15);
    }

    /* Textarea Specific */
    .form-textarea {
        min-height: 200px;
        resize: vertical;
        font-family: 'Poppins', sans-serif;
        line-height: 1.6;
    }

    /* File Input Styling */
    .file-input-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .file-input {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-input-display {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        padding: 2rem;
        border: 3px dashed var(--metallic-silver);
        border-radius: 15px;
        background: linear-gradient(145deg, #f8fafc 0%, #ffffff 100%);
        transition: var(--transition);
        cursor: pointer;
        text-align: center;
        min-height: 120px;
    }

    .file-input-display:hover,
    .file-input-wrapper:hover .file-input-display {
        border-color: var(--warning-orange);
        background: linear-gradient(145deg, 
            rgba(255, 140, 0, 0.02) 0%, 
            rgba(255, 140, 0, 0.01) 100%);
        transform: translateY(-2px);
    }

    .file-icon {
        font-size: 3rem;
        color: var(--warning-orange);
        opacity: 0.7;
    }

    .file-text {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .file-text strong {
        color: var(--dark-steel);
        font-size: 1.1rem;
        font-weight: 600;
    }

    .file-text span {
        color: var(--light-steel);
        font-size: 0.9rem;
    }

    /* Select Styling */
    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23ff8c00' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1.2em;
        padding-right: 3rem;
    }

    /* Error Messages */
    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.9rem;
        font-weight: 500;
        margin-top: 0.5rem;
        padding: 0.5rem 0.75rem;
        background: linear-gradient(145deg, 
            rgba(220, 53, 69, 0.05) 0%, 
            rgba(220, 53, 69, 0.02) 100%);
        border-radius: 8px;
        border-left: 4px solid #dc3545;
    }

    /* Help Text */
    .form-text {
        color: var(--light-steel);
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-text i {
        color: var(--warning-orange);
        opacity: 0.7;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid rgba(1, 62, 126, 0.05);
        position: relative;
    }

    .form-actions::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 2px;
        background: var(--warning-orange);
        border-radius: 1px;
    }

    /* Button Styles */
    .btn {
        padding: 1rem 2rem;
        border-radius: 15px;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: var(--transition);
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        font-family: 'Poppins', sans-serif;
        letter-spacing: 0.5px;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, 
            transparent, 
            rgba(255, 255, 255, 0.2), 
            transparent);
        transition: left 0.6s ease;
    }

    .btn:hover::before {
        left: 100%;
    }

    .btn-secondary {
        background: linear-gradient(145deg, 
            var(--metallic-silver) 0%, 
            #cbd5e0 100%);
        color: var(--dark-steel);
        border: 2px solid rgba(74, 85, 104, 0.2);
    }

    .btn-secondary:hover {
        background: linear-gradient(145deg, 
            #cbd5e0 0%, 
            var(--light-steel) 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(74, 85, 104, 0.2);
        color: var(--dark-steel);
        text-decoration: none;
    }

    .btn-primary {
        background: linear-gradient(145deg, 
            var(--warning-orange) 0%, 
            var(--industrial-yellow) 100%);
        color: var(--text-white);
        border: 2px solid transparent;
        box-shadow: 0 4px 15px rgba(255, 140, 0, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(145deg, 
            var(--industrial-yellow) 0%, 
            var(--warning-orange) 100%);
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(255, 140, 0, 0.4);
        color: var(--text-white);
    }

    /* Status Badge */
    .status-indicator {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-left: 1rem;
        background: linear-gradient(145deg, 
            rgba(255, 140, 0, 0.1) 0%, 
            rgba(255, 140, 0, 0.05) 100%);
        color: var(--warning-orange);
        border: 1px solid rgba(255, 140, 0, 0.3);
    }

    .status-dot {
        width: 8px;
        height: 8px;
        background: var(--warning-orange);
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.7; transform: scale(1.1); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-container {
            padding: 1rem;
        }

        .page-header {
            padding: 1.5rem;
        }

        .header-content {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .page-title {
            font-size: 2rem;
        }

        .form-container {
            padding: 2rem 1.5rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            justify-content: center;
        }
    }

    /* Animation */
    .form-container {
        animation: slideUpFade 0.8s ease-out;
    }

    @keyframes slideUpFade {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="page-container">
    <!-- Enhanced Page Header -->
    <div class="page-header">
        <div class="header-content">
            <a href="{{ route('news.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Daftar
            </a>
            <h1 class="page-title">
                <i class="fas fa-plus-circle"></i>
                Tulis Berita Baru
            </h1>
            <div class="status-indicator">
                <div class="status-dot"></div>
                Mode Editor Aktif
            </div>
        </div>
    </div>

    <!-- Enhanced Form Container -->
    <div class="form-container">
        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Title Input -->
            <div class="form-group">
                <label for="title" class="form-label">
                    <i class="fas fa-heading"></i>
                    Judul Berita
                </label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       value="{{ old('title') }}"
                       class="form-control @error('title') is-invalid @enderror"
                       placeholder="Masukkan judul berita yang menarik..."
                       required>
                @error('title')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Thumbnail Input -->
            <div class="form-group">
                <label for="thumbnail" class="form-label">
                    <i class="fas fa-image"></i>
                    Thumbnail Berita
                </label>
                <div class="file-input-wrapper">
                    <input type="file" 
                           name="thumbnail" 
                           id="thumbnail" 
                           accept="image/*"
                           class="file-input @error('thumbnail') is-invalid @enderror">
                    <div class="file-input-display">
                        <i class="fas fa-cloud-upload-alt file-icon"></i>
                        <div class="file-text">
                            <strong>Klik untuk upload thumbnail</strong>
                            <span>atau drag & drop file gambar di sini</span>
                        </div>
                    </div>
                </div>
                @error('thumbnail')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-text">
                    <i class="fas fa-info-circle"></i>
                    Format yang didukung: JPEG, PNG, JPG, GIF. Maksimal ukuran 2MB
                </div>
            </div>

            <!-- Content Input -->
            <div class="form-group">
                <label for="content" class="form-label">
                    <i class="fas fa-edit"></i>
                    Konten Berita
                </label>
                <textarea name="content" 
                          id="content" 
                          rows="15"
                          class="form-control form-textarea @error('content') is-invalid @enderror"
                          placeholder="Tulis konten berita Anda di sini...">{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-text">
                    <i class="fas fa-lightbulb"></i>
                    Gunakan format yang jelas dan mudah dibaca. Pisahkan paragraf dengan enter.
                </div>
            </div>

            <!-- Status Select -->
            <div class="form-group">
                <label for="status" class="form-label">
                    <i class="fas fa-toggle-on"></i>
                    Status Publikasi
                </label>
                <select name="status" 
                        id="status" 
                        class="form-control form-select">
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>
                        💾 Draft - Simpan sebagai draft
                    </option>
                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>
                        🚀 Published - Terbitkan sekarang
                    </option>
                </select>
                <div class="form-text">
                    <i class="fas fa-info-circle"></i>
                    Pilih "Draft" untuk menyimpan tanpa menerbitkan, atau "Published" untuk langsung terbit
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('news.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Berita
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Enhanced File Upload Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('thumbnail');
    const fileDisplay = document.querySelector('.file-input-display');
    
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const fileName = file.name;
            const fileSize = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            
            fileDisplay.innerHTML = `
                <i class="fas fa-check-circle file-icon" style="color: var(--success-green);"></i>
                <div class="file-text">
                    <strong>${fileName}</strong>
                    <span>Ukuran: ${fileSize} • Siap untuk upload</span>
                </div>
            `;
            fileDisplay.style.borderColor = 'var(--success-green)';
            fileDisplay.style.background = 'linear-gradient(145deg, rgba(56, 161, 105, 0.05) 0%, rgba(56, 161, 105, 0.02) 100%)';
        }
    });

    // Drag and drop functionality
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        fileDisplay.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        fileDisplay.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        fileDisplay.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        fileDisplay.style.borderColor = 'var(--warning-orange)';
        fileDisplay.style.transform = 'scale(1.02)';
    }

    function unhighlight() {
        fileDisplay.style.borderColor = 'var(--metallic-silver)';
        fileDisplay.style.transform = 'scale(1)';
    }

    fileDisplay.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        
        // Trigger change event
        const event = new Event('change', { bubbles: true });
        fileInput.dispatchEvent(event);
    }
});
</script>

@endsection