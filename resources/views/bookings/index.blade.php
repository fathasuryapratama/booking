<!-- resources/views/bookings/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">
            <i class="fas fa-calendar-check"></i> 
            @if(Auth::user()->isAdmin())
                Booking Management
            @else
                My Bookings
            @endif
        </h1>
        <a href="{{ route('bookings.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Booking
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($bookings->count() > 0)
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            @if(Auth::user()->isAdmin())
                            <th>User</th>
                            @endif
                            <th>Room</th>
                            <th>Purpose</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            @if(Auth::user()->isAdmin())
                            <td>
                                <strong>{{ $booking->user->name }}</strong>
                                <br>
                                <small class="text-muted">{{ $booking->user->email }}</small>
                            </td>
                            @endif
                            <td>
                                <strong>{{ $booking->room->name }}</strong>
                                <br>
                                <small class="text-muted">Capacity: {{ $booking->room->capacity }}</small>
                            </td>
                            <td>{{ $booking->purpose }}</td>
                            <td>
                                {{ $booking->start_time->format('M d, Y') }}
                                <br>
                                <small class="text-muted">{{ $booking->start_time->format('H:i') }}</small>
                            </td>
                            <td>
                                {{ $booking->end_time->format('M d, Y') }}
                                <br>
                                <small class="text-muted">{{ $booking->end_time->format('H:i') }}</small>
                            </td>
                            <td>
                                <span class="badge 
                                    @if($booking->status == 'approved') bg-success
                                    @elseif($booking->status == 'rejected') bg-danger
                                    @else bg-warning @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('bookings.show', $booking) }}" class="btn btn-info btn-sm" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    @if(Auth::user()->isAdmin() && $booking->status == 'pending')
                                    <form action="{{ route('bookings.updateStatus', $booking) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-success btn-sm" 
                                                onclick="return confirm('Approve this booking?')" title="Approve">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('bookings.updateStatus', $booking) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Reject this booking?')" title="Reject">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @endif
                                    
                                    @if(!Auth::user()->isAdmin() || $booking->user_id == Auth::id())
                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this booking?')" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-5">
        <div class="py-5">
            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
            <h4>No bookings found</h4>
            <p class="text-muted">
                @if(Auth::user()->isAdmin())
                    There are no bookings in the system yet.
                @else
                    You haven't made any bookings yet.
                @endif
            </p>
            <a href="{{ route('bookings.create') }}" class="btn btn-primary mt-2">
                <i class="fas fa-plus"></i> Create Your First Booking
            </a>
        </div>
    </div>
    @endif
</div>

<style>
.card {
    border: none;
    border-radius: 12px;
}

.table th {
    border-top: none;
    font-weight: 600;
}

.badge {
    font-size: 0.8rem;
    padding: 0.5em 0.75em;
}

.btn-group .btn {
    margin-right: 5px;
    border-radius: 6px;
}

.alert {
    border-radius: 10px;
}
</style>
@endsection