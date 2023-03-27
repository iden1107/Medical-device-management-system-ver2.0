<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SettingController;
use App\Models\Setting;

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
    $user = Auth::user();
    if ($user == null){
        return Inertia::render('Welcome');
    }else{
        return redirect()->to('/floormap');
    };
});
// 全員
Route::group(['middleware' => ['auth', 'can:all']], function () {
    Route::get('/floormap', [DeviceController::class, 'showFloormap'])->name('floormap');
    Route::get('/inventory', [DeviceController::class, 'showInventory'])->name('inventory');
    Route::get('/device_detail/{device}',[DeviceController::class, 'showDeviceDetail'])->name('deviceDetail')->where('id', '[0-9]+');
    Route::patch('/device/{device}/update',[DeviceController::class, 'updateDevice'])->name('updateDevice')->where('id', '[0-9]+');
    Route::patch('/device/update_location',[DeviceController::class, 'updateLocation'])->name('updateLocation');
    Route::get('/device_list', [DeviceController::class, 'showDeviceList'] )->name('deviceList');
});
// 管理者のみ
Route::group(['middleware' => ['auth', 'can:admin']], function () {
    Route::get('/setting', [SettingController::class, 'showSetting'])->name('setting');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
