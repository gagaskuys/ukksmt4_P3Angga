@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>👁️ Lihat Semua Aspirasi Siswa</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- PESAN NOTIFIKASI --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
    @endif

    <div class="card-style mb-30">
        <div class="table-wrapper table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><h6>No</h6></th>
                        <th><h6>Pelapor</h6></th>
                        <th><h6>Kategori</h6></th>
                        <th><h6>Ruangan</h6></th>
                        <th><h6>Deskripsi Laporan</h6></th>
                        <th><h6>Foto</h6></th>
                        <th><h6>Status</h6></th>
                        <th><h6>Waktu Lapor</h6></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aspirasis as $key => $aspirasi)
                    <tr>
                        {{-- Nomor Urut --}}
                        <td>
                            <p class="text-sm">{{ $aspirasis->firstItem() + $key }}</p>
                        </td>

                        {{-- Nama Siswa --}}
                        <td>
                            <p class="text-sm fw-bold">{{ $aspirasi->siswa->nama_siswa ?? '-' }}</p>
                            <small class="text-muted">NIS: {{ $aspirasi->siswa->nis ?? '-' }}</small>
                        </td>

                        {{-- Kategori --}}
                        <td>
                            <p>{{ $aspirasi->kategori->nama_kategori ?? '-' }}</p>
                        </td>

                        {{-- Ruangan --}}
                        <td>
                            <p>{{ $aspirasi->ruangan->nama_ruangan ?? '-' }}</p>
                        </td>

                        {{-- Deskripsi Laporan --}}
                        <td>
                            <p class="text-sm text-truncate" style="max-width: 180px;">
                                {{ $aspirasi->deskripsi_laporan }}
                            </p>
                        </td>

                        {{-- Foto Bukti --}}
                        <td>
                            @if($aspirasi->foto)
                                <a href="{{ asset('storage/'.$aspirasi->foto) }}" target="_blank" title="Klik untuk lihat ukuran penuh">
                                    <img src="{{ asset('storage/'.$aspirasi->foto) }}" width="50" height="50" class="img-thumbnail" alt="Foto Bukti">
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        {{-- STATUS LAPORAN (HANYA TULISAN, TIDAK BISA DIUBAH) --}}
                        <td>
                            @if($aspirasi->status == 'menunggu')
                                <span class="badge rounded-pill bg-warning text-dark px-3 py-2">Menunggu</span>
                            @elseif($aspirasi->status == 'proses')
                                <span class="badge rounded-pill bg-info text-white px-3 py-2">Proses</span>
                            @else
                                <span class="badge rounded-pill bg-success text-white px-3 py-2">Selesai</span>
                            @endif
                        </td>

                        {{-- Waktu --}}
                        <td>
                            <p class="text-sm">
                                {{ $aspirasi->created_at->format('d/m/Y') }}
                                <br>
                                <small>{{ $aspirasi->created_at->format('H:i') }} WIB</small>
                            </p>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- NAVIGASI HALAMAN --}}
            <div class="mt-3 d-flex justify-content-center">
                {{ $aspirasis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection