@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">History Aspirasi</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($aspirasis as $aspirasi)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $aspirasi->judul }}</h5>
                                <p class="card-text">{{ $aspirasi->deskripsi }}</p>
                                <p class="card-text"><small class="text-muted">Dibuat pada {{ $aspirasi->created_at->format('d M Y H:i') }}</small></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection