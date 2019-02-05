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
						<label for="address">Street</label>
						<input type="text" name='address' required class="form-control" value="{{$client->address}}">
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
						<label for="county">County</label>
						<input type="text" name='county' required class="form-control" value="{{$client->county}}">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="postal_code">Postal Code</label>
						<input type="text" name='postal_code' required class="form-control" value="{{$client->postal_code}}">
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
				@if($client->passport == 1)
				<div class="text-center"><h3>Passport Details</h3></div><hr>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="passport_no">Passport Number</label>
							<input type="text" name="passport_no" required class="form-control" value="{{$client->passport_no}}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="passport_expiry_date">Passport Expire date</label>
							<input type="date" name="passport_expiry_date" required class="form-control" value="{{$client->passport_expiry_date}}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="passport_place">Place of Issue</label>
							<input type="text" name="passport_place" required class="form-control" value="{{$client->passport_place}}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="passport_issue_date">Date Of Issue</label>
							<input type="date" name="passport_issue_date" required class="form-control" value="{{$client->passport_issue_date}}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="passport_front">Passport Front</label>
							<input type="file" name="passport_front" required class="form-control" value="{{$client->passport_front}}">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="passport_back">Passport Back</label>
							<input type="file" name="passport_back" required class="form-control" value="{{$client->passport_back}}">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="letter">Letter:</label>
							<input type="file" name="letter" required class="form-control" value="{{$client->letter}}">
						</div>
					</div>
				</div>
				@endif
				
				
		</div>
		</div>
				<div class="form-group">
					<div class="text-center">
						<button class="btn btn-success" type="submit">Update</button>
					</div>
				</div>
			</form>
	


@stop