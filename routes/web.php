<?php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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
Auth::routes();

Route::get('/', [
	'name' => 'home',
	'as' => 'home',
	'uses' => 'HomeController@index',
]);
Route::get('/edit/profile',[
	'uses'=> 'UserController@index',
	'as'=>'edit.profile'
]);
Route::post('/update/profile',[
	'uses'=> 'UserController@update',
	'as'=>'update.profile'
]);
Route::get('/Role-management', [
	'uses' => 'RolesController@index',
	'as' => 'role.management',
])->middleware('permission:Role Management');
Route::post('/create/role', [
	'uses' => 'RolesController@CreateRole',
	'as' => 'create.role',
])->middleware('permission:Role Management');
Route::get('/find/role/{id}', [
	'uses' => 'RolesController@findRole',
	'as' => 'find.role',
])->middleware('permission:Role Management');
Route::post('/assign/permissions/{id}', [
	'uses' => 'RolesController@assignPermissions',
	'as' => 'assign.permissions',
])->middleware('permission:Role Management');
Route::get('/user/roles/{id}', [
	'uses' => 'RolesController@userRole',
	'as' => 'user.roles',
])->middleware('permission:Role Management');
Route::post('/assign/roles/to/user/{id}', [
	'uses' => 'RolesController@assignUserRoles',
	'as' => 'assignuser.roles',
])->middleware('permission:Role Management');
// Route::get('/find/role/{id}', function ($id) {
// 	$role = Role::find($id);
// 	$pers = $role->getPermissionNames();
//     return [$role,$pers];
// });
Route::get('/find/family/{id}', function ($id) {
    $family = App\ClientFamily::find($id);
    return $family;
});


Route::get('/start/reminder/{id}', function ($id) {
	$client = App\client::find($id);
	$client->reminder = 1;
	$client->save();
    return redirect()->back();
})->middleware('permission:Client Notification Reminder Toggle');
Route::get('/stop/reminder/{id}', function ($id) {
	$client = App\client::find($id);
	$client->reminder = 0;
	$client->save();
    return redirect()->back();
})->middleware('permission:Client Notification Reminder Toggle');


Route::get('/users',[
	'uses' => 'HomeController@users',
	'as' => 'users'
])->middleware('permission:View Users');


Route::get('/direct/chat',[
	'uses' => 'ChatController@index',
	'as' => 'direct.chat'
])->middleware('permission:Direct Chat');
Route::post('/chat/store',[
	'uses' => 'ChatController@store',
	'as' => 'chat.store'
])->middleware('permission:Direct Chat');
Route::post('/chat/store/admin',[
	'uses' => 'ChatController@AdminMessageStore',
	'as' => 'admin.message.send'
])->middleware('permission:Direct Chat');
Route::get('homeWithMessage/{id}',[
	'uses'=>'HomeController@HomeWithMessage',
	'as'=>'home.message'
	])->middleware('permission:Direct Chat');
Route::get('indexWithMessage/{id}',[
	'uses'=>'ChatController@IndexWithMessage',
	'as'=>'index.message'
	])->middleware('permission:Direct Chat');


Route::get('canceled/invoices',['uses'=>'InvoiceController@canceled','as'=>'canceled.invoices'])->middleware('permission:View Canceled Invoice');
Route::get('retrieve/invoice/{id}',['uses'=>'InvoiceController@retrieve','as'=>'invoice.retrieve'])->middleware('permission:Restore Invoice');
Route::get('kill/invoice/{id}',['uses'=>'InvoiceController@kill','as'=>'invoice.kill'])->middleware('permission:Cancel Invoice');
Route::get('pay/invoice/{id}',['uses'=>'InvoiceController@pay','as'=>'invoice.pay'])->middleware('permission:Pay Invoice');
Route::post('payy/invoice/{id}',['uses'=>'InvoiceController@payy','as'=>'invoice.payy'])->middleware('permission:Pay Invoice');
Route::get('accept/{token}', 'InviteController@accept')->name('accept');
Route::get('confirm/{token}', 'InviteController@confirm')->name('confirm');
Route::get('deleteClientPassportData/{token}', 'InviteController@deleteClientPassportData')->name('deleteClientPassportData');


