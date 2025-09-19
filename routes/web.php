// routes/web.php
<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $rooms = \App\Models\Room::where('status', true)->get();
    return view('home', compact('rooms'));
})->name('home');

// Auth Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        // Redirect berdasarkan role
        if (Auth::user()->isAdmin()) {
            return redirect()->route('rooms.index');
        }
        
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
})->name('login.post');

Route::post('/register', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'role' => 'user', // Default role
    ]);

    Auth::login($user);

    return redirect('/')->with('success', 'Registration successful!');
})->name('register.post');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Room Routes - admin only
    Route::resource('rooms', RoomController::class)->middleware('admin');
    
    // Booking Routes
    Route::resource('bookings', BookingController::class)->except(['edit', 'update']);
    Route::post('bookings/{booking}/status', [BookingController::class, 'updateStatus'])
        ->name('bookings.updateStatus')
        ->middleware('admin');
});