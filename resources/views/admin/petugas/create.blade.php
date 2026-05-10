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
        <form action="{{ route('petugas.store') }}" method="POST">
            @csrf
            <div class="input-style-1">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_petugas" placeholder="Masukkan nama lengkap petugas" required>
            </div>
            <div class="input-style-1">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email petugas" required>
            </div>
            <div class="input-style-1">
                <label>Nomor HP</label>
                <input type="text" name="no_hp" placeholder="Masukkan nomor HP petugas (opsional)">
            </div>
            <div class="text-end">
                <a href="{{ url('petugas') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
                <button type="submit" class="main-btn success-btn rounded-md btn-hover">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection