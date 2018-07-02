<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index');

Route::get('/post/{id}', ['as' => 'home.post', 'uses' => 'AdminPostsController@post']);

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::resource('users', 'AdminUsersController', ['names' => [

        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
    ]]);

    Route::resource('posts', 'AdminPostsController', ['names' => [

        'index' => 'admin.posts.index',
        'create' => 'admin.posts.create',
        'store' => 'admin.posts.store',
        'edit' => 'admin.posts.edit',
    ]]);

    Route::resource('categories', 'AdminCatController', ['names' => [

        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
    ]]);
    Route::resource('media', 'AdminMediasController', ['names' => [

        'index' => 'admin.media.index',
        'create' => 'admin.media.create',
        'store' => 'admin.media.store',
        'edit' => 'admin.media.edit',
    ]]);

//    Route::get('media/upload', ['as'=>'admin.media.upload', 'uses'=>'AdminMediasController@store']);  no need to change the URI to Upload, default create URI is good enough

    Route::resource('comments', 'PostCommentsController', ['names' => [

        'index' => 'admin.comments.index',
        'create' => 'admin.comments.create',
        'store' => 'admin.comments.store',
        'edit' => 'admin.comments.edit',
        'show' => 'admin.comments.show',
    ]]);
    Route::resource('comments/replies', 'CommentRepliesController', ['names' => [

        'index' => 'admin.replies.index',
        'create' => 'admin.replies.create',
        'store' => 'admin.replies.store',
        'edit' => 'admin.replies.edit',
        'show' => 'admin.comments.replies.show',
    ]]);

    Route::get('/', 'HomeController@admin');
});


Route::group(['middleware' => 'auth'], function () {

    Route::post('comment/{comment_id}/reply', 'CommentRepliesController@createReply');

});