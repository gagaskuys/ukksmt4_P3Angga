@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Dashboard Petugas</h2>
                </div>
            </div>
            <!-- Pindahkan tombol ke sini agar sejajar di kanan -->
            <div class="col-md-6 text-end">
                <div class="mb-30">
                    <a href="{{ route('admin.petugas.create') }}" class="main-btn primary-btn btn-hover">Tambah Petugas</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card-style mb-30">
        <div class="table-wrapper table-responsive"> <!-- Tambahkan class table-wrapper -->
            <table class="table">
                <thead>
                    <tr>
                        <th><h6>No</h6></th>
                        <th><h6>Nama Petugas</h6></th>
                        <th><h6>NIP</h6></th>
                        <th><h6>Jabatan</h6></th>
                        <th><h6>Jenis Kelamin</h6></th>
                        <th><h6>Nomor HP</h6></th>
                        <th><h6>Aksi</h6></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($petugas as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->nip }}</td>
                        <td>{{ $p->jabatan }}</td>
                        <td>{{ $p->jenis_kelamin ?? '-' }}</td>
                        <td>{{ $p->no_hp ?? '-' }}</td>
                        <td>
                            <!-- Gunakan style ikon agar seragam dengan halaman Kepsek -->
                            <a href="{{ route('admin.petugas.edit', $p->id) }}" class="text-primary me-3">
                                <i class="lni lni-pencil"></i> Ubah
                            </a>
                            <form action="{{ route('admin.petugas.destroy', $p->id) }}" method="POST" class="d-inline">
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
                        <td colspan="6" class="text-center">Belum ada data petugas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
