@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <h2>Kirim Aspirasi Baru</h2>
    </div>

    <div class="card-style mb-30">
        <!-- PENTING: Tambahkan enctype untuk upload foto -->
        <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Pilih Kategori (sesuai ERD) -->
            <div class="select-style-1">
                <label>Kategori Kerusakan</label>
                <div class="select-position">
                    <select name="kategori_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Pilih Ruangan (sesuai database) -->
            <div class="select-style-1">
                <label>Lokasi / Ruangan</label>
                <div class="select-position">
                    <select name="ruangan_id" required>
                        <option value="">-- Pilih Ruangan --</option>
                        @foreach($ruangans as $r)
                            <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Deskripsi Laporan -->
            <div class="input-style-1">
                <label>Detail Kerusakan</label>
                <textarea name="deskripsi_laporan" rows="5" placeholder="Jelaskan detail kerusakan sarana..." required></textarea>
            </div>

            <!-- Upload Foto Bukti -->
            <div class="input-style-1">
                <label>Foto Bukti Kerusakan</label>
                <input type="file" name="foto" accept="image/*" required />
                <small class="text-muted">Format: JPG, PNG, JPEG (Maks 2MB)</small>
            </div>

            <button type="submit" class="main-btn primary-btn btn-hover">Kirim Aspirasi</button>
        </form>
    </div>
</div>
@endsection
