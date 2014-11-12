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

Route::match(array('GET', 'POST'), '/login', array('as' => 'login', 'uses' => 'UserController@login'));
Route::match(array('GET', 'POST'), '/logout', array('as' => 'logout', 'uses' => 'UserController@logout'));
Route::match(array('GET', 'POST'), '/f/{oneloginkey}', array('as' => 'fresh_password', 'uses' => 'UserController@fresh_password'));
Route::match(array('GET', 'POST'), '/forget_password', array('as' => 'forget_password', 'uses' => 'UserController@forget_password'));

Route::get('/lang/{locale?}', [
	'as'=>'lang',
	'uses'=>'HomeController@changeLang'
]);

Route::group( array( 'before' => 'auth' ), function () {
	Route::get('/', array('as' => 'root', 'uses' => 'DashBoardController@show'));
	Route::get('admin', array('as' => 'admin', 'uses' => 'AdminController@index'));
	Route::get('admin/users', array('as' => 'users_all', 'uses' => 'UsersController@all'));
	Route::match(array('GET', 'POST'), 'admin/users/create', array('as' => 'users_create', 'uses' => 'UsersController@create'));
	Route::get('admin/users/show/{email}', array('as' => 'users_show', 'uses' => 'UsersController@show'));
	Route::match(array('GET', 'POST'), 'admin/users/edit/{email}', array('as' => 'users_edit', 'uses' => 'UsersController@edit'));
	Route::delete('admin/users/delete/{email}', array('as' => 'users_delete', 'uses' => 'UsersController@delete'));
} );
