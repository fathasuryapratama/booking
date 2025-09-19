<!-- resources/views/rooms/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-edit"></i> Edit Room: {{ $room->name }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('rooms.update', $room) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">Room Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $room->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="capacity" class="form-label">Capacity *</label>
                                <input type="number" class="form-control @error('capacity') is-invalid @enderror" 
                                       id="capacity" name="capacity" value="{{ old('capacity', $room->capacity) }}" 
                                       min="1" required>
                                @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" name="status">
                                    <option value="1" {{ old('status', $room->status) ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ !old('status', $room->status) ? 'selected' : '' }}>Unavailable</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="4">{{ old('description', $room->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Update Room
                            </button>
                            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <a href="{{ route('rooms.show', $room) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                        </div>
                    </form>
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

.form-label {
    font-weight: 500;
    color: #2c3e50;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}
</style>
@endsection