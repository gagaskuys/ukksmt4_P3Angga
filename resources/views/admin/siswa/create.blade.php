@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <h2>Tambah Siswa Baru</h2>
    </div>

    <div class="card-style mb-30">
        <form action="{{ route('admin.siswa.store') }}" method="POST">
            @csrf
            <div class="input-style-1">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Masukkan nama" required>
            </div>
            <div class="input-style-1">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email" required>
            </div>
            <div class="input-style-1">
                <label>Password</label>
                <input type="password" name="password" placeholder="Minimal 6 karakter" required>
            </div>
            <div class="text-end">
                <a href="{{ route('admin.siswa.index') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
                <button type="submit" class="main-btn primary-btn btn-hover">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
