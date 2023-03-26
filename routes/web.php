<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DeviceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::user() == null){
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
        return Inertia::render('login');
    }else{
        return redirect()->to('/floormap');
    };
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/floormap', [DeviceController::class, 'showFloormap'])->name('floormap');
    Route::get('/inventory', [DeviceController::class, 'showInventory'])->name('inventory');
    Route::get('/device_detail/{device}',[DeviceController::class, 'showDeviceDetail'])->name('deviceDetail')->where('id', '[0-9]+');
    Route::patch('/device/{device}/update',[DeviceController::class, 'update'])->name('deviceUpdate')->where('id', '[0-9]+');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
