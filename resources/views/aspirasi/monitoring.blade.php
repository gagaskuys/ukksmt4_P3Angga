@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <h2>Monitoring Aspirasi</h2>
        <p>Ringkasan laporan masuk berdasarkan kategori.</p>
    </div>

    <!-- BAGIAN STATISTIK KATEGORI -->
    <div class="row">
        @foreach($statistikKategori as $stat)
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon purple">
                    <i class="lni lni-tag"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10 text-bold">{{ $stat->kategori->nama_kategori ?? 'Tanpa Kategori' }}</h6>
                    <h3 class="text-bold mb-10">{{ $stat->total }} Laporan</h3>
                    <p class="text-sm text-gray">Perlu ditindaklanjuti</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- TABEL ASPIRASI (Data Detail) -->
    <div class="card-style mb-30">
        <div class="title d-flex justify-content-between align-items-center mb-10">
            <h6>Daftar Aspirasi Masuk</h6>
        </div>
        <div class="table-wrapper table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><h6>No</h6></th>
                        <th><h6>Nama</h6></th>
                        <th><h6>Kategori</h6></th>
                        <th><h6>Status</h6></th>
                        <th><h6>Aksi</h6></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aspirasis as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->siswa->nama ?? 'Anonim' }}</td>
                        <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                        <td>
                            @if($item->status == 'menunggu')
                                <span class="status-btn close-btn">Menunggu</span>
                            @elseif($item->status == 'proses')
                                <span class="status-btn warning-btn">Proses</span>
                            @else
                                <span class="status-btn success-btn">Selesai</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('aspirasi.show', $item->id) }}" class="btn btn-sm btn-primary">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
