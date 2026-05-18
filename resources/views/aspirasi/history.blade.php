@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>📋 History Aspirasi Saya</h2>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
    @endif

    @if($aspirasis->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada riwayat aspirasi yang dikirim.
        </div>
    @else
        @foreach ($aspirasis as $aspirasi)
        <div class="card-style mb-30">
            <div class="row">
                <div class="col-md-12">
                    
                    <!-- Status di atas -->
                    <h5 class="text-primary mb-2">
                        Aspirasi 
                        <span class="badge float-end 
                            @if($aspirasi->status == 'menunggu') bg-warning 
                            @elseif($aspirasi->status == 'proses') bg-info 
                            @else bg-success @endif">
                            {{ strtouPPER($aspirasi->status) }}
                        </span>
                    </h5>

                    <hr>

                    <!-- Info Utama -->
                    <div class="row">
                        <div class="col-md-8">
                            <p class="mb-1"><strong>Kategori:</strong> {{ $aspirasi->kategori->nama_kategori ?? '-' }}</p>
                            <p class="mb-1"><strong>Lokasi / Ruangan:</strong> {{ $aspirasi->ruangan->nama_ruangan ?? '-' }}</p>
                            <p class="text-sm text-muted mb-3">Dikirim pada: {{ $aspirasi->created_at->format('d F Y | H:i') }}</p>
                            
                            <label>Detail Laporan:</label>
                            <p class="bg-light p-2 rounded">{{ $aspirasi->deskripsi_laporan }}</p>
                        </div>
                        
                        <!-- Foto Bukti -->
                        <div class="col-md-4 text-end">
                            @if($aspirasi->foto)
                                <img src="{{ asset('storage/'.$aspirasi->foto) }}" width="150" class="img-thumbnail" alt="Bukti Foto">
                            @else
                                <small class="text-muted">Tidak ada foto terlampir</small>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection