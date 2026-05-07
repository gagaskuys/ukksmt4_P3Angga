@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Kelola Data Jurusan</h2>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('admin.jurusan.create') }}" class="main-btn primary-btn btn-hover">Tambah Jurusan Baru</a>
            </div>
        </div>
    </div>
    <div class="card-style mb-30">
        <div class="table-wrapper table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Jurusan</th>
                <th>Dibuat Pada</th>
                <th>Diupdate Pada</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jurusans as $j)
            <tr>
                <td>{{ $j->id }}</td>
                <td>{{ $j->nama_jurusan }}</td>
                <td>{{ optional($j->created_at)->format('d-m-Y') }}</td>
                <td>{{ optional($j->updated_at)->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('admin.jurusan.edit', $j->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.jurusan.destroy', $j->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection