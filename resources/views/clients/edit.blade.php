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
						<input type="date" name='DOB' value="{{ Carbon\Carbon::parse($client->DOB)->toDateString()}}" required class="form-control">
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
							<div class="image-outer-div">
								<img  id="passport_front"
									src="{{asset($client->passport_front)}}"
								alt="passport_front" height="250px" width="250px" style="border-radius:20px">
								<label for="front" class="upload-icon">
										<i class="fa fa-camera" aria-hidden="true"></i>
								</label>
								<input type="file" id="front" name='passport_front' onchange="readURLFront(this);"  class="form-control" style="display:none;">
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="passport_back">Passport Back</label>
							<div class="image-outer-div">
								<img  id="passport_back"
									src="{{asset($client->passport_back)}}"
								alt="passport_back" height="250px" width="250px" style="border-radius:20px">
								<label for="back" class="upload-icon">
										<i class="fa fa-camera" aria-hidden="true"></i>
								</label>
								<input type="file" id="back" name='passport_back' onchange="readURLBack(this);"  class="form-control" style="display:none;">
							</div>
							{{-- <input type="file" name="passport_back"  class="form-control" value="{{$client->passport_back}}"> --}}
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="letter">Letter:</label>
							<div class="image-outer-div">
								<img  id="letter"
									src="{{asset($client->letter)}}"
								alt="letter" height="250px" width="250px" style="border-radius:20px">
								<label for="lette" class="upload-icon">
										<i class="fa fa-camera" aria-hidden="true"></i>
								</label>
								<input type="file" id="lette" name='letter' onchange="readURLLetter(this);"  class="form-control" style="display:none;">
							</div>
							{{-- <input type="file" name="letter"  class="form-control" value="{{$client->letter}}">  --}}
							<br>	<br><hr>
						</div>
					</div>
				</div>
				@else
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="passport">Do you have passport</label>
							<input type="radio" name='passport' required id="yespassport" value=1>Yes
							<input type="radio" name='passport' required id="nopassport" checked value=0>No
						</div>
					</div>
				</div>
				<div id="passport"></div>
				@endif
				@if($client->permanent == 0)
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="passport">Do you want to make this client permanent</label>
							<input type="radio" name='permanent' required id="yespermanent" value=1>Yes
							<input type="radio" name='permanent' required id="nopermanent" checked value=0>No
						</div>
					</div>
					<div class="col-md-6">
						<div id="permanent"></div>
					</div>
				</div>
				@endif
				@if($client->family->count() > 0)
				<?php $i=1?>
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
    		var append = '<div class="hatao"><div class="text-center"><h3>New Family Member</h3></div><hr><div class="row">	<div class="col-md-4">		<div class="form-group">			<label for="member_name[]">Member Name</label>			<input type="text" name="member_name[]" required class="form-control">		</div>	</div>	<div class="col-md-4">		<div class="form-group">			<label for="member_DOB[]">Member DOB</label>			<input type="date" name="member_DOB[]" value="{{$date}}" required class="form-control">		</div>	</div>	<div class="col-md-4">		<div class="form-group">			<label for="member_passport_no[]">Member Passport NO.</label>			<input type="text" name="member_passport_no[]" required class="form-control">		</div>	</div></div><div class="row"><div class="col-md-4"><div class="form-group"><label for="member_passport_place">Place of Issue</label><input type="text" name="member_passport_place[]" required class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label for="member_passport_front">Passport Front:</label><input type="file" name="member_passport_front[]" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label for="member_passport_back">Passport Back:</label><input type="file" name="member_passport_back[]" class="form-control"></div></div></div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">	</div></div>';
        $("#family-member").append(append);
        });
    });
function SomeDeleteRowFunction(btndel) {
    if (typeof(btndel) == "object") {
        $(btndel).closest('.hatao').remove();
    } else {
        return false;
	}}</script>
	
	<script>
			function readURLFront(input) {
					  if (input.files && input.files[0]) {
						  var reader = new FileReader();
		  
						  reader.onload = function (e) {
							  $('#passport_front')
								  .attr('src', e.target.result);
						  };
		  
						  reader.readAsDataURL(input.files[0]);
					  }
				  }
				  function readURLBack(input) {
					  if (input.files && input.files[0]) {
						  var reader = new FileReader();
		  
						  reader.onload = function (e) {
							  $('#passport_back')
								  .attr('src', e.target.result);
						  };
		  
						  reader.readAsDataURL(input.files[0]);
					  }
				  }
				  function readURLLetter(input) {
					  if (input.files && input.files[0]) {
						  var reader = new FileReader();
		  
						  reader.onload = function (e) {
							  $('#letter')
								  .attr('src', e.target.result);
						  };
		  
						  reader.readAsDataURL(input.files[0]);
					  }
				  }

				  $(document).ready(function(){
	    $("#yespassport").click(function(){
	    	var data = '<hr><div class="text-center"><h3>Passport Details</h3></div><hr><div class="row"><div class="col-md-6"><div class="form-group"><label for="passport_no">Passport Number</label><input type="text" name="passport_no" required class="form-control" maxlength="10"></div></div><div class="col-md-6"><div class="form-group"><label for="passport_expiry_date">Passport Expire date</label><input type="date" name="passport_expiry_date" required class="form-control"></div></div></div><div class="row"><div class="col-md-6"><div class="form-group"><label for="passport_place">Place of Issue</label><input type="text" name="passport_place" required class="form-control"></div></div><div class="col-md-6"><div class="form-group"><label for="passport_issue_date">Date Of Issue</label><input type="date" name="passport_issue_date" required class="form-control"></div></div></div><div class="row"><div class="col-md-4"><div class="form-group"><label for="passport_front">Passport Front:</label><input type="file" name="passport_front" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label for="passport_back">Passport Back:</label><input type="file" name="passport_back" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label for="passport_front">Letter:</label><input type="file" name="letter" class="form-control"></div></div></div><hr>';
	        $("#passport").html(data);
	        });
	    });
	    $(document).ready(function(){
	    $("#nopassport").click(function(){
	    	var data = '';
	        $("#passport").html(data);
	        });
	    });

	    $(document).ready(function(){
	    $("#yespermanent").click(function(){
	    	var data = '<div class="row"><div class="col-md-6"><div class="form-group"><label for="currency">Currency</label><select name="currency" class="form-control" id="currency"><option value="$">$</option><option value="&#163;" selected>&#163;</option></select></div></div><div class="col-md-6"><div class="form-group"><label for="credit_limit">Credit Limit</label><input type="text" name="credit_limit" required class="form-control"></div></div></div>';
	        $("#permanent").html(data);
	        });
	    });
	    $(document).ready(function(){
	    $("#nopermanent").click(function(){
	    	var data = '';
	        $("#permanent").html(data);
	        });
	    });
		  </script>
@stop
