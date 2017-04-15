<?php

use v1\AccountController;
use v1\GrpController;
use v1\PostController;
use v1\ComentController;
use v1\ConversationController;
use v1\MessageController;
use v1\PollController;
use v1\MessageNotificationController;
use v1\NotificationController;
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

//Routs for managing the pivot tables
Route::post('/v1/Groups/{id}/addAdmin',['uses'=>'v1\\GrpController@addAdmin']);
Route::post('/v1/Groups/{id}/removeAdmin',['uses'=>'v1\\GrpController@removeAdmin']);
Route::post('/v1/Groups/{id}/addMember',['uses'=>'v1\\GrpController@addMember']);
Route::post('/v1/Groups/{id}/removeMember',['uses'=>'v1\\GrpController@removeMember']);



Route::resource('/v1/Accounts', AccountController::class);
Route::resource('/v1/Groups', GrpController::class);
Route::resource('/v1/Messages', MessageController::class);
Route::resource('/v1/Posts', PostController::class);
Route::resource('/v1/Comments', ComentController::class);
Route::resource('/v1/Conversations', ConversationController::class);
Route::resource('/v1/Messages', MessageController::class);
Route::resource('/v1/Polls', PollController::class);
Route::resource('/v1/MessageNotifications', MessageNotificationController::class);
Route::resource('/v1/Notifications', NotificationController::class);
