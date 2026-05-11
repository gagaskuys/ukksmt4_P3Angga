@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Kelola Data Kepala Sekolah</h2>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ url('admin/kepsek/create') }}" class="main-btn primary-btn btn-hover">Tambah Kepala Sekolah</a>
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
                        <th><h6>NIP</h6></th>
                        <th><h6>Jenis Kelamin</h6></th>
                        <th><h6>Nomor HP</h6></th>
                        <th><h6>Aksi</h6></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kepseks as $key => $kepsek)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $kepsek->name }}</td>
                        <td>{{ $kepsek->nip }}</td>
                        <td>{{ $kepsek->jenis_kelamin ?? '-' }}</td>
                        <td>{{ $kepsek->no_hp ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.kepsek.edit', $kepsek->id) }}" class="text-primary me-3">
                                <i class="lni lni-pencil"></i> Ubah
                            </a>
                            <form action="{{ route('admin.kepsek.destroy', $kepsek->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-danger border-0 bg-transparent" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="lni lni-trash-can"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data kepala sekolah.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection