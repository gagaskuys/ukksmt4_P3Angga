@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>📊 Monitoring Aspirasi Siswa</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- KOTAK STATISTIK JUMLAH LAPORAN --}}
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card-style mb-30 bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title text-white">⚡ MENUNGGU</h5>
                    <p class="card-text display-6">
                        {{ $aspirasis->where('status', 'menunggu')->count() }} Laporan
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card-style mb-30 bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title text-white">🔄 DIPROSES</h5>
                    <p class="card-text display-6">
                        {{ $aspirasis->where('status', 'proses')->count() }} Laporan
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card-style mb-30 bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title text-white">✅ SELESAI</h5>
                    <p class="card-text display-6">
                        {{ $aspirasis->where('status', 'selesai')->count() }} Laporan
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- PESAN NOTIFIKASI SUKSES/GAGAL --}}
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
                        <th><h6>Pelapor</h6></th>
                        <th><h6>Kategori</h6></th>
                        <th><h6>Ruangan</h6></th>
                        <th><h6>Deskripsi</h6></th>
                        <th><h6>Foto</h6></th>
                        <th><h6>Status</h6></th>
                        <th><h6>Aksi</h6></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aspirasis as $aspirasi)
                    <tr>
                        {{-- Nama Siswa --}}
                        <td>
                            <p class="text-sm fw-bold">{{ $aspirasi->siswa->nama_siswa ?? '-' }}</p>
                            <small class="text-muted">{{ $aspirasi->created_at->format('d/m/Y H:i') }}</small>
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
                            <p class="text-sm text-truncate" style="max-width: 150px;">
                                {{ $aspirasi->deskripsi_laporan }}
                            </p>
                        </td>

                        {{-- Foto Bukti --}}
                        <td>
                            @if($aspirasi->foto)
                                <a href="{{ asset('storage/'.$aspirasi->foto) }}" target="_blank">
                                    <img src="{{ asset('storage/'.$aspirasi->foto) }}" width="50" height="50" class="img-thumbnail" alt="Foto">
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        {{-- STATUS LAPORAN --}}
                        <td>
                            @if($aspirasi->status == 'menunggu')
                                <span class="badge rounded-pill bg-warning text-dark px-3 py-2">Menunggu</span>
                            @elseif($aspirasi->status == 'proses')
                                <span class="badge rounded-pill bg-info text-white px-3 py-2">Proses</span>
                            @else
                                <span class="badge rounded-pill bg-success text-white px-3 py-2">Selesai</span>
                            @endif
                        </td>

                        {{-- TOMBOL UBAH STATUS --}}
                        <td>
                            <form action="{{ route('aspirasi.updateStatus', $aspirasi->id) }}" method="POST">
                                @csrf
                                <select name="status" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                                    <option value="menunggu" {{ $aspirasi->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="proses" {{ $aspirasi->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="selesai" {{ $aspirasi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- PAGINASI / NAVIGASI HALAMAN --}}
            <div class="mt-3">
                {{ $aspirasis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection