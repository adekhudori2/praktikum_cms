@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="text-primary mb-1">
                        <i class="fas fa-user-graduate me-2"></i>Detail Mahasiswa
                    </h2>
                    <p class="text-muted mb-0">Informasi lengkap data mahasiswa</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i>Edit Data
                    </a>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Profile Card -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-gradient-primary text-white text-center py-4">
                    <div class="mb-3">
                        @if($mahasiswa->foto)
                            <img src="{{ asset('storage/uploads/'.$mahasiswa->foto) }}" 
                                alt="Foto {{ $mahasiswa->nama }}" 
                                class="rounded-circle border-4 border-white shadow"
                                width="150" height="150" style="object-fit:cover;">
                        @else
                            <div class="rounded-circle border-4 border-white shadow d-inline-flex align-items-center justify-content-center bg-light"
                                width="150" height="150" style="width: 150px; height: 150px;">
                                <i class="fas fa-user-graduate fa-4x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <h4 class="mb-1">{{ $mahasiswa->nama }}</h4>
                    <p class="mb-0 opacity-75">
                        <i class="fas fa-id-card me-1"></i>{{ $mahasiswa->nim }}
                    </p>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <span class="badge bg-info fs-6 px-3 py-2">
                            <i class="fas fa-graduation-cap me-1"></i>{{ $mahasiswa->jurusan }}
                        </span>
                    </div>
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h5 class="text-primary mb-1">{{ $mahasiswa->created_at->format('d') }}</h5>
                                <small class="text-muted">Tanggal Daftar</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h5 class="text-success mb-1">{{ $mahasiswa->created_at->format('M Y') }}</h5>
                            <small class="text-muted">Bulan Tahun</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Information Card -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2 text-primary"></i>Informasi Pribadi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="icon-wrapper bg-primary text-white rounded-circle me-3">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                    <h6 class="mb-0 text-primary">NIM</h6>
                                </div>
                                <p class="mb-0 fs-5 fw-semibold">{{ $mahasiswa->nim }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="icon-wrapper bg-success text-white rounded-circle me-3">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <h6 class="mb-0 text-success">Nama Lengkap</h6>
                                </div>
                                <p class="mb-0 fs-5 fw-semibold">{{ $mahasiswa->nama }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="icon-wrapper bg-info text-white rounded-circle me-3">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <h6 class="mb-0 text-info">Jurusan</h6>
                                </div>
                                <p class="mb-0 fs-5 fw-semibold">{{ $mahasiswa->jurusan }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="icon-wrapper bg-warning text-white rounded-circle me-3">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <h6 class="mb-0 text-warning">Email</h6>
                                </div>
                                <p class="mb-0 fs-5 fw-semibold">{{ $mahasiswa->email }}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="info-item mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="icon-wrapper bg-secondary text-white rounded-circle me-3">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <h6 class="mb-0 text-secondary">Alamat</h6>
                                </div>
                                <p class="mb-0 fs-5 fw-semibold">{{ $mahasiswa->alamat }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-clock me-2 text-primary"></i>Informasi Pendaftaran
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center p-3 border rounded">
                                <i class="fas fa-calendar-alt fa-2x text-primary mb-2"></i>
                                <h6 class="text-primary">Tanggal Pendaftaran</h6>
                                <p class="mb-0 fw-semibold">{{ $mahasiswa->created_at->format('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 border rounded">
                                <i class="fas fa-clock fa-2x text-success mb-2"></i>
                                <h6 class="text-success">Waktu Pendaftaran</h6>
                                <p class="mb-0 fw-semibold">{{ $mahasiswa->created_at->format('H:i') }} WIB</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 border rounded">
                                <i class="fas fa-calendar-check fa-2x text-info mb-2"></i>
                                <h6 class="text-info">Status</h6>
                                <p class="mb-0 fw-semibold">
                                    <span class="badge bg-success">Terdaftar</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-warning btn-lg">
                            <i class="fas fa-edit me-2"></i>Edit Data Mahasiswa
                        </a>
                        <a href="{{ route('mahasiswa.delete', $mahasiswa->id) }}" class="btn btn-danger btn-lg"
                           onclick="return confirm('Yakin ingin menghapus data mahasiswa ini?')">
                            <i class="fas fa-trash me-2"></i>Hapus Data
                        </a>
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #007bff, #0056b3);
}
.border-4 {
    border-width: 4px !important;
}
.icon-wrapper {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
}
.info-item {
    padding: 1rem;
    border-radius: 0.5rem;
    background: #f8f9fa;
    transition: all 0.3s ease;
}
.info-item:hover {
    background: #e9ecef;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
.card {
    transition: transform 0.2s ease-in-out;
}
.card:hover {
    transform: translateY(-2px);
}
@media print {
    .btn, .d-flex {
        display: none !important;
    }
}
</style>
@endsection