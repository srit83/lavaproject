<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * außer login, überall loginpflicht
 */

Route::match(array('GET', 'POST'), '/login', array('uses' => 'UserController@login'));
Route::match(array('GET', 'POST'), '/logout', array('uses' => 'UserController@logout'));

Route::group( array( 'before' => 'auth' ), function () {
	Route::get('/', array('uses' => 'DashBoardController@show'));
	Route::get('admin', array('uses' => 'AdminController@index'));
	Route::get('admin/users', array('uses' => 'UsersController@all'));
	Route::match(array('GET', 'POST'), 'admin/users/create', array('uses' => 'UsersController@create'));
} );
