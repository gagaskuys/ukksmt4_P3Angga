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
            <div class="col-md-6 text-end">
                <a href="{{ route('admin.ruangan.create') }}" class="main-btn primary-btn btn-hover">Tambah Ruangan Baru</a>
            </div>
        </div>
    </div>
    
    <div class="card-style mb-30">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Ruangan</th>
                    <th>Lokasi</th>
                    <th>Dibuat Pada</th>
                    <th>Diupdate Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ruangans as $ruangan)
                <tr>
                    <td>{{ $ruangan->nama_ruangan }}</td>
                    <td>{{ $ruangan->lokasi }}</td>
                    <td>{{ optional($ruangan->created_at)->format('d-m-Y') }}</td>
                    <td>{{ optional($ruangan->updated_at)->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('admin.ruangan.edit', $ruangan->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.ruangan.destroy', $ruangan->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection