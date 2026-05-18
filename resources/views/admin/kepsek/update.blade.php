@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Update Kepala Sekolah</h2>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Kotak Alert untuk menampilkan error validasi jika input salah -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-style mb-30">
        <form action="{{ route('admin.kepsek.update', $kepsek->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="input-style-1">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $kepsek->name) }}" placeholder="Masukkan nama lengkap" required>
            </div>
            
            <div class="input-style-1">
                <label>NIP</label>
                <input type="text" name="nip" value="{{ old('nip', $kepsek->nip) }}" placeholder="Masukkan NIP" required>
            </div>
            
            <div class="input-style-1">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L" {{ old('jenis_kelamin', $kepsek->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $kepsek->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            
            <div class="input-style-1">
                <label>Nomor HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $kepsek->no_hp) }}" placeholder="Masukkan nomor HP" required>
            </div>

            <!-- INPUT BARU: EMAIL -->
            <div class="input-style-1">
                <label>Email Akun Login</label>
                <input type="email" name="email" value="{{ old('email', $kepsek->user->email ?? '') }}" placeholder="Masukkan email aktif" required>
            </div>

            <!-- INPUT BARU: PASSWORD -->
            <div class="input-style-1">
                <label>Password Baru (Kosongkan jika tidak ingin diganti)</label>
                <input type="password" name="password" placeholder="Minimal 6 karakter">
            </div>
            
            <div class="text-end">
                <a href="{{ route('admin.kepsek.index') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
                <button type="submit" class="main-btn success-btn rounded-md btn-hover">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
