@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Jurusan</h1>
    <form action="{{ route('admin.jurusan.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_jurusan">Nama Jurusan</label>
            <input type="text" class="form-control"  name="nama_jurusan" required>
        </div>
            <div class="text-end">
                        <a href="{{ route('admin.jurusan.index') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection