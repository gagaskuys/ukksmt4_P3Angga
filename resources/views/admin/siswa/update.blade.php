@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Edit Siswa</h1>
    <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="input-style-1">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $siswa->name) }}" placeholder="Masukkan nama lengkap" required>
        </div>
        <div class="input-style-1">
            <label>NIS</label>
            <input type="text" name="nis" value="{{ old('nis', $siswa->nis) }}" placeholder="Masukkan NIS" required>
        </div>
        <div class="input-style-1">
            <label>Kelas</label>
            <select name="kelas_id" required>
                <option value="">Pilih Kelas</option>
                @foreach($kelass as $kelas)
                    <option value="{{ $kelas->id }}" {{ old('kelas_id', $siswa->kelas_id) == $kelas->id ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-style-1">
            <label>Jurusan</label>
            <select name="jurusan_id" required>
                <option value="">Pilih Jurusan</option>
                @foreach($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $siswa->jurusan_id) == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-style-1">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="input-style-1">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $siswa->email) }}" placeholder="Masukkan email" required>
        </div>
        <div class="input-style-1">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password baru (bisa dikosongkan jika tidak ingin mengubah password)">
        </div>
        <div class="input-style-1">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}" placeholder="Masukkan tanggal lahir" required>
        </div>
            <div class="input-style-1">
                <label>Alamat</label>
                <textarea name="alamat" placeholder="Masukkan alamat">{{ old('alamat', $siswa->alamat) }}</textarea>
            </div>
             <div class="input-style-1">
                <label>Nomor Telepon</label>
                <input type="text" name="no_telepon" value="{{ old('no_telepon', $siswa->no_telepon) }}" placeholder="Masukkan nomor telepon">
            </div>

             <div class="text-end">
                <a href="{{ route('admin.siswa.index') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
            </div>        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
