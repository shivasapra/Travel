@extends('layouts.frontend')
@section('title')
Role Management
@endsection
@section('header')
	<section class="content-header">
      <h1>
       Role Management
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i>Role Management</li>
      </ol>
    </section>
@stop
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@stop
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-hover mb-0" id="example">
                    <div class="pull-right">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Role">Create Role</button>
                    </div>
                    <div class="text-center">
                        <h2>Roles</h2>
                    </div>
                    <thead>
                        <tr>
                        <th>Sno.</th>
                        <th>Name</th>
                        <th>##</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($roles->count()>0)
                        <?php $i = 1; ?>
                        @foreach($roles as $rol)
                        <tr>
                            <th>{{$i++}}.</th>
                            <td>{{$rol->name}}</td>
                            <td>
                                {{-- <button type="button" class="btn btn-xs btn-success" onClick="findRole({{$role->id}})" >Permissions</button> --}}
                                @can('Role Management')
                                <a href="{{route('find.role',['id'=>$rol->id])}}" class="btn btn-xs btn-success">Permissions</a>
                                @if($rol->name != 'Admin')
                                    <a onClick="return confirm('Are You Sure You Want To Delete The {{$rol->name}} Role?')" href="{{route('role.delete',['id'=>$rol->id])}}" class="btn btn-xs btn-danger">Delete Role</a>
                                @endif
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <div id="permissions">
                @if($permissions->count()>0 and $role != null)
                {{-- <form action="{{route('assign.permissions',['id'=>$role->id])}}" method="post">
                        @csrf --}}
                @endif
                    <table class="table table-hover mb-0" id="example2">
                        <div class="text-center">
                            <h2>All Permissions @if($permissions->count()>0 and $role != null) Under ({{$role->name}}) @endif</h2><hr>
                        </div>
                        <thead>
                            <tr>
                            <th>Sno.</th>
                            <th>Name</th>
                            <th>##</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($permissions->count()>0 and $role == null)
                            <?php $i = 1; ?>
                            @foreach($permissions as $permission)
                            <tr>
                                <th>{{$i++}}.</th>
                                <td>{{$permission->name}}</td>
                            </tr>
                            @endforeach
                            
                            @elseif($permissions->count()>0 and $role != null)
                            <?php $i = 1; ?>
                            @foreach($permissions as $permission)
                            
                            <tr>
                                <th>{{$i++}}.</th>
                                <td>{{$permission->name}}</td>
                                @if($role->name != 'Admin')
                                    <td>
                                        @can('Role Management')
                                        {{-- <input type="checkbox"  value="{{$permission->name}}" name="permissions[]" @if($role->hasPermissionTo($permission->name)) checked @endif> --}}
                                        <a 
                                        @if($role->hasPermissionTo($permission->name))
                                    onClick="return confirm('Are You Sure You Want To Revoke {{$permission->name}} Permission From {{$role->name}}?')" 
                                        href="{{route('revoke.permissions',['id'=>$role->id, 'permission_id'=>$permission->id])}}"
                                        @else
                                        onClick="return confirm('Are You Sure You Want To Assign {{$permission->name}} Permission To {{$role->name}}?')"
                                        href="{{route('assign.permissions',['id'=>$role->id, 'permission_id'=>$permission->id])}}"
                                        @endif

                                        @if($role->hasPermissionTo($permission->name)) 
                                            class="btn btn-sm btn-success" 
                                        @else 
                                            class="btn btn-sm btn-danger" 
                                        @endif 
                                        style="border-radius:50%"></a>
                                        @endcan
                                    </td>
                                @else
                                <td>
                                    @can('Role Management')
                                    <button  type="button"
                                    @if($role->hasPermissionTo($permission->name)) 
                                        class="btn btn-sm btn-success" 
                                    @else 
                                        class="btn btn-sm btn-danger" 
                                    @endif 
                                    style="border-radius:50%"></button>
                                    @endcan
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- @if($permissions->count()>0 and $role != null)
                    <div class="text-center">
                        <button type="submit" class="btn btn-xs btn-success">Update</button>
                    </div>
                    @endif
                    </form> --}}
                            
                </div>
            </div>
        </div>
    </div>
</div>
    

<div class="modal fade" id="Role" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content" >
        <div class="modal-header bg-light" >
            <h5 class="modal-title" id="exampleModalLongTitle" ><strong>Create Role!!</strong></h5>
        </div>
    <form action="{{route('create.role')}}" method="post" >
        @csrf
        <div class="modal-body" >
            <label for="name" class="pull-left"><strong>Role Name:</strong></label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="modal-footer bg-light" >
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Add Role</button>
        </div>
        </form>
        </div>
    </div>
</div>
@stop
@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>


  <script>
  	$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        ]
    } );

    $('#example2').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        ]
    } );
} );
</script>
@endsection
