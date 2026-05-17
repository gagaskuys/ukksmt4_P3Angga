@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Tambah Kategori Baru</h1>
    <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf
        <div class="input-style-1">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" placeholder="Masukkan nama kategori" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection