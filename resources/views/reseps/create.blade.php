@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        content: '👨‍🍳';
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

    /* File Input */
    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        border: 2px dashed #A0522D;
        border-radius: 12px;
        padding: 3rem 2rem;
        text-align: center;
        background: linear-gradient(135deg, #f8f1e4 0%, #ffffff 100%);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .file-input-wrapper:hover {
        border-color: #8B4513;
        background: linear-gradient(135deg, #ffffff 0%, #f8f1e4 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(139, 69, 19, 0.15);
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
        font-size: 3rem;
        color: #A0522D;
        margin-bottom: 1rem;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
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
        color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary-custom:hover {
        background: #6c757d;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
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

    /* Create Badge */
    .create-badge {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
        }
    }

    /* Welcome Message */
    .welcome-message {
        background: linear-gradient(135deg, #e3f2fd 0%, #ffffff 100%);
        border: 2px solid #2196f3;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        text-align: center;
    }

    .welcome-message h3 {
        color: #1976d2;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .welcome-message p {
        color: #424242;
        margin: 0;
    }

    /* Tips Section */
    .tips-section {
        background: linear-gradient(135deg, #fff3cd 0%, #ffffff 100%);
        border: 2px solid #ffc107;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .tips-title {
        color: #856404;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .tips-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tips-list li {
        color: #856404;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .tips-list li i {
        color: #ffc107;
        margin-top: 0.2rem;
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

        .file-input-wrapper {
            padding: 2rem 1rem;
        }
    }
    /* Loading state untuk button */
    .btn-loading {
        position: relative;
        pointer-events: none;
    }
    .btn-loading::after {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -9px 0 0 -9px;
        width: 18px;
        height: 18px;
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Error message container */
    .form-error-container {
        background-color: #fee;
        border-left: 4px solid #dc3545;
        padding: 1rem;
        margin-bottom: 1.5rem;
        border-radius: 4px;
        display: none;
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2>Buat Resep Baru</h2>
        </div>
        
        <div class="form-body">
            <div class="create-badge">
                <i class="fas fa-plus-circle"></i>
                Mode Buat - Bagikan resep lezat Anda!
            </div>

            <!-- Tips Section -->
            <div class="tips-section">
                <div class="tips-title">
                    <i class="fas fa-lightbulb"></i>
                    Tips Membuat Resep yang Menarik
                </div>
                <ul class="tips-list">
                    <li><i class="fas fa-star"></i> Gunakan judul yang menarik dan deskriptif</li>
                    <li><i class="fas fa-camera"></i> Upload foto yang menggugah selera</li>
                    <li><i class="fas fa-list"></i> Tulis bahan-bahan dengan takaran yang jelas</li>
                    <li><i class="fas fa-clipboard-check"></i> Jelaskan langkah-langkah dengan detail</li>
                </ul>
            </div>

            <form action="{{ route('reseps.store') }}" method="POST" enctype="multipart/form-data" id="resep-form">
                @csrf

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
                           value="{{ old('judul') }}" 
                           placeholder="Contoh: Nasi Gudeg Jogja Spesial, Rendang Daging Sapi Padang..."
                           required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">
                        <i class="fas fa-info-circle"></i>
                        Buat judul yang menarik dan menggambarkan resep Anda
                    </small>
                </div>

                <!-- Gambar Resep -->
                <div class="form-group">
                    <label for="gambar" class="form-label">
                        <i class="fas fa-camera"></i>
                        Gambar Resep
                    </label>
                    
                    <div class="file-input-wrapper" onclick="document.getElementById('gambar').click()">
                        <div class="file-upload-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <div class="file-upload-text">
                            <strong>Klik untuk upload gambar</strong><br>
                            atau drag & drop file di sini<br>
                            <small style="color: #6c757d;">Format: JPEG, PNG | Maksimal: 2MB</small>
                        </div>
                        <input type="file" 
                               class="form-control @error('gambar') is-invalid @enderror" 
                               id="gambar" 
                               name="gambar" 
                               accept="image/*"
                               required>
                    </div>
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
                                  placeholder="Contoh:&#10;- 500gr beras pulen&#10;- 2 lembar daun pandan&#10;- 400ml santan kental&#10;- 1 sdt garam halus&#10;- 2 sdm minyak goreng&#10;- 1 buah bawang merah (iris tipis)"
                                  required>{{ old('bahan') }}</textarea>
                        @error('bahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            <i class="fas fa-info-circle"></i>
                            Tulis setiap bahan dalam baris terpisah dengan takaran yang jelas
                        </small>
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
                                  placeholder="Contoh:&#10;1. Cuci beras hingga bersih, tiriskan&#10;2. Rebus santan dengan daun pandan dan garam hingga mendidih&#10;3. Masukkan beras, aduk rata dan masak dengan api kecil&#10;4. Tutup panci, masak selama 20 menit hingga nasi matang&#10;5. Angkat dan sajikan selagi hangat"
                                  required>{{ old('langkah') }}</textarea>
                        @error('langkah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            <i class="fas fa-info-circle"></i>
                            Jelaskan setiap langkah dengan detail agar mudah diikuti
                        </small>
                    </div>
                </div>

                <!-- Button Group -->
                <div class="button-group">
                    <a href="{{ route('dashboard') }}" class="btn-custom btn-secondary-custom">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                    <button type="submit" id="submit-btn" class="btn-custom btn-primary-custom">
                        <i class="fas fa-paper-plane"></i>
                        <span id="submit-text">Publikasikan Resep</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Inisialisasi
    document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('resep-form');
    if (!form) return;

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('submit-btn');
        const originalContent = submitBtn.innerHTML;
        
        // Set loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
        
        try {
            const formData = new FormData(form);
            
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });
            
            const result = await response.json();
            
            if (!response.ok) {
                throw new Error(result.message || 'Terjadi kesalahan saat menyimpan');
            }
            
            if (result.redirect) {
                window.location.href = result.redirect;
            } else {
                window.location.href = "{{ route('reseps.index') }}";
            }
            
        } catch (error) {
            console.error('Error:', error);
            
            // Tampilkan error
            const errorContainer = document.getElementById('form-error-container');
            errorContainer.innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> ${error.message}
                </div>
            `;
            errorContainer.style.display = 'block';
            errorContainer.scrollIntoView({ behavior: 'smooth' });
            
            // Reset button
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalContent;
        }
    });
});

        // Auto-resize textareas
        document.querySelectorAll('textarea').forEach(textarea => {
            setupTextareaResize(textarea);
            setupCharacterCounter(textarea);
        });

        // Form submission
        const form = document.getElementById('resep-form');
        if (form) {
            form.addEventListener('submit', handleFormSubmit);
        }
    });
    
    function previewImage(input) {
        const file = input.files[0];
        const wrapper = document.getElementById('file-upload-wrapper');
        const previewContainer = document.getElementById('image-preview-container');
        const previewImage = document.getElementById('image-preview');
        const uploadIcon = document.getElementById('upload-icon');
        const uploadText = document.getElementById('upload-text');

        if (file) {
            // Validasi ukuran file (maksimal 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 2MB');
                input.value = '';
                return;
            }

            // Validasi tipe file
            if (!file.type.match('image/jpeg') && !file.type.match('image/png')) {
                alert('Format file harus JPEG atau PNG');
                input.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                // Tampilkan preview
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
                
                // Ubah tampilan upload area
                wrapper.style.borderColor = '#28a745';
                wrapper.style.background = 'linear-gradient(135deg, #e8f5e9 0%, #ffffff 100%)';
                uploadIcon.innerHTML = '<i class="fas fa-check-circle" style="color: #28a745;"></i>';
                uploadText.innerHTML = `<strong style="color: #28a745;">${file.name}</strong><br>
                                      <small>${(file.size/1024/1024).toFixed(2)} MB</small>`;
            };

            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        const input = document.getElementById('gambar');
        const wrapper = document.getElementById('file-upload-wrapper');
        const previewContainer = document.getElementById('image-preview-container');
        const uploadIcon = document.getElementById('upload-icon');
        const uploadText = document.getElementById('upload-text');

        // Reset semua
        input.value = '';
        previewContainer.style.display = 'none';
        
        // Kembalikan ke tampilan awal
        wrapper.style.borderColor = '#A0522D';
        wrapper.style.background = 'linear-gradient(135deg, #f8f1e4 0%, #ffffff 100%)';
        uploadIcon.innerHTML = '<i class="fas fa-cloud-upload-alt"></i>';
        uploadText.innerHTML = `<strong>Klik untuk upload gambar</strong><br>
                              atau drag & drop file di sini<br>
                              <small style="color: #6c757d;">Format: JPEG, PNG | Maksimal: 2MB</small>`;
    }

    // Drag and drop functionality
    const wrapper = document.getElementById('file-upload-wrapper');
    
    wrapper.addEventListener('dragover', (e) => {
        e.preventDefault();
        wrapper.style.borderColor = '#8B4513';
        wrapper.style.boxShadow = '0 0 10px rgba(139, 69, 19, 0.3)';
    });

    wrapper.addEventListener('dragleave', () => {
        wrapper.style.borderColor = '#A0522D';
        wrapper.style.boxShadow = 'none';
    });

    wrapper.addEventListener('drop', (e) => {
        e.preventDefault();
        wrapper.style.borderColor = '#A0522D';
        wrapper.style.boxShadow = 'none';
        
        const input = document.getElementById('gambar');
        if (e.dataTransfer.files.length) {
            input.files = e.dataTransfer.files;
            previewImage(input);
        }
    });

    // Fungsi untuk handle file upload
    function handleFileUpload(e) {
        const file = e.target.files[0];
        const wrapper = document.querySelector('.file-input-wrapper');
        
        if (!file) return;

        // Validasi file
        const validTypes = ['image/jpeg', 'image/png'];
        const maxSize = 2 * 1024 * 1024; // 2MB

        if (!validTypes.includes(file.type)) {
            showError('Format file harus JPEG atau PNG');
            e.target.value = '';
            return;
        }

        if (file.size > maxSize) {
            showError('Ukuran file maksimal 2MB');
            e.target.value = '';
            return;
        }

        // Tampilkan preview
        const reader = new FileReader();
        reader.onload = function(e) {
            wrapper.innerHTML = `
                <div style="position: relative;">
                    <img src="${e.target.result}" 
                         style="max-height: 200px; border-radius: 12px; box-shadow: 0 8px 25px rgba(139, 69, 19, 0.2);">
                    <div style="margin-top: 1rem;">
                        <div class="file-upload-icon" style="color: #28a745; font-size: 2rem; animation: none;">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="file-upload-text" style="color: #28a745;">
                            <strong>Gambar berhasil dipilih!</strong><br>
                            ${file.name} (${(file.size/1024/1024).toFixed(2)} MB)
                        </div>
                    </div>
                </div>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
            `;
            wrapper.style.borderColor = '#28a745';
            wrapper.style.background = 'linear-gradient(135deg, #d4edda 0%, #ffffff 100%)';
        };
        reader.readAsDataURL(file);
    }

    // Fungsi untuk handle form submission
    async function handleFormSubmit(e) {
        e.preventDefault();
        
        const form = e.target;
        const submitBtn = document.getElementById('submit-btn');
        const submitText = document.getElementById('submit-text');
        const errorContainer = document.getElementById('form-error-container');
        
        // Reset error
        errorContainer.style.display = 'none';
        errorContainer.innerHTML = '';
        
        // Validasi sederhana di client side
        const requiredFields = ['judul', 'gambar', 'bahan', 'langkah'];
        let isValid = true;
        
        requiredFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (!field.value.trim() && fieldId !== 'gambar') {
                field.classList.add('is-invalid');
                isValid = false;
            }
            
            if (fieldId === 'gambar' && !field.files[0]) {
                field.closest('.file-input-wrapper').style.borderColor = '#dc3545';
                isValid = false;
            }
        });
        
        if (!isValid) {
            showError('Mohon lengkapi semua field yang diperlukan');
            return;
        }
        
        // Set loading state
        submitBtn.classList.add('btn-loading');
        submitText.textContent = 'Mengirim...';
        submitBtn.disabled = true;
        
        try {
            const formData = new FormData(form);
            
            // Kirim data via fetch
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            
            const result = await response.json();
            
            if (!response.ok) {
                throw new Error(result.message || 'Terjadi kesalahan pada server');
            }
            
            // Jika sukses, redirect
            window.location.href = result.redirect || "{{ route('reseps.index') }}";
            
        } catch (error) {
            console.error('Error:', error);
            showError(error.message);
            
            // Reset loading state
            submitBtn.classList.remove('btn-loading');
            submitText.textContent = 'Publikasikan Resep';
            submitBtn.disabled = false;
        }
    }

    // Fungsi untuk menampilkan error
    function showError(message) {
        const errorContainer = document.getElementById('form-error-container');
        errorContainer.innerHTML = `
            <p><strong>Error:</strong> ${message}</p>
            <p>Silakan periksa kembali form Anda.</p>
        `;
        errorContainer.style.display = 'block';
        
        // Scroll ke error
        errorContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Fungsi untuk auto-resize textarea
    function setupTextareaResize(textarea) {
        function resize() {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        }
        
        textarea.addEventListener('input', resize);
        resize(); // Initial resize
    }

    // Fungsi untuk character counter
    function setupCharacterCounter(textarea) {
        const maxLength = textarea.id === 'bahan' ? 1000 : 2000;
        const counter = document.createElement('small');
        counter.className = 'text-muted';
        counter.style.float = 'right';
        counter.style.marginTop = '0.5rem';
        
        textarea.parentNode.appendChild(counter);
        
        function updateCounter() {
            const remaining = maxLength - textarea.value.length;
            counter.textContent = `${textarea.value.length}/${maxLength} karakter`;
            counter.style.color = remaining < 100 ? '#dc3545' : '#A0522D';
        }
        
        textarea.addEventListener('input', updateCounter);
        updateCounter();
    }
</script>
@endsection