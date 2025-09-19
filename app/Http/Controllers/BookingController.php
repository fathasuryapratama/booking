<?php
// app/Http/Controllers/BookingController.php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            $bookings = Booking::with(['user', 'room'])->get();
        } else {
            $bookings = Booking::with(['user', 'room'])
                ->where('user_id', Auth::id())
                ->get();
        }

        // Ubah ini: dari 'user.bookings.index' menjadi 'bookings.index'
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::where('status', true)->get();
        return view('bookings.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'purpose' => 'required|string|max:255',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        $room = Room::findOrFail($request->room_id);

        // Check room availability
        if (!$room->isAvailable($request->start_time, $request->end_time)) {
            return back()->withInput()
                ->with('error', 'The room is not available at the selected time.');
        }

        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'purpose' => $request->purpose,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking created successfully. Waiting for admin approval.');
    }

    public function show(Booking $booking)
    {
        // Authorization: only admin or booking owner can view
        if (!Auth::user()->isAdmin() && $booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $booking->update(['status' => $request->status]);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking status updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        // Authorization: only admin or booking owner can delete
        if (!Auth::user()->isAdmin() && $booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }
}