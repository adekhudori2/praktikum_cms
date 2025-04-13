@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Tambah Mahasiswa Baru</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" required>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="program_studi" class="form-label">Program Studi</label>
                    <input type="text" class="form-control" id="program_studi" name="program_studi" required>
                </div>
                <div class="col-md-6">
                    <label for="fakultas" class="form-label">Fakultas</label>
                    <input type="text" class="form-control" id="fakultas" name="fakultas" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="telepon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection