@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Hapus Kategori </h1>
    <form action="{{ route('admin.kategori.destroy', ['kategori' => $kategori->id_kategori]) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="input-style-1">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" placeholder="Masukkan nama kategori" required>
        </div>
        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
    </form>
</div>
@endsection