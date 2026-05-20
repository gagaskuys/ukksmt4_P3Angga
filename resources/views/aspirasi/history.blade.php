@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>📜 Sejarah Aspirasi Saya</h2>
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

    @foreach ($aspirasis as $aspirasi)
    <div class="card-style mb-30">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="text-primary fw-bold mb-0">Aspirasi #{{ $loop->iteration }}</h5>
            
            {{-- BADGE STATUS --}}
            @if($aspirasi->status == 'menunggu')
                <span class="badge rounded-pill bg-warning text-dark px-3 py-2">⏳ MENUNGGU</span>
            @elseif($aspirasi->status == 'proses')
                <span class="badge rounded-pill bg-info text-white px-3 py-2">🔄 DIPROSES</span>
            @else
                <span class="badge rounded-pill bg-success text-white px-3 py-2">✅ SELESAI</span>
            @endif
        </div>

        <hr>

        <div class="row">
            {{-- BAGIAN KIRI: INFORMASI LAPORAN --}}
            <div class="col-md-8">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td width="120" class="text-muted">Kategori</td>
                        <td>: <strong>{{ $aspirasi->kategori->nama_kategori ?? '-' }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Lokasi / Ruangan</td>
                        <td>: <strong>{{ $aspirasi->ruangan->nama_ruangan ?? '-' }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Waktu Kirim</td>
                        <td>: {{ $aspirasi->created_at->format('d/m/Y | H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Laporan</td>
                        <td>: {{ $aspirasi->deskripsi_laporan }}</td>
                    </tr>
                </table>
            </div>

            {{-- BAGIAN FOTO --}}
<div class="col-md-4 text-center">
    <p class="text-muted mb-1">📸 Bukti Foto</p>
    
    @if($aspirasi->foto)
        <img src="{{ asset($aspirasi->foto) }}" 
             width="150" 
             height="120" 
             class="img-thumbnail rounded shadow-sm"
             style="object-fit: cover; cursor: pointer;"
             alt="Bukti Foto"
             onclick="window.open(this.src, '_blank')">
    @else
        <span class="text-muted fst-italic">📷 Tidak ada foto</span>
    @endif
</div>
        </div> {{-- / Tutup ROW --}}

        {{-- ✅ BAGIAN TANGGAPAN / FEEDBACK ADMIN --}}
        <div class="mt-4 p-3 rounded border-start border-4 border-primary bg-light">
            <h6 class="mb-2 text-primary">📩 Tanggapan / Balasan Admin:</h6>
            
            @if($aspirasi->feedback_admin)
                <p class="mb-0 fst-italic text-dark">
                    {{ $aspirasi->feedback_admin }}
                </p>
            @else
                <p class="mb-0 text-muted fst-italic">
                    ⏳ Belum ada tanggapan dari admin. Mohon ditunggu.
                </p>
            @endif
        </div>

    </div> {{-- /CARD --}}
    @endforeach

    {{-- JIKA BELUM ADA LAPORAN SAMA SEKALI --}}
    @if($aspirasis->isEmpty())
    <div class="card-style mb-30 text-center py-5">
        <h4 class="text-muted">📭 Anda belum mengirimkan aspirasi apapun.</h4>
        <a href="{{ route('siswa.create') }}" class="btn btn-primary mt-3">➕ Buat Aspirasi Baru</a>
    </div>
    @endif

</div>
@endsection

{{-- CATATAN: KODE DI BAWAH INI UNTUK HALAMAN CREATE ASPIRASI, JANGAN DITAMPILKAN DI HISTORY --}}
{{-- JIKA INGIN MENAMPILKAN FORM CREATE DI HISTORY, HARUS DIBUNGKUS DENGAN KONDISI --}}