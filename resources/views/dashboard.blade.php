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
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
