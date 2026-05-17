@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <h2>Tambah Guru</h2>
    </div>

    <!-- Menampilkan Alert Error Validasi jika ada input yang salah -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card-style mb-30">
        <form action="{{ route('admin.guru.store') }}" method="POST">
            @csrf
            
            <!-- Gunakan value="{{ old('nama_input') }}" agar ketikan lama tidak hilang saat error -->
            <div class="input-style-1">
                <label>NIP</label>
                <input type="text" name="nip" value="{{ old('nip') }}" placeholder="Masukkan NIP" required>
            </div>
            
            <div class="input-style-1">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>
            </div>
            
            <div class="input-style-1">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password (minimal 6 karakter)" required>
            </div>
            
            <div class="input-style-1">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
            </div>
            
            <div class="input-style-1">
                <label>Mata Pelajaran</label>
                <input type="text" name="mata_pelajaran" value="{{ old('mata_pelajaran') }}" placeholder="Masukkan mata pelajaran" required>
            </div>
            
            <!-- Memperbaiki struktur select box template PlainAdmin -->
            <div class="select-style-1">
                <label>Jenis Kelamin</label>
                <div class="select-position">
                    <select name="jenis_kelamin" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>
            
            <div class="input-style-1">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
            </div>
            
            <div class="input-style-1">
                <label>Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan alamat" required>
            </div>
            
            <div class="input-style-1">
                <label>No Telepon</label>
                <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="Masukkan no telepon" required>
            </div>
            
            <div class="text-end mt-4">
                <a href="{{ route('admin.guru.index') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
                <button type="submit" class="main-btn success-btn rounded-md btn-hover">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
