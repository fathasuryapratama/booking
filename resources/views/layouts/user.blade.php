<!-- resources/views/layouts/user.blade.php -->
@extends('layouts.app')

@section('content')
<div class="user-container">
    <div class="user-header">
        <h2 class="user-title">@yield('page-title', 'Welcome, ' . Auth::user()->name)</h2>
        <div class="user-actions">
            @yield('user-actions')
        </div>
    </div>

    <div class="user-content">
        @yield('user-content')
    </div>
</div>
@endsection

@push('styles')
<style>
.user-main {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
}

.user-container {
    padding: 20px;
}

.user-header {
    background: white;
    padding: 20px;
    border-radius: 15px;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    display: flex;
    justify-content: between;
    align-items: center;
}

.user-title {
    color: #2c3e50;
    font-weight: 600;
    margin: 0;
}

.user-actions {
    display: flex;
    gap: 10px;
}

.user-content {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* Custom buttons for user layout */
.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 8px;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
    transform: translateY(-2px);
}

.btn-success {
    background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
    border: none;
    border-radius: 8px;
}

.btn-success:hover {
    background: linear-gradient(135deg, #4a9c23 0%, #95d4b8 100%);
}
</style>
@endpush