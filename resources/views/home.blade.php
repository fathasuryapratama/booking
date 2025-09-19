<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="jumbotron bg-light p-5 rounded">
            <h1 class="display-4">Room Booking System</h1>
            <p class="lead">A system for booking rooms easily and efficiently.</p>
            <hr class="my-4">
            <p>Check room availability and make bookings according to your needs.</p>
            <a class="btn btn-primary btn-lg" href="{{ route('rooms.index') }}" role="button">View Rooms</a>
            @auth
                <a class="btn btn-success btn-lg" href="{{ route('bookings.create') }}" role="button">Create New Booking</a>
            @endauth
        </div>
    </div>
</div>

@if(isset($rooms) && $rooms->count() > 0)
<div class="row mt-4">
    <div class="col-md-12">
        <h2>Available Rooms</h2>
        <div class="row">
            @foreach($rooms as $room)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $room->name }}</h5>
                        <p class="card-text">{{ Str::limit($room->description, 100) }}</p>
                        <p class="card-text"><strong>Capacity:</strong> {{ $room->capacity }} people</p>
                        <a href="{{ route('rooms.show', $room) }}" class="btn btn-primary">Details</a>
                        @auth
                            <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" class="btn btn-success">Book Now</a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection