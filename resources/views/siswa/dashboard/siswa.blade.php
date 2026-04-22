@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <h2>Dashboard Siswa</h2>
        <p>Halo, {{ auth()->user()->name }}! Ada aspirasi hari ini?</p>
    </div>
    <div class="row mt-30">
        <div class="col-xl-4 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon success"><i class="lni lni-checkmark-circle"></i></div>
                <div class="content">
                    <h6 class="mb-10">Aspirasi Saya</h6>
                    <h3 class="text-bold mb-10">0</h3>
                    <p class="text-sm">Total pengajuan Anda</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
