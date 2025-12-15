<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Login
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::post('/login', function () {
    try {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, request()->filled('remember'))) {
            request()->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
        
    } catch (\Illuminate\Session\TokenMismatchException $e) {
        // CSRF token expired - redirect to fresh login page
        return redirect()->route('login')->with('error', 'Your session has expired. Please try again.');
    }
})->middleware('guest')->name('login.post');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');

// Register (optional - can be disabled for admin-only CMS)
Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

Route::post('/register', function () {
    $validated = request()->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:8',
    ]);

    $validated['password'] = bcrypt($validated['password']);
    $validated['role_id'] = \App\Models\Role::where('slug', 'viewer')->first()->id;
    $validated['is_active'] = true;

    $user = \App\Models\User::create($validated);

    Auth::login($user);

    return redirect('/dashboard');
})->middleware('guest')->name('register.post');

