@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Hapus Petugas</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-style mb-30">
                <div class="table-wrapper table-responsive">
                    <form action="{{ route('admin.petugas.destroy', $petugas->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <p>Apakah Anda yakin ingin menghapus petugas <strong>{{ $petugas->name }}</strong>?</p>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        <a href="{{ route('admin.petugas.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
