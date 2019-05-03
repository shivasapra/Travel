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
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-hover mb-0">
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
                                <a href="{{route('find.role',['id'=>$rol->id])}}" class="btn btn-xs btn-success">Permissions</a>
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
                <form action="{{route('assign.permissions',['id'=>$role->id])}}" method="post">
                        @csrf
                @endif
                    <table class="table table-hover mb-0">
                        <div class="text-center">
                            <h2>All Permissions @if($permissions->count()>0 and $role != null) Under ({{$role->name}}) @endif</h2><hr>
                        </div>
                        <thead>
                            <tr>
                            <th>Sno.</th>
                            <th>Name</th>
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
                                <td>
                                    <input type="checkbox"  value="{{$permission->name}}" name="permissions[]" @if($role->hasPermissionTo($permission->name)) checked @endif>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if($permissions->count()>0 and $role != null)
                    <div class="text-center">
                        <button type="submit" class="btn btn-xs btn-success">Update</button>
                    </div>
                    @endif
                    </form>
                            
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
{{-- @section('js')
<script>
function findRole(id) {
    var roleId = id;
    var Url = "http://127.0.0.1:8000/find/role/" +roleId;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', Url, true);
    xhr.send();
    xhr.onreadystatechange = processRequest;
    function processRequest(e) {
    if (xhr.readyState == 4 && xhr.status == 200) {
    var response1 = JSON.parse(xhr.responseText);
    alert(response1[1]);
    var data =  '<table class="table table-hover mb-0">'+
                        '<div class="text-center">'+
                            '<h2>Permissions Under ('+ response1[0].name+ ')</h2><hr>'+
                        '</div>'+
                        '<thead>'+
                            '<tr>'+
                            '<th>Sno.</th>'+
                            '<th>Name</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                        if ( response[1].length > 0 ) {
                            for (var i = 0 ; i < response[1].length )
                            +'<tr>'+ 
                            '<th>'+ i++ +'</th>'+
                            '<td>'+ response[1][i] +'</td>'+
                            '<tr>'+ 
                            }
                        }
                        +'</tbody>'+
                    '</table>';
        $('#permissions').html(data);
    // document.getElementById("city").value = response1.result.admin_ward;
    // document.getElementById("country").value = response1.result.country;
    // document.getElementById("county").value = response1.result.admin_county;
    }
    }
    }
</script>
@stop --}}