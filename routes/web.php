<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=> 'auth'],function(){
    Route::get('profile/{slug}','profileController@show');
    Route::resource('posts', 'PostController');
    Route::post('profile/{id}','profileController@Update');
    Route::post('like','LikeController@Store');
    Route::post('/comment','CommentController@Store');
    Route::post('/friendrq','FriendRequestController@Store');
    Route::delete('/delfriendrq','FriendRequestController@destroy');
    Route::post('/confirmRq','FriendRequestController@confirm');
    Route::post('/deleteRq','FriendRequestController@remove');
    Route::post('/deletefr','FriendsController@removefr');
    Route::post('/deletecom','CommentController@delcom');
    
});
