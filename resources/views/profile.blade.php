@extends('layouts.frontend')
@section('title')
Edit Profile
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Edit Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
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



	<form action="{{route('update.profile')}}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="box box-warning">
		<div class="box-body">
			<div class="container text-center">
            	<img 
            	@if(Auth::user()->avatar)
                  src="{{asset(Auth::user()->avatar)}}"
                @else
                  src="{{asset('app/images/user-placeholder.jpg')}}"
                @endif 
                alt="avatar" height="300px" width="300px" style="border-radius:20px">
            </div>
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name='name' value="{{$user->name}}" class="form-control">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name='email' value="{{$user->email}}" class="form-control">
			</div>
			<div class="form-group">
				<label for="password">New Password:</label>
				<input type="password" name='password' class="form-control">
			</div>
			<div class="form-group">
				<label for="avatar">Image</label>
				<input type="file" name='avatar' class="form-control">
			</div>
        	<div class="form-group">
			<div class="text-center">
				<button class="btn btn-success" type="submit">Update</button>
			</div>
			</div>
		</div>
		</div>
	</form>
		
		


@stop