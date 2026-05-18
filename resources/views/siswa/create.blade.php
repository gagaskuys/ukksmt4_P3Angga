@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Kirim Aspirasi Baru</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Tampilkan Pesan Galat Jika Ada -->
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
    @endif

    <div class="card-style mb-30">
        <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
           <!-- Pilihan Kategori Kerusakan (Sudah Seragam Menggunakan $kat) -->
<div class="select-style-1">
    <label>Kategori Kerusakan</label>
    <div class="select-position">
        <select name="kategori_id" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $kat)
                <!-- ✅ UBAH $kat->id MENJADI $kat->id_kategori -->
                <option value="{{ $kat->id_kategori }}" {{ old('kategori_id') == $kat->id_kategori ? 'selected' : '' }}>
                    {{ $kat->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- Pilihan Lokasi / Ruangan -->
<div class="select-style-1">
    <label>Lokasi / Ruangan</label>
    <div class="select-position">
        <select name="ruangan_id" required>
            <option value="">-- Pilih Ruangan --</option>
            @foreach($ruangans as $r)
                <!-- ✅ Ini sudah BENAR, karena di tabel ruangan kuncinya emang 'id' -->
                <option value="{{ $r->id }}" {{ old('ruangan_id') == $r->id ? 'selected' : '' }}>
                    {{ $r->nama_ruangan }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- Deskripsi Laporan -->
<div class="input-style-1">
    <label>Detail Kerusakan / Aspirasi</label>
    <textarea name="deskripsi_laporan" rows="5" placeholder="Jelaskan secara rinci apa yang rusak atau apa yang menjadi usulanmu..." required>{{ old('deskripsi_laporan') }}</textarea>
</div>

            <!-- Unggah Foto Bukti -->
            <div class="input-style-1">
                <label>Foto Bukti</label>
                <input type="file" name="foto" accept="image/*" />
                <small class="text-muted">Format yang diizinkan: JPG, PNG, JPEG. Ukuran maksimal: 2MB.</small>
            </div>

            <div class="mt-4">
                <button type="submit" class="main-btn primary-btn btn-hover">Kirim Aspirasi</button>
                <a href="{{ route('aspirasi.history') }}" class="main-btn secondary-btn btn-hover ms-2">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
