<?php

use App\Http\Controllers\PassengerController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['cors'])->group(function () {
    Route::get('/token', function (Request $request) {
        $token = $request->session()->token();
    
        // $token = csrf_token();
        return $token;
    });
});

// Public
// api authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// api chuyen bay 
Route::get('/flights', [FlightController::class, 'index']);
Route::get('/flights/{IdChuyenBay}', [FlightController::class, 'show']);
Route::post('/flights/search/', [FlightController::class, 'search']);

// api ve may bay
Route::get('/tickets', [TicketController::class, 'index']);
Route::get('/tickets/{IdVeMayBay}', [TicketController::class, 'show']);
Route::get('/tickets/search/{IdVeMayBay}', [TicketController::class, 'search']);

// api khach hang
Route::get('/passengers', [PassengerController::class, 'index']);
Route::get('/passengers/{IdHanhKhach}', [PassengerController::class, 'show']);
Route::post('/passengers/search/', [PassengerController::class, 'search']);

// api nguoi dung
Route::get('/users', [AuthController::class, 'index']);
Route::get('/users/{IdTaiKhoan}', [AuthController::class, 'show']);
Route::post('/users/search/', [AuthController::class, 'search']);

// Protected
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/flights', [FlightController::class, 'store']);
    Route::put('/flights/{IdChuyenBay}', [FlightController::class, 'update']);
    Route::delete('/flights/{IdChuyenBay}', [FlightController::class, 'destroy']);

    Route::post('/tickets', [TicketController::class, 'store']);
    Route::put('/tickets/{IdVeMayBay}', [TicketController::class, 'update']);
    Route::delete('/tickets/{IdVeMayBay}', [TicketController::class, 'destroy']);
    
    Route::post('/passengers', [PassengerController::class, 'store']);
    Route::put('/passengers/{IdHanhKhach}', [PassengerController::class, 'update']);
    Route::delete('/passengers/{IdHanhKhach}', [PassengerController::class, 'destroy']);

    Route::put('/users/{IdTaiKhoan}', [AuthController::class, 'update']);
    Route::delete('/users/{IdTaiKhoan}', [AuthController::class, 'destroy']);


    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
