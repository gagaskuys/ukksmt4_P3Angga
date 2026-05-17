@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Update Petugas</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Menampilkan Alert Error Validasi jika ada input yang tidak lolos sensor -->
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

    <div class="row">
        <div class="col-lg-12">
            <div class="card-style mb-30">
                <form action="{{ route('admin.petugas.update', $petugas->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="input-style-1">
                        <label>NIP</label>
                        <input type="text" name="nip" value="{{ old('nip', $petugas->nip) }}" placeholder="Masukkan NIP petugas" required>
                    </div>

                    <!-- TAMBAHAN WAJIB: Input Email untuk dikirim ke tabel users -->
                    <div class="input-style-1">
                        <label>Email (Untuk Login)</label>
                        <input type="email" name="email" value="{{ old('email', $petugas->user->email ?? '') }}" placeholder="Masukkan email petugas" required>
                    </div>

                    <!-- TAMBAHAN WAJIB: Input Password jika ingin diubah -->
                    <div class="input-style-1">
                        <label>Password Baru (Kosongkan jika tidak ingin diubah)</label>
                        <input type="password" name="password" placeholder="Masukkan password baru (minimal 6 karakter)">
                    </div>

                    <div class="input-style-1">
                        <label>Nama Petugas</label>
                        <input type="text" name="name" value="{{ old('name', $petugas->name) }}" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="input-style-1">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" value="{{ old('jabatan', $petugas->jabatan) }}" placeholder="Masukkan jabatan petugas" required>
                    </div>

                    <!-- Merapikan Select Box Sesuai Gaya Khas PlainAdmin -->
                    <div class="select-style-1">
                        <label>Jenis Kelamin</label>
                        <div class="select-position">
                            <select name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jenis_kelamin', $petugas->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $petugas->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="input-style-1">
                        <label>No HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $petugas->no_hp) }}" placeholder="Masukkan nomor handphone" required>
                    </div>

                    <!-- Tombol Aksi yang Serasi dengan Halaman Guru/Kepsek -->
                    <div class="text-end mt-4">
                        <a href="{{ route('admin.petugas.index') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
                        <button type="submit" class="main-btn success-btn rounded-md btn-hover">Update Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
