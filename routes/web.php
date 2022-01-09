<?php

use App\Http\Controllers\ChatLiveController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('user', [ChatLiveController::class, 'user']);
    Route::get('ChatLive/rooms', [ChatLiveController::class, 'Rooms']);
    Route::get('ChatLive/room/{roomId}/message', [ChatLiveController::class, 'Messages']);
    Route::post('ChatLive/room/{roomId}/message', [ChatLiveController::class, 'NewMessages']);
});
