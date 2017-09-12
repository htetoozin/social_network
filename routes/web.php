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

/*
* Authnetication 
*/

Route::group(['middleware' => 'guest'], function(){
	Route::get('/signup', 'AuthController@getSignUp')->name('auth.signup');
	Route::post('/signup', 'AuthController@postSignUp');

	Route::get('/signin', 'AuthController@getSignIn')->name('auth.signin');
	Route::post('/signin', 'AuthController@postSignIn');

});

Route::get('/signout', 'AuthController@getSignOut')->name('auth.signout');




/*
* Application Route
*/
Route::get('/', 'HomeController@index')->name('home');
Route::get('/search', 'SearchController@getResults')->name('search.results');

//Profile Route
Route::get('/user/{username}', 'ProfileController@getProfile')->name('profile.index');
Route::get('/profile/edit', 'ProfileController@getEdit')->name('profile.edit');
Route::post('/profile/edit', 'ProfileController@postEdit');


Route::get('/friends', 'FriendController@getIndex')->name('friend.index');

