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
        <form action="{{ route('admin.kepsek.update', $kepsek->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="input-style-1">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ $kepsek->name }}" placeholder="Masukkan nama lengkap kepala sekolah" required>
            </div>
            <div class="input-style-1">
                <label>NIP</label>
                <input type="text" name="nip" value="{{ $kepsek->nip }}" placeholder="Masukkan NIP kepala sekolah" required>
            </div>
            <div class="input-style-1">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L" {{ $kepsek->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $kepsek->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            </div>
            <div class="input-style-1">
                <label>Nomor HP</label>
                <input type="text" name="no_hp" value="{{ $kepsek->no_hp }}" placeholder="Masukkan nomor HP kepala sekolah (opsional)">
            </div>
            <div class="text-end">
                <a href="{{ route('admin.kepsek.index') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
                <button type="submit" class="main-btn success-btn rounded-md btn-hover">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection