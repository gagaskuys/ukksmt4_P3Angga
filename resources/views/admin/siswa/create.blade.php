@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <h2>Tambah Siswa Baru</h2>
    </div>
    ```php id="5s69wr"
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
``` 
    <div class="card-style mb-30">
        <form action="{{ route('admin.siswa.store') }}" method="POST">
            @csrf
            <div class="input-style-1">
                <label>Nis</label>
                <input type="text" name="nis" placeholder="Masukkan nis" required>
            </div>
            <div class="input-style-1">
                <label>Nama Lengkap</label>
                <input type="text" name="name" placeholder="Masukkan nama" required>
            </div>
            <div class="select-style-1">
                <label>Pilih kelas</label>
                <div class="select-position">
                    <select name="kelas_id" required>
                        <option value="">-- Pilih kelas --</option>
                        @foreach($kelass as $k)
                            <!-- Ubah dari $r->id menjadi $r->id_ruangan sesuai pola kolommu -->
                            <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
                <div class="select-style-1">
                    <label>Pilih jurusan</label>
                    <div class="select-position">
                        <select name="jurusan_id" required>
                            <option value="">-- Pilih jurusan --</option>
                            @foreach($jurusans as $j)
                                <!-- Ubah dari $r->id menjadi $r->id_ruangan sesuai pola kolommu -->
                                <option value="{{ $j->id }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="select-style-1">
                    <label>Jenis Kelamin</label>
                    <div class="select-position">
                        <select name="jenis_kelamin" required>
                            <option value="">-- Pilih jenis kelamin --</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
            <div class="input-style-1">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email" required>
            </div>
            <div class="input-style-1">
                <label>Password</label>
                <input type="password" name="password" placeholder="Minimal 6 karakter" required>
            </div>
            <div class="input-style-1">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" required>
            </div>
            <div class="input-style-1">
                <label>Alamat</label>
                <input type="text" name="alamat" placeholder="Masukkan alamat" required>
            </div>
            <div class="input-style-1">
                <label>No Telepon</label>
                <input type="text" name="no_telepon" placeholder="Masukkan no telepon" required>
            </div>
            <div class="text-end">
                <a href="{{ route('admin.siswa.index') }}" class="main-btn danger-btn-outline btn-hover">Batal</a>
                <button type="submit" class="main-btn primary-btn btn-hover">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
