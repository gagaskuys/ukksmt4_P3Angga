@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Kelola Data Siswa</h2>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('admin.siswa.create') }}" class="main-btn primary-btn btn-hover">Tambah Siswa Baru</a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
    @endif

    <div class="card-style mb-30">
        <div class="table-wrapper table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><h6>No</h6></th>
                        <th><h6>Nama Lengkap</h6></th>
                        <th><h6>Alamat Surel</h6></th>
                        <th><h6>Aksi</h6></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswas as $key => $siswa)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $siswa->email }}</td>
                        <td>
                            <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="text-primary me-3">
                                <i class="lni lni-pencil"></i> Ubah
                            </a>
                            <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-danger border-0 bg-transparent" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="lni lni-trash-can"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data siswa.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
