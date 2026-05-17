@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <h2>Edit Guru</h2>
    </div>

    <div class="card-style mb-30">
        <!-- Mengubah $gurus->id_guru menjadi $gurus->id sesuai database -->
        <form action="{{ route('admin.guru.update', $gurus->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="input-style-1">
                <label>Nama Lengkap</label>
                <!-- Menyamakan semua variabel input menggunakan $gurus -->
                <input type="text" name="name" value="{{ $gurus->name }}" placeholder="Masukkan nama lengkap" required>
            </div>
            
            <div class="input-style-1">
                <label>Mata Pelajaran</label>
                <input type="text" name="mata_pelajaran" value="{{ $gurus->mata_pelajaran }}" placeholder="Masukkan mata pelajaran" required>
            </div>
            
            <div class="input-style-1">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L" {{ $gurus->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $gurus->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            
            <div class="input-style-1">
                <label>Tanggal Lahir</label>
                <!-- Mengonversi format tanggal agar bisa terbaca otomatis oleh HTML date picker -->
                <input type="date" name="tanggal_lahir" value="{{ $gurus->tanggal_lahir ? \Carbon\Carbon::parse($gurus->tanggal_lahir)->format('Y-m-m') : '' }}" required>
            </div>
            
            <div class="input-style-1">
                <label>Alamat</label>
                <input type="text" name="alamat" value="{{ $gurus->alamat }}" placeholder="Masukkan alamat" required>
            </div>
            
            <div class="input-style-1">
                <label>No Telepon</label>
                <input type="text" name="no_telepon" value="{{ $gurus->no_telepon }}" placeholder="Masukkan no telepon" required>
            </div>
            
            <div class="text-end mt-3">
                <a href="{{ route('admin.guru.index') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
                <button type="submit" class="main-btn success-btn rounded-md btn-hover">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
