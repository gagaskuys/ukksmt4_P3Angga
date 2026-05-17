@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Kelola Data Ruangan</h2>
                </div>
            </div>
            <!-- Membuat tombol tambah sejajar rapi di kanan atas -->
            <div class="col-md-6 text-end mb-30">
                <a href="{{ route('admin.ruangan.create') }}" class="main-btn primary-btn btn-hover">Tambah Ruangan Baru</a>
            </div>
        </div>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
    @endif

    <!-- Tabel Data Ruangan bergaya Kategori -->
    <div class="card-style mb-30">
        <div class="table-wrapper table-responsive">
            <table class="table table-bordered table-striped align-middle m-0">
                <thead>
                    <tr class="bg-light">
                        <th class="px-3 py-3" style="width: 80px;"><h6>No</h6></th>
                        <th class="px-3 py-3"><h6>Nama Ruangan</h6></th>
                        <th class="px-3 py-3 text-center" style="width: 200px;"><h6>Aksi</h6></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ruangans as $key => $ruangan)
                    <tr>
                        <td class="px-3 py-3">{{ $key + 1 }}</td>
                        <td class="px-3 py-3 fw-bold text-dark">{{ $ruangan->nama_ruangan }}</td>
                        <td class="px-3 py-3 text-center">
                            <div class="action justify-content-center">
                                <!-- Menggunakan gaya tombol ikon minimalis khas PlainAdmin -->
                                <a href="{{ route('admin.ruangan.edit', $ruangan->id) }}" class="text-primary me-3 text-decoration-none">
                                    <i class="lni lni-pencil"></i> Ubah
                                </a>
                                <form action="{{ route('admin.ruangan.destroy', $ruangan->id) }}" method="POST" class="d-inline m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger border-0 bg-transparent p-0" onclick="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')">
                                        <i class="lni lni-trash-can"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <!-- Menggunakan colspan="4" agar pas di tengah 4 buah kolom -->
                        <td colspan="4" class="text-center text-muted py-4">Belum ada data ruangan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
    