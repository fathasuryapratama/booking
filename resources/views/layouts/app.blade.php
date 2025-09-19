<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Room Booking System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body>
    @auth
        @if(Auth::user()->isAdmin())
            @include('layouts.partials.admin-sidebar')
        @else
            @include('layouts.partials.user-navbar')
        @endif
    @else
        @include('layouts.partials.guest-navbar')
    @endauth

    <main class="@auth @if(Auth::user()->isAdmin()) admin-main @else user-main @endif @endauth">
        <div class="@auth @if(Auth::user()->isAdmin()) admin-container @else container @endif @else container @endauth">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    document.querySelector('.admin-main').classList.toggle('sidebar-collapsed');
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>

<style>
.admin-main {
    margin-left: 250px;
    transition: margin-left 0.3s ease;
    min-height: 100vh;
    background: #f8f9fa;
    padding: 20px;
}

.admin-main.sidebar-collapsed {
    margin-left: 80px;
}

.admin-container {
    max-width: 100%;
    padding: 0 20px;
}

.user-main {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 20px 0;
}
</style>