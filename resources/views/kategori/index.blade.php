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
        </div>
    </div>

    <!-- Form Tambah -->
    <div class="card-style mb-30">
        <h6 class="mb-25">Tambah Kategori Baru</h6>
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="input-style-1">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" placeholder="Contoh: Kerusakan Fasilitas" required />
            </div>
            <button type="submit" class="main-btn primary-btn btn-hover">Simpan Kategori</button>
        </form>
    </div>

    <!-- Tabel Data -->
    <div class="card-style mb-30">
        <h6 class="mb-10">Daftar Kategori</h6>
        <div class="table-wrapper table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><h6>No</h6></th>
                        <th><h6>Nama Kategori</h6></th>
                        <th><h6>Aksi</h6></th>
                    </tr>
                </thead>
<tbody>
    @forelse($kategoris as $key => $kat)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $kat->nama_kategori }}</td>
        <td>
            {{-- Bagian ini yang krusial, pastikan ada $kat->id --}}
            <form action="{{ route('kategori.destroy', ['kategori' => $kat->id_kategori]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-danger border-0 bg-transparent">
        <i class="lni lni-trash-can"></i> Hapus
    </button>
</form>

        </td>
    </tr>
    @empty
    <tr>
        <td colspan="3" class="text-center">Belum ada data kategori.</td>
    </tr>
    @endforelse
</tbody>

            </table>
        </div>
    </div>
</div>
@endsection
