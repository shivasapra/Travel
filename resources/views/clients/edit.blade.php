@extends('layouts.frontend')
@section('title')
Edit Client
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Edit Client
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('clients')}}"><i class="fa fa-user-circle"></i> clients</a></li>
        <li class="active">Edit Client</li>
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



	
			<form action="{{route('update.client',['id'=>$client->id])}}" method="post">
				@csrf
		<div class="box box-success">
		<div class="box-body">
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="first_name">First Name</label>
						<input type="text" name='first_name' required class="form-control" value="{{$client->first_name}}">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="last_name">Last Name</label>
						<input type="text" name='last_name' required class="form-control"value="{{$client->last_name}}">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="country">Country</label>
						<input type="text" name='country' required class="form-control" value="{{$client->country}}">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="county">County</label>
						<input type="text" name='county' required class="form-control" value="{{$client->county}}">
					</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="postal_code">Postal Code</label>
						<input type="text" name='postal_code' required class="form-control" value="{{$client->postal_code}}">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="city">City</label>
						<input type="text" name='city' required class="form-control" value="{{$client->city}}">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="address">Client Address</label>
						<input type="text" name='address' required class="form-control" value="{{$client->address}}">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="phone">Phone</label>
						<input type="text" name='phone' required class="form-control" value="{{$client->phone}}">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name='email' required class="form-control" value="{{$client->email}}">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="DOB">DOB</label>
						<input type="date" name='DOB' required class="form-control" value="{{$client->DOB}}">
					</div>
					</div>
				</div>
				
				
		</div>
		</div>
			</form>
				<div class="form-group">
					<div class="text-center">
						<button class="btn btn-success" type="submit">Update</button>
					</div>
				</div>
	


@stop