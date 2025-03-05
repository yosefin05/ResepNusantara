@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mt-4">{{ $resep->judul }}</h2>

        <p><strong>Bahan:</strong></p>
        <p>{!! nl2br(e($resep->bahan)) !!}</p>
        <p><strong>Langkah:</strong></p>
        <p>{!! nl2br(e($resep->langkah)) !!}</p>
        <p><small>Diunggah oleh: {{ $resep->user->name }}</small></p>

        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>
@endsection