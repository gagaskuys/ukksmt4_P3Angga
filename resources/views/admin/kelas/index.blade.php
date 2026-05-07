@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Kelola Data Kelas</h2>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('admin.kelas.create') }}" class="main-btn primary-btn btn-hover">Tambah Kelas Baru</a>
            </div>
        </div>
    </div>
    <div class="card-style mb-30">
        <div class="table-wrapper table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><h6>No</h6></th>
                        <th><h6>Nama Kelas</h6></th>
                        <th><h6>Dibuat Pada</h6></th>
                        <th><h6>Diupdate Pada</h6></th>
                        <th><h6>Aksi</h6></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelass as $key => $kelas)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $kelas->nama_kelas }}</td>
                        <td>{{ optional($kelas->created_at)->format('d-m-Y') }}</td>
                        <td>{{ optional($kelas->updated_at)->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('admin.kelas.edit', $kelas->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.kelas.destroy', $kelas->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data kelas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
