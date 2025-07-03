<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa - Admin Dashboard</title>
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
            max-width: 1000px;
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
        
        .profile-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            margin: 0 auto 1rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .profile-name {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .profile-nim {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 1rem;
        }
        
        .profile-role {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .profile-content {
            padding: 2rem;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .info-section {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 0.75rem;
            border-left: 4px solid #3b82f6;
        }
        
        .info-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 500;
            color: #6b7280;
        }
        
        .info-value {
            font-weight: 600;
            color: #1e293b;
            text-align: right;
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
        
        .btn-primary {
            background: #3b82f6;
            color: white;
        }
        
        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-2px);
        }
        
        .btn-warning {
            background: #f59e0b;
            color: white;
        }
        
        .btn-warning:hover {
            background: #d97706;
            transform: translateY(-2px);
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
        
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        
        .alert-warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fcd34d;
        }
        
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }
            
            .profile-header {
                padding: 2rem 1rem;
            }
            
            .profile-name {
                font-size: 1.5rem;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
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
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="page-header">
            <h1 class="page-title">Detail Mahasiswa</h1>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Daftar
            </a>
        </div>

        <div class="profile-card">
            <div class="profile-header">
                @if($mahasiswa->foto)
                    <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto Profil" class="profile-avatar">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($mahasiswa->nama) }}&background=3b82f6&color=fff&size=120" alt="Avatar" class="profile-avatar">
                @endif
                <h2 class="profile-name">{{ $mahasiswa->nama }}</h2>
                <p class="profile-nim">NIM: {{ $mahasiswa->nim }}</p>
                <span class="profile-role">
                    <i class="fas fa-{{ $mahasiswa->role === 'admin' ? 'user-shield' : 'user-graduate' }}"></i>
                    {{ ucfirst($mahasiswa->role) }}
                </span>
            </div>

            <div class="profile-content">
                <div class="info-grid">
                    <div class="info-section">
                        <h3 class="info-title">
                            <i class="fas fa-user"></i>
                            Informasi Pribadi
                        </h3>
                        <div class="info-item">
                            <span class="info-label">Nama Lengkap</span>
                            <span class="info-value">{{ $mahasiswa->nama }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">NIM</span>
                            <span class="info-value">{{ $mahasiswa->nim }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $mahasiswa->email }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Username</span>
                            <span class="info-value">{{ $mahasiswa->username }}</span>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3 class="info-title">
                            <i class="fas fa-graduation-cap"></i>
                            Informasi Akademik
                        </h3>
                        <div class="info-item">
                            <span class="info-label">Jurusan</span>
                            <span class="info-value">{{ $mahasiswa->jurusan }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Role</span>
                            <span class="info-value">
                                <span style="background: {{ $mahasiswa->role === 'admin' ? '#fef3c7' : '#dbeafe' }}; color: {{ $mahasiswa->role === 'admin' ? '#92400e' : '#1e40af' }}; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: 600;">
                                    {{ ucfirst($mahasiswa->role) }}
                                </span>
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Status</span>
                            <span class="info-value">
                                <span style="background: #d1fae5; color: #065f46; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: 600;">
                                    Aktif
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3 class="info-title">
                            <i class="fas fa-map-marker-alt"></i>
                            Informasi Kontak
                        </h3>
                        <div class="info-item">
                            <span class="info-label">Alamat</span>
                            <span class="info-value">{{ $mahasiswa->alamat }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $mahasiswa->email }}</span>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3 class="info-title">
                            <i class="fas fa-calendar-alt"></i>
                            Informasi Sistem
                        </h3>
                        <div class="info-item">
                            <span class="info-label">Tanggal Dibuat</span>
                            <span class="info-value">{{ $mahasiswa->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Terakhir Diupdate</span>
                            <span class="info-value">{{ $mahasiswa->updated_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                        Edit Mahasiswa
                    </a>
                    <a href="{{ route('mahasiswa.delete', $mahasiswa->id) }}" class="btn btn-danger" 
                       onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">
                        <i class="fas fa-trash"></i>
                        Hapus Mahasiswa
                    </a>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                        <i class="fas fa-list"></i>
                        Lihat Semua Mahasiswa
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 