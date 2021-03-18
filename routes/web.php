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

Auth::routes();

Route::post('follow/{user}','FollowsController@store')->name('follow.store');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{username}', 'ProfilesController@user')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::get('/p/create', 'PostController@create')->name('post.create');

Route::get('/','PostController@index');

Route::post('/p/store', 'PostController@store')->name('post.store');
Route::get('/p/show/{post}', 'PostController@show')->name('post.show');
//patch is a method to update
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::get('/following/{user}', 'FollowsController@following');

Route::get('/follower/{user}', 'FollowsController@followers');
Route::get('/search/{user}', 'SearchController@getUser');

Route::get('/comment/{post}/{comment}', 'CommentController@comment');
Route::get('/like/{post}', 'LikeController@like');
Route::get('/getlike/{post}', 'LikeController@getlike');
Route::get('/getComments/{post}', 'CommentController@getComments');
Route::get('/likers/{post}', 'LikeController@getLiker');
Route::get('/update/{user}', 'FollowsController@index');

Route::get('/hey', 'ProfilesController@hey');

