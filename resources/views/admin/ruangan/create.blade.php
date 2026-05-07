@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <h2>Tambah Ruangan Baru</h2>
    </div>

    <div class="card-style mb-30">
        <form action="{{ route('admin.ruangan.store') }}" method="POST">
            @csrf
            <div class="input-style-1">
                <label>Nama Ruangan</label>
                <input type="text" name="nama_ruangan" placeholder="Masukkan nama ruangan" required>
            </div>
            <div class="input-style-1">
                <label>Lokasi</label>
                <input type="text" name="lokasi" placeholder="Masukkan lokasi ruangan" required>
            </div>
                <div class="text-end">
                    <a href="{{ route('admin.ruangan.index') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
            <button type="submit" class="main-btn success-btn rounded-md btn-hover">Simpan</button>
        </form>
    </div>
</div>
@endsection