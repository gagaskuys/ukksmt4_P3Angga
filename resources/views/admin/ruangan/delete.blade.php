@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <h2>Hapus Ruangan</h2>
    </div>

    <div class="card-style mb-30">
        <p>Apakah Anda yakin ingin menghapus ruangan ini?</p>
        <form action="{{ route('admin.ruangan.destroy', $ruangan->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="main-btn danger-btn rounded-md btn-hover">Hapus</button>
            <a href="{{ route('admin.ruangan.index') }}" class="main-btn secondary-btn rounded-md btn-hover">Batal</a>
        </form>
    </div>
</div>
@endsection