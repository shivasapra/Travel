<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use App\User;
use App\invoice;
use Carbon\Carbon;

class DepartmentController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('departments.index')->with('roles',Role::all());
    }

    public function accounts(){
        $paid_invoices = invoice::where('status',1)->where('refund',0)->get();
        $unpaid_invoices = invoice::where('status',0)->where('refund',0)->get();
        $canceled_invoices = invoice::onlyTrashed()->get();
        $refunded_invoices = invoice::where('refund',1)->get();
        $todays_invoices = invoice::withTrashed()->where('invoice_date',Carbon::now()->timezone('Europe/London')->toDateString())->get();
        $invoice_issues = invoice::where('issues','!=',null)->get();
        return view('departments.accounts')->with('roles',Role::all())
                                           ->with('paid_invoices',$paid_invoices)
                                           ->with('unpaid_invoices',$unpaid_invoices)
                                           ->with('canceled_invoices',$canceled_invoices)
                                           ->with('refunded_invoices',$refunded_invoices)
                                           ->with('todays_invoices',$todays_invoices)
                                           ->with('invoices',invoice::withTrashed()->get())
                                           ->with('invoice_issues',$invoice_issues);
    }

    public function marketing(){
        return view('departments.marketing')->with('roles',Role::all());
    }
    
    public function operations(){
        return view('departments.operations')->with('roles',Role::all());
    }

    public function hrd(){
        return view('departments.hrd')->with('roles',Role::all());
    }

    public function displaySpecific($slug){
        $users = User::role($slug)->get();
        return view('departments.displaySpecific')->with('users',$users)
                                                  ->with('slug',$slug);
    }
}

