<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PinController;
use App\Http\Controllers\PanelController;

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
    return redirect('login');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::name('pins.')->prefix('pins')->group(function(){
        Route::get('/', [PinController::class, 'index'])->name('index');
        Route::post('/create', [PinController::class, 'create'])->name('create');
        Route::post('/store', [PinController::class, 'store'])->name('create');
        Route::post('/destroy', [PinController::class, 'destroy'])->name('destroy');
    });

    Route::name('panel.')->prefix('panel')->group(function(){
        Route::get('/', [PanelController::class, 'index'])->name('index');
        Route::post('/store', [PanelController::class, 'store'])->name('create');
        Route::post('/update', [PanelController::class, 'update'])->name('update');
        Route::post('/destroy', [PanelController::class, 'destroy'])->name('destroy');
    });

});
