@extends('layouts.frontend')
@section('title')
Users
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
      </ol>
    </section>
@stop
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
            <form action="" method="post">
                @csrf
                <table class="table table-hover mb-0">
                    <div class="text-center">
                        <h2>Roles</h2>
                    </div>
                    <thead>
                        <tr>
                        <th>Sno.</th>
                        <th>Name</th>
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
                                <input type="checkbox"  value="{{$role->name}}" name="roles[]" @if($user->hasRole($role->name)) checked @endif>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="text-center">
                    <button type="submit" class="btn btn-xs btn-success">Update</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <div id="permissions">
                <form action="" method="post">
                        @csrf
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
                            <?php $i = 1; ?>
                            @foreach($permissions as $permission)
                            <tr>
                                <th>{{$i++}}.</th>
                                <td>{{$permission->name}}</td>
                                <td>
                                    <input type="checkbox"  value="{{$permission->name}}" name="permissions[]" @if($user->hasPermissionTo($permission->name)) checked @endif>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-xs btn-success">Update</button>
                    </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@stop