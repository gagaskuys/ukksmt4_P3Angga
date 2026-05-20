@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>👨‍🏫 Dashboard Guru / Petugas</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- KOTAK STATISTIK --}}
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card-style mb-30 bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title text-white">📊 TOTAL</h5>
                    <p class="card-text display-6">{{ $total ?? 0 }} Laporan</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card-style mb-30 bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title text-white">⏳ MENUNGGU</h5>
                    <p class="card-text display-6">{{ $menunggu ?? 0 }} Laporan</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card-style mb-30 bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title text-white">🔄 DIPROSES</h5>
                    <p class="card-text display-6">{{ $proses ?? 0 }} Laporan</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card-style mb-30 bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title text-white">✅ SELESAI</h5>
                    <p class="card-text display-6">{{ $selesai ?? 0 }} Laporan</p>
                </div>
            </div>
        </div>
    </div>

    {{-- DAFTAR LAPORAN TERBARU --}}
    <div class="card-style mb-30">
        <div class="card-body">
            <h5 class="mb-3">📌 Laporan Terbaru</h5>
            <div class="table-wrapper table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><h6>Pelapor</h6></th>
                            <th><h6>Deskripsi</h6></th>
                            <th><h6>Status</h6></th>
                            <th><h6>Waktu</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Aspirasi::with('siswa')->latest()->take(5)->get() as $item)
                        <tr>
                            <td>{{ $item->siswa->name ?? '-' }}</td>
                            <td>{{ Str::limit($item->deskripsi_laporan, 30) }}</td>
                            <td>
                                @if($item->status == 'menunggu')
                                    <span class="badge bg-warning">Menunggu</span>
                                @elseif($item->status == 'proses')
                                    <span class="badge bg-info">Proses</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                            <td><small>{{ $item->created_at->format('d/m/Y H:i') }}</small></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection