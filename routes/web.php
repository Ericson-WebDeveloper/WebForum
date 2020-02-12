<?php

use App\Thread;
use Illuminate\Support\Facades\Auth;
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
    $threads = Thread::paginate(15);
    return view('welcome', compact('threads'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/threads', 'ThreadController@index')->name('thread.index');
Route::get('/thread/create', 'ThreadController@create')->name('thread.create');
Route::post('/thread/store', 'ThreadController@store')->name('thread.store');
Route::get('/thread/show/{thread}', 'ThreadController@show')->name('thread.show');
Route::get('/thread/edit/{thread}', 'ThreadController@edit')->name('thread.edit');
Route::delete('/thread/destroy/{thread}', 'ThreadController@destroy')->name('thread.destroy');
Route::put('/thread/update/{thread}', 'ThreadController@update')->name('thread.update');


Route::resource('/thread/comment', 'CommentController', ['only' => ['edit', 'update', 'destroy' ]]);
Route::post('/thread/comment/{thread}', 'CommentController@AddComment')->name('thread.comment.add');
Route::post('/thread/reply/{comment}', 'CommentController@AddReply')->name('thread.reply.add');

Route::post('/thread/mark/solution', 'CommentController@marksolution')->name('mark.solution');
Route::post('/thread/like/comment', 'LikeController@likeit')->name('like.comment');

Route::get('/user/profile/{user}', 'UserProfileController@index')->name('user_profile')->middleware('auth');


Route::get('/markAsRead',function(){
    auth()->user()->unreadNotifications->markAsRead();
});