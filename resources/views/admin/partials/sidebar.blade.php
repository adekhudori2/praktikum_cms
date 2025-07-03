<div class="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-brand">
            <i class="fas fa-graduation-cap"></i>
            <span>Admin Panel</span>
        </div>
    </div>
    
    <nav class="sidebar-nav">
        <div class="nav-section">
            <h3 class="nav-section-title">Dashboard</h3>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </div>
        
        <div class="nav-section">
            <h3 class="nav-section-title">Manajemen Mahasiswa</h3>
            <a href="{{ route('mahasiswa.index') }}" class="nav-item {{ request()->routeIs('mahasiswa.index') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Daftar Mahasiswa</span>
            </a>
            <a href="{{ route('mahasiswa.create') }}" class="nav-item {{ request()->routeIs('mahasiswa.create') ? 'active' : '' }}">
                <i class="fas fa-user-plus"></i>
                <span>Tambah Mahasiswa</span>
            </a>
        </div>
        
        <div class="nav-section">
            <h3 class="nav-section-title">Laporan</h3>
            <a href="#" class="nav-item">
                <i class="fas fa-chart-bar"></i>
                <span>Statistik</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-file-alt"></i>
                <span>Laporan</span>
            </a>
        </div>
        
        <div class="nav-section">
            <h3 class="nav-section-title">Pengaturan</h3>
            <a href="#" class="nav-item">
                <i class="fas fa-cog"></i>
                <span>Pengaturan Sistem</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-user-cog"></i>
                <span>Profil Admin</span>
            </a>
        </div>
    </nav>
</div>

<style>
.sidebar {
    width: 250px;
    background: #1e293b;
    color: white;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    overflow-y: auto;
}

.sidebar-header {
    padding: 1.5rem;
    border-bottom: 1px solid #334155;
}

.sidebar-brand {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.25rem;
    font-weight: 700;
    color: #60a5fa;
}

.sidebar-nav {
    padding: 1rem 0;
}

.nav-section {
    margin-bottom: 2rem;
}

.nav-section-title {
    font-size: 0.75rem;
    font-weight: 600;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding: 0 1.5rem;
    margin-bottom: 0.5rem;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1.5rem;
    color: #cbd5e1;
    text-decoration: none;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
}

.nav-item:hover {
    background: #334155;
    color: white;
    border-left-color: #60a5fa;
}

.nav-item.active {
    background: #334155;
    color: white;
    border-left-color: #60a5fa;
}

.nav-item i {
    width: 1rem;
    text-align: center;
}

@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .sidebar.show {
        transform: translateX(0);
    }
}
</style> 