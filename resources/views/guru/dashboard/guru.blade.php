@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <h2>Dashboard Guru</h2>
        <p>Selamat Datang, {{ auth()->user()->name }}</p>
    </div>
    <div class="row mt-30">
        <div class="col-xl-4 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon primary"><i class="lni lni-bullhorn"></i></div>
                <div class="content">
                    <h6 class="mb-10">Aspirasi Masuk</h6>
                    <h3 class="text-bold mb-10">0</h3>
                    <p class="text-sm">Perlu diverifikasi</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
