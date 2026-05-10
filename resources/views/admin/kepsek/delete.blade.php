@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Hapus Kepala Sekolah</h2>
                </div>
            </div>
        </div>

    </div>
    <div class="card-style mb-30">
        <h3>Apakah Anda yakin ingin menghapus akun ini?</h3>
        <form action="{{ route('kepsek.destroy', $kepsek->id_kepsek) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="text-end">
                <a href="{{ url('kepsek') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
                <button type="submit" class="main-btn success-btn rounded-md btn-hover">Hapus</button>
            </div>
        </form>
    </div>
</div>
@endsection