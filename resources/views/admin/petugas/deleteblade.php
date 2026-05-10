@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>hapus Petugas</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-style mb-30">
                <div class="table-wrapper table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><h6>Nama Petugas</h6></th>
                                <th><h6>Email</h6></th>
                                <th><h6>No HP</h6></th>
                                <th><h6>Alamat</h6></th>
                                <th><h6>Aksi</h6></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($petugas as $p)
                            <tr>
                                <td>{{ $p->nama_petugas }}</td>
                                <td>{{ $p->email }}</td>
                                <td>{{ $p->no_hp }}</td>
                                <td>{{ $p->alamat }}</td>
                                <td>
                                    <form action="{{ route('admin.petugas.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus petugas ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data petugas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
