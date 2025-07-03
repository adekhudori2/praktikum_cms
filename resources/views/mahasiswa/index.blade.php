@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="text-primary mb-1">
                        <i class="fas fa-users me-2"></i>Data Mahasiswa
                    </h2>
                    <p class="text-muted mb-0">Kelola data mahasiswa dengan mudah dan efisien</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('mahasiswa.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i>Tambah Mahasiswa
                    </a>
                    <button class="btn btn-outline-primary" onclick="window.print()">
                        <i class="fas fa-print me-1"></i>Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <form action="{{ route('mahasiswa.index') }}" method="GET" class="d-flex">
                <div class="input-group">
                    <span class="input-group-text bg-primary text-white">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama, NIM, jurusan, atau email..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    @if(request('search'))
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>
        <div class="col-md-4 text-end">
            <div class="d-flex justify-content-end align-items-center">
                <span class="text-muted me-2">Tampilkan:</span>
                <select class="form-select form-select-sm w-auto" onchange="changeView(this.value)">
                    <option value="card">Card View</option>
                    <option value="table">Table View</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $mahasiswas->total() }}</h4>
                            <small>Total Mahasiswa</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $mahasiswas->where('foto', '!=', null)->count() }}</h4>
                            <small>Dengan Foto</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-camera fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $mahasiswas->unique('jurusan')->count() }}</h4>
                            <small>Jurusan</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-graduation-cap fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
        <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $mahasiswas->where('foto', null)->count() }}</h4>
                            <small>Belum Ada Foto</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card View (Default) -->
    <div id="card-view" class="view-section">
        @if(count($mahasiswas) > 0)
            <div class="row">
                @foreach($mahasiswas as $mahasiswa)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-header bg-gradient-primary text-white text-center py-3">
                                <h6 class="mb-0">
                                    <i class="fas fa-id-card me-2"></i>{{ $mahasiswa->nim }}
                                </h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    @if($mahasiswa->foto)
                                        <img src="{{ asset('storage/uploads/'.$mahasiswa->foto) }}" 
                                            alt="Foto {{ $mahasiswa->nama }}" 
                                            class="rounded-circle border-3 border-primary"
                                            width="100" height="100" style="object-fit:cover;">
                                    @else
                                        <div class="rounded-circle border-3 border-primary d-inline-flex align-items-center justify-content-center bg-light"
                                            width="100" height="100" style="width: 100px; height: 100px;">
                                            <i class="fas fa-user fa-2x text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <h5 class="card-title text-primary mb-1">{{ $mahasiswa->nama }}</h5>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-graduation-cap me-1"></i>{{ $mahasiswa->jurusan }}
                                </p>
                                <p class="text-muted mb-3">
                                    <i class="fas fa-envelope me-1"></i>{{ $mahasiswa->email }}
                                </p>
                                <div class="d-grid gap-2">
                                    <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}" class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </a>
                                    <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <a href="{{ route('mahasiswa.delete', $mahasiswa->id) }}" class="btn btn-outline-danger btn-sm" 
                                       onclick="return confirm('Yakin ingin menghapus data mahasiswa ini?')">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-users fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">
                    @if(request('search'))
                        Tidak ada data mahasiswa yang sesuai dengan pencarian "{{ request('search') }}"
                    @else
                        Belum ada data mahasiswa
                    @endif
                </h4>
                <p class="text-muted">Silakan tambahkan data mahasiswa baru</p>
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Tambah Mahasiswa
                </a>
            </div>
        @endif
    </div>

    <!-- Table View (Hidden by default) -->
    <div id="table-view" class="view-section" style="display: none;">
            @if(count($mahasiswas) > 0)
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Foto</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswas as $mahasiswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                @if($mahasiswa->foto)
                                    <img src="{{ asset('storage/uploads/'.$mahasiswa->foto) }}" 
                                                    alt="Foto {{ $mahasiswa->nama }}" 
                                                    class="rounded-circle" width="40" height="40" style="object-fit:cover;">
                                @else
                                                <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center" 
                                                     width="40" height="40" style="width: 40px; height: 40px;">
                                                    <i class="fas fa-user text-muted"></i>
                                                </div>
                                @endif
                                </td>
                                        <td><strong>{{ $mahasiswa->nim }}</strong></td>
                                        <td>{{ $mahasiswa->nama }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $mahasiswa->jurusan }}</span>
                                        </td>
                                        <td>{{ $mahasiswa->email }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}" class="btn btn-outline-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-outline-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('mahasiswa.delete', $mahasiswa->id) }}" class="btn btn-outline-danger"
                                                   onclick="return confirm('Yakin ingin menghapus data mahasiswa ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($mahasiswas->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Menampilkan {{ $mahasiswas->firstItem() ?? 0 }} - {{ $mahasiswas->lastItem() ?? 0 }} dari {{ $mahasiswas->total() }} data
                    </div>
                    <div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm mb-0">
                                {{-- Previous Page Link --}}
                                @if ($mahasiswas->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">
                                            <i class="fas fa-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $mahasiswas->previousPageUrl() }}" rel="prev">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Next Page Link --}}
                                @if ($mahasiswas->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $mahasiswas->nextPageUrl() }}" rel="next">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
            @else
                                    <li class="page-item disabled">
                                        <span class="page-link">
                                            <i class="fas fa-chevron-right"></i>
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #007bff, #0056b3);
}
.border-3 {
    border-width: 3px !important;
}
.card {
    transition: transform 0.2s ease-in-out;
}
.card:hover {
    transform: translateY(-5px);
}
.btn-group-sm .btn {
    padding: 0.25rem 0.5rem;
}

/* Custom Pagination Styling */
.pagination {
    font-size: 0.875rem;
}
.pagination .page-link {
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    border-radius: 0.375rem;
    margin: 0 3px;
    min-width: 40px;
    text-align: center;
    border: 1px solid #dee2e6;
    color: #007bff;
    background-color: #fff;
    transition: all 0.2s ease-in-out;
}
.pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
    color: #fff;
}
.pagination .page-item.disabled .page-link {
    color: #6c757d;
    background-color: #f8f9fa;
    border-color: #dee2e6;
    cursor: not-allowed;
}
.pagination .page-link:hover:not(.disabled) {
    background-color: #e9ecef;
    border-color: #007bff;
    color: #007bff;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.pagination .page-link:focus {
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
    outline: none;
}

@media print {
    .btn, .form-control, .input-group {
        display: none !important;
    }
}
</style>

<script>
function changeView(view) {
    if (view === 'card') {
        document.getElementById('card-view').style.display = 'block';
        document.getElementById('table-view').style.display = 'none';
    } else {
        document.getElementById('card-view').style.display = 'none';
        document.getElementById('table-view').style.display = 'block';
    }
}
</script>
@endsection