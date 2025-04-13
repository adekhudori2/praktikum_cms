
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Detail Mahasiswa</h2>
        <div class="btn-group">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" 
                    data-bs-target="#deleteModal">
                Hapus
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <h5>Nama Lengkap</h5>
                <p>{{ $user->nama }}</p>
            </div>
            <div class="col-md-6">
                <h5>NIM</h5>
                <p>{{ $user->nim }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <h5>Email</h5>
                <p>{{ $user->email }}</p>
            </div>
            <div class="col-md-6">
                <h5>Telepon</h5>
                <p>{{ $user->telepon ?? '-' }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <h5>Program Studi</h5>
                <p>{{ $user->program_studi }}</p>
            </div>
            <div class="col-md-6">
                <h5>Fakultas</h5>
                <p>{{ $user->fakultas }}</p>
            </div>
        </div>

        <div class="mb-3">
            <h5>Alamat</h5>
            <p>{{ $user->alamat ?? '-' }}</p>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data mahasiswa ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Inisialisasi modal
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
</script>
@endpush