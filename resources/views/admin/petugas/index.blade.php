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
            <!-- Membuat tombol tambah sejajar rapi di kanan atas -->
            <div class="col-md-6 text-end mb-30">
                <a href="{{ route('admin.petugas.create') }}" class="main-btn primary-btn btn-hover">Tambah Petugas</a>
            </div>
        </div>
    </div>

    <!-- Menambahkan Alert Sukses agar notifikasi aksi muncul di layar -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
    @endif

    <div class="card-style mb-30">
        <div class="table-wrapper table-responsive">
            <!-- Menambahkan class table-bordered, table-striped, dan m-0 agar seragam -->
            <table class="table table-bordered table-striped align-middle m-0">
                <thead>
                    <tr class="bg-light">
                        <th class="px-3 py-3" style="width: 80px;"><h6>No</h6></th>
                        <th class="px-3 py-3" style="min-width: 180px;"><h6>Nama Petugas</h6></th>
                        <th class="px-3 py-3" style="min-width: 130px;"><h6>NIP</h6></th>
                        <th class="px-3 py-3" style="min-width: 130px;"><h6>Email</h6></th>
                        <th class="px-3 py-3" style="min-width: 130px;"><h6>Jabatan</h6></th>
                        <th class="px-3 py-3" style="min-width: 140px;"><h6>Jenis Kelamin</h6></th>
                        <th class="px-3 py-3" style="min-width: 140px;"><h6>Nomor HP</h6></th>
                        <th class="px-3 py-3 text-center" style="width: 150px;"><h6>Aksi</h6></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($petugas as $p)
                    <tr>
                        <td class="px-3 py-3">{{ $loop->iteration }}</td>
                        <td class="px-3 py-3 fw-bold text-dark">{{ $p->name }}</td>
                        <td class="px-3 py-3">{{ $p->nip }}</td>
<td class="px-3 py-3">
                                @if($p->user)
                                    {{ $p->user->email }}
                                @else
                                    <span class="text-danger">Akun tidak ditemukan</span>
                                @endif
                            </td>                        <td class="px-3 py-3">{{ $p->jabatan }}</td>
                        <!-- Mengonversi inisial L/P menjadi teks lengkap yang rapi -->
                        <td class="px-3 py-3">
                            @if($p->jenis_kelamin === 'L')
                                Laki-laki
                            @elseif($p->jenis_kelamin === 'P')
                                Perempuan
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-3 py-3">{{ $p->no_hp ?? '-' }}</td>
                        <td class="px-3 py-3 text-center">
                            <!-- Membungkus aksi ke d-flex justify-content-center agar lurus di tengah -->
                            <div class="action justify-content-center">
                                <a href="{{ route('admin.petugas.edit', $p->id) }}" class="text-primary me-3 text-decoration-none">
                                    <i class="lni lni-pencil"></i> Ubah
                                </a>
                                <form action="{{ route('admin.petugas.destroy', $p->id) }}" method="POST" class="d-inline m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger border-0 bg-transparent p-0" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="lni lni-trash-can"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <!-- Memperbaiki colspan menjadi 7 sesuai dengan total jumlah kolom -->
                        <td colspan="7" class="text-center text-muted py-4">Belum ada data petugas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
