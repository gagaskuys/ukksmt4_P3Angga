@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Update Kategori</h1>
    <form action="{{ route('admin.kategori.update', ['kategori' => $kategori->id_kategori]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="input-style-1">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" placeholder="Masukkan nama kategori" required>
        </div>
        <div class="input-style-1">
            <label>Deskripsi</label>
            <textarea name="deskripsi" placeholder="Masukkan deskripsi kategori">{{ $kategori->deskripsi }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection