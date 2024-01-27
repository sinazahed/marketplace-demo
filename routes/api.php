<?php

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
Route::fallback(function(){
    return response()->json([
        'message' => 'Route Not Found'], 404);
});



Route::post('/register',[\App\Http\Controllers\Api\v1\RegisterController::class,'create']);
Route::post('/login',[\App\Http\Controllers\Api\v1\AuthController::class,'auth'])->name('login');

Route::group(['prefix' => 'v1', 'middleware' => ['auth:sanctum']], function(){
    Route::post('/upload/media',[\App\Http\Controllers\Api\v1\UploadController::class,'upload']);
    Route::post('/product/create',[\App\Http\Controllers\Api\v1\ProductController::class,'create']);
    Route::get('/product/explore',[\App\Http\Controllers\Api\v1\ProductController::class,'explore']);
    Route::delete('/product/delete/{product}',[\App\Http\Controllers\Api\v1\ProductController::class,'destroy']);
    Route::post('/order/create',[\App\Http\Controllers\Api\v1\OrderController::class,'create']);
});


