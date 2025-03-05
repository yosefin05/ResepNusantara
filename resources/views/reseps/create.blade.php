@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Upload Resep Baru</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('reseps.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Resep</label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" required>
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="bahan" class="form-label">Bahan-bahan</label>
            <textarea class="form-control @error('bahan') is-invalid @enderror" id="bahan" name="bahan" rows="4" required></textarea>
            @error('bahan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="langkah" class="form-label">Langkah-langkah</label>
            <textarea class="form-control @error('langkah') is-invalid @enderror" id="langkah" name="langkah" rows="4" required></textarea>
            @error('langkah')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
