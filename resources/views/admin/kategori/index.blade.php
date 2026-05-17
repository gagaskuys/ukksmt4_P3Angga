@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Kelola Kategori Aspirasi</h2>
                </div>
            </div>
            <!-- Memasukkan kembali tombol tambah ke dalam row agar sejajar rapi di kanan -->
            <div class="col-md-6 text-end mb-30">
                <a href="{{ route('admin.kategori.create') }}" class="main-btn primary-btn btn-hover">Tambah Kategori Baru</a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
    @endif

    <!-- Tabel Data -->
    <div class="card-style mb-30">
        <h6 class="mb-10">Daftar Kategori</h6>
        <div class="table-wrapper table-responsive">
            <!-- Menambahkan class table-bordered dan table-striped agar tampilan tabel tegas -->
            <table class="table table-bordered table-striped align-middle m-0">
                <thead>
                    <tr class="bg-light">
                        <th class="px-3 py-3" style="width: 80px;"><h6>No</h6></th>
                        <th class="px-3 py-3"><h6>Nama Kategori</h6></th>
                        <th class="px-3 py-3 text-center" style="width: 200px;"><h6>Aksi</h6></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $key => $kat)
                    <tr>
                        <td class="px-3 py-3">{{ $key + 1 }}</td>
                        <td class="px-3 py-3 fw-bold text-dark">{{ $kat->nama_kategori }}</td>
                        <td class="px-3 py-3 text-center">
                            <div class="action justify-content-center">
    <!-- Menggunakan properti nama kolom asli database untuk mengirim parameter ID -->
    <a href="{{ route('admin.kategori.edit', $kat->id_kategori ?? $kat->id) }}" class="text-primary me-3 text-decoration-none">
        <i class="lni lni-pencil"></i> Ubah
    </a>
    <form action="{{ route('admin.kategori.destroy', $kat->id_kategori ?? $kat->id) }}" method="POST" class="d-inline m-0">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-danger border-0 bg-transparent p-0" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
            <i class="lni lni-trash-can"></i> Hapus
        </button>
    </form>
</div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <!-- Mengubah colspan menjadi 3 agar pas dengan jumlah kolom -->
                        <td colspan="3" class="text-center text-muted py-4">Belum ada data kategori.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
