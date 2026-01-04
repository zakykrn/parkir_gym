<nav class="admin-navbar">
    <div class="navbar-brand">
        <span class="brand-icon">🚗</span>
        <span class="brand-text">Admin Parkir</span>
    </div>
    <div class="navbar-menu">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            Dashboard
        </a>
        <a href="{{ route('admin.data') }}" class="nav-link {{ request()->routeIs('admin.data') ? 'active' : '' }}">
            Data Parkir
        </a>
        <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            Pengaturan
        </a>
        <div class="nav-user">
            <span class="user-name">{{ Auth::guard('admin')->user()->nama }}</span>
            <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-link logout" style="background: none; border: none; cursor: pointer;">Logout</button>
            </form>
        </div>
    </div>
</nav>

