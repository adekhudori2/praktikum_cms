<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Hapus Mahasiswa - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #1e293b;
        }
        
        .navbar {
            background: #0f172a;
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #60a5fa;
        }
        
        .navbar-nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-link {
            color: #cbd5e1;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            background: #1e293b;
            color: white;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
        }
        
        .confirmation-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 2rem;
            text-align: center;
        }
        
        .warning-icon {
            font-size: 4rem;
            color: #f59e0b;
            margin-bottom: 1rem;
        }
        
        .confirmation-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1rem;
        }
        
        .confirmation-message {
            color: #6b7280;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .student-info {
            background: #f8fafc;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-left: 4px solid #ef4444;
        }
        
        .student-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1rem;
            border: 3px solid #e5e7eb;
        }
        
        .student-name {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        
        .student-details {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 1rem;
        }
        
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        
        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: #6b7280;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #4b5563;
            transform: translateY(-2px);
        }
        
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .alert-warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fcd34d;
        }
        
        .danger-zone {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .danger-zone h3 {
            color: #dc2626;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .danger-zone p {
            color: #991b1b;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <div class="navbar-brand">
                <i class="fas fa-graduation-cap"></i>
                Admin Dashboard
            </div>
            <div class="navbar-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="{{ route('mahasiswa.index') }}" class="nav-link">
                    <i class="fas fa-users"></i> Daftar Mahasiswa
                </a>
                <a href="{{ route('mahasiswa.create') }}" class="nav-link">
                    <i class="fas fa-plus"></i> Tambah Mahasiswa
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        @if (session('error'))
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="page-header">
            <h1 class="page-title">Konfirmasi Hapus</h1>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Daftar
            </a>
        </div>

        <div class="confirmation-card">
            <div class="warning-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            
            <h2 class="confirmation-title">Konfirmasi Penghapusan Mahasiswa</h2>
            <p class="confirmation-message">
                Anda akan menghapus mahasiswa berikut dari sistem. Tindakan ini tidak dapat dibatalkan.
            </p>

            <div class="student-info">
                @if($mahasiswa->foto)
                    <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto Profil" class="student-avatar">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($mahasiswa->nama) }}&background=3b82f6&color=fff&size=80" alt="Avatar" class="student-avatar">
                @endif
                <div class="student-name">{{ $mahasiswa->nama }}</div>
                <div class="student-details">
                    NIM: {{ $mahasiswa->nim }} | {{ $mahasiswa->jurusan }}<br>
                    Email: {{ $mahasiswa->email }}<br>
                    Role: {{ ucfirst($mahasiswa->role) }}
                </div>
            </div>

            <div class="danger-zone">
                <h3>
                    <i class="fas fa-exclamation-circle"></i>
                    Zona Berbahaya
                </h3>
                <p>
                    <strong>Peringatan:</strong> Menghapus mahasiswa ini akan menghapus semua data terkait termasuk:
                </p>
                <ul style="text-align: left; margin-top: 0.5rem; margin-left: 1.5rem;">
                    <li>Data profil mahasiswa</li>
                    <li>Foto profil (jika ada)</li>
                    <li>Riwayat login</li>
                    <li>Semua data terkait lainnya</li>
                </ul>
                <p style="margin-top: 1rem; font-weight: 600;">
                    Tindakan ini TIDAK DAPAT DIBATALKAN!
                </p>
            </div>

            <div class="action-buttons">
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Batal
                </a>
                <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda benar-benar yakin ingin menghapus mahasiswa ini? Tindakan ini tidak dapat dibatalkan.')">
                        <i class="fas fa-trash"></i>
                        Ya, Hapus Mahasiswa
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 