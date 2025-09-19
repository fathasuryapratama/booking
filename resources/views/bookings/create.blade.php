<!-- resources/views/bookings/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-plus"></i> Create New Booking
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="room_id" class="form-label">Select Room *</label>
                                <select class="form-select @error('room_id') is-invalid @enderror" 
                                        id="room_id" name="room_id" required>
                                    <option value="">Choose a room...</option>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}" 
                                                {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                            {{ $room->name }} (Capacity: {{ $room->capacity }} people)
                                        </option>
                                    @endforeach
                                </select>
                                @error('room_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="purpose" class="form-label">Purpose *</label>
                                <input type="text" class="form-control @error('purpose') is-invalid @enderror" 
                                       id="purpose" name="purpose" value="{{ old('purpose') }}" 
                                       required placeholder="Meeting, Training, Presentation, etc.">
                                @error('purpose')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="start_time" class="form-label">Start Time *</label>
                                <input type="datetime-local" class="form-control @error('start_time') is-invalid @enderror" 
                                       id="start_time" name="start_time" value="{{ old('start_time') }}" 
                                       required min="{{ now()->format('Y-m-d\TH:i') }}">
                                @error('start_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="end_time" class="form-label">End Time *</label>
                                <input type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" 
                                       id="end_time" name="end_time" value="{{ old('end_time') }}" 
                                       required>
                                @error('end_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            Please make sure to check room availability before booking. 
                            Bookings are subject to admin approval.
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Booking
                            </button>
                            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');
    
    // Set minimum end time based on start time
    startTimeInput.addEventListener('change', function() {
        const startTime = new Date(this.value);
        const minEndTime = new Date(startTime.getTime() + 30 * 60000); // 30 minutes later
        
        endTimeInput.min = minEndTime.toISOString().slice(0, 16);
        
        // If current end time is before new minimum, clear it
        if (endTimeInput.value && new Date(endTimeInput.value) < minEndTime) {
            endTimeInput.value = '';
        }
    });

    // Set default start time to next hour
    const now = new Date();
    now.setHours(now.getHours() + 1);
    now.setMinutes(0);
    now.setSeconds(0);
    
    if (!startTimeInput.value) {
        startTimeInput.value = now.toISOString().slice(0, 16);
    }

    // Set default end time to 1 hour after start time
    if (!endTimeInput.value && startTimeInput.value) {
        const startTime = new Date(startTimeInput.value);
        const defaultEndTime = new Date(startTime.getTime() + 60 * 60000); // 1 hour later
        endTimeInput.value = defaultEndTime.toISOString().slice(0, 16);
    }
});
</script>

<style>
.card {
    border: none;
    border-radius: 15px;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
}

.form-label {
    font-weight: 500;
    color: #2c3e50;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    padding: 10px 20px;
}

.alert {
    border-radius: 10px;
}

.invalid-feedback {
    display: block;
}
</style>
@endsection