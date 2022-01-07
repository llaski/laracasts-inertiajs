<?php

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Auth\LoginController;


Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function() {

    Route::get('/', function () {
        return Inertia::render('Home');
    });

    Route::get('/users', function () {
        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->when(Request::input('search'), function($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'can' => [
                        'edit' => Auth::user()->can('edit', $user)
                    ]
                ]),
            'filters' => Request::only('search'),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class)
            ]
        ]);
    });


    Route::get('/users/create', function() {
        return Inertia::render('Users/Create');
    })->can('create', User::class);

    Route::post('/users', function() {
        $attributes = Request::validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:3'],
        ]);

        User::create([
            ...$attributes,
            'very_secret_token' => 1,
        ]);

        return redirect('/users');
    });

    Route::get('/settings', function () {
        return Inertia::render('Settings');
    });

});