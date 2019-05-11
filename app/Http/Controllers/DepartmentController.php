<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        return view('departments.index')->with('roles',Role::all());
    }

    public function accounts(){
        $paid_invoices = invoice::where('status',1)->get();
        $unpaid_invoices = invoice::where('status',0)->get();
        $canceled_invoices = invoice::onlyTrashed()->get();
        return view('departments.accounts')->with('roles',Role::all())
                                        ->with('paid_invoices',$paid_invoices)
                                        ->with('unpaid_invoices',$unpaid_invoices)
                                        ->with('canceled_invoices',$canceled_invoices)
                                        ->with('invoices',invoice::where('invoice_date',Carbon::now()->timezone('Europe/London')->toDateString()));
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

