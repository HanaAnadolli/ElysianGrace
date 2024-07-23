<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\BookingController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('rooms', [RoomController::class, 'index']);
Route::get('/room_details/{id}', [RoomController::class, 'show']);
Route::get('/random-room', [RoomController::class, 'getRandomRooms']);
Route::get('services', [ServiceController::class, 'index']);
Route::post('contact_forms', [ContactController::class, 'store']);
Route::post('/book_room', [BookingController::class, 'store']);
