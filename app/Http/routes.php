<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/post/{id}', ['as' => 'home.post', 'uses' => 'AdminPostsController@post']);

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::resource('users', 'AdminUsersController');

    Route::resource('posts', 'AdminPostsController');

    Route::resource('categories', 'AdminCatController');

    Route::resource('media', 'AdminMediasController');

//    Route::get('media/upload', ['as'=>'admin.media.upload', 'uses'=>'AdminMediasController@store']);  no need to change the URI to Upload, default create URI is good enough

    Route::resource('comments', 'PostCommentsController');

    Route::resource('comments/replies', 'CommentRepliesController');

    Route::get('/', 'HomeController@admin');
});


Route::group(['middleware' => 'auth'], function () {

    Route::post('comment/{comment_id}/reply', 'CommentRepliesController@createReply');

});