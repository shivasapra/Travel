<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use App\User;

class RolesController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Role.index')->with('roles',Role::all())
                                 ->with('role',null)
                                 ->with('permissions',Permission::all());
    }

    public function CreateRole(Request $request)
    {
        Role::create(['name' => $request->name]);
        Session::flash('success','New Role created');
        return redirect()->back();
    }

    public function findRole($id){
        $role = Role::find($id);
        return view('Role.index')->with('roles',Role::all())
                                 ->with('permissions',Permission::all())
                                 ->with('role',$role);
    }

    public function assignPermissions($id,$permission_id){
        $role = Role::find($id);
        $role->givePermissionTo($permission_id);
        return $role;
    }

    public function revokePermissions($id,$permission_id){
        $role = Role::find($id);
        $role->revokePermissionTo($permission_id);
        return $role;
    }

    public function userRole($id){
        return view('userRoles')->with('user',User::find($id))
                                ->with('roles',Role::all())
                                ->with('permissions',Permission::all());
    }

    public function assignUserRoles(Request $request, $id){
        $user = User::find($id);
        foreach($user->roles as $role){
            $user->removeRole($role);
        }
        $user->assignRole($request->roles);
        Session::flash('success','Role Assigned');
        return redirect()->back();
    }

    public function destroyRole($id)
    {
        $role = Role::find($id);
        $role->delete();
        Session::flash('warning','Role deleted!!');
        return view('Role.index')->with('roles',Role::all())
                                 ->with('role',null)
                                 ->with('permissions',Permission::all());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
}
