<!-- resources/views/layouts/partials/guest-navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-calendar-alt"></i> Room Booking System
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>