Route::get('/client/documents/movement',[
	'uses' => 'ClientDocController@index',
	'as' => 'clientDocIndex'
])->middleware('permission:Client Documents Movement');
Route::get('/client/documents/movement/store/{id}',[
	'uses' => 'ClientDocController@store',
	'as' => 'clientDoc.store'
])->middleware('permission:Client Documents Movement');
Route::get('/client/documents/movement/redirected/{name}',[
	'uses' => 'ClientDocController@redirected',
	'as' => 'redirected'
])->middleware('permission:Client Documents Movement');
Route::get('/client/documents/movement/destroy/{id}',[
	'uses' => 'ClientDocController@destroy',
	'as' => 'clientDoc.destroy'
])->middleware('permission:Client Documents Movement');
Route::post('/emergency/message',[
	'uses' => 'ClientDocController@emergency',
	'as' => 'emergency'
])->middleware('permission:Client Documents Movement');

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


Route::post('/search/client',[
		'uses' => 'clientController@search',
		'as' => 'searchClient'
	]);
	Route::post('/search/client/for/doc',[
		'uses' => 'clientController@searchForDoc',
		'as' => 'searchClientForDoc'
	]);
	Route::post('/find/Employee',[
		'uses' => 'employeeController@searchEmployee',
		'as' => 'searchEmployees'
	]);
	Route::post('/find/EmployeeG',[
		'uses' => 'employeeController@searchEmployeeG',
		'as' => 'searchEmployeesG'
	]);
Route::post('/search/employee',[
		'uses' => 'employeeController@search',
		'as' => 'searchEmployee'
	]);


Route::get('/assign/task',[
			'uses'=> 'AssignmentController@index',
			'as'=>'assign'
		]);
Route::post('/accept/task',[
	'uses'=> 'AssignmentController@store',
	'as'=>'assignTask'
]);
Route::get('/accept/task/{id}',[
	'uses'=> 'AssignmentController@accept',
	'as'=>'task.accept'
]);


Route::get('/assignments/{id}',[
			'uses'=> 'AssignmentController@assignments',
			'as'=>'assignments'
		]);
Route::get('/assignment/Done/{id}',[
			'uses'=> 'AssignmentController@assignmentDone',
			'as'=>'assignmentDone'
		]);


Route::get('/activate/employee/{id}',[
	'uses'=> 'employeeController@activate',
	'as'=>'activateEmployee'
])->middleware('permission:Activate/Deactivate Employee');
Route::get('/deactivate/employee/{id}',[
	'uses'=> 'employeeController@deactivate',
	'as'=>'deactivateEmployee'
])->middleware('permission:Activate/Deactivate Employee');
// Route::get('/search/client',['as'=>'searchClient'],function(){
// 	dd(true);
// 	$clients = App\client::where('first_name', 'like', '%'.request('client_name').'%')->get();
// 	return view('status')->with('clients',$clients);
// });



Route::post('sendEmail', [
        'uses' => 'HomeController@sendEmail',
        'as' => 'send.email',
    ]);

Route::resource('tasks', 'TasksController');


Route::get('/client/status',[
			'uses'=> 'clientController@status',
			'as'=>'clientStatus'
		])->middleware('permission: Client Visa Application Status');
Route::post('/status/save',[
			'uses'=> 'clientController@statusSave',
			'as'=>'statusSave'
		])->middleware('permission: Client Visa Application Status');


Route::get('/letter',[
			'uses'=> 'HomeController@letter',
			'as'=>'letter'
		])->middleware('permission: Generate Letter');
Route::post('/send/letter',[
			'uses'=> 'HomeController@sendLetter',
			'as'=>'sendLetter'
		])->middleware('permission: Generate Letter');


Route::post('/send/letter/{id}',[
	'uses'=> 'employeeController@sendLetterToEmployee',
	'as'=>'sendLetterTOEmployee'
	])->middleware('permission: Letter To Employee');


Route::get('/task/delete/{id}',[
			'uses'=> 'TasksController@destroy',
			'as'=>'task.destroy'
		]);


Route::get('/tax',[
			'uses'=> 'HomeController@tax',
			'as'=>'tax'
		])->middleware('permission: VAT Updation');
Route::post('/tax/update/',[
			'uses'=> 'HomeController@taxUpdate',
			'as'=>'tax.update'
		])->middleware('permission: VAT Updation');


