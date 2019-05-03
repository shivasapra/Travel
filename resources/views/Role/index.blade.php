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
                        @foreach($roles as $role)
                        <tr>
                            <th>{{$i++}}.</th>
                            <td>{{$role->name}}</td>
                            <td>
                                <a href="#" class="btn btn-xs btn-success">Permissions</a>
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
                <table class="table table-hover mb-0">
                    <div class="text-center">
                        <h2>Permissions</h2><hr>
                    </div>
                    <thead>
                        <tr>
                        <th>Sno.</th>
                        <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($permissions->count()>0)
                        <?php $i = 1; ?>
                        @foreach($permissions as $permission)
                        <tr>
                            <th>{{$i++}}.</th>
                            <td>{{$permission->name}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
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