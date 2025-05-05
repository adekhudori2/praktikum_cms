@extends('layouts.app')

@section('title', 'Hapus Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Konfirmasi Hapus Data</h5>
        </div>
        <div class="card-body">
            <p class="mb-4">Apakah Anda yakin ingin menghapus data mahasiswa berikut?</p>
            
            <div class="alert alert-warning">
                <div class="row mb-2">
                    <div class="col-md-3 fw-bold">NIM</div>
                    <div class="col-md-9">{{ $mahasiswa->nim }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 fw-bold">Nama</div>
                    <div class="col-md-9">{{ $mahasiswa->nama }}</div>
                </div>
                <div class="row">
                    <div class="col-md-3 fw-bold">Jurusan</div>
                    <div class="col-md-9">{{ $mahasiswa->jurusan }}</div>
                </div>
            </div>
            
            <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Ya, Hapus Data</button>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection