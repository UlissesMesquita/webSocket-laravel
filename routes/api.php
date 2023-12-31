<?php

use App\Http\Controllers\ZoomAuthController;
use App\Http\Controllers\ZoomWebSocketController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/zoom/token')->group(function () {
    
    Route::get('/accessToken', [ZoomAuthController::class, 'createAccessToken']);

});

Route::post('/websocket', [ZoomWebSocketController::class, 'authWebsocketConfig']);

