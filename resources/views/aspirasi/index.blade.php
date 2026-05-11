@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Monitoring Aspirasi Masuk</h2>
                    <p>Kelola dan tindak lanjuti aspirasi siswa secara real-time.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card-style mb-30">
        <div class="table-wrapper table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><h6>No</h6></th>
                        <th><h6>Nama Pengirim</h6></th>
                        <th><h6>Kategori</h6></th>
                        <th><h6>Isi Aspirasi</h6></th>
                        <th><h6>Status</h6></th>
                        <th><h6>Aksi</h6></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aspirasis as $key => $item)
                    <tr>
                        <td class="min-width">
                            <p>{{ $key + 1 }}</p>
                        </td>
                        <td class="min-width">
                            <p>{{ $item->siswa->nama ?? 'Anonim' }}</p>
                        </td>
                        <td class="min-width">
                            <p>{{ $item->kategori->nama_kategori ?? '-' }}</p>
                        </td>
                        <td class="min-width">
                            <p>{{ Str::limit($item->deskripsi, 50) }}</p>
                        </td>
                        <td class="min-width">
                            @if($item->status == 'pending')
                                <span class="status-btn close-btn">Pending</span>
                            @elseif($item->status == 'proses')
                                <span class="status-btn warning-btn">Proses</span>
                            @else
                                <span class="status-btn success-btn">Selesai</span>
                            @endif
                        </td>
                        <td>
                            <div class="action">
                                <a href="{{ route('aspirasi.show', $item->id) }}" class="text-primary">
                                    <i class="lni lni-eye"></i> Detail & Tanggapi
                                </a>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('aspirasi.edit', $item->id) }}" class="text-primary me-3">
                                <i class="lni lni-pencil"></i> Ubah
                            </a>
                            <form action="{{ route('admin.aspirasi.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-danger border-0 bg-transparent" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="lni lni-trash-can"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            <p>Belum ada aspirasi yang masuk untuk dipantau.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
