<div class="card h-100 shadow-sm">
    @if($resep->image)
    <img src="{{ asset('storage/' . $resep->image) }}" class="card-img-top" alt="{{ $resep->judul }}" style="height: 180px; object-fit: cover;">
    @else
    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
        <i class="fas fa-utensils fa-3x text-muted"></i>
    </div>
    @endif
    
    <div class="card-body">
        <h5 class="card-title">{{ $resep->judul }}</h5>
        
        <div class="card-text mb-3">
            <small class="text-muted">Bahan utama:</small>
            <div class="text-truncate">
                {{ Str::limit(strip_tags($resep->bahan), 60) }}
            </div>
        </div>
    </div>
    
    <div class="card-footer bg-white">
        <a href="{{ route('reseps.show', $resep) }}" class="btn btn-sm btn-outline-primary">
            Lihat Detail
        </a>
        @if($editable ?? false)
        <div class="float-end">
            <a href="{{ route('reseps.edit', $resep) }}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('reseps.destroy', $resep) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus resep ini?')">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
        @endif
    </div>
</div>