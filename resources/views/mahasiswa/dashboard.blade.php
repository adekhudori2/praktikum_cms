@extends('layouts.app')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center">
                    <h2 class="mb-4">Selamat Datang, <span class="text-primary">{{ $mahasiswa->nama }}</span></h2>
                    <div class="mb-4">
                        @if($mahasiswa->foto)
                            <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto Profil" class="rounded-circle" width="120" height="120" style="object-fit:cover; border:4px solid #0d6efd;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($mahasiswa->nama) }}&background=0d6efd&color=fff&size=120" alt="Avatar" class="rounded-circle" width="120" height="120">
                        @endif
                    </div>
                    <div class="row mb-4 justify-content-center">
                        <div class="col-md-6 text-start">
                            <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
                            <p><strong>Email:</strong> {{ $mahasiswa->email }}</p>
                            <p><strong>Jurusan:</strong> {{ $mahasiswa->jurusan }}</p>
                        </div>
                    </div>
                    @if(!$mahasiswa->foto)
                        <div class="alert alert-warning">Lengkapi data diri Anda dengan mengunggah foto profil.</div>
                    @endif
                    <a href="{{ route('mahasiswa.profile.edit') }}" class="btn btn-primary px-4">Edit Data Diri</a>
                    <div class="alert alert-info">Selamat datang di dashboard mahasiswa!</div>
                    <div class="alert alert-warning">
                        <i class="fas fa-shield-alt me-2"></i>
                        <strong>Pembatasan Akses:</strong> Mahasiswa hanya bisa mengakses dashboard dan edit profil sendiri. Tidak bisa mengakses fitur admin.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
