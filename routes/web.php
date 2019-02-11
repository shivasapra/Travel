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
// Route::post('invite', 'employeeController@process')->name('process');
// {token} is a required parameter that will be exposed to us in the controller method
Route::get('accept/{token}', 'InviteController@accept')->name('accept');
Route::get('confirm/{token}', 'InviteController@confirm')->name('confirm');
Route::get('deleteClientPassportData/{token}', 'InviteController@deleteClientPassportData')->name('deleteClientPassportData');

// Route::group(['middleware' => ['authorize', 'auth']], function () {
//     Route::get('/', [
//         'name' => 'home',
//         'as' => 'home',
//         'uses' => 'HomeController@index',
//     ]);
// });

// Route::group(['middleware' => ['auth']], function () {
//     Route::get('/authorize/{token}', [
//         'name' => 'Authorize Login',
//         'as' => 'authorize.device',
//         'uses' => 'Auth\AuthorizeController@verify',
//     ]);

//     Route::post('/authorize/resend', [
//         'name' => 'Authorize',
//         'as' => 'authorize.resend',
//         'uses' => 'Auth\AuthorizeController@resend',
//     ]);
// });


Route::get('/', [
        'name' => 'home',
        'as' => 'home',
        'uses' => 'HomeController@index',
    ]);
Auth::routes();
Route::resource('tasks', 'TasksController');
Route::get('/client/status',[
			'uses'=> 'clientController@status',
			'as'=>'clientStatus'
		]);
Route::get('/letter',[
			'uses'=> 'HomeController@letter',
			'as'=>'letter'
		]);
Route::post('/send/letter',[
			'uses'=> 'HomeController@sendLetter',
			'as'=>'sendLetter'
		]);
Route::get('/task/delete/{id}',[
			'uses'=> 'TasksController@destroy',
			'as'=>'task.destroy'
		]);
Route::get('/edit/profile',[
			'uses'=> 'UserController@index',
			'as'=>'edit.profile'
		]);
Route::get('/tax',[
			'uses'=> 'HomeController@tax',
			'as'=>'tax'
		]);
Route::post('/tax/update/',[
			'uses'=> 'HomeController@taxUpdate',
			'as'=>'tax.update'
		]);
Route::post('/update/profile',[
			'uses'=> 'UserController@update',
			'as'=>'update.profile'
		]);

Route::get('/paidInvoice/report',[
			'uses'=> 'ReportController@paidInvoice',
			'as'=>'paidInvoice.report'
		]);
Route::get('/unpaidInvoice/report',[
			'uses'=> 'ReportController@unpaidInvoice',
			'as'=>'unpaidInvoice.report'
		]);
Route::get('/expenses/report',[
			'uses'=> 'ReportController@expenses',
			'as'=>'expenses.report'
		]);
Route::get('/invoice/print',[
			'uses'=> 'InvoiceController@invoicePrint',
			'as'=>'invoice.print'
		]);
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
	])->middleware('admin');
Route::get('/employee/wage/log/{id}',[
		'uses' => 'wageController@show',
		'as' => 'wage.log'
	])->middleware('admin');

Route::get('/generate/slip',[
		'uses' => 'wageController@generateSlip',
		'as' => 'slip.generate'
	])->middleware('admin');
Route::post('/slip',[
		'uses' => 'wageController@slip',
		'as' => 'slip'
	])->middleware('admin');


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
Route::get('/employeeletter/{id}',[
		'uses' => 'employeeController@letter',
		'as' => 'letter.employee'
	]);
Route::get('/status',[
		'uses' => 'employeeController@status',
		'as' => 'status'
	]);
Route::post('/employee/status',[
		'uses' => 'employeeController@status2',
		'as' => 'status2'
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
	])->middleware('admin');
Route::post('/add/product',[
	'uses'=>'HomeController@addProduct',
	'as'=>'product.add'
	])->middleware('admin');
Route::get('/delete/product/{id}',[
	'uses'=>'HomeController@destroyProduct',
	'as'=>'product.delete'
	])->middleware('admin');
Route::get('/airlines',[
	'uses'=>'HomeController@airlines',
	'as'=>'airlines'
	])->middleware('admin');
Route::post('/add/airline',[
	'uses'=>'HomeController@addAirline',
	'as'=>'airline.add'
	])->middleware('admin');
Route::get('/delete/airline/{id}',[
	'uses'=>'HomeController@destroyAirline',
	'as'=>'airline.delete'
	])->middleware('admin');
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
Route::get('/invoice',[
	'uses'=>'InvoiceController@index',
	'as'=>'invoice'
	]);
Route::get('/invoice/view/{id}',[
	'uses'=>'InvoiceController@show',
	'as'=>'invoice.view'
	]);
Route::get('/invoice/print/{id}',[
			'uses'=> 'InvoiceController@invoicePrint',
			'as'=>'invoice.print'
		]);
Route::get('/create/invoice',[
	'uses'=>'InvoiceController@create',
	'as'=>'invoice.create'
	]);
Route::post('/store/invoice',[
	'uses'=>'InvoiceController@store',
	'as'=>'invoice.store'
	]);
Route::get('/delete/invoice/{id}',[
	'uses'=>'InvoiceController@destroy',
	'as'=>'invoice.delete'
	])->middleware('admin');
Route::get('/edit/invoice/{id}',[
	'uses'=>'InvoiceController@edit',
	'as'=>'invoice.edit'
	])->middleware('admin');
Route::post('/update/invoice/{id}',[
	'uses'=>'InvoiceController@update',
	'as'=>'invoice.update'
	])->middleware('admin');

Route::post('/add/todo',[
			'uses'=> 'HomeController@addTodo',
			'as'=>'add.todo'
		]);
Route::post('/update/todo/{id}',[
			'uses'=> 'HomeController@updateTodo',
			'as'=>'update.todo'
		]);
Route::get('/todos/{target_date}',[
			'uses'=> 'HomeController@todos',
			'as'=>'todos'
		]);
Route::post('/todos/',[
			'uses'=> 'HomeController@todosCustom',
			'as'=>'todos.custom'
		]);
Route::get('/pastWeekTodos',[
			'uses'=> 'HomeController@pastWeekTodos',
			'as'=>'pastWeekTodos'
		]);
Route::get('/pastMonthTodos',[
			'uses'=> 'HomeController@pastMonthTodos',
			'as'=>'pastMonthTodos'
		]);