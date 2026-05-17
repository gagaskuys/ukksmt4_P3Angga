@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Kelola Data Guru</h2>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('admin.guru.create') }}" class="main-btn primary-btn btn-hover">Tambah Guru</a>
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
                <!-- Menambahkan class table-bordered dan table-striped agar bergaris dan berjarak -->
                <table class="table table-bordered table-striped align-middle m-0">
                    <thead>
                        <tr class="bg-light">
                            <th class="px-3 py-3" style="min-width: 50px;"><h6>No</h6></th>
                            <th class="px-3 py-3" style="min-width: 150px;"><h6>Nama Lengkap</h6></th>
                            <th class="px-3 py-3" style="min-width: 100px;"><h6>NIP</h6></th>
                            <th class="px-3 py-3" style="min-width: 120px;"><h6>Mata Pelajaran</h6></th>
                            <th class="px-3 py-3" style="min-width: 130px;"><h6>Jenis Kelamin</h6></th>
                            <th class="px-3 py-3" style="min-width: 180px;"><h6>Email</h6></th>
                            <th class="px-3 py-3" style="min-width: 130px;"><h6>Tanggal Lahir</h6></th>
                            <th class="px-3 py-3" style="min-width: 140px;"><h6>No Telepon</h6></th>
                            <th class="px-3 py-3" style="min-width: 200px;"><h6>Alamat</h6></th>
                            <th class="px-3 py-3 text-center" style="min-width: 150px;"><h6>Aksi</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gurus as $key => $guru)
                        <tr>
                            <td class="px-3 py-3">{{ $key + 1 }}</td>
                            <td class="px-3 py-3 fw-bold text-dark">{{ $guru->name }}</td>
                            <td class="px-3 py-3">{{ $guru->nip ?? 'N/A' }}</td>
                            <td class="px-3 py-3"><span class="status-btn close-btn">{{ $guru->mata_pelajaran ?? 'N/A' }}</span></td>
                            <td class="px-3 py-3">@if($guru->jenis_kelamin === 'L')
                                                    Laki-laki
                                                @elseif($guru->jenis_kelamin === 'P')
                                                    Perempuan
                                                @else
                                                    Tidak Diketahui
                                                @endif
                            </td>
                            <td class="px-3 py-3">
                                @if($guru->user)
                                    {{ $guru->user->email }}
                                @else
                                    <span class="text-danger">Akun tidak ditemukan</span>
                                @endif
                            </td>
                            <td class="px-3 py-3">{{ optional($guru->tanggal_lahir)->format('d-m-Y') ?? 'N/A' }}</td>
                            <td class="px-3 py-3">{{ $guru->no_telepon ?? 'N/A' }}</td>
                            <td class="px-3 py-3 text-wrap" style="max-width: 250px;">{{ $guru->alamat ?? 'N/A' }}</td>
                            <td class="px-3 py-3 text-center">
                                <div class="action justify-content-center">
                                    <a href="{{ route('admin.guru.edit', $guru->id) }}" class="text-primary me-3 text-decoration-none">
                                        <i class="lni lni-pencil"></i> Ubah
                                    </a>
                                    <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" class="d-inline m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger border-0 bg-transparent p-0" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="lni lni-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted py-4">Belum ada data guru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
</div>
@endsection