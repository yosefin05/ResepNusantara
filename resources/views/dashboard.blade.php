@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mt-4">Daftar Resep</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @foreach ($reseps as $resep)
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title">{{ $resep->judul }}</h3>
                    <p><strong>Bahan:</strong></p>
                    <p>{!! nl2br(e($resep->bahan)) !!}</p>
                    <p><strong>Langkah:</strong></p>
                    <p>{!! nl2br(e($resep->langkah)) !!}</p>

                </div>
            </div>
        @endforeach

        @if($reseps->isEmpty())
            <p class="text-center">Belum ada resep yang diunggah.</p>
        @endif
    </div>
@endsection