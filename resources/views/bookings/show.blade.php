<!-- resources/views/bookings/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-alt"></i> Booking Details
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h4 class="text-primary">{{ $booking->purpose }}</h4>
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge 
                                    @if($booking->status == 'approved') bg-success
                                    @elseif($booking->status == 'rejected') bg-danger
                                    @else bg-warning @endif me-2">
                                    {{ ucfirst($booking->status) }}
                                </span>
                                <span class="text-muted">Booking ID: #{{ $booking->id }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            @if(Auth::user()->isAdmin() && $booking->status == 'pending')
                            <div class="btn-group">
                                <form action="{{ route('bookings.updateStatus', $booking) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                                <form action="{{ route('bookings.updateStatus', $booking) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-muted">
                                        <i class="fas fa-door-open"></i> Room Information
                                    </h6>
                                    <p class="mb-1"><strong>Room:</strong> {{ $booking->room->name }}</p>
                                    <p class="mb-1"><strong>Capacity:</strong> {{ $booking->room->capacity }} people</p>
                                    <p class="mb-0"><strong>Status:</strong> 
                                        <span class="badge {{ $booking->room->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $booking->room->status ? 'Available' : 'Unavailable' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-muted">
                                        <i class="fas fa-clock"></i> Time Information
                                    </h6>
                                    <p class="mb-1"><strong>Start:</strong> {{ $booking->start_time->format('M d, Y H:i') }}</p>
                                    <p class="mb-1"><strong>End:</strong> {{ $booking->end_time->format('M d, Y H:i') }}</p>
                                    <p class="mb-0"><strong>Duration:</strong> 
                                        {{ $booking->start_time->diffInHours($booking->end_time) }} hours
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(Auth::user()->isAdmin())
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-muted">
                                        <i class="fas fa-user"></i> User Information
                                    </h6>
                                    <p class="mb-1"><strong>Booked by:</strong> {{ $booking->user->name }}</p>
                                    <p class="mb-1"><strong>Email:</strong> {{ $booking->user->email }}</p>
                                    <p class="mb-0"><strong>Role:</strong> {{ ucfirst($booking->user->role) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Bookings
                        </a>
                        
                        @if(!Auth::user()->isAdmin() || $booking->user_id == Auth::id())
                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this booking?')">
                                <i class="fas fa-trash"></i> Delete Booking
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 15px;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
}

.bg-light {
    background-color: #f8f9fa !important;
}

.btn {
    border-radius: 8px;
}

.badge {
    font-size: 0.8rem;
    padding: 0.5em 0.75em;
}
</style>
@endsection