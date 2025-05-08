@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-4 text-center">Edit Resep</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reseps.update', $resep->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $resep->judul) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="bahan">Bahan</label>
            <textarea class="form-control" id="bahan" name="bahan" rows="4" required>{{ old('bahan', $resep->bahan) }}</textarea>
        </div>

        <div class="form-group mb-4">
            <label for="langkah">Langkah</label>
            <textarea class="form-control" id="langkah" name="langkah" rows="4" required>{{ old('langkah', $resep->langkah) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('reseps.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
