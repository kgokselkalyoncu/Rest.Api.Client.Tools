<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
    
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::post('/call-api', [App\Http\Controllers\HomeController::class, 'callApi'])->name('call-api')->middleware('auth');


// Route::middleware('auth:web')->group(function(){
//     Route::get('/user',function(){
//         return Auth::user();
//     });
// });

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
