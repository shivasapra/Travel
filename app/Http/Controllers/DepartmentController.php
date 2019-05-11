<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        return view('departments.index')->with('roles',Role::all());
    }

    public function accounts(){
        return view('departments.accounts')->with('roles',Role::all());
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
}

