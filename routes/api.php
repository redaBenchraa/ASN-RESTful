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
//Grp
Route::post('/v1/Groups/{id}/addAdmin',['uses'=>'v1\\GrpController@addAdmin']);
Route::post('/v1/Groups/{id}/removeAdmin',['uses'=>'v1\\GrpController@removeAdmin']);
Route::post('/v1/Groups/{id}/addMember',['uses'=>'v1\\GrpController@addMember']);
Route::post('/v1/Groups/{id}/updateMember',['uses'=>'v1\\GrpController@updateMember']);
Route::post('/v1/Groups/{id}/removeMember',['uses'=>'v1\\GrpController@removeMember']);
//Account
Route::post('/v1/Accounts/{id}/addConversation',['uses'=>'v1\\AccountController@addConversation']);
Route::post('/v1/Accounts/{id}/removeConversation',['uses'=>'v1\\AccountController@removeConversation']);
Route::post('/v1/Accounts/{id}/addPollVote',['uses'=>'v1\\AccountController@addPollVote']);
Route::post('/v1/Accounts/{id}/removePollVote',['uses'=>'v1\\AccountController@removePollVote']);
Route::post('/v1/Accounts/{id}/addReactInComment',['uses'=>'v1\\AccountController@addReactInComment']);
Route::post('/v1/Accounts/{id}/removeReactInComment',['uses'=>'v1\\AccountController@removeReactInComment']);
Route::post('/v1/Accounts/{id}/addReactInPost',['uses'=>'v1\\AccountController@addReactInPost']);
Route::post('/v1/Accounts/{id}/removeReactInPost',['uses'=>'v1\\AccountController@removeReactInPost']);
Route::post('/v1/Accounts/{id}/becomeAdmin',['uses'=>'v1\\AccountController@becomeAdmin']);
Route::post('/v1/Accounts/{id}/removeAdmin',['uses'=>'v1\\AccountController@removeAdmin']);
Route::post('/v1/Accounts/{id}/becomeMember',['uses'=>'v1\\AccountController@becomeMember']);
Route::post('/v1/Accounts/{id}/removeMember',['uses'=>'v1\\AccountController@removeMember']);
//Comment
Route::post('/v1/Comments/{id}/reactedToBy',['uses'=>'v1\\ComentController@reactedToBy']);
Route::post('/v1/Comments/{id}/removeReact',['uses'=>'v1\\ComentController@removeReact']);
//Conversation
Route::post('/v1/Conversations/{id}/addAccount',['uses'=>'v1\\ConversationController@addAccount']);
Route::post('/v1/Conversations/{id}/removeAccount',['uses'=>'v1\\ConversationController@removeAccount']);
//Poll
Route::post('/v1/Polls/{id}/addVoter',['uses'=>'v1\\PollController@addVoter']);
Route::post('/v1/Polls/{id}/removeVoter',['uses'=>'v1\\PollController@removeVoter']);
//Post
Route::post('/v1/Posts/{id}/addReactingAccount',['uses'=>'v1\\PostController@addReactingAccount']);
Route::post('/v1/Posts/{id}/removeReactingAccount',['uses'=>'v1\\PostController@removeReactingAccount']);






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
