<!-- resources/views/layouts/partials/user-navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-calendar-alt"></i> Room Booking
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="userNavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rooms.index') }}">
                        <i class="fas fa-door-open"></i> Rooms
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bookings.index') }}">
                        <i class="fas fa-calendar-check"></i> My Bookings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bookings.create') }}">
                        <i class="fas fa-plus-circle"></i> New Booking
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-item-text">
                            <small class="text-muted">Role: {{ Auth::user()->role }}</small>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>