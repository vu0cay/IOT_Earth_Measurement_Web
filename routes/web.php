<?php

use App\Http\Controllers\FeatureController;
// use App\Http\Controllers\HandleFeatureController;
use App\Http\Controllers\Features\HandleFeatureController;
use App\Http\Controllers\Features\AmenityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SensorController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'role:admin'])->name('admin.index');

// Route::get('/sensors', function () {
//     return view('admin.sensors');
// })->middleware(['auth', 'verified'])->name('admin.sensors');
Route::get('/sensors', [SensorController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.sensors');
Route::get('/history_measurement', [SensorController::class, 'history'])->middleware(['auth', 'verified'])->name('admin.history_measurement');



Route::get('/features', [FeatureController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.sensors');
Route::post('/features/anchors', [FeatureController::class, 'addAnchor'])->middleware(['auth', 'verified'])->name('addAnchor');
Route::get('/handlefeature', [HandleFeatureController::class, 'index'])->middleware(['auth', 'verified'])->name('addAnchor');
Route::get('/getform/{theForm}',[HandleFeatureController::class, 'getFeatureForm']);
// ->middleware(['auth', 'role:admin']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
    
Route::get('/sensorids', [SensorController::class, 'getSensors']);
Route::get('/sensorids/{anchor_id}', [SensorController::class, 'getSensorID']);

require __DIR__ . '/auth.php';
