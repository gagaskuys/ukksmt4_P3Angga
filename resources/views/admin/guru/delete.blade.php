@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <h2>Dashboard Guru</h2>
    </div>

    <div class="card-style mb-30">
        <h3>Apakah Anda yakin ingin menghapus akun ini?</h3>
        <form action="{{ route('guru.destroy', $guru->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="text-end">
                <a href="{{ route('guru.index') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
                <button type="submit" class="main-btn success-btn rounded-md btn-hover">Hapus</button>
            </div>
        </form>
@endsection