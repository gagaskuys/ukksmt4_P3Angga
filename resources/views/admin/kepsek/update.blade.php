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
    <div class="card-style mb-30">
        <form action="{{ route('kepsek.update', $kepsek->id_kepsek) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="input-style-1">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_kepsek" value="{{ $kepsek->nama_kepsek }}" placeholder="Masukkan nama lengkap kepala sekolah" required>
            </div>
            <div class="input-style-1">
                <label>NIP</label>
                <input type="text" name="nip" value="{{ $kepsek->nip }}" placeholder="Masukkan NIP kepala sekolah" required>
            </div>
            <div class="input-style-1">
                <label>Email</label>
                <input type="email" name="email" value="{{ $kepsek->email }}" placeholder="Masukkan email kepala sekolah" required>
            </div>
            <div class="input-style-1">
                <label>Nomor HP</label>
                <input type="text" name="no_hp" value="{{ $kepsek->no_hp }}" placeholder="Masukkan nomor HP kepala sekolah (opsional)">
            </div>
            <div class="text-end">
                <a href="{{ url('kepsek') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
                <button type="submit" class="main-btn success-btn rounded-md btn-hover">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection