@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Data Mahasiswa</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}">
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <select class="form-select @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan">
                        <option value="">Pilih Jurusan</option>
                        <option value="Teknik Informatika" {{ $mahasiswa->jurusan == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                        <option value="Sistem Informasi" {{ $mahasiswa->jurusan == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                        <option value="Teknik Komputer" {{ $mahasiswa->jurusan == 'Teknik Komputer' ? 'selected' : '' }}>Teknik Komputer</option>
                        <option value="Manajemen Informatika" {{ $mahasiswa->jurusan == 'Manajemen Informatika' ? 'selected' : '' }}>Manajemen Informatika</option>
                    </select>
                    @error('jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $mahasiswa->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat', $mahasiswa->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="foto">Foto Profil</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                        id="foto" name="foto">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    @if($mahasiswa->foto)
                        <div class="mt-2">
                            <img src="{{ asset('storage/uploads/'.$mahasiswa->foto) }}" 
                                width="100" class="img-thumbnail">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" 
                                    id="hapus_foto" name="hapus_foto">
                                <label class="form-check-label" for="hapus_foto">
                                    Hapus foto saat ini
                                </label>
                            </div>
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>

                
            </form>
        </div>
    </div>
@endsection