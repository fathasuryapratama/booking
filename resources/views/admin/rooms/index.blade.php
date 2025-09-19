<!-- resources/views/rooms/index.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Room Management</h1>
        @auth
            @if(Auth::user()->isAdmin())
                <a href="{{ route('rooms.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Room
                </a>
            @endif
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($rooms->count() > 0)
    <div class="row">
        @foreach($rooms as $room)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title mb-0">{{ $room->name }}</h5>
                        <span class="badge {{ $room->status ? 'bg-success' : 'bg-danger' }}">
                            {{ $room->status ? 'Available' : 'Unavailable' }}
                        </span>
                    </div>
                    
                    <p class="card-text text-muted mb-2">
                        <i class="fas fa-users"></i> Capacity: {{ $room->capacity }} people
                    </p>
                    
                    @if($room->description)
                    <p class="card-text mb-3">{{ Str::limit($room->description, 100) }}</p>
                    @endif

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('rooms.show', $room) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye"></i> View
                        </a>
                        
                        @auth
                            <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" 
                               class="btn btn-success btn-sm">
                                <i class="fas fa-calendar-plus"></i> Book
                            </a>
                            
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('rooms.edit', $room) }}" class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" 
                                            onclick="return confirm('Are you sure you want to delete this room?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <small class="text-muted">
                        Last updated: {{ $room->updated_at->diffForHumans() }}
                    </small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <div class="py-5">
            <i class="fas fa-building fa-3x text-muted mb-3"></i>
            <h4>No rooms available</h4>
            <p class="text-muted">There are no rooms in the system yet.</p>
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('rooms.create') }}" class="btn btn-primary mt-2">
                        <i class="fas fa-plus"></i> Add First Room
                    </a>
                @endif
            @endauth
        </div>
    </div>
    @endif
</div>

<style>
.card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    border: none;
    border-radius: 12px;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
}

.card-title {
    font-weight: 600;
    color: #2c3e50;
}

.badge {
    font-size: 0.75rem;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.card-footer {
    border-top: 1px solid #f8f9fa;
}
</style>
@endsection