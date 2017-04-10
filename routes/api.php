<?php

use v1\AccountController;
use v1\PostController;
use v1\ComentController;
use v1\ConversationController;
use v1\MessageController;
use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/v1/Messages', MessageController::class);
Route::resource('/v1/Accounts', AccountController::class);
Route::resource('/v1/Posts', PostController::class);
Route::resource('/v1/Comments', ComentController::class);
Route::resource('/v1/Conversations', ConversationController::class);
