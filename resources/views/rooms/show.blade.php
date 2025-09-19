<!-- resources/views/rooms/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-door-open"></i> Room Details
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="text-primary">{{ $room->name }}</h3>
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge {{ $room->status ? 'bg-success' : 'bg-danger' }} me-2">
                                    {{ $room->status ? 'Available' : 'Unavailable' }}
                                </span>
                                <span class="text-muted">
                                    <i class="fas fa-users"></i> Capacity: {{ $room->capacity }} people
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            @auth
                                <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" 
                                   class="btn btn-success mb-2">
                                    <i class="fas fa-calendar-plus"></i> Book This Room
                                </a>
                            @endauth
                        </div>
                    </div>

                    @if($room->description)
                    <div class="mb-4">
                        <h6 class="text-muted">Description</h6>
                        <p class="lead">{{ $room->description }}</p>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-muted">
                                        <i class="fas fa-info-circle"></i> Room Information
                                    </h6>
                                    <div class="mb-2">
                                        <strong>Status:</strong>
                                        <span class="badge {{ $room->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $room->status ? 'Available for booking' : 'Not available' }}
                                        </span>
                                    </div>
                                    <div class="mb-2">
                                        <strong>Capacity:</strong> {{ $room->capacity }} people
                                    </div>
                                    <div class="mb-2">
                                        <strong>Created:</strong> {{ $room->created_at->format('M d, Y') }}
                                    </div>
                                    <div>
                                        <strong>Last Updated:</strong> {{ $room->updated_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Rooms
                        </a>
                        
                        @auth
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('rooms.edit', $room) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Room
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 12px;
}

.card-header {
    border-radius: 12px 12px 0 0 !important;
}

.badge {
    font-size: 0.8rem;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.lead {
    color: #6c757d;
    line-height: 1.6;
}
</style>
@endsection