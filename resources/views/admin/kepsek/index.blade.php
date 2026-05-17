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
            <!-- Merapikan jarak bawah tombol tambah agar sejajar row -->
            <div class="col-md-6 text-end mb-30">
                <a href="{{ route('admin.kepsek.create') }}" class="main-btn primary-btn btn-hover">Tambah Kepala Sekolah</a>
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
            <!-- Menambahkan class table-bordered, table-striped, dan m-0 agar seragam -->
            <table class="table table-bordered table-striped align-middle m-0">
                <thead>
                    <tr class="bg-light">
                        <th class="px-3 py-3" style="width: 80px;"><h6>No</h6></th>
                        <th class="px-3 py-3" style="min-width: 180px;"><h6>Nama Lengkap</h6></th>
                        <th class="px-3 py-3" style="min-width: 130px;"><h6>NIP</h6></th>
                        <th class="px-3 py-3" style="min-width: 130px;"><h6>Email</h6></th>
                        <th class="px-3 py-3" style="min-width: 140px;"><h6>Jenis Kelamin</h6></th>
                        <th class="px-3 py-3" style="min-width: 140px;"><h6>Nomor HP</h6></th>
                        <th class="px-3 py-3 text-center" style="width: 150px;"><h6>Aksi</h6></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kepseks as $key => $kepsek)
                    <tr>
                        <td class="px-3 py-3">{{ $key + 1 }}</td>
                        <td class="px-3 py-3 fw-bold text-dark">{{ $kepsek->name }}</td>
                        <td class="px-3 py-3">{{ $kepsek->nip }}</td>
<!-- Ganti kode pencetakan email lamamu menjadi seperti ini -->
<td class="px-3 py-3">
    {{ $kepsek->user->email ?? 'N/A' }}
</td>
                        <!-- Mengonversi inisial L/P menjadi teks lengkap yang rapi -->
                        <td class="px-3 py-3">
                            @if($kepsek->jenis_kelamin === 'L')
                                Laki-laki
                            @elseif($kepsek->jenis_kelamin === 'P')
                                Perempuan
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-3 py-3">{{ $kepsek->no_hp ?? '-' }}</td>
                        <td class="px-3 py-3 text-center">
                            <!-- Membungkus aksi ke d-flex justify-content-center agar lurus di tengah -->
                            <div class="action justify-content-center">
                                <a href="{{ route('admin.kepsek.edit', $kepsek->id) }}" class="text-primary me-3 text-decoration-none">
                                    <i class="lni lni-pencil"></i> Ubah
                                </a>
                                <form action="{{ route('admin.kepsek.destroy', $kepsek->id) }}" method="POST" class="d-inline m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger border-0 bg-transparent p-0" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="lni lni-trash-can"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <!-- Menyesuaikan padding vertikal saat tabel kosong -->
                        <td colspan="6" class="text-center text-muted py-4">Belum ada data kepala sekolah.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