Route::get('/searchAirline','InvoiceController@AirlineSearch');
Route::get('/searchAirport','InvoiceController@AirportSearch');
Route::get('/searchAirportArrival','InvoiceController@AirportArrivalSearch');





Route::get('/paidInvoice/report',[
			'uses'=> 'ReportController@paidInvoice',
			'as'=>'paidInvoice.report'
		])->middleware('permission: View/Export Reports');
Route::get('/unpaidInvoice/report',[
			'uses'=> 'ReportController@unpaidInvoice',
			'as'=>'unpaidInvoice.report'
		])->middleware('permission: View/Export Reports');
Route::get('/expenses/report',[
			'uses'=> 'ReportController@expenses',
			'as'=>'expenses.report'
		])->middleware('permission: View/Export Reports');
Route::get('/visa/report',[
	'uses'=> 'ReportController@visa',
	'as'=>'visa.report'
		])->middleware('permission: View/Export Reports');
Route::get('/document/movement/report',[
	'uses'=> 'ReportController@docMovement',
	'as'=>'docmov.report'
		])->middleware('permission: View/Export Reports');




Route::get('/session',[
		'uses' => 'wageController@session',
		'as' => 'session'
	]);
Route::post('/Login',[
		'uses' => 'wageController@Login',
		'as' => 'Login'
	]);
Route::post('/Logout',[
		'uses' => 'wageController@Logout',
		'as' => 'Logout'
	]);
Route::get('/wage',[
		'uses' => 'wageController@index',
		'as' => 'wage'
	])->middleware('permission: Staff Wage management');
Route::get('/employee/wage/log/{id}',[
		'uses' => 'wageController@show',
		'as' => 'wage.log'
	])->middleware('permission: Staff Wage management');


Route::get('/generate/slip',[
		'uses' => 'wageController@generateSlip',
		'as' => 'slip.generate'
	])->middleware('permission: Employee Salary Slip');
Route::post('/slip',[
		'uses' => 'wageController@slip',
		'as' => 'slip'
	])->middleware('permission: Employee Salary Slip');



Route::get('/employees',[
		'uses' => 'employeeController@index',
		'as' => 'employees'
	])->middleware('permission: View Employees');
Route::get('/employee/registration',[
		'uses' => 'employeeController@create',
		'as' => 'create.employee'
	])->middleware('permission: Create Employee');
Route::post('/employee/store',[
		'uses' => 'employeeController@store',
		'as' => 'store.employee'
		])->middleware('permission: Create Employee');
Route::post('/employee/update/{id}',[
		'uses' => 'employeeController@update',
		'as' => 'update.employee'
		])->middleware('permission: Create Employee');
Route::get('/employee/edit/{id}',[
		'uses' => 'employeeController@edit',
		'as' => 'edit.employee'
	])->middleware('permission: Edit Employee');
Route::get('/employee/view/{id}',[
		'uses' => 'employeeController@show',
		'as' => 'view.employee'
	])->middleware('permission: View Employees');
// Route::get('/employee/delete/{id}',[
// 		'uses' => 'employeeController@destroy',
// 		'as' => 'delete.employee'
// 	]);
Route::get('/employeeletter/{id}',[
		'uses' => 'employeeController@letter',
		'as' => 'letter.employee'
		])->middleware('permission: Letter To Employee');
Route::get('/status',[
		'uses' => 'employeeController@status',
		'as' => 'status'
	])->middleware('permission: Employee Attendance Status');
Route::post('/employee/status',[
		'uses' => 'employeeController@status2',
		'as' => 'status2'
	])->middleware('permission: Employee Attendance Status');



Route::get('/clients',[
		'uses' => 'clientController@index',
		'as' => 'clients'
	])->middleware('permission:View Clients');
Route::get('/client/registration',[
		'uses' => 'clientController@create',
		'as' => 'create.client'
	])->middleware('permission:Create Client');
Route::post('/client/store',[
		'uses' => 'clientController@store',
		'as' => 'store.client'
	])->middleware('permission:Create Client');
Route::post('/client/update/{id}',[
		'uses' => 'clientController@update',
		'as' => 'update.client'
	])->middleware('permission:Edit Client');
Route::post('/client/family/update/{id}',[
	'uses' => 'clientController@updateFamily',
	'as' => 'update.family'
])->middleware('permission:Edit Client');
Route::get('/client/edit/{id}',[
		'uses' => 'clientController@edit',
		'as' => 'edit.client'
	])->middleware('permission:Edit Client');
