@extends('layouts.adminapp')

@section('content')
<style>
    .main-container {
        padding: 2rem;
        margin-top: 1rem;
    }

    .page-header {
        background: linear-gradient(135deg, 
            var(--primary-blue) 0%, 
            var(--secondary-blue) 50%, 
            var(--dark-steel) 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: var(--text-white);
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(1, 62, 126, 0.15);
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

    .page-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-title i {
        background: var(--warning-orange);
        padding: 0.75rem;
        border-radius: 16px;
        font-size: 1.5rem;
        box-shadow: 0 4px 16px rgba(255, 140, 0, 0.3);
    }

    .form-container {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.08),
            0 8px 32px rgba(1, 62, 126, 0.05);
        border: 1px solid rgba(1, 62, 126, 0.08);
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

    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark-steel);
        margin-bottom: 0.75rem;
        font-size: 1.05rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label i {
        color: var(--warning-orange);
        font-size: 1.1rem;
    }

    .form-control {
        border: 2px solid rgba(1, 62, 126, 0.1);
        border-radius: 16px;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .form-control:focus {
        border-color: var(--warning-orange);
        box-shadow: 0 0 0 0.2rem rgba(255, 140, 0, 0.15),
                    0 8px 32px rgba(255, 140, 0, 0.1);
        transform: translateY(-2px);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .current-image-container {
        background: linear-gradient(145deg, #f8fafc 0%, #ffffff 100%);
        border: 2px dashed rgba(1, 62, 126, 0.2);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        text-align: center;
        transition: var(--transition);
    }

    .current-image-container:hover {
        border-color: var(--warning-orange);
        transform: scale(1.02);
    }

    .current-image {
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        transition: var(--transition);
        border: 3px solid var(--warning-orange);
    }

    .current-image:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 48px rgba(255, 140, 0, 0.3);
    }

    .image-label {
        color: var(--steel-gray);
        font-size: 0.9rem;
        margin-top: 0.75rem;
        font-weight: 500;
    }

    .form-check {
        background: linear-gradient(145deg, #f8fafc 0%, #ffffff 100%);
        border: 2px solid rgba(1, 62, 126, 0.1);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        transition: var(--transition);
    }

    .form-check:hover {
        border-color: var(--warning-orange);
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(255, 140, 0, 0.1);
    }

    .form-check-input {
        width: 1.5rem;
        height: 1.5rem;
        margin-right: 1rem;
        border: 2px solid var(--steel-gray);
        border-radius: 6px;
    }

    .form-check-input:checked {
        background-color: var(--warning-orange);
        border-color: var(--warning-orange);
    }

    .form-check-label {
        font-weight: 600;
        color: var(--dark-steel);
        font-size: 1.1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-check-label i {
        color: var(--success-green);
    }

    .btn-group {
        display: flex;
        gap: 1rem;
        margin-top: 2.5rem;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .btn {
        padding: 1rem 2rem;
        font-weight: 600;
        border-radius: 16px;
        border: none;
        font-size: 1.05rem;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
        position: relative;
        overflow: hidden;
        min-width: 140px;
        justify-content: center;
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
        background: linear-gradient(145deg, 
            var(--warning-orange) 0%, 
            rgba(255, 140, 0, 0.9) 100%);
        color: var(--text-white);
        box-shadow: 0 8px 32px rgba(255, 140, 0, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 48px rgba(255, 140, 0, 0.4);
        background: linear-gradient(145deg, 
            rgba(255, 140, 0, 0.9) 0%, 
            var(--warning-orange) 100%);
    }

    .btn-secondary {
        background: linear-gradient(145deg, 
            var(--steel-gray) 0%, 
            var(--light-steel) 100%);
        color: var(--text-white);
        box-shadow: 0 8px 32px rgba(74, 85, 104, 0.3);
    }

    .btn-secondary:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 48px rgba(74, 85, 104, 0.4);
        background: linear-gradient(145deg, 
            var(--light-steel) 0%, 
            var(--steel-gray) 100%);
    }

    .invalid-feedback {
        display: block;
        background: linear-gradient(145deg, #fee 0%, #fdd 100%);
        color: #dc3545;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        margin-top: 0.5rem;
        font-weight: 500;
        border-left: 4px solid #dc3545;
    }

    .is-invalid {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .main-container {
            padding: 1rem;
        }

        .page-header {
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .page-title {
            font-size: 1.8rem;
        }

        .form-container {
            padding: 1.5rem;
        }

        .btn-group {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }

    /* Animation Classes */
    .fade-in {
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="main-container">
    <!-- Page Header -->
    <div class="page-header fade-in">
        <h1 class="page-title">
            <i class="fas fa-edit"></i>
            Edit Lowongan Pekerjaan
        </h1>
    </div>
    
    <!-- Form Container -->
    <div class="form-container fade-in">
        <form action="{{ route('admin.lokers.update', $loker) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Title Field -->
            <div class="form-group">
                <label for="title" class="form-label">
                    <i class="fas fa-briefcase"></i>
                    Judul Lowongan
                </label>
                <input type="text" 
                       class="form-control @error('title') is-invalid @enderror" 
                       id="title" 
                       name="title" 
                       value="{{ old('title', $loker->title) }}" 
                       required
                       placeholder="Masukkan judul lowongan pekerjaan...">
                @error('title')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Poster Field -->
            <div class="form-group">
                <label for="poster" class="form-label">
                    <i class="fas fa-image"></i>
                    Poster (Portrait)
                </label>
                
                @if($loker->poster)
                    <div class="current-image-container">
                        <img src="{{ asset('storage/' . $loker->poster) }}" 
                             alt="Current Poster" 
                             class="current-image"
                             style="width: 120px; height: 168px; object-fit: cover;">
                        <div class="image-label">
                            <i class="fas fa-image text-success"></i>
                            Poster saat ini
                        </div>
                    </div>
                @endif
                
                <input type="file" 
                       class="form-control @error('poster') is-invalid @enderror" 
                       id="poster" 
                       name="poster" 
                       accept="image/*">
                <small class="text-muted">
                    <i class="fas fa-info-circle"></i>
                    Format yang didukung: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah poster.
                </small>
                @error('poster')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Description Field -->
            <div class="form-group">
                <label for="deskripsi" class="form-label">
                    <i class="fas fa-align-left"></i>
                    Deskripsi (Opsional)
                </label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                          id="deskripsi" 
                          name="deskripsi" 
                          rows="6"
                          placeholder="Masukkan deskripsi lowongan pekerjaan (opsional)...">{{ old('deskripsi', $loker->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Publish Status -->
            <div class="form-check">
                <input type="hidden" name="is_published" value="0">
                <input type="checkbox" 
                       class="form-check-input" 
                       id="is_published" 
                       name="is_published" 
                       value="1" 
                       {{ old('is_published', $loker->is_published) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_published">
                    <i class="fas fa-globe"></i>
                    Publikasikan lowongan ini
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Update Lowongan
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
// Add some interactive enhancements
document.addEventListener('DOMContentLoaded', function() {
    // File input enhancement
    const fileInput = document.getElementById('poster');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // You can add preview functionality here if needed
                console.log('File selected:', file.name);
            }
        });
    }

    // Form validation enhancement
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('.form-control');
    
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    });

    // Smooth scroll to error if exists
    const firstError = document.querySelector('.is-invalid');
    if (firstError) {
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
</script>
@endsection