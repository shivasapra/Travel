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

Route::get('/wage',[
		'uses' => 'wageController@index',
		'as' => 'wage'
	]);
Route::get('/employee/wage/log/{id}',[
		'uses' => 'wageController@show',
		'as' => 'wage.log'
	]);

Route::get('/generate/slip',[
		'uses' => 'wageController@generateSlip',
		'as' => 'slip.generate'
	]);
Route::post('/slip',[
		'uses' => 'wageController@slip',
		'as' => 'slip'
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
	'uses'=>'HomeController@products',
	'as'=>'products'
	]);
Route::post('/add/product',[
	'uses'=>'HomeController@addProduct',
	'as'=>'product.add'
	]);
Route::get('/delete/product/{id}',[
	'uses'=>'HomeController@destroyProduct',
	'as'=>'product.delete'
	]);
Route::get('/airlines',[
	'uses'=>'HomeController@airlines',
	'as'=>'airlines'
	]);
Route::post('/add/airline',[
	'uses'=>'HomeController@addAirline',
	'as'=>'airline.add'
	]);
Route::get('/delete/airline/{id}',[
	'uses'=>'HomeController@destroyAirline',
	'as'=>'airline.delete'
	]);
Route::get('/expense',[
	'uses'=>'expensesController@index',
	'as'=>'expenses.get'
	]);
Route::post('/expenses',[
	'uses'=>'expensesController@index',
	'as'=>'expenses'
	]);
Route::get('/Auto/deduction',[
	'uses'=>'expensesController@auto',
	'as'=>'auto.get'
	]);
Route::post('/auto/deduction',[
	'uses'=>'expensesController@auto',
	'as'=>'auto',
	]);
Route::get('/expense/delete/{id}',[
	'uses'=>'expensesController@destroy',
	'as'=>'expense.delete'
	]);

Route::get('/create/invoice',[
	'uses'=>'InvoiceController@create',
	'as'=>'invoice.create'
	]);
Route::post('/store/invoice',[
	'uses'=>'InvoiceController@store',
	'as'=>'invoice.store'
	]);
