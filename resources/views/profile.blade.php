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
			<div class="image-outer-div">
            	<img  id="blah"
            	@if(Auth::user()->avatar)
                  src="{{asset(Auth::user()->avatar)}}"
                @else
                  src="{{asset('app/images/user-placeholder.jpg')}}"
                @endif 
				alt="avatar" height="250px" width="250px" style="border-radius:20px">
				<label for="avatar" class="upload-icon">
						<i class="fa fa-camera" aria-hidden="true"></i>
				</label>
				<input type="file" id="avatar" name='avatar' onchange="readURL(this);"  class="form-control" style="display:none;">
			</div>
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
				
			</div>
        	<div class="form-group">
			<div class="text-center">
				<button class="btn btn-success" type="submit">Update</button>
			</div>
			</div>
		</div>
		</div>
	</form>
		
<script>
  function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>		


@stop