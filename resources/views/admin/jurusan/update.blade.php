@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Jurusan</h1>
    <form action="{{ route('admin.jurusan.update', $jurusans->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="input-style-1">
            <label>Nama Jurusan</label>
            <input type="text" name="nama_jurusan" value="{{ old('nama_jurusan', $jurusans->nama_jurusan) }}" placeholder="Masukkan nama jurusan" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection