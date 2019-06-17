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




			<form action="{{route('update.client',['id'=>$client->id])}}" enctype="multipart/form-data" method="post">
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
					<div class="col-md-3">
					<div class="form-group">
						<label for="phone">Phone</label>
						<input type="text" name='phone' required class="form-control" value="{{$client->phone}}">
					</div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label for="client_type">Client Type:</label>
                        <select name="client_type" class="form-control">
                            <option value="Corporate" {{($client->client_type == 'Corporate')?"selected":" "}}>Corporate</option>
                            <option value="Individual" {{($client->client_type == 'Individual')?"selected":" "}}>Individual</option>
                        </select>
                    </div>
                    </div>
				</div>
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name='email' required class="form-control" value="{{$client->email}}">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="DOB">DOB</label>
						<input type="date" name='DOB' required class="form-control" value="{{$client->DOB}}">
					</div>
					</div>
					@if($client->credit_limit != null)
					<div class="col-md-4">
						<div class="form-group">
							<label for="credit_limit">Credit Limit</label>
							<input type="text" name='credit_limit' required class="form-control" value="{{$client->credit_limit}}">
						</div>
						</div>
					@endif
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
							<input type="file" name="passport_front"  class="form-control" value="{{$client->passport_front}}">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="passport_back">Passport Back</label>
							<input type="file" name="passport_back"  class="form-control" value="{{$client->passport_back}}">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="letter">Letter:</label>
							<input type="file" name="letter"  class="form-control" value="{{$client->letter}}"> <br>	<br><hr>
						</div>
					</div>
				</div>
				@endif
				@if($client->family->count() > 0)
				<?php $i=1?>
				{{-- <div class="text-center"><h3>Family Members</h3></div><hr>
				@foreach($client->family as $fam)
				<div class="hatao">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="member_name[]"><strong>{{$i++}}</strong>. Member Name</label>
								<input type="text" name="member_name[]" value="{{$fam->member_name}}" required class="form-control">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="member_DOB[]">Member DOB</label>
								<input type="date" name="member_DOB[]" value="{{$fam->member_DOB}}" required class="form-control">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="member_passport_no[]">Member Passport NO.</label>
								<input type="text" name="member_passport_no[]" value="{{$fam->member_passport_no}}" required class="form-control">
							</div>
						</div>
						<div class="col-md-3">
								<div class="form-group">
									<label for="member_passport_place">Place of Issue</label>
									<input type="text" name="member_passport_place[]" value="{{$fam->member_passport_place}}" required class="form-control">
								</div>
							</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="member_passport_place">Place of Issue</label>
								<input type="text" name="member_passport_place[]" value="{{$fam->member_passport_place}}" required class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="member_passport_front">Passport Front:</label>
								<input type="file" name="member_passport_front[]"  class="form-control" value="{{$fam->member_passport_front}}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
							<label for="member_passport_back">Passport Back:</label>
							<input type="file" name="member_passport_back[]"  class="form-control" value="{{$fam->member_passport_back}}">
							</div>
						</div>
					</div>
					<div align="right">
						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">	<br><br>
					</div>
				</div>
				@endforeach --}}
				@endif
				<div id="family-member"></div>
				<div align="right" style="margin-top: 5px">
					<button class="btn btn-sm btn-primary" type="button" id="add">Add Family Member</button>
				</div>
		</div>
		</div>
				<div class="form-group">
					<div class="text-center">
						<button class="btn btn-success" type="submit">Update</button>
					</div>
				</div>
			</form>



@stop
@section('js')
<script>
	$(document).ready(function(){
    $("#add").click(function(){
    		var append = '<div class="text-center"><h3>New Family Member</h3></div><hr><div class="hatao"><div class="row">	<div class="col-md-4">		<div class="form-group">			<label for="member_name[]">Member Name</label>			<input type="text" name="member_name[]" required class="form-control">		</div>	</div>	<div class="col-md-4">		<div class="form-group">			<label for="member_DOB[]">Member DOB</label>			<input type="date" name="member_DOB[]" value="{{$date}}" required class="form-control">		</div>	</div>	<div class="col-md-4">		<div class="form-group">			<label for="member_passport_no[]">Member Passport NO.</label>			<input type="text" name="member_passport_no[]" required class="form-control">		</div>	</div></div><div class="row"><div class="col-md-4"><div class="form-group"><label for="member_passport_place">Place of Issue</label><input type="text" name="member_passport_place[]" required class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label for="member_passport_front">Passport Front:</label><input type="file" name="member_passport_front[]" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label for="member_passport_back">Passport Back:</label><input type="file" name="member_passport_back[]" class="form-control"></div></div></div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">	</div></div>';
        $("#family-member").append(append);
        });
    });
function SomeDeleteRowFunction(btndel) {
    if (typeof(btndel) == "object") {
        $(btndel).closest('.hatao').remove();
    } else {
        return false;
    }}</script>
@stop
