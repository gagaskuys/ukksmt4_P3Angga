@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <h2>Kirim Aspirasi Baru</h2>
    </div>
    <div class="card-style mb-30">
        <form action="{{ route('aspirasi.store') }}" method="POST">
            @csrf
            <div class="input-style-1">
                <label>Topik Aspirasi</label>
                <input type="text" name="topik" placeholder="Contoh: Fasilitas Kelas" required />
            </div>
            <div class="input-style-1">
                <label>Isi Aspirasi</label>
                <textarea name="cerita" rows="5" placeholder="Ceritakan aspirasi Anda..." required></textarea>
            </div>
            <button type="submit" class="main-btn primary-btn btn-hover">Kirim Aspirasi</button>
        </form>
    </div>
</div>
@endsection
