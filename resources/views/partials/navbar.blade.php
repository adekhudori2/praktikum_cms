<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        @if(auth()->guard('web')->check() || auth()->guard('mahasiswa')->check())
            @php
                $user = auth()->guard('web')->user() ?? auth()->guard('mahasiswa')->user();
            @endphp
            @if($user->role === 'admin')
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
            @else
                <a class="navbar-brand" href="{{ route('mahasiswa.dashboard') }}">Mahasiswa Dashboard</a>
            @endif
        @else
            <a class="navbar-brand" href="/">Manajemen Pendaftaran Mahasiswa</a>
        @endif
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @if(auth()->guard('web')->check() || auth()->guard('mahasiswa')->check())
                    @php
                        $user = auth()->guard('web')->user() ?? auth()->guard('mahasiswa')->user();
                    @endphp
                    @if($user->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mahasiswa.index') }}">Daftar Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mahasiswa.create') }}">Tambah Mahasiswa</a>
                </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mahasiswa.profile.edit') }}">Edit Profil</a>
                        </li>
                    @endif
                @endif
            </ul>
            
            <ul class="navbar-nav">
                @if(auth()->guard('web')->check() || auth()->guard('mahasiswa')->check())
                    @php
                        $user = auth()->guard('web')->user() ?? auth()->guard('mahasiswa')->user();
                    @endphp
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ $user->nama }}
                            <span class="badge bg-light text-dark ms-1">{{ $user->role }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><span class="dropdown-item-text text-muted">
                                <i class="fas fa-user me-1"></i>{{ $user->role }}
                            </span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>