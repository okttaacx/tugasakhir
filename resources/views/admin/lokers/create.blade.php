@extends('layouts.adminapp')

@section('content')
<style>
    .form-container {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        padding: 2.5rem;
        margin: 2rem 0;
        position: relative;
        overflow: hidden;
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
            var(--warning-orange) 50%, 
            var(--primary-blue) 100%);
    }

    .page-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid rgba(1, 62, 126, 0.1);
    }

    .page-header h2 {
        color: var(--primary-blue);
        font-weight: 700;
        margin: 0;
        font-size: 2rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .page-header .icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(145deg, var(--warning-orange), rgba(255, 140, 0, 0.8));
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        box-shadow: 0 8px 25px rgba(255, 140, 0, 0.3);
    }

    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }

    .form-label {
        color: var(--dark-steel);
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label i {
        color: var(--warning-orange);
        width: 20px;
        text-align: center;
    }

    .form-control {
        border: 2px solid rgba(1, 62, 126, 0.1);
        border-radius: 12px;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
    }

    .form-control:focus {
        border-color: var(--warning-orange);
        box-shadow: 0 0 0 0.25rem rgba(255, 140, 0, 0.15);
        background: white;
        transform: translateY(-2px);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: #dc3545;
        background: rgba(220, 53, 69, 0.1);
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border-left: 4px solid #dc3545;
    }

    .file-upload-area {
        border: 3px dashed rgba(1, 62, 126, 0.2);
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.8), rgba(248, 250, 252, 0.8));
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .file-upload-area:hover {
        border-color: var(--warning-orange);
        background: linear-gradient(145deg, rgba(255, 140, 0, 0.05), rgba(255, 140, 0, 0.1));
    }

    .file-upload-area.dragover {
        border-color: var(--warning-orange);
        background: rgba(255, 140, 0, 0.1);
        transform: scale(1.02);
    }

    .upload-icon {
        font-size: 3rem;
        color: var(--warning-orange);
        margin-bottom: 1rem;
    }

    .upload-text {
        color: var(--dark-steel);
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .upload-hint {
        color: var(--light-steel);
        font-size: 0.875rem;
    }

    .file-input {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .checkbox-container {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.5rem;
        background: linear-gradient(145deg, rgba(255, 140, 0, 0.05), rgba(255, 140, 0, 0.1));
        border-radius: 15px;
        border: 2px solid rgba(255, 140, 0, 0.2);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .checkbox-container:hover {
        background: linear-gradient(145deg, rgba(255, 140, 0, 0.1), rgba(255, 140, 0, 0.15));
        transform: translateY(-2px);
    }

    .form-check-input {
        width: 1.5rem;
        height: 1.5rem;
        margin: 0;
        cursor: pointer;
        border: 2px solid var(--warning-orange);
        border-radius: 6px;
    }

    .form-check-input:checked {
        background-color: var(--warning-orange);
        border-color: var(--warning-orange);
    }

    .form-check-label {
        color: var(--dark-steel);
        font-weight: 600;
        margin: 0;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .button-group {
        display: flex;
        gap: 1rem;
        justify-content: flex-start;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid rgba(1, 62, 126, 0.1);
    }

    .btn {
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        border: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn:hover::before {
        left: 100%;
    }

    .btn-primary {
        background: linear-gradient(145deg, var(--warning-orange), rgba(255, 140, 0, 0.8));
        color: white;
        box-shadow: 0 8px 25px rgba(255, 140, 0, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(145deg, rgba(255, 140, 0, 0.9), var(--warning-orange));
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(255, 140, 0, 0.4);
    }

    .btn-secondary {
        background: linear-gradient(145deg, var(--steel-gray), var(--light-steel));
        color: white;
        box-shadow: 0 8px 25px rgba(74, 85, 104, 0.3);
    }

    .btn-secondary:hover {
        background: linear-gradient(145deg, var(--light-steel), var(--steel-gray));
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(74, 85, 104, 0.4);
        color: white;
    }

    .form-floating {
        position: relative;
    }

    .form-floating .form-control {
        padding: 1.625rem 1.25rem 0.625rem;
    }

    .form-floating .form-label {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        padding: 1rem 1.25rem;
        pointer-events: none;
        border: 1px solid transparent;
        transform-origin: 0 0;
        transition: opacity 0.1s ease-in-out, transform 0.1s ease-in-out;
    }

    @media (max-width: 768px) {
        .form-container {
            margin: 1rem;
            padding: 1.5rem;
        }
        
        .page-header h2 {
            font-size: 1.5rem;
        }
        
        .button-group {
            flex-direction: column;
        }
        
        .btn {
            justify-content: center;
        }
    }

    .preview-container {
        margin-top: 1rem;
        display: none;
    }

    .preview-image {
        max-width: 200px;
        max-height: 200px;
        object-fit: cover;
        border-radius: 10px;
        border: 3px solid var(--warning-orange);
        box-shadow: 0 8px 25px rgba(255, 140, 0, 0.2);
    }

    .remove-image {
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        position: absolute;
        top: -10px;
        right: -10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="container-fluid">
    <div class="form-container">
        <div class="page-header">
            <div class="icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <h2>Tambah Lowongan Pekerjaan</h2>
        </div>
        
        <form action="{{ route('admin.lokers.store') }}" method="POST" enctype="multipart/form-data" id="lokerForm">
            @csrf
            
            <!-- Title Field -->
            <div class="form-group">
                <label for="title" class="form-label">
                    <i class="fas fa-heading"></i>
                    Judul Lowongan
                </label>
                <input type="text" 
                       class="form-control @error('title') is-invalid @enderror" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}" 
                       placeholder="Masukkan judul lowongan pekerjaan"
                       required>
                @error('title')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Poster Upload -->
            <div class="form-group">
                <label for="poster" class="form-label">
                    <i class="fas fa-image"></i>
                    Poster Lowongan (Portrait)
                </label>
                <div class="file-upload-area" onclick="document.getElementById('poster').click()">
                    <div class="upload-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <div class="upload-text">Klik untuk upload poster</div>
                    <div class="upload-hint">atau drag & drop file gambar di sini</div>
                    <input type="file" 
                           class="file-input @error('poster') is-invalid @enderror" 
                           id="poster" 
                           name="poster" 
                           accept="image/*"
                           onchange="previewImage(this)">
                </div>
                <div class="preview-container" id="imagePreview">
                    <div style="position: relative; display: inline-block;">
                        <img class="preview-image" id="previewImg" src="" alt="Preview">
                        <button type="button" class="remove-image" onclick="removeImage()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                @error('poster')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Description Field -->
            <div class="form-group">
                <label for="deskripsi" class="form-label">
                    <i class="fas fa-align-left"></i>
                    Deskripsi <span class="text-muted">(Opsional)</span>
                </label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                          id="deskripsi" 
                          name="deskripsi" 
                          rows="6"
                          placeholder="Masukkan deskripsi detail tentang lowongan pekerjaan...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Publish Checkbox -->
            <div class="form-group">
                <div class="checkbox-container" onclick="toggleCheckbox()">
                    <input type="checkbox" 
                           class="form-check-input" 
                           id="is_published" 
                           name="is_published" 
                           {{ old('is_published') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_published">
                        <i class="fas fa-globe"></i>
                        Publikasikan lowongan ini sekarang
                    </label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Lowongan
                </button>
                <a href="{{ route('admin.lokers.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>

<script>
// File Upload with Drag & Drop
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.querySelector('.file-upload-area');
    const fileInput = document.getElementById('poster');

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });

    // Handle dropped files
    uploadArea.addEventListener('drop', handleDrop, false);

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight(e) {
        uploadArea.classList.add('dragover');
    }

    function unhighlight(e) {
        uploadArea.classList.remove('dragover');
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length > 0) {
            fileInput.files = files;
            previewImage(fileInput);
        }
    }
});

// Image Preview Function
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Remove Image Function
function removeImage() {
    document.getElementById('poster').value = '';
    document.getElementById('imagePreview').style.display = 'none';
    document.getElementById('previewImg').src = '';
}

// Toggle Checkbox Function
function toggleCheckbox() {
    const checkbox = document.getElementById('is_published');
    checkbox.checked = !checkbox.checked;
}

// Form Validation
document.getElementById('lokerForm').addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    
    if (!title) {
        e.preventDefault();
        alert('Judul lowongan harus diisi!');
        document.getElementById('title').focus();
        return false;
    }
    
    // Show loading state
    const submitBtn = document.querySelector('.btn-primary');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    submitBtn.disabled = true;
    
    // Re-enable button after 10 seconds as fallback
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 10000);
});
</script>
@endsection