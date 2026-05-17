@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="title mb-30">
            <h2>Edit Jurusan</h2>
        </div>
    </div>

    <!-- Tampilkan Pesan Galat / Error Validasi jika ada input yang salah -->
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

    <!-- Kotak Putih Form -->
    <div class="card-style mb-30">
        <form action="{{ route('admin.jurusan.update', $jurusans->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="input-style-1">
                <label>Nama Jurusan</label>
                <input type="text" name="nama_jurusan" value="{{ old('nama_jurusan', $jurusans->nama_jurusan) }}" placeholder="Masukkan nama jurusan" required>
            </div>

            <!-- Tombol Aksi Khas PlainAdmin yang Sejajar Rapi -->
            <div class="text-end mt-4">
                <a href="{{ route('admin.jurusan.index') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
                <button type="submit" class="main-btn success-btn rounded-md btn-hover">Update Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
