@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <h2> Ubah kelas</h2>
    </div>

    <div class="card-style mb-30">
        <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="input-style-1">
                <label>Nama Kelas</label>
                <input type="text" name="nama_kelas" value="{{ $kelas->nama_kelas }}" placeholder="Masukkan nama kelas" required>
            </div>
             <div class="text-end">
                <a href="{{ route('admin.kelas.index') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
            <button type="submit" class="main-btn success-btn rounded-md btn-hover">Simpan</button>
        </form>
    </div>
</div>
@endsection