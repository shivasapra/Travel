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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/employees',[
		'uses' => 'employeeController@index',
		'as' => 'employees'
	]);
Route::get('/employee/registration',[
		'uses' => 'employeeController@create',
		'as' => 'create.employee'
	]);
Route::post('/employee/store',[
		'uses' => 'employeeController@store',
		'as' => 'store.employee'
	]);
Route::post('/employee/update/{id}',[
		'uses' => 'employeeController@update',
		'as' => 'update.employee'
	]);
Route::get('/employee/edit/{id}',[
		'uses' => 'employeeController@edit',
		'as' => 'edit.employee'
	]);
Route::get('/employee/view/{id}',[
		'uses' => 'employeeController@show',
		'as' => 'view.employee'
	]);
Route::get('/employee/delete/{id}',[
		'uses' => 'employeeController@destroy',
		'as' => 'delete.employee'
	]);