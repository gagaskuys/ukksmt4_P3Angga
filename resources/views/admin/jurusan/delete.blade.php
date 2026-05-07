@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Hapus Jurusan</h1>
    <p>Apakah Anda yakin ingin menghapus jurusan "{{ $jurusans->nama }}"?</p>
    <form action="{{ route('admin.jurusan.destroy', $jurusans->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-danger">Hapus</button>
    </form>
</div>
@endsection