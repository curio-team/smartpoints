<?php

use App\Http\Controllers\ImportExportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::view('/', 'welcome')->name('home');
});

Route::controller(\App\Http\Controllers\ApiTokenController::class)->group(function(){
    //Route::get('token', 'update');
});



// AMOCLIENT ROUTES
Route::get('/login', function(){
	return redirect('/amoclient/redirect');
})->name('login');
Route::get('/amoclient/ready', function(){
	return redirect()->route('home');
});
