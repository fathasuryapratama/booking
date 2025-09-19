<!-- resources/views/layouts/admin.blade.php -->
@extends('layouts.app')

@section('content')
<div class="admin-content-header">
    <h1 class="admin-title">@yield('page-title', 'Admin Dashboard')</h1>
    <div class="admin-breadcrumb">
        @yield('breadcrumb')
    </div>
</div>

<div class="admin-content">
    @yield('admin-content')
</div>
@endsection

@push('styles')
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
    justify-content: between;
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

.admin-main {
    margin-left: 250px;
    transition: margin-left 0.3s ease;
    min-height: 100vh;
    background: #f8f9fa;
}

.admin-main.sidebar-collapsed {
    margin-left: 80px;
}

.admin-content-header {
    background: white;
    padding: 20px;
    margin: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.admin-title {
    color: #2c3e50;
    font-weight: 600;
    margin: 0;
}

.admin-content {
    padding: 0 20px 20px 20px;
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
@endpush