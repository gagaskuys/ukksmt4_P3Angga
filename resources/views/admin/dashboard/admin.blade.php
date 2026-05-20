@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="title mb-30">
                    <h2>📊 Dashboard Admin (Rekap & Statistik)</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- STATISTIK DATA MASTER --}}
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card-style mb-30 bg-primary text-white">
                <div class="card-body text-center">
                    <h1 class="display-4">{{ $totalSiswa }}</h1>
                    <h5>👨‍🎓 Total Siswa</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card-style mb-30 bg-info text-white">
                <div class="card-body text-center">
                    <h1 class="display-4">{{ $totalGuru }}</h1>
                    <h5>👨‍🏫 Total Guru</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card-style mb-30 bg-success text-white">
                <div class="card-body text-center">
                    <h1 class="display-4">{{ $totalAspirasi }}</h1>
                    <h5>📝 Total Aspirasi</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card-style mb-30 bg-warning text-dark">
                <div class="card-body text-center">
                    <h1 class="display-4">{{ $totalKepsek }}</h1>
                    <h5>👔 Total Kepala Sekolah</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card-style mb-30 bg-secondary text-white">
                <div class="card-body text-center">
                    <h1 class="display-4">{{ $totalPetugas }}</h1>
                    <h5>🛠️ Total Petugas</h5>
                </div>
            </div>
        </div>
    </div>

    {{-- STATISTIK STATUS ASPIRASI --}}
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card-style mb-30 bg-warning text-dark">
                <div class="card-body text-center">
                    <h1 class="display-4">{{ $aspirasiMenunggu }}</h1>
                    <h5>⏳ Aspirasi Menunggu</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card-style mb-30 bg-info text-white">
                <div class="card-body text-center">
                    <h1 class="display-4">{{ $aspirasiProses }}</h1>
                    <h5>🔄 Aspirasi Diproses</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card-style mb-30 bg-success text-white">
                <div class="card-body text-center">
                    <h1 class="display-4">{{ $aspirasiSelesai }}</h1>
                    <h5>✅ Aspirasi Selesai</h5>
                </div>
            </div>
        </div>
    </div>

    {{-- 5 ASPIRASI TERBARU --}}
    <div class="card-style mb-30">
        <h5 class="mb-3">📋 5 Aspirasi Terbaru</h5>
        <div class="table-wrapper table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Pelapor</th>
                        <th>Kategori</th>
                        <th>Laporan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($aspirasiTerbaru as $aspirasi)
                    <tr>
                        <td>
                            @if($aspirasi->siswa_id)
                                👨‍🎓 {{ $aspirasi->siswa->name ?? 'Siswa' }}
                            @elseif($aspirasi->guru_id)
                                👨‍🏫 {{ $aspirasi->guru->name ?? 'Guru' }}
                            @else
                                ❓ Tidak diketahui
                            @endif
                        </td>
                        <td>{{ $aspirasi->kategori->nama_kategori ?? '-' }}</td>
                        <td>{{ Str::limit($aspirasi->deskripsi_laporan, 40) }}</td>
                        <td>
                            @if($aspirasi->status == 'menunggu')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($aspirasi->status == 'proses')
                                <span class="badge bg-info">Diproses</span>
                            @else
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </td>
                        <td>{{ $aspirasi->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada aspirasi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

{{-- CATATAN: KODE DI BAWAH INI UNTUK HALAMAN CREATE ASPIRASI, JANGAN DITAMPILKAN DI DASHBOARD --}}
{{-- JIKA INGIN MENAMPILKAN FORM CREATE DI DASHBOARD, HARUS DIBUNGKUS DENGAN KONDISI --}}