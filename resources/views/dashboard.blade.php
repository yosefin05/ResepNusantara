@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f1e4;
    }

    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    /* Simple Header */
    .dashboard-header {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 5px 15px rgba(139, 69, 19, 0.1);
        border-left: 5px solid #8B4513;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
    }

    .header-text h1 {
        color: #8B4513;
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .header-text p {
        color: #A0522D;
        font-size: 1rem;
        margin: 0;
    }

    .btn-add-new {
        background: linear-gradient(135deg, #8B4513 0%, #A0522D 100%);
        color: white;
        padding: 0.875rem 2rem;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.2);
        white-space: nowrap;
    }

    .btn-add-new:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 69, 19, 0.3);
        color: white;
        text-decoration: none;
    }

    /* Success Alert */
    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border: 2px solid #28a745;
        color: #155724;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 500;
    }

    /* Stats Cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: white;
        padding: 2rem 1.5rem;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(139, 69, 19, 0.1);
        border: 2px solid transparent;
        transition: all 0.3s ease;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #8B4513 0%, #A0522D 100%);
    }

    .stat-card:hover {
        border-color: #8B4513;
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(139, 69, 19, 0.15);
    }

    .stat-icon {
        font-size: 2.5rem;
        color: #8B4513;
        margin-bottom: 1rem;
        opacity: 0.8;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #8B4513;
        margin-bottom: 0.5rem;
        line-height: 1;
    }

    .stat-label {
        color: #A0522D;
        font-weight: 500;
        font-size: 1rem;
    }

    /* Recipe Cards */
    .recipes-section {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(139, 69, 19, 0.1);
    }

    .section-title {
        color: #8B4513;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .recipes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
    }

    .recipe-card {
        background:rgb(242, 235, 222);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(139, 69, 19, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 2px solid transparent;
    }

    .recipe-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(139, 69, 19, 0.15);
        border-color: #8B4513;
        background: white;
    }

    .recipe-image-container {
        height: 200px;
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
        transform: scale(1.05);
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
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .recipe-title {
        font-weight: 600;
        font-size: 1.2rem;
        margin-bottom: 0.75rem;
        color: #8B4513;
        line-height: 1.3;
    }

    .meta-info {
        font-size: 0.85rem;
        color: #A0522D;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .meta-info i {
        width: 16px;
        text-align: center;
    }

    .recipe-excerpt {
        color: #6B4423;
        margin-top: 0.75rem;
        font-size: 0.9rem;
        line-height: 1.5;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-footer {
        padding: 0 1.5rem 1.5rem;
        background: transparent;
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }

    .btn-detail {
        background: #8B4513;
        color: white;
        padding: 0.6rem 1.5rem;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 2px solid #8B4513;
        flex: 1;
        text-align: center;
    }

    .btn-detail:hover {
        background: #A0522D;
        border-color: #A0522D;
        color: white;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .btn-group-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-icon {
        width: 38px;
        height: 38px;
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
        text-align: center;
        padding: 4rem 2rem;
        color: #A0522D;
    }

    .empty-icon {
        font-size: 4rem;
        color: #8B4513;
        margin-bottom: 1.5rem;
        opacity: 0.6;
    }

    .empty-state h3 {
        color: #8B4513;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .empty-state p {
        margin-bottom: 2rem;
        font-size: 1.1rem;
    }
</style>

<div class="dashboard-container">
    <!-- Simple Header -->
    <div class="dashboard-header">
        <div class="header-content">
            <div class="header-text">
                <h1>Dashboard Resep Nusantara</h1>
                <p>Kelola koleksi resep masakan tradisional Indonesia Anda</p>
            </div>
            <a href="{{ route('reseps.create') }}" class="btn-add-new">
                <i class="fas fa-plus-circle"></i>
                Tambah Resep Baru
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-utensils"></i>
            </div>
            <div class="stat-number">{{ $reseps->count() }}</div>
            <div class="stat-label">Total Resep</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="stat-number">{{ $reseps->where('user_id', auth()->id())->count() }}</div>
            <div class="stat-label">Resep Saya</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-calendar-week"></i>
            </div>
            <div class="stat-number">{{ $reseps->where('created_at', '>=', now()->subDays(7))->count() }}</div>
            <div class="stat-label">Resep Minggu Ini</div>
        </div>
    </div>

    <!-- Recipes Section -->
    <div class="recipes-section">
        <h2 class="section-title">
            <i class="fas fa-book-open"></i>
            Semua Resep
        </h2>

        @if($reseps->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-utensils"></i>
            </div>
            <h3>Belum ada resep yang tersedia</h3>
            <p>Mulai berbagi resep masakan favorit Anda dan lestarikan warisan kuliner Nusantara</p>
            <a href="{{ route('reseps.create') }}" class="btn-add-new">
                <i class="fas fa-plus-circle"></i>
                Buat Resep Pertama
            </a>
        </div>
        @else
        <div class="recipes-grid">
            @foreach ($reseps as $resep)
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
                    
                    <div class="meta-info">
                        <i class="fas fa-user"></i>
                        <span>{{ $resep->user->name }}</span>
                    </div>
                    
                    <div class="meta-info">
                        <i class="far fa-clock"></i>
                        <span>{{ $resep->created_at->diffForHumans() }}</span>
                    </div>
                    
                    <p class="recipe-excerpt">
                        {{ Str::words($resep->bahan, 20, '...') }}
                    </p>
                </div>

                <!-- Card Footer -->
                <div class="card-footer">
                    <div class="action-buttons">
                        <a href="{{ route('reseps.show', $resep->id) }}" class="btn-detail">
                            <i class="fas fa-eye me-1"></i>
                            Lihat Detail
                        </a>
                        
                        @if(auth()->user()->role === 'admin' || auth()->id() === $resep->user_id)
                        <div class="btn-group-actions">
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
                                        onclick="return confirm('Yakin ingin menghapus resep ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($reseps->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $reseps->links() }}
        </div>
        @endif
        @endif
    </div>
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