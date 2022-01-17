<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\PayerController;
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

// Public
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/flights', [FlightController::class, 'index']);
Route::get('/flights/{IdChuyenBay}', [FlightController::class, 'show']);
Route::post('/flights/search', [FlightController::class, 'search']);

Route::get('/tickets', [TicketController::class, 'index']);
Route::get('/tickets/{IdVeMayBay}', [TicketController::class, 'show']);
Route::post('/tickets/search', [TicketController::class, 'search']);

Route::get('/passengers', [PassengerController::class, 'index']);
Route::get('/passengers/{IdHanhKhach}', [PassengerController::class, 'show']);
Route::post('/passengers/search', [PassengerController::class, 'search']);

Route::get('/users', [AuthController::class, 'index']);
Route::get('/users/{IdTaiKhoan}', [AuthController::class, 'show']);
Route::post('/users/search', [AuthController::class, 'search']);

Route::get('/invoices', [InvoiceController::class, 'index']);
Route::get('/invoices/{IdHoaDon}', [InvoiceController::class, 'show']);
Route::post('/invoices/search', [InvoiceController::class, 'search']);

Route::get('/invoice-details', [InvoiceDetailController::class, 'index']);
Route::get('/invoice-details/{IdChiTietHoaDon}', [InvoiceDetailController::class, 'show']);
Route::post('/invoice-details/search', [InvoiceDetailController::class, 'search']);

Route::get('/contact-infos', [ContactInfoController::class, 'index']);
Route::get('/contact-infos/{IdNguoiLienHe}', [ContactInfoController::class, 'show']);
Route::post('/contact-infos/search', [ContactInfoController::class, 'search']);

Route::get('/payers', [PayerController::class, 'index']);
Route::get('/payers/{IdNguoiThanhToan}', [PayerController::class, 'show']);
Route::post('/payers/search', [PayerController::class, 'search']);

Route::post('/passengers', [PassengerController::class, 'store']);
Route::post('/invoices', [InvoiceController::class, 'store']);
Route::post('/invoice-details', [InvoiceDetailController::class, 'store']);
Route::post('/contact-infos', [ContactInfoController::class, 'store']);
Route::post('/payers', [PayerController::class, 'store']);

Route::put('/tickets/{IdVeMayBay}', [TicketController::class, 'update']);
Route::put('/flights/{IdChuyenBay}', [FlightController::class, 'update']);

// Protected
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/flights', [FlightController::class, 'store']);
    Route::delete('/flights/{IdChuyenBay}', [FlightController::class, 'destroy']);

    Route::post('/tickets', [TicketController::class, 'store']);
    Route::delete('/tickets/{IdVeMayBay}', [TicketController::class, 'destroy']);
    
    Route::put('/passengers/{IdHanhKhach}', [PassengerController::class, 'update']);
    Route::delete('/passengers/{IdHanhKhach}', [PassengerController::class, 'destroy']);

    Route::put('/users/{IdTaiKhoan}', [AuthController::class, 'update']);
    Route::delete('/users/{IdTaiKhoan}', [AuthController::class, 'destroy']);

    Route::put('/invoices/{IdHoaDon}', [InvoiceController::class, 'update']);
    Route::delete('/invoices/{IdHoaDon}', [InvoiceController::class, 'destroy']);

    Route::put('/invoice-details/{IdChiTietHoaDon}', [InvoiceDetailController::class, 'update']);
    Route::delete('/invoice-details/{IdChiTietHoaDon}', [InvoiceDetailController::class, 'destroy']);

    Route::put('/contact-infos/{IdNguoiLienHe}', [ContactInfoController::class, 'update']);
    Route::delete('/contact-infos/{IdNguoiLienHe}', [ContactInfoController::class, 'destroy']);

    Route::put('/payers/{IdNguoiThanhToan}', [PayerController::class, 'update']);
    Route::delete('/payers/{IdNguoiThanhToan}', [PayerController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
