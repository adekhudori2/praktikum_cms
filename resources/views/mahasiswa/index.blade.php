@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Mahasiswa</h5>
        </div>
        <div class="card-body">
            @if(count($mahasiswas) > 0)
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
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
                                <td>{{ $mahasiswa->nim }}</td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td>{{ $mahasiswa->jurusan }}</td>
                                <td>{{ $mahasiswa->email }}</td>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                @if($mahasiswa->foto)
                                    <img src="{{ asset('storage/uploads/'.$mahasiswa->foto) }}" 
                                        alt="Foto {{ $mahasiswa->nama }}" width="50" class="img-thumbnail">
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                                </td>
                                <td>
                                    <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{ route('mahasiswa.delete', $mahasiswa->id) }}" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                            <tr>
                            
                            <!-- tambahkan kolom lainnya -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">
                    Tidak ada data mahasiswa yang tersedia.
                </div>
            @endif
        </div>
    </div>
@endsection