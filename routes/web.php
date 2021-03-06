<?php

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
    return redirect()->route('posts.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home');

Route::resource('posts', 'PostController');

Route::resource('categories', 'CategoryController');

Route::post('/comments', 'CommentController@store')
    ->name('comments.store');

Route::get('/sessions', 'UserSessionController@index')
    ->name('sessions.index');
