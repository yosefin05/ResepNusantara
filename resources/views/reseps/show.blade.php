@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f1e4;
    }

    .recipe-container {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .recipe-card {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(139, 69, 19, 0.15);
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .recipe-card:hover {
        border-color: #8B4513;
        transform: translateY(-5px);
        box-shadow: 0 25px 60px rgba(139, 69, 19, 0.2);
    }

    /* Hero Image Section */
    .recipe-hero {
        position: relative;
        height: 400px;
        overflow: hidden;
        background: linear-gradient(135deg, #f8f1e4 0%, #e8d5c4 100%);
    }

    .recipe-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .recipe-card:hover .recipe-image {
        transform: scale(1.05);
    }

    .no-image {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #8B4513;
        font-size: 4rem;
        background: linear-gradient(135deg, #f8f1e4 0%, #e8d5c4 100%);
    }

    .recipe-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        padding: 3rem 2rem 2rem;
        color: white;
    }

    .recipe-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0 0 1rem 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        line-height: 1.2;
    }

    .recipe-meta {
        display: flex;
        align-items: center;
        gap: 2rem;
        font-size: 1rem;
        opacity: 0.95;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .meta-item i {
        font-size: 1.1rem;
    }

    /* Content Section */
    .recipe-content {
        padding: 3rem 2.5rem;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-top: 2rem;
    }

    .content-section {
        background: #fafafa;
        border-radius: 20px;
        overflow: hidden;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        height: fit-content;
    }

    .content-section:hover {
        border-color: #8B4513;
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(139, 69, 19, 0.1);
    }

    .section-header {
        background: linear-gradient(135deg, #8B4513 0%, #A0522D 100%);
        color: white;
        padding: 1.5rem 2rem;
        position: relative;
        overflow: hidden;
    }

    .section-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        position: relative;
        z-index: 2;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    }

    .section-title i {
        font-size: 1.4rem;
    }

    .section-content {
        padding: 2rem;
        line-height: 1.8;
        color: #6B4423;
        font-size: 1rem;
    }

    .section-content pre {
        white-space: pre-line;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        background: none;
        border: none;
        padding: 0;
        color: inherit;
    }

    /* Action Buttons */
    .recipe-actions {
        background: linear-gradient(135deg, #f8f1e4 0%, #ffffff 100%);
        padding: 2rem 2.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        border-top: 2px solid #8B4513;
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
        gap: 0.75rem;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-back {
        background: white;
        color: #8B4513;
        border-color: #8B4513;
    }

    .btn-back:hover {
        background: #8B4513;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 69, 19, 0.3);
        text-decoration: none;
    }

    .btn-edit {
        background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
        color: #8B4513;
        border-color: #DAA520;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #FFD700 0%, #DAA520 100%);
        color: #8B4513;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(218, 165, 32, 0.4);
        text-decoration: none;
    }

    .btn-delete {
        background: white;
        color: #dc3545;
        border-color: #dc3545;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }

    .actions-left {
        display: flex;
        gap: 1rem;
    }

    .actions-right {
        display: flex;
        gap: 1rem;
    }

    /* Author Badge */
    .author-badge {
        position: absolute;
        top: 2rem;
        right: 2rem;
        background: rgba(255, 255, 255, 0.95);
        color: #8B4513;
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .recipe-container {
            margin: 1rem auto;
            padding: 0 0.5rem;
        }

        .recipe-hero {
            height: 300px;
        }

        .recipe-title {
            font-size: 2rem;
        }

        .recipe-content {
            padding: 2rem 1.5rem;
        }

        .content-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .recipe-actions {
            padding: 1.5rem;
            flex-direction: column;
            gap: 1rem;
        }

        .actions-left,
        .actions-right {
            width: 100%;
            justify-content: center;
        }

        .btn-custom {
            flex: 1;
            justify-content: center;
        }

        .recipe-meta {
            flex-direction: column;
            gap: 0.5rem;
            align-items: flex-start;
        }

        .author-badge {
            position: static;
            margin-bottom: 1rem;
            align-self: flex-start;
        }
    }

    /* Print Styles */
    @media print {
        .recipe-actions {
            display: none;
        }
        
        .recipe-card {
            box-shadow: none;
            border: 1px solid #ddd;
        }
    }
</style>

<div class="recipe-container">
    <div class="recipe-card">
        <!-- Hero Section -->
        <div class="recipe-hero">
            @if($resep->gambar)
                <img src="{{ asset('storage/' . $resep->gambar) }}" 
                     class="recipe-image"
                     alt="{{ $resep->judul }}">
            @else
                <div class="no-image">
                    <i class="fas fa-utensils"></i>
                </div>
            @endif
            
            <div class="author-badge">
                <i class="fas fa-user-circle"></i>
                {{ $resep->user->name }}
            </div>
            
            <div class="recipe-overlay">
                <h1 class="recipe-title">{{ $resep->judul }}</h1>
                <div class="recipe-meta">
                    <div class="meta-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ $resep->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-clock"></i>
                        <span>{{ $resep->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="recipe-content">
            <div class="content-grid">
                <!-- Bahan-bahan -->
                <div class="content-section">
                    <div class="section-header">
                        <h4 class="section-title">
                            <i class="fas fa-list-ul"></i>
                            Bahan-bahan
                        </h4>
                    </div>
                    <div class="section-content">
                        <pre>{{ $resep->bahan }}</pre>
                    </div>
                </div>

                <!-- Langkah Pembuatan -->
                <div class="content-section">
                    <div class="section-header">
                        <h4 class="section-title">
                            <i class="fas fa-clipboard-list"></i>
                            Langkah Pembuatan
                        </h4>
                    </div>
                    <div class="section-content">
                        <pre>{{ $resep->langkah }}</pre>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="recipe-actions">
            <div class="actions-left">
                <a href="{{ route('reseps.index') }}" class="btn-custom btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Daftar
                </a>
            </div>
            
            <div class="actions-right">
                @can('update', $resep)
                    <a href="{{ route('reseps.edit', $resep->id) }}" class="btn-custom btn-edit">
                        <i class="fas fa-edit"></i>
                        Edit Resep
                    </a>
                @endcan

                @can('delete', $resep)
                    <form action="{{ route('reseps.destroy', $resep->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn-custom btn-delete" 
                                onclick="return confirm('Yakin ingin menghapus resep {{ $resep->judul }}?')">
                            <i class="fas fa-trash"></i>
                            Hapus
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection