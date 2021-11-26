<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\api\HomeApiController;
use App\Http\Controllers\api\ProfileApiController;
use App\Http\Controllers\api\TransactionApiController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/home',[HomeApiController::class, 'index']);
    Route::put('/profile/update/{user}',[ProfileApiController::class, 'update']);
    Route::post('/payment/store',[TransactionApiController::class, 'store']);
    Route::get('/logout',[AuthController::class, 'logout']);
});
