@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Kelola Data Siswa</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="tables-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <h6 class="mb-10">Daftar Siswa Aktif</h6>
                    <div class="table-wrapper table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><h6>No</h6></th>
                                    <th><h6>Nama</h6></th>
                                    <th><h6>Email</h6></th>
                                    <th><h6>Aksi</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswas as $key => $siswa)
                                <tr>
                                    <td><p>{{ $key + 1 }}</p></td>
                                    <td><p>{{ $siswa->name }}</p></td>
                                    <td><p>{{ $siswa->email }}</p></td>
                                    <td>
                                        <div class="action">
                                            <button class="text-danger"><i class="lni lni-trash-can"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
