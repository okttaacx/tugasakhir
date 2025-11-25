@extends('layouts.adminapp')

@section('title', 'Ubah Berita')

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

    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, var(--metallic-silver) 0%, #f7fafc 100%);
        color: var(--dark-steel);
    }

    .page-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
        position: relative;
    }

    .page-wrapper::before {
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
            rgba(1, 62, 126, 0.02) 100px,
            rgba(1, 62, 126, 0.02) 102px
        );
        pointer-events: none;
        z-index: 0;
    }

    /* Industrial Form Card */
    .industrial-form-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: 2px solid rgba(1, 62, 126, 0.1);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 
            0 25px 60px -12px rgba(0, 0, 0, 0.12),
            0 8px 32px -8px rgba(1, 62, 126, 0.08);
        position: relative;
        z-index: 1;
    }

    .industrial-form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, 
            var(--primary-blue) 0%, 
            var(--warning-orange) 50%, 
            var(--primary-blue) 100%);
    }

    /* Industrial Header */
    .industrial-header {
        background: linear-gradient(135deg, 
            var(--carbon-black) 0%, 
            var(--dark-steel) 50%, 
            var(--steel-gray) 100%);
        color: var(--text-white);
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
    }

    .industrial-header::before {
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
            rgba(255, 140, 0, 0.05) 2px,
            rgba(255, 140, 0, 0.05) 4px
        );
        pointer-events: none;
    }

    .industrial-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-light);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        transition: var(--transition);
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 2;
    }

    .industrial-back-btn:hover {
        color: var(--text-white);
        border-color: var(--warning-orange);
        background: rgba(255, 140, 0, 0.2);
        transform: translateX(-5px);
    }

    .industrial-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0;
        position: relative;
        z-index: 2;
        letter-spacing: 1px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .industrial-title::after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: var(--warning-orange);
        border-radius: 2px;
        margin-top: 0.75rem;
        box-shadow: 0 2px 8px rgba(255, 140, 0, 0.4);
    }

    /* Industrial Form Body */
    .industrial-form-body {
        padding: 3rem;
        position: relative;
    }

    .industrial-form-group {
        margin-bottom: 2rem;
        position: relative;
    }

    .industrial-label {
        display: block;
        font-weight: 700;
        color: var(--dark-steel);
        margin-bottom: 0.75rem;
        font-size: 1rem;
        letter-spacing: 0.5px;
        position: relative;
    }

    .industrial-label::before {
        content: '';
        position: absolute;
        left: -1rem;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 100%;
        background: var(--warning-orange);
        border-radius: 2px;
        opacity: 0;
        transition: var(--transition);
    }

    .industrial-form-group:focus-within .industrial-label::before {
        opacity: 1;
    }

    .industrial-input,
    .industrial-textarea,
    .industrial-select {
        width: 100%;
        padding: 1rem 1.25rem;
        border: 2px solid #cbd5e1;
        border-radius: 12px;
        font-size: 1rem;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        transition: var(--transition);
        position: relative;
    }

    .industrial-input:focus,
    .industrial-textarea:focus,
    .industrial-select:focus {
        outline: none;
        border-color: var(--warning-orange);
        background: #ffffff;
        box-shadow: 
            0 0 0 4px rgba(255, 140, 0, 0.15),
            0 8px 24px -8px rgba(255, 140, 0, 0.2);
        transform: translateY(-2px);
    }

    .industrial-textarea {
        min-height: 200px;
        resize: vertical;
        line-height: 1.6;
    }

    .error {
        border-color: #ef4444 !important;
        background: linear-gradient(145deg, #fef2f2 0%, #fee2e2 100%) !important;
    }

    .error-message {
        color: #dc2626;
        font-size: 0.875rem;
        font-weight: 600;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .error-message::before {
        content: '⚠';
        color: #ef4444;
    }

    .help-text {
        color: var(--light-steel);
        font-size: 0.875rem;
        margin-top: 0.5rem;
        font-weight: 500;
    }

    /* Industrial Thumbnail Display */
    .industrial-thumbnail-display {
        display: inline-block;
        padding: 1.5rem;
        background: linear-gradient(145deg, #f1f5f9 0%, #e2e8f0 100%);
        border: 2px dashed var(--light-steel);
        border-radius: 16px;
        margin-bottom: 1.5rem;
        text-align: center;
        transition: var(--transition);
        position: relative;
    }

    .industrial-thumbnail-display::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, 
            var(--warning-orange) 0%, 
            var(--primary-blue) 50%, 
            var(--warning-orange) 100%);
        border-radius: 18px;
        z-index: -1;
        opacity: 0;
        transition: var(--transition);
    }

    .industrial-thumbnail-display:hover::before {
        opacity: 0.3;
    }

    .industrial-thumbnail-display img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 12px;
        border: 3px solid var(--warning-orange);
        box-shadow: 0 8px 24px -8px rgba(0, 0, 0, 0.2);
        transition: var(--transition);
    }

    .industrial-thumbnail-display img:hover {
        transform: scale(1.05);
    }

    .thumbnail-label {
        display: block;
        margin-top: 1rem;
        color: var(--steel-gray);
        font-size: 0.875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Industrial File Input */
    .industrial-file-wrapper {
        position: relative;
        overflow: hidden;
        display: block;
    }

    .industrial-file-input {
        position: absolute;
        left: -9999px;
        opacity: 0;
    }

    .industrial-file-button {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.5rem;
        background: linear-gradient(145deg, 
            var(--steel-gray) 0%, 
            var(--dark-steel) 100%);
        color: var(--text-white);
        border: none;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 700;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: var(--transition);
        box-shadow: 0 6px 16px -6px rgba(45, 55, 72, 0.4);
        position: relative;
        overflow: hidden;
    }

    .industrial-file-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 140, 0, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .industrial-file-button:hover::before {
        left: 100%;
    }

    .industrial-file-button:hover {
        background: linear-gradient(145deg, 
            var(--warning-orange) 0%, 
            #e67e00 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px -8px rgba(255, 140, 0, 0.4);
    }

    /* Industrial Action Buttons */
    .industrial-actions {
        display: flex;
        gap: 1.5rem;
        justify-content: flex-end;
        padding-top: 2rem;
        border-top: 2px solid rgba(1, 62, 126, 0.1);
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .industrial-btn {
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        min-height: 52px;
        box-shadow: 0 6px 16px -6px rgba(0, 0, 0, 0.2);
    }

    .industrial-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .industrial-btn:hover::before {
        left: 100%;
    }

    .industrial-btn-secondary {
        background: linear-gradient(145deg, 
            var(--metallic-silver) 0%, 
            #cbd5e1 100%);
        color: var(--dark-steel);
        border: 2px solid var(--light-steel);
    }

    .industrial-btn-secondary:hover {
        background: linear-gradient(145deg, 
            var(--light-steel) 0%, 
            var(--steel-gray) 100%);
        color: var(--text-white);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px -8px rgba(113, 128, 150, 0.4);
    }

    .industrial-btn-primary {
        background: linear-gradient(145deg, 
            var(--primary-blue) 0%, 
            var(--warning-orange) 100%);
        color: var(--text-white);
        border: 2px solid transparent;
    }

    .industrial-btn-primary:hover {
        background: linear-gradient(145deg, 
            var(--warning-orange) 0%, 
            #e67e00 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px -8px rgba(255, 140, 0, 0.4);
    }

    .icon-industrial {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-wrapper {
            padding: 1rem 0.5rem;
        }

        .industrial-form-body {
            padding: 2rem 1.5rem;
        }

        .industrial-header {
            padding: 2rem 1.5rem;
        }

        .industrial-title {
            font-size: 1.8rem;
        }

        .industrial-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .industrial-btn {
            justify-content: center;
        }

        .industrial-thumbnail-display img {
            width: 120px;
            height: 120px;
        }
    }

    @media (max-width: 480px) {
        .industrial-title {
            font-size: 1.6rem;
        }

        .industrial-form-group {
            margin-bottom: 1.5rem;
        }

        .industrial-input,
        .industrial-textarea,
        .industrial-select {
            padding: 0.875rem 1rem;
        }
    }

    /* Loading Animation */
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

    .industrial-form-card {
        animation: slideInUp 0.8s ease-out;
    }

    .industrial-form-group {
        animation: slideInUp 0.6s ease-out;
    }

    .industrial-form-group:nth-child(1) { animation-delay: 0.1s; }
    .industrial-form-group:nth-child(2) { animation-delay: 0.2s; }
    .industrial-form-group:nth-child(3) { animation-delay: 0.3s; }
    .industrial-form-group:nth-child(4) { animation-delay: 0.4s; }
</style>

<div class="page-wrapper">
    <div class="industrial-form-card">
        <div class="industrial-header">
            <a href="{{ route('news.show', $news) }}" class="industrial-back-btn" aria-label="Kembali ke detail berita">
                <svg class="icon-industrial" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>Kembali ke Detail</span>
            </a>
            <h1 class="industrial-title">Ubah Berita</h1>
        </div>

        <form action="{{ route('news.update', $news) }}" method="POST" enctype="multipart/form-data" class="industrial-form-body" novalidate>
            @csrf
            @method('PUT')

            <div class="industrial-form-group">
                <label for="title" class="industrial-label">Judul Berita</label>
                <input type="text"
                       name="title"
                       id="title"
                       value="{{ old('title', $news->title) }}"
                       class="industrial-input @error('title') error @enderror"
                       required
                       aria-required="true"
                       aria-describedby="title-error"
                       placeholder="Masukkan judul berita yang menarik...">
                @error('title')
                    <p class="error-message" id="title-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="industrial-form-group">
                <label for="thumbnail" class="industrial-label">Gambar Thumbnail</label>

                @if($news->thumbnail)
                    <div class="industrial-thumbnail-display">
                        <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="Thumbnail saat ini">
                        <span class="thumbnail-label">Thumbnail Aktif</span>
                    </div>
                @endif

                <div class="industrial-file-wrapper">
                    <input type="file"
                           name="thumbnail"
                           id="thumbnail"
                           accept="image/*"
                           class="industrial-file-input @error('thumbnail') error @enderror"
                           aria-describedby="thumbnail-help">
                    <label for="thumbnail" class="industrial-file-button">
                        <svg class="icon-industrial" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Pilih Gambar Baru</span>
                    </label>
                </div>

                @error('thumbnail')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <p class="help-text" id="thumbnail-help">Kosongkan jika tidak ingin mengubah. Format: JPEG, PNG, JPG, GIF. Max: 2MB</p>
            </div>

            <div class="industrial-form-group">
                <label for="content" class="industrial-label">Konten Berita</label>
                <textarea name="content"
                          id="content"
                          rows="15"
                          class="industrial-textarea @error('content') error @enderror"
                          required
                          aria-required="true"
                          aria-describedby="content-error"
                          placeholder="Tulis konten berita Anda di sini...">{{ old('content', $news->content) }}</textarea>
                @error('content')
                    <p class="error-message" id="content-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="industrial-form-group">
                <label for="status" class="industrial-label">Status Publikasi</label>
                <select name="status"
                        id="status"
                        class="industrial-select"
                        aria-label="Status publikasi berita">
                    <option value="draft" {{ old('status', $news->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $news->status) === 'published' ? 'selected' : '' }}>Terbitkan</option>
                </select>
            </div>

            <div class="industrial-actions">
                <a href="{{ route('news.show', $news) }}" class="industrial-btn industrial-btn-secondary" aria-label="Batal dan kembali">
                    <svg class="icon-industrial" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span>Batal</span>
                </a>
                <button type="submit" class="industrial-btn industrial-btn-primary">
                    <svg class="icon-industrial" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Perbarui Berita</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- CKEditor 5 Integration -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // CKEditor initialization (commented out as in original)
        // ClassicEditor
        //     .create(document.querySelector('#content'), {
        //         // ... CKEditor config
        //     })
        //     .catch(error => {
        //         console.error('Editor initialization failed:', error);
        //     });

        // Enhanced file input handling
        const fileInput = document.getElementById('thumbnail');
        const fileButton = document.querySelector('label[for="thumbnail"]');
        const originalButtonText = fileButton.querySelector('span').textContent;

        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const buttonSpan = fileButton.querySelector('span');
            
            if (file) {
                buttonSpan.textContent = file.name;
                fileButton.style.background = 'linear-gradient(145deg, var(--success-green) 0%, #2f855a 100%)';
                
                // File size validation
                if (file.size > 2 * 1024 * 1024) { // 2MB
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    fileInput.value = '';
                    buttonSpan.textContent = originalButtonText;
                    fileButton.style.background = '';
                }
            } else {
                buttonSpan.textContent = originalButtonText;
                fileButton.style.background = '';
            }
        });

        // Form validation enhancement
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            const content = document.getElementById('content').value.trim();
            
            if (!title || !content) {
                e.preventDefault();
                alert('Harap lengkapi semua field yang wajib diisi.');
                
                if (!title) document.getElementById('title').focus();
                else if (!content) document.getElementById('content').focus();
            }
        });

        // Auto-resize textarea
        const textarea = document.getElementById('content');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.max(this.scrollHeight, 200) + 'px';
        });

        // Loading state for submit button
        const submitBtn = document.querySelector('.industrial-btn-primary');
        form.addEventListener('submit', function() {
            submitBtn.style.opacity = '0.7';
            submitBtn.style.pointerEvents = 'none';
            submitBtn.querySelector('span').textContent = 'Memproses...';
        });

        console.log('Industrial News Edit Form Initialized');
    });
</script>
@endsection