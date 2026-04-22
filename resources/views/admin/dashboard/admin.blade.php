@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Judul Halaman -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Dashboard Admin (Rekap & Statistik)</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Kotak Statistik (Cards) -->
    <div class="row">
        <!-- Card Total Siswa -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon purple">
                    <i class="lni lni-users"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">Total Siswa</h6>
                    <h3 class="text-bold mb-10">{{ $totalSiswa }}</h3>
                </div>
            </div>
        </div>

        <!-- Card Total Guru -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon success">
                    <i class="lni lni-user"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">Total Guru</h6>
                    <h3 class="text-bold mb-10">{{ $totalGuru }}</h3>
                </div>
            </div>
        </div>

        <!-- Card Total Aspirasi -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon primary">
                    <i class="lni lni-archive"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">Total Aspirasi</h6>
                    <h3 class="text-bold mb-10">{{ $totalAspirasi }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
