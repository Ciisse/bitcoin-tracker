<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CryptoControllerbuy;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/crypto', [CryptoControllerbuy::class, 'index']);
Route::post('/crypto', [CryptoControllerbuy::class, 'store']);

require __DIR__ . '/auth.php';

Route::get('/overview', function () {
    return view('overview');
});

Route::post('/overview', function(Request $request) {
    $token = Auth::user()->createToken($request->name_token ?? 'default');

    return redirect()->route('overview')
     ->with('success', 'Token generated: ' . $token->plainTextToken);
})->middleware('auth')->name('overview');