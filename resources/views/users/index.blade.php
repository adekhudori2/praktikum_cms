@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Daftar Mahasiswa</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary">+ Tambah Mahasiswa</a>
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>Fakultas</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
        <tr>
            <td>{{ $user->nim }}</td>
            <td>{{ $user->nama }}</td>
            <td>{{ $user->program_studi }}</td>
            <td>{{ $user->fakultas }}</td>
            <td>
                <div class="btn-group" role="group">
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info">Detail</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" 
                            data-bs-target="#deleteModal{{ $user->id }}">
                        Hapus
                    </button>
                </div>

                <!-- Modal Konfirmasi Hapus -->
                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" 
                     aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus data mahasiswa:<br>
                                <strong>{{ $user->nama }} (NIM: {{ $user->nim }})</strong>?
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
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Tidak ada data mahasiswa</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection