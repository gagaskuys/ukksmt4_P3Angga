@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Hapus siswa</h1>
    <p>Apakah Anda yakin ingin menghapus siswa "{{ $siswa->nama }}"?</p>
    <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-danger">Hapus</button>
    </form>
</div>
@endsection