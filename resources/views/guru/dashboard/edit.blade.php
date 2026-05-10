@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <h2>edit Guru</h2>
    </div>

    <div class="card-style mb-30">
        <form action="{{ route('guru.update', $guru->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="input-style-1">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="{{ $guru->nama }}" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="input-style-1">
                <label>Email</label>
                <input type="email" name="email" value="{{ $guru->email }}" placeholder="Masukkan email" required>
            </div>
            <div class="input-style-1">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password baru (biarkan kosong jika tidak ingin mengubah)" >
            </div>
                <div class="text-end">
                        <a href="{{ route('guru.dashboard') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
            <button type="submit" class="main-btn success-btn rounded-md btn-hover">Simpan</button>
        </form>
@endsection
