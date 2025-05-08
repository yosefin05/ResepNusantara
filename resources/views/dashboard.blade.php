@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mt-4 text-center">Daftar Resep</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($reseps->isEmpty())
            <p class="text-center text-muted">Belum ada resep yang diunggah.</p>
        @else
            <div class="row">
                @foreach ($reseps as $resep)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h3 class="card-title text-primary">{{ $resep->judul }}</h3>
                                <p><strong>Bahan:</strong></p>
                                <p>{!! nl2br(e($resep->bahan)) !!}</p>
                                <p><strong>Langkah:</strong></p>
                                <p>{!! nl2br(e($resep->langkah)) !!}</p>

                                {{-- Tombol Edit & Delete hanya muncul untuk admin atau pemilik resep --}}
                                @if(auth()->user()->role === 'admin' || auth()->id() === $resep->user_id)
                                    <div class="mt-3 d-flex justify-content-between">
                                        <a href="{{ route('reseps.edit', $resep->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        
                                        <form action="{{ route('reseps.destroy', $resep->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus resep ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