Route::get('/client/family/edit/{id}',[
	'uses' => 'clientController@editFamily',
	'as' => 'edit.family'
])->middleware('permission:Edit Client');
Route::get('/client/view/{id}',[
		'uses' => 'clientController@show',
		'as' => 'view.client'
	])->middleware('permission:View Clients');
// Route::get('/client/delete/{id}',[
// 		'uses' => 'clientController@destroy',
// 		'as' => 'delete.client'
// 	]);



Route::get('/products',[
	'uses'=>'HomeController@products',
	'as'=>'products'
	])->middleware('permission:Services Registration');
Route::post('/add/product',[
	'uses'=>'HomeController@addProduct',
	'as'=>'product.add'
	])->middleware('permission:Services Registration');
Route::get('/delete/product/{id}',[
	'uses'=>'HomeController@destroyProduct',
	'as'=>'product.delete'
	])->middleware('permission:Services Registration');


Route::get('/airlines',[
	'uses'=>'HomeController@airlines',
	'as'=>'airlines'
	])->middleware('permission:Airlines Name Registration');
Route::post('/add/airline',[
	'uses'=>'HomeController@addAirline',
	'as'=>'airline.add'
	])->middleware('permission:Airlines Name Registration');
Route::get('/delete/airline/{id}',[
	'uses'=>'HomeController@destroyAirline',
	'as'=>'airline.delete'
	])->middleware('permission:Airlines Name Registration');


Route::get('/expense',[
	'uses'=>'expensesController@index',
	'as'=>'expenses.get'
	])->middleware('permission:Expense Entry');
Route::post('/expenses',[
	'uses'=>'expensesController@index',
	'as'=>'expenses'
	])->middleware('permission:Expense Entry');
Route::get('/Auto/deduction',[
	'uses'=>'expensesController@auto',
	'as'=>'auto.get'
	])->middleware('permission:Auto Deduction Expense Entry');
Route::post('/auto/deduction',[
	'uses'=>'expensesController@auto',
	'as'=>'auto',
	])->middleware('permission:Auto Deduction Expense Entry');
Route::get('/expense/delete/{id}',[
	'uses'=>'expensesController@destroy',
	'as'=>'expense.delete'
	])->middleware('permission:Delete Expense');





Route::get('/invoice',[
	'uses'=>'InvoiceController@index',
	'as'=>'invoice'
	])->middleware('permission:View Invoices');
Route::get('/invoice/view/{id}',[
	'uses'=>'InvoiceController@show',
	'as'=>'invoice.view'
	])->middleware('permission:View Invoices');
Route::get('/invoice/print/{id}',[
			'uses'=> 'InvoiceController@invoicePrint',
			'as'=>'invoice.print'
		])->middleware('permission:View Invoices');
Route::get('/create/invoice',[
	'uses'=>'InvoiceController@create',
	'as'=>'invoice.create'
	])->middleware('permission:Generate Invoice');
Route::post('/store/invoice',[
	'uses'=>'InvoiceController@store',
	'as'=>'invoice.store'
	])->middleware('permission:Generate Invoice');
Route::get('/delete/invoice/{id}',[
	'uses'=>'InvoiceController@destroy',
	'as'=>'invoice.delete'
	])->middleware('permission:Cancel Invoice');
Route::get('/edit/invoice/{id}',[
	'uses'=>'InvoiceController@edit',
	'as'=>'invoice.edit'
	])->middleware('permission:Edit Invoice');
Route::post('/update/invoice/{id}',[
	'uses'=>'InvoiceController@update',
	'as'=>'invoice.update'
	])->middleware('permission:Edit Invoice');
Route::get('/invoice/reminder/{id}',[
	'uses'=>'InvoiceController@reminder',
	'as'=>'invoice.reminder'
	])->middleware('permission:Send Reminder For Unpaid Invoice');
Route::get('/generate/invoice/pdf/{id}',[
	'uses'=> 'InvoiceController@generatePdf',
	'as'=>'pdf.invoice'
	])->middleware('permission:View Invoices');
Route::get('/invoice/print',[
			'uses'=> 'InvoiceController@invoicePrint',
			'as'=>'invoice.print'
		])->middleware('permission:View Invoices');
