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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();


Route::group( [ 'middleware' => ['auth', 'admin' ], 'prefix' => 'dashboard'], function () {

    Route::resource( 'users', 'Dashboard\UserController' );


});


Route::group( [ 'middleware' => ['checkLink' ], 'prefix' => 'link'], function () {

    Route::get( '/{link}', 'UserPageController@index' )->name( 'user.home' );

    Route::get('/{link}/generate', 'UserPageController@generateLink')->name('user.generate');

    Route::get('/{link}/remove', 'UserPageController@removeLink')->name('user.remove');
});


Route::post('/calculated', 'UserPageController@calculatedResult')->name('calculated');

Route::post('/history', 'UserPageController@getHistory')->name('history');

