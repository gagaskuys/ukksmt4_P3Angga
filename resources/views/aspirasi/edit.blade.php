@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">update status Aspirasi</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('aspirasi.update', $aspirasi->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="pending" {{ $aspirasi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ $aspirasi->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $aspirasi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection