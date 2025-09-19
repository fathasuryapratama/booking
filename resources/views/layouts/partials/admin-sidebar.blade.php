<!-- resources/views/layouts/partials/admin-sidebar.blade.php -->
<nav id="sidebar" class="admin-sidebar">
    <div class="sidebar-header">
        <h5 class="text-white">
            <i class="fas fa-crown"></i> Admin Panel
        </h5>
        <button id="sidebarToggle" class="btn btn-sm btn-outline-light">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <ul class="list-unstyled components">
        <li class="sidebar-item">
            <a href="{{ route('home') }}" class="sidebar-link">
                <i class="fas fa-home"></i>
                <span class="sidebar-text">Dashboard</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a href="{{ route('rooms.index') }}" class="sidebar-link">
                <i class="fas fa-door-open"></i>
                <span class="sidebar-text">Room Management</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="{{ route('bookings.index') }}" class="sidebar-link">
                <i class="fas fa-calendar-alt"></i>
                <span class="sidebar-text">Booking Management</span>
            </a>
        </li>

        <li class="sidebar-divider"></li>

        <li class="sidebar-item">
            <a href="{{ route('rooms.create') }}" class="sidebar-link">
                <i class="fas fa-plus-circle"></i>
                <span class="sidebar-text">Add New Room</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="user-details">
                <span class="user-name">{{ Auth::user()->name }}</span>
                <span class="user-role">Administrator</span>
            </div>
        </div>
        
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm w-100">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</nav>

<style>
.admin-sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: white;
    transition: all 0.3s ease;
    z-index: 1000;
}

.admin-sidebar.collapsed {
    width: 80px;
}

.sidebar-header {
    padding: 20px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.sidebar-item {
    border-bottom: 1px solid rgba(255,255,255,0.05);
}

.sidebar-link {
    padding: 15px 20px;
    color: #b8c2cc;
    text-decoration: none;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
}

.sidebar-link:hover {
    background: rgba(255,255,255,0.1);
    color: white;
}

.sidebar-link.active {
    background: rgba(52, 152, 219, 0.2);
    color: white;
    border-left: 4px solid #3498db;
}

.sidebar-text {
    margin-left: 15px;
    transition: opacity 0.3s ease;
}

.admin-sidebar.collapsed .sidebar-text {
    opacity: 0;
    visibility: hidden;
}

.sidebar-divider {
    height: 1px;
    background: rgba(255,255,255,0.1);
    margin: 10px 0;
}

.sidebar-footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    padding: 20px;
    background: rgba(0,0,0,0.2);
}

.user-info {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.user-avatar {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
}

.user-details {
    flex: 1;
}

.user-name {
    display: block;
    font-weight: 600;
    font-size: 0.9rem;
}

.user-role {
    font-size: 0.8rem;
    opacity: 0.8;
}

.logout-form {
    margin-top: 10px;
}
</style>