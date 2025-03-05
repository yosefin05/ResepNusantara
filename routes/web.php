<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResepController;
use App\Models\Resep;

Route::get('/', function () {
    $reseps = Resep::latest()->limit(6)->get(); // Ambil 6 resep terbaru
    return view('welcome', compact('reseps')); // Ganti ke 'welcome'
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::get('/dashboard', [ResepController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/reseps/create', [ResepController::class, 'create'])->middleware(['auth'])->name('reseps.create');
Route::post('/reseps', [ResepController::class, 'store'])->middleware(['auth'])->name('reseps.store');
Route::get('/resep/{id}', [ResepController::class, 'show'])->name('resep.show');
