@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Kelola Lokasi / Ruangan</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Tambah -->
    <div class="card-style mb-30">
        <h6 class="mb-25">Tambah Ruangan Baru</h6>
        <form action="{{ route('ruangan.store') }}" method="POST">
            @csrf
            <div class="input-style-1">
                <label>Nama Ruangan</label>
                <input type="text" name="nama_ruangan" placeholder="Contoh: Ruang Lab Komputer" required />
            </div>
            <button type="submit" class="main-btn primary-btn btn-hover">Simpan Ruangan</button>
        </form>
    </div>

    <!-- Tabel Data -->
    <div class="card-style mb-30">
        <h6 class="mb-10">Daftar Ruangan</h6>
        <div class="table-wrapper table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><h6>No</h6></th>
                        <th><h6>Nama Ruangan</h6></th>
                        <th><h6>Aksi</h6></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ruangans as $key => $rng)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $rng->nama_ruangan }}</td>
                        <td>
                            <form action="{{ route('ruangan.destroy', $rng->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf @method('DELETE')
                                <button class="text-danger border-0 bg-transparent">
                                    <i class="lni lni-trash-can"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada data ruangan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
