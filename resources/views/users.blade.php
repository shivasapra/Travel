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
	
	@if(count($errors)>0)
		<ul class="list-group">
			@foreach($errors->all() as $error)
				<li class="list_group-item text-danger">
					{{ $error }}
				</li>
			@endforeach
		</ul>
	@endif

<div class="box box-primary">
    <div class="box-body">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                <th>Sno.</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
                </tr>
                </thead>
            <tbody>
                @if($users->count()>0)
                <?php $i = 1; ?>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <img alt="" height="50px" class="img-circle "
                            @if($user->avatar)
                                src="{{asset(Auth::user()->avatar)}}"
                            @else
                                src="{{asset('app/images/user-placeholder.jpg')}}"
                            @endif 
                            class="img-circle" alt="User Image"><br>
                            <div class="text-center">
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <form action="{{route('assignuser.roles',['id'=>$user->id])}}" method="post">
                        @csrf
                            <td>
                                <select name="roles" id="" class="form-control">
                                    <option value="">{{'--Select Role--'}}</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}" @if($user->hasRole($role->name)) selected @endif>{{$role->name}}</option>
                                    @endforeach
                                </select>
                                {{-- <a href="{{route('user.roles',['id'=>$user->id])}}" class="btn btn-xs btn-success">Roles/Permisssions</a> --}}
                            </td>
                            <td>
                                <button type="submit" class="btn btn-xs btn-success">Save</button>
                            </td>
                        </form>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@stop