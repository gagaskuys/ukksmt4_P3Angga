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
    {{-- FORM FILTER --}}
<div class="card-style mb-30">
    <h5 class="mb-3">🔍 Filter Aspirasi</h5>
    <form method="GET" class="row g-3">
        <div class="col-md-3">
            <label class="form-label">Cari Nama Pelapor</label>
            <input type="text" name="search_nama" class="form-control" 
                   placeholder="Nama siswa/guru..." value="{{ request('search_nama') }}">
        </div>
        
        <div class="col-md-3">
            <label class="form-label">Cari Laporan</label>
            <input type="text" name="search_laporan" class="form-control" 
                   placeholder="Kata kunci laporan..." value="{{ request('search_laporan') }}">
        </div>
        
        <div class="col-md-2">
            <label class="form-label">Filter Status</label>
            <select name="status" class="form-select">
                <option value="all">Semua Status</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>⏳ Menunggu</option>
                <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>🔄 Diproses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
            </select>
        </div>
        
        <div class="col-md-2">
            <label class="form-label">Filter Kategori</label>
            <select name="kategori_id" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
                @endforeach
            </select>
        </div>
        
        <div class="col-md-2">
            <label class="form-label">Filter Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
        </div>
        
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">🔍 Terapkan Filter</button>
            <a href="{{ route('aspirasi.monitoring') }}" class="btn btn-secondary">↺ Reset Filter</a>
        </div>
    </form>
</div>
    <div class="card-style mb-30">
        <div class="table-wrapper table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="12%"><h6>Pelapor</h6></th>
                        <th width="10%"><h6>Kategori</h6></th>
                        <th width="10%"><h6>Ruangan</h6></th>
                        <th width="15%"><h6>Deskripsi</h6></th>
                        <th width="8%"><h6>Foto</h6></th>
                        <th width="10%"><h6>Status</h6></th>
                        <th width="20%"><h6>Tanggapan / Feedback</h6></th>
                        <th width="15%"><h6>Aksi</h6></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aspirasis as $aspirasi)
                    <tr>
                        {{-- Nama Siswa dan Guru --}}
                        <td>
                        @if($aspirasi->siswa_id != null)
                            <p class="text-sm fw-bold mb-0">👨‍🎓 {{ $aspirasi->siswa->name ?? 'Siswa Tidak Diketahui' }}</p>
                        @elseif($aspirasi->guru_id != null)
                            <p class="text-sm fw-bold mb-0">👨‍🏫 {{ $aspirasi->guru->name ?? 'Guru / Staf' }}</p>
                        @endif
                        <small class="text-muted">{{ $aspirasi->created_at->format('d/m/Y H:i') }}</small>
                        </td>
                        
                        {{-- Kategori --}}
                        <td>
                            <span class="text-sm">{{ $aspirasi->kategori->nama_kategori ?? '-' }}</span>
                        </td>

                        {{-- Ruangan --}}
                        <td>
                            <span class="text-sm">{{ $aspirasi->ruangan->nama_ruangan ?? '-' }}</span>
                        </td>

                        {{-- Deskripsi Laporan --}}
                        <td>
                            <p class="text-sm text-truncate-2" style="max-width: 180px;" title="{{ $aspirasi->deskripsi_laporan }}">
                                {{ $aspirasi->deskripsi_laporan }}
                            </p>
                        </td>

                        {{-- BAGIAN FOTO - SIMPLE & LANGSUNG --}}
<td class="text-center">
    @if($aspirasi->foto)
        <a href="{{ asset($aspirasi->foto) }}" target="_blank">
            <img src="{{ asset($aspirasi->foto) }}" 
                 width="60" 
                 height="60" 
                 class="img-thumbnail rounded" 
                 style="object-fit: cover; border:2px solid #28a745;" 
                 alt="Bukti Foto"
                 onerror="this.style.display='none'; this.nextSibling.style.display='block';">
            <span class="text-danger small" style="display: none;">❌</span>
        </a>
    @else
        <span class="text-muted">-</span>
    @endif
</td>

                        {{-- STATUS LAPORAN --}}
                        <td class="text-center">
                            @if($aspirasi->status == 'menunggu')
                                <span class="badge rounded-pill bg-warning text-dark px-3 py-2">Menunggu</span>
                            @elseif($aspirasi->status == 'proses')
                                <span class="badge rounded-pill bg-info text-white px-3 py-2">Proses</span>
                            @else
                                <span class="badge rounded-pill bg-success text-white px-3 py-2">Selesai</span>
                            @endif
                        </td>

                        {{-- TANGGAPAN ADMIN --}}
                        <td>
                            <form action="{{ route('aspirasi.updateStatus', $aspirasi->id) }}" method="POST" id="formUbah{{ $aspirasi->id }}">
                                @csrf
                                <textarea name="feedback_admin" 
                                          class="form-control form-control-sm" 
                                          rows="3" 
                                          placeholder="Tulis balasan di sini..."
                                          style="font-size: 0.85rem;">{{ $aspirasi->feedback_admin }}</textarea>
                        </td>

                        {{-- TOMBOL UBAH STATUS & SIMPAN + HAPUS --}}
                        <td>
                                <select name="status" class="form-select form-select-sm mb-2" style="font-size: 0.85rem;">
                                    <option value="menunggu" {{ $aspirasi->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="proses" {{ $aspirasi->status == 'proses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="selesai" {{ $aspirasi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                <button type="submit" form="formUbah{{ $aspirasi->id }}" class="btn btn-sm btn-primary w-100 mb-1">
                                    💾 Simpan
                                </button>
                            </form> {{-- ✅ Form utama ditutup di sini biar gak nyarang --}}

                            {{-- ✅ FORM HAPUS DIPISAH, SUDAH BENAR STRUKTURNYA --}}
                            <form action="{{ route('aspirasi.hapus', $aspirasi->id) }}" method="POST" 
                                  onsubmit="return confirm('⚠️ PERINGATAN: Data akan dihapus permanen!\nYakin mau hapus laporan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- PAGINASI / NAVIGASI HALAMAN --}}
            <div class="mt-3 d-flex justify-content-center">
                {{ $aspirasis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection