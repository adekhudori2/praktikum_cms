<header class="admin-header">
    <div class="header-content">
        <div class="header-left">
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <div class="breadcrumb">
                @yield('breadcrumb', 'Dashboard')
            </div>
        </div>
        
        <div class="header-right">
            <div class="header-actions">
                <button class="action-btn" onclick="toggleNotifications()">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                
                <div class="user-menu">
                    <button class="user-toggle" onclick="toggleUserMenu()">
                        @if(Auth::user()->foto)
                            <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Profile" class="user-avatar">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}&background=3b82f6&color=fff&size=32" alt="Avatar" class="user-avatar">
                        @endif
                        <span class="user-name">{{ Auth::user()->nama }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    
                    <div class="user-dropdown" id="userDropdown">
                        <div class="dropdown-header">
                            <div class="user-info">
                                <div class="user-full-name">{{ Auth::user()->nama }}</div>
                                <div class="user-role">{{ ucfirst(Auth::user()->role) }}</div>
                            </div>
                        </div>
                        
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-user"></i>
                                <span>Profil Saya</span>
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-cog"></i>
                                <span>Pengaturan</span>
                            </a>
                            <hr class="dropdown-divider">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item logout-btn">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
.admin-header {
    background: white;
    border-bottom: 1px solid #e5e7eb;
    padding: 1rem 2rem;
    position: sticky;
    top: 0;
    z-index: 100;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.sidebar-toggle {
    background: none;
    border: none;
    font-size: 1.25rem;
    color: #6b7280;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
}

.sidebar-toggle:hover {
    background: #f3f4f6;
    color: #374151;
}

.breadcrumb {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
}

.header-right {
    display: flex;
    align-items: center;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.action-btn {
    background: none;
    border: none;
    font-size: 1.125rem;
    color: #6b7280;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 0.5rem;
    position: relative;
    transition: all 0.3s ease;
}

.action-btn:hover {
    background: #f3f4f6;
    color: #374151;
}

.notification-badge {
    position: absolute;
    top: 0;
    right: 0;
    background: #ef4444;
    color: white;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.125rem 0.375rem;
    border-radius: 1rem;
    min-width: 1.25rem;
    text-align: center;
}

.user-menu {
    position: relative;
}

.user-toggle {
    background: none;
    border: none;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.user-toggle:hover {
    background: #f3f4f6;
}

.user-avatar {
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    object-fit: cover;
}

.user-name {
    font-weight: 500;
    color: #374151;
}

.user-dropdown {
    position: absolute;
    right: 0;
    top: 100%;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 0.75rem;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    min-width: 250px;
    z-index: 1000;
    display: none;
    margin-top: 0.5rem;
}

.user-dropdown.show {
    display: block;
}

.dropdown-header {
    padding: 1rem;
    border-bottom: 1px solid #f3f4f6;
}

.user-info {
    text-align: center;
}

.user-full-name {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.user-role {
    font-size: 0.875rem;
    color: #6b7280;
}

.dropdown-menu {
    padding: 0.5rem 0;
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    color: #374151;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
}

.dropdown-item:hover {
    background: #f9fafb;
}

.dropdown-item i {
    width: 1rem;
    text-align: center;
}

.dropdown-divider {
    border: none;
    border-top: 1px solid #e5e7eb;
    margin: 0.5rem 0;
}

.logout-btn {
    color: #ef4444;
}

.logout-btn:hover {
    background: #fef2f2;
}

@media (max-width: 768px) {
    .admin-header {
        padding: 1rem;
    }
    
    .user-name {
        display: none;
    }
    
    .breadcrumb {
        font-size: 1rem;
    }
}
</style>

<script>
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        sidebar.classList.toggle('show');
    }
}

function toggleUserMenu() {
    const dropdown = document.getElementById('userDropdown');
    dropdown.classList.toggle('show');
}

function toggleNotifications() {
    // Implementasi untuk toggle notifications
    console.log('Toggle notifications');
}

// Tutup dropdown jika klik di luar
window.onclick = function(event) {
    const dropdown = document.getElementById('userDropdown');
    if (dropdown && !event.target.closest('.user-menu')) {
        dropdown.classList.remove('show');
    }
}
</script> 