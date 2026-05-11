@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2> Tambah Petugas</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="card-style mb-30">
        <form action="{{ route('admin.petugas.store') }}" method="POST">
            @csrf
            <div class="input-style-1">
                <label> NIP</label>
                <input type="text" name="nip" placeholder="Masukkan NIP petugas" required>
            </div>
            
            <div class="input-style-1">
                <label>Nama Lengkap</label>
                <input type="text" name="name" placeholder="Masukkan nama lengkap petugas" required>
            </div>
            <div class="input-style-1">
                <label>Jabatan</label>
                <input type="text" name="jabatan" placeholder="Masukkan jabatan petugas" required>
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
                <label>Nomor HP</label>
                <input type="text" name="no_hp" placeholder="Masukkan nomor HP petugas (opsional)">
            </div>
            <div class="text-end">
                <a href="{{ route('admin.petugas.index') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
                <button type="submit" class="main-btn success-btn rounded-md btn-hover">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection