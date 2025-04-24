@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Resep</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @foreach ($reseps as $resep)
        <div class="card mb-3">
            <div class="card-body">
                <h3 class="card-title">{{ $resep->judul }}</h3>
                <p><strong>Bahan:</strong> {{ $resep->bahan }}</p>
                <p><strong>Langkah:</strong> {{ $resep->langkah }}</p>
                <p><small>Diunggah oleh: {{ $resep->user->name }}</small></p>
            </div>
        </div>
    @endforeach

    @if($reseps->isEmpty())
        <p class="text-center">Belum ada resep yang diunggah.</p>
    @endif

    @auth
        <a href="{{ route('reseps.create') }}" class="btn btn-primary">Upload Resep</a>
    @else
        <p><a href="{{ route('login') }}">Login</a> untuk mengunggah resep.</p>
    @endauth
</div>
@endsection
