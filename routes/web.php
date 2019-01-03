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
Route::get('/log',[
		'uses' => 'wageController@log',
		'as' => 'log'
	]);
Route::post('/logs',[
		'uses' => 'wageController@logs',
		'as' => 'logs'
	]);
Route::post('/log/login/{id}',[
		'uses' => 'wageController@login',
		'as' => 'log.login'
	]);
Route::get('/log/logout/{id}',[
		'uses' => 'wageController@logout',
		'as' => 'log.logout'
	]);




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


Route::get('/clients',[
		'uses' => 'clientController@index',
		'as' => 'clients'
	]);
Route::get('/client/registration',[
		'uses' => 'clientController@create',
		'as' => 'create.client'
	]);
Route::post('/client/store',[
		'uses' => 'clientController@store',
		'as' => 'store.client'
	]);
Route::post('/client/update/{id}',[
		'uses' => 'clientController@update',
		'as' => 'update.client'
	]);
Route::get('/client/edit/{id}',[
		'uses' => 'clientController@edit',
		'as' => 'edit.client'
	]);
Route::get('/client/view/{id}',[
		'uses' => 'clientController@show',
		'as' => 'view.client'
	]);
Route::get('/client/delete/{id}',[
		'uses' => 'clientController@destroy',
		'as' => 'delete.client'
	]);

Route::get('/products',[
	'uses'=>'controller@products',
	'as'=>'products'
	]);
Route::post('/add/product',[
	'uses'=>'controller@addProduct',
	'as'=>'product.add'
	]);
Route::get('/delete/product/{id}',[
	'uses'=>'controller@destroyProduct',
	'as'=>'product.delete'
	]);
Route::get('/airlines',[
	'uses'=>'controller@airlines',
	'as'=>'airlines'
	]);
Route::post('/add/airline',[
	'uses'=>'controller@addAirline',
	'as'=>'airline.add'
	]);
Route::get('/delete/airline/{id}',[
	'uses'=>'controller@destroyAirline',
	'as'=>'airline.delete'
	]);