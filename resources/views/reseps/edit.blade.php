@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f1e4;
    }

    .form-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .form-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(139, 69, 19, 0.15);
        overflow: hidden;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .form-card:hover {
        border-color: #8B4513;
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(139, 69, 19, 0.2);
    }

    .form-header {
        background: linear-gradient(135deg, #A0522D 0%, #8B4513 100%);
        color: white;
        padding: 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .form-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .form-header h2 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        position: relative;
        z-index: 2;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .form-header::after {
        content: '✏️';
        font-size: 3rem;
        position: absolute;
        top: 50%;
        right: 2rem;
        transform: translateY(-50%);
        opacity: 0.3;
        z-index: 1;
    }

    .form-body {
        padding: 2.5rem;
    }

    .form-group {
        margin-bottom: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: #8B4513;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
    }

    .form-label i {
        color: #A0522D;
        width: 20px;
        text-align: center;
    }

    .form-control {
        border: 2px solid #e8d5c4;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #fefefe;
        font-family: 'Poppins', sans-serif;
    }

    .form-control:focus {
        border-color: #8B4513;
        box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.15);
        background: white;
        outline: none;
    }

    .form-control:hover {
        border-color: #A0522D;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        font-weight: 500;
    }

    .text-muted {
        color: #A0522D !important;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        font-style: italic;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
        line-height: 1.6;
    }

    /* Current Image Display */
    .current-image-container {
        background: linear-gradient(135deg, #f8f1e4 0%, #ffffff 100%);
        border: 2px solid #8B4513;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .current-image-label {
        color: #8B4513;
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .current-image {
        max-height: 250px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(139, 69, 19, 0.2);
        transition: all 0.3s ease;
    }

    .current-image:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 35px rgba(139, 69, 19, 0.3);
    }

    /* File Input */
    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        border: 2px dashed #A0522D;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        background: linear-gradient(135deg, #f8f1e4 0%, #ffffff 100%);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .file-input-wrapper:hover {
        border-color: #8B4513;
        background: linear-gradient(135deg, #ffffff 0%, #f8f1e4 100%);
        transform: translateY(-2px);
    }

    .file-input-wrapper input[type="file"] {
        position: absolute;
        left: -9999px;
    }

    .file-upload-text {
        color: #8B4513;
        font-weight: 500;
    }

    .file-upload-icon {
        font-size: 2rem;
        color: #A0522D;
        margin-bottom: 1rem;
    }

    .button-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid #f8f1e4;
    }

    .btn-custom {
        padding: 0.875rem 2rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-secondary-custom {
        background: white;
        color: #dc3545;
        border-color: #dc3545;
    }

    .btn-secondary-custom:hover {
        background: #dc3545;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #8B4513 0%, #A0522D 100%);
        color: white;
        border-color: #8B4513;
        position: relative;
        overflow: hidden;
    }

    .btn-primary-custom::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-primary-custom:hover::before {
        left: 100%;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(139, 69, 19, 0.4);
    }

    .form-section {
        background: #fafafa;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border-left: 4px solid #A0522D;
    }

    .section-title {
        color: #8B4513;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Edit Badge */
    .edit-badge {
        background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
        color: #8B4513;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-container {
            margin: 1rem auto;
            padding: 0 0.5rem;
        }

        .form-header {
            padding: 1.5rem;
        }

        .form-header h2 {
            font-size: 1.5rem;
        }

        .form-body {
            padding: 1.5rem;
        }

        .button-group {
            flex-direction: column;
            gap: 1rem;
        }

        .btn-custom {
            width: 100%;
            justify-content: center;
        }

        .form-header::after {
            display: none;
        }

        .current-image {
            max-height: 200px;
        }
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2>Edit Rese{{ $resep->judul }}</h2>
        </div>
        
        <div class="form-body">
            <div class="edit-badge">
                <i class="fas fa-edit"></i>
                Mode Edit - Ubah informasi resep Anda
            </div>

            <form action="{{ route('reseps.update', $resep->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul Resep -->
                <div class="form-group">
                    <label for="judul" class="form-label">
                        <i class="fas fa-utensils"></i>
                        Judul Resep
                    </label>
                    <input type="text" 
                           class="form-control @error('judul') is-invalid @enderror" 
                           id="judul" 
                           name="judul" 
                           value="{{ old('judul', $resep->judul) }}" 
                           placeholder="Masukkan nama resep yang menarik..."
                           required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Gambar Resep -->
                <div class="form-group">
                    <label for="gambar" class="form-label">
                        <i class="fas fa-camera"></i>
                        Gambar Resep
                    </label>
                    
                    <!-- Tampilkan gambar saat ini -->
                    @if($resep->gambar)
                    <div class="current-image-container">
                        <div class="current-image-label">
                            <i class="fas fa-image"></i>
                            Gambar Saat Ini
                        </div>
                        <img src="{{ asset('storage/' . $resep->gambar) }}" 
                             alt="{{ $resep->judul }}" 
                             class="current-image">
                    </div>
                    @endif
                    
                    <div class="file-input-wrapper" onclick="document.getElementById('gambar').click()">
                        <div class="file-upload-icon">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <div class="file-upload-text">
                            <strong>Klik untuk ganti gambar</strong><br>
                            atau drag & drop file baru di sini
                        </div>
                        <input type="file" 
                               class="form-control @error('gambar') is-invalid @enderror" 
                               id="gambar" 
                               name="gambar" 
                               accept="image/*">
                    </div>
                    <small class="text-muted">
                        <i class="fas fa-info-circle"></i>
                        Biarkan kosong jika tidak ingin mengubah gambar. Format: JPEG, PNG | Maksimal: 2MB
                    </small>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bahan-bahan -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fas fa-list-ul"></i>
                        Bahan-bahan
                    </div>
                    <div class="form-group mb-0">
                        <textarea class="form-control @error('bahan') is-invalid @enderror" 
                                  id="bahan" 
                                  name="bahan" 
                                  rows="6" 
                                  placeholder="Contoh:&#10;- 500gr beras&#10;- 2 lembar daun pandan&#10;- 400ml santan kental&#10;- 1 sdt garam"
                                  required>{{ old('bahan', $resep->bahan) }}</textarea>
                        @error('bahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Langkah Pembuatan -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fas fa-clipboard-list"></i>
                        Langkah Pembuatan
                    </div>
                    <div class="form-group mb-0">
                        <textarea class="form-control @error('langkah') is-invalid @enderror" 
                                  id="langkah" 
                                  name="langkah" 
                                  rows="8" 
                                  placeholder="Contoh:&#10;1. Cuci beras hingga bersih&#10;2. Rebus santan dengan daun pandan&#10;3. Masukkan beras dan aduk rata&#10;4. Masak hingga matang"
                                  required>{{ old('langkah', $resep->langkah) }}</textarea>
                        @error('langkah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Button Group -->
                <div class="button-group">
                    <a href="{{ route('reseps.show', $resep->id) }}" class="btn-custom btn-secondary-custom">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                    <button type="submit" class="btn-custom btn-primary-custom">
                        <i class="fas fa-save"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // File upload preview
    document.getElementById('gambar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const wrapper = document.querySelector('.file-input-wrapper');
        
        if (file) {
            const fileName = file.name;
            const fileSize = (file.size / 1024 / 1024).toFixed(2);
            
            wrapper.innerHTML = `
                <div class="file-upload-icon" style="color: #28a745;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="file-upload-text" style="color: #28a745;">
                    <strong>File baru dipilih: ${fileName}</strong><br>
                    Ukuran: ${fileSize} MB
                </div>
            `;
            wrapper.style.borderColor = '#28a745';
            wrapper.style.background = 'linear-gradient(135deg, #d4edda 0%, #ffffff 100%)';
        }
    });

    // Auto-resize textareas
    document.querySelectorAll('textarea').forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
        
        // Initial resize
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    });
</script>
@endsection