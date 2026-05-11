@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <h2>tambah Guru</h2>
    </div>

    <div class="card-style mb-30">
        <form action="{{ route('admin.guru.store') }}" method="POST">
            @csrf
            <div class="input-style-1">
                <label>NIP</label>
                <input type="text" name="nip" placeholder="Masukkan NIP" required>
            </div>
            
            <div class="input-style-1">
                <label>Nama Lengkap</label>
                <input type="text" name="name" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="input-style-1">
                <label>Mata Pelajaran</label>
                <input type="text" name="mata_pelajaran" placeholder="Masukkan mata pelajaran" required>
            </div>
            <div class="input-style-1">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="input-style-1">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" placeholder="Masukkan tanggal lahir" required>
            </div>
            <div class="input-style-1">
                <label>Alamat</label>
                <input type="text" name="alamat" placeholder="Masukkan alamat" required>
            </div>
            <div class="input-style-1">
                <label>No Telepon</label>
                <input type="text" name="no_telepon" placeholder="Masukkan no telepon" required>
            </div>
            <div class="text-end">
                <a href="{{ route('admin.guru.index') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
                <button type="submit" class="main-btn success-btn rounded-md btn-hover">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection