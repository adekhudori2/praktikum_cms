@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detail Mahasiswa</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">NIM</div>
                <div class="col-md-9">{{ $mahasiswa['nim'] }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Nama Lengkap</div>
                <div class="col-md-9">{{ $mahasiswa['nama'] }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Jurusan</div>
                <div class="col-md-9">{{ $mahasiswa['jurusan'] }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Email</div>
                <div class="col-md-9">{{ $mahasiswa['email'] }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Alamat</div>
                <div class="col-md-9">{{ $mahasiswa['alamat'] }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Tanggal Pendaftaran</div>
                <div class="col-md-9">{{ $mahasiswa['created_at'] }}</div>
            </div>
            
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection