@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f1e4;
    }

    .page-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    /* Header Section */
    .page-header {
        background: linear-gradient(135deg, #8B4513 0%, #A0522D 100%);
        color: white;
        padding: 3rem 2rem;
        border-radius: 20px;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(139, 69, 19, 0.3);
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        z-index: 2;
    }

    .header-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .header-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-top: 0.5rem;
    }

    .btn-add-recipe {
        background: white;
        color: #8B4513;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        font-size: 1.1rem;
    }

    .btn-add-recipe:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        color: #8B4513;
        text-decoration: none;
    }

    .btn-add-recipe i {
        font-size: 1.2rem;
    }

    /* Stats Section */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(139, 69, 19, 0.1);
        border: 2px solid transparent;
        transition: all 0.3s ease;
        text-align: center;
    }

    .stat-card:hover {
        border-color: #8B4513;
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(139, 69, 19, 0.2);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #8B4513;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #A0522D;
        font-weight: 500;
        font-size: 1rem;
    }

    .stat-icon {
        font-size: 2rem;
        color: #A0522D;
        margin-bottom: 1rem;
        opacity: 0.7;
    }

    /* Recipe Cards */
    .recipes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .recipe-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(139, 69, 19, 0.1);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
    }

    .recipe-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(139, 69, 19, 0.2);
        border-color: #8B4513;
    }

    .recipe-image-container {
        height: 220px;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #f8f1e4 0%, #e8d5c4 100%);
    }

    .recipe-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .recipe-card:hover .recipe-img {
        transform: scale(1.1);
    }

    .no-image {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #8B4513;
        font-size: 2rem;
        background: linear-gradient(135deg, #f8f1e4 0%, #e8d5c4 100%);
    }

    .card-content {
        padding: 1.5rem;
    }

    .recipe-title {
        font-weight: 600;
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
        color: #8B4513;
        line-height: 1.3;
    }

    .recipe-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
        font-size: 0.85rem;
        color: #A0522D;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .recipe-excerpt {
        color: #6B4423;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }

    .btn-view {
        background: #8B4513;
        color: white;
        padding: 0.6rem 1.5rem;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        flex: 1;
        text-align: center;
    }

    .btn-view:hover {
        background: #A0522D;
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.2s ease;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .btn-edit {
        color: #D4A574;
        border: 2px solid #D4A574;
        background: white;
    }

    .btn-edit:hover {
        background: #D4A574;
        color: white;
        transform: translateY(-2px);
    }

    .btn-delete {
        color: #CD853F;
        border: 2px solid #CD853F;
        background: white;
    }

    .btn-delete:hover {
        background: #CD853F;
        color: white;
        transform: translateY(-2px);
    }

    /* Empty State */
    .empty-state {
        background: white;
        padding: 4rem 2rem;
        text-align: center;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(139, 69, 19, 0.1);
        border: 2px solid #f8f1e4;
    }

    .empty-icon {
        font-size: 5rem;
        color: #8B4513;
        margin-bottom: 2rem;
        opacity: 0.6;
    }

    .empty-title {
        color: #8B4513;
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .empty-text {
        color: #A0522D;
        margin-bottom: 2rem;
        font-size: 1.1rem;
    }

    .btn-create-first {
        background: linear-gradient(135deg, #8B4513 0%, #A0522D 100%);
        color: white;
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        font-size: 1.1rem;
    }

    .btn-create-first:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(139, 69, 19, 0.4);
        color: white;
        text-decoration: none;
    }

    /* Pagination */
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
    }
</style>

<div class="page-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <div>
                <h1 class="header-title">
                    <i class="fas fa-book"></i>
                    Resep Saya
                </h1>
                <p class="header-subtitle">Koleksi resep masakan tradisional yang telah Anda buat</p>
            </div>
            <a href="{{ route('reseps.create') }}" class="btn-add-recipe">
                <i class="fas fa-plus-circle"></i>
                Resep Baru
            </a>
        </div>
    </div>

    @if(!$reseps->isEmpty())
    <!-- Stats Section -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-utensils"></i>
            </div>
            <div class="stat-number">{{ $reseps->total() }}</div>
            <div class="stat-label">Total Resep</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-calendar-week"></i>
            </div>
            <div class="stat-number">{{ $reseps->where('created_at', '>=', now()->subDays(7))->count() }}</div>
            <div class="stat-label">Minggu Ini</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-calendar-day"></i>
            </div>
            <div class="stat-number">{{ $reseps->where('created_at', '>=', now()->subDays(30))->count() }}</div>
            <div class="stat-label">Bulan Ini</div>
        </div>
    </div>
    @endif

    <!-- Recipes Grid -->
    @if($reseps->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <h3 class="empty-title">Belum Ada Resep</h3>
            <p class="empty-text">Mulai berbagi resep masakan favorit Anda dan lestarikan warisan kuliner Nusantara</p>
            <a href="{{ route('reseps.create') }}" class="btn-create-first">
                <i class="fas fa-plus-circle"></i>
                Buat Resep Pertama
            </a>
        </div>
    @else
        <div class="recipes-grid">
            @foreach($reseps as $resep)
            <div class="recipe-card">
                <!-- Recipe Image -->
                <div class="recipe-image-container">
                    @if($resep->gambar)
                    <img src="{{ asset('storage/' . $resep->gambar) }}" 
                         alt="{{ $resep->judul }}"
                         class="recipe-img">
                    @else
                    <div class="no-image">
                        <i class="fas fa-image"></i>
                    </div>
                    @endif
                </div>

                <!-- Recipe Content -->
                <div class="card-content">
                    <h3 class="recipe-title">{{ $resep->judul }}</h3>
                    
                    <div class="recipe-meta">
                        <div class="meta-item">
                            <i class="far fa-clock"></i>
                            <span>{{ $resep->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-calendar"></i>
                            <span>{{ $resep->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    
                    <p class="recipe-excerpt">
                        {{ Str::words($resep->bahan, 15, '...') }}
                    </p>

                    <!-- Card Actions -->
                    <div class="card-actions">
                        <a href="{{ route('reseps.show', $resep->id) }}" class="btn-view">
                            <i class="fas fa-eye me-1"></i>
                            Lihat Detail
                        </a>
                        
                        <div class="action-buttons">
                            <a href="{{ route('reseps.edit', $resep->id) }}" 
                               class="btn-icon btn-edit"
                               title="Edit Resep">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <form action="{{ route('reseps.destroy', $resep->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn-icon btn-delete"
                                        title="Hapus Resep"
                                        onclick="return confirm('Yakin ingin menghapus resep {{ $resep->judul }}?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($reseps->hasPages())
        <div class="pagination-container">
            {{ $reseps->links() }}
        </div>
        @endif
    @endif
</div>

<!-- Custom Pagination Styles -->
<style>
    .pagination {
        gap: 0.5rem;
    }
    
    .page-link {
        color: #8B4513;
        border: 2px solid #8B4513;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        margin: 0 0.25rem;
        transition: all 0.2s ease;
    }
    
    .page-link:hover {
        background-color: #8B4513;
        color: white;
        border-color: #8B4513;
    }
    
    .page-item.active .page-link {
        background-color: #8B4513;
        border-color: #8B4513;
        color: white;
    }
</style>
@endsection