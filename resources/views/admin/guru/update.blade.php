@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <h2>edit Guru</h2>
    </div>

    <div class="card-style mb-30">
        <form action="{{ route('admin.guru.update', $guru->id_guru) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="input-style-1">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ $guru->name }}" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="input-style-1">
                <label>Mata Pelajaran</label>
                <input type="text" name="mata_pelajaran" value="{{ $guru->mata_pelajaran }}" placeholder="Masukkan mata pelajaran" required>
            </div>
            <div class="input-style-1">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" required>
                    <option value="L" {{ $guru->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $guru->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="input-style-1">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ $guru->tanggal_lahir }}" placeholder="Masukkan tanggal lahir" required>
            </div>
            <div class="input-style-1">
                <label>Alamat</label>
                <input type="text" name="alamat" value="{{ $guru->alamat }}" placeholder="Masukkan alamat" required>
            </div>
            <div class="input-style-1">
                <label>No Telepon</label>
                <input type="text" name="no_telepon" value="{{ $guru->no_telepon }}" placeholder="Masukkan no telepon" required>
            </div>
                <div class="text-end">
                        <a href="{{ route('admin.guru.index') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
            <button type="submit" class="main-btn success-btn rounded-md btn-hover">Simpan</button>
        </form>
@endsection